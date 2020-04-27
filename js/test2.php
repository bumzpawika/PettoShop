<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "store";

    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }

    $sql = "SELECT * FROM $tablename ";
    while($row = $result->fetch_assoc()){
        echo "eiei";
    }
    if($conn->query($sql) === TRUE){
        echo "New record created successfully";
    }
    else{
        echo "Error : ".$sql."<br>".$conn->error;
    }
    $conn->close();

    header('Location:../test2.php');

?>