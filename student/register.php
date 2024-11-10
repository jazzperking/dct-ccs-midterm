<?php
require '../functions.php';
guard();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    if (empty($student_id) || empty($first_name) || empty($last_name)) {
        $errors[] = "All fields are required.";
    } else {
        $_SESSION['students'][] = [
            'student_id' => $student_id,
            'first_name' => $first_name,
            'last_name' => $last_name
        ];
        header("Location: register.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Register Student</h2>
                        <?= displayErrors($errors) ?>
                        <form method="post">
                            <div class="form-group">
                                <label for="student_id">Student ID</label>
                                <input type="text" id="student_id" name="student_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
