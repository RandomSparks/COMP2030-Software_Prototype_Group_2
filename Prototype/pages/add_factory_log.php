<?php
session_start();

include '../inc/dbconn.inc.php';


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $timestamp = $_POST['timestamp'];
    $machine_name = $_POST['machine_name'];
    $temperature = $_POST['temperature'];
    $pressure = $_POST['pressure'];
    $vibration = $_POST['vibration'];
    $humidity = $_POST['humidity'];
    $power_consumption = $_POST['power_consumption'];
    $operational_status = $_POST['operational_status'];
    $error_code = $_POST['error_code'];
    $production_count = $_POST['production_count'];
    $maintenance_log = $_POST['maintenance_log'];
    $speed = $_POST['speed'];
    $user = $_POST['user'];

    // Prepare SQL statement
    $sql = "INSERT INTO factory_logs (timestamp, machine_name, temperature, pressure, vibration, humidity, power_consumption, operational_status, error_code, production_count, maintenance_log, speed, user) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssdddddssisss', $timestamp, $machine_name, $temperature, $pressure, $vibration, $humidity, $power_consumption, $operational_status, $error_code, $production_count, $maintenance_log, $speed, $user);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully.";
        header("Location: machines.php");

    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<<!DOCTYPE html>
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
                <h1>Add Factory Log</h1>
                <form method="POST" action="">
                    <label for="timestamp">Timestamp:</label>
                    <input type="datetime-local" id="timestamp" name="timestamp" required><br>

                    <label for="machine_name">Machine Name:</label>
                    <input type="text" id="machine_name" name="machine_name" required><br>

                    <label for="temperature">Temperature:</label>
                    <input type="number" step="any" id="temperature" name="temperature"><br>

                    <label for="pressure">Pressure:</label>
                    <input type="number" step="any" id="pressure" name="pressure"><br>

                    <label for="vibration">Vibration:</label>
                    <input type="number" step="any" id="vibration" name="vibration"><br>

                    <label for="humidity">Humidity:</label>
                    <input type="number" step="any" id="humidity" name="humidity"><br>

                    <label for="power_consumption">Power Consumption:</label>
                    <input type="number" step="any" id="power_consumption" name="power_consumption"><br>

                    <label for="operational_status">Operational Status:</label>
                    <input type="text" id="operational_status" name="operational_status"><br>

                    <label for="error_code">Error Code:</label>
                    <input type="text" id="error_code" name="error_code"><br>

                    <label for="production_count">Production Count:</label>
                    <input type="number" id="production_count" name="production_count"><br>

                    <label for="maintenance_log">Maintenance Log:</label>
                    <textarea id="maintenance_log" name="maintenance_log"></textarea><br>

                    <label for="speed">Speed:</label>
                    <input type="number" step="any" id="speed" name="speed"><br>

                    <label for="user">User:</label>
                    <input type="text" id="user" name="user"><br>

                    <input type="submit" value="Add Log">
                </form>
            </div>
        </main>
        <footer>
            <?php require_once "../inc/info.php"; ?>
        </footer>
    </body>

    </html>