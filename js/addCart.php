<?php
    session_start();

    function addDatabase($img){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "petto";
        $tablename = "store";
    
        $type = $_POST['type'];
        $id = $_POST['id'];
        $name = $_POST['name'];
        $detail=$_POST['detail'];
        $price=$_POST['price'];
        // $img=$_GET['storeToUpload'];
    
        $conn = new mysqli($servername,$username,$password,$dbname);
    
        if($conn->connect_error){
            die("Connection failed : ".$conn->connect_error);
        }
        echo "Connect successfully <br>";
        
    
        $sql = "CREATE TABLE $tablename (
        type VARCHAR(60) NOT NULL,
        id INT(4) NOT NULL,
        name VARCHAR(60) NOT NULL,
        detail VARCHAR(255) NOT NULL,
        price INT(6) NOT NULL,
        image VARCHAR(60) NOT NULL,
        status INT(100) NOT NULL
        )";
    
        if($conn->query($sql) === TRUE){
            echo "Table $tablename created successfully";
        }
        else{
            echo "Error creating table : ",$conn->error;
        }
    
        $sql = "INSERT INTO $tablename (type,id,name,detail,price,image,status) VALUES('$type','$id','$name','$detail','$price','$img','0')";
    
        if($conn->query($sql) === TRUE){
            echo "New record created successfully";
        }
        else{
            echo "Error : ".$sql."<br>".$conn->error;
        }
        $conn->close();
        header('Location:../store.php');
    }


    function uploadPic(){
        $target_dir = "store/";
        $target_file = $target_dir . basename($_FILES["storeToUpload"]["name"]);
        $ok=1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_POST["submit"])){
            $check = getimagesize($_FILES["storeToUpload"]["tmp_name"]);
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
        if($_FILES["storeToUpload"]["size"] > 500000){
            echo "Sorry, your file is too large.";
            $ok = 0;
        }
        if($ok==0){
            echo "Sorry, your file was not uploaded.";
        }
        else{
            if(move_uploaded_file($_FILES["storeToUpload"]["tmp_name"],"C:/xampp/htdocs/Petto/".$target_file)){
                addDatabase(basename($_FILES["storeToUpload"]["name"]));
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    uploadPic();
    // header('Location:../js/storePic.php');

?>