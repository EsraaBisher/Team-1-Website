<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../connect2.php';
include '../header.php';

$db = new Connect2();
$conn = $db->getConnection();

$session_id = $_SESSION['user_id'] ?? $_SESSION['student_id'] ?? 1;
$safe_id = $conn->real_escape_string($session_id);

// 1. Fetch current user data from `users`
$query = "SELECT * FROM users WHERE id = '$safe_id' LIMIT 1";
$users = $db->query($query);
$user = !empty($users) ? $users[0] : [];

// 2. Handle form update submission
if (isset($_POST['update_profile'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);

    $update_query = "UPDATE users SET name = '$name', email = '$email' WHERE id = '$safe_id'";

    if ($db->update($update_query)) {
        echo "<script>
                alert('Profile Updated Successfully!');
                window.location.href = 'profile.php';
              </script>";
    } else {
        $error = "Failed to update profile. Please try again.";
    }
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll("nav a");
        navLinks.forEach(function(link) {
            const href = link.getAttribute("href");
            if (href === "index.php") link.href = "../index.php";
            else if (href === "about.php") link.href = "../about.php";
            else if (href === "courses.php") link.href = "../courses.php";
            else if (href === "pricing.php") link.href = "../pricing.php";
            else if (href === "login.php") link.href = "../login.php";
            else if (href === "register.php") link.href = "../register.php";
        });

        const footerLinks = document.querySelectorAll("footer a");
        footerLinks.forEach(function(link) {
            const href = link.getAttribute("href");
            if (href === "index.php") link.href = "../index.php";
            else if (href === "about.php") link.href = "../about.php";
            else if (href === "courses.php") link.href = "../courses.php";
            else if (href === "pricing.php") link.href = "../pricing.php";
            else if (href === "login.php") link.href = "../login.php";
            else if (href === "register.php") link.href = "../register.php";
        });
    });
</script>

<div class="container my-5" style="min-height: 70vh;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-4">
                <h3 class="fw-bold text-center mb-4">Edit Profile</h3>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" name="update_profile" class="btn btn-warning text-white fw-bold w-100">Save Changes</button>
                        <a href="profile.php" class="btn btn-secondary fw-bold w-100">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>