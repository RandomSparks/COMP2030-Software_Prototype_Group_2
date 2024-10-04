<!-- Ensure that xamp is running and navagiatve to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
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
    <header>
        <div>
            <img src="" alt="Logo">
            <h1>Company Name</h1>
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
    <main>
        <div class="box">
            <p>
                Forgot your password?
            </p>
            <p>
                A system admin will send you your new password as soon as possible.
            </p>
            <hr>
            <form action="login.php" method="post">
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
                <div class="rememberMe">
                    <div>
                        <input type="checkbox" id="sign_in" name="sign_in">
                        <label for="sign_in">Keep me signed in</label>
                    </div>
                    <a href="">Forgotten Password?</a>
                </div> 
                    <button type="submit">Login</button>
            </form>
        </div>
    </main>
</body>
</html>