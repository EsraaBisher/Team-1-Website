<?php

include "connect.php";

if (!isset($_GET['id'])) {
    header("Location: manage_courses.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM courses
        WHERE id = $id";

if ($conn->query($sql)) {

    header("Location: manage_courses.php");
    exit();

} else {

    echo "Error: " . $conn->error;
}

?>