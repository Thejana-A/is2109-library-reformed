<!DOCTYPE html>
<html>

<head>
    <title>OTP Verification</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body style="background-image: url('icon/common.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:cover;">

    <center>
        <div class="verify">
            <form method="post" action="php/otp_verification.php">
                <table>
                    <tr>
                        <td>
                            <center>
                                <h3>Verify email</h3>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                    </tr>
                    <tr>
                        <td><input type="email" name="email" value="<?php echo htmlspecialchars($_REQUEST['email']); ?>" readonly /></td>
                    </tr>
                    <tr>
                        <td>OTP Code</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="otp" required /></td>
                    </tr>
                    <tr>
                        <td>
                            <center><input type="submit" value="Verify" id="submit-button" /></center>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
</body>

</html>