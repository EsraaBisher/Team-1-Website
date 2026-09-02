<?php
include_once "../header.php";
include_once "connect.php";

$objCon = new connect();

// Handle Delete Function
if (isset($_POST["delete_id"])) {
    if ($objCon->delete("courses", $_POST["delete_id"])) {
        header("location: index.php?delete=success");
        exit();
    }
}

// Fetch all courses with their teacher's real names
$courses = $objCon->getAllCoursesWithTeacher();

function safeAssetUrl($rawValue, $fallback)
{
    $value = trim((string) ($rawValue ?? ''));

    if ($value === '') {
        return $fallback;
    }

    if (preg_match('/^https?:\/\//i', $value) || preg_match('/^data:image\//i', $value)) {
        return $value;
    }

    $value = str_replace('\\', '/', $value);

    if (preg_match('/\/Team-1-Website\//i', $value)) {
        return '/' . ltrim(substr($value, strpos(strtolower($value), '/team-1-website/')), '/');
    }

    if (preg_match('/\/xampp\/htdocs\//i', $value)) {
        return '/' . ltrim(preg_replace('#^.*?/htdocs/#i', '', $value), '/');
    }

    if (preg_match('/^\//', $value)) {
        return $value;
    }

    if (preg_match('/^[A-Za-z]:\//', $value)) {
        return '/' . ltrim($value, '/');
    }

    // If no path separators and looks like a simple filename, assume it's in /courses/
    if (!preg_match('#[/\\\\]#', $value)) {
        return '/Team-1-Website/courses/' . $value;
    }

    return '/' . ltrim($value, '/');
}

$fallbackImage = 'data:image/svg+xml;charset=UTF-8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="800" height="500"><rect width="100%" height="100%" fill="#f5f5f5"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial" font-size="30" fill="#666">Course</text></svg>');
$fallbackAvatar = 'data:image/svg+xml;charset=UTF-8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"><rect width="100%" height="100%" rx="40" fill="#e5e7eb"/><circle cx="40" cy="30" r="14" fill="#9ca3af"/><path d="M22 60c6-12 16-18 18-18s12 6 18 18" fill="#9ca3af"/></svg>');
?>

<div class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold">Courses</h2>
        <?php if (isset($_GET["delete"]) && $_GET["delete"] == "success"): ?>
            <div class="alert alert-success">Deleted course successfully</div>
        <?php endif; ?>
        <?php if (isset($_GET["add"]) && $_GET["add"] == "success"): ?>
            <div class="alert alert-success">Added course successfully</div>
        <?php endif; ?>
        <?php if (isset($_GET["edit"]) && $_GET["edit"] == "success"): ?>
            <div class="alert alert-success">Updated course successfully</div>
        <?php endif; ?>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <?php
                    $imageSrc = safeAssetUrl($course['image'] ?? '', $fallbackImage);
                    $avatarSrc = safeAssetUrl($course['avatar'] ?? '', $fallbackAvatar);
                ?>
                <div class="col">
                    <div class="card h-100 border-1 shadow-sm rounded-4" style="border-color: #e0e0e0;">

                        <img src="<?= htmlspecialchars($imageSrc) ?>" class="card-img-top rounded-top-4" alt="<?= htmlspecialchars($course['name']) ?>" style="object-fit: cover; height: 250px;">

                        <div class="card-body d-flex flex-column mt-2">
                            <h5 class="card-title fw-bold text-end mb-2"><?= $course['name'] ?></h5>

                            <p class="card-text text-muted text-end small mb-4">
                                <?= htmlspecialchars($course['description'] ?? 'No description available.') ?>
                            </p>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center text-muted small mb-3 pb-3 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-clock me-1" viewBox="0 0 16 16">
                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                        </svg>
                                        <?= $course['hours'] ?> Hours
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <span class="me-2"><?= $course['teacher_name'] ?? 'Unknown Teacher' ?></span>
                                        <img src="<?= htmlspecialchars($avatarSrc) ?>" class="rounded-circle border" width="30" height="30" alt="Avatar">
                                    </div>
                                </div>

                                <button type="button" class="btn btn-outline-warning w-100 fw-semibold rounded-3 py-2 text-dark" data-bs-toggle="modal" data-bs-target="#modal-<?= $course['id'] ?>">
                                    Course details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Modal -->
                <div class="modal fade" id="modal-<?= $course['id'] ?>" tabindex="-1" aria-labelledby="modalLabel-<?= $course['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4 border-0 shadow">
                            <div class="modal-header border-bottom-0 pb-0">
                                <h5 class="modal-title fw-bold fs-4" id="modalLabel-<?= $course['id'] ?>"><?= $course['name'] ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pt-4">
                                <div class="row g-4">
                                    <div class="col-md-5">
                                        <img src="<?= htmlspecialchars($imageSrc) ?>" class="img-fluid rounded-4 shadow-sm" alt="<?= htmlspecialchars($course['name']) ?>" style="object-fit: cover; width: 100%; height: auto;">
                                    </div>
                                    <div class="col-md-7">
                                        <h6 class="fw-bold text-muted mb-3">About this course</h6>
                                        <p class="mb-4"><?= htmlspecialchars($course['description'] ?? 'No description available.') ?></p>

                                        <div class="d-flex align-items-center mb-3">
                                            <img src="<?= htmlspecialchars($avatarSrc) ?>" class="rounded-circle border me-3" width="50" height="50" alt="Avatar">
                                            <div>
                                                <p class="mb-0 fw-bold">Instructor</p>
                                                <p class="mb-0 text-muted"><?= $course['teacher_name'] ?? 'Unknown Teacher' ?></p>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-4">
                                            <div class="bg-light rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clock text-warning" viewBox="0 0 16 16">
                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-bold">Duration</p>
                                                <p class="mb-0 text-muted"><?= $course['hours'] ?> Hours</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 pt-0">
                                <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Close</button>

                                <!-- Only admin can edit/delete courses -->
                                <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                                    <a href="edit.php?id=<?= $course['id'] ?>" class="btn btn-success rounded-3 px-4">Edit</a>

                                    <form action="" method="POST" class="d-inline">
                                        <input type="hidden" name="delete_id" value="<?= $course['id'] ?>">
                                        <button type="submit" class="btn btn-danger rounded-3 px-4">Delete</button>
                                    </form>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['user_id']) && ($_SESSION['role'] ?? '') === 'student'): ?>
                                    <a href="/Team-1-Website/students/enroll_course.php?course_id=<?= $course['id'] ?>"
                                        class="btn btn-warning text-white rounded-3 px-4 fw-bold">
                                        Enroll Now
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center text-muted py-5">
                <h4>No courses available yet. Click "Add Course" below to create one!</h4>
            </div>
        <?php endif; ?>

    </div>

    <!-- Show Add Course only for admin/teacher -->
    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'teacher')): ?>
        <div class="text-center mt-5">
            <a href="add.php" class="btn btn-success px-5 py-2 fw-bold fs-5 rounded-3">Add Course</a>
        </div>
    <?php endif; ?>
</div>

<?php include_once "../footer.php"; ?>