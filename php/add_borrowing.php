<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_borrow = $conn->prepare("INSERT INTO borrowings (bookID, userID, borrowing_date) VALUES (?,?,?)");
    $sql_borrow->bind_param("sss",$_POST['bookID'],$_POST['userID'],$_POST['borrowing_date']);
    $sql_borrow->execute();
    $borrowID = $conn->insert_id;
    $stmt = $conn->prepare("UPDATE book SET status = 'on borrow' WHERE bookID = ?;");
    $stmt->bind_param("i",$_POST['bookID']);
    $stmt->execute();
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    /*$sql_update_book = "UPDATE book SET status = 'on borrow' WHERE bookID = ".$_POST['bookID']." ;";
    if (($borrowID != 0)&&($conn->query($sql_update_book) === TRUE)) { */
    if (($borrowID != 0)&&($affectedRows != -1)) {  
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Book was lended successfully</center>";
        echo "</div>";
    } else {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Error:<br>".$conn->error."</center>";
        echo "</div>";

        date_default_timezone_set("Asia/Calcutta");
        $error = "Error:borrowing attempt failed ";
        $timestamp = date("Y-m-d h:i:s A");
        echo file_put_contents("error_log.txt","$error - $timestamp \n",FILE_APPEND);
    }

    $conn->close(); 
?>
