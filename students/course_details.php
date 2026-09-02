<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /Team-1-Website/login.php');
    exit();
}

include '../connect2.php';
include '../header.php';

function safeCourseImageUrl($rawValue, $fallback = '/Team-1-Website/bootstrap/assets/image/avatar.webp')
{
    $value = trim((string) ($rawValue ?? ''));

    if ($value === '') {
        return $fallback;
    }

    if (preg_match('/^https?:\/\//i', $value) || preg_match('/^data:image\//i', $value)) {
        return $value;
    }

    $value = str_replace('\\', '/', $value);

    if (preg_match('/^\//', $value)) {
        return $value;
    }

    if (preg_match('#^upload/#i', $value)) {
        return '/Team-1-Website/' . $value;
    }

    // If no path separators and looks like a simple filename, assume it's in /courses/
    if (!preg_match('#[/\\\\]#', $value)) {
        return '/Team-1-Website/courses/' . $value;
    }

    return '/Team-1-Website/' . ltrim($value, '/');
}

$db = new Connect2();
$conn = $db->getConnection();

$courseId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($courseId <= 0) {
    echo '<div class="container py-5"><div class="alert alert-danger">Invalid course ID.</div></div>';
    include '../footer.php';
    exit();
}

$query = "SELECT * FROM courses WHERE id = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $courseId);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();

if (!$course) {
    echo '<div class="container py-5"><div class="alert alert-warning">Course not found.</div></div>';
    include '../footer.php';
    exit();
}

$teacherName = 'Unknown Teacher';
$teacherQuery = "SELECT users.name FROM teachers JOIN users ON teachers.user_id = users.id WHERE teachers.id = ? LIMIT 1";
$teacherStmt = $conn->prepare($teacherQuery);
$teacherStmt->bind_param('i', $course['teacher_id']);
$teacherStmt->execute();
$teacherResult = $teacherStmt->get_result();
if ($teacherRow = $teacherResult->fetch_assoc()) {
    $teacherName = $teacherRow['name'];
}

$image = safeCourseImageUrl($course['image'] ?? '', '/Team-1-Website/bootstrap/assets/image/avatar.webp');
$avatar = safeCourseImageUrl($course['avatar'] ?? '', '/Team-1-Website/bootstrap/assets/image/avatar.webp');
$description = !empty($course['description']) ? $course['description'] : 'No description available.';
?>

<div class="container py-5">
    <div class="card border-0 shadow rounded-4 overflow-hidden">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($course['name']) ?>" class="img-fluid h-100 w-100" style="object-fit: cover; min-height: 350px;">
            </div>
            <div class="col-md-7">
                <div class="p-4 p-md-5">
                    <h2 class="fw-bold mb-3"><?= htmlspecialchars($course['name']) ?></h2>
                    <p class="text-muted mb-4"><?= nl2br(htmlspecialchars($description)) ?></p>

                    <div class="d-flex align-items-center mb-4">
                        <img src="<?= htmlspecialchars($avatar) ?>" class="rounded-circle border me-3" width="55" height="55" alt="Avatar">
                        <div>
                            <div class="fw-bold">Instructor</div>
                            <div class="text-muted"><?= htmlspecialchars($teacherName) ?></div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-clock-fill text-warning fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Duration</div>
                            <div class="text-muted"><?= (int) $course['hours'] ?> Hours</div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="mycourses.php" class="btn btn-secondary px-4">Back</a>
                        <a href="/Team-1-Website/students/enroll_course.php?course_id=<?= $courseId ?>" class="btn text-white px-4" style="background-color:#FF9500;">Enroll Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>
