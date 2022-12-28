<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE user SET first_name = ?, last_name = ?, email = ?, DOB = ?, city = ?, contact_no = ?, active_status = ? WHERE userID = '".$_POST['userID']."';");
    $stmt->bind_param("sssssss", $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['DOB'], $_POST['city'], $_POST['contact_no'], $_POST['active_status']);
    $stmt->execute();
    $affectedRows = mysqli_stmt_affected_rows($stmt);
    if($affectedRows != -1){
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>User was updated successfully</center>";
        echo "</div>";
    } else {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Error: <br>" . $conn->error."</center>";
        echo "</div>";

    }

    $conn->close(); 
?>