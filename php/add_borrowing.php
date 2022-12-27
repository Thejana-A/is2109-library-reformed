<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_borrow = "INSERT INTO borrowings (bookID, userID, borrowing_date) VALUES ('".$_POST['bookID']."', '".$_POST['userID']."', '".$_POST['borrowing_date']."');";
    $sql_update_book = "UPDATE book SET status = 'on borrow';";

    if (($conn->query($sql_borrow) === TRUE)&&($conn->query($sql_update_book) === TRUE)) {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Book was lended successfully</center>";
        echo "</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); 
?>
