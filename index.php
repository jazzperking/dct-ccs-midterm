<?php
require 'functions.php';

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $errors = validateLoginCredentials($email, $password);

    if (empty($errors) && checkLoginCredentials($email, $password)) {
        $_SESSION["email"] = $email;
        header("Location: dashboard.php");
        exit;
    } else {
        $errors[] = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center min-vh-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login</h2>
                        
                        <!-- Display any errors, including the invalid login image if login fails -->
                        <?= displayErrors($errors) ?>

                        <form method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
