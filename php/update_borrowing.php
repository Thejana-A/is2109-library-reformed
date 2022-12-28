<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_update_book = "UPDATE book SET status = 'available' WHERE bookID = '".$_POST['bookID']."';";
    $stmt = $conn->prepare("UPDATE borrowings SET returning_date =? WHERE borrowingID = '".$_POST['borrowingID']."';");
    $stmt->bind_param("s",$_POST['returning_date']);
    $stmt->execute();
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    if (($affectedRows != -1)&&($conn->query($sql_update_book) === TRUE)) {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Book was returned successfully</center>";
        echo "</div>";
    } else {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Error:<br>" . $conn->error."</center>";
        echo "</div>";

        date_default_timezone_set("Asia/Calcutta");
        $error = "Error:borrow updating failed ";
        $timestamp = date("Y-m-d h:i:s A");
        echo file_put_contents("error_log.txt","$error - $timestamp \n",FILE_APPEND);
    }

    $conn->close(); 
?>