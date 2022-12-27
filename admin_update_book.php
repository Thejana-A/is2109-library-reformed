<!DOCTYPE html>
<?php require_once 'php/admin_redirect_login.php' ?>
<html>
<head>
    <title>Admin update book</title>
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

        $sql = "SELECT * FROM book WHERE bookID = ".$_GET["bookID"];
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "0 results";
        }

    ?>
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
            <div class="form-box">
                <form method="post" action="php/update_book.php">
                    <table>
                        <tr>
                            <td><center><h3>Edit book</h3></center></td>
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
                            <td><input type="text" name="name" value="<?php echo $row["name"]; ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Author</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="author" value="<?php echo $row["author"]; ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="price" step="1" min="1" value="<?php echo $row["price"]; ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Year</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="year" step="1" min="0" value="<?php echo $row["year"]; ?>" required /></td>
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
                            <td><center><input type="submit" value="Save" id="form-submit-button" /></center></td>
                        </tr>
                    </table>
                </form>
            </div>
        </center>

        <center>
            <div class="form-box">
                <form method="post" action="php/add_borrowing.php">
                    <table>
                        <tr>
                            <td><center><h3>Lending book</h3></center></td>
                        </tr>
                        <tr>
                            <td>Book ID</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="bookID" value="<?php echo $row["bookID"]; ?>" readonly /></td>
                        </tr>
                        <tr>
                            <td>Member</td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                    echo "<select name = 'userID' style='width:200px;'>";
                                        $sql_user = "SELECT * FROM user WHERE userID != '1'";
                                        $result_user = $conn->query($sql_user);
                                        if ($result_user->num_rows > 0) {
                                            while($row_member = $result_user->fetch_assoc()) {
                                            echo "<option value='".$row_member["userID"]."'>".$row_member["userID"]." - ".$row_member["first_name"]." ".$row_member["last_name"]."</option>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                    echo "</select>";
                                    
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Borrowing date</td>
                        </tr>
                        <tr>
                            <td><input type="date" name="borrowing_date" id="borrowing_date" style="width:200px;" /></td>
                        </tr>

                        <tr>
                            <td><center>
                                <?php 
                                    if($row["status"] == "available"){
                                        echo "<input type='submit' value='Save' id='form-submit-button' />";
                                    }else{
                                        echo "<input type='submit' value='Save' id='form-submit-button' disabled />";
                                    } 
                                    $conn->close();
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

        var min_borrowing_date = new Date();
        min_borrowing_date.setYear(min_borrowing_date.getFullYear());
        min_borrowing_date = min_borrowing_date.getFullYear() + '-' + addLeadingZeros(min_borrowing_date.getMonth(),2) + '-' + addLeadingZeros(min_borrowing_date.getDate(),2);

        document.getElementById("borrowing_date").setAttribute("min", min_borrowing_date);
        document.getElementById("borrowing_date").setAttribute("max", min_borrowing_date);
    </script>
    
</body>
</html>