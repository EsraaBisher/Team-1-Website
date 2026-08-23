<?php
include "connect.php";

if (!isset($_GET['id'])) {
    header("Location: manage_courses.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT *
        FROM courses
        WHERE id = $id";

$result = $conn->query($sql);
$course = $result->fetch_assoc();

if (!$course) {
    die("Course not found");
}

$teachers = $conn->query("
    SELECT teachers.id, users.name
    FROM teachers
    JOIN users ON teachers.user_id = users.id
");

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $hours = $_POST['hours'];
    $teacher_id = $_POST['teacher_id'];

    $image = $course['image'];

    if (!empty($_FILES['image']['name'])) {

        $image = time() . "_" . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "upload/" . $image
        );
    }

    $sql = "UPDATE courses
            SET name='$name',
                hours='$hours',
                teacher_id='$teacher_id',
                image='$image'
            WHERE id=$id";

    if ($conn->query($sql)) {

        header("Location: manage_courses.php");
        exit();

    } else {

        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Course</title>

    <link rel="stylesheet"
          href="./bootstrap/assets/css/bootstrap.min.css">

</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="fw-bold">Edit Course</h1>

        <a href="manage_courses.php"
           class="btn btn-dark">
            Back
        </a>

    </div>

    <div class="card border-0 shadow-sm p-4">

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Course Name
                </label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="<?php echo $course['name']; ?>"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Hours
                </label>

                <input type="number"
                       name="hours"
                       class="form-control"
                       value="<?php echo $course['hours']; ?>"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Teacher
                </label>

                <select name="teacher_id"
                        class="form-select"
                        required>

                    <?php while ($teacher = $teachers->fetch_assoc()): ?>

                        <option value="<?php echo $teacher['id']; ?>"
                            <?php
                            if ($teacher['id'] == $course['teacher_id']) {
                                echo "selected";
                            }
                            ?>>

                            <?php echo $teacher['name']; ?>

                        </option>

                    <?php endwhile; ?>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Course Image
                </label>

                <input type="file"
                       name="image"
                       class="form-control"
                       accept="image/*">

            </div>

            <button type="submit"
                    name="submit"
                    class="btn btn-primary w-100">

                Update Course

            </button>

        </form>

    </div>

</div>

</body>
</html>