<?php
class Connect2
{
    private const host_name = "localhost";
    private const user_name = "root";
    private const password = "";
    private const db = "course_system(1)";

    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect(self::host_name, self::user_name, self::password, self::db);

        if (!$this->conn) {
            die("database connection failed: " . mysqli_connect_error());
        }
    }

    public function insert(array $post, string $table): bool
    {
        $cols = [];
        $values = [];
        foreach ($post as $key => $value) {
            $cols[] = $key;
            $values[] = "'" . $this->conn->real_escape_string($value) . "'";
        }
        $colsString = implode(',', $cols);
        $valuesString = implode(',', $values);
        if ($this->conn->query("insert into " . $table . " (" . $colsString . ") values (" . $valuesString . ")")) {
            return true;
        } else {
            return false;
        }
    }

    public function lastId(): int
    {
        return $this->conn->insert_id;
    }


    public function login(string $email): array
    {
        $safeEmail = $this->conn->real_escape_string($email);
        $row = $this->conn->query("SELECT * FROM users WHERE email='$safeEmail' limit 1");
        if ($row && $row->num_rows > 0) {
            $data = $row->fetch_assoc();
            return $data;
        }
        return [];
    }

    public function update(string $sql): bool
    {
        return $this->conn->query($sql);
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function query(string $sql): array
    {
        $rows = $this->conn->query($sql);
        if ($rows && $rows->num_rows > 0) {
            return $rows->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
}
