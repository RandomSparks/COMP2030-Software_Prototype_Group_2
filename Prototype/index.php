<!-- Ensure that xamp is running and navigate to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
<?php
session_start();
require_once "./inc/dbconn.inc.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $sql = "SELECT user_id, username, password, role_id FROM users WHERE username = ?";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($statement);

    if ($user && $password == $user["password"]) {
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role_id"] = $user["role_id"];
        header("Location: ./pages/home.php");
        exit();
    } else {
        $login_err = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">
    <title>Login_Page</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header class="landing_header">
        <div>
            <img src="images/placeholder.jpg" alt="Logo">
            <a href="./index.php">SMD Dashboard</a>
        </div>
        <ul>
            <li class="title">
                <strong>Login Portal</strong>
            </li>
            <li>
                <p>
                    Please login to continue to [Company Name] Dashboard
                </p>
            </li>
        </ul>
    </header>
    <main class="landing_main">
        <div class="box">
            <p>
                Welcome to the [Company Name] Smart Manufacturing Dashboard! Please login to continue.
            </p>
            <?php if (isset($login_err) && $login_err): ?>
                <div style="color: red;">
                    <p><?php echo htmlspecialchars($login_err); ?></p>
                </div>
            <?php endif; ?>
            <hr>
            <form action="" method="post">
                <ul>
                    <li>
                        <label for="username">USERNAME</label>
                        <input type="text" id="username" name="username" required placeholder="username">
                    </li>
                    <li>
                        <label for="password">PASSWORD</label>
                        <input type="password" id="password" name="password" required placeholder="password">
                    </li>
                </ul>
                <div class="rememberMe">
                    <div>
                        <input type="checkbox" id="sign_in" name="sign_in">
                        <label for="sign_in">Keep me signed in</label>
                    </div>
                    <a href="./pages/password.php">Forgotten Password?</a>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </main>
    <footer class="landing_footer">
        <div id="support">
            <a href="">Support</a>
        </div>
    </footer>
</body>
</html>