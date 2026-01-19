<?php

require_once __DIR__ . '/../core/Database.php';

class Student
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->pdo;
    }

    // get all students
    public function getAll()
    {
        $sql = "SELECT * FROM students";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update($id, $name, $email)
{
    $sql = "UPDATE students SET name = ?, email = ? WHERE id = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$name, $email, $id]);
}

public function delete($id)
{
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$id]);
}


    // register student
    public function register($name, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO students (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$name, $email, $hashedPassword]);
    }

    // login 
    public function authenticate($email, $password)
    {
        $sql = "SELECT * FROM students WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);

        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student && password_verify($password, $student['password'])) {
            return $student;
        }

        return false;
    }

    // find student by id
    public function findById($id)
    {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCourses($student_id) {
    $sql = "SELECT c.* 
            FROM courses c
            INNER JOIN enrollments e ON c.id = e.course_id
            WHERE e.student_id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$student_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// find student by email  
public function findByEmail($email)
{
    $sql = "SELECT * FROM students WHERE email = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$email]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


}
