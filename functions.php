<?php
session_start();

function getUsers() {
    return [
        ["email" => "user1@email.com", "password" => "password1"],
        ["email" => "user2@email.com", "password" => "password2"],
        ["email" => "jazzper@email.com", "password" => "123"],
        ["email" => "username@email.com", "password" => "pass"],
        // Add more users as needed
    ];
}

function validateLoginCredentials($email, $password) {
    $errors = [];
    if (empty($email)) $errors[] = "Email is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (empty($password)) $errors[] = "Password is required.";
    return $errors;
}

function checkLoginCredentials($email, $password) {
    foreach (getUsers() as $user) {
        if ($user["email"] === $email && $user["password"] === $password) {
            return true;
        }
    }
    return false;
}

function displayErrors($errors) {
    if (empty($errors)) return "";
    $output = "<div class='alert alert-danger' role='alert'><strong>Errors:</strong><ul>";
    foreach ($errors as $error) $output .= "<li>$error</li>";
    $output .= "</ul></div>";
    return $output;
}

function guard() {
    if (empty($_SESSION['email'])) {
        header("Location: index.php");
        exit;
    }
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
