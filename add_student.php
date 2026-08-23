<?php
include "connect.php";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $student_number = $_POST['student_number'];
    $class = $_POST['class'];

    $sql1 = "INSERT INTO users (name, email, password, role)
             VALUES ('$name', '$email', '$password', 'student')";

    if ($conn->query($sql1)) {

        $user_id = $conn->insert_id;

        $sql2 = "INSERT INTO students (student_number, class, user_id)
                 VALUES ('$student_number', '$class', '$user_id')";

        if ($conn->query($sql2)) {
            header("Location: manage_students.php");
            exit();
        }
    }

    echo "Error: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Student</title>

    <link rel="stylesheet" href="./bootstrap/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap/assets/css/style.css">
</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Add Student</h1>

        <a href="manage_students.php" class="btn btn-dark">
            Back
        </a>
    </div>

    <div class="card border-0 shadow-sm p-4">

        <form method="POST">

            <div class="mb-3">
                <label class="form-label fw-bold">Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Enter student name"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter student email"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter password"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Student Number</label>
                <input type="number"
                       name="student_number"
                       class="form-control"
                       placeholder="Enter student number"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Class</label>
                <input type="text"
                       name="class"
                       class="form-control"
                       placeholder="Enter class"
                       required>
            </div>

            <button type="submit"
                    name="submit"
                    class="btn btn-dark w-100">
                Add Student
            </button>

        </form>

    </div>

</div>

</body>
</html>