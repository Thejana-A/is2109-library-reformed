<!DOCTYPE html>
<?php require_once 'php/member_redirect_login.php' ?>
<html>
<head>
    <title>Member view book</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "is2109_library_reformed";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn){
            die("Connection failed: ".mysqli_connect_error());
        }

        /*$sql = "SELECT * FROM book WHERE bookID = ".$_GET["bookID"];
        $result = mysqli_query($conn, $sql);  */
        $sql = "SELECT * FROM book WHERE bookID = ?"; 
        $stmt = $conn->prepare($sql);
        $bookID = $_GET["bookID"];
        $stmt->bind_param("i", $bookID);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "0 results";
        }

    ?>
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
                <form method="post" action="php/update_book.php">
                    <table>
                        <tr>
                            <td><center><h3>View book</h3></center></td>
                        </tr>
                        <tr>
                            <td>Book ID</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="bookID" value="<?php echo $row["bookID"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="name" value="<?php echo $row["name"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Author</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="author" value="<?php echo $row["author"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="price" step="1" min="1" value="<?php echo $row["price"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Year</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="year" step="1" min="0" value="<?php echo $row["year"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="status" value="<?php echo $row["status"]; ?>" /></td>
                        </tr>
                    
                    </table>
                </form>
            </div>
        </center>

    </div>
</body>
</html>
