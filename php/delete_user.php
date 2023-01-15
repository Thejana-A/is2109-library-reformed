<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    //$sql = "DELETE FROM user WHERE userID = '".$_POST['userID']."';";
    $stmt = $conn->prepare("DELETE FROM user WHERE userID = ?;");
    $stmt->bind_param("i",$_POST['userID']);
    $stmt->execute();
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    if($affectedRows != -1){

    //if ($conn->query($sql) === TRUE) {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>User was deleted successfully</center>";
        echo "</div>";
    } else {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Error:<br>" . $conn->error."</center>";
        echo "</div>";
    }

    $conn->close(); 
?>