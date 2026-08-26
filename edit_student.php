<?php

include "connect.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: manage_students.php");
    exit();
}

$id = (int) $_GET['id'];

$sql = "SELECT students.id, students.student_number, students.class,
               students.user_id, users.name, users.email
        FROM students
        JOIN users ON students.user_id = users.id
        WHERE students.id = $id";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Student not found";
    exit();
}

$student = $result->fetch_assoc();

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $student_number = $_POST['student_number'];
    $class = $_POST['class'];

    $user_id = $student['user_id'];

    $sql1 = "UPDATE users
             SET name='$name', email='$email'
             WHERE id='$user_id'";

    $sql2 = "UPDATE students
             SET student_number='$student_number', class='$class'
             WHERE id='$id'";

    if ($conn->query($sql1) && $conn->query($sql2)) {

        header("Location: manage_students.php");
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
                Edit Student
            </h1>

            <p class="text-muted mb-0">
                Update student information
            </p>

        </div>

        <a href="manage_students.php"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Students

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
                               value="<?php echo htmlspecialchars($student['name']); ?>"
                               placeholder="Enter student name"
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
                               value="<?php echo htmlspecialchars($student['email']); ?>"
                               placeholder="Enter student email"
                               required>

                    </div>


                    <!-- Student Number -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Student Number
                        </label>

                        <input type="number"
                               name="student_number"
                               class="form-control"
                               value="<?php echo htmlspecialchars($student['student_number']); ?>"
                               placeholder="Enter student number"
                               required>

                    </div>


                    <!-- Class -->
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Class
                        </label>

                        <input type="text"
                               name="class"
                               class="form-control"
                               value="<?php echo htmlspecialchars($student['class']); ?>"
                               placeholder="Enter class"
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
                                Update Student

                            </button>


                            <a href="manage_students.php"
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