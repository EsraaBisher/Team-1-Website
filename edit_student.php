<?php
include "connect.php";

if (!isset($_GET['id'])) {
    header("Location: manage_students.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT students.id, students.student_number, students.class,
               students.user_id, users.name, users.email
        FROM students
        JOIN users ON students.user_id = users.id
        WHERE students.id = '$id'";

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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Student</title>

    <link rel="stylesheet" href="./bootstrap/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap/assets/css/style.css">

</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="fw-bold">
            Edit Student
        </h1>

        <a href="manage_students.php"
           class="btn btn-dark">
            Back
        </a>

    </div>

    <div class="card border-0 shadow-sm p-4">

        <form method="POST">

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Name
                </label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="<?php echo htmlspecialchars($student['name']); ?>"
                       required>

            </div>


            <div class="mb-3">

                <label class="form-label fw-bold">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       value="<?php echo htmlspecialchars($student['email']); ?>"
                       required>

            </div>


            <div class="mb-3">

                <label class="form-label fw-bold">
                    Student Number
                </label>

                <input type="number"
                       name="student_number"
                       class="form-control"
                       value="<?php echo $student['student_number']; ?>"
                       required>

            </div>


            <div class="mb-3">

                <label class="form-label fw-bold">
                    Class
                </label>

                <input type="text"
                       name="class"
                       class="form-control"
                       value="<?php echo htmlspecialchars($student['class']); ?>"
                       required>

            </div>


            <button type="submit"
                    name="submit"
                    class="btn btn-primary w-100">

                Update Student

            </button>

        </form>

    </div>

</div>

</body>

</html>