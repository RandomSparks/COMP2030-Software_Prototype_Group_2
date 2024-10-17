<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// session_start();
require_once "./inc/dbconn.inc.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $post_password = trim($_POST['password']);

    // Check if fields are empty
    if (empty($username) || empty($post_password)) {
        echo 'Please fill in all fields.';
        exit();
    }


    $sql = "SELECT * FROM users WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters

        mysqli_stmt_bind_param($stmt, "s", $username);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Store result
            mysqli_stmt_store_result($stmt);
            // Check if username exists, if yes then verify password
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $user_id, $username, $password, $role_id);
                if (mysqli_stmt_fetch($stmt)) {
                    if ($post_password === $password) {

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $user_id;
                        $_SESSION["username"] = $username;
                        $_SeSSION["role"] = $role_id;

                        // Redirect user to welcome page
                        header("location: ./pages/home.php");
                    } else {
                        // Password is not valid, display a generic error message
                        $login_err = "Invalid username or password.";
                    }
                }
            } else {
                // Username doesn't exist, display a generic error message
                $login_err = "Invalid username or password.";
            }
        } else {
            $login_err = "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();