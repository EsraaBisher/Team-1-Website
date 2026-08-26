<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../connect2.php';

$db = new Connect2();
$conn = $db->getConnection();

$session_id = $_SESSION['user_id'] ?? $_SESSION['student_id'] ?? 1;
$safe_id = $conn->real_escape_string($session_id);

// Resolve exact student_id from students table using user_id
$student_query = "SELECT id FROM students WHERE user_id = '$safe_id' OR id = '$safe_id' LIMIT 1";
$student_res = $db->query($student_query);
$student_id = !empty($student_res) ? $student_res[0]['id'] : $safe_id;

if (isset($_GET['course_id'])) {
    $course_id = $conn->real_escape_string($_GET['course_id']);

    // 1. Check if already enrolled
    $check_query = "SELECT * FROM enrollments WHERE student_id = '$student_id' AND course_id = '$course_id'";
    $existing = $db->query($check_query);

    if (!empty($existing)) {
        echo "<script>
                alert('You are already enrolled in this course!');
                window.location.href = 'mycourses.php';
              </script>";
    } else {
        // 2. Perform enrollment insertion
        $data = [
            'student_id' => $student_id,
            'course_id' => $course_id
        ];

        if ($db->insert($data, 'enrollments')) {
            echo "<script>
                    alert('Enrolled Successfully!');
                    window.location.href = 'mycourses.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to enroll. Please try again.');
                    window.location.href = 'mycourses.php';
                  </script>";
        }
    }
    exit();
} else {
    header("Location: mycourses.php");
    exit();
}
