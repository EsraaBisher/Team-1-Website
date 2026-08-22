<?php
session_start();
include '../connect.php';
include '../header.php';

$student_id = $_SESSION['student_id'] ?? 1;

$user_query = "SELECT * FROM students WHERE id = '$student_id'";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);

$count_query = "SELECT COUNT(*) as total FROM enrollments WHERE student_id = '$student_id'";
$count_result = mysqli_query($conn, $count_query);
$total_courses = mysqli_fetch_assoc($count_result)['total'];
?>

<div class="container my-5" style="min-height: 70vh;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-4">
                <div class="text-center mb-4">
                    <div class="rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; font-size: 36px;">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h3 class="fw-bold"><?php echo $user['name'] ?? 'Student Name'; ?></h3>
                    <p class="text-muted"><?php echo $user['email'] ?? 'student@example.com'; ?></p>
                </div>
                <hr>
                <div class="row text-center my-3">
                    <div class="col-6">
                        <h4 class="fw-bold text-warning"><?php echo $total_courses; ?></h4>
                        <p class="text-muted mb-0">Enrolled Courses</p>
                    </div>
                    <div class="col-6">
                        <h4 class="fw-bold text-warning">Student</h4>
                        <p class="text-muted mb-0">Account Role</p>
                    </div>
                </div>
                <hr>
                <!-- أزرار التحكم والتعديل للحساب -->
                <div class="mt-4 d-flex justify-content-center gap-2 wrap flex-wrap">
                    <a href="mycourses.php" class="btn btn-warning text-white fw-bold">
                        <i class="fa-solid fa-book me-1"></i> My Courses
                    </a>
                    <a href="edit_profile.php" class="btn btn-primary fw-bold">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit Profile
                    </a>
                    <a href="delete_profile.php" class="btn btn-danger fw-bold" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                        <i class="fa-solid fa-trash me-1"></i> Delete Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>