<?php

include "connect2.php";

$objCon = new Connect2();

$error = "";

// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {

        header('Location: /Team-1-Website/admin_dashboard.php');
        exit();
    } elseif ($_SESSION['role'] === 'teacher') {

        header('Location: /Team-1-Website/teachers/dashboard.php');
        exit();
    } elseif ($_SESSION['role'] === 'student') {

        header('Location: /Team-1-Website/students/profile.php');
        exit();
    } else {

        header('Location: /Team-1-Website/index.php');
        exit();
    }
}



if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = $objCon->login($email);


    if (count($user) > 0 && password_verify($password, $user['password'])) {


        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['image'] = $user['image'];

        if ($user['role'] === 'student') {

            $student_query = "SELECT id FROM students WHERE user_id = ?";

            $student_stmt = $objCon->getConnection()->prepare($student_query);

            if ($student_stmt) {

                $student_stmt->bind_param("i", $user['id']);

                $student_stmt->execute();

                $student_result = $student_stmt->get_result();

                $student_data = $student_result->fetch_assoc();


                if ($student_data) {

                    $_SESSION['student_id'] = $student_data['id'];
                }

                $student_stmt->close();
            }
        }


        if (isset($_POST['rememberMe'])) {

            setcookie(
                'remembered_email',
                $email,
                time() + (86400 * 30),
                '/'
            );
        }

        if ($user['role'] === 'admin') {
            header('Location:/Team-1-Website/admin_dashboard.php');
            exit();
        } elseif ($user['role'] === 'teacher') {

            header('Location:/Team-1-Website/teachers/dashboard.php');
            exit();
        } elseif ($user['role'] === 'student') {

            header('Location:/Team-1-Website/students/profile.php');
            exit();
        } else {

            header('Location:/Team-1-Website/index.php');
            exit();
        }
    } else {

        $error = "Invalid email or password.";
    }
}



$rememberedEmail = $_COOKIE['remembered_email'] ?? '';



include "header.php";

?>


<section class="py-5" style="background-color: #f7f7f7;">

    <div class="container">

        <div class="row align-items-center">


            <!--  TESTIMONIAL-->

            <div class="col-lg-6 order-lg-1 order-2">

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


            <!--  LOGIN -->

            <div class="col-lg-6 order-1 order-lg-2">

                <div class="card border-0 shadow-sm p-3 p-md-5 mb-5">


                    <h1 class="fw-bold text-center mb-2">
                        Login
                    </h1>


                    <p class="text-center mb-3">

                        Welcome back!
                        Please log in to access your account.

                    </p>


                    <!-- ERROR -->

                    <?php if (!empty($error)): ?>

                        <div class="alert alert-danger">

                            <?php echo htmlspecialchars($error); ?>

                        </div>

                    <?php endif; ?>


                    <form method="POST">


                        <!--EMAIL -->

                        <div class="mb-3">

                            <label
                                for="email"
                                class="form-label fw-bold">

                                Email

                            </label>


                            <input
                                type="email"
                                id="email"
                                class="form-control form-control-lg"
                                name="email"
                                placeholder="Enter your Email"
                                value="<?php echo htmlspecialchars($rememberedEmail); ?>"
                                required>

                        </div>


                        <!--  PASSWORD-->

                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label fw-bold">

                                Password

                            </label>


                            <div class="position-relative">


                                <input
                                    type="password"
                                    id="password"
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


                        <!--   FORGOT PASSWORD-->

                        <div class="text-end mb-3">

                            <p>
                                Forgot Password?
                            </p>

                        </div>


                        <!--  REMEMBER ME-->

                        <div class="mb-3 form-check">

                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="rememberMe"
                                name="rememberMe">

                            <label
                                class="form-check-label"
                                for="rememberMe">

                                Remember Me

                            </label>

                        </div>


                        <!-- LOGIN BUTTON-->

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
                                style="border-top:2px solid #eee;">
                            </div>


                            <span style="color:#bcbbbb;">
                                OR
                            </span>


                            <div
                                class="flex-grow-1"
                                style="border-top:2px solid #eee;">
                            </div>

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


                        <!--  REGISTER -->

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


<?php

include "footer.php";

?>