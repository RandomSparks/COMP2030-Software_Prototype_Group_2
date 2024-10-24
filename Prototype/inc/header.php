<?php
session_start();
?>
<div id="div_header">
    <div id="header_name">
        <p id="header_title">
            <?php echo isset($_SESSION["role_id"]) ? htmlspecialchars($_SESSION["role_id"]) : "Guest"; ?>
        </p>
    </div>
    <img src="../images/companyNameIcon.png" alt="Profile_Picture">
</div>