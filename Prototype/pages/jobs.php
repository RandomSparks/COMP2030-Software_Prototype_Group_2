<?php
session_start();
include '../inc/dbconn.inc.php';


// Handle toggling a job's completion status
if (isset($_GET['toggle_id'])) {
    $jobId = $_GET['toggle_id'];

    // Get the current status of the job
    $stmt = $conn->prepare("SELECT job_completed FROM jobs WHERE id = ?");
    $stmt->bind_param('i', $jobId);
    $stmt->execute();
    $stmt->bind_result($jobCompleted);
    $stmt->fetch();
    $stmt->close();

    // Determine the new status and date based on the current state
    $newStatus = $jobCompleted ? 0 : 1;
    $dateCompleted = $newStatus ? date('Y-m-d') : null;

    // Update the job to toggle the completion status and set/clear the completion date
    $stmt = $conn->prepare("UPDATE jobs SET job_completed = ?, date_completed = ? WHERE id = ?");
    $stmt->bind_param('isi', $newStatus, $dateCompleted, $jobId);
    if ($stmt->execute()) {
        $successMessage = "Job status updated successfully.";
        header("Location: jobs.php");
        exit();
    } else {
        $errorMessage = "Error updating job status: " . $stmt->error;
    }
    $stmt->close();
}

// Handle job deletion
if (isset($_GET['delete_id'])) {
    $jobId = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM jobs WHERE id = ?");
    $stmt->bind_param('i', $jobId);
    if ($stmt->execute()) {
        $successMessage = "Job deleted successfully.";
    } else {
        $errorMessage = "Error deleting job: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch the list of jobs
$stmt = $conn->prepare("SELECT id, job_name, date_started, date_completed, job_completed FROM jobs ORDER BY created_at DESC");
$stmt->execute();
$stmt->bind_result($id, $jobName, $dateStarted, $dateCompleted, $jobCompleted);

$jobs = [];
while ($stmt->fetch()) {
    $jobs[] = [
        'id' => $id,
        'job_name' => $jobName,
        'date_started' => $dateStarted,
        'date_completed' => $dateCompleted,
        'job_completed' => $jobCompleted,
    ];
}
$stmt->close();
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
            <a href="create_job.php" class="button">Create Job</a>

            <h2>Job List</h2>

            <?php if (!empty($successMessage)): ?>
                <div style="color: green;">
                    <?php echo htmlspecialchars($successMessage); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($errorMessage)): ?>
                <div style="color: red;">
                    <?php echo htmlspecialchars($errorMessage); ?>
                </div>
            <?php endif; ?>

            <table id="job_list">
                <tr>
                    <th>Job Title</th>
                    <th>Date Started</th>
                    <th>Date Completed</th>
                    <th>Actions</th>
                </tr>
                <?php if (empty($jobs)): ?>
                    <tr>
                        <td colspan="4">No jobs found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($jobs as $job): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($job['job_name']); ?></td>
                            <td><?php echo htmlspecialchars($job['date_started']); ?></td>
                            <td>
                                <?php echo $job['date_completed'] ? htmlspecialchars($job['date_completed']) : 'Not Completed'; ?>
                            </td>
                            <td>
                                <a href="view_job.php?id=<?php echo $job['id']; ?>">View</a> |
                                <a href="edit_job.php?id=<?php echo $job['id']; ?>">Edit</a> |
                                <a href="?delete_id=<?php echo $job['id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this job?');">Delete</a> |
                                <a href="?toggle_id=<?php echo $job['id']; ?>"
                                    class="toggle-button <?php echo $job['job_completed'] ? 'completed' : 'not-completed'; ?>">
                                    <?php echo $job['job_completed'] ? 'Mark as Incomplete' : 'Mark as Completed'; ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>

            <?php
            $sql = "SELECT id, name, content, job_name FROM job_notes;";

            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    echo '<table id="notes_table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Note Name:</th>';
                    echo '<th>Note Contents:</th>';
                    echo '<th>Job Name:</th>';
                    echo '<th>Note Management:</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row["name"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["content"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["job_name"]) . '</td>';
                        echo '<td> <a href="managenote.php?id=' . $row["id"] . '&type=edit">Edit</a> <a href="managenote.php?id=' . $row["id"] . '&type=delete">Delete</a> </td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo "</table>";

                    mysqli_free_result($result);
                }
            }
            ?>
            <h2 id="note_h2">Create a Note</h2>
            <form action='managejobnote.php' method='POST' class="form_createnote">
                <input type="hidden" name="type" value="create">
                <select name='job_name' required>
                    <?php foreach ($jobs as $job): ?>
                        <option value="<?php echo htmlspecialchars($job['job_name']); ?>">
                            <?php echo htmlspecialchars($job['job_name']); ?>
                        </option>
                    <?php endforeach; ?>

                </select>
                <textarea name="content" id="textarea_createnote" placeholder="Note Content" maxlength="100"></textarea>

                <button type="submit">Create Note</button>
            </form>
        </div>
        <?php mysqli_close($conn); ?>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>

</html>