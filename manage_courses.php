<?php
include "connect.php";

$sql = "SELECT courses.id, courses.name, courses.hours, courses.image,
               users.name AS teacher_name
        FROM courses
        JOIN teachers ON courses.teacher_id = teachers.id
        JOIN users ON teachers.user_id = users.id";

$result = $conn->query($sql);

include "header.php";
?>

<div class="container py-5">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5">

        <div>
            <h1 class="fw-bold mb-2">
                Manage Courses
            </h1>

            <p class="text-muted mb-0">
                View and manage all courses.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="add_course.php"
               class="btn text-white fw-medium"
               style="background-color: #FF9500;">

                <i class="bi bi-plus-lg me-1"></i>
                Add Course

            </a>

            <a href="admin_dashboard.php"
               class="btn btn-outline-secondary fw-medium">

                <i class="bi bi-arrow-left me-1"></i>
                Dashboard

            </a>

        </div>

    </div>


    <!-- Courses Table Card -->
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
                                Image
                            </th>

                            <th class="py-3">
                                Course Name
                            </th>

                            <th class="py-3">
                                Hours
                            </th>

                            <th class="py-3">
                                Teacher
                            </th>

                            <th class="py-3 pe-4">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if ($result && $result->num_rows > 0): ?>

                        <?php while ($course = $result->fetch_assoc()): ?>

                            <tr>

                                <!-- ID -->
                                <td class="px-4 fw-medium">
                                    <?php echo $course['id']; ?>
                                </td>


                                <!-- Image -->
                                <td>

                                    <?php if (!empty($course['image'])): ?>

                                        <img
                                            src="upload/<?php echo htmlspecialchars($course['image']); ?>"
                                            alt="Course Image"
                                            class="rounded-3"
                                            style="
                                                width: 60px;
                                                height: 60px;
                                                object-fit: cover;
                                            "
                                        >

                                    <?php else: ?>

                                        <div
                                            class="d-flex align-items-center justify-content-center bg-light rounded-3"
                                            style="
                                                width: 60px;
                                                height: 60px;
                                            "
                                        >
                                            <i class="bi bi-book text-muted fs-4"></i>
                                        </div>

                                    <?php endif; ?>

                                </td>


                                <!-- Course Name -->
                                <td>

                                    <span class="fw-semibold">
                                        <?php echo htmlspecialchars($course['name']); ?>
                                    </span>

                                </td>


                                <!-- Hours -->
                                <td>

                                    <span class="badge bg-light text-dark border px-3 py-2">
                                        <?php echo htmlspecialchars($course['hours']); ?> Hours
                                    </span>

                                </td>


                                <!-- Teacher -->
                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <i class="bi bi-person-circle text-muted"></i>

                                        <span>
                                            <?php echo htmlspecialchars($course['teacher_name']); ?>
                                        </span>

                                    </div>

                                </td>


                                <!-- Actions -->
                                <td class="pe-4">

                                    <div class="d-flex gap-2">

                                        <!-- Edit -->
                                        <a
                                            href="edit_course.php?id=<?php echo $course['id']; ?>"
                                            class="btn btn-sm btn-outline-secondary"
                                        >

                                            <i class="bi bi-pencil me-1"></i>
                                            Edit

                                        </a>


                                        <!-- Delete -->
                                        <a
                                            href="delete_course.php?id=<?php echo $course['id']; ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this course?');"
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

                                    <i class="bi bi-book fs-1 text-muted"></i>

                                </div>

                                <h5 class="fw-bold">
                                    No Courses Found
                                </h5>

                                <p class="text-muted mb-3">
                                    There are no courses available yet.
                                </p>

                                <a
                                    href="add_course.php"
                                    class="btn text-white"
                                    style="background-color: #FF9500;"
                                >
                                    <i class="bi bi-plus-lg me-1"></i>
                                    Add Course
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