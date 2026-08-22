<?php
include_once "../header.php";
include_once "connect.php";

$objCon = new connect();

// Handle Delete Function
if (isset($_POST["delete_id"])) {
    if ($objCon->delete("courses", $_POST["delete_id"])) {
        header("location: index.php?delete=success");
        exit();
    }
}

// Fetch all courses directly from your database
$courses = $objCon->selectAll("courses");
?>

<div class="container my-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold">Courses</h2>
        <?php if (isset($_GET["delete"]) && $_GET["delete"] == "success"): ?>
            <div class="alert alert-success">Deleted course successfully</div>
        <?php endif; ?>
        <?php if (isset($_GET["add"]) && $_GET["add"] == "success"): ?>
            <div class="alert alert-success">Added course successfully</div>
        <?php endif; ?>
        <?php if (isset($_GET["edit"]) && $_GET["edit"] == "success"): ?>
            <div class="alert alert-success">Updated course successfully</div>
        <?php endif; ?>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <div class="col">
                    <div class="card h-100 border-1 shadow-sm rounded-4" style="border-color: #e0e0e0;">

                        <img src="<?= $course['image'] ?>" class="card-img-top rounded-top-4" alt="<?= $course['name'] ?>" style="object-fit: cover; height: 250px;">

                        <div class="card-body d-flex flex-column mt-2">
                            <h5 class="card-title fw-bold text-end mb-2"><?= $course['name'] ?></h5>

                            <p class="card-text text-muted text-end small mb-4">
                                <?= $course['description'] ?>
                            </p>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center text-muted small mb-3 pb-3 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-clock me-1" viewBox="0 0 16 16">
                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                        </svg>
                                        <?= $course['hours'] ?> Hours
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <span class="me-2">Teacher ID: <?= $course['teacher_id'] ?></span>
                                        <img src="<?= $course['avatar'] ?>" class="rounded-circle border" width="30" height="30" alt="Avatar">
                                    </div>
                                </div>

                                <button type="button" class="btn btn-outline-warning w-100 fw-semibold rounded-3 py-2 text-dark" data-bs-toggle="modal" data-bs-target="#modal-<?= $course['id'] ?>">
                                    Course details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Modal -->
                <div class="modal fade" id="modal-<?= $course['id'] ?>" tabindex="-1" aria-labelledby="modalLabel-<?= $course['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4 border-0 shadow">
                            <div class="modal-header border-bottom-0 pb-0">
                                <h5 class="modal-title fw-bold fs-4" id="modalLabel-<?= $course['id'] ?>"><?= $course['name'] ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pt-4">
                                <div class="row g-4">
                                    <div class="col-md-5">
                                        <img src="<?= $course['image'] ?>" class="img-fluid rounded-4 shadow-sm" alt="<?= $course['name'] ?>" style="object-fit: cover; width: 100%; height: auto;">
                                    </div>
                                    <div class="col-md-7">
                                        <h6 class="fw-bold text-muted mb-3">About this course</h6>
                                        <p class="mb-4"><?= $course['description'] ?></p>

                                        <div class="d-flex align-items-center mb-3">
                                            <img src="<?= $course['avatar'] ?>" class="rounded-circle border me-3" width="50" height="50" alt="Avatar">
                                            <div>
                                                <p class="mb-0 fw-bold">Instructor</p>
                                                <p class="mb-0 text-muted">Teacher ID: <?= $course['teacher_id'] ?></p>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mb-4">
                                            <div class="bg-light rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clock text-warning" viewBox="0 0 16 16">
                                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-bold">Duration</p>
                                                <p class="mb-0 text-muted"><?= $course['hours'] ?> Hours</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 pt-0">
                                <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Close</button>
                                <a href="edit.php?id=<?= $course['id'] ?>" class="btn btn-success rounded-3 px-4">Edit</a>
                                <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="delete_id" value="<?= $course['id'] ?>">
                                    <button type="submit" class="btn btn-danger rounded-3 px-4">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center text-muted py-5">
                <h4>No courses available yet. Click "Add Course" below to create one!</h4>
            </div>
        <?php endif; ?>

    </div>

    <div class="text-center mt-5">
        <a href="add.php" class="btn btn-success px-5 py-2 fw-bold fs-5 rounded-3">Add Course</a>
    </div>
</div>

<?php include_once "../footer.php"; ?>