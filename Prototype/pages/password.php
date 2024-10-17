<!-- Ensure that xamp is running and navagiatve to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <header class="landing_header">
        <div>
            <img src="../images/placeholder.jpg" alt="Logo">
            <a href="./index.php">SMB Dashboard</a>
        </div>
        <ul>
            <li class="title">
                <strong>Forgot Password</strong>
            </li>
            <li>
                Please login to continue to [Company Name] Dashboard
            </li>
        </ul>
    </header>
    <main class="landing_main">
        <div class="box">
            <p>
                Forgot your password?
            </p>
            <p>
                A system admin will send you your new password as soon as possible.
            </p>
            <hr>
            <form action="../index.php" method="GET">
                <ul>
                    <li>
                        <label for="username">USERNAME*</label>
                        <input type="text" id="username" name="username" required placeholder="username">
                    </li>
                    <li>
                        <label for="password">PASSWORD*</label>
                        <input type="password" id="password" name="password" required placeholder="password">
                    </li>
                    <li>
                        <label for="password">Notes</label>
                        <textarea name="note" id="notes"></textarea>
                    </li>
                </ul>
                    <button id="forgot_password_submit" type="submit">Send Request</button>
            </form>
        </div>
    </main>
    <footer class="landing_footer">
        <div id="support">
            <a href=" ">Support</a>
        </div>
    </footer>
</body>
</html>