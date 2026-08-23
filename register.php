<?php
include "header.php";
include "connect2.php";

$objCon = new Connect2();

$error = "";

$old = ['fullName' => '', 'email' => '', 'role' => 'user', 'student_number' => '', 'class' => '', 'phone' => '', 'subject' => ''];

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['fullName'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'user';
    $role = in_array($role, ['student', 'teacher', 'user']) ? $role : 'user';

    $old['fullName'] = $fullName;
    $old['email'] = $email;
    $old['role'] = $role;
    $old['student_number'] = $_POST['student_number'] ?? '';
    $old['class'] = $_POST['class'] ?? '';
    $old['phone'] = $_POST['phone'] ?? '';
    $old['subject'] = $_POST['subject'] ?? '';

    if (!isset($_POST['terms'])) {
        $error = "you must agree to the terms";
    } elseif (strlen($password) < 6) {  //strlen()=> counts characters
        $error = "Password must be at least 6 characters";
    } else {
        $user = $objCon->login($email);
        if (count($user) > 0) {

            $error = "An account using this email already exists.";
        } else {
            $imagePath = "bootstrap/assets/image/avatar.webp";

            if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === 0) {

                $imageName = time() . "_" . basename($_FILES['profilePic']['name']);

                move_uploaded_file($_FILES['profilePic']['tmp_name'], "bootstrap/assets/uploads/" . $imageName);
                $imagePath = "bootstrap/assets/uploads/" . $imageName;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $userData = ['name' => $fullName, 'email' => $email, 'password' => $hashedPassword, 'role' => $role, 'image' => $imagePath];

            if ($objCon->insert($userData, "users")) {

                // Get newly created user's ID
                $userId = $objCon->lastId();
                if ($role === 'student') {

                    $studentNumber = $_POST['student_number'];
                    $class = $_POST['class'];

                    $studentData = [
                        'student_number' => $studentNumber,
                        'user_id' => $userId,
                        'class' => $class
                    ];

                    $objCon->insert($studentData, "students");
                }


                //teacher
                elseif ($role === 'teacher') {

                    $phone = $_POST['phone'];
                    $subject = $_POST['subject'];

                    $teacherData = [
                        'phone' => $phone,
                        'subject' => $subject,
                        'user_id' => $userId
                    ];

                    $objCon->insert($teacherData, "teachers");
                }

                $_SESSION['user_id'] = $userId;
                $_SESSION['name'] = $fullName;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
                $_SESSION['image'] = $imagePath;
                header("location: index.php");
                exit();
            } else {

                $error = "Registration failed.";
            }
        }
    }
}
?>
<section class="py-5" style="background-color: #f7f7f7;">
    <div class="container">
        <div class="row align-items-start">
            <!-- SUBCONTAINER -->
            <div class="col-lg-6 order-lg-1 order-2">
                <!-- text -->
                <div>
                    <h2 class="fw-bold mb-3">Students Testimonials</h2>
                    <p class="mb-3">Lorem ipsum dolor sit amet consectetur. Tempus tincidunt etiam eget elit id imperdiet et. Cras eu sit dignissim lorem nibh et. Ac cum eget habitasse in velit fringilla feugiat senectus in.</p>
                </div>

                <!-- container -->
                <div class="card border-0 shadow-sm p-4">
                    <p>
                        The web design course provided a solid foundation for me. The instructors were knowledgeable and supportive, and the interactive learning environment was engaging. I highly recommend it!
                    </p>
                    <div class="d-flex justify-content-between alighn-items-center mt-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="bootstrap/assets/image/profile.jpg" alt="profile" class="rounded-2" style="width: 48px;aspect-ratio:1/1;object-fit:cover">
                            <span class="fw-semibold">Sarah L</span>
                        </div>
                        <a href="#" class="btn btn-light fw-meduim py-2 px-3">Read More</a>
                    </div>
                </div>
                <!-- arrows -->
                <div class="d-flex gap-2 mt-3 justify-content-end">
                    <button class="btn shadow-sm" style="background-color: white;"><i class="bi bi-arrow-left"></i></button><button class="btn shadow-sm" style="background-color: white;"><i class="bi bi-arrow-right"></i></button>
                </div>
            </div>

            <!-- REGISTER -->
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="card border-0 shadow-sm p-3 p-md-5 mb-5">
                    <h1 class="fw-bold text-center mb-2">Sign Up</h1>
                    <p class="text-center mb-3">Create an account to unlock exclusive features.</p>
                    <?php if ($error) { ?>
                        <div class="alert alert-danger py-2"><?= $error ?></div>
                    <?php } ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="fullName" class="form-label fw-bold">Full Name</label>
                            <input type="text" class="form-control form-control-lg" name="fullName" placeholder="Enter your Name" required value="<?= $old['fullName'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control form-control-lg" name="email" placeholder="Enter your Email" required value="<?= $old['email'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control form-control-lg " name="password" id="password" placeholder="Enter your Password" required minlength="6">
                                <button type="button" class="btn position-absolute translate-middle-y border-0 end-0 top-50" onclick="togglePassword('password',this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-end mb-3">
                            <p>Forgot Password?</p>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label fw-bold">Role</label>
                            <select name="role" id="role" class="form-select form-select-lg" onchange="toggleRoleFields()" required>
                                <option value="student" <?= $old['role'] === 'student' ? 'selected' : '' ?>>student</option>
                                <option value="teacher" <?= $old['role'] === 'teacher' ? 'selected' : '' ?>>teacher</option>
                                <option value="user" <?= $old['role'] === 'user' ? 'selected' : '' ?>>user</option>
                            </select>
                        </div>
                        <!-- student fields -->
                        <div id="studentFields" class="row g-2">
                            <div class="col-6 mb-3">
                                <label for="student_number" class="form-label fw-bold">Student Number</label>
                                <input type="number" class="form-control form-control-lg" name="student_number" id="student_number" value="<?= $old['student_number'] ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">Class</label>
                                <input type="text" class="form-control form-control-lg" name="class" id="class" value="<?= $old['class'] ?>">
                            </div>
                        </div>
                        <!-- teacher -->
                        <div id="teacherFields" class="row g-2" style="display: none;">
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">phone</label>
                                <input type="text" class="form-control form-control-lg" name="phone" id="phone" value="<?= $old['phone'] ?>">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label fw-bold">subject</label>
                                <input type="text" class="form-control form-control-lg" name="subject" id="subject" value="<?= $old['subject'] ?>">
                            </div>
                        </div>
                        <!-- profile pic -->
                        <div class="mb-3">
                            <label for="profilePic" class="form-label fw-bold">Profile Picture <span class="fw-normal text-muted">(optional)</span></label>
                            <input type="file" class="form-control form-control-lg" name="profilePic" id="profilePic">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="terms" required>
                            <label class="form-check-label" for="terms">i agree with <span class="text-decoration-underline">Terms of Use</span> and <span class="text-decoration-underline">Privacy Policy</span></label>
                        </div>
                        <button type="submit" class="btn fw-meduim btn-lg w-100 text-white mb-4" style="background-color: #FF9500;">Sign Up</button>

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="flex-grow-1" style="border-top:2px solid #eee;"></div>
                            <span style="color: #bcbbbb;">OR</span>
                            <div class="flex-grow-1" style="border-top:2px solid #eee;"></div>
                        </div>
                        <a href="#" class="btn btn-light fw-meduim btn-lg w-100 d-flex align-items-center justify-content-center gap-2 mb-3 p-3">
                            <img src="bootstrap/assets/image/googleIcon.png" alt="google" width="20" height="20">
                            <span class=" fs-6">Sign Up with Google</span>
                        </a>

                        <p class="text-center">
                            Already have an account?
                            <a href="login.php" class="fw-meduim">
                                login <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    function toggleRoleFields() {
        const role = document.getElementById('role').value;
        document.getElementById('studentFields').style.display = role === 'student' ? 'flex' : 'none';
        document.getElementById('teacherFields').style.display = role === 'teacher' ? 'flex' : 'none';
    }

    function togglePassword(fieldId, btn) {
        const field = document.getElementById(fieldId);
        const icon = btn.querySelector('i');
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
    toggleRoleFields();
</script>

<?php
include "footer.php";
?>