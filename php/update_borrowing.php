<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_update_borrowing = "UPDATE borrowings SET returning_date = '".$_POST['returning_date']."' WHERE borrowingID = '".$_POST['borrowingID']."';";
    $sql_update_book = "UPDATE book SET status = 'available' WHERE bookID = '".$_POST['bookID']."';";

    if (($conn->query($sql_update_borrowing) === TRUE)&&($conn->query($sql_update_book) === TRUE)) {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Book was returned successfully</center>";
        echo "</div>";
    } else {
        echo "Error: " . $sql_update_borrowing . "<br>" . $conn->error;
    }

    $conn->close(); 
?>