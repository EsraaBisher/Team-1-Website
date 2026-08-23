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

?>



    <link
        rel="stylesheet"
        href="../bootstrap/assets/css/bootstrap.min.css"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >




<body class="bg-light">


<?php include "../header.php"; ?>


<script>

document.addEventListener("DOMContentLoaded", function () {

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


<!-- PROFILE -->

<div class="container py-5">

    <div class="mb-4">

        <h1 class="fw-bold">
            Teacher Profile
        </h1>

        <p class="text-muted">
            View your personal information
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4 p-md-5">

            <div class="row align-items-center">


                <!-- IMAGE -->

                <div class="col-md-4 text-center mb-4 mb-md-0">

                    <?php if (!empty($teacher['image'])): ?>

                        <img
                            src="../upload/<?php echo htmlspecialchars($teacher['image']); ?>"
                            alt="Teacher"
                            width="180"
                            height="180"
                            class="rounded-circle shadow-sm"
                            style="object-fit:cover;"
                        >

                    <?php else: ?>

                        <div
                            class="rounded-circle bg-secondary-subtle d-flex justify-content-center align-items-center mx-auto"
                            style="width:180px;height:180px;"
                        >

                            <i class="bi bi-person fs-1 text-secondary"></i>

                        </div>

                    <?php endif; ?>

                </div>


                <!-- INFORMATION -->

                <div class="col-md-8">


                    <!-- NAME -->

                    <div class="mb-4">

                        <label class="text-muted small">
                            Name
                        </label>

                        <h3 class="fw-bold mb-0">

                            <?php
                            echo htmlspecialchars($teacher['name']);
                            ?>

                        </h3>

                    </div>


                    <!-- EMAIL -->

                    <div class="mb-4">

                        <label class="text-muted small">
                            Email
                        </label>

                        <p class="fs-5 mb-0">

                            <i class="bi bi-envelope me-2"></i>

                            <?php
                            echo htmlspecialchars($teacher['email']);
                            ?>

                        </p>

                    </div>


                    <!-- PHONE -->

                    <div class="mb-4">

                        <label class="text-muted small">
                            Phone
                        </label>

                        <p class="fs-5 mb-0">

                            <i class="bi bi-telephone me-2"></i>

                            <?php
                            echo htmlspecialchars($teacher['phone']);
                            ?>

                        </p>

                    </div>


                    <!-- SUBJECT -->

                    <div class="mb-4">

                        <label class="text-muted small">
                            Subject
                        </label>

                        <p class="fs-5 mb-0">

                            <i class="bi bi-mortarboard me-2"></i>

                            <?php
                            echo htmlspecialchars($teacher['subject']);
                            ?>

                        </p>

                    </div>


                    <!-- BUTTONS -->

                    <div class="mt-4">

                        <a
                            href="edit_profile.php"
                            class="btn text-white px-4"
                            style="background-color:#FF9500;"
                        >

                            <i class="bi bi-pencil me-2"></i>

                            Edit Profile

                        </a>


                        <a
                            href="dashboard.php"
                            class="btn btn-light px-4 ms-2"
                        >

                            Back to Dashboard

                        </a>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>


<script src="../bootstrap/assets/js/bootstrap.bundle.min.js"></script>


<?php include "../footer.php"; ?>


