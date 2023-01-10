<!DOCTYPE html>
<html>
<head>
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script>
    function acceptCookies() {
        let text = "We use cookies on our website to see how you interact with it. By accepting, you agree to our use of such cookies.";
        if (confirm(text) == true) {
            <?php if(isset($_COOKIE['username'])){
                $username = $_COOKIE['username'];
            }
            else {
                setcookie('user', 'username', time() + 3600*24);
            }?>
        }
        else{
            setcookie('user', '', time() + -3600);
        }
    }
</script>
</head>

<body onload="acceptCookies()"
    style="background-image: url('icon/index.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:cover;">
    <div class="container">
        <div class="top">
            <img src="./icon/logo.jpg" style="float:left;width:80px;">
            <img src="./icon/logo.jpg" style="float:right;width:80px;">
            <center>
                <h1>Reading Club</h1>
            </center>
        </div>
        <div class="mid">
            <a href="login.php">Login</a>
            <a href="signup.php">Sign up</a>
        </div>
        <br><br>
        <div>
            <center>
                <h1><b>Hi , Welcome to our online library platform !!! </b></h1>
                <h2>
                    "Books are mirrors: You only see in them what you already have inside you." <br>
                    – Carlos Ruiz Zafón
                </h2>
            </center>

        </div>
    </div>
</body>


</html>