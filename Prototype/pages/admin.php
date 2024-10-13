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
        <p>
        What whould you like to manage?
        </p>
        <ul>
            <li>
                <a href="./jobs.php">
                    <button id="button_jobs">
                    Jobs
                    </button>
                </a>
            </li>
            <li>
                <a href="./machines.php">
                    <button id="button_machines">
                    Machines
                    </button>
                </a>
            </li>
            <li>
                <a href="./users.php">
                    <button id="button_users">
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