<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/Enrollment.php';

class StudentController extends BaseController
{
    private $studentModel;
    private $courseModel;
    private $enrollmentModel;

    public function __construct()
    {
        $this->studentModel    = new Student();
        $this->courseModel     = new Course();
        $this->enrollmentModel = new Enrollment();
    }
//login 
    public function login()
{
    $this->render('student/login');
}
//storelogin
public function auth()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /login');
        exit;
    }

    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $this->render('student/login', [
            'error' => '   remplire tout les cases'
        ]);
        return;
    }

    $student = $this->studentModel->findByEmail($email);

    if (!$student || !password_verify($password, $student['password'])) {
        $this->render('student/login', [
            'error' => '  mots de pas ou email incorrect    '
        ]);
        return;
    }

    Auth::login($student['id']);
    header('Location: /student/dashboard');
    exit;
}

    // Dashboard étudiant
    public function dashboard()
    {
        if (!Auth::check()) {
            header("Location: /login");
            exit;
        }

        $courses   = $this->courseModel->getAll();
        $myCourses = $this->enrollmentModel->getStudentCourses($_SESSION['student_id']);

        $this->render('student/dashboard', [
            'courses'   => $courses,
            'myCourses' => $myCourses
        ]);
    }

    // Inscription à un cours
    public function enroll()
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /student/dashboard');
            exit;
        }

        if (!Auth::checkCsrfToken($_POST['csrf_token'] ?? '')) {
            die('CSRF token invalide');
        }

        $courseId  = (int) ($_POST['course_id'] ?? 0);
        $studentId = $_SESSION['student_id'];

        if ($courseId && !$this->enrollmentModel->isEnrolled($studentId, $courseId)) {
            $this->enrollmentModel->enroll($studentId, $courseId);
        }

        header('Location: /student/dashboard');
        exit;
    }

    // Afficher tous les étudiants
    public function index()
    {
        $students = $this->studentModel->getAll();
        $this->render('student/dashboard', [
            'students' => $students
        ]);
    }

    // Formulaire création étudiant
    public function create()
    {
        $this->render('students/create');
    }

    // Sauvegarder nouvel étudiant
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name  = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';

            if (empty($name) || empty($email)) {
                $this->render('students/create', [
                    'error' => 'Tous les champs sont obligatoires'
                ]);
                return;
            }

            $this->studentModel->register($name, $email, '123456');

            header('Location: /students');
            exit;
        }
    }

    // Formulaire update étudiant
    public function edit($id)
    {
        $student = $this->studentModel->findById($id);

        if (!$student) {
            echo "Student not found";
            return;
        }

        $this->render('students/edit', [
            'student' => $student
        ]);
    }

    // Mettre à jour étudiant
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name  = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';

            $this->studentModel->update($id, $name, $email);

            header('Location: /students');
            exit;
        }
    }

    // Formulaire inscription
    public function register()
    {
        $this->render('student/register');
    }

    // Traiter inscription
    public function storeRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name     = $_POST['name'] ?? '';
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($name) || empty($email) || empty($password)) {
                $this->render('students/register', [
                    'error' => 'Tous les champs sont obligatoires'
                ]);
                return;
            }

            $this->studentModel->register($name, $email, $password);

            header('Location: /login');
            exit;
        }
    }

    // Supprimer étudiant
    public function delete($id)
    {
        $this->studentModel->delete($id);

        header('Location: /students');
        exit;
    }
    //logout
    public function logout()
{
    Auth::logout();
    header('Location: /login');
    exit;
}
}
