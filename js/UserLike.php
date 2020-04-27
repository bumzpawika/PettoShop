<?php
    session_start();

    $Product = $_GET['ID'];
    // $Pet=$_GET["Pet"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "UserLike";
    
    $price=0;

    if(!isset($_SESSION['username'])){
        // echo $Product;
        exit("Login.");
        
    }

    $name=$_SESSION['username'];
    

    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }

    $sql = "CREATE TABLE $tablename (
    name VARCHAR(60) NOT NULL,
    ProductID INT(30),
    PetID INT(30)
    )";

    // if($conn->query($sql) === TRUE){
    //     echo "New record created successfully";
    // }
    // else {
    //     echo "Error creating table: " . $conn->error;
    // }

    $sql1 = "SELECT * FROM $tablename WHERE name='$name' AND ProductID='$Product' ";
    $result1 = $conn->query($sql1);

    if($result1->num_rows >0){
        while($row1 = $result1->fetch_assoc()){
            $sqlx="DELETE FROM $tablename WHERE name='$name' AND ProductID='$Product' ";
            echo ("Deleted");
        }
    }
    else{
        $sqlx = "INSERT INTO $tablename (name,ProductID) VALUES ('$name','$Product')";
        echo ("Inserted");
    }
    
    if($conn->query($sqlx) === TRUE){
        // echo ("De");
        // exit("Deleted");
    }
    $conn->close();
?>