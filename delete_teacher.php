<?php

include "connect.php";

if (!isset($_GET['id'])) {
    header("Location: manage_teachers.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT user_id
        FROM teachers
        WHERE id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $teacher = $result->fetch_assoc();

    $user_id = $teacher['user_id'];

    $conn->query("DELETE FROM teachers WHERE id = $id");

    $conn->query("DELETE FROM users WHERE id = $user_id");
}

header("Location: manage_teachers.php");
exit();

?>