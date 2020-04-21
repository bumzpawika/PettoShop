<?php
    session_start();

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
                // header('Location: ../store.php');
                exit();
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    uploadPic();
?>