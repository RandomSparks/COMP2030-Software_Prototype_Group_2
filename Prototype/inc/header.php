<div id="div_header">
    <div id="header_name">
        <p id="header_title">
            <?php echo isset($_SESSION["name"]) ? htmlspecialchars($_SESSION["name"]) : "Guest"; ?>
            <br>
            <?php echo isset($_SESSION["role_id"]) ? htmlspecialchars($_SESSION["role_id"]) : "Guest"; ?>
</br>
        </p>
    </div>
    <img src="../images/companyNameIcon.png" alt="Profile_Picture">
</div>