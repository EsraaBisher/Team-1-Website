<?php
include_once "../header.php";
include_once "connect.php";

$objCon = new connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Handle Course Image Upload
    if (isset($_FILES["image"]) && $_FILES["image"]["name"] != "") {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);

        // Save the image directly in the current "courses" folder
        move_uploaded_file($_FILES["image"]["tmp_name"], $imageName);

        // Save the correct path to the database
        $_POST["image"] = "/Team-1-Website/courses/" . $imageName;
    }

    // 2. Handle Avatar Upload (Added ../ to paths)
    if (isset($_FILES["avatar"]) && $_FILES["avatar"]["name"] != "") {
        $avatarName = time() . "_avatar_" . basename($_FILES["avatar"]["name"]);
        move_uploaded_file($_FILES["avatar"]["tmp_name"], "../avatars/" . $avatarName);
        $_POST["avatar"] = "/Team-1-Website/avatars/" . $avatarName;
    }

    // Insert into the 'courses' table
    if ($objCon->new_course($_POST, "courses")) {
        header("location: index.php?add=success");
        exit();
    }
}
?>

<div class="container my-5">
    <h1 class="text-center fw-bold mb-4">Add New Course</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm border-0 rounded-4">
                <div class="mb-3">
                    <label class="fw-bold">Course Name:</label>
                    <input class="form-control" type="text" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Description:</label>
                    <textarea class="form-control" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Teacher ID:</label>
                    <input class="form-control" type="number" name="teacher_id" required>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Hours (e.g., 10):</label>
                    <input class="form-control" type="number" name="hours" required>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Course Image:</label>
                    <input class="form-control" type="file" name="image" required>
                </div>
                <div class="mb-4">
                    <label class="fw-bold">Instructor Avatar:</label>
                    <input class="form-control" type="file" name="avatar" required>
                </div>
                <button class="btn btn-success w-100 fw-bold py-2" type="submit">Add Course</button>
            </form>
        </div>
    </div>
</div>

<?php include_once "../footer.php"; ?>