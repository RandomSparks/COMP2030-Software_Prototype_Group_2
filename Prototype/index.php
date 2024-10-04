<!-- Ensure that xamp is running and navagiatve to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">
    <title>Login_Page</title>
</head>
<body>
    <header>
        <h1>
        Company Name
        </h1>
        <ul>
            <li>
                Login Portal
            </li>
            <li>
                Please login to continue to [Company Name] Dashboard
            </li>
        </ul>
    </header>
    <main>
        <p>
            Welcome to the [Company Name] Smart Manufacturing Dashboard! Please login to continue.
        </p>
        <form action="login.php" method="post">
            <ul>
                <li>
                     <label for="username">USERNAME</label>
                </li>
                <li>
                    <input type="text" id="username" name="username" required>
                </li>
                <li>
                    <label for="password">PASSWORD</label>
                </li>
                <li>
                    <input type="password" id="password" name="password" required>
                </li>
            </ul>
                <button type="submit" id="Login">Login</button>
                <input type="checkbox" id="sign_in" name="sign_in">
                <label for="sign_in">Keep me signed in</label>
                <a href=""><p id="ForgotPassLink">Forgotten Password?</p></a> 
                
        </form>
    </main>
</body>
</html>