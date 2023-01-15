<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
?>