<?php
require 'functions.php';
guard();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h1 class="mb-4">Welcome, <?= htmlspecialchars($_SESSION["email"]); ?>!</h1>
                <div class="d-flex justify-content-center">
                    <a href="student/register.php" class="btn btn-outline-primary mr-3">Manage Students</a>
                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
