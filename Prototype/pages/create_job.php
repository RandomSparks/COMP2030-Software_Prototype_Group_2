<?php
// Include database connection if needed (e.g., db.php)
include '../inc/dbconn.inc.php';

// Initialize error message variable
$errorMessage = "";

// Initialize variables with default values
$errorMessage = "";
$jobName = "";
$jobAllocated = "";
$jobDescription = "";
$jobCompleted = 0; // Default to false
$dateStarted = date('Y-m-d'); // Default to today's date
$dateCompleted = null;
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $jobName = trim($_POST['job_name']);
    $jobComplete = isset($_POST['job_complete']) ? $_POST['job_complete'] : 'No';
    $dateStarted = trim($_POST['date_started']);
    $dateCompleted = trim($_POST['date_completed']);
    $jobAllocated = trim($_POST['job_allocated']);
    $jobDescription = trim($_POST['job_description']);

    // Get form data
    $jobName = trim($_POST['job_name']);
    $jobAllocated = trim($_POST['job_allocated']);
    $jobDescription = trim($_POST['job_description']);
    $jobCompleted = isset($_POST['job_completed']) ? 1 : 0; // Checkbox, default is false
    $dateStarted = $_POST['date_started'];
    $dateCompleted = $_POST['date_completed'] ? $_POST['date_completed'] : null;

    // Validate required fields
    if (empty($jobName)) {
        $errorMessage = "Job Name is required.";
    } else {
        // Insert into the database (example only, adjust for your database structure)
        $stmt = $conn->prepare("INSERT INTO jobs (job_name, job_completed, date_started, date_completed, job_allocated, job_description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sissss', $jobName, $jobCompleted, $dateStarted, $dateCompleted, $jobAllocated, $jobDescription);

        if ($stmt->execute()) {
            // Redirect to a confirmation page or show a success message
            header("Location: jobs.php");
            exit();
        } else {
            $errorMessage = "Error creating job: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
<!-- Ensure that xamp is running and navagiatve to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">
    <title>Create Jobs</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/script.js" defer></script>
</head>

<body>
    <main id="overview-main">
        <?php
        require_once "../inc/sidebar.php";
        require_once "../inc/header.php";
        ?>
        <div class="div_content">
            <h2>Create a New Job</h2>

            <?php if (!empty($errorMessage)): ?>
                <div style="color: red;">
                    <?php echo htmlspecialchars($errorMessage); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div>
                    <label for="job_name">Job Name:</label>
                    <input type="text" name="job_name" value="<?php echo htmlspecialchars($jobName); ?>" required>
                </div>

                <div>
                    <label for="job_completed">Job Completed:</label>
                    <input type="checkbox" name="job_completed" <?php if (isset($jobCompleted) && $jobCompleted)
                        echo 'checked'; ?>>
                </div>

                <div>
                    <label for="date_started">Date Started:</label>
                    <input type="date" name="date_started" value="<?php echo htmlspecialchars($dateStarted); ?>"
                        required>
                </div>

                <div>
                    <label for="date_completed">Date Completed:</label>
                    <input type="date" name="date_completed" value="<?php echo htmlspecialchars($dateCompleted); ?>">
                </div>

                <div>
                    <label for="job_allocated">Job Allocated:</label>
                    <input type="text" name="job_allocated" value="<?php echo htmlspecialchars($jobAllocated); ?>">
                </div>

                <div>
                    <label for="job_description">Job Description:</label>
                    <textarea name="job_description"><?php echo htmlspecialchars($jobDescription); ?></textarea>
                </div>

                <div>
                    <button type="submit">Create Job</button>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>

</html>