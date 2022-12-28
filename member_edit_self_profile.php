<!DOCTYPE html>
<?php require_once 'php/member_redirect_login.php' ?>
<html>
<head>
    <title>Admin edit self profile</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "is2109_library_reformed";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn){
            die("Connection failed: ".mysqli_connect_error());
        }
        $userID = $_SESSION["userID"];
        $sql = "SELECT * FROM user WHERE userID = ".$userID;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "0 results";
        }

        mysqli_close($conn);
    ?>

    <script>
        function validateMemberForm(){
            var first_name = document.forms["editProfileForm"]["first_name"].value;
            var last_name = document.forms["editProfileForm"]["last_name"].value;
            if (/^[a-zA-Z\s]+$/.test(first_name) == false) {
                alert("First name must have only letters and spaces");
                return false;
            }else if (/^[a-zA-Z\s]+$/.test(last_name) == false) {
                alert("Last name must have only letters and spaces");
                return false;
            }else{
                return true;
            }
        }

        function validateResetPassword(){
            var password = document.forms["resetPasswordForm"]["password"].value;
            var confirm_password = document.forms["resetPasswordForm"]["confirm_password"].value;
            if (password.length < 8) {
                alert("Password must have at least 8 characters");
                return false;
            }else if (password != confirm_password) {
                alert("Confirm your password correctly");
                return false;
            }else{
                return true;
            }
        }
    </script>

</head>
<body style="background-image: url('icon/member_home.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:cover;">
    <div class="container">
        <div class="top">
            <img src="./icon/logo.jpg" style="float:left;width:80px;">
            <img src="./icon/logo.jpg" style="float:right;width:80px;">
            <center><h1>Reading Club</h1></center>
        </div>
        <div class="mid">
            <a href="login.php">Logout</a>
            <a href="member_edit_self_profile.php"><?php echo $_SESSION["username"]; ?></a> 
        </div>
       <div class="nav">
            <div class="nav-btn">
                <center>
                    <a href="member_books.php">Books</a>
                    <a href="member_borrowings.php">Borrowings</a>
                </center>
            </div>
        </div><br><br>

        <center>
            <div class="form-box">
                <form method="post" action="php/update_user.php" enctype="multipart/form-data" name="editProfileForm" onSubmit="return validateMemberForm()">
                    <table>
                        <tr>
                            <td><center><h3>Edit profile</h3></center></td>
                        </tr>
                        <tr>
                            <td>User ID</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="userID" value="<?php echo $row["userID"]; ?>" readonly /></td>
                            <input type="text" hidden="true" name="active_status" value="<?php echo $row["active_status"]; ?>" readonly />
                        </tr>
                        <tr>
                            <td>First name</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="first_name" value="<?php echo $row["first_name"]; ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Last name</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="last_name" value="<?php echo $row["last_name"]; ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="email" value="<?php echo $row["email"]; ?>" required readonly /></td>
                        </tr>
                        <tr>
                            <td>Date of birth</td>
                        </tr>
                        <tr>
                            <td><input type="date" name="DOB" id="DOB" style="width:200px;" value="<?php echo $row["DOB"]; ?>" required /></td>
                        </tr>
                        <tr>
                            <td>City</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="city" value="<?php echo $row["city"]; ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Contact number</td>
                        </tr>
                        <tr>
                            <td><input type="tel" name="contact_no" pattern="[0-9]{2} [0-9]{3} [0-9]{3} [0-9]{3}" placeholder="94 123 456 789" value="<?php echo $row["contact_no"]; ?>" required /></td>
                        </tr>
                        <tr>
                            <td><center><input type="submit" value="Save" id="submit-button" /></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>

        <center>
            <div class="form-box">
                <form method="post" action="php/reset_password.php" name="resetPasswordForm" onSubmit="return validateResetPassword()">
                    <table>
                    <tr>
                            <td><center><h3>Reset password</h3></center></td>
                        </tr>
                        <tr>
                            <td>User ID</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="userID" value="<?php echo $row["userID"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Current password</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="current_password" required /></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" required /></td>
                        </tr>
                        <tr>
                            <td>Confirm password</td>
                        </tr>
                        <tr>
                            <td><input type="password" name="confirm_password" required /></td>
                        </tr>

                        <tr>
                            <td><center><input type="submit" value="Save" id="submit-button" /></center></td>
                        </tr>
                    </table>
                </form>
            </div>
    </center>

    </div>
    <script>
        function addLeadingZeros(num, totalLength) {
            return String(num).padStart(totalLength, '0');
        }

        var max_DOB = new Date();
        max_DOB.setYear(max_DOB.getFullYear()-6);
        max_DOB = max_DOB.getFullYear() + '-' + addLeadingZeros(max_DOB.getMonth(),2) + '-' + addLeadingZeros(max_DOB.getDate(),2);

        document.getElementById("DOB").setAttribute("max", max_DOB);
    </script>
</body>
</html>
