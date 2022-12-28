<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "is2109_library_reformed";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user WHERE email_OTP = '" . md5($_POST["otp"]) . "';";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row["email_OTP"] == md5($_POST["otp"])) {
        $sql = "UPDATE user SET email_verification = '1' WHERE email = '" . $_POST['email'] . "';";

        if ($conn->query($sql) === true) {
            echo " <script>
                   alert('Account verification done, you may sign in now');
                   window.location.replace('../login.php');
             </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

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
