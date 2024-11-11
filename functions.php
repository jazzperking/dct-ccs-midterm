<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to get the list of users (for demonstration purposes, this is hardcoded)
function getUsers() {
    return [
        ["email" => "user1@email.com", "password" => "password1"],
        ["email" => "user2@email.com", "password" => "password2"],
        ["email" => "jazzper@email.com", "password" => "123"],
        ["email" => "username@email.com", "password" => "pass"],
        // Add more users as needed
    ];
}

// Function to validate login credentials
function validateLoginCredentials($email, $password) {
    $errors = [];
    if (empty($email)) $errors[] = "Email is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (empty($password)) $errors[] = "Password is required.";
    return $errors;
}

// Function to check if the login credentials are correct
function checkLoginCredentials($email, $password) {
    foreach (getUsers() as $user) {
        if ($user["email"] === $email && $user["password"] === $password) {
            return true;
        }
    }
    return false;
}

// Function to display errors (for login validation)
function displayErrors($errors) {
    if (empty($errors)) return "";
    $output = "<div class='alert alert-danger' role='alert'><strong>Errors:</strong><ul>";
    foreach ($errors as $error) $output .= "<li>$error</li>";
    $output .= "</ul></div>";
    return $output;
}

// Function to protect a page and ensure the user is logged in
function guard() {
    if (empty($_SESSION['email'])) {
        header("Location: index.php"); // Redirect to login page if not logged in
        exit;
    }
}

// Function to log out the user
function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php"); // Redirect to login page after logging out
    exit;
}

// Function to sanitize input data (to prevent XSS attacks)
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to validate if a string is a valid student ID (example: alphanumeric check)
function validateStudentId($student_id) {
    return preg_match('/^[A-Za-z0-9]+$/', $student_id);
}

// Function to validate student name (basic check for letters and spaces)
function validateName($name) {
    return preg_match('/^[A-Za-z\s]+$/', $name);
}

// Function to check if student ID already exists
function isStudentRegistered($student_id) {
    if (isset($_SESSION['students'])) {
        foreach ($_SESSION['students'] as $student) {
            if ($student['student_id'] === $student_id) {
                return true; // Student ID already exists
            }
        }
    }
    return false; // Student ID not found
}

// Function to add a new student to the session
function addStudent($student_id, $first_name, $last_name) {
    $_SESSION['students'][] = [
        'student_id' => $student_id,
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
}

?>