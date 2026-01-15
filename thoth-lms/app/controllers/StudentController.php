<?php
require_once __DIR__.'/BaseController.php';
require_once __DIR__.'/../models/Student.php';
class StudentController extends BaseController{
    private $studentModel;
    public function __construct(){
        $this->studentModel = new student();
    }
//affichge de tout les etudients
    public function index(){
        $student = $this->studentModel->getAll();
        $this->render('students/index',['students=>$students']);
    }
 //form
 
  public function create()
    {
        $this->render('students/create');
    }
}