<?php
session_start();
require_once "../inc/dbconn.inc.php";
if (isset($_POST["update_user"])) {
    $user_id = htmlspecialchars($_POST["user_id"]);
    $username = htmlspecialchars($_POST["username"]);
    $role_id = htmlspecialchars($_POST["role_id"]);
    $password = htmlspecialchars($_POST["password"]);

    $sql = "UPDATE users SET username = ?, password = ?, role_id = ? WHERE user_id = ?";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, "sssi", $username, $password, $role_id, $user_id);
    if (mysqli_stmt_execute($statement)) {
        header("Location: users.php");
    } else {
        echo "An error occurred: " . mysqli_error($conn);
    }
    mysqli_stmt_close($statement);
} else if (isset($_POST["add_user"])) {
    $username = htmlspecialchars($_POST["username"]);
    $role_id = htmlspecialchars($_POST["role_id"]);
    $password = htmlspecialchars($_POST["password"]);

    $sql = "INSERT INTO users (username, password, role_id) VALUES (?, ?, ?)";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, "sss", $username, $password, $role_id);
    if (mysqli_stmt_execute($statement)) {
        header("Location: users.php");
    } else {
        echo "An error occurred: " . mysqli_error($conn);
    }
    mysqli_stmt_close($statement);
} else if (isset($_GET["delete"])) {
    $user_id = htmlspecialchars($_GET["delete"]);
    $sql = "DELETE FROM users WHERE user_id = ?";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, "i", $user_id);
    if (mysqli_stmt_execute($statement)) {
        header("Location: users.php");
    } else {
        echo "An error occurred: " . mysqli_error($conn);
    }
    mysqli_stmt_close($statement);
} else {
    echo "Error! Invalid request!";
}
?>