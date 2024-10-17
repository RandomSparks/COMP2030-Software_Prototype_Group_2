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
                            echo '<td> <a href="notes.php?id=' . $row["id"] . '&type=edit">Edit</a> <a href="managenote.php?id=' . $row["id"] . '&type=delete">Delete</a> </td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo "</table>";
                
                        mysqli_free_result($result);
                    }
                }

                if (isset($_GET["type"]) && $_GET["type"] == "edit") {
                    $id = htmlspecialchars($_GET["id"]);
                    $sql = "SELECT id, name, content, machine_name FROM Notes WHERE id = ?;";
                    $statement = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($statement, $sql);
                    mysqli_stmt_bind_param($statement, "i", $id);
                    mysqli_stmt_execute($statement);
                    $result = mysqli_stmt_get_result($statement);
                    $note = mysqli_fetch_assoc($result);
                    mysqli_stmt_close($statement);

                    if ($note) {
                        echo "<h3>Edit Note</h3>";
                        echo '<form action="managenote.php" method="post" id="form_editnote">';
                        echo '<input type="hidden" name="id" value="' . $note["id"] . '">';
                        echo '<label for="name">Edit Name:</label>';
                        echo '<input type="text" name="name" id="name" value="' . htmlspecialchars($note["name"]) . '" required>';
                        echo '<label for="content">Edit Content:</label>';
                        echo '<textarea name="content" id="textarea_editnote" required>' . htmlspecialchars($note["content"]) . '</textarea>';
                        echo '<label for="machine_name">Edit Machine:</label>';
                        echo '<select name="machine_name" id="machine_name" required>';
                        $machines = [
                            'CNC Machine', '3D Printer', 'Industrial Robot', 'Automated Guided Vehicle (AGV)',
                            'Smart Conveyor System', 'IoT Sensor Hub', 'Predictive Maintenance System',
                            'Automated Assembly Line', 'Quality Control Scanner', 'Energy Management System'
                        ];
                        foreach ($machines as $machine) {
                            $selected = $note["machine_name"] == $machine ? 'selected' : '';
                            echo '<option value="' . $machine . '" ' . $selected . '>' . $machine . '</option>';
                        }
                        echo '</select>';
                        echo '<button type="submit" name="update_note">Update Note</button>';
                        echo '</form>';
                        echo '<a href="notes.php"><button>Cancel</button></a>';
                    } 
                    else {
                        echo "Note not found!";
                    }
                } 
                else{
                    echo "<h3>Create Note</h3>";
                    echo "<form action='managenote.php' method='POST' id='form_createnote'>";
                    echo "<input type='hidden' name='type' value='create'>";
                    echo "<label for='name'>Note Name:</label>";
                    echo "<input type='text' name='name' id='name' placeholder='Note Name' maxlength='50' required>";
                    echo "<label for='content'>Note Content:</label>";
                    echo "<textarea name='content' id='textarea_createnote' placeholder='Note Content' maxlength='100'></textarea>";
                    echo "<label for='machine_name'>Machine Name:</label>";
                    echo "<select name='machine_name' id='machine_name' required>";
                    $machines = [
                        'CNC Machine', '3D Printer', 'Industrial Robot', 'Automated Guided Vehicle (AGV)',
                        'Smart Conveyor System', 'IoT Sensor Hub', 'Predictive Maintenance System',
                        'Automated Assembly Line', 'Quality Control Scanner', 'Energy Management System'
                    ];
                    foreach ($machines as $machine) {
                        echo "<option value='$machine'>$machine</option>";
                    }
                    echo "</select>";
                    echo "<button type='submit'>Create Note</button>";
                    echo "</form>";
                }
                mysqli_close($conn);
            ?>
        </div>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>
</html>
