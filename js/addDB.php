<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "userInfo";

    $name = $_GET['username'];
    $email = $_GET['mail'];
    $pass = $_GET['psw'];

    $conn = new mysqli($servername,$username,$password,$dbname);

    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }
    echo "Connect successfully <br>";
    

    $sql = "CREATE TABLE $tablename (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(60) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    image VARCHAR(60) NOT NULL
    )";

    if($conn->query($sql) === TRUE){
        echo "Table $tablename created successfully";
    }
    else{
        echo "Error creating table : ",$conn->error;
    }

    $sql = "INSERT INTO $tablename (name,email,password,image) VALUES('$name','$email','$pass','user.png')";

    if($conn->query($sql) === TRUE){
        echo "New record created successfully";
    }
    else{
        echo "Error : ".$sql."<br>".$conn->error;
    }

    $conn->close();
    header('Location:../index.php');

?>