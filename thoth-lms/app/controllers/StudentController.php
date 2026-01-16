<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Student.php';

class StudentController extends BaseController
{
    private $studentModel;

    public function __construct()
    {
        $this->studentModel = new Student();
    }

    // afficher le dashboard avec tous les cours et les cours de l'étudiant
public function dashboard() {
    // vérifier que l'étudiant est connecté
    if (!Auth::check()) {
        header("Location: /login");
        exit;
    }

    // récupérer tous les cours
    $courseModel = new Course(); // Assure-toi que Course.php existe dans models
    $courses = $courseModel->getAll();

    // récupérer les cours de l'étudiant connecté
    $myCourses = $this->studentModel->getCourses();

    // envoyer les données à la vue dashboard
    $this->render('student/dashboard', [
        'courses'   => $courses,
        'myCourses' => $myCourses
    ]);
}


    // afficher tous les étudiants
    public function index()
    {
        $students = $this->studentModel->getAll();
        $this->render('students/index', [
            'students' => $students
        ]);
    }

    // afficher formulaire
    public function create()
    {
        $this->render('students/create');
    }

    // sauvegarder étudiant
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

    // afficher formulaire update
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

    // update étudiant
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name  = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';

            $this->studentModel->update($id, $name, $email);

            header('Location: index.php?action=students');
            exit;
        }
    }
    // afficher formulaire register
    public function register()
    {
        $this->render('students/register');
    }

    // traiter formulaire register
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

            // redirect login
            header('Location: /login');
            exit;
        }
    }


    // supprimer étudiant
    public function delete($id)
    {
        $this->studentModel->delete($id);

        header('Location: index.php?action=students');
        exit;
    }
}
