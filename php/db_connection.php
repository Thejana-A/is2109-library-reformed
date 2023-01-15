<?php
    /*$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn){
        die("Connection failed: ".mysqli_connect_error());
    } */
    $db_params = parse_ini_file( dirname(__FILE__).'/db_params.ini', false );
    $conn = mysqli_connect($db_params['servername'], $db_params['username'], $db_params['password'], $db_params['dbname']);
    if (!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
?>