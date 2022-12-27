<?php
    session_start();
    if($_SESSION["userID"] != 1){
        header("location:http://localhost/is2109-library-reformed/login.php");
        die();
    }
?>