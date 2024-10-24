<?php
require_once "../inc/dbconn.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">
    <title>Manage Note</title>
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
            if (isset($_GET["type"]) && isset($_GET["id"])) {
                $id = htmlspecialchars($_GET["id"]);
                if ($_GET["type"] == "edit") {
                    $sql = "SELECT id, name, content, machine_name FROM Notes WHERE id = ?;";
                    $statement = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($statement, $sql);
                    mysqli_stmt_bind_param($statement, "i", $id);
                    mysqli_stmt_execute($statement);
                    $result = mysqli_stmt_get_result($statement);
                    $note = mysqli_fetch_assoc($result);
                    mysqli_stmt_close($statement);

                    if ($note) {
                        echo '<form action="managenote.php" method="post" id="form_editnote">';
                        echo '<input type="hidden" name="id" value="' . $note["id"] . '">';
                        echo '<input type="text" name="name" value="' . htmlspecialchars($note["name"]) . '" required>';
                        echo '<textarea name="content" id="textarea_editnote" required>' . htmlspecialchars($note["content"]) . '</textarea>';
                        echo '<select name="machine_name" required>';
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
                    } 
                    
                    else {
                        echo "Note not found!";
                    }
                } 
                
                elseif ($_GET["type"] == "delete") {
                    $sql = "DELETE FROM Notes WHERE id = ?;";
                    $statement = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($statement, $sql);
                    mysqli_stmt_bind_param($statement, "i", $id);
                    if (mysqli_stmt_execute($statement)) {
                        header("Location: notes.php");
                    } 
                    
                    else {
                        echo "An error occurred: " . mysqli_error($conn);
                    }
                    mysqli_stmt_close($statement);
                } 
                
                else {
                    echo "Error! Invalid type!";
                }
                mysqli_close($conn);
            } 
            
            elseif (isset($_POST["type"]) && $_POST["type"] == "create") {
                $name = htmlspecialchars($_POST["name"]);
                $content = htmlspecialchars($_POST["content"]);
                $machine_name = htmlspecialchars($_POST["machine_name"]);

                $sql = "INSERT INTO Notes (name, content, machine_name) VALUES (?, ?, ?);";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql);
                mysqli_stmt_bind_param($statement, "sss", $name, $content, $machine_name);
                if (mysqli_stmt_execute($statement)) {
                    header("Location: notes.php");
                } else {
                    echo "An error occurred: " . mysqli_error($conn);
                }
                mysqli_stmt_close($statement);
                mysqli_close($conn);

            } 
            
            elseif (isset($_POST["update_note"])) {
                $id = htmlspecialchars($_POST["id"]);
                $name = htmlspecialchars($_POST["name"]);
                $content = htmlspecialchars($_POST["content"]);
                $machine_name = htmlspecialchars($_POST["machine_name"]);

                $sql = "UPDATE Notes SET name = ?, content = ?, machine_name = ?, updated = CURRENT_TIMESTAMP WHERE id = ?;";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql);
                mysqli_stmt_bind_param($statement, "sssi", $name, $content, $machine_name, $id);
                if (mysqli_stmt_execute($statement)) {
                    header("Location: notes.php");
                } else {
                    echo "An error occurred: " . mysqli_error($conn);
                }
                mysqli_stmt_close($statement);
                mysqli_close($conn);
            } 
            
            else {
                echo "Error! Invalid request!";
            }
            ?>
        </div>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>
</html>