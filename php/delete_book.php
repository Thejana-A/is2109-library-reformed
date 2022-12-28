<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM book WHERE bookID = '".$_POST['bookID']."';";

    if ($conn->query($sql) === TRUE) {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Book was deleted successfully</center>";
        echo "</div>";
    } else {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Error:  <br>" . $conn->error."</center>";
        echo "</div>";
    }

    $conn->close(); 
?>