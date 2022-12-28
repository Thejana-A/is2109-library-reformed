<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $status = "available";
    $stmt = $conn->prepare("INSERT INTO book (name, author, price, year, status) VALUES (?,?,?,?,?)");
    $stmt->bind_param("ssiis",$_POST['name'],$_POST['author'],$_POST['price'],$_POST['year'],$status);
    $stmt->execute();
    $bookID = $conn->insert_id;
    if($bookID == 0){
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Sorry ! Book was not inserted</center>";
        echo "</div>";

        date_default_timezone_set("Asia/Calcutta");
        $error = "Error:book insertion failed";
	    $timestamp = date("Y-m-d h:i:s A");
	    echo file_put_contents("error_log.txt","$error- $timestamp \n",FILE_APPEND);
    }else{
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>New book was added successfully</center>";
        echo "</div>";
    }
    $conn->close(); 
?>
