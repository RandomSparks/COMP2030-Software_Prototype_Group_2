<!-- Ensure that xamp is running and navagiatve to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">
    <title>Dashboard/Performance</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/script.js" defer></script>
</head>

<body>
    <main id="performance-main">
        <?php require_once "../inc/sidebar.php";
        require_once "../inc/header.php";
        ?>
        <div class="div_content" id="perf_table">
            <?php
            require_once "../inc/dbconn.inc.php";

            $sql = "SELECT * FROM factory_logs LIMIT 25";
            $result = $conn->query($sql);

            if (!$result) {
                echo "Error: " . $conn->error;
                exit;
            }

            if ($result->num_rows > 0) {
                echo '<table id="factory_logs_table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Timestamp</th>';
                echo '<th>Machine Name</th>';
                echo '<th>Temperature</th>';
                echo '<th>Pressure</th>';
                echo '<th>Vibration</th>';
                echo '<th>Humidity</th>';
                echo '<th>Power Consumption</th>';
                echo '<th>Operational Status</th>';
                echo '<th>Error Code</th>';
                echo '<th>Production Count</th>';
                echo '<th>Maintenance Log</th>';
                echo '<th>Speed</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["timestamp"] . '</td>';
                    echo '<td>' . $row["machine_name"] . '</td>';
                    echo '<td>' . $row["temperature"] . '</td>';
                    echo '<td>' . $row["pressure"] . '</td>';
                    echo '<td>' . $row["vibration"] . '</td>';
                    echo '<td>' . $row["humidity"] . '</td>';
                    echo '<td>' . $row["power_consumption"] . '</td>';
                    echo '<td>' . $row["operational_status"] . '</td>';
                    echo '<td>' . $row["error_code"] . '</td>';
                    echo '<td>' . $row["production_count"] . '</td>';
                    echo '<td>' . $row["maintenance_log"] . '</td>';
                    echo '<td>' . $row["speed"] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo "No records found.";
            }

            $conn->close();
            ?>
        </div>
    </main>
    <footer>
        <div id="div_info">
            <?php require_once "../inc/info.php"; ?>
        </div>
    </footer>
</body>

</html>