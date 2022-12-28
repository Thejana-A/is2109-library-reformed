<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "is2109_library_reformed";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

while (true) {
    $newImageName = uniqid() . "." . explode("/", $_FILES["membershipID"]["type"])[1];
    if (!file_exists("../membershipID/" . $newImageName)) {
        break;
    }

}

$target = "../membershipID/";
$fileTarget = $target . $newImageName;
$tempFileName = $_FILES["membershipID"]["tmp_name"];
$result = move_uploaded_file($tempFileName, $fileTarget);
if ($result) {
    $otp = rand(100000, 999999);
    $sql = "INSERT INTO user (first_name, last_name, email, DOB, city, contact_no, membershipID, password, email_OTP) SELECT '" . $_POST['first_name'] . "', '" . $_POST['last_name'] . "', '" . $_POST['email'] . "', '" . $_POST['DOB'] . "', '" . $_POST['city'] . "', '" . $_POST['contact_no'] . "', '" . $newImageName . "' , '" . md5($_POST['password']) . "' , '" . md5($otp) . "' WHERE NOT EXISTS (SELECT userID FROM user WHERE email = '" . $_POST['email'] . "');";
    if ($conn->query($sql) === true) {
        $employeeID = $conn->insert_id;
        if ($employeeID == 0) {
            echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
            echo "<center>Sorry ! That email already exists.</center>";
            echo "</div>";
        } else {
            $email = $_POST['email'];

            require_once "../PHPMailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';

            $mail->Username = 'pksthimaya@gmail.com';
            $mail->Password = 'ymjkeiefakvzmrwr';

            $mail->setFrom('pksthimaya@gmail.com', 'OTP Verification');
            $mail->addAddress($_POST["email"]);

            $mail->isHTML(true);
            $mail->Subject = "OTP Verification code";
            $mail->Body = "<p>Dear user, </p> <h3>Your verification OTP code is $otp <br></h3>
                    <br>
                    <a href='https://localhost/is2109-library-reformed/verify_email.php?email=$email'>Click here</a> to proceed";

            if (!$mail->send()) {
                ?>
                <script>
                    alert("<?php echo "Invalid Email " ?>");
                </script>
                <?php
} else {
                ?>
                <script>
                    alert("<?php echo "OTP sent to " . $email ?>");
                </script>
                <?php
}

        }
    } else {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Error: " . $sql . "<br>" . $conn->error . "</center>";
        echo "</div>";
    }
} else {
    echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
    echo "<center>Sorry! Image wasn't uploaded.</center>";
    echo "</div>";
}
$conn->close();
?>