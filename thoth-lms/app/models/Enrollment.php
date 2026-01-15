<?php

class Enrollment
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->pdo;
    }

    public function enroll($student_id, $course_id)
    {
        $sql = "INSERT INTO enrollments (student_id, course_id, enrollment_date)
                VALUES (?, ?, NOW())";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$student_id, $course_id]);
    }

    public function getStudentCourses($student_id)
    {
        $sql = "
            SELECT c.*
            FROM courses c
            INNER JOIN enrollments e ON c.id = e.course_id
            WHERE e.student_id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$student_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isEnrolled($student_id, $course_id)
    {
        $sql = "SELECT id FROM enrollments WHERE student_id = ? AND course_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$student_id, $course_id]);

        return $stmt->fetch() !== false;
    }
}
