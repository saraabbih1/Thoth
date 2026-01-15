<?php
 class student {
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->pdo;
    }

    public function register($name,$email,$password){
        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO student (name,email,password)VALUES(?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name,$email,$hashedPassword]);
    }
    public function authentificate($email,$password){
        $sql = "SELECT * FROM student WHERE email =?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute([$email]);

        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        if($student && password_verify($password,$student['password'])){
            return $student;
        }
        return false;
    }
    public function findById($id){
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
 }