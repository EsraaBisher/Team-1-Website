<?php
session_start();
include '../header.php';
?>

<div class="container my-5" style="min-height: 70vh;">
    <h2 class="fw-bold mb-4">Student Dashboard</h2>
    <div class="row g-4">
        <!-- قسم الكورسات -->
        <div class="col-md-6">
            <div class="card p-4 shadow-sm border-0 text-center h-100">
                <i class="fa-solid fa-graduation-cap fs-1 text-warning mb-3"></i>
                <h4 class="fw-bold">My Courses</h4>
                <p class="text-muted">Access your enrolled courses, register for new ones, and manage them.</p>
                <div class="d-flex justify-content-center gap-2 mt-auto">
                    <a href="mycourses.php" class="btn btn-warning text-white fw-bold">
                        <i class="fa-solid fa-eye me-1"></i> View Courses
                    </a>
                    <a href="enroll.php" class="btn btn-success fw-bold">
                        <i class="fa-solid fa-plus me-1"></i> Enroll / Add
                    </a>
                </div>
            </div>
        </div>

        <!-- قسم الملف الشخصي -->
        <div class="col-md-6">
            <div class="card p-4 shadow-sm border-0 text-center h-100">
                <i class="fa-solid fa-id-card fs-1 text-warning mb-3"></i>
                <h4 class="fw-bold">My Profile</h4>
                <p class="text-muted">Manage your personal information and update your profile settings.</p>
                <div class="d-flex justify-content-center gap-2 mt-auto">
                    <a href="profile.php" class="btn btn-warning text-white fw-bold">
                        <i class="fa-solid fa-user me-1"></i> View Profile
                    </a>
                    <a href="edit_profile.php" class="btn btn-primary fw-bold">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>