<?php
include 'header.php';  // Include the header for session start and breadcrumbs
include 'functions.php'; // Include functions for validation and other actions

guard(); // Protect the page to ensure only logged-in users can access

?>

<main>
    <div class="container py-5">
        <!-- Logout Button in the upper-right corner -->
        <div class="d-flex justify-content-end">
            <a href="logout.php" class="btn btn-danger custom-logout">Logout</a>
        </div>
        <style>
        .custom-logout {
            margin-right: 100px; 
        }
        </style>

        <!-- Welcome Message -->
        <div class="mb-4" style="text-align: left; margin-left: 95px; margin-top: -35px;">
            <h2 style="font-size: 28px;">Welcome to the System: <?= htmlspecialchars($_SESSION["email"]); ?></h2>
        </div>

        <!-- Row for Add Subject and Register Student Cards -->
        <div class="row justify-content-center">
            <!-- Add a Subject Card -->
            <div class="col-md-5 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-left"> 
                        <h5>Add a Subject</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-left pl-0">This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
                        <a href="subject/add.php" class="btn btn-primary btn-block">Add Subject</a>
                    </div>
                </div>
            </div>
            
            <!-- Register a Student Card -->
            <div class="col-md-5 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header text-left">
                        <h5>Register a Student</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-left pl-0">This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>
                        <a href="student/register.php" class="btn btn-primary btn-block">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include 'footer.php';  // Include the footer
?>
