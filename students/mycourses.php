<?php
session_start();
include '../connect.php';
include '../header.php';

// التأكد من معرف الطالب من السيشن
$student_id = $_SESSION['student_id'] ?? 1;

$query = "SELECT courses.*, enrollments.id as enrollment_id FROM courses 
          JOIN enrollments ON courses.id = enrollments.course_id 
          WHERE enrollments.student_id = '$student_id'";
$result = mysqli_query($conn, $query);
?>

<div class="container my-5" style="min-height: 70vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">My Enrolled Courses</h2>
        <!-- ربط زر الإضافة بصفحة الكورسات الرئيسية المترابطة بالمشروع -->
        <a href="../courses.php" class="btn btn-success fw-bold">
            <i class="fa-solid fa-plus me-1"></i> Add / Enroll New Course
        </a>
    </div>

    <div class="row g-4">
        <?php if($result && mysqli_num_rows($result) > 0): ?>
            <?php while($course = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                        <img src="../images/<?php echo $course['image'] ?? 'default.jpg'; ?>" class="card-img-top" alt="Course Image">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?php echo $course['title']; ?></h5>
                            <p class="card-text text-muted"><?php echo substr($course['description'], 0, 90); ?>...</p>
                            
                            <div class="mt-auto pt-3">
                                <a href="course_details.php?id=<?php echo $course['id']; ?>" class="btn btn-warning w-100 fw-bold text-white mb-2">
                                    Continue Learning
                                </a>
                                
                                <div class="d-flex gap-2">
                                    <a href="edit_course.php?id=<?php echo $course['id']; ?>" class="btn btn-sm btn-outline-primary w-50 fw-bold">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <a href="delete_course.php?enrollment_id=<?php echo $course['enrollment_id']; ?>" class="btn btn-sm btn-outline-danger w-50 fw-bold" onclick="return confirm('Are you sure you want to remove this course?');">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <!-- تعديل الرابط ليخرج خارج مجلد students ويربط بالصفحة الرئيسية للمشروع -->
            <div class="col-12 text-center py-5">
                <h4 class="text-muted">You have not enrolled in any courses yet.</h4>
                <a href="../courses.php" class="btn btn-warning text-white mt-3 fw-bold">
                    <i class="fa-solid fa-magnifying-glass me-1"></i> Explore Courses
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../footer.php'; ?>