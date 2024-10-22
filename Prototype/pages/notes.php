<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">

    <title>Dashboard/Alerts</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/script.js" defer></script>
</head>

<body>
    <main id="notes-main">
        <?php
        require_once "../inc/sidebar.php";
        require_once "../inc/header.php";
        ?>
        <div class="div_content">
            <?php
            require_once "../inc/dbconn.inc.php";

            // Check if the user is an administrator
            $isAdmin = $_SESSION["role_id"] === 'Administrator';
            $userId = $_SESSION['user_id']; // Assuming you store user_id in session
            // Prepare the SQL query based on user role
            if ($isAdmin) {
                $sql = "SELECT Notes.id, Notes.name, Notes.content, Notes.machine_name, Notes.assigned_to, users.name AS assigned_user 
                        FROM Notes 
                        LEFT JOIN Users ON Notes.assigned_to = users.user_id";
            } else {
                // Non-admin users only see their assigned notes
                $sql = "SELECT Notes.id, Notes.name, Notes.content, Notes.machine_name, Notes.assigned_to, users.name AS assigned_user 
                        FROM Notes 
                        LEFT JOIN Users ON Notes.assigned_to = users.user_id 
                        WHERE Notes.assigned_to = ? OR Notes.assigned_to = 0"; // 0 for 'Everyone'
            }

            // Count the number of notes
            $countsql = "SELECT COUNT(*) as count FROM Notes" . ($isAdmin ? ";" : " WHERE assigned_to = ? OR assigned_to = 0;");
            // Prepare statement for counting notes if not admin
            if (!$isAdmin) {
                $countstmt = mysqli_prepare($conn, $countsql);
                mysqli_stmt_bind_param($countstmt, 'i', $userId);
                mysqli_stmt_execute($countstmt);
                $count_result = mysqli_stmt_get_result($countstmt);
            } else {
                $count_result = mysqli_query($conn, $countsql);
            }

            if ($count_result) {
                $numnote = mysqli_fetch_assoc($count_result);
                echo "<h2 id='notes_count'>";
                if ($numnote['count'] > 1) {
                    echo "Notes ({$numnote['count']})";
                } else if ($numnote['count'] > 0) {
                    echo "Notes {$numnote['count']}";
                } else {
                    echo "No Notes";
                }
                echo "</h2>";
                mysqli_free_result($count_result);
            }

            // Execute the main query to fetch notes
            if ($isAdmin) {
                $result = mysqli_query($conn, $sql);
            } else {
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'i', $userId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
            }

            if ($result && mysqli_num_rows($result) > 0) {
                echo '<table id="notes_table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Note Name:</th>';
                echo '<th>Note Contents:</th>';
                echo '<th>Machine Name:</th>';
                echo '<th>Assigned To:</th>';
                echo '<th>Note Management:</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $assigned_to_display = ($row['assigned_to'] == 0) ? 'Everyone' : htmlspecialchars($row['assigned_user']);
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row["name"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["content"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["machine_name"]) . '</td>';
                    echo '<td>' . $assigned_to_display . '</td>';
                    echo '<td> <a href="managenote.php?id=' . $row["id"] . '&type=edit">Edit</a> <a href="managenote.php?id=' . $row["id"] . '&type=delete">Delete</a> </td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo "</table>";

                mysqli_free_result($result);
            }
            ?>
            <form action='managenote.php' method='POST' class="form_createnote">
                <input type="hidden" name="type" value="create">
                <input type='text' name='name' placeholder='Note Name' maxlength="50" required>
                <textarea name="content" id="textarea_createnote" placeholder="Note Content" maxlength="100"></textarea>
                <select name='machine_name' required>
                    <option value = 'None'>None</option>
                    <option value='CNC Machine'>CNC Machine</option>
                    <option value='3D Printer'>3D Printer</option>
                    <option value='Industrial Robot'>Industrial Robot</option>
                    <option value='Automated Guided Vehicle (AGV)'>Automated Guided Vehicle (AGV)</option>
                    <option value='Smart Conveyor System'>Smart Conveyor System</option>
                    <option value='IoT Sensor Hub'>IoT Sensor Hub</option>
                    <option value='Predictive Maintenance System'>Predictive Maintenance System</option>
                    <option value='Automated Assembly Line'>Automated Assembly Line</option>
                    <option value='Quality Control Scanner'>Quality Control Scanner</option>
                    <option value='Energy Management System'>Energy Management System</option>
                </select>
                <select name="assigned_to" required>
                    <option value="0">Everyone</option>

                    <?php
                    // Fetch users from the database
                    $user_query = "SELECT user_id, name FROM users";
                    $user_result = mysqli_query($conn, $user_query);
                    if ($user_result && mysqli_num_rows($user_result) > 0) {
                        while ($user_row = mysqli_fetch_assoc($user_result)) {
                            echo '<option value="' . $user_row['user_id'] . '">' . htmlspecialchars($user_row['name']) . '</option>';
                        }
                    }
                    ?>
                </select>
                <button type="submit">Create Note</button>
            </form>
        </div>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>

</html>