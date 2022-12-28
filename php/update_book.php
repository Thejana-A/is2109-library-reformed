<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("UPDATE book SET name = ?, author = ?, price = ?, year = ?, status = ? WHERE bookID = ".$_POST['bookID'].";");
    $stmt->bind_param("ssiis",$_POST['name'],$_POST['author'],$_POST['price'],$_POST['year'],$_POST['status']);
    $stmt->execute();
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    if($affectedRows == -1){
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Sorry ! An error occured.</center>";
        echo "</div>";
    }else{
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Book was updated successfully</center>";
        echo "</div>";
    }
    $conn->close(); 
?>