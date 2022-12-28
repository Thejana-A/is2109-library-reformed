<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "is2109_library_reformed";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    while (true) {
        $newImageName = uniqid().".".explode("/", $_FILES["membershipID"]["type"])[1];
        if (!file_exists("../membershipID/".$newImageName)) break;
    }
    
    $target = "../membershipID/";		
    $fileTarget = $target.$newImageName;	
    $tempFileName = $_FILES["membershipID"]["tmp_name"];
    $result = move_uploaded_file($tempFileName,$fileTarget);
    if($result) { 
        $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, DOB, city, contact_no, membershipID, password) SELECT ?,?,?,?,?,?,?,? WHERE NOT EXISTS (SELECT userID FROM user WHERE email = ".$_POST['email'].";");
        $password = md5($_POST['password']);
        $stmt->bind_param("ssssssss",$_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['DOB'],$_POST['city'],$_POST['contact_no'] , $newImageName,$password);
        $stmt->execute();
        $userID = $conn->insert_id;
        if($userID == 0){
            echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
            echo "<center>Sorry ! That email already exists.</center>";
            echo "</div>";
        }else{
            echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
            echo "<center>Signed up successfully</center>";
            echo "</div>";
        }
    
    }else{
        echo "<div style='background-color:#a8a8ec;border-radius:3px;padding:5px;'>";
        echo "<center>Sorry! Image wasn't uploaded.</center>";
        echo "</div>";
    }
    $conn->close(); 
?>
