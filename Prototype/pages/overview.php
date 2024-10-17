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
                        **Overview**
                    </h2>
                    <img src="../images/companyNameIcon.png" alt="CompanyNameIcon">
                </div>

                <div class="machine_info">
                    <h3>Machine Information</h3>
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

                    $conn->close();
                    ?>
                </div>
            </div>

            <!-- Grid of 4 analytics -->
            <div class="overview_wrapper">
                <div class="analytics_box">
                    <h3>Analytics 1</h3>
                    <?php

                    ?>
                </div>
            <div class="analytics_box">
                <h3>Analytics 2</h3>
                <?php

                ?>
            </div>
            <div class="analytics_box">
                <h3>Analytics 3</h3>
                <?php
                
                ?>
            </div>
            <div class="analytics_box">
                <h3>Analytics 4</h3>
                <?php
                
                ?>
            </div>
            </div>
        </div>

    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>
</html>