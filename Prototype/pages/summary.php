<!-- Ensure that xamp is running and navigate to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">

    <title>Dashboard/Reporting</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/script.js" defer></script>
</head>

<body>
    <main id="reporting-main">
        <?php
        require_once "../inc/sidebar.php";
        require_once "../inc/header.php";
        ?>
        <div class="div_content">
            <div class="summary_info">
                <?php
                require_once "../inc/dbconn.inc.php";

                $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
                $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

                if ($start_date && $end_date) {
                    $sql = "SELECT timestamp, machine_name, temperature, pressure, humidity, power_consumption, operational_status
                            FROM factory_logs 
                            WHERE timestamp BETWEEN ? AND ? 
                            ORDER BY timestamp DESC";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $start_date, $end_date);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo '<h2>Summary Report from ' . htmlspecialchars($start_date) . ' to ' . htmlspecialchars($end_date) . '</h2>';
                        echo '<table>';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Timestamp</th>';
                        echo '<th>Machine Name</th>';
                        echo '<th>Temperature</th>';
                        echo '<th>Pressure</th>';
                        echo '<th>Humidity</th>';
                        echo '<th>Power Consumption</th>';
                        echo '<th>Operational Status</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row["timestamp"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["machine_name"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["temperature"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["pressure"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["humidity"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["power_consumption"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["operational_status"]) . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo "No records found for the specified dates.";
                    }
                }

                $conn->close();
                ?>

                <form method="post" action="">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" required>
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" required>
                    <input type="submit" value="Get Summary Report">
                </form>
            </div>
        </div>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>

</html>