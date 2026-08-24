<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user_id']);
$userRole   = $_SESSION['role'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Course System</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="../bootstrap/assets/css/style.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- Custom Style CDN/Relative -->
    <link rel="stylesheet" href="../bootstrap/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary">

        <div class="container-fluid">

            <!-- Logo -->

            <a class="navbar-brand fw-bold fs-5" href="index.php">
                Course<span style="color: #FF9500;"> System </span>
            </a>


            <!-- Mobile Navbar Button -->

            <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarText"
                aria-controls="navbarText"
                aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>


            <!-- Navbar Content -->

            <div class="collapse navbar-collapse" id="navbarText">


                <!-- Navbar Links -->

                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">

                    <li class="nav-item">

                        <a class="nav-link active fs-5 fw-medium"
                            href="/Team-1-Website/index.php">

                            Home

                        </a>

                    </li>


                    <li class="nav-item">

                        <a class="nav-link fw-medium fs-5"
                            href="/Team-1-Website/about.php">

                            About

                        </a>

                    </li>


                    <li class="nav-item">

                        <a class="nav-link fw-medium fs-5"
                            href="/Team-1-Website/courses.php">

                            Courses

                        </a>

                    </li>


                    <li class="nav-item">

                        <a class="nav-link fw-medium fs-5"
                            href="/Team-1-Website/pricing.php">

                            Pricing

                        </a>

                    </li>

                </ul>


                <!-- Login / Register OR Profile / Logout -->


                <?php if ($isLoggedIn) { ?>

                    <!-- User is logged in -->

                    <div class="d-flex align-items-center gap-2">
                        <a href="/Team-1-Website/<?php if ($userRole === 'teacher') echo 'teachers/dashboard.php';
                                                    elseif ($userRole === 'student') echo 'students/profile.php';
                                                    else echo 'users/profile.php'; ?>" class=" d-flex align-items-center gap-2 text-decoration-none" style="color:#262626;">
                            <img src="/Team-1-Website/<?= !empty($_SESSION['image']) ? $_SESSION['image'] : 'bootstrap/assets/image/avatar.webp' ?>"
                                alt="profile" class="rounded-circle" style="width:36px;height:36px;object-fit:cover;">
                            <span class="fw-medium"><?= htmlspecialchars($_SESSION['name'] ?? 'Profile') ?></span>
                        </a>


                        <!-- Logout -->

                        <a href="/Team-1-Website/logout.php"
                            class="btn text-white fw-medium fs-5"
                            style="background-color: #FF9500;">

                            Logout

                        </a>

                    </div>


                <?php } else { ?>

                    <!-- User is NOT logged in -->

                    <div>

                        <!-- Login -->

                        <a href="login.php"
                            class="btn fw-medium fs-5 me-2"
                            style="color: #262626;">

                            Login

                        </a>


                        <!-- Register -->

                        <a href="register.php"
                            class="btn text-white fs-5 fw-medium"
                            style="background-color: #FF9500;">

                            Register

                        </a>

                    </div>

                <?php } ?>


            </div>

        </div>

    </nav>


    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>