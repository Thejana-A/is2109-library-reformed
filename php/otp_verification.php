<?php
require_once 'db_connection.php';

$sql = "SELECT * FROM user WHERE email_OTP = '" . sha1($_POST["otp"]) . "';";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row["email_OTP"] == sha1($_POST["otp"])) {
        /*$sql = "UPDATE user SET email_verification = '1' WHERE email = '" . $_POST['email'] . "';";
        if ($conn->query($sql) === true) {  */
        $stmt = $conn->prepare("UPDATE user SET email_verification = '1' WHERE email = ?;");
        $stmt->bind_param("s",$_POST['email']);
        $stmt->execute();
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        if($affectedRows != -1){
            echo " <script>
                   alert('Account verification done. You may sign in now');
                   window.location.replace('../login.php');
             </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } else {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Sorry! Invalid OTP code</center>";
        echo "</div>";
    }

} else {
    echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
    echo "<center>Sorry! Invalid OTP code</center>";
    echo "</div>";

}

$conn->close();
