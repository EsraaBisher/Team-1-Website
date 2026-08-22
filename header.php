
<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$userRole   = $_SESSION['role'] ?? null;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Course System</title>

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="/Team-1-Website-main/bootstrap/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Team-1-Website-main/bootstrap/assets/css/style.css">
=======
    <!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom Style CDN/Relative -->
<link rel="stylesheet" href="../bootstrap/assets/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <a class="navbar-brand fw-bold fs-5 " href="#">
                Course<span style="color: #FF9500; "> System </span>
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarText">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarText">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">

                    <li class="nav-item">

                        <a class="nav-link active fs-5 fw-medium" href="/Team-1-Website-main/index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium fs-5" href="/Team-1-Website-main/about.php">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium fs-5" href="/Team-1-Website-main/courses/index.php">Courses</a>
=======
                        <a class="nav-link active fs-5 fw-medium" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium fs-5" href="about.php">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium fs-5" href="courses.php">Courses</a>

                    </li>


                    <li class="nav-item">

                        <a class="nav-link fw-medium fs-5" href="/Team-1-Website-main/pricing.php">Pricing</a>
                    </li>

                </ul>

                <div>

                        <a class="nav-link fw-medium fs-5" href="pricing.php">Pricing</a>
                    </li>

                </ul>
                <?php if ($isLoggedIn) { ?>
                    <div class="d-flex align-items-center gap-2">
                        <a href="profile.php" class="d-flex align-items-center gap-2 text-decoration-none" style="color:#262626;">
                            <img src="<?= htmlspecialchars($_SESSION['image'] ?? 'bootstrap/assets/image/profile.jpg') ?>"
                                alt="profile" class="rounded-circle" style="width:36px;height:36px;object-fit:cover;">
                            <span class="fw-medium"><?= htmlspecialchars($_SESSION['name'] ?? 'Profile') ?></span>
                        </a>

                        <a href="logout.php" class="btn text-white fw-medium fs-5" style="background-color: #FF9500;">
                            Logout
                        </a>
                    </div>
                <?php } else { ?>
                    <div>
                        <a href="login.php" class="btn fw-medium fs-5 me-2" style="color: #262626;">
                            Login
                        </a>

                        <a href="register.php" class="btn text-white fs-5 fw-medium" style="background-color: #FF9500;">
                            Register
                        </a>
                    </div>
                <?php } ?>
                <!-- <div>

                    <a href="login.php" class="btn fw-medium fs-5 me-2" style="color: #262626;">
                        Login
                    </a>

                    <a href="register.php" class="btn text-white fs-5 fw-medium" style="background-color: #FF9500;">
                        Register
                    </a>
     </div>

                </div> -->


            </div>

        </div>

    </nav>