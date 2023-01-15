<?php
    $servername = "localhost";
    //$username = "root";
    $user = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = mysqli_connect($servername, $user, $password, $dbname);
    if (!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
?>