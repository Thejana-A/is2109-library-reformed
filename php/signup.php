<?php
require_once 'db_connection.php';

while (true) {
    $newImageName = uniqid() . "." . explode("/", $_FILES["membershipID"]["type"])[1];
    if (!file_exists("../membershipID/" . $newImageName)) {
        break;
    }

}

$target = "../membershipID/";
$fileTarget = $target . $newImageName;
$tempFileName = $_FILES["membershipID"]["tmp_name"];
$result = move_uploaded_file(htmlspecialchars($tempFileName), htmlspecialchars($fileTarget));
if ($result) {
    $otp = rand(100000, 999999);
    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, DOB, city, contact_no, membershipID, password, email_OTP) SELECT ?,?,?,?,?,?,?,?,? WHERE NOT EXISTS (SELECT userID FROM user WHERE email = ?);");
    $password = sha1($_POST['password']);
    $eotp = sha1($otp);
    $stmt->bind_param("ssssssssss", $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['DOB'], $_POST['city'], $_POST['contact_no'], $newImageName, $password, $eotp, $_POST["email"]);
    $stmt->execute();
    $userID = $conn->insert_id;
    if ($userID == 0) {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Sorry ! That email already exists.</center>";
        echo "</div>";

        date_default_timezone_set("Asia/Calcutta");
        $error = "Error:signup attempt failed " . $_POST['email'];
        $timestamp = date("Y-m-d h:i:s A");
        $message = "$error - $timestamp \n";
        echo file_put_contents("error_log.txt", htmlspecialchars($message), FILE_APPEND);
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
                    alert("<?php echo "OTP sent to ".htmlspecialchars($email) ?>");
                </script>
                <?php
        }

    }

} else {
    echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
    echo "<center>Sorry! Image wasn't uploaded.</center>";
    echo "</div>";
}
$conn->close();
