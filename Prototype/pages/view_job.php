<?php
session_start();
include '../inc/dbconn.inc.php';

// Check if job ID is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect back to the job list if ID is not provided or invalid
    header("Location: job_list.php");
    exit();
}

$jobId = $_GET['id'];

// Fetch the job details from the database
$stmt = $conn->prepare("SELECT job_name, job_completed, date_started, date_completed, job_allocated, job_description FROM jobs WHERE id = ?");
$stmt->bind_param('i', $jobId);
$stmt->execute();
$stmt->bind_result($jobName, $jobCompleted, $dateStarted, $dateCompleted, $jobAllocated, $jobDescription);
$stmt->fetch();
$stmt->close();
$conn->close();

// Check if the job was found
if (!$jobName) {
    // Redirect back to the job list if no job is found
    header("Location: job_list.php");
    exit();
}
?>
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
            <div>
                <a href="job_list.php">Back to Job List</a>

                <a href="edit_job.php?id=<?php echo $jobId; ?>">Edit Job</a>
            </div>
            <div>
                <strong>Job Name:</strong> <?php echo htmlspecialchars($jobName); ?><br>
                <strong>Date Started:</strong> <?php echo htmlspecialchars($dateStarted); ?><br>
                <strong>Date Completed:</strong>
                <?php echo $dateCompleted ? htmlspecialchars($dateCompleted) : 'Not Completed'; ?><br>
                <strong>Job Allocated:</strong> <?php echo htmlspecialchars($jobAllocated); ?><br>
                <strong>Job Description:</strong> <br>
                <pre><?php echo htmlspecialchars($jobDescription); ?></pre>
                <strong>Status:</strong> <?php echo $jobCompleted ? 'Completed' : 'Not Completed'; ?><br>
            </div>

            <br>

    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>

</html>