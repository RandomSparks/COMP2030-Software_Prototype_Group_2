<?php
session_start();
include '../inc/dbconn.inc.php';

// Initialize error message variable
$errorMessage = "";

// Initialize variables with default values
$jobName = "";
$jobAllocated = "";
$jobDescription = "";
$jobCompleted = 0; // Default to false
$dateStarted = date('Y-m-d'); // Default to today's date
$dateCompleted = null;
$machine = "";

// Fetch all users for the dropdown
$users = [];
$user_query = "SELECT user_id, name FROM users";
$user_result = mysqli_query($conn, $user_query);
if ($user_result) {
    while ($user_row = mysqli_fetch_assoc($user_result)) {
        $users[] = $user_row;
    }
}

// Fetch machine options for the dropdown
$machines = [
    'CNC Machine',
    '3D Printer',
    'Industrial Robot',
    'Automated Guided Vehicle (AGV)',
    'Smart Conveyor System',
    'IoT Sensor Hub',
    'Predictive Maintenance System',
    'Automated Assembly Line',
    'Quality Control Scanner',
    'Energy Management System'
];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $jobName = trim($_POST['job_name']);
    $jobAllocated = trim($_POST['job_allocated']);
    $jobDescription = trim($_POST['job_description']);
    $jobCompleted = isset($_POST['job_completed']) ? 1 : 0; // Checkbox, default is false
    $dateStarted = $_POST['date_started'];
    $dateCompleted = $_POST['date_completed'] ? $_POST['date_completed'] : null;
    $machine = isset($_POST['machine']) ? trim($_POST['machine']) : null;

    // Validate required fields
    if (empty($jobName)) {
        $errorMessage = "Job Name is required.";
    } elseif (empty($jobAllocated)) {
        $errorMessage = "Job must be allocated to a user.";
    } else {
        // Insert into the database
        $stmt = $conn->prepare("INSERT INTO jobs (job_name, job_completed, date_started, date_completed, job_allocated, job_description, machine) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sississ', $jobName, $jobCompleted, $dateStarted, $dateCompleted, $jobAllocated, $jobDescription, $machine);

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
                    <label for="job_allocated">Job Allocated to:</label>
                    <select name="job_allocated" required>
                        <option value="">Select a user</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['user_id']; ?>" <?php echo $jobAllocated == $user['user_id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($user['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="machine">Machine (Optional):</label>
                    <select name="machine">
                        <option value="">Select a machine</option>
                        <?php foreach ($machines as $machineOption): ?>
                            <option value="<?php echo $machineOption; ?>" <?php echo $machine == $machineOption ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($machineOption); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
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