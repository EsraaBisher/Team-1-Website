<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../connect2.php';

$db = new Connect2();
$conn = $db->getConnection();

if (!isset($_SESSION['user_id'])) {
    header('Location: /Team-1-Website/login.php');
    exit();
}

if (($_SESSION['role'] ?? '') !== 'student') {
    echo "<script>
            alert('Only students can enroll in courses.');
            window.location.href = '/Team-1-Website/index.php';
          </script>";
    exit();
}

$user_id = (int) $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id FROM students WHERE user_id = ? LIMIT 1");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    echo "<script>
            alert('Please complete your student profile before enrolling in a course.');
            window.location.href = '/Team-1-Website/students/profile.php';
          </script>";
    exit();
}

$student_id = (int) $student['id'];

if (isset($_GET['course_id'])) {
    $course_id = (int) $_GET['course_id'];

    $check_query = "SELECT * FROM enrollments WHERE student_id = ? AND course_id = ? LIMIT 1";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param('ii', $student_id, $course_id);
    $check_stmt->execute();
    $existing = $check_stmt->get_result();

    if ($existing->num_rows > 0) {
        echo "<script>
                alert('You are already enrolled in this course!');
                window.location.href = 'mycourses.php';
              </script>";
    } else {
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
