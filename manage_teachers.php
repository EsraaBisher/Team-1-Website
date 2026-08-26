<?php
include "connect.php";
$sql = "SELECT teachers.id, teachers.phone, teachers.subject,
               users.name, users.email
        FROM teachers
        JOIN users ON teachers.user_id = users.id";
$result = $conn->query($sql);

include "header.php";
?>

<div class="container py-5">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">

        <div>
            <h1 class="fw-bold mb-2">
                Manage Teachers
            </h1>

            <p class="text-muted mb-0">
                View and manage all teachers.
            </p>
        </div>

        <div class="d-flex gap-2">

            <!-- Add Teacher -->
            <a href="add_teacher.php"
               class="btn text-white fw-medium"
               style="background-color: #FF9500;">

                <i class="bi bi-plus-lg me-1"></i>
                Add Teacher

            </a>

            <!-- Dashboard -->
            <a href="admin_dashboard.php"
               class="btn btn-outline-secondary fw-medium">

                <i class="bi bi-arrow-left me-1"></i>
                Dashboard

            </a>

        </div>

    </div>


    <!-- Teachers Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

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
                                Phone
                            </th>

                            <th class="py-3">
                                Subject
                            </th>

                            <th class="py-3 pe-4">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if ($result && $result->num_rows > 0): ?>

                        <?php while ($teacher = $result->fetch_assoc()): ?>

                            <tr>

                                <!-- ID -->
                                <td class="px-4 fw-medium">
                                    <?php echo $teacher['id']; ?>
                                </td>


                                <!-- Name -->
                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <i class="bi bi-person-circle fs-4 text-muted"></i>

                                        <span class="fw-semibold">
                                            <?php echo htmlspecialchars($teacher['name']); ?>
                                        </span>

                                    </div>

                                </td>


                                <!-- Email -->
                                <td>
                                    <?php echo htmlspecialchars($teacher['email']); ?>
                                </td>


                                <!-- Phone -->
                                <td>

                                    <span class="text-nowrap">
                                        <i class="bi bi-telephone me-1 text-muted"></i>

                                        <?php echo htmlspecialchars($teacher['phone']); ?>
                                    </span>

                                </td>


                                <!-- Subject -->
                                <td>

                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        <?php echo htmlspecialchars($teacher['subject']); ?>
                                    </span>

                                </td>


                                <!-- Actions -->
                                <td class="pe-4">

                                    <div class="d-flex gap-2">

                                        <!-- Edit -->
                                        <a
                                            href="edit_teacher.php?id=<?php echo $teacher['id']; ?>"
                                            class="btn btn-sm btn-outline-secondary"
                                        >

                                            <i class="bi bi-pencil me-1"></i>
                                            Edit

                                        </a>


                                        <!-- Delete -->
                                        <a
                                            href="delete_teacher.php?id=<?php echo $teacher['id']; ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this teacher?');"
                                        >

                                            <i class="bi bi-trash me-1"></i>
                                            Delete

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endwhile; ?>


                    <?php else: ?>

                        <!-- Empty State -->
                        <tr>

                            <td colspan="6"
                                class="text-center py-5">

                                <div class="mb-3">

                                    <i class="bi bi-person-workspace fs-1 text-muted"></i>

                                </div>

                                <h5 class="fw-bold">
                                    No Teachers Found
                                </h5>

                                <p class="text-muted mb-3">
                                    There are no teachers available yet.
                                </p>

                                <a
                                    href="add_teacher.php"
                                    class="btn text-white"
                                    style="background-color: #FF9500;"
                                >

                                    <i class="bi bi-plus-lg me-1"></i>
                                    Add Teacher

                                </a>

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