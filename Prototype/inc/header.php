<div id="div_header">
    <div id="header_name">
        <p id="header_title">
            <?php echo isset($_SESSION["name"]) ? htmlspecialchars($_SESSION["name"]) : "Guest"; ?>
        </p>
    </div>
    <img src="../images/companyNameIcon.png" alt="Profile_Picture">
</div>