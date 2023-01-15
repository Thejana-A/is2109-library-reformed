<?php
    require_once 'db_connection.php';

    //$sql_update_book = "UPDATE book SET status = 'available' WHERE bookID = '".$_POST['bookID']."';";
    $stmt = $conn->prepare("UPDATE borrowings SET returning_date =? WHERE borrowingID = ?;");
    $stmt->bind_param("si",$_POST['returning_date'], $_POST['borrowingID'] );
    $stmt->execute();
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    $stmt2 = $conn->prepare("UPDATE book SET status = 'available' WHERE bookID = ?;");
    $stmt2->bind_param("i",$_POST['bookID']);
    $stmt2->execute();
    $affectedRows2 = mysqli_stmt_affected_rows($stmt2);
    //if (($affectedRows != -1)&&($conn->query($sql_update_book) === TRUE)) {
    if (($affectedRows != -1)&&($affectedRows2 != -1)) {
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