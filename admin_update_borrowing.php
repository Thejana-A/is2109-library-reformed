<!DOCTYPE html>
<?php require_once 'php/admin_redirect_login.php' ?>
<html>
<head>
    <title>Admin update borrow</title>
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

        /*$sql = "SELECT * FROM borrowings, book, user WHERE borrowings.bookID = book.bookID AND borrowings.userID = user.userID AND borrowingID = ".$_GET["borrowingID"];
        $result = mysqli_query($conn, $sql); */
        $sql = "SELECT * FROM borrowings, book, user WHERE borrowings.bookID = book.bookID AND borrowings.userID = user.userID AND borrowingID = ?"; 
        $stmt = $conn->prepare($sql);
        $borrowingID = $_GET["borrowingID"];
        $stmt->bind_param("i", $borrowingID);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "0 results";
        }

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
                <form method="post" action="php/update_borrowing.php">
                    <table>
                        <tr>
                            <td><center><h3>Edit borrowing</h3></center></td>
                        </tr>
                        <tr>
                            <td>Borrowing ID</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="borrowingID" value="<?php echo $row["borrowingID"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Book ID</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="bookID" value="<?php echo $row["bookID"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Book name</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="name" value="<?php echo $row["name"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Member</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="user" value="<?php echo $row["userID"]." - ".$row["first_name"]." ".$row["last_name"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Borrowing date</td>
                        </tr>
                        <tr>
                            <td><input type="date" name="borrowing_date" value="<?php echo $row["borrowing_date"]; ?>" style="width:200px;" readonly /></td>
                        </tr>
                        <tr>
                            <td>Returning date</td>
                        </tr>
                        <tr>
                            <td><input type="date" name="returning_date" id="returning_date" value="<?php echo $row["returning_date"]; ?>" style="width:200px;" required /></td>
                        </tr>
                    
                        <tr>
                            <td><center>
                                <?php
                                    if($row["returning_date"] == ""){
                                        echo "<input type='submit' value='Save' id='form-submit-button' />";
                                    }else{
                                        echo "<input type='submit' value='Save' id='form-submit-button' disabled />";
                                    }
                                ?>
                                
                            </center></td>
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

        var min_returning_date = new Date();
        min_returning_date.setYear(min_returning_date.getFullYear());
        min_returning_date = min_returning_date.getFullYear() + '-' + addLeadingZeros(min_returning_date.getMonth(),2) + '-' + addLeadingZeros(min_returning_date.getDate(),2);

        document.getElementById("returning_date").setAttribute("min", min_returning_date);
        document.getElementById("returning_date").setAttribute("max", min_returning_date);
    </script>
</body>
</html>
