<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("UPDATE book SET name = ?, author = ?, price = ?, year = ?, status = ? WHERE bookID = ?;");
    $stmt->bind_param("ssiisi",$_POST['name'],$_POST['author'],$_POST['price'],$_POST['year'],$_POST['status'], $_POST['bookID']);
    $stmt->execute();
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    if($affectedRows == -1){
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Sorry ! An error occured.</center>";
        echo "</div>";

        date_default_timezone_set("Asia/Calcutta");
        $error = "Error:book updating failed ";
        $timestamp = date("Y-m-d h:i:s A");
        echo file_put_contents("error_log.txt","$error - $timestamp \n",FILE_APPEND);
    }else{
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Book was updated successfully</center>";
        echo "</div>";
    }
    $conn->close(); 
?>