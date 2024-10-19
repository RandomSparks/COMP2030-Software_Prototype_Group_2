<!-- Ensure that xamp is running and navagiatve to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">
    <title>Dashboard/Overview</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/script.js" defer></script>
</head>

<body>
    <main id="overview-main">
        <?php
        require_once "../inc/sidebar.php";
        require_once "../inc/header.php";
        require_once "../inc/dbconn.inc.php";
        ?>

        <div class="div_content">
            <div>
                <div class="overview_title">
                    <h2>
                        Overview
                    </h2>
                    <img src="../images/companyNameIcon.png" alt="CompanyNameIcon">
                </div>

                <div class="machine_info">
                    <h3>Machine Temperature</h3>
                    <?php

                    $sql = "SELECT timestamp, machine_name, temperature FROM factory_logs LIMIT 25";
                    $result = $conn->query($sql);

                    if (!$result) {
                        echo "Error: " . $conn->error;
                        exit;
                    }

                    if ($result->num_rows > 0) {
                        echo '<table id="machine_temperature_table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Timestamp</th>';
                        echo '<th>Machine Name</th>';
                        echo '<th>Temperature</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row["timestamp"] . '</td>';
                            echo '<td>' . $row["machine_name"] . '</td>';
                            echo '<td>' . $row["temperature"] . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo "No records found.";
                    }
                    ?>
                </div>

            </div>
            <div class="overview_wrapper">
                <div class="analytics_box">
                    <h3>Machine Pressure</h3>
                    <?php
                    $sql = "SELECT timestamp, machine_name, pressure FROM factory_logs LIMIT 25";
                    $result = $conn->query($sql);

                    if (!$result) {
                        echo "Error: " . $conn->error;
                        exit;
                    }

                    if ($result->num_rows > 0) {
                        echo '<table id="machine_pressure_table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Timestamp</th>';
                        echo '<th>Machine Name</th>';
                        echo '<th>Pressure</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row["timestamp"] . '</td>';
                            echo '<td>' . $row["machine_name"] . '</td>';
                            echo '<td>' . $row["pressure"] . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo "No records found.";
                    }
                    ?>
                </div>
                <div class="analytics_box">
                    <h3>Power Consumption</h3>
                    <?php
                    $sql = "SELECT timestamp, machine_name, power_consumption FROM factory_logs LIMIT 25";
                    $result = $conn->query($sql);

                    if (!$result) {
                        echo "Error: " . $conn->error;
                        exit;
                    }

                    if ($result->num_rows > 0) {
                        echo '<table id="machine_power_consumption_table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Timestamp</th>';
                        echo '<th>Machine Name</th>';
                        echo '<th>Power Consumption</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row["timestamp"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["machine_name"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["power_consumption"]) . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo "No records found.";
                    }
                    ?>
                </div>
                <div class="analytics_box">
                    <h3>Machine Humidity</h3>
                    <?php
                    $sql = "SELECT timestamp, machine_name, humidity FROM factory_logs LIMIT 25";
                    $result = $conn->query($sql);

                    if (!$result) {
                        echo "Error: " . $conn->error;
                        exit;
                    }

                    if ($result->num_rows > 0) {
                        echo '<table id="machine_humidity_table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Timestamp</th>';
                        echo '<th>Machine Name</th>';
                        echo '<th>Humidity</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row["timestamp"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["machine_name"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["humidity"]) . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo "No records found.";
                    }
                    ?>
                </div>
                <div class="analytics_box">
                    <h3>Machine Speed</h3>
                    <?php
                    $sql = "SELECT timestamp, machine_name, speed FROM factory_logs LIMIT 25";
                    $result = $conn->query($sql);

                    if (!$result) {
                        echo "Error: " . $conn->error;
                        exit;
                    }

                    if ($result->num_rows > 0) {
                        echo '<table id="machine_speed_table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Timestamp</th>';
                        echo '<th>Machine Name</th>';
                        echo '<th>Speed</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row["timestamp"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["machine_name"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["speed"]) . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo "No records found.";
                    }
                    ?>
                </div>
            </div>

            <div id="perf_table">
                <?php
                require_once "../inc/dbconn.inc.php";

                $sql = "
        SELECT fl.*
        FROM factory_logs fl
        INNER JOIN (
            SELECT machine_name, MAX(timestamp) AS latest_timestamp
            FROM factory_logs
            GROUP BY machine_name
        ) subquery
        ON fl.machine_name = subquery.machine_name AND fl.timestamp = subquery.latest_timestamp
        ORDER BY fl.timestamp DESC
    ";
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
        </div>

    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>

</html>