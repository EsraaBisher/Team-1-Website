<?php
include "connect.php";

$sql = "SELECT students.id, students.student_number, students.class,
               students.user_id, users.name, users.email
        FROM students
        JOIN users ON students.user_id = users.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>

    <link rel="stylesheet" href="./bootstrap/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap/assets/css/style.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold">Manage Students</h1>
            <p class="text-muted">View and manage students</p>
        </div>

        <div>
            <a href="add_student.php" class="btn btn-success">
                <i class="bi bi-plus-lg"></i>
                Add Student
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Student Number</th>
                            <th>Class</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if ($result && $result->num_rows > 0): ?>

                        <?php while ($student = $result->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo $student['id']; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student['name']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student['email']); ?>
                                </td>

                                <td>
                                    <?php echo $student['student_number']; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student['class']); ?>
                                </td>

                                <td>

                                    <a href="edit_student.php?id=<?php echo $student['id']; ?>"
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil"></i>
                                        Edit
                                    </a>

                                    <a href="delete_student.php?id=<?php echo $student['id']; ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this student?');">
                                        <i class="bi bi-trash"></i>
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="6"
                                class="text-center text-muted py-4">
                                No students found.
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