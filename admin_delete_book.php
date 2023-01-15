<!DOCTYPE html>
<?php require_once 'php/admin_redirect_login.php' ?>
<?php require_once 'php/db_connection.php' ?>
<html>
<head>
    <title>Admin delete book</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <?php

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
        </div> <br><br>

        <center>
            <div class="form-box">
                <form method="post" action="php/delete_book.php">
                    <table>
                        <tr>
                            <td><center><h3>Delete book</h3></center></td>
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
                            <td><input type="text" name="name" value="<?php echo $row["name"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Author</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="author" value="<?php echo $row["author"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="price" step="1" min="1" value="<?php echo $row["price"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Year</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="year" step="1" min="0" value="<?php echo $row["year"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="status" style="width:200px;">
                                    <option value="available" <?php echo ($row["status"]=="available"?"selected":"") ?>>Available</option>
                                    <option value="on borrow" <?php echo ($row["status"]=="on borrow"?"selected":"") ?>>On borrow</option>
                                    <option value="missing" <?php echo ($row["status"]=="missing"?"selected":"") ?>>Missing</option>
                                </select>
                            </td>
                        </tr>
                    
                        <tr>
                            <td><center><input type="submit" value="Delete" id="form-submit-button" /></center></td>
                        </tr>
                    </table>
                </form>
                </form>
            </div>
        </center>
    </div>
</body>
</html>
