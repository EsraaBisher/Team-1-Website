<?php

include "connect.php";

$hasDescriptionColumn = $conn->query("SHOW COLUMNS FROM courses LIKE 'description'")->num_rows > 0;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: manage_courses.php");
    exit();
}

$id = (int) $_GET['id'];

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
    $description = $_POST['description'] ?? $course['description'] ?? '';

    $image = $course['image'];

    if (!empty($_FILES['image']['name'])) {

        $image = time() . "_" . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "upload/" . $image
        );
    }

    $sqlParts = [
        "name='$name'",
        "hours='$hours'",
        "teacher_id='$teacher_id'",
        "image='$image'"
    ];

    if ($hasDescriptionColumn) {
        $sqlParts[] = "description='" . $conn->real_escape_string($description) . "'";
    }

    $sql = "UPDATE courses
            SET " . implode(", ", $sqlParts) . "
            WHERE id=$id";

    if ($conn->query($sql)) {

        header("Location: manage_courses.php");
        exit();

    } else {

        echo "Error: " . $conn->error;
    }
}
?>

<?php include "header.php"; ?>


<div class="container py-5">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row
                justify-content-between
                align-items-md-center
                gap-3
                mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Edit Course
            </h1>

            <p class="text-muted mb-0">
                Update course information
            </p>
        </div>

        <a href="manage_courses.php"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Courses

        </a>

    </div>


    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4 p-md-5">

            <form method="POST"
                  enctype="multipart/form-data">

                <div class="row g-4">

                    <!-- Course Name -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Course Name
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control form-control-lg"
                               value="<?php echo htmlspecialchars($course['name']); ?>"
                               placeholder="Enter course name"
                               required>

                    </div>


                    <!-- Hours -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Hours
                        </label>

                        <input type="number"
                               name="hours"
                               class="form-control"
                               value="<?php echo htmlspecialchars($course['hours']); ?>"
                               placeholder="Enter course hours"
                               min="1"
                               required>

                    </div>


                    <?php if ($hasDescriptionColumn): ?>
                        <!-- Description -->
                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea name="description"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Enter course description"
                                      required><?php echo htmlspecialchars($course['description'] ?? ''); ?></textarea>

                        </div>
                    <?php endif; ?>

                    <!-- Teacher -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Teacher
                        </label>

                        <select name="teacher_id"
                                class="form-select"
                                required>

                            <option value="">
                                Select Teacher
                            </option>

                            <?php while ($teacher = $teachers->fetch_assoc()): ?>

                                <option value="<?php echo $teacher['id']; ?>"
                                    <?php
                                    if ($teacher['id'] == $course['teacher_id']) {
                                        echo "selected";
                                    }
                                    ?>>

                                    <?php echo htmlspecialchars($teacher['name']); ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>


                    <!-- Current Image -->
                    <?php if (!empty($course['image'])): ?>

                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Current Course Image
                            </label>

                            <div>
                                <img src="upload/<?php echo htmlspecialchars($course['image']); ?>"
                                     alt="Course Image"
                                     class="rounded-3 border"
                                     style="width: 180px; height: 120px; object-fit: cover;">
                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- New Image -->
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Course Image
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control"
                               accept="image/*">

                        <div class="form-text">
                            Leave empty if you don't want to change the current image.
                        </div>

                    </div>


                    <!-- Buttons -->
                    <div class="col-12">

                        <div class="d-flex flex-column flex-md-row
                                    gap-2
                                    pt-3">

                            <button type="submit"
                                    name="submit"
                                    class="btn text-white px-4"
                                    style="background-color: #FF9500;">

                                <i class="bi bi-check-lg me-1"></i>
                                Update Course

                            </button>


                            <a href="manage_courses.php"
                               class="btn btn-outline-secondary px-4">

                                Cancel

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


<?php include "footer.php"; ?>