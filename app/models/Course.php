<?php

class Course
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->pdo;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM courses";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM courses WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
