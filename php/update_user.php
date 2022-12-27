<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE user SET first_name = '".$_POST['first_name']."', last_name = '".$_POST['last_name']."', email = '".$_POST['email']."', DOB = '".$_POST['DOB']."', city = '".$_POST['city']."' , contact_no = '".$_POST['contact_no']."', active_status = '".$_POST['active_status']."' WHERE userID = '".$_POST['userID']."';";

    if ($conn->query($sql) === TRUE) {
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>User was updated successfully</center>";
        echo "</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); 
?>