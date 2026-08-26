<?php
include "connect.php";

$teachers = $conn->query("
    SELECT teachers.id, users.name
    FROM teachers
    JOIN users ON teachers.user_id = users.id
");

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $hours = $_POST['hours'];
    $teacher_id = $_POST['teacher_id'];

    $image = "";

    if (!empty($_FILES['image']['name'])) {

        $image = time() . "_" . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "upload/" . $image
        );
    }

    $sql = "INSERT INTO courses (name, hours, teacher_id, image)
            VALUES ('$name', '$hours', '$teacher_id', '$image')";

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
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h1 class="fw-bold mb-1">Add Course</h1>

            <p class="text-muted mb-0">
                Add a new course to the course system.
            </p>
        </div>

        <a href="manage_courses.php"
           class="btn btn-outline-dark">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Courses

        </a>

    </div>


    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4 p-md-5">

            <form method="POST" enctype="multipart/form-data">

                <div class="row g-4">

                    <!-- Course Name -->
                    <div class="col-md-6">

                        <label for="name" class="form-label fw-semibold">
                            Course Name
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-book"></i>
                            </span>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="Enter course name"
                                required>

                        </div>

                    </div>


                    <!-- Hours -->
                    <div class="col-md-6">

                        <label for="hours" class="form-label fw-semibold">
                            Course Hours
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-clock"></i>
                            </span>

                            <input
                                type="number"
                                id="hours"
                                name="hours"
                                class="form-control"
                                placeholder="Enter course hours"
                                min="1"
                                required>

                        </div>

                    </div>


                    <!-- Teacher -->
                    <div class="col-12">

                        <label for="teacher_id" class="form-label fw-semibold">
                            Teacher
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-person-workspace"></i>
                            </span>

                            <select
                                id="teacher_id"
                                name="teacher_id"
                                class="form-select"
                                required>

                                <option value="">
                                    Select Teacher
                                </option>

                                <?php while ($teacher = $teachers->fetch_assoc()): ?>

                                    <option value="<?php echo $teacher['id']; ?>">
                                        <?php echo htmlspecialchars($teacher['name']); ?>
                                    </option>

                                <?php endwhile; ?>

                            </select>

                        </div>

                    </div>


                    <!-- Course Image -->
                    <div class="col-12">

                        <label for="image" class="form-label fw-semibold">
                            Course Image
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-image"></i>
                            </span>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="form-control"
                                accept="image/*">

                        </div>

                        <small class="text-muted">
                            Upload an image for the course. This field is optional.
                        </small>

                    </div>

                </div>


                <!-- Buttons -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-5">

                    <a href="manage_courses.php"
                       class="btn btn-outline-secondary px-4">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        name="submit"
                        class="btn text-white px-4"
                        style="background-color: #FF9500;">

                        <i class="bi bi-plus-circle me-1"></i>
                        Add Course

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php include "footer.php"; ?>