<?php
session_start();

require_once 'db_connection.php';

/*$sql = "SELECT * FROM user WHERE email = '" . $_POST["email"] . "';";
$result = mysqli_query($conn, $sql); */
$sql = "SELECT * FROM user WHERE email = ?"; 
$stmt = $conn->prepare($sql);
$email = $_POST["email"];
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row["password"] == sha1($_POST["password"])) {
        if ($row["email_verification"] == 1) {
            if ($row["active_status"] == "enable") {
                session_start();
                $_SESSION["email"] = $row["email"];
                $_SESSION["userID"] = $row["userID"];
                $_SESSION["username"] = $row["first_name"] . " " . $row["last_name"];
                if ($row["userID"] == 1) {
                    header("location: http://localhost/is2109-library-reformed/admin_home.php");
                } else {
                    header("location: http://localhost/is2109-library-reformed/member_home.php");
                }

                date_default_timezone_set("Asia/Calcutta");
                $userID = $_SESSION["userID"];
                $timestamp = date("Y-m-d h:i:s A");
                echo file_put_contents("login_log.txt", "Log in by $userID - $timestamp \n", FILE_APPEND);
            } else {
                echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
                echo "<center>Sorry! Your account is inactive.</center>";
                echo "</div>";
            }
        } else {
            echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
            echo "<center>Sorry! Your email isn't verified.</center>";
            echo "</div>";
        }

    } else {
        // echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        // echo "<center>Sorry! Credentials are invalid</center>";
        // echo "</div>";
        $_SESSION["attempts"] += 1;
        $_SESSION["error"] = "Sorry! Credentials are invalid";
        echo "<script type='text/javascript'>
            window.location.replace('../login.php')
            </script>";

    }

} else {
    $_SESSION["attempts"] += 1;
    $_SESSION["error"] = "Sorry! Credentials are invalid";
    echo "<script type='text/javascript'>
        window.location.replace('../login.php');
        </script>";

}

$conn->close();
