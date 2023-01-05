<!DOCTYPE html>
<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    $_SESSION["email"] = ""; 
    $_SESSION["userID"] = ""; 
    $_SESSION["username"] = ""; 

    if (isset($_SESSION["locked"])) {
        $difference = time() - $_SESSION["locked"];
        if ($difference > 3) {
            unset($_SESSION["locked"]);
            unset($_SESSION["attempts"]);
        }
}
?>

<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body
    style="background-image: url('icon/common.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:cover;">
    <div class="top">
        <img src="./icon/logo.jpg" style="float:left;width:80px;">
        <img src="./icon/logo.jpg" style="float:right;width:80px;">
        <center>
            <h1>Reading Club</h1>
        </center>
    </div>
    <div class="mid">
        <a href="index.php">Home</a>
    </div>
    <br><br>
    <center><br>
        <div class="login-box">
            <form method="post" action="php/login.php">
                <table>
                    <tr>
                        <td>
                            <center>
                                <h3>Login</h3>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td>User email</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="email" required /></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                    </tr>
                    <tr>
                        <td><input type="password" name="password" required /></td>
                    </tr>
                    <tr>
                        <td><?php
                                if (!isset($_SESSION["error"])) {
                                    $_SESSION["error"] = null;
                                } else {
                                    echo "<p class='text' style='color:red;text-align:center;padding:4px;'>";
                                    echo $_SESSION["error"];
                                    echo "</p>";
                                    unset($_SESSION["error"]);
                                }
                                if (!isset($_SESSION["attempts"])) {
                                    $_SESSION["attempts"] = null;
                                }
                                if ($_SESSION["attempts"] > 3) {
                                    $_SESSION["locked"] = time();
                                    echo "<div class='text' style='color:red;text-align:center;padding:1px;margin-top:2px;'>Try again after 3 seconds</div>";
                                } else { ?>
                            <center><input type="submit" value="Login" id="submit-button" /></center>
                        </td>
                        <?php } ?>
                    </tr>
                </table>
                <div style="font-size:12px;">Don't have an account <a href="signup.php"
                        style="text-decoration:none;color:red;">Sign up for free</a></div>
            </form>
        </div>
    </center>
</body>

</html>