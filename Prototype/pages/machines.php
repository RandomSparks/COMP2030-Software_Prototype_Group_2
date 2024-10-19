<?php
include '../inc/dbconn.inc.php';


// Define the number of records per page
$records_per_page = 10;
$visible_pages = 5;
// Get the current page number from the URL, default is 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;

// Calculate the starting record for the query
$offset = ($page - 1) * $records_per_page;

// Fetch logs with LIMIT for pagination
$sql = "SELECT timestamp, machine_name, temperature, pressure, vibration, humidity, power_consumption, 
        operational_status, error_code, production_count, maintenance_log, speed
        FROM factory_logs 
        ORDER BY timestamp DESC 
        LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $offset, $records_per_page);
$stmt->execute();
$result = $stmt->get_result();

// Get the total number of records to calculate total pages
$total_records_sql = "SELECT COUNT(*) FROM factory_logs";
$total_records_result = $conn->query($total_records_sql);
$total_records = $total_records_result->fetch_row()[0];
$total_pages = ceil($total_records / $records_per_page);


$start_page = max(1, $page - floor($visible_pages / 2));
$end_page = min($total_pages, $page + floor($visible_pages / 2));

// Adjust if at the beginning or end of the range
if ($end_page - $start_page < $visible_pages - 1) {
    $end_page = min($total_pages, $start_page + $visible_pages - 1);
    $start_page = max(1, $end_page - $visible_pages + 1);
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
            <a href="add_factory_log.php" class="button">Add Machine</a>

            <h2>Machine List</h2>

            <?php if ($result->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>Timestamp</th>
                        <th>Machine Name</th>
                        <th>Temperature</th>
                        <th>Pressure</th>
                        <th>Vibration</th>
                        <th>Humidity</th>
                        <th>Power Consumption</th>
                        <th>Operational Status</th>
                        <th>Error Code</th>
                        <th>Production Count</th>
                        <th>Maintenance Log</th>
                        <th>Speed</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['timestamp']); ?></td>
                            <td><?php echo htmlspecialchars($row['machine_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['temperature']); ?></td>
                            <td><?php echo htmlspecialchars($row['pressure']); ?></td>
                            <td><?php echo htmlspecialchars($row['vibration']); ?></td>
                            <td><?php echo htmlspecialchars($row['humidity']); ?></td>
                            <td><?php echo htmlspecialchars($row['power_consumption']); ?></td>
                            <td><?php echo htmlspecialchars($row['operational_status']); ?></td>
                            <td><?php echo htmlspecialchars($row['error_code']); ?></td>
                            <td><?php echo htmlspecialchars($row['production_count']); ?></td>
                            <td><?php echo htmlspecialchars($row['maintenance_log']); ?></td>
                            <td><?php echo htmlspecialchars($row['speed'] ?? ''); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>

                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=1">&laquo; First</a>
                        <a href="?page=<?php echo $page - 1; ?>">&lt; Prev</a>
                    <?php else: ?>
                        <a class="disabled">&laquo; First</a>
                        <a class="disabled">&lt; Prev</a>
                    <?php endif; ?>

                    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?php echo $page + 1; ?>">Next &gt;</a>
                        <a href="?page=<?php echo $total_pages; ?>">Last &raquo;</a>
                    <?php else: ?>
                        <a class="disabled">Next &gt;</a>
                        <a class="disabled">Last &raquo;</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p>No factory logs found.</p>
            <?php endif; ?>

            <?php
            // Close the database connection
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>

</html>