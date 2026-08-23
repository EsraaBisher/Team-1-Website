<?php

include '../connect.php';

// الحصول على ID الطالب الحالي من السيشن
$student_id = $_SESSION['student_id'] ?? 1;

// حذف بيانات الطالب من جدول الطلاب
$query = "DELETE FROM students WHERE id = '$student_id'";

if (mysqli_query($conn, $query)) {
    // إنهاء الجلسة وتسجيل الخروج
    session_destroy();
    echo "<script>
            alert('Your account has been deleted successfully.');
            window.location.href = '../index.php';
          </script>";
} else {
    echo "<script>
            alert('Error deleting account. Please try again.');
            window.location.href = 'profile.php';
          </script>";
}
?>