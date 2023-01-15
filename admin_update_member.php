<!DOCTYPE html>
<?php require_once 'php/admin_redirect_login.php' ?>
<?php require_once 'php/db_connection.php' ?>
<html>
<head>
    <title>Admin update member</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <?php

        /*$sql = "SELECT * FROM user WHERE userID = ".$_GET["userID"];
        $result = mysqli_query($conn, $sql); */
        $sql = "SELECT * FROM user WHERE userID = ?"; 
        $stmt = $conn->prepare($sql);
        $userID = $_GET["userID"];
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

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
    </script>

</head>
<body style="background-image: url('icon/admin_home.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:cover;">
    <div class="container">
        <div class="top">
            <img src="./icon/logo.jpg" style="float:left;width:80px;">
            <img src="./icon/logo.jpg" style="float:right;width:80px;">
            <center><h1>Reading Club</h1></center>
        </div>
        <div class="mid">
            <a href="login.php">Logout</a>
            <a href="admin_edit_self_profile.php"><?php echo $_SESSION["username"]; ?></a> 
        </div>
        <div class="nav">
            <div class="nav-btn">
                <center>
                   <a href="admin_books.php">Books</a>
                   <a href="admin_members.php">Members</a>
                   <a href="admin_borrowings.php">Borrowings</a>
                </center>
            </div>
        </div> <br><br>

        <center>
            <div class="form-box">
                <form method="post" action="php/update_user.php" enctype="multipart/form-data" name="editProfileForm" onSubmit="return validateMemberForm()">
                    <table>
                        <tr>
                            <td><center><h3>Edit member</h3></center></td>
                        </tr>
                        <tr>
                            <td>Member ID</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="userID" value="<?php echo $row["userID"]; ?>" readonly /></td>
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
                            <td>Library membership card</td>
                        </tr>
                        <tr>
                            <td><img src="./membershipID/<?php echo $row["membershipID"] ?>" style="width:210px;" /></td>
                        </tr>
                        <tr>
                            <td>Active status</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="active_status" value="enable" <?php echo ($row["active_status"] == "enable"?"checked":"") ?> /> Enable
                                <input type="radio" name="active_status" value="disable" <?php echo ($row["active_status"] == "disable"?"checked":"") ?> /> Disable
                            </td>
                        </tr>

                        <tr>
                            <td><center><input type="submit" value="Save" id="submit-button" /></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>

    </div>
    
</body>
</html>
