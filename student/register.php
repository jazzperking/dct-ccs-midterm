<?php
session_start(); // Start the session to store student data
require '../functions.php'; // Include the functions file
guard(); // Protect the page by ensuring the user is logged in

$errors = [];

// Handle form submission to add a student
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = sanitizeInput($_POST['student_id']);
    $first_name = sanitizeInput($_POST['first_name']);
    $last_name = sanitizeInput($_POST['last_name']);

    // Validate inputs
    if (empty($student_id) || empty($first_name) || empty($last_name)) {
        $errors[] = "All fields are required.";
    } else {
        // Check if the student is already registered
        if (isStudentRegistered($student_id)) {
            $errors[] = "Student ID already exists.";
        }

        // Validate name format
        if (!validateStudentId($student_id)) {
            $errors[] = "Invalid Student ID format.";
        }

        if (!validateName($first_name)) {
            $errors[] = "First name can only contain letters and spaces.";
        }

        if (!validateName($last_name)) {
            $errors[] = "Last name can only contain letters and spaces.";
        }

        // If no errors, add the student
        if (empty($errors)) {
            $_SESSION['students'][] = [
                'student_id' => $student_id,
                'first_name' => $first_name,
                'last_name' => $last_name
            ];
            header("Location: register.php"); // Redirect to avoid resubmission
            exit;
        }
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $deleteIndex = $_GET['delete'];
    if (isset($_SESSION['students'][$deleteIndex])) {
        unset($_SESSION['students'][$deleteIndex]); // Remove the student from the session array
        $_SESSION['students'] = array_values($_SESSION['students']); // Re-index the array
    }
    header("Location: register.php"); // Redirect to avoid re-triggering deletion on refresh
    exit;
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
        <!-- Student Registration Form -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Register Student</h2>
                        <!-- Display validation errors -->
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <?php foreach ($errors as $error): ?>
                                    <p><?= htmlspecialchars($error) ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
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
                            <button type="submit" class="btn btn-primary btn-block">Add Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student List Table -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h3 class="text-center">Student List</h3>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($_SESSION['students'])): ?>
                            <?php foreach ($_SESSION['students'] as $index => $student): ?>
                                <tr>
                                    <td><?= htmlspecialchars($student['student_id']) ?></td>
                                    <td><?= htmlspecialchars($student['first_name']) ?></td>
                                    <td><?= htmlspecialchars($student['last_name']) ?></td>
                                    <td>
                                        <!-- Delete option with confirmation -->
                                        <a href="register.php?delete=<?= $index ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No student records found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
