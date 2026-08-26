<?php
include "connect.php";

if (!isset($_GET['id'])) {
    header("Location: manage_teachers.php");
    exit();
}

$id = $_GET['id'];

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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Teacher</title>

    <link rel="stylesheet"
          href="./bootstrap/assets/css/bootstrap.min.css">

</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="fw-bold">Edit Teacher</h1>

        <a href="manage_teachers.php"
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
                       value="<?php echo $teacher['name']; ?>"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       value="<?php echo $teacher['email']; ?>"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Phone
                </label>

                <input type="text"
                       name="phone"
                       class="form-control"
                       value="<?php echo $teacher['phone']; ?>"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Subject
                </label>

                <input type="text"
                       name="subject"
                       class="form-control"
                       value="<?php echo $teacher['subject']; ?>"
                       required>

            </div>

            <button type="submit"
                    name="submit"
                    class="btn btn-primary w-100">

                Update Teacher

            </button>

        </form>

    </div>

</div>

</body>
</html>