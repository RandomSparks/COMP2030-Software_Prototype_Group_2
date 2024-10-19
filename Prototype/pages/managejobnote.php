<?php
require_once "../inc/dbconn.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobName = htmlspecialchars($_POST["job_name"]);
    $content = htmlspecialchars($_POST["content"]);

    $sql = "INSERT INTO job_notes (job_name, note) VALUES (?, ?)";
    $statement = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($statement, $sql)) {
        mysqli_stmt_bind_param($statement, "ss", $jobName, $content);
        if (mysqli_stmt_execute($statement)) {
            header("Location: jobs.php");
        } else {
            echo "An error occurred: " . mysqli_error($conn);
        }
        mysqli_stmt_close($statement);
    } else {
        echo "An error occurred: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>