<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../connect2.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

$objCon = new Connect2();
$conn = $objCon->getConnection();

$error = "";
$success = false;

$stmt = $conn->prepare("SELECT name, email, image, role FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'user';

    $role = in_array($role, ['student', 'teacher', 'user']) ? $role : 'user';

    if ($name === '' || $email === '') {
        $error = "Name and email are required.";
    } else {
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ?, role = ? WHERE id = ?");
            $update->bind_param("ssssi", $name, $email, $hashed, $role, $_SESSION['user_id']);
        } else {
            $update = $conn->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
            $update->bind_param("sssi", $name, $email, $role, $_SESSION['user_id']);
        }

        if ($update->execute()) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            header("Location: profile.php");
            exit();
        } else {
            $error = "Failed to update profile. Please try again.";
        }
        $update->close();
    }
}

include "../header.php";
?>
<section class="py-5" style="background-color: #f7f7f7; min-height: 70vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm p-4 p-md-5">
                    <h3 class="fw-bold text-center mb-4">Edit Profile</h3>

                    <?php if ($success): ?>
                        <div class="alert alert-success">Profile updated successfully!</div>
                    <?php endif; ?>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="fullName" class="form-label fw-bold">Full Name</label>
                            <input type="text" class="form-control form-control-lg" name="fullName"
                                value="<?= htmlspecialchars($user['name']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control form-control-lg" name="email"
                                value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">New Password</label>
                            <input type="password" class="form-control form-control-lg" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label fw-bold">Role</label>
                            <select name="role" id="role" class="form-select form-select-lg" required>
                                <option value="student" <?= $user['role'] === 'student' ? 'selected' : '' ?>>
                                    Student
                                </option>

                                <option value="teacher" <?= $user['role'] === 'teacher' ? 'selected' : '' ?>>
                                    Teacher
                                </option>

                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>
                                    User
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn fw-medium btn-lg w-100 text-white mb-3" style="background-color: #FF9500;">
                            Save Changes
                        </button>
                        <a href="profile.php" class="btn btn-light btn-lg w-100">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include "../footer.php";
?>