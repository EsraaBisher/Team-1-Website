<?php

include "connect.php";

if (!isset($_GET['id'])) {
    header("Location: manage_students.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT user_id FROM students WHERE id='$id'";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    header("Location: manage_students.php");
    exit();
}

$student = $result->fetch_assoc();

$user_id = $student['user_id'];

$sql1 = "DELETE FROM students WHERE id='$id'";

if ($conn->query($sql1)) {

    $sql2 = "DELETE FROM users WHERE id='$user_id'";

    if ($conn->query($sql2)) {

        header("Location: manage_students.php");
        exit();

    } else {

        echo "Error deleting user: " . $conn->error;
    }

} else {

    echo "Error deleting student: " . $conn->error;
}

?>