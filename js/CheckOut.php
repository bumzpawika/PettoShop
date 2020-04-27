<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "MyOrder";

    $name = $_SESSION['username'];

    $conn = new mysqli($servername,$username,$password,$dbname);

    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }

    $sql = "SELECT * FROM $tablename";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $sql = "DELETE FROM $tablename WHERE name='$name' ";

        if($conn->query($sql) === TRUE){
            echo "Record deleted successfully.";
        }
        else{
            echo "Error deleting record : ".$conn->error;
        }
    }
    $conn->close();
?>