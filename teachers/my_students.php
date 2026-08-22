<?php

session_start();

include "../connect.php";


// Temporary test user
// Later, the login person will replace this with:
// $user_id = $_SESSION['user_id'];

$user_id = 0;


// Get teacher ID

$teacher_sql = "SELECT id
                FROM teachers
                WHERE user_id = ?";

$teacher_stmt = $conn->prepare($teacher_sql);

$teacher_stmt->bind_param("i", $user_id);

$teacher_stmt->execute();

$teacher_result = $teacher_stmt->get_result();

$teacher = $teacher_result->fetch_assoc();


if (!$teacher) {

    die("Teacher not found.");

}


$teacher_id = $teacher['id'];


// Get students enrolled in teacher's courses

$sql = "SELECT DISTINCT
               students.id,
               students.student_number,
               students.class,
               users.name,
               users.email,
               users.image

        FROM enrollments

        INNER JOIN students
        ON enrollments.student_id = students.id

        INNER JOIN users
        ON students.user_id = users.id

        INNER JOIN courses
        ON enrollments.course_id = courses.id

        WHERE courses.teacher_id = ?

        ORDER BY users.name ASC";


$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $teacher_id);

$stmt->execute();

$result = $stmt->get_result();

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>My Students</title>


    <!-- Bootstrap CSS -->

    <link
        rel="stylesheet"
        href="../bootstrap/assets/css/bootstrap.min.css"
    >


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

</head>


<body class="bg-light">


<?php

include "../header.php";

?>


<!-- Fix Navbar + Footer Links -->

<script>

document.addEventListener("DOMContentLoaded", function () {


    /*
    =========================
    NAVBAR LINKS
    =========================
    */

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

    });



    /*
    =========================
    FOOTER LINKS
    =========================
    */

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

    });

});

</script>



<!-- MY STUDENTS -->

<div class="container py-5">


    <!-- PAGE TITLE -->

    <div class="d-flex justify-content-between align-items-center mb-4">


        <div>

            <h1 class="fw-bold mb-1">

                My Students

            </h1>


            <p class="text-muted mb-0">

                Students enrolled in your courses

            </p>

        </div>



        <a
            href="dashboard.php"
            class="btn btn-light"
        >

            <i class="bi bi-arrow-left me-2"></i>

            Dashboard

        </a>


    </div>



    <!-- STUDENTS COUNT -->

    <div class="card border-0 shadow-sm mb-4">


        <div class="card-body p-4">


            <div class="d-flex align-items-center gap-3">


                <div
                    class="rounded-circle d-flex justify-content-center align-items-center"
                    style="
                        width:55px;
                        height:55px;
                        background-color:#fff3cd;
                    "
                >

                    <i class="bi bi-people fs-4 text-warning"></i>

                </div>



                <div>

                    <p class="text-muted mb-1">

                        Total Students

                    </p>


                    <h3 class="fw-bold mb-0">

                        <?php

                        echo $result->num_rows;

                        ?>

                    </h3>

                </div>


            </div>


        </div>


    </div>



    <!-- STUDENTS -->

    <div class="row g-4">


        <?php if ($result->num_rows > 0): ?>


            <?php while ($student = $result->fetch_assoc()): ?>


                <div class="col-md-6 col-lg-4">


                    <div class="card border-0 shadow-sm h-100">


                        <!-- STUDENT IMAGE -->

                        <div class="text-center pt-4">


                            <?php if (!empty($student['image'])): ?>


                                <img
                                    src="../<?php echo htmlspecialchars($student['image']); ?>"
                                    alt="Student"
                                    width="100"
                                    height="100"
                                    class="rounded-circle"
                                    style="object-fit:cover;"
                                >


                            <?php else: ?>


                                <div
                                    class="rounded-circle bg-secondary-subtle d-flex justify-content-center align-items-center mx-auto"
                                    style="width:100px;height:100px;"
                                >

                                    <i class="bi bi-person fs-1 text-secondary"></i>

                                </div>


                            <?php endif; ?>


                        </div>



                        <!-- STUDENT INFORMATION -->

                        <div class="card-body p-4 text-center">


                            <h5 class="fw-bold mb-2">

                                <?php

                                echo htmlspecialchars($student['name']);

                                ?>

                            </h5>



                            <p class="text-muted mb-2">


                                <i class="bi bi-envelope me-2"></i>


                                <?php

                                echo htmlspecialchars($student['email']);

                                ?>


                            </p>



                            <p class="mb-2">


                                <strong>

                                    Student Number:

                                </strong>


                                <?php

                                echo htmlspecialchars(
                                    $student['student_number']
                                );

                                ?>


                            </p>



                            <p class="mb-0">


                                <strong>

                                    Class:

                                </strong>


                                <?php

                                echo htmlspecialchars(
                                    $student['class']
                                );

                                ?>


                            </p>


                        </div>


                    </div>


                </div>


            <?php endwhile; ?>


        <?php else: ?>


            <!-- NO STUDENTS -->


            <div class="col-12">


                <div class="card border-0 shadow-sm">


                    <div class="card-body text-center p-5">


                        <i class="bi bi-people fs-1 text-muted"></i>


                        <h4 class="fw-bold mt-3">

                            No Students Yet

                        </h4>


                        <p class="text-muted mb-0">

                            No students are currently enrolled
                            in your courses.

                        </p>


                    </div>


                </div>


            </div>


        <?php endif; ?>


    </div>


</div>



<!-- Bootstrap JS -->

<script src="../bootstrap/assets/js/bootstrap.bundle.min.js"></script>


<?php

include "../footer.php";

?>


</body>

</html>