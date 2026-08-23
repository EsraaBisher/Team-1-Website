<?php

include '../connect.php';
include '../header.php';

// Student ID from session
$student_id = $_SESSION['student_id'] ?? 1;


// Get enrolled courses

$query = "SELECT courses.*,
                 enrollments.id AS enrollment_id

          FROM courses

          JOIN enrollments
          ON courses.id = enrollments.course_id

          WHERE enrollments.student_id = '$student_id'";

$result = mysqli_query($conn, $query);

?>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // ================= NAVBAR =================

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


    // ================= FOOTER =================

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

    .courses-page {
        background: #f8f9fa;
        min-height: 75vh;
    }


    /* ================= HEADER ================= */

    .courses-header {
        background: linear-gradient(135deg, #262626, #414141);
        border-radius: 22px;
        padding: 35px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .courses-header::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border-radius: 50%;
        background: rgba(255, 149, 0, 0.15);
        right: -60px;
        top: -100px;
    }

    .courses-header h1,
    .courses-header p {
        position: relative;
        z-index: 2;
    }

    .courses-header h1 {
        font-weight: 700;
    }

    .courses-header p {
        color: #d5d5d5;
    }


    /* ================= COURSE CARD ================= */

    .course-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: white;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    .course-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.10);
    }


    .course-image {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }


    .course-body {
        padding: 22px;
    }


    .course-title {
        font-weight: 700;
        color: #262626;
    }


    .course-description {
        color: #777;
        line-height: 1.6;
        min-height: 50px;
    }


    /* ================= BUTTON ================= */

    .btn-orange {
        background-color: #FF9500;
        border: none;
        color: white;
    }

    .btn-orange:hover {
        background-color: #e88600;
        color: white;
    }


    /* ================= EMPTY ================= */

    .empty-courses {
        background: white;
        border-radius: 20px;
        padding: 60px 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #fff3df;
        color: #FF9500;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin: 0 auto 20px;
    }

</style>


<div class="courses-page py-5">

    <div class="container">


        <!-- ================= PAGE HEADER ================= -->

        <div class="courses-header mb-5">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                <div>

                    <h1 class="mb-2">
                        My Courses
                    </h1>

                    <p class="mb-0">
                        Continue your learning journey and manage your enrolled courses.
                    </p>

                </div>


                <a
                    href="../courses.php"
                    class="btn btn-warning fw-bold px-4"
                >

                    <i class="fa-solid fa-plus me-2"></i>

                    Explore Courses

                </a>

            </div>

        </div>


        <!-- ================= COURSES ================= -->

        <div class="row g-4">


            <?php if ($result && mysqli_num_rows($result) > 0): ?>


                <?php while ($course = mysqli_fetch_assoc($result)): ?>


                    <div class="col-md-6 col-lg-4">


                        <div class="course-card h-100 d-flex flex-column">


                            <!-- IMAGE -->

                            <img
                                src="../images/<?php echo htmlspecialchars($course['image'] ?? 'default.jpg'); ?>"
                                class="course-image"
                                alt="Course Image"
                            >


                            <!-- BODY -->

                            <div class="course-body d-flex flex-column flex-grow-1">


                                <h5 class="course-title mb-2">

                                    <?php
                                    echo htmlspecialchars(
                                        $course['title']
                                    );
                                    ?>

                                </h5>


                                <p class="course-description mb-3">

                                    <?php

                                    $description = $course['description'] ?? '';

                                    echo htmlspecialchars(
                                        substr($description, 0, 100)
                                    );

                                    if (strlen($description) > 100) {
                                        echo "...";
                                    }

                                    ?>

                                </p>


                                <!-- BUTTONS -->

                                <div class="mt-auto">


                                    <!-- Continue -->

                                    <a
                                        href="course_details.php?id=<?php echo $course['id']; ?>"
                                        class="btn btn-orange w-100 fw-bold mb-2"
                                    >

                                        <i class="fa-solid fa-play me-2"></i>

                                        Continue Learning

                                    </a>


                                    <!-- Edit / Delete -->

                                    <div class="d-flex gap-2">


                                        <a
                                            href="edit_course.php?id=<?php echo $course['id']; ?>"
                                            class="btn btn-outline-primary btn-sm w-50 fw-bold"
                                        >

                                            <i class="fa-solid fa-pen me-1"></i>

                                            Edit

                                        </a>


                                        <a
                                            href="delete_course.php?enrollment_id=<?php echo $course['enrollment_id']; ?>"
                                            class="btn btn-outline-danger btn-sm w-50 fw-bold"
                                            onclick="return confirm('Are you sure you want to remove this course?');"
                                        >

                                            <i class="fa-solid fa-trash me-1"></i>

                                            Delete

                                        </a>


                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>


                <?php endwhile; ?>


            <?php else: ?>


                <!-- ================= EMPTY STATE ================= -->

                <div class="col-12">

                    <div class="empty-courses text-center">


                        <div class="empty-icon">

                            <i class="fa-solid fa-book-open"></i>

                        </div>


                        <h4 class="fw-bold">
                            No Courses Yet
                        </h4>


                        <p class="text-muted mb-4">
                            You haven't enrolled in any courses yet.
                            Explore our courses and start learning today.
                        </p>


                        <a
                            href="../courses.php"
                            class="btn btn-orange px-4 fw-bold"
                        >

                            <i class="fa-solid fa-magnifying-glass me-2"></i>

                            Explore Courses

                        </a>


                    </div>

                </div>


            <?php endif; ?>


        </div>

    </div>

</div>


<script src="../bootstrap/assets/js/bootstrap.bundle.min.js"></script>


<?php

include '../footer.php';

?>