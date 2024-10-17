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
            <h2>Manage Users</h2>
            <?php
            require_once "../inc/dbconn.inc.php";
            $sql = "SELECT user_id, username, password, role_id FROM users";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Username</th>';
                echo '<th>Role</th>';
                echo '<th>Password Hash</th>';
                echo '<th>Role Management</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row["username"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["role_id"]) . '</td>';
                    echo '<td>' . password_hash($row["password"], PASSWORD_DEFAULT) . '</td>';
                    echo '<td><a href="users.php?edit=' . $row["user_id"] . '">Edit</a></td>';
                    echo "<td><a href='editusers.php?delete=" . $row["user_id"] . "'>Delete</a></td>";
                    echo '</tr>';
                }
                echo '<tr>';
                echo '<td><a href="users.php?add=true>"Add User</a></td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
            } else {
                echo "No users found.";
            }
            ?>
            <?php
            if (isset($_GET["edit"])) {
                $user_id = htmlspecialchars($_GET["edit"]);
                $sql = "SELECT user_id, username, password, role_id FROM users WHERE user_id = ?";
                $statement = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($statement, $sql);
                mysqli_stmt_bind_param($statement, "i", $user_id);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                $user = mysqli_fetch_assoc($result);
                mysqli_stmt_close($statement);
                if ($user) {
                    echo '<h3>Edit User</h3>';
                    echo '<form action="editusers.php" method="post">';
                    echo '<input type="hidden" name="user_id" value="' . $user["user_id"] . '">';
                    echo '<label for="username">Username:</label>';
                    echo '<input type="text" name="username" value="' . htmlspecialchars($user["username"]) . '" required>';
                    echo '<label for="password">New Password:</label>';
                    echo '<input type="password" name="password" placeholder="Encrypted"required>';
                    echo '<label for="role_id">Role:</label>';
                    echo '<select name="role_id" required>';
                    $roles = ['Administrator', 'Manager', 'Operator', 'Auditor'];
                    foreach ($roles as $role) {
                        $selected = $user["role_id"] == $role ? 'selected' : '';
                        echo '<option value="' . $role . '" ' . $selected . '>' . $role . '</option>';
                    }
                    echo '</select>';
                    echo '<button type="submit" name="update_user">Update User</button>';
                    echo '</form>';
                    echo '<a href="users.php"><button>Cancel</button></a>';
                    
                } else {
                    echo "User not found.";
                }
            }
            else {
                echo '<h3>Add User</h3>';
                echo '<form action="editusers.php" method="post">';
                echo '<label for="username">Username:</label>';
                echo '<input type="text" name="username" placeholder="Username"required>';
                echo '<label for="password">Password:</label>';
                echo '<input type="text" name="password" placeholder="Password" required>';
                echo '<label for="role_id">Role:</label>';
                echo '<select name="role_id" required>';
                $roles = ['Administrator', 'Manager', 'Operator', 'Auditor'];
                foreach ($roles as $role) {
                    echo "<option value=" . $role . ">" . $role . "</option>";
                }
                echo '</select>';
                echo '<button type="submit" name="add_user">Add User</button>';
                echo '</form>';
            }


            ?>
        </div>
    </main>
    <footer>
        <?php require_once "../inc/info.php"; ?>
    </footer>
</body>
</html>
<?php
mysqli_close($conn);
?>