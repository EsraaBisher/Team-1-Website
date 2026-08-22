<?php
session_start();
include 'connect.php';
include 'header.php';

$student_id = $_SESSION['student_id'] ?? 1;

$query = "SELECT courses.* FROM courses 
          JOIN enrollments ON courses.id = enrollments.course_id 
          WHERE enrollments.student_id = '$student_id'";
$result = mysqli_query($conn, $query);
?>

<div class="container my-5" style="min-height: 70vh;">
    <h2 class="fw-bold mb-4">My Enrolled Courses</h2>
    <div class="row g-4">
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($course = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="images/<?php echo $course['image'] ?? 'default.jpg'; ?>" class="card-img-top" alt="Course Image">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $course['title']; ?></h5>
                            <p class="card-text text-muted"><?php echo substr($course['description'], 0, 90); ?>...</p>
                            <a href="course_details.php?id=<?php echo $course['id']; ?>" class="btn btn-warning w-100 fw-bold text-white">Continue Learning</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <h4>You have not enrolled in any courses yet.</h4>
                <a href="courses.php" class="btn btn-warning text-white mt-3 fw-bold">Explore Courses</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>