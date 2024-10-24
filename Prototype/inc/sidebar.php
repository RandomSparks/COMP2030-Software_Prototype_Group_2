<div id="div_sidebar">
    <div id="div_logo">
        <img src="../images/placeholder.jpg" alt="Logo">
        <h1>SMB Dashboard</h1>
    </div>
    <ul id="ul_menu">
        <li>
            <img src="../images/homeIcon.png" alt="home">
            <a href="home.php">
                Home
            </a>
        </li>
        <li>
            <img src="../images/overviewIcon.png" alt="overview">
            <a href="overview.php">
                Overview
            </a>
        </li>
        <li>
            <img src="../images/reportingIcon.png" alt="notes">
            <a href="notes.php">
                Messages
            </a>
        </li>
        <li>
            <img src="../images/productionIcon.png" alt="summary">
            <a href="summary.php">
                Summary
            </a>
        </li>
        <li>
            <img src="../images/jobsIcon.png" alt="jobs">
            <a href="jobs.php">
                Jobs
            </a>
        </li>
        <li>
            <img src="../images/machinesIcon.png" alt="machines">
            <a href="machines.php">
                Machines
            </a>
        </li>
        <?php if ($_SESSION["role_id"] === 'Administrator'): ?>
            <li>
                <img src="../images/usersIcon.png" alt="users">
                <a href="users.php">
                    Users
                </a>
            </li>
        <?php endif; ?>

    </ul>
    <div id="div_logout">
        <img src="../images/logoutIcon.png" alt="Logout">
        <a href="../index.php">
            Logout
        </a>
    </div>
</div>