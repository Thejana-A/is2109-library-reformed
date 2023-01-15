<!DOCTYPE html>
<?php require_once 'php/member_redirect_login.php' ?>
<?php require_once 'php/db_connection.php' ?>

<html>
<head>
    <title>Member borrowings</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
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
        </div><br>
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

                        $sql = "SELECT * FROM borrowings WHERE userID = ".$_SESSION["userID"];
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row["bookID"]."</td><td>".$row["userID"]."</td><td>".$row["borrowing_date"]."</td><td>".$row["returning_date"]."</td><td><a href='member_view_borrowing.php?borrowingID=".$row["borrowingID"]."'>&nbsp;&nbsp;View&nbsp;&nbsp;</a></td>";
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
