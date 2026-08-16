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
                                        Beginner
                                    </span>
                                </div>

                            </div>


                            <h5 class="fw-bold">
                                Web Design Fundamentals
                            </h5>

                            <p class="text-muted small fw-medium ">
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

                            <p class="text-muted small fw-medium ">
                                Master the art of creating intuitive user interfaces
                                and enhancing user experiences.
                            </p>


                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Pricing Section -->
    <section class="py-5 bg-light">

        <div class="container">

            <!-- Heading -->
            <div class="d-flex justify-content-between align-items-end mb-4">

                <div>
                    <h2 class="fw-bold mb-2">Our Pricing</h2>

                    <p class="text-secondary mb-0">
                         Choose the right plan for your learning journey and get access to
                        courses, resources, instructor support, and certificates.
                    </p>
                </div>

                <!-- Monthly / Yearly -->
                <div class="bg-white rounded-2 p-1 shadow-sm">
                    <button class="btn btn-warning text-white px-3">
                        Monthly
                    </button>

                    <button class="btn btn-light px-3">
                        Yearly
                    </button>
                </div>

            </div>


            <!-- Pricing Box -->
            <div class="bg-white rounded-3 p-4">

                <div class="row g-4">

                    <!-- Free Plan -->
                    <div class="col-md-6">

                        <div class="border rounded-3 p-3 h-100">

                            <!-- Plan Name -->
                            <div class="bg-light border rounded-2 text-center py-2 mb-3">
                                <span class="fw-semibold">Free Plan</span>
                            </div>

                            <!-- Price -->
                            <div class="text-center mb-4">
                                <span class="display-5 fw-bold">$0</span>
                                <small class="text-secondary">/month</small>
                            </div>

                            <!-- Features -->
                            <div class="border rounded-3 p-3">

                                <h6 class="text-center fw-bold mb-4">
                                    Available Features
                                </h6>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; Access to selected free courses.
                                </div>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; Limited course materials and resources.
                                </div>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; Basic community support.
                                </div>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; No certification upon completion.
                                </div>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; Ad-supported platform.
                                </div>

                                <div class="border rounded-2 p-2 mb-2 small text-secondary">
                                    ✕ &nbsp; Access to exclusive Pro Plan community forums.
                                </div>

                                <div class="border rounded-2 p-2 small text-secondary">
                                    ✕ &nbsp; Early access to new courses and updates.
                                </div>

                            </div>

                            <!-- Button -->
                            <a href="register.php?plan=free" class="btn btn-warning text-white w-100">
                                Get Started
                            </a>

                        </div>

                    </div>


                    <!-- Pro Plan -->
                    <div class="col-md-6">

                        <div class="border rounded-3 p-3 h-100">

                            <!-- Plan Name -->
                            <div class="bg-light border rounded-2 text-center py-2 mb-3">
                                <span class="fw-semibold">Pro Plan</span>
                            </div>

                            <!-- Price -->
                            <div class="text-center mb-4">
                                <span class="display-5 fw-bold">$79</span>
                                <small class="text-secondary">/month</small>
                            </div>

                            <!-- Features -->
                            <div class="border rounded-3 p-3">

                                <h6 class="text-center fw-bold mb-4">
                                    Available Features
                                </h6>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; Unlimited access to all courses.
                                </div>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; Unlimited course materials and resources.
                                </div>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; Priority support from instructors.
                                </div>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; Course completion certificates.
                                </div>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; Ad-free experience.
                                </div>

                                <div class="border rounded-2 p-2 mb-2 small">
                                    ✓ &nbsp; Access to exclusive Pro Plan community forums.
                                </div>

                                <div class="border rounded-2 p-2 small">
                                    ✓ &nbsp; Early access to new courses and updates.
                                </div>

                            </div>

                            <!-- Button -->
                            <a href="register.php?plan=pro" class="btn btn-warning text-white w-100">
                                Get Started
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
