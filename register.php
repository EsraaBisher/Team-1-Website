<?php
include "header.php";
?>
<section class="py-5" style="background-color: #f7f7f7;">
    <div class="container">
        <div class="row align-items-center">
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

            <!-- LOGIN -->
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="card border-0 shadow-sm p-3 p-md-5 mb-5">
                    <h1 class="fw-bold text-center mb-2">Sign Up</h1>
                    <p class="text-center mb-3">Create an account to unlock exclusive features.</p>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="fullName" class="form-label fw-bold">Full Name</label>
                            <input type="text" class="form-control form-control-lg" name="fullName" placeholder="Enter your Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control form-control-lg" name="email" placeholder="Enter your Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control form-control-lg " name="password" placeholder="Enter your Password" required>
                                <button class="btn position-absolute translate-middle-y border-0 end-0 top-50">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-end mb-3">
                            <p>Forgot Password?</p>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="terms" required>
                            <label class="form-check-label" for="terms">i agree with <span class="text-decoration-underline">Terms of Use</span> and <span class="text-decoration-underline">Privacy Policy</span></label>
                        </div>
                        <button href="index.php" type="submit" class="btn fw-meduim btn-lg w-100 text-white mb-4" style="background-color: #FF9500;">Sign Up</button>

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
<?php
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['fullName'])) {
    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "<script>window.location.href='index.php';</script>";
}
?>
<?php
include "footer.php";
?>