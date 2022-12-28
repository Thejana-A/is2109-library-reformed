<!DOCTYPE html>
<?php require_once 'php/admin_redirect_login.php' ?>
<html>
<head>
    <title>Admin borrowings</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
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
            <br>
            <div class="form-box">
                <table>
                    <tr>
                        <th>Book ID |</th>
                        <th>Member ID |</th>  
                        <th>Borrowed on |</th> 
                        <th>Returned on</th> 
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

                        $sql = "SELECT * FROM borrowings";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row["bookID"]."</td><td>".$row["userID"]."</td><td>".$row["borrowing_date"]."</td><td>".$row["returning_date"]."</td><td><a href='admin_update_borrowing.php?borrowingID=".$row["borrowingID"]."'>&nbsp;&nbsp;View&nbsp;&nbsp;</a></td>";
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
