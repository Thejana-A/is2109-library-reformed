<!DOCTYPE html>
<?php require_once 'php/admin_redirect_login.php' ?>
<?php require_once 'php/db_connection.php' ?>
<html>
<head>
    <title>Admin delete member</title>
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
        </div> <br>

        <center>
            <div class="form-box">
                <form method="post" action="php/delete_user.php" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td><center><h3>Delete member</h3></center></td>
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
                            <td><input type="text" name="first_name" value="<?php echo $row["first_name"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Last name</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="last_name" value="<?php echo $row["last_name"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="email" value="<?php echo $row["email"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Date of birth</td>
                        </tr>
                        <tr>
                            <td><input type="date" name="DOB" value="<?php echo $row["DOB"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>City</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="city" value="<?php echo $row["city"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Contact number</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="contact_no" value="<?php echo $row["contact_no"]; ?>" readonly /></td>
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
                            <td><center><input type="submit" value="Delete" id="submit-button" /></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>

    </div>
</body>
</html>
