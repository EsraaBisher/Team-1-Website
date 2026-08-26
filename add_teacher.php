<?php
include "connect.php";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];

    $sql1 = "INSERT INTO users (name, email, password, role)
             VALUES ('$name', '$email', '$password', 'teacher')";

    if ($conn->query($sql1)) {

        $user_id = $conn->insert_id;

        $sql2 = "INSERT INTO teachers (phone, subject, user_id)
                 VALUES ('$phone', '$subject', '$user_id')";

        if ($conn->query($sql2)) {

            header("Location: manage_teachers.php");
            exit();

        } else {

            echo "Teacher Error: " . $conn->error;
        }

    } else {

        echo "User Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Teacher</title>

    <link rel="stylesheet"
          href="./bootstrap/assets/css/bootstrap.min.css">

</head>

<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="fw-bold">Add Teacher</h1>

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
                       placeholder="Enter teacher name"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter teacher email"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Password
                </label>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter password"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Phone
                </label>

                <input type="text"
                       name="phone"
                       class="form-control"
                       placeholder="Enter phone number"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Subject
                </label>

                <input type="text"
                       name="subject"
                       class="form-control"
                       placeholder="Enter subject"
                       required>

            </div>

            <button type="submit"
                    name="submit"
                    class="btn btn-dark w-100">

                Add Teacher

            </button>

        </form>

    </div>

</div>

</body>
</html>