<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../connect2.php';
include '../header.php';

$db = new Connect2();
$conn = $db->getConnection();

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

    if (!preg_match('#[/\\\\]#', $value)) {
        return '/Team-1-Website/courses/' . ltrim($value, '/');
    }

    return '/Team-1-Website/' . ltrim($value, '/');
}

$user_id = (int) ($_SESSION['user_id'] ?? 0);

if ($user_id <= 0) {
    header('Location: /Team-1-Website/login.php');
    exit();
}

// First, get the student record
$student_query = "SELECT id FROM students WHERE user_id = ?";
$stmt = $conn->prepare($student_query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$student_result = $stmt->get_result();
$student_row = $student_result->fetch_assoc();

if (!$student_row) {
    $courses = [];
} else {
    $student_id = (int) $student_row['id'];
    
    // Get enrolled courses
    $query = "SELECT courses.*, teachers.user_id as teacher_user_id
              FROM courses
              JOIN enrollments ON courses.id = enrollments.course_id
              LEFT JOIN teachers ON courses.teacher_id = teachers.id
              WHERE enrollments.student_id = ?
              ORDER BY enrollments.id DESC";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $student_id);
    $stmt->execute();
    $courses = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll("nav a");
        navLinks.forEach(function(link) {
            const href = link.getAttribute("href");
            if (href === "index.php") link.href = "../index.php";
            else if (href === "about.php") link.href = "../about.php";
            else if (href === "courses.php") link.href = "../courses.php";
            else if (href === "pricing.php") link.href = "../pricing.php";
            else if (href === "login.php") link.href = "../login.php";
            else if (href === "register.php") link.href = "../register.php";
            else if (href === "logout.php") link.href = "../logout.php";
        });

        const footerLinks = document.querySelectorAll("footer a");
        footerLinks.forEach(function(link) {
            const href = link.getAttribute("href");
            if (href === "index.php") link.href = "../index.php";
            else if (href === "about.php") link.href = "../about.php";
            else if (href === "courses.php") link.href = "../courses.php";
            else if (href === "pricing.php") link.href = "../pricing.php";
            else if (href === "login.php") link.href = "../login.php";
            else if (href === "register.php") link.href = "../register.php";
            else if (href === "logout.php") link.href = "../logout.php";
        });
    });
</script>

<style>
    .courses-page {
        background: #f8f9fa;
        min-height: 75vh;
    }

    .courses-header {
        background: linear-gradient(135deg, #262626, #414141);
        border-radius: 22px;
        padding: 35px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .courses-header::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border-radius: 50%;
        background: rgba(255, 149, 0, 0.15);
        right: -60px;
        top: -100px;
    }

    .courses-header h1,
    .courses-header p {
        position: relative;
        z-index: 2;
    }

    .courses-header h1 {
        font-weight: 700;
    }

    .courses-header p {
        color: #d5d5d5;
    }

    .course-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: white;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    .course-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.10);
    }

    .course-image {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }

    .course-body {
        padding: 22px;
    }

    .course-title {
        font-weight: 700;
        color: #262626;
    }

    .course-description {
        color: #777;
        line-height: 1.6;
        min-height: 50px;
    }

    .btn-orange {
        background-color: #FF9500;
        border: none;
        color: white;
    }

    .btn-orange:hover {
        background-color: #e88600;
        color: white;
    }

    .empty-courses {
        background: white;
        border-radius: 20px;
        padding: 60px 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #fff3df;
        color: #FF9500;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin: 0 auto 20px;
    }
</style>

<div class="courses-page py-5">
    <div class="container">
        <div class="courses-header mb-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h1 class="mb-2">My Courses</h1>
                    <p class="mb-0">Continue your learning journey and manage your enrolled courses.</p>
                </div>
                <a href="../courses.php" class="btn btn-warning fw-bold px-4">
                    <i class="fa-solid fa-plus me-2"></i> Explore Courses
                </a>
            </div>
        </div>

        <div class="row g-4">
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="course-card h-100 d-flex flex-column">
                            <img src="<?php echo htmlspecialchars(safeCourseImageUrl($course['image'] ?? '', '/Team-1-Website/bootstrap/assets/image/avatar.webp')); ?>" class="course-image" alt="Course Image">
                            <div class="course-body d-flex flex-column flex-grow-1">
                                <h5 class="course-title mb-2">
                                    <?php echo htmlspecialchars($course['name'] ?? ''); ?>
                                </h5>
                                <p class="course-description mb-3">
                                    <?php
                                    $description = $course['description'] ?? '';
                                    echo htmlspecialchars(substr($description, 0, 100));
                                    if (strlen($description) > 100) echo "...";
                                    ?>
                                </p>
                                <div class="mt-auto">
                                    <a href="/Team-1-Website/students/course_details.php?id=<?php echo $course['id']; ?>" class="btn btn-orange w-100 fw-bold">
                                        <i class="fa-solid fa-play me-2"></i> Continue Learning
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-courses text-center">
                        <div class="empty-icon"><i class="fa-solid fa-book-open"></i></div>
                        <h4 class="fw-bold">No Courses Yet</h4>
                        <p class="text-muted mb-4">You haven't enrolled in any courses yet. Explore our courses and start learning today.</p>
                        <a href="../courses.php" class="btn btn-orange px-4 fw-bold">
                            <i class="fa-solid fa-magnifying-glass me-2"></i> Explore Courses
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="../bootstrap/assets/js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>