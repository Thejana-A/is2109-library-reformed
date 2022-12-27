<!DOCTYPE html>
<?php require_once 'php/admin_redirect_login.php' ?>
<html>
<head>
    <title>Admin books</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
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
            <center>
                <a href="admin_books.php">Books</a>
                <a href="admin_members.php">Members</a>
                <a href="admin_borrowings.php">Borrowings</a>
            </center>
        </div>
        <center>
            <br>
            <div class="form-box">
                <table>
                    <tr>
                        <th>Member ID </th>
                        <th>Name </th>  
                        <th>Contact no </th> 
                        <th>City</th> 
                    </tr>
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "is2109_library_reformed";

                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM user WHERE userID != '1'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row["userID"]."</td><td>".$row["first_name"]." ".$row["last_name"]."</td><td>".$row["contact_no"]."</td><td>".$row["city"]."</td><td><a href='admin_update_member.php?userID=".$row["userID"]."'>&nbsp;&nbsp;View&nbsp;&nbsp;</a></td><td><a href='admin_delete_member.php?userID=".$row["userID"]."'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                    ?>

                    <tr>
                        <td></td>
                    </tr>
                </table>
            </div>
        </center>
    </div>
</body>
</html>