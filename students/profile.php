<?php

include '../connect.php';
include '../header.php';

$student_id = $_SESSION['student_id'] ?? 1;


// Get student data

$user_query = "SELECT * FROM students WHERE id = '$student_id'";

$user_result = mysqli_query($conn, $user_query);

$user = mysqli_fetch_assoc($user_result);


// Get enrolled courses count

$count_query = "SELECT COUNT(*) as total
                FROM enrollments
                WHERE student_id = '$student_id'";

$count_result = mysqli_query($conn, $count_query);

$total_courses = mysqli_fetch_assoc($count_result)['total'];

?>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // Fix Navbar Links

    const navLinks = document.querySelectorAll("nav a");

    navLinks.forEach(function (link) {

        const href = link.getAttribute("href");

        if (href === "index.php") {
            link.href = "../index.php";
        }

        else if (href === "about.php") {
            link.href = "../about.php";
        }

        else if (href === "courses.php") {
            link.href = "../courses.php";
        }

        else if (href === "pricing.php") {
            link.href = "../pricing.php";
        }

        else if (href === "login.php") {
            link.href = "../login.php";
        }

        else if (href === "register.php") {
            link.href = "../register.php";
        }

        else if (href === "logout.php") {
            link.href = "../logout.php";
        }

    });


    // Fix Footer Links

    const footerLinks = document.querySelectorAll("footer a");

    footerLinks.forEach(function (link) {

        const href = link.getAttribute("href");

        if (href === "index.php") {
            link.href = "../index.php";
        }

        else if (href === "about.php") {
            link.href = "../about.php";
        }

        else if (href === "courses.php") {
            link.href = "../courses.php";
        }

        else if (href === "pricing.php") {
            link.href = "../pricing.php";
        }

        else if (href === "login.php") {
            link.href = "../login.php";
        }

        else if (href === "register.php") {
            link.href = "../register.php";
        }

        else if (href === "logout.php") {
            link.href = "../logout.php";
        }

    });

});

</script>


<style>

    .profile-page {
        background: #f8f9fa;
        min-height: 75vh;
    }

    .profile-card {
        background: white;
        border: none;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
    }

    .profile-cover {
        height: 150px;
        background: linear-gradient(135deg, #262626, #414141);
        position: relative;
    }

    .profile-cover::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 149, 0, 0.15);
        right: -50px;
        top: -100px;
    }

    .profile-avatar {
        width: 115px;
        height: 115px;
        border-radius: 50%;
        background: #fff3df;
        color: #FF9500;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 45px;
        border: 6px solid white;
        position: absolute;
        bottom: -55px;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
    }

    .profile-content {
        padding: 75px 35px 35px;
    }

    .profile-name {
        font-weight: 700;
        color: #262626;
    }

    .profile-email {
        color: #777;
    }

    .info-box {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        height: 100%;
    }

    .info-box i {
        color: #FF9500;
        font-size: 22px;
    }

    .info-label {
        font-size: 13px;
        color: #888;
        margin-bottom: 5px;
    }

    .info-value {
        font-weight: 600;
        color: #262626;
    }

    .stat-box {
        background: #fff8ed;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
    }

    .stat-number {
        color: #FF9500;
        font-size: 28px;
        font-weight: 700;
    }

    .btn-orange {
        background-color: #FF9500;
        color: white;
        border: none;
    }

    .btn-orange:hover {
        background-color: #e88600;
        color: white;
    }

</style>


<div class="profile-page py-5">

    <div class="container">

        <!-- Page Title -->

        <div class="mb-4">

            <h2 class="fw-bold">
                My Profile
            </h2>

            <p class="text-muted">
                Manage and view your student account information.
            </p>

        </div>


        <div class="profile-card">

            <!-- Cover -->

            <div class="profile-cover">

                <div class="profile-avatar">

                    <i class="fa-solid fa-user"></i>

                </div>

            </div>


            <!-- Profile Content -->

            <div class="profile-content">


                <!-- Student Name -->

                <div class="text-center mb-4">

                    <h3 class="profile-name mb-1">

                        <?php
                        echo htmlspecialchars(
                            $user['name'] ?? 'Student Name'
                        );
                        ?>

                    </h3>

                    <p class="profile-email mb-0">

                        <?php
                        echo htmlspecialchars(
                            $user['email'] ?? 'student@example.com'
                        );
                        ?>

                    </p>

                </div>


                <!-- Information -->

                <div class="row g-3 mb-4">


                    <!-- Email -->

                    <div class="col-md-6">

                        <div class="info-box">

                            <div class="d-flex align-items-center gap-3">

                                <i class="fa-solid fa-envelope"></i>

                                <div>

                                    <div class="info-label">
                                        Email
                                    </div>

                                    <div class="info-value">

                                        <?php
                                        echo htmlspecialchars(
                                            $user['email'] ?? 'student@example.com'
                                        );
                                        ?>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Phone -->

                    <div class="col-md-6">

                        <div class="info-box">

                            <div class="d-flex align-items-center gap-3">

                                <i class="fa-solid fa-phone"></i>

                                <div>

                                    <div class="info-label">
                                        Phone
                                    </div>

                                    <div class="info-value">

                                        <?php
                                        echo htmlspecialchars(
                                            $user['phone'] ?? 'Not available'
                                        );
                                        ?>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Role -->

                    <div class="col-md-6">

                        <div class="info-box">

                            <div class="d-flex align-items-center gap-3">

                                <i class="fa-solid fa-user-graduate"></i>

                                <div>

                                    <div class="info-label">
                                        Account Role
                                    </div>

                                    <div class="info-value">
                                        Student
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Student ID -->

                    <div class="col-md-6">

                        <div class="info-box">

                            <div class="d-flex align-items-center gap-3">

                                <i class="fa-solid fa-id-card"></i>

                                <div>

                                    <div class="info-label">
                                        Student ID
                                    </div>

                                    <div class="info-value">

                                        <?php
                                        echo htmlspecialchars(
                                            $user['id'] ?? $student_id
                                        );
                                        ?>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Statistics -->

                <div class="row g-3 mb-4">

                    <div class="col-md-6">

                        <div class="stat-box">

                            <div class="stat-number">

                                <?php
                                echo $total_courses;
                                ?>

                            </div>

                            <div class="text-muted">
                                Enrolled Courses
                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="stat-box">

                            <div class="stat-number">
                                Student
                            </div>

                            <div class="text-muted">
                                Account Type
                            </div>

                        </div>

                    </div>

                </div>


                <!-- Buttons -->

                <div class="d-flex justify-content-center gap-2 flex-wrap">

                    <a
                        href="mycourses.php"
                        class="btn btn-orange px-4 fw-bold"
                    >

                        <i class="fa-solid fa-book me-2"></i>

                        My Courses

                    </a>


                    <a
                        href="edit_profile.php"
                        class="btn btn-primary px-4 fw-bold"
                    >

                        <i class="fa-solid fa-pen-to-square me-2"></i>

                        Edit Profile

                    </a>


                    <a
                        href="delete_profile.php"
                        class="btn btn-danger px-4 fw-bold"
                        onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');"
                    >

                        <i class="fa-solid fa-trash me-2"></i>

                        Delete Account

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<script src="../bootstrap/assets/js/bootstrap.bundle.min.js"></script>


<?php
include '../footer.php';
?>