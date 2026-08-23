<?php


include "../connect.php";

// Temporary test user
// Later:
// $user_id = $_SESSION['user_id'];

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


// UPDATE PROFILE

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];


    // Update users table

    $user_sql = "UPDATE users
                 SET name = ?, email = ?
                 WHERE id = ?";

    $user_stmt = $conn->prepare($user_sql);

    $user_stmt->bind_param(
        "ssi",
        $name,
        $email,
        $user_id
    );

    $user_stmt->execute();


    // Update teachers table

    $teacher_sql = "UPDATE teachers
                    SET phone = ?, subject = ?
                    WHERE user_id = ?";

    $teacher_stmt = $conn->prepare($teacher_sql);

    $teacher_stmt->bind_param(
        "ssi",
        $phone,
        $subject,
        $user_id
    );

    $teacher_stmt->execute();


    // UPLOAD IMAGE

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] === 0
    ) {

        // Get old image name

        $old_image = $teacher['image'];


        // Get new image information

        $image_name = $_FILES['image']['name'];

        $image_tmp = $_FILES['image']['tmp_name'];

        $image_ext = strtolower(
            pathinfo($image_name, PATHINFO_EXTENSION)
        );


        // Allowed extensions

        $allowed_extensions = [
            "jpg",
            "jpeg",
            "png",
            "webp"
        ];


        if (in_array($image_ext, $allowed_extensions)) {


            // Create unique image name

            $new_image_name =
                "teacher_" .
                $user_id .
                "_" .
                time() .
                "." .
                $image_ext;


            // Upload path

            $upload_path =
                "../upload/" . $new_image_name;


            // Move new image to upload folder

            if (
                move_uploaded_file(
                    $image_tmp,
                    $upload_path
                )
            ) {


                // Update image name in database

                $image_sql = "UPDATE users
                              SET image = ?
                              WHERE id = ?";


                $image_stmt =
                    $conn->prepare($image_sql);


                $image_stmt->bind_param(
                    "si",
                    $new_image_name,
                    $user_id
                );


                // If database update succeeds

                if ($image_stmt->execute()) {


                    // Delete old image

                    if (!empty($old_image)) {


                        $old_image_path =
                            "../upload/" . $old_image;


                        if (
                            file_exists($old_image_path)
                        ) {

                            unlink($old_image_path);

                        }

                    }

                }

            }

        }

    }


    // Go back to profile

    header("Location: profile.php");

    exit;

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

</head>


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


<!-- EDIT PROFILE -->

<div class="container py-5">


    <div class="mb-4">

        <h1 class="fw-bold">
            Edit Profile
        </h1>

        <p class="text-muted">
            Update your personal information
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4 p-md-5">


            <form
                method="POST"
                enctype="multipart/form-data"
            >


                <!-- PROFILE IMAGE -->

                <div class="text-center mb-5">


                    <?php if (!empty($teacher['image'])): ?>

                        <img
                            src="../upload/<?php echo htmlspecialchars($teacher['image']); ?>"
                            alt="Teacher"
                            width="150"
                            height="150"
                            class="rounded-circle shadow-sm mb-3"
                            style="object-fit:cover;"
                        >

                    <?php else: ?>

                        <div
                            class="rounded-circle bg-secondary-subtle d-flex justify-content-center align-items-center mx-auto mb-3"
                            style="width:150px;height:150px;"
                        >

                            <i class="bi bi-person fs-1 text-secondary"></i>

                        </div>

                    <?php endif; ?>


                    <div>

                        <label
                            for="image"
                            class="btn btn-light border"
                        >

                            <i class="bi bi-camera me-2"></i>

                            Change Photo

                        </label>


                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="d-none"
                            accept="image/*"
                        >

                    </div>


                </div>


                <!-- NAME -->

                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control form-control-lg"
                        value="<?php echo htmlspecialchars($teacher['name']); ?>"
                        required
                    >

                </div>


                <!-- EMAIL -->

                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control form-control-lg"
                        value="<?php echo htmlspecialchars($teacher['email']); ?>"
                        required
                    >

                </div>


                <!-- PHONE -->

                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control form-control-lg"
                        value="<?php echo htmlspecialchars($teacher['phone']); ?>"
                        required
                    >

                </div>


                <!-- SUBJECT -->

                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Subject
                    </label>

                    <input
                        type="text"
                        name="subject"
                        class="form-control form-control-lg"
                        value="<?php echo htmlspecialchars($teacher['subject']); ?>"
                        required
                    >

                </div>


                <!-- BUTTONS -->

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn text-white px-4"
                        style="background-color:#FF9500;"
                    >

                        <i class="bi bi-check-lg me-2"></i>

                        Save Changes

                    </button>


                    <a
                        href="profile.php"
                        class="btn btn-light px-4"
                    >

                        Cancel

                    </a>

                </div>


            </form>

        </div>

    </div>

</div>


<script src="../bootstrap/assets/js/bootstrap.bundle.min.js"></script>


<?php include "../footer.php"; ?>

