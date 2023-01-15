<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    /*$sql = "SELECT * FROM user WHERE userID = '".$_POST["userID"]."';";
    $result = mysqli_query($conn, $sql);  */
    $sql = "SELECT * FROM user WHERE userID = ?"; 
    $stmt = $conn->prepare($sql);
    $userID = $_POST["userID"];
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row["password"] == sha1($_POST["current_password"])){
            /*$sql_reset_password = "UPDATE user SET password = '".sha1($_POST['password'])."' WHERE userID = '".$_POST['userID']."';";
            if ($conn->query($sql_reset_password) === TRUE) { */
            $stmt = $conn->prepare("UPDATE user SET password = '".sha1($_POST['password'])."' WHERE userID = ?;");
            $stmt->bind_param("i",$_POST['userID']);
            $stmt->execute();
            $affectedRows = mysqli_stmt_affected_rows($stmt);
            if($affectedRows != -1){
                echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
                echo "<center>Password was updated successfully</center>";
                echo "</div>";
            } else {
                echo "Error: " . $sql_reset_password . "<br>" . $conn->error;
            }
        }else{
            echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
            echo "<center>Sorry! Current password is incorrect.</center>";
            echo "</div>";
        }
    }else{
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Sorry! An error occured.</center>";
        echo "</div>";
    }

    $conn->close(); 
?>