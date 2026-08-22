<?php
session_start();

// استقبال كود الكورس
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    
    // إنشاء مصفوفة الكورسات في السشن لو مش موجودة
    if (!isset($_SESSION['my_courses'])) {
        $_SESSION['my_courses'] = [];
    }
    
    // إضافة الكورس
    if (!in_array($course_id, $_SESSION['my_courses'])) {
        $_SESSION['my_courses'][] = $course_id;
    }
    
    // إظهار رسالة والتحويل لصفحة الكورسات
    echo "<script>
            alert('Enrolled Successfully!');
            window.location.href = 'mycourses.php';
          </script>";
    exit();
} else {
    header("Location: courses.php");
    exit();
}
?>