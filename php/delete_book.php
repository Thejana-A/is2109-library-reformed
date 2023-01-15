<?php
    require_once 'db_connection.php';

    /*$sql = "DELETE FROM book WHERE bookID = '".$_POST['bookID']."';";
    if ($conn->query($sql) === TRUE) { */
    $stmt = $conn->prepare("DELETE FROM book WHERE bookID = ?;");
    $stmt->bind_param("i",$_POST['bookID']);
    $stmt->execute();
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    if($affectedRows != -1){
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