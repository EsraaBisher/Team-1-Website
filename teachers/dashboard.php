<?php


include "../connect.php";


// $user_id = $_SESSION['user_id'] ?? null;

// if (!$user_id) {
//     header("Location: ../login.php");
//     exit;
// }


$user_id = 1;




// Get teacher data

$sql = "SELECT teachers.id,
               teachers.phone,
               teachers.subject,
               users.name,
               users.email,
               users.image
        FROM teachers
        INNER JOIN users
        ON teachers.user_id = users.id
        WHERE teachers.user_id = ?";


$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $user_id);

$stmt->execute();


$result = $stmt->get_result();

$teacher = $result->fetch_assoc();


if (!$teacher) {

    die("Teacher not found.");

}


// Get teacher courses

$course_sql = "SELECT id,name, hours,image   FROM courses WHERE teacher_id = ?";
               
                      
                

$course_stmt = $conn->prepare($course_sql);

$course_stmt->bind_param("i", $teacher['id']);

$course_stmt->execute();


$courses_result = $course_stmt->get_result();

?>



<?php

include "../header.php";

?>



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



<!-- Fix Navbar + Footer Links -->

<script>

document.addEventListener("DOMContentLoaded", function () {


    // NAVBAR LINKS

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



    // FOOTER LINKS

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



<!-- DASHBOARD -->

<div class="container py-5">


    <!-- WELCOME -->

    <div class="mb-5">

        <h1 class="fw-bold">

            Welcome,

            <?php

            echo htmlspecialchars($teacher['name']);

            ?>

            👋

        </h1>


        <p class="text-muted mb-0">

            Teacher Dashboard

        </p>

    </div>



    <!-- STATISTICS -->

    <div class="row g-4 mb-5">


        <!-- COURSES -->

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">


                        <div>

                            <p class="text-muted mb-2">

                                My Courses

                            </p>


                            <h2 class="fw-bold mb-0">

                                <?php

                                echo $courses_result->num_rows;

                                ?>

                            </h2>

                        </div>


                        <i class="bi bi-book fs-1 text-warning"></i>


                    </div>

                </div>

            </div>

        </div>



        <!-- STUDENTS -->

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">


                        <div>

                            <p class="text-muted mb-2">

                                My Students

                            </p>


                            <h2 class="fw-bold mb-0">

                                0

                            </h2>

                        </div>


                        <i class="bi bi-people fs-1 text-warning"></i>


                    </div>

                </div>

            </div>

        </div>



        <!-- SUBJECT -->

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">


                        <div>

                            <p class="text-muted mb-2">

                                Subject

                            </p>


                            <h5 class="fw-bold mb-0">

                                <?php

                                echo htmlspecialchars($teacher['subject']);

                                ?>

                            </h5>

                        </div>


                        <i class="bi bi-mortarboard fs-1 text-warning"></i>


                    </div>

                </div>

            </div>

        </div>


    </div>



    <!-- TEACHER INFORMATION -->

    <h3 class="fw-bold mb-3">

        Teacher Information

    </h3>



    <div class="card border-0 shadow-sm mb-5">

        <div class="card-body p-4">

            <div class="row align-items-center">


                <!-- IMAGE -->

                <div class="col-md-3 text-center mb-4 mb-md-0">


                    <?php if (!empty($teacher['image'])): ?>


                        <img
                            src="../upload/<?php echo htmlspecialchars($teacher['image']); ?>"
                            alt="Teacher"
                            width="120"
                            height="120"
                            class="rounded-circle"
                            style="object-fit:cover;"
                        >


                    <?php else: ?>


                        <div
                            class="rounded-circle bg-secondary-subtle d-flex justify-content-center align-items-center mx-auto"
                            style="width:120px;height:120px;"
                        >

                            <i class="bi bi-person fs-1 text-secondary"></i>

                        </div>


                    <?php endif; ?>


                </div>



                <!-- INFORMATION -->

                <div class="col-md-6">


                    <h3 class="fw-bold">

                        <?php

                        echo htmlspecialchars($teacher['name']);

                        ?>

                    </h3>


                    <p class="text-muted mb-2">

                        <i class="bi bi-mortarboard me-2"></i>

                        <?php

                        echo htmlspecialchars($teacher['subject']);

                        ?>

                    </p>


                    <p class="mb-2">

                        <i class="bi bi-envelope me-2"></i>

                        <?php

                        echo htmlspecialchars($teacher['email']);

                        ?>

                    </p>


                    <p class="mb-0">

                        <i class="bi bi-telephone me-2"></i>

                        <?php

                        echo htmlspecialchars($teacher['phone']);

                        ?>

                    </p>


                </div>



                <!-- PROFILE BUTTON -->

                <div class="col-md-3 text-md-end mt-4 mt-md-0">


                    <a
                        href="profile.php"
                        class="btn text-white px-4"
                        style="background-color:#FF9500;"
                    >

                        View Profile

                    </a>


                </div>


            </div>

        </div>

    </div>



    <!-- COURSES -->

    <div class="row g-4">


        <?php if ($courses_result->num_rows > 0): ?>


            <?php while ($course = $courses_result->fetch_assoc()): ?>


                <div class="col-md-6 col-lg-4">


                    <div class="card border-0 shadow-sm h-100">


                        <!-- COURSE IMAGE -->

                        <?php if (!empty($course['image'])): ?>


                            <img
                                src="../<?php echo htmlspecialchars($course['image']); ?>"
                                class="card-img-top"
                                alt="Course"
                                style="height:180px;object-fit:cover;"
                            >


                        <?php else: ?>


                            <div
                                class="bg-secondary-subtle d-flex justify-content-center align-items-center"
                                style="height:180px;"
                            >

                                <i class="bi bi-book fs-1 text-secondary"></i>

                            </div>


                        <?php endif; ?>



                        <!-- COURSE BODY -->

                        <div class="card-body p-4">


                            <h5 class="card-title fw-bold">

                                <?php

                                echo htmlspecialchars($course['name']);

                                ?>

                            </h5>


                            <p class="text-muted">

                                <i class="bi bi-clock me-2"></i>

                                <?php

                                echo htmlspecialchars($course['hours']);

                                ?>

                                Hours

                            </p>


                            <a
                                href="../courses/course_details.php?id=<?php echo $course['id']; ?>"
                                class="btn text-white w-100"
                                style="background-color:#FF9500;"
                            >

                                View Course

                            </a>


                        </div>


                    </div>


                </div>


            <?php endwhile; ?>


        <?php else: ?>


            <!-- NO COURSES -->

            <div class="col-12">


                <div class="card border-0 shadow-sm">


                    <div class="card-body text-center p-5">


                        <i class="bi bi-book fs-1 text-muted"></i>


                        <h5 class="fw-bold mt-3">

                            No Courses Yet

                        </h5>


                        <p class="text-muted mb-0">

                            You don't have any courses assigned yet.

                        </p>


                    </div>


                </div>


            </div>


        <?php endif; ?>


    </div>


</div>



<?php

include "../footer.php";

?>
