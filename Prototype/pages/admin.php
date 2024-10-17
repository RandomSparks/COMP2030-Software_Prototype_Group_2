<!-- Ensure that xamp is running and navagiatve to localhost/COMP2030-Software_Prototype_Group_2/Prototype/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Developed_By" content="smul0003_basn0058_tami0009_will1941_beam0036_park0903">
    <title>Dashboard/Admin</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/script.js" defer></script>
</head>
<body>
    <main id="admin-main">
        <?php 
        require_once "../inc/sidebar.php"; 
        require_once "../inc/header.php";
        ?>
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