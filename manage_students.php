<?php
include "connect.php";

$sql = "SELECT students.id, students.student_number, students.class,
               students.user_id, users.name, users.email
        FROM students
        JOIN users ON students.user_id = users.id";

$result = $conn->query($sql);

include "header.php";
?>

<div class="container py-5">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row
                justify-content-between
                align-items-md-center
                gap-3
                mb-4">

        <div>
            <h1 class="fw-bold mb-1">
                Manage Students
            </h1>

            <p class="text-muted mb-0">
                View and manage all registered students.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="admin_dashboard.php"
               class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left me-1"></i>
                Dashboard

            </a>

            <a href="add_student.php"
               class="btn admin-primary-btn">

                <i class="bi bi-plus-lg me-1"></i>
                Add Student

            </a>

        </div>

    </div>


    <!-- Students Table -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-4 py-3">
                                ID
                            </th>

                            <th class="py-3">
                                Name
                            </th>

                            <th class="py-3">
                                Email
                            </th>

                            <th class="py-3">
                                Student Number
                            </th>

                            <th class="py-3">
                                Class
                            </th>

                            <th class="py-3 pe-4">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if ($result && $result->num_rows > 0): ?>

                        <?php while ($student = $result->fetch_assoc()): ?>

                            <tr>

                                <td class="px-4 fw-medium">
                                    <?= $student['id'] ?>
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        <?= htmlspecialchars($student['name']) ?>
                                    </span>
                                </td>

                                <td class="text-muted">
                                    <?= htmlspecialchars($student['email']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($student['student_number']) ?>
                                </td>

                                <td>

                                    <span class="badge text-bg-light">
                                        <?= htmlspecialchars($student['class']) ?>
                                    </span>

                                </td>

                                <td class="pe-4">

                                    <div class="d-flex flex-wrap gap-2">

                                        <a href="edit_student.php?id=<?= $student['id'] ?>"
                                           class="btn btn-sm btn-outline-primary">

                                            <i class="bi bi-pencil me-1"></i>
                                            Edit

                                        </a>


                                        <a href="delete_student.php?id=<?= $student['id'] ?>"
                                           class="btn btn-sm btn-outline-danger"
                                           onclick="return confirm('Are you sure you want to delete this student?');">

                                            <i class="bi bi-trash me-1"></i>
                                            Delete

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6"
                                class="text-center text-muted py-5">

                                <i class="bi bi-people fs-1 d-block mb-3"></i>

                                <h5 class="fw-semibold">
                                    No students found
                                </h5>

                                <p class="mb-0">
                                    There are currently no students to display.
                                </p>

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php
include "footer.php";
?>