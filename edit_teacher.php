<?php

include "connect.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: manage_teachers.php");
    exit();
}

$id = (int) $_GET['id'];

$sql = "SELECT teachers.id,
               teachers.phone,
               teachers.subject,
               users.id AS user_id,
               users.name,
               users.email
        FROM teachers
        JOIN users ON teachers.user_id = users.id
        WHERE teachers.id = $id";

$result = $conn->query($sql);
$teacher = $result->fetch_assoc();

if (!$teacher) {
    die("Teacher not found");
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];

    $user_id = $teacher['user_id'];

    $sql1 = "UPDATE users
             SET name='$name',
                 email='$email'
             WHERE id=$user_id";

    $sql2 = "UPDATE teachers
             SET phone='$phone',
                 subject='$subject'
             WHERE id=$id";

    if ($conn->query($sql1) && $conn->query($sql2)) {

        header("Location: manage_teachers.php");
        exit();

    } else {

        echo "Error: " . $conn->error;
    }
}

?>

<?php include "header.php"; ?>


<div class="container py-5">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row
                justify-content-between
                align-items-md-center
                gap-3
                mb-4">

        <div>

            <h1 class="fw-bold mb-1">
                Edit Teacher
            </h1>

            <p class="text-muted mb-0">
                Update teacher information
            </p>

        </div>

        <a href="manage_teachers.php"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Teachers

        </a>

    </div>


    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-4 p-md-5">

            <form method="POST">

                <div class="row g-4">

                    <!-- Name -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Name
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control form-control-lg"
                               value="<?php echo htmlspecialchars($teacher['name']); ?>"
                               placeholder="Enter teacher name"
                               required>

                    </div>


                    <!-- Email -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control form-control-lg"
                               value="<?php echo htmlspecialchars($teacher['email']); ?>"
                               placeholder="Enter teacher email"
                               required>

                    </div>


                    <!-- Phone -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Phone
                        </label>

                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="<?php echo htmlspecialchars($teacher['phone']); ?>"
                               placeholder="Enter phone number"
                               required>

                    </div>


                    <!-- Subject -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Subject
                        </label>

                        <input type="text"
                               name="subject"
                               class="form-control"
                               value="<?php echo htmlspecialchars($teacher['subject']); ?>"
                               placeholder="Enter subject"
                               required>

                    </div>


                    <!-- Buttons -->
                    <div class="col-12">

                        <div class="d-flex flex-column flex-md-row
                                    gap-2
                                    pt-3">

                            <button type="submit"
                                    name="submit"
                                    class="btn text-white px-4"
                                    style="background-color: #FF9500;">

                                <i class="bi bi-check-lg me-1"></i>
                                Update Teacher

                            </button>


                            <a href="manage_teachers.php"
                               class="btn btn-outline-secondary px-4">

                                Cancel

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<?php include "footer.php"; ?>