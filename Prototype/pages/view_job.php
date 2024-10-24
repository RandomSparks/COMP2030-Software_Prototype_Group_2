<?php
session_start();
require_once "../inc/dbconn.inc.php";

// Check if job ID is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect back to the job list if ID is not provided or invalid
    header("Location: jobs.php");
    exit();
}

$jobId = $_GET['id'];

// Fetch job details from the database
$stmt = $conn->prepare("SELECT job_name, date_started, date_completed, job_allocated, job_description, job_completed FROM jobs WHERE id = ?");
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt->bind_param('i', $jobId);
$stmt->execute();
$stmt->bind_result($jobName, $dateStarted, $dateCompleted, $jobAllocated, $jobDescription, $jobCompleted);
$stmt->fetch();
$stmt->close();

// Check if the job was found
if (!$jobName) {
    // Redirect back to the job list if no job is found
    header("Location: jobs.php");
    exit();
}

// Handle form submission to add a new note
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note_content'])) {
    $noteContent = htmlspecialchars($_POST['note_content']);
    $stmt = $conn->prepare("INSERT INTO job_notes (job_name, note, created_at) VALUES (?, ?, NOW())");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('ss', $jobName, $noteContent);
    $stmt->execute();
    $stmt->close();
    // Redirect to avoid form resubmission
    header("Location: view_job.php?id=" . $jobId);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">
    <title>View Job</title>
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
                <a href="jobs.php">Back to Job List</a>
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

            <div>
                <strong>Job Notes:</strong><br>
                <?php
                // Fetch the job notes from the database
                $stmt = $conn->prepare("SELECT job_description, created_at FROM jobs WHERE job_name = ?");
                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt->bind_param('s', $jobName);
                $stmt->execute();
                $stmt->bind_result($noteContent, $dateCreated);

                while ($stmt->fetch()) {
                    echo '<div>';
                    echo '<strong>Note time:</strong> ' . htmlspecialchars($dateCreated) . '<br>';
                    echo '<strong>Note contents:</strong> <pre>' . htmlspecialchars($noteContent) . '</pre><br>';
                    echo '</div>';
                }

                $stmt->close();
                ?>
            </div>

            <div>
                <h3>Add a New Note</h3>
                <form method="POST" action="">
                    <textarea name="note_content" rows="4" cols="50" placeholder="Enter your note here"
                        required></textarea><br>
                    <button type="submit">Add Note</button>
                </form>
            </div>

            <br>

    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>

</html>
<?php
$conn->close(); // Close the connection after all queries are executed
?>