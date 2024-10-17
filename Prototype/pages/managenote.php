            <?php
            if (isset($_GET["type"]) && isset($_GET["id"])) {
                $id = htmlspecialchars($_GET["id"]);
                if ($_GET["type"] == "delete") {
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