<!DOCTYPE html>
<?php require_once 'php/admin_redirect_login.php' ?>
<html>
<head>
    <title>Admin home</title>
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

        <div>

        </div>
    </div>
</body>
</html>