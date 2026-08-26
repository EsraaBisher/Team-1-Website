<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../connect2.php';
include '../header.php';

$db = new Connect2();
$conn = $db->getConnection();

// Get ID from session (check user_id or student_id)
$session_id = $_SESSION['user_id'] ?? $_SESSION['student_id'] ?? 1;
$safe_id = $conn->real_escape_string($session_id);

// JOIN users and students tables using user_id foreign key
$user_query = "SELECT users.*, students.id AS student_tbl_id, students.student_number, students.class 
              FROM users 
              LEFT JOIN students ON users.id = students.user_id 
              WHERE users.id = '$safe_id' OR students.id = '$safe_id' 
              LIMIT 1";

$users = $db->query($user_query);
$user = (!empty($users) && is_array($users)) ? $users[0] : [];

// Display variables based on your users database structure
$display_name = $user['name'] ?? $_SESSION['name'] ?? 'Student';
$display_email = $user['email'] ?? $_SESSION['email'] ?? 'Not set';
$display_role = ucfirst($user['role'] ?? 'student');
$display_id = $user['student_number'] ?? $user['student_tbl_id'] ?? $user['id'] ?? $safe_id;

// Count enrolled courses for this student
$student_id_for_enrollment = $user['student_tbl_id'] ?? $safe_id;
$count_query = "SELECT COUNT(*) as total FROM enrollments WHERE student_id = '$student_id_for_enrollment' OR student_id = '$safe_id'";
$count_result = $db->query($count_query);
$total_courses = (!empty($count_result) && isset($count_result[0]['total'])) ? $count_result[0]['total'] : 0;
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
    .profile-page {
        background: #f8f9fa;
        min-height: 75vh;
    }

    .profile-card {
        background: white;
        border: none;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
    }

    .profile-cover {
        height: 150px;
        background: linear-gradient(135deg, #262626, #414141);
        position: relative;
    }

    .profile-cover::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 149, 0, 0.15);
        right: -50px;
        top: -100px;
    }

    .profile-avatar {
        width: 115px;
        height: 115px;
        border-radius: 50%;
        background: #fff3df;
        color: #FF9500;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 45px;
        border: 6px solid white;
        position: absolute;
        bottom: -55px;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-content {
        padding: 75px 35px 35px;
    }

    .profile-name {
        font-weight: 700;
        color: #262626;
    }

    .profile-email {
        color: #777;
    }

    .info-box {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 20px;
        height: 100%;
    }

    .info-box i {
        color: #FF9500;
        font-size: 22px;
    }

    .info-label {
        font-size: 13px;
        color: #888;
        margin-bottom: 5px;
    }

    .info-value {
        font-weight: 600;
        color: #262626;
    }

    .stat-box {
        background: #fff8ed;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
    }

    .stat-number {
        color: #FF9500;
        font-size: 28px;
        font-weight: 700;
    }

    .btn-orange {
        background-color: #FF9500;
        color: white;
        border: none;
    }

    .btn-orange:hover {
        background-color: #e88600;
        color: white;
    }
</style>

<div class="profile-page py-5">
    <div class="container">
        <div class="mb-4">
            <h2 class="fw-bold">My Profile</h2>
            <p class="text-muted">Manage and view your account information.</p>
        </div>

        <div class="profile-card">
            <div class="profile-cover">
                <div class="profile-avatar">
                    <?php if (!empty($user['image'])): ?>
                        <img src="../<?php echo htmlspecialchars($user['image']); ?>" alt="Profile Picture">
                    <?php else: ?>
                        <i class="fa-solid fa-user"></i>
                    <?php endif; ?>
                </div>
            </div>

            <div class="profile-content">
                <div class="text-center mb-4">
                    <h3 class="profile-name mb-1">
                        <?php echo htmlspecialchars($display_name); ?>
                    </h3>
                    <p class="profile-email mb-0">
                        <?php echo htmlspecialchars($display_email); ?>
                    </p>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fa-solid fa-envelope"></i>
                                <div>
                                    <div class="info-label">Email</div>
                                    <div class="info-value">
                                        <?php echo htmlspecialchars($display_email); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fa-solid fa-user-gear"></i>
                                <div>
                                    <div class="info-label">Role</div>
                                    <div class="info-value">
                                        <?php echo htmlspecialchars($display_role); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fa-solid fa-graduation-cap"></i>
                                <div>
                                    <div class="info-label">Class / Grade</div>
                                    <div class="info-value">
                                        <?php echo htmlspecialchars($user['class'] ?? 'N/A'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fa-solid fa-id-card"></i>
                                <div>
                                    <div class="info-label">User / Student ID</div>
                                    <div class="info-value">
                                        <?php echo htmlspecialchars($display_id); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="stat-box">
                            <div class="stat-number"><?php echo $total_courses; ?></div>
                            <div class="text-muted">Enrolled Courses</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-box">
                            <div class="stat-number"><?php echo htmlspecialchars($display_role); ?></div>
                            <div class="text-muted">Account Status</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2 flex-wrap">
                    <a href="mycourses.php" class="btn btn-orange px-4 fw-bold">
                        <i class="fa-solid fa-book me-2"></i> My Courses
                    </a>
                    <a href="edit_profile.php" class="btn btn-primary px-4 fw-bold">
                        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
                    </a>
                    <a href="delete_profile.php" class="btn btn-danger px-4 fw-bold" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                        <i class="fa-solid fa-trash me-2"></i> Delete Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../bootstrap/assets/js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>