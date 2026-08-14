<?php
include "header.php" ;
?>

<!-- Hero Section -->
    <section
        class="d-flex align-items-center"
        style="
            min-height: 650px;

            /* background-image: url('./bootstrap/assets/image/herosection.png'); */

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

                <a href="courses.php" class="btn fw-medium btn-lg text-white" style="background-color: #FF9500;">
                    Our Courses
                </a>

            </div>

        </div>

    </section>

<!-- Courses Section -->
    <section class="py-5">

        <div class="container">

            <!-- Section Header -->
            <div class="d-flex justify-content-between align-items-end mb-4">

                <div>
                    <h2 class="fw-bold mb-2">Our Courses</h2>

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

                            <!-- Course Info -->
                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex gap-2">
                                    <span class="badge text-bg-light">
                                        4 Weeks
                                    </span>

                                    <span class="badge text-bg-light">
                                        Beginner
                                    </span>
                                </div>

                                <small class="text-muted">
                                    By John Smith
                                </small>

                            </div>


                            <h5 class="fw-bold">
                                Web Design Fundamentals
                            </h5>

                            <p class="text-muted small fw-medium ">
                                Learn the fundamentals of web design, including HTML,
                                CSS, and responsive design principles.
                            </p>


                            <a href="course-details.php"
                            class="btn btn-light w-100 fw-medium ">
                                Get it Now
                            </a>

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
                                        6 Weeks
                                    </span>

                                    <span class="badge text-bg-light">
                                        Intermediate
                                    </span>
                                </div>

                                <small class="text-muted">
                                    By Emily Johnson
                                </small>

                            </div>


                            <h5 class="fw-bold">
                                UI/UX Design
                            </h5>

                            <p class="text-muted small fw-medium ">
                                Master the art of creating intuitive user interfaces
                                and enhancing user experiences.
                            </p>


                            <a href="course-details.php"
                            class="btn btn-light w-100 fw-medium">
                                Get it Now
                            </a>

                        </div>
                    </div>

                </div>


                <!-- Course 3 -->
                <div class="col-md-6">

                    <div class="card h-100 border-0 shadow-sm p-3">

                        <img src="bootstrap/assets/image/Image 3.png"
                            class="card-img-top rounded"
                            alt="Mobile App Development">

                        <div class="card-body px-0 pb-0">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex gap-2">
                                    <span class="badge text-bg-light">
                                        8 Weeks
                                    </span>

                                    <span class="badge text-bg-light">
                                        Intermediate
                                    </span>
                                </div>

                                <small class="text-muted">
                                    By David Brown
                                </small>

                            </div>


                            <h5 class="fw-bold">
                                Mobile App Development
                            </h5>

                            <p class="text-muted small fw-medium ">
                                Learn to build modern mobile applications using
                                industry-leading technologies.
                            </p>


                            <a href="course-details.php"
                            class="btn btn-light w-100 fw-medium ">
                                Get it Now
                            </a>

                        </div>
                    </div>

                </div>


                <!-- Course 4 -->
                <div class="col-md-6">

                    <div class="card h-100 border-0 shadow-sm p-3">

                        <img src="bootstrap/assets/image/Image 4.png"
                            class="card-img-top rounded"
                            alt="Graphic Design">

                        <div class="card-body px-0 pb-0">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex gap-2">
                                    <span class="badge text-bg-light">
                                        10 Weeks
                                    </span>

                                    <span class="badge text-bg-light">
                                        Beginner
                                    </span>
                                </div>

                                <small class="text-muted">
                                    By Sarah Thompson
                                </small>

                            </div>


                            <h5 class="fw-bold">
                                Graphic Design for Beginners
                            </h5>

                            <p class="text-muted small fw-medium ">
                                Discover the fundamentals of graphic design,
                                including typography, color theory and layout design.
                            </p>


                            <a href="course-details.php"
                            class="btn btn-light w-100 fw-medium ">
                                Get it Now
                            </a>

                        </div>
                    </div>

                </div>

                <!-- course5 -->
                <div class="col-md-6">

                    <div class="card h-100 border-0 shadow-sm p-3">

                        <img src="bootstrap/assets/image/Image 5.png"
                            class="card-img-top rounded"
                            alt="Graphic Design">

                        <div class="card-body px-0 pb-0">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex gap-2">
                                    <span class="badge text-bg-light">
                                        10 Weeks
                                    </span>

                                    <span class="badge text-bg-light">
                                        Intermediate
                                    </span>
                                </div>

                                <small class="text-muted">
                                    By Michael Adams
                                </small>

                            </div>


                            <h5 class="fw-bold">
                                Front-End Web Development
                            </h5>

                            <p class="text-muted small fw-medium ">
                                Become proficient in front-end web development. Learn HTML, CSS, JavaScript,
                                and popular frameworks like Bootstrap and React. Build interactive and responsive websites.
                            </p>


                            <a href="course-details.php"
                            class="btn btn-light w-100 fw-medium ">
                                Get it Now
                            </a>

                        </div>
                    </div>

                </div>


                <!-- course6 -->
                <div class="col-md-6">

                    <div class="card h-100 border-0 shadow-sm p-3">

                        <img src="bootstrap/assets/image/herosection.png"
                            class="card-img-top rounded"
                            alt="Graphic Design">

                        <div class="card-body px-0 pb-0">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex gap-2">
                                    <span class="badge text-bg-light">
                                        6 Weeks
                                    </span>

                                    <span class="badge text-bg-light">
                                        Advance
                                    </span>
                                </div>

                                <small class="text-muted">
                                    By Jennifer Wilson
                                </small>

                            </div>


                            <h5 class="fw-bold">
                                Graphic Design for Beginners
                            </h5>

                            <p class="text-muted small fw-medium">
                                Discover the fundamentals of graphic design,
                                including typography, color theory and layout design.
                            </p>


                            <a href="course-details.php"
                            class="btn btn-light w-100 fw-medium">
                                Get it Now
                            </a>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>


<?php
include "footer.php" ;
?>