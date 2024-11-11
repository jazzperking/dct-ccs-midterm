<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
include('config.php');

// Check if the ID of the student to edit is passed in the URL
if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Fetch student details from the database
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the student exists
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "Student not found!";
        exit;
    }
} else {
    echo "No student ID provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="students.php">Students</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
        </ol>
    </nav>

    <h3 class="mb-4">Edit Student Details</h3>

    <!-- Edit Student Form -->
    <form method="POST" action="update_student.php">
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

        <div class="mb-3">
            <label for="studentName" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="studentName" name="studentName" value="<?php echo $student['name']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="studentEmail" class="form-label">Student Email</label>
            <input type="email" class="form-control" id="studentEmail" name="studentEmail" value="<?php echo $student['email']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="studentPhone" class="form-label">Student Phone</label>
            <input type="text" class="form-control" id="studentPhone" name="studentPhone" value="<?php echo $student['phone']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Student</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
