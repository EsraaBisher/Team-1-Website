<?php
include "connect.php";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $student_number = $_POST['student_number'];
    $class = $_POST['class'];

    $sql1 = "INSERT INTO users (name, email, password, role)
             VALUES ('$name', '$email', '$password', 'student')";

    if ($conn->query($sql1)) {

        $user_id = $conn->insert_id;

        $sql2 = "INSERT INTO students (student_number, class, user_id)
                 VALUES ('$student_number', '$class', '$user_id')";

        if ($conn->query($sql2)) {
            header("Location: manage_students.php");
            exit();
        }
    }

    echo "Error: " . $conn->error;
}
?>

<?php include "header.php"; ?>

<div class="container py-5">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h1 class="fw-bold mb-1">Add Student</h1>
            <p class="text-muted mb-0">
                Add a new student to the course system.
            </p>
        </div>

        <a href="manage_students.php"
           class="btn btn-outline-dark">
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

                        <label for="name" class="form-label fw-semibold">
                            Student Name
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-person"></i>
                            </span>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="Enter student name"
                                required>
                        </div>

                    </div>


                    <!-- Email -->
                    <div class="col-md-6">

                        <label for="email" class="form-label fw-semibold">
                            Email
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-envelope"></i>
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter student email"
                                required>
                        </div>

                    </div>


                    <!-- Password -->
                    <div class="col-md-6">

                        <label for="password" class="form-label fw-semibold">
                            Password
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-lock"></i>
                            </span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter password"
                                required>
                        </div>

                    </div>


                    <!-- Student Number -->
                    <div class="col-md-6">

                        <label for="student_number" class="form-label fw-semibold">
                            Student Number
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-hash"></i>
                            </span>

                            <input
                                type="number"
                                id="student_number"
                                name="student_number"
                                class="form-control"
                                placeholder="Enter student number"
                                required>
                        </div>

                    </div>


                    <!-- Class -->
                    <div class="col-12">

                        <label for="class" class="form-label fw-semibold">
                            Class
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-mortarboard"></i>
                            </span>

                            <input
                                type="text"
                                id="class"
                                name="class"
                                class="form-control"
                                placeholder="Enter class"
                                required>
                        </div>

                    </div>

                </div>


                <!-- Buttons -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-5">

                    <a href="manage_students.php"
                       class="btn btn-outline-secondary px-4">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        name="submit"
                        class="btn text-white px-4"
                        style="background-color: #FF9500;">

                        <i class="bi bi-person-plus me-1"></i>
                        Add Student

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php include "footer.php"; ?>