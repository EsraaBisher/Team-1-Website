<?php
include "connect.php";

$sql = "SELECT teachers.id, teachers.phone, teachers.subject,
               users.name, users.email
        FROM teachers
        JOIN users ON teachers.user_id = users.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Teachers</title>

    <link rel="stylesheet" href="./bootstrap/assets/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="fw-bold">Manage Teachers</h1>
            <p class="text-muted">View and manage teachers</p>
        </div>

        <div>

            <a href="add_teacher.php" class="btn btn-success">
                <i class="bi bi-plus-lg"></i>
                Add Teacher
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
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php if ($result->num_rows > 0): ?>

                        <?php while ($teacher = $result->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo $teacher['id']; ?>
                                </td>

                                <td>
                                    <?php echo $teacher['name']; ?>
                                </td>

                                <td>
                                    <?php echo $teacher['email']; ?>
                                </td>

                                <td>
                                    <?php echo $teacher['phone']; ?>
                                </td>

                                <td>
                                    <?php echo $teacher['subject']; ?>
                                </td>

                                <td>

                                    <a href="edit_teacher.php?id=<?php echo $teacher['id']; ?>"
                                       class="btn btn-sm btn-primary">
                                        Edit
                                    </a>

                                    <a href="delete_teacher.php?id=<?php echo $teacher['id']; ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure you want to delete this teacher?');">
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6"
                                class="text-center text-muted py-4">

                                No teachers found.

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