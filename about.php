<?php
include "header.php";
?>

<style>

    /* ================= GLOBAL ================= */

    body {
        background-color: #ffffff;
        color: #222222;
    }

    h1, h2, h3, h4, h5, h6 {
        color: #222222;
    }

    p {
        color: #666666;
        line-height: 1.7;
    }

    .orange {
        color: #FF9500 !important;
    }

    .btn-orange {
        background-color: #FF9500;
        border: 1px solid #FF9500;
        color: white;
        padding: 12px 25px;
        border-radius: 6px;
        font-weight: 600;
    }

    .btn-orange:hover {
        background-color: #e68600;
        border-color: #e68600;
        color: white;
    }


    /* ================= TOP BANNER ================= */

    .about-banner {
        background-color: #FF9500;
        color: white;
        padding: 9px 20px;
        text-align: center;
        font-size: 13px;
        font-weight: 500;
    }


    /* ================= HERO ================= */

    .about-hero {
        background-color: #f8f8f8;
        padding: 75px 0;
    }

    .hero-label {
        color: #FF9500;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
    }

    .hero-title {
        font-size: 48px;
        font-weight: 800;
        line-height: 1.15;
        margin-top: 15px;
    }

    .hero-title span {
        color: #FF9500;
    }

    .hero-text {
        max-width: 600px;
        margin-top: 20px;
        font-size: 16px;
    }


    /* ================= HERO BOX ================= */

    .learning-box {
        background: white;
        border-radius: 12px;
        padding: 35px;
        box-shadow: 0 10px 35px rgba(0,0,0,0.08);
        position: relative;
    }

    .learning-box::before {
        content: "";
        position: absolute;
        width: 70px;
        height: 70px;
        background: #FF9500;
        border-radius: 10px;
        top: -20px;
        right: -20px;
        opacity: 0.15;
    }

    .learning-icon {
        width: 65px;
        height: 65px;
        background: #fff3e3;
        color: #FF9500;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 20px;
    }

    .course-progress {
        background: #eeeeee;
        height: 8px;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 15px;
    }

    .course-progress span {
        display: block;
        width: 78%;
        height: 100%;
        background: #FF9500;
    }


    /* ================= SECTION TITLE ================= */

    .section-label {
        color: #FF9500;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 1px;
    }

    .section-title {
        font-size: 36px;
        font-weight: 800;
        margin-top: 10px;
    }


    /* ================= ACHIEVEMENTS ================= */

    .achievement-section {
        padding: 80px 0;
    }

    .achievement-card {
        background: white;
        border: 1px solid #eeeeee;
        border-radius: 10px;
        padding: 28px;
        height: 100%;
        transition: 0.3s;
    }

    .achievement-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    }

    .achievement-icon {
        width: 45px;
        height: 45px;
        background: #fff3e3;
        color: #FF9500;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }

    .achievement-card h4 {
        font-size: 18px;
        font-weight: 700;
    }

    .achievement-card p {
        font-size: 14px;
        margin-bottom: 0;
    }


    /* ================= GOALS ================= */

    .goals-section {
        background: #f8f8f8;
        padding: 80px 0;
    }

    .goal-card {
        background: white;
        border-radius: 10px;
        padding: 28px;
        height: 100%;
        border: 1px solid #eeeeee;
    }

    .goal-number {
        color: #FF9500;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .goal-card h4 {
        font-weight: 700;
        font-size: 18px;
    }

    .goal-card p {
        font-size: 14px;
    }


    /* ================= CTA ================= */

    .cta-section {
        padding: 80px 0;
    }

    .cta-box {
        background: #f8f8f8;
        border-radius: 12px;
        padding: 50px;
        position: relative;
        overflow: hidden;
    }

    .cta-box::after {
        content: "";
        position: absolute;
        width: 200px;
        height: 200px;
        border: 35px solid #FF9500;
        border-radius: 50%;
        right: -80px;
        bottom: -100px;
        opacity: 0.12;
    }

    .cta-title {
        font-size: 32px;
        font-weight: 800;
    }


    /* ================= RESPONSIVE ================= */

    @media (max-width: 768px) {

        .hero-title {
            font-size: 36px;
        }

        .section-title {
            font-size: 29px;
        }

        .cta-box {
            padding: 35px 25px;
        }

    }

</style>


<!-- ================= TOP ORANGE BANNER ================= -->

<div class="about-banner">

    Learn something new today — Explore our courses and grow your skills.

</div>


<!-- ================= HERO ================= -->

<section class="about-hero">

    <div class="container">

        <div class="row align-items-center g-5">

            <!-- LEFT -->

            <div class="col-lg-7">

                <div class="hero-label">
                    About Our Platform
                </div>

                <h1 class="hero-title">

                    Learning Made
                    <br>

                    <span>Simple. Smart. Better.</span>

                </h1>

                <p class="hero-text">

                    Welcome to EduLearn, an online learning platform
                    created to make education easier, more flexible
                    and accessible for everyone.

                    <br><br>

                    We connect students with useful courses,
                    professional instructors and practical knowledge
                    that can help them build real skills for the future.

                </p>

                <a href="courses.php" class="btn btn-orange mt-3">

                    Explore Courses

                    <i class="fa-solid fa-arrow-right ms-2"></i>

                </a>

            </div>


            <!-- RIGHT -->

            <div class="col-lg-5">

                <div class="learning-box">

                    <div class="learning-icon">

                        <i class="fa-solid fa-graduation-cap"></i>

                    </div>

                    <h3 class="fw-bold">
                        Your Learning Journey
                    </h3>

                    <p>
                        Choose a course, learn at your own pace
                        and track your progress step by step.
                    </p>


                    <div class="d-flex justify-content-between mt-4">

                        <span class="fw-bold">
                            Course Progress
                        </span>

                        <span class="orange fw-bold">
                            78%
                        </span>

                    </div>

                    <div class="course-progress">

                        <span></span>

                    </div>


                    <div class="row mt-4 text-center">

                        <div class="col-4">

                            <i class="fa-solid fa-book orange fs-4"></i>

                            <small class="d-block mt-2">
                                Courses
                            </small>

                        </div>

                        <div class="col-4">

                            <i class="fa-solid fa-video orange fs-4"></i>

                            <small class="d-block mt-2">
                                Lessons
                            </small>

                        </div>

                        <div class="col-4">

                            <i class="fa-solid fa-award orange fs-4"></i>

                            <small class="d-block mt-2">
                                Skills
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ================= ACHIEVEMENTS ================= -->

<section class="achievement-section">

    <div class="container">

        <div class="text-center mb-5">

            <div class="section-label">
                Our Achievements
            </div>

            <h2 class="section-title">
                Helping Learners Move Forward
            </h2>

            <p class="mx-auto" style="max-width: 650px;">

                Our platform is designed around one simple idea:
                give learners the tools and knowledge they need
                to improve themselves.

            </p>

        </div>


        <div class="row g-4">


            <!-- 1 -->

            <div class="col-md-6">

                <div class="achievement-card">

                    <div class="achievement-icon">

                        <i class="fa-solid fa-users"></i>

                    </div>

                    <h4>
                        Trusted by Learners
                    </h4>

                    <p>

                        Students can discover educational content
                        and develop new skills through a simple
                        and organized learning experience.

                    </p>

                </div>

            </div>


            <!-- 2 -->

            <div class="col-md-6">

                <div class="achievement-card">

                    <div class="achievement-icon">

                        <i class="fa-solid fa-star"></i>

                    </div>

                    <h4>
                        Quality Learning
                    </h4>

                    <p>

                        We focus on providing useful courses
                        that combine clear explanations with
                        practical knowledge.

                    </p>

                </div>

            </div>


            <!-- 3 -->

            <div class="col-md-6">

                <div class="achievement-card">

                    <div class="achievement-icon">

                        <i class="fa-solid fa-clock"></i>

                    </div>

                    <h4>
                        Learn Anytime
                    </h4>

                    <p>

                        Learning should fit your lifestyle.
                        Students can access their courses
                        whenever they are ready to learn.

                    </p>

                </div>

            </div>


            <!-- 4 -->

            <div class="col-md-6">

                <div class="achievement-card">

                    <div class="achievement-icon">

                        <i class="fa-solid fa-chart-line"></i>

                    </div>

                    <h4>
                        Track Your Progress
                    </h4>

                    <p>

                        Follow your learning journey and see
                        how far you have come as you complete
                        your courses.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ================= GOALS ================= -->

<section class="goals-section">

    <div class="container">

        <div class="row align-items-center mb-5">

            <div class="col-lg-7">

                <div class="section-label">
                    Our Goals
                </div>

                <h2 class="section-title">

                    Building a Better
                    <span class="orange">
                        Learning Experience
                    </span>

                </h2>

            </div>

            <div class="col-lg-5">

                <p class="mb-0">

                    We want to make online education more
                    practical, organized and enjoyable for
                    students of different backgrounds and levels.

                </p>

            </div>

        </div>


        <div class="row g-4">


            <!-- GOAL 1 -->

            <div class="col-md-6 col-lg-3">

                <div class="goal-card">

                    <div class="goal-number">
                        01
                    </div>

                    <h4>
                        Practical Skills
                    </h4>

                    <p>

                        Focus on knowledge that students
                        can actually use in their academic
                        and professional lives.

                    </p>

                </div>

            </div>


            <!-- GOAL 2 -->

            <div class="col-md-6 col-lg-3">

                <div class="goal-card">

                    <div class="goal-number">
                        02
                    </div>

                    <h4>
                        Easy Learning
                    </h4>

                    <p>

                        Keep the platform simple so students
                        can focus on learning instead of
                        complicated navigation.

                    </p>

                </div>

            </div>


            <!-- GOAL 3 -->

            <div class="col-md-6 col-lg-3">

                <div class="goal-card">

                    <div class="goal-number">
                        03
                    </div>

                    <h4>
                        Better Opportunities
                    </h4>

                    <p>

                        Help learners develop skills that
                        can open new academic and career
                        opportunities.

                    </p>

                </div>

            </div>


            <!-- GOAL 4 -->

            <div class="col-md-6 col-lg-3">

                <div class="goal-card">

                    <div class="goal-number">
                        04
                    </div>

                    <h4>
                        Keep Growing
                    </h4>

                    <p>

                        Continue improving our platform
                        and adding useful educational
                        content.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ================= CTA ================= -->

<section class="cta-section">

    <div class="container">

        <div class="cta-box">

            <div class="row align-items-center g-4">

                <div class="col-lg-8">

                    <div class="section-label">
                        Start Learning
                    </div>

                    <h2 class="cta-title mt-2">

                        Your Next Skill
                        <span class="orange">
                            Starts Here.
                        </span>

                    </h2>

                    <p class="mb-0">

                        Explore our courses, discover something
                        new and take the next step in your
                        learning journey.

                    </p>

                </div>


                <div class="col-lg-4 text-lg-end">

                    <a href="courses.php"
                       class="btn btn-orange btn-lg">

                        View Courses

                        <i class="fa-solid fa-arrow-right ms-2"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


<?php
include "footer.php";
?>