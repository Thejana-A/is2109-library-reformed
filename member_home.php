<!DOCTYPE html>
<?php require_once 'php/member_redirect_login.php' ?>
<html>
<head>
    <title>Member home</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script>
        function acceptCookies() {
            let text = "We use cookies on our website to see how you interact with it. By accepting, you agree to our use of such cookies.";
            if (confirm(text) === true) {
                document.cookie = "username=<?php echo $_SESSION["username"]; ?>";
                alert("Hi "+(document.cookie.split(";")[1]).split("=")[1]+"! Welcome you to library system");
            }else{
                document.cookie = "username=<?php echo $_SESSION["username"]; ?>;expires=Thu, 18 Dec 2013 12:00:00 UTC";
                alert("Hi ! Welcome you to library system");
            }
        }
    </script>
</head>
<body onload="acceptCookies()" style="background-image: url('icon/member_home.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:cover;">
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
        <div>
        <div>

        </div>
    </div>
</body>
</html>
