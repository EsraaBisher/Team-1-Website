<?php 
include "header.php";
include "connect.php";

// Get statistics from database
$studentsCount = 0;
$teachersCount = 0;
$coursesCount = 0;
$enrollmentsCount = 0;

$result = $conn->query("SELECT COUNT(*) AS total FROM students");
if ($result) {
    $studentsCount = $result->fetch_assoc()['total'];
}

$result = $conn->query("SELECT COUNT(*) AS total FROM teachers");
if ($result) {
    $teachersCount = $result->fetch_assoc()['total'];
}

$result = $conn->query("SELECT COUNT(*) AS total FROM courses");
if ($result) {
    $coursesCount = $result->fetch_assoc()['total'];
}

$result = $conn->query("SELECT COUNT(*) AS total FROM enrollments");
if ($result) {
    $enrollmentsCount = $result->fetch_assoc()['total'];
}
?>

<!-- Hero Section -->
<section 
    class="d-flex align-items-center" 
    style="
        min-height: 650px;

        background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
        url('./bootstrap/assets/image/herosection.png');

        background-size: cover;
        background-position: center;
    ">

    <div class="container">

        <div class="col-lg-7">

            <h1 class="display-4 fw-bold text-white 1h-sm">
                Learn, Grow, and Achieve Your Goals
            </h1>

            <p class="lead my-4 fw-medium text-white-50">
                Discover the best courses and develop your skills 
                with our online learning platform.
            </p>

            <a href="courses.php" 
               class="btn fw-medium btn-lg text-white" 
               style="background-color: #FF9500;">
                Our Courses
            </a>

        </div>

    </div>

</section>


<!-- Platform Statistics Section -->
<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-4">

            <h2 class="fw-bold">
                Our Platform
            </h2>

            <p class="text-muted">
                Join our growing learning community.
            </p>

        </div>


        <div class="row g-4">

            <!-- Students -->
            <div class="col-6 col-lg-3">

                <div class="bg-white rounded-3 shadow-sm text-center p-4 h-100">

                    <div class="mb-3">
                        <i class="bi bi-people fs-1" style="color: #FF9500;"></i>
                    </div>

                    <h2 class="fw-bold mb-1">
                        <?= $studentsCount ?>+
                    </h2>

                    <p class="text-muted mb-0">
                        Students
                    </p>

                </div>

            </div>


            <!-- Teachers -->
            <div class="col-6 col-lg-3">

                <div class="bg-white rounded-3 shadow-sm text-center p-4 h-100">

                    <div class="mb-3">
                        <i class="bi bi-person-workspace fs-1" style="color: #FF9500;"></i>
                    </div>

                    <h2 class="fw-bold mb-1">
                        <?= $teachersCount ?>+
                    </h2>

                    <p class="text-muted mb-0">
                        Teachers
                    </p>

                </div>

            </div>


            <!-- Courses -->
            <div class="col-6 col-lg-3">

                <div class="bg-white rounded-3 shadow-sm text-center p-4 h-100">

                    <div class="mb-3">
                        <i class="bi bi-book fs-1" style="color: #FF9500;"></i>
                    </div>

                    <h2 class="fw-bold mb-1">
                        <?= $coursesCount ?>+
                    </h2>

                    <p class="text-muted mb-0">
                        Courses
                    </p>

                </div>

            </div>


            <!-- Enrollments -->
            <div class="col-6 col-lg-3">

                <div class="bg-white rounded-3 shadow-sm text-center p-4 h-100">

                    <div class="mb-3">
                        <i class="bi bi-mortarboard fs-1" style="color: #FF9500;"></i>
                    </div>

                    <h2 class="fw-bold mb-1">
                        <?= $enrollmentsCount ?>+
                    </h2>

                    <p class="text-muted mb-0">
                        Enrollments
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- How It Works Section -->
<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                How It Works
            </h2>

            <p class="text-muted">
                Start your learning journey in four simple steps.
            </p>

        </div>


        <div class="row g-4">

            <!-- Step 1 -->
            <div class="col-md-6 col-lg-3">

                <div class="bg-white rounded-3 shadow-sm text-center p-4 h-100">

                    <div class="mb-3">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle text-white fw-bold"
                              style="width: 55px; height: 55px; background-color: #FF9500;">
                            1
                        </span>
                    </div>

                    <h5 class="fw-bold">
                        Create Your Account
                    </h5>

                    <p class="text-muted small mb-0">
                        Register and create your account
                        to start your learning journey.
                    </p>

                </div>

            </div>


            <!-- Step 2 -->
            <div class="col-md-6 col-lg-3">

                <div class="bg-white rounded-3 shadow-sm text-center p-4 h-100">

                    <div class="mb-3">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle text-white fw-bold"
                              style="width: 55px; height: 55px; background-color: #FF9500;">
                            2
                        </span>
                    </div>

                    <h5 class="fw-bold">
                        Explore Courses
                    </h5>

                    <p class="text-muted small mb-0">
                        Browse our courses and choose
                        the skills you want to learn.
                    </p>

                </div>

            </div>


            <!-- Step 3 -->
            <div class="col-md-6 col-lg-3">

                <div class="bg-white rounded-3 shadow-sm text-center p-4 h-100">

                    <div class="mb-3">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle text-white fw-bold"
                              style="width: 55px; height: 55px; background-color: #FF9500;">
                            3
                        </span>
                    </div>

                    <h5 class="fw-bold">
                        Start Learning
                    </h5>

                    <p class="text-muted small mb-0">
                        Enroll in your favorite courses
                        and start learning.
                    </p>

                </div>

            </div>


            <!-- Step 4 -->
            <div class="col-md-6 col-lg-3">

                <div class="bg-white rounded-3 shadow-sm text-center p-4 h-100">

                    <div class="mb-3">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle text-white fw-bold"
                              style="width: 55px; height: 55px; background-color: #FF9500;">
                            4
                        </span>
                    </div>

                    <h5 class="fw-bold">
                        Achieve Your Goals
                    </h5>

                    <p class="text-muted small mb-0">
                        Improve your skills and achieve
                        your learning and career goals.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Courses Section -->
<section class="py-5">

    <div class="container">

        <!-- Section Header -->
        <div class="d-flex justify-content-between align-items-end mb-4">

            <div>

                <h2 class="fw-bold mb-2">
                    Our Courses
                </h2>

                <p class="text-muted mb-0">
                    Explore our courses and start learning new skills today.
                </p>

            </div>

            <a href="courses.php" class="btn btn-light">
                View All
            </a>

        </div>


        <!-- Courses -->
        <div class="row g-4">


            <!-- Course 1 -->
            <div class="col-md-6">

                <div class="card h-100 border-0 shadow-sm p-3">

                    <img src="./bootstrap/assets/image/Image 1.png"
                         class="card-img-top rounded"
                         alt="Web Design">

                    <div class="card-body px-0 pb-0">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="d-flex gap-2">

                                <span class="badge text-bg-light">
                                    Beginner
                                </span>

                            </div>

                        </div>


                        <h5 class="fw-bold">
                            Web Design Fundamentals
                        </h5>

                        <p class="text-muted small fw-medium">
                            Learn the fundamentals of web design, including HTML,
                            CSS, and responsive design principles.
                        </p>

                    </div>

                </div>

            </div>


            <!-- Course 2 -->
            <div class="col-md-6">

                <div class="card h-100 border-0 shadow-sm p-3">

                    <img src="./bootstrap/assets/image/Image 2.png"
                         class="card-img-top rounded"
                         alt="UI UX Design">

                    <div class="card-body px-0 pb-0">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div class="d-flex gap-2">

                                <span class="badge text-bg-light">
                                    Intermediate
                                </span>

                            </div>

                        </div>


                        <h5 class="fw-bold">
                            UI/UX Design
                        </h5>

                        <p class="text-muted small fw-medium">
                            Master the art of creating intuitive user interfaces
                            and enhancing user experiences.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Call To Action Section -->
<section class="py-5">

    <div class="container">

        <div class="rounded-4 p-5 text-center text-white"
             style="background-color: #262626;">

            <h2 class="fw-bold mb-3">
                Ready to Start Learning?
            </h2>

            <p class="mb-4 text-white-50">
                Join our learning community and start developing
                your skills today.
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap">

                <a href="courses.php"
                   class="btn btn-warning text-white px-4 py-2">
                    Explore Courses
                </a>

                <a href="register.php"
                   class="btn btn-outline-light px-4 py-2">
                    Create Account
                </a>

            </div>

        </div>

    </div>

</section>


<?php 
include "footer.php"; 
?>