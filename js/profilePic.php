<?php
    session_start();
    
    function writePic($img){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "petto";
        $tablename = "userinfo";
    
        $conn = new mysqli($servername,$username,$password,$dbname);

        $name = $_SESSION["username"];
    
        $conn = new mysqli($servername,$username,$password,$dbname);

        if($conn->connect_error){
            die("Connection failed : ".$conn->connect_error);
        }
        echo "Connected successfully <br>";

        $sql = "UPDATE $tablename SET image='$img' WHERE name='$name'";

        if($conn->query($sql) === TRUE){
            echo "Record updated successfully";
            $_SESSION['img'] = "$img";
            header('Location: ../profile.php');
            exit();
        }
        else{
            echo "Error updating record : ".$conn->error;
        }
        $conn->close();

        
    }

    function uploadPic(){
        $target_dir = "user/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $ok=1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_POST["submit"])){
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false){
                echo "File is an image - ".$check["mime"].".";
                $ok=1;
            }
            else {
                echo "File is not an image.";
                $ok=0;
            }
        }
        if(file_exists($target_file)){
            echo "Sorry, file already exists.";
            $ok = 0;
        }
        if($_FILES["fileToUpload"]["size"] > 500000){
            echo "Sorry, your file is too large.";
            $ok = 0;
        }
        if($ok==0){
            echo "Sorry, your file was not uploaded.";
        }
        else{
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"C:/xampp/htdocs/Petto/".$target_file)){
                writePic(basename($_FILES["fileToUpload"]["name"]));
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    uploadPic();
?>