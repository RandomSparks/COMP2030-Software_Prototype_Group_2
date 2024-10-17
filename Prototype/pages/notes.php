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
                        echo "{$numnote['count']} notes";
                    }
                    else if($numtask['count'] > 0){
                        echo "{$numnote['count']} note";
                    }
                    else {
                        echo "No notes";
                    }
                    echo "</h2>";
                    mysqli_free_result($count_result);
                }   

                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo '<table id="notes_table">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>Summary:</th>';
                        echo '<th>Note Contents:</th>';
                        echo '<th>Machine Name:</th>';
                        echo '<th>Note Management:</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while($row = mysqli_fetch_assoc($result)){
                            
                            echo '<td>' . $row["name"] . '</td>';
                            echo '<td>' . $row["content"] . '</td>';
                            echo '<td>' . $row["machine_name"] . '</td>';
                            echo '<td> <a href="editnote.php?id=' . $row["id"] . '">Edit</a><a href="deletenote.php?id=' . $row["id"] . '">Delete</a> </td>';
                            echo '</tr>';
                        }
                        echo '<tr>';
                        echo "<td><button></button></td>";
                        echo '</tr>';
                        echo '</tbody>';
                        echo "</table>";
                        
                        mysqli_free_result($result);
                    }
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
