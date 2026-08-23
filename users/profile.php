<?php
include "../header.php";
include "../connect2.php";

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='../login.php';</script>";
    exit;
}

$objCon = new Connect2();

$userData = $objCon->query("SELECT name, email, role, image FROM users WHERE id = " . (int)$_SESSION['user_id']);

$user = $userData[0] ?? [];

$avatar = !empty($user['image']) ? '/' . htmlspecialchars($user['image']) : '../bootstrap/assets/image/avatar.webp';
?>
<section class="py-5" style="background-color: #f7f7f7; min-height: 70vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 p-md-5 text-center">
                    <img src="<?= $avatar ?>" alt="profile"
                        class="rounded-circle mx-auto mb-3"
                        style="width: 120px; height: 120px; object-fit: cover;">

                    <h3 class="fw-bold mb-3"><?= $user['name'] ?></h3>
                    <div class="shadow-sm p-3 rounded-3 shadow" style="background-color: #eeee;">
                        <p class="text-muted"><?= $user['email'] ?></p>
                        <div class="d-flex justify-content-center">
                            <i class="bi bi-mortarboard mx-2" style="color: #FF9500;"></i>
                            <p class=" text-capitalize fw-bold"><?= $user['role'] ?></p>
                        </div>
                    </div>


                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <a href="edit.php" class="btn fw-medium text-white px-4" style="background-color: #FF9500;">
                            Edit Profile
                        </a>
                        <a href="../logout.php" class="btn btn-outline-secondary fw-medium px-4">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "../footer.php";
?>