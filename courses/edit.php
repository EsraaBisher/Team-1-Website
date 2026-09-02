<?php
include_once "connect.php";

$objCon = new connect();

if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$course = $objCon->selectOne("courses", $_GET["id"]);

if (!$course) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle Image Update
    if (isset($_FILES["image"]) && $_FILES["image"]["name"] != "") {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $imageName);
        $_POST["image"] = "/Team-1-Website/courses/" . $imageName;
    }

    // Handle Avatar Update
    if (isset($_FILES["avatar"]) && $_FILES["avatar"]["name"] != "") {
        $avatarName = time() . "_avatar_" . basename($_FILES["avatar"]["name"]);
        move_uploaded_file($_FILES["avatar"]["tmp_name"], "../avatars/" . $avatarName);
        $_POST["avatar"] = "/Team-1-Website/avatars/" . $avatarName;
    }

    if ($objCon->update($_POST, "courses", $course["id"])) {
        header("Location: index.php?edit=success");
        exit();
    }
}

include_once "../header.php";
?>

<div class="container my-5">
    <h1 class="text-center fw-bold mb-4">Edit Course: <?= htmlspecialchars($course["name"] ?? '') ?></h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm border-0 rounded-4">
                <div class="mb-3">
                    <label class="fw-bold">Course Name:</label>
                    <input class="form-control" type="text" name="name" value="<?= htmlspecialchars($course["name"] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Description:</label>
                    <textarea class="form-control" name="description" rows="3" required><?= htmlspecialchars($course["description"] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Teacher ID:</label>
                    <input class="form-control" type="number" name="teacher_id" value="<?= htmlspecialchars($course["teacher_id"] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Hours:</label>
                    <input class="form-control" type="number" name="hours" value="<?= htmlspecialchars($course["hours"] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Update Course Image (Leave blank to keep current):</label>
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="mb-4">
                    <label class="fw-bold">Update Avatar (Leave blank to keep current):</label>
                    <input class="form-control" type="file" name="avatar">
                </div>
                <button class="btn btn-success w-100 fw-bold py-2" type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</div>

<?php
include_once "../footer.php";
?>