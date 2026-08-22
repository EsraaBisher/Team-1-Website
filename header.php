<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Course System</title>

    <!-- Bootstrap CSS -->
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
                        <a class="nav-link active fs-5 fw-medium" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium fs-5" href="about.php">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium fs-5" href="courses.php">Courses</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link fw-medium fs-5" href="pricing.php">Pricing</a>
                    </li>

                </ul>

                <div>
                    <a href="login.php" class="btn fw-medium fs-5 me-2" style="color: #262626;">
                        Login
                    </a>

                    <a href="register.php" class="btn text-white fs-5 fw-medium" style="background-color: #FF9500;">
                        Register
                    </a>
                </div>

            </div>

        </div>

    </nav>