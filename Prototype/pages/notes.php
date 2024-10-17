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
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Handle form submission to add a new note
            if (isset($_POST["machine_name"])) {
                $note = $conn->real_escape_string($_POST["note"]);
                $sql = "INSERT INTO Notes (content, machine_name) VALUES ('$note')";
                if ($conn->query($sql) === TRUE) {
                    echo "New note added successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // Fetch all notes from the database
            $sql = "SELECT id, content FROM notes";
            $result = $conn->query($sql);
            ?>

            <div class="notes-container">
                <h2>Notes</h2>
                <ul>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($row["content"]) . "</li>";
                        }
                    } else {
                        echo "<li>No notes available</li>";
                    }
                    ?>
                </ul>
            </div>

            <div class="add-note">
                <h2>Add a new note</h2>
                <form method="post" action="">
                    <textarea name="note" required></textarea>
                    <button type="submit">Add Note</button>
                </form>
            </div>

            <?php
            $conn->close();
            ?>
            </div>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>
</html>
