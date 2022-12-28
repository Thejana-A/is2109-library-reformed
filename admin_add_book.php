<!DOCTYPE html>
<?php require_once 'php/admin_redirect_login.php' ?>
<html>
<head>
    <title>Admin add book</title>
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
        </div> <br> <br>
        <center>
            <div class="form-box">
                <form method="post" action="php/add_book.php">
                    <table>
                        <tr>
                            <td><center><h3>Add book</h3></center></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="name" required /></td>
                        </tr>
                        <tr>
                            <td>Author</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="author" required /></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="price" step="1" min="1" required /></td>
                        </tr>
                        <tr>
                            <td>Year</td>
                        </tr>
                        <tr>
                            <td><input type="number" name="year" step="1" min="0" required /></td>
                        </tr>
                    
                        <tr>
                            <td><center><input type="submit" value="Save" id="form-submit-button" /></center></td>
                        </tr>
                    </table>
                </form>
                </form>
            </div>
        </center>
    </div>
</body>
</html>
