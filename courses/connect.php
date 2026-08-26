<?php
class connect
{
    private $db;

    public function __construct()
    {
        // Connects to the database named "courses"
        $this->db = new PDO("mysql:host=localhost;dbname=course_system", "root", "");
    }

    // Function 1: Delete
    public function delete($table, $id)
    {
        $stmt = $this->db->prepare("DELETE FROM $table WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Function 2: Update
    public function update($data, $table, $id)
    {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $query = "UPDATE $table SET $fields WHERE id = :id";

        $data['id'] = $id;
        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    // Function 3: Add New Course
    public function new_course($data, $table)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        $stmt = $this->db->prepare($query);
        return $stmt->execute($data);
    }

    // Helper: Select One (needed to populate the Edit page)
    public function selectOne($table, $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Helper: Select All (needed to show courses on index page)
    public function selectAll($table)
    {
        $stmt = $this->db->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch courses AND the teacher's real name from the users table
    public function getAllCoursesWithTeacher()
    {
        $query = "SELECT courses.*, users.name AS teacher_name 
                  FROM courses 
                  LEFT JOIN teachers ON courses.teacher_id = teachers.id 
                  LEFT JOIN users ON teachers.user_id = users.id";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
