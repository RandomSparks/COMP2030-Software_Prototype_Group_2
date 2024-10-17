<!-- Ensure that xamp is running and navagiatve to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
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

                $sql = "SELECT id, name, content, machine_name FROM Notes;";

                $countsql = "SELECT COUNT(*) as count FROM Notes;";

                if($count_result = mysqli_query($conn, $countsql)){
                    $numnote = mysqli_fetch_assoc($count_result);
                    echo "<h2 id='notes_count'>";
                    if($numnote['count'] > 1){
                        echo "{$numnote['count']} Notes";
                    }
                    else if($numnote['count'] > 0){
                        echo "{$numnote['count']} Note";
                    }
                    else {
                        echo "No Notes";
                    }
                    echo "</h2>";
                    mysqli_free_result($count_result);
                }   

                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table id="notes_table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Note Name:</th>';
                        echo '<th>Note Contents:</th>';
                        echo '<th>Machine Name:</th>';
                        echo '<th>Note Management:</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row["name"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["content"]) . '</td>';
                            echo '<td>' . htmlspecialchars($row["machine_name"]) . '</td>';
                            echo '<td> <a href="managenote.php?id=' . $row["id"] . '&type=edit">Edit</a> <a href="managenote.php?id=' . $row["id"] . '&type=delete">Delete</a> </td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo "</table>";
                
                        mysqli_free_result($result);
                    }
                }
                mysqli_close($conn);
            ?>
            <form action='managenote.php' method='POST' id="form_createnote">
                <input type="hidden" name="type" value="create">
                <input type='text' name='name' placeholder='Note Name' required>
                <textarea name="content" id="textarea_createnote" placeholder="Note Content"></textarea>
                <select name='machine_name' required>
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
                <button type="submit">Create Note</button>
            </form>
        </div>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>
</html>
