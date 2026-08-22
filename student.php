<?php
session_start();
include 'header.php';
?>

<div class="container my-5" style="min-height: 70vh;">
    <h2 class="fw-bold mb-4">Student Dashboard</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card p-4 shadow-sm border-0 text-center">
                <i class="fa-solid fa-graduation-cap fs-1 text-warning mb-3"></i>
                <h4 class="fw-bold">My Courses</h4>
                <p class="text-muted">Access your enrolled courses and view your progress.</p>
                <a href="mycourses.php" class="btn btn-warning text-white fw-bold">View My Courses</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 shadow-sm border-0 text-center">
                <i class="fa-solid fa-id-card fs-1 text-warning mb-3"></i>
                <h4 class="fw-bold">My Profile</h4>
                <p class="text-muted">Manage your personal information and profile settings.</p>
                <a href="profile.php" class="btn btn-warning text-white fw-bold">View Profile</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>