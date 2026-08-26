<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../connect2.php';
include '../header.php';

$db = new Connect2();
$conn = $db->getConnection();

// Fetch session user ID
$session_id = $_SESSION['user_id'] ?? $_SESSION['student_id'] ?? 1;
$safe_id = $conn->real_escape_string($session_id);

// Query user details joined with student data
$user_query = "SELECT users.*, students.class 
              FROM users 
              LEFT JOIN students ON users.id = students.user_id 
              WHERE users.id = '$safe_id' OR students.id = '$safe_id' 
              LIMIT 1";

$users = $db->query($user_query);
$user = (!empty($users) && is_array($users)) ? $users[0] : [];

$display_name = $user['name'] ?? $_SESSION['name'] ?? 'Student';
$class_info = $user['class'] ?? '';
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Fix Navbar Links
        const navLinks = document.querySelectorAll("nav a");

        navLinks.forEach(function(link) {

            const href = link.getAttribute("href");

            if (href === "index.php") {
                link.href = "../index.php";
            } else if (href === "about.php") {
                link.href = "../about.php";
            } else if (href === "courses.php") {
                link.href = "../courses.php";
            } else if (href === "pricing.php") {
                link.href = "../pricing.php";
            } else if (href === "login.php") {
                link.href = "../login.php";
            } else if (href === "register.php") {
                link.href = "../register.php";
            } else if (href === "logout.php") {
                link.href = "../logout.php";
            }

        });


        // Fix Footer Links
        const footerLinks = document.querySelectorAll("footer a");

        footerLinks.forEach(function(link) {

            const href = link.getAttribute("href");

            if (href === "index.php") {
                link.href = "../index.php";
            } else if (href === "about.php") {
                link.href = "../about.php";
            } else if (href === "courses.php") {
                link.href = "../courses.php";
            } else if (href === "pricing.php") {
                link.href = "../pricing.php";
            } else if (href === "login.php") {
                link.href = "../login.php";
            } else if (href === "register.php") {
                link.href = "../register.php";
            } else if (href === "logout.php") {
                link.href = "../logout.php";
            }

        });

    });
</script>


<style>
    .student-dashboard {
        background: #f8f9fa;
        min-height: 75vh;
    }

    .dashboard-header {
        background: linear-gradient(135deg, #262626, #3b3b3b);
        border-radius: 20px;
        padding: 35px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 149, 0, 0.15);
        right: -60px;
        top: -80px;
    }

    .dashboard-header h1 {
        font-weight: 700;
        position: relative;
        z-index: 2;
    }

    .dashboard-header p {
        color: #d5d5d5;
        position: relative;
        z-index: 2;
    }

    .dashboard-card {
        border: none;
        border-radius: 20px;
        background: white;
        padding: 30px;
        height: 100%;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.10);
    }

    .dashboard-icon {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff3df;
        color: #FF9500;
        font-size: 28px;
        margin-bottom: 20px;
    }

    .dashboard-card h4 {
        font-weight: 700;
        margin-bottom: 10px;
    }

    .dashboard-card p {
        color: #777;
        line-height: 1.7;
        min-height: 55px;
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

    .quick-title {
        font-weight: 700;
        margin-bottom: 20px;
    }

    .quick-link {
        background: white;
        border-radius: 15px;
        padding: 18px 20px;
        text-decoration: none;
        color: #262626;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
    }

    .quick-link:hover {
        transform: translateY(-3px);
        color: #FF9500;
    }

    .quick-link i {
        color: #FF9500;
        font-size: 22px;
    }
</style>


<div class="student-dashboard py-5">

    <div class="container">

        <!-- ================= HEADER ================= -->

        <div class="dashboard-header mb-5">

            <h1>
                Welcome, <?php echo htmlspecialchars($display_name); ?> 👋
            </h1>

            <p class="mb-0">
                Manage your courses and profile from your dashboard.
                <?php if (!empty($class_info)): ?>
                    <span class="badge bg-warning text-dark ms-2">Class: <?php echo htmlspecialchars($class_info); ?></span>
                <?php endif; ?>
            </p>

        </div>


        <!-- ================= MAIN CARDS ================= -->

        <div class="row g-4">


            <!-- MY COURSES -->

            <div class="col-lg-6">

                <div class="dashboard-card">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-graduation-cap"></i>

                    </div>

                    <h4>
                        My Courses
                    </h4>

                    <p>
                        View your enrolled courses, explore new courses,
                        and manage your learning journey easily.
                    </p>

                    <div class="d-flex gap-2 mt-4">

                        <a
                            href="mycourses.php"
                            class="btn btn-orange px-4 fw-bold">

                            <i class="fa-solid fa-book-open me-2"></i>
                            View Courses

                        </a>

                        <a
                            href="../courses.php"
                            class="btn btn-outline-success px-4 fw-bold">

                            <i class="fa-solid fa-plus me-2"></i>
                            Enroll

                        </a>

                    </div>

                </div>

            </div>


            <!-- MY PROFILE -->

            <div class="col-lg-6">

                <div class="dashboard-card">

                    <div class="dashboard-icon">

                        <i class="fa-solid fa-user"></i>

                    </div>

                    <h4>
                        My Profile
                    </h4>

                    <p>
                        View your personal information and keep your
                        student profile up to date.
                    </p>

                    <div class="d-flex gap-2 mt-4">

                        <a
                            href="profile.php"
                            class="btn btn-orange px-4 fw-bold">

                            <i class="fa-solid fa-user me-2"></i>
                            View Profile

                        </a>

                        <a
                            href="edit_profile.php"
                            class="btn btn-outline-primary px-4 fw-bold">

                            <i class="fa-solid fa-pen me-2"></i>
                            Edit

                        </a>

                    </div>

                </div>

            </div>

        </div>


    </div>

</div>

<script src="../bootstrap/assets/js/bootstrap.bundle.min.js"></script>
<?php
include '../footer.php';
?>