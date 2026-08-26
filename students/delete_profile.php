<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include '../connect2.php';

$db = new Connect2();
$conn = $db->getConnection();

$session_id = $_SESSION['user_id'] ?? $_SESSION['student_id'] ?? 1;
$safe_id = $conn->real_escape_string($session_id);

// Remove student record first, then the user record
$db->update("DELETE FROM students WHERE user_id = '$safe_id' OR id = '$safe_id'");
$delete_user = "DELETE FROM users WHERE id = '$safe_id'";

if ($db->update($delete_user)) {
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
