<?php
    session_start();

    function addDatabase($img){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "petto";
        $tablename = "pet";
    
        $type = $_POST['type'];
        $id = $_POST['id'];
        $sex=$_POST['sex'];
        $color=$_POST['color'];
        $gene=$_POST['gene'];
        $age=$_POST['age'];
    
        $conn = new mysqli($servername,$username,$password,$dbname);
    
        if($conn->connect_error){
            die("Connection failed : ".$conn->connect_error);
        }
        echo "Connect successfully <br>";
        
    
        $sql = "CREATE TABLE $tablename (
        idx INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        type VARCHAR(60) NOT NULL,
        id INT(4) NOT NULL,
        sex VARCHAR(255) NOT NULL,
        color VARCHAR(255) NOT NULL,
        gene VARCHAR(255) NOT NULL,
        age VARCHAR(255) NOT NULL,
        image VARCHAR(60) NOT NULL
        )";
    
        if($conn->query($sql) === TRUE){
            echo "Table $tablename created successfully";
        }
        else{
            echo "Error creating table : ",$conn->error;
        }
    
        $sql = "INSERT INTO $tablename (type,id,sex,color,gene,age,image) VALUES('$type','$id','$sex','$color','$gene','$age','$img')";
    
        if($conn->query($sql) === TRUE){
            echo "New record created successfully";
        }
        else{
            echo "Error : ".$sql."<br>".$conn->error;
        }
        $conn->close();
        header('Location:../Petto_pet.php');
    }


    function uploadPic(){
        $target_dir = "pet/";
        $target_file = $target_dir . basename($_FILES["petToUpload"]["name"]);
        $ok=1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_POST["submit"])){
            $check = getimagesize($_FILES["petToUpload"]["tmp_name"]);
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
        if($_FILES["petToUpload"]["size"] > 500000){
            echo "Sorry, your file is too large.";
            $ok = 0;
        }
        if($ok==0){
            echo "Sorry, your file was not uploaded.";
        }
        else{
            if(move_uploaded_file($_FILES["petToUpload"]["tmp_name"],"C:/xampp/htdocs/Petto/".$target_file)){
                addDatabase(basename($_FILES["petToUpload"]["name"]));
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    uploadPic();
    // header('Location:../js/storePic.php');

?>