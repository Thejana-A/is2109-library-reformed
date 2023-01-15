<?php
    require_once 'db_connection.php';

    $stmt = $conn->prepare("UPDATE user SET first_name = ?, last_name = ?, email = ?, DOB = ?, city = ?, contact_no = ?, active_status = ? WHERE userID = ?;");
    $stmt->bind_param("sssssssi", $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['DOB'], $_POST['city'], $_POST['contact_no'], $_POST['active_status'], $_POST['userID']);
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

        date_default_timezone_set("Asia/Calcutta");
        $error = "Error:user updating failed ";
        $timestamp = date("Y-m-d h:i:s A");
        echo file_put_contents("error_log.txt","$error - $timestamp \n",FILE_APPEND);

    }

    $conn->close(); 
?>