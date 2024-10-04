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
                <strong>Login Portal</strong>
            </li>
            <li>
                Please login to continue to [Company Name] Dashboard
            </li>
        </ul>
    </header>
    <main>
        <div class="box">
            <p>
                Welcome to the [Company Name] Smart Manufacturing Dashboard! Please login to continue.
            </p>
            <hr>
            <form action="login.php" method="post">
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
                    <a href="">Forgotten Password?</a>
                </div> 
                    <button type="submit">Login</button>
            </form>
        </div>
    </main>
    
    <footer>
        <div id="support">
            <a href=" ">Support</a>
        </div>
    </footer>
</body>
</html>