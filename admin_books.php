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
            <a href="admin_add_book.php" style="text-decoration:none;background-color:#efefef;padding:6px;padding-left:20px;padding-right:20px;border-radius:5px;">Add new book</a>
            <div class="form-box">
                <table>
                    <tr>
                        <th>Book ID </th>
                        <th>Name </th>  
                        <th>Author </th> 
                        <th>Status</th> 
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

                        $sql = "SELECT * FROM book";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row["bookID"]."</td><td>".$row["name"]."</td><td>".$row["author"]."</td><td>".$row["status"]."</td><td><a href='admin_update_book.php?bookID=".$row["bookID"]."'>&nbsp;&nbsp;View&nbsp;&nbsp;</a></td><td><a href='admin_delete_book.php?bookID=".$row["bookID"]."'>Delete</a></td>";
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