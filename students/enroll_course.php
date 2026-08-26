<?php

include '../connect.php';

// التأكد من تسجيل دخول الطالب ومكانه في السيشن
$student_id = $_SESSION['student_id'] ?? 1;

// استقبال كود الكورس المراد إضافته
if (isset($_GET['course_id'])) {
    $course_id = mysqli_real_escape_string($conn, $_GET['course_id']);

    // 1. التحقق مما إذا كان الكورس مضافاً بالفعل للـ Student
    $check_query = "SELECT * FROM enrollments WHERE student_id = '$student_id' AND course_id = '$course_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // الكورس مضاف مسبقاً
        echo "<script>
                alert('You are already enrolled in this course!');
                window.location.href = 'mycourses.php';
              </script>";
    } else {
        // 2. تنفيذ عملية الإضافة (Add / Enroll) في قاعدة البيانات
        $insert_query = "INSERT INTO enrollments (student_id, course_id) VALUES ('$student_id', '$course_id')";

        if (mysqli_query($conn, $insert_query)) {
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
    // في حال عدم وجود course_id يتم التوجيه لصفحة الكورسات
    header("Location: mycourses.php");
    exit();
}
