<?php
include "connect.php";

$sql = "SELECT courses.id, courses.name, courses.hours, courses.image,
               users.name AS teacher_name
        FROM courses
        JOIN teachers ON courses.teacher_id = teachers.id
        JOIN users ON teachers.user_id = users.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Courses</title>

    <link rel="stylesheet" href="./bootstrap/assets/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold">Manage Courses</h1>
            <p class="text-muted">View and manage courses</p>
        </div>

        <div>

            <a href="add_course.php" class="btn btn-success">
                <i class="bi bi-plus-lg"></i>
                Add Course
            </a>

            <a href="admin_dashboard.php" class="btn btn-dark">
                <i class="bi bi-arrow-left"></i>
                Dashboard
            </a>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Course Name</th>
                        <th>Hours</th>
                        <th>Teacher</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php if ($result->num_rows > 0): ?>

                        <?php while ($course = $result->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo $course['id']; ?>
                                </td>

                                <td>

                                    <?php if (!empty($course['image'])): ?>

                                        <img src="upload/<?php echo $course['image']; ?>"
                                             width="60"
                                             height="60"
                                             style="object-fit: cover;">

                                    <?php else: ?>

                                        No Image

                                    <?php endif; ?>

                                </td>

                                <td>
                                    <?php echo $course['name']; ?>
                                </td>

                                <td>
                                    <?php echo $course['hours']; ?>
                                </td>

                                <td>
                                    <?php echo $course['teacher_name']; ?>
                                </td>

                                <td>

                                    <a href="edit_course.php?id=<?php echo $course['id']; ?>"
                                       class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                    <a href="delete_course.php?id=<?php echo $course['id']; ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this course?');">
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6"
                                class="text-center text-muted py-4">

                                No courses found.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>