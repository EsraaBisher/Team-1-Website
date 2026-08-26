<?php
include "connect.php"; 
//بتنفذ SQL Query على الداتابيز.
$students = $conn->query("SELECT COUNT(*) AS total FROM students")->fetch_assoc()['total'];
$teachers = $conn->query("SELECT COUNT(*) AS total FROM teachers")->fetch_assoc()['total'];
$courses = $conn->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
$enrollments = $conn->query("SELECT COUNT(*) AS total FROM enrollments")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="./bootstrap/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-5">
        <div> 
            <h1 class="fw-bold">Admin Dashboard</h1>
            <p class="text-muted">Manage the course system</p>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm p-4 text-center">
                <i class="bi bi-people fs-1 mb-3"></i>
                <h5>Students</h5>
                <h2 class="fw-bold"><?php echo $students; ?></h2>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm p-4 text-center">
                <i class="bi bi-person-workspace fs-1 mb-3"></i>
                <h5>Teachers</h5>
                <h2 class="fw-bold"><?php echo $teachers; ?></h2>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm p-4 text-center">
                <i class="bi bi-book fs-1 mb-3"></i>
                <h5>Courses</h5>
                <h2 class="fw-bold"><?php echo $courses; ?></h2>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm p-4 text-center">
                <i class="bi bi-journal-check fs-1 mb-3"></i>
                <h5>Enrollments</h5>
                <h2 class="fw-bold"><?php echo $enrollments; ?></h2>
            </div>
        </div>

    </div>

    <div class="row g-4 mt-4">

        <div class="col-md-4">
            <a href="manage_students.php" class="btn btn-dark w-100 py-3">
                Manage Students
            </a>
        </div>

        <div class="col-md-4">
            <a href="manage_teachers.php" class="btn btn-dark w-100 py-3">
                Manage Teachers
            </a>
        </div>

        <div class="col-md-4">
            <a href="manage_courses.php" class="btn btn-dark w-100 py-3">
                Manage Courses
            </a>
        </div>

    </div>

</div>

</body>
</html>