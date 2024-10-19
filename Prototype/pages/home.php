<!-- Ensure that xamp is running and navagiatve to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">
    <title>Dashboard/Home</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/script.js" defer></script>
</head>
<body>
    <main id="home-main">

        <?php 
        require_once "../inc/sidebar.php"; 
        require_once "../inc/header.php";
        ?>
        <div class="div_content">
            <h1 id="content_title">
                Welcome to the [Company Name] Smart Manufacturing Dashboard, Hiroshi.
            </h1>
            <p id="content_p">
                This Dashboard will allow to view factory status, production information, performance metrics, and any factory alerts.
                You can also edit accounts, assign jobs, machines, manage job information, and read reports from production operators.
            </p>
            <p id="content_p2">
                You may also configure your personal settings, request support, or log out of your account.
            </p>
        </div>
        
        <div class="div_content" id="content_admin">
            <p id="p_admin">
            What would you like to manage?
            </p>
            <ul>
                <li>
                    <a href="./alerts.php">
                    <img src="../images/jobsIcon.png" alt="Alerts">
                    </a>
                    <a href="./jobs.php">
                        <button>
                        Jobs
                        </button>
                    </a>
                </li>
                <li>
                    <a href="./machines.php">
                    <img src="../images/machinesIcon.png" alt="Machines">
                    </a>
                    <a href="./machines.php">
                        <button>
                        Machines
                        </button>
                    </a>
                </li>
                <li>
                    <a href="./maintenance.php">
                    <img src="../images/usersIcon.png" alt="User">
                    </a>
                    <a href="./users.php">
                        <button>
                        Users
                        </button>
                    </a>
                </li>        
            </ul>
        </div>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>
</html>