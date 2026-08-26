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

<?php include "header.php"; ?>

<div class="container py-5">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h1 class="fw-bold mb-1">Add Teacher</h1>

            <p class="text-muted mb-0">
                Add a new teacher to the course system.
            </p>
        </div>

        <a href="manage_teachers.php"
           class="btn btn-outline-dark">

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

                        <label for="name" class="form-label fw-semibold">
                            Teacher Name
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
                                placeholder="Enter teacher name"
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
                                placeholder="Enter teacher email"
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


                    <!-- Phone -->
                    <div class="col-md-6">

                        <label for="phone" class="form-label fw-semibold">
                            Phone
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-telephone"></i>
                            </span>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                class="form-control"
                                placeholder="Enter phone number"
                                required>

                        </div>

                    </div>


                    <!-- Subject -->
                    <div class="col-12">

                        <label for="subject" class="form-label fw-semibold">
                            Subject
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-book"></i>
                            </span>

                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                class="form-control"
                                placeholder="Enter subject"
                                required>

                        </div>

                    </div>

                </div>


                <!-- Buttons -->
                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-5">

                    <a href="manage_teachers.php"
                       class="btn btn-outline-secondary px-4">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        name="submit"
                        class="btn text-white px-4"
                        style="background-color: #FF9500;">

                        <i class="bi bi-person-plus me-1"></i>
                        Add Teacher

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<?php include "footer.php"; ?>