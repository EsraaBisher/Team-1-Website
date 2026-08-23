<?php
include "header.php";
include "connect2.php";

$objCon = new Connect2();

$error = "";

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'teacher') {
        header('location:index.php');
    } elseif ($_SESSION['role'] === 'student') {
        header('location:index.php');
    } else {
        header('location:index.php');
    }
    exit();
}


if (isset($_POST['email'])  && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = $objCon->login($email);

    //password_verify-> checks if the password matches the hashed pass in the db
    if (count($user) > 0 && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['image'] = $user['image'];

        if (isset($_POST['rememberMe'])) {
            setcookie('remembered_email', $email, time() + (86400 * 30), '/');
        }

        if ($user['role'] === 'teacher') {
            header('location:index.php');
        } elseif ($user['role'] === 'student') {
            header('location:index.php');
        } else {
            header('location:index.php');
        }
        exit();
    } else {
        $error = "you are not logged in";
    }
}

$rememberedEmail = $_COOKIE['remembered_email'] ?? '';
?>

<section class="py-5" style="background-color: #f7f7f7;">

    <div class="container">

        <div class="row align-items-center">

            <!-- SUBCONTAINER -->

            <div class="col-lg-6 order-lg-1 order-2">

                <!-- text -->

                <div>

                    <h2 class="fw-bold mb-3">
                        Students Testimonials
                    </h2>

                    <p class="mb-3">
                        Lorem ipsum dolor sit amet consectetur.
                        Tempus tincidunt etiam eget elit id imperdiet et.
                        Cras eu sit dignissim lorem nibh et.
                        Ac cum eget habitasse in velit fringilla feugiat
                        senectus in.
                    </p>

                </div>


                <!-- testimonial -->

                <div class="card border-0 shadow-sm p-4">

                    <p>
                        The web design course provided a solid foundation
                        for me. The instructors were knowledgeable and supportive,
                        and the interactive learning environment was engaging.
                        I highly recommend it!
                    </p>

                    <div class="d-flex justify-content-between align-items-center mt-3">

                        <div class="d-flex align-items-center gap-3">

                            <img
                                src="bootstrap/assets/image/profile.jpg"
                                alt="profile"
                                class="rounded-2"
                                style="width:48px; aspect-ratio:1/1; object-fit:cover;">

                            <span class="fw-semibold">
                                Sarah L
                            </span>

                        </div>

                        <a
                            href="#"
                            class="btn btn-light fw-medium py-2 px-3">
                            Read More
                        </a>

                    </div>

                </div>


                <!-- arrows -->

                <div class="d-flex gap-2 mt-3 justify-content-end">

                    <button
                        class="btn shadow-sm"
                        style="background-color:white;">
                        <i class="bi bi-arrow-left"></i>
                    </button>

                    <button
                        class="btn shadow-sm"
                        style="background-color:white;">
                        <i class="bi bi-arrow-right"></i>
                    </button>

                </div>

            </div>


            <!-- LOGIN -->

            <div class="col-lg-6 order-1 order-lg-2">

                <div class="card border-0 shadow-sm p-3 p-md-5 mb-5">

                    <h1 class="fw-bold text-center mb-2">
                        Login
                    </h1>

                    <p class="text-center mb-3">
                        Welcome back! Please log in to access your account.
                    </p>


                    <form method="POST">


                        <!-- EMAIL -->

                        <div class="mb-3">

                            <label
                                for="email"
                                class="form-label fw-bold">
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control form-control-lg"
                                name="email"
                                placeholder="Enter your Email"
                                required>

                        </div>


                        <!-- PASSWORD -->

                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label fw-bold">
                                Password
                            </label>

                            <div class="position-relative">

                                <input
                                    type="password"
                                    class="form-control form-control-lg"
                                    name="password"
                                    placeholder="Enter your Password"
                                    required>

                                <button
                                    type="button"
                                    class="btn position-absolute translate-middle-y border-0 end-0 top-50">
                                    <i class="bi bi-eye"></i>
                                </button>

                            </div>

                        </div>


                        <!-- FORGOT PASSWORD -->

                        <div class="text-end mb-3">

                            <p>
                                Forgot Password?
                            </p>

                        </div>


                        <!-- REMEMBER ME -->

                        <div class="mb-3 form-check">

                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="rememberMe">

                            <label class="form-check-label">
                                Remember Me
                            </label>

                        </div>


                        <!-- LOGIN -->

                        <button
                            type="submit"
                            class="btn fw-medium btn-lg w-100 text-white mb-4"
                            style="background-color:#FF9500;">
                            Login
                        </button>


                        <!-- OR -->

                        <div class="d-flex align-items-center gap-3 mb-4">

                            <div
                                class="flex-grow-1"
                                style="border-top:2px solid #eee;"></div>

                            <span style="color:#bcbbbb;">
                                OR
                            </span>

                            <div
                                class="flex-grow-1"
                                style="border-top:2px solid #eee;"></div>

                        </div>


                        <!-- GOOGLE -->

                        <a
                            href="#"
                            class="btn btn-light fw-medium btn-lg w-100 d-flex align-items-center justify-content-center gap-2 mb-3 p-3">

                            <img
                                src="bootstrap/assets/image/googleIcon.png"
                                alt="google"
                                width="20"
                                height="20">

                            <span class="fs-6">
                                Login with Google
                            </span>

                        </a>


                        <!-- REGISTER -->

                        <p class="text-center">

                            Don't have an account?

                            <a
                                href="register.php"
                                class="fw-medium">
                                Sign Up
                                <i class="bi bi-arrow-up-right"></i>
                            </a>

                        </p>


                    </form>

                </div>

            </div>

        </div>

    </div>

</section>
<<<<<<< HEAD=======<?php

                    if (isset($_POST['email']) && isset($_POST['password'])) {

                        $email = $_POST['email'];

                        $password = $_POST['password'];

                        if ($email == "test@gmail" && $password == "111") {

                            echo "<script>
                window.location.href='index.php';
              </script>";
                        } else {
                        }
                    }

                    ?>>>>>>>> 5cd73a54d9cb044e26967abff252323a8558d878
    <?php
    include "footer.php";
    ?>