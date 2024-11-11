<?php
session_start();
if (!isset($_SESSION['subjects'])) {
    header('Location: add.php');
    exit();
}

$index = $_GET['index'];
$subject = $_SESSION['subjects'][$index];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newCode = $_POST['subjectCode'];
    $newName = $_POST['subjectName'];
    $_SESSION['subjects'][$index] = array("code" => $newCode, "name" => $newName);
    header('Location: add.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4">Edit Subject</h3>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="subjectCode" class="form-label">Subject Code</label>
            <input type="text" class="form-control" id="subjectCode" name="subjectCode" value="<?php echo $subject['code']; ?>">
        </div>
        <div class="mb-3">
            <label for="subjectName" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="subjectName" name="subjectName" value="<?php echo $subject['name']; ?>">
        </div>
        <button type="submit" class="btn btn-success">Update Subject</button>
        <a href="add.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
