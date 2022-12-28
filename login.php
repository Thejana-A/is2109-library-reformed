<!DOCTYPE html>
<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    $_SESSION["email"] = ""; 
    $_SESSION["userID"] = ""; 
    $_SESSION["username"] = ""; 
?>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body style="background-image: url('icon/common.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:cover;">
    <center>
        <div class="login-box">
            <form method="post" action="php/login.php">
                <table>
                    <tr>
                        <td><center><h3>Login</h3></center></td>
                    </tr>
                    <tr>
                        <td>User email</td>
                    </tr>
                    <tr>
                        <td><input type="email" name="email" required /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                    </tr>
                    <tr>
                        <td><input type="password" name="password" required /></td>
                    </tr>
                    <tr>
                        <td><center><input type="submit" value="Login" id="submit-button" /></center></td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
</body>
</html>
