<?php
include "connect.php";

$students = $conn->query("SELECT COUNT(*) AS total FROM students")->fetch_assoc()['total'];
$teachers = $conn->query("SELECT COUNT(*) AS total FROM teachers")->fetch_assoc()['total'];
$courses = $conn->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
$enrollments = $conn->query("SELECT COUNT(*) AS total FROM enrollments")->fetch_assoc()['total'];

include "header.php";
?>

<div class="container py-5">

    <!-- Dashboard Header -->
    <div class="mb-5">
        <h1 class="fw-bold mb-2">
            Admin Dashboard
        </h1>

        <p class="text-muted mb-0">
            Welcome back, Admin. Manage your course system from here.
        </p>
    </div>


    <!-- Statistics -->
    <div class="row g-4 mb-5">

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Total Students</p>
                            <h2 class="fw-bold mb-0">
                                <?= $students ?>
                            </h2>
                        </div>

                        <i class="bi bi-people fs-2 text-warning"></i>
                    </div>

                    <small class="text-muted">
                        Registered students
                    </small>

                </div>
            </div>
        </div>


        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Total Teachers</p>
                            <h2 class="fw-bold mb-0">
                                <?= $teachers ?>
                            </h2>
                        </div>

                        <i class="bi bi-person-workspace fs-2 text-warning"></i>
                    </div>

                    <small class="text-muted">
                        Registered teachers
                    </small>

                </div>
            </div>
        </div>


        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Total Courses</p>
                            <h2 class="fw-bold mb-0">
                                <?= $courses ?>
                            </h2>
                        </div>

                        <i class="bi bi-book fs-2 text-warning"></i>
                    </div>

                    <small class="text-muted">
                        Available courses
                    </small>

                </div>
            </div>
        </div>


        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Total Enrollments</p>
                            <h2 class="fw-bold mb-0">
                                <?= $enrollments ?>
                            </h2>
                        </div>

                        <i class="bi bi-journal-check fs-2 text-warning"></i>
                    </div>

                    <small class="text-muted">
                        Course enrollments
                    </small>

                </div>
            </div>
        </div>

    </div>


    <!-- Quick Management -->
    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            Quick Management
        </h3>

        <p class="text-muted">
            Manage the main sections of the course system.
        </p>

    </div>


    <div class="row g-4">

        <!-- Students -->
        <div class="col-12 col-md-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <i class="bi bi-people fs-1 text-warning"></i>

                    <h5 class="fw-bold mt-3">
                        Manage Students
                    </h5>

                    <p class="text-muted">
                        View, add, edit and delete students.
                    </p>

                    <a href="manage_students.php"
                       class="btn admin-primary-btn w-100">

                        Manage Students
                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>

        </div>


        <!-- Teachers -->
        <div class="col-12 col-md-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <i class="bi bi-person-workspace fs-1 text-warning"></i>

                    <h5 class="fw-bold mt-3">
                        Manage Teachers
                    </h5>

                    <p class="text-muted">
                        View, add, edit and delete teachers.
                    </p>

                    <a href="manage_teachers.php"
                       class="btn admin-primary-btn w-100">

                        Manage Teachers
                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>

        </div>


        <!-- Courses -->
        <div class="col-12 col-md-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <i class="bi bi-book fs-1 text-warning"></i>

                    <h5 class="fw-bold mt-3">
                        Manage Courses
                    </h5>

                    <p class="text-muted">
                        View, add, edit and delete courses.
                    </p>

                    <a href="manage_courses.php"
                       class="btn admin-primary-btn w-100">

                        Manage Courses
                        <i class="bi bi-arrow-right ms-1"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include "footer.php";
?>