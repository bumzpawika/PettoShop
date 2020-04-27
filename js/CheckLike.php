<?php
    session_start();
    $Product = $_GET['ProID'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "UserLike";

    if(!isset($_SESSION['username'])){
        exit("<i class='fa fa-heart-o' style='color:black;' ></i>");
    }
    $name = $_SESSION['username'];

    $conn = new mysqli($servername,$username,$password,$dbname);

    $sql = "SELECT * FROM $tablename WHERE name='$name' AND ProductID='$Product' ";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        echo "<i class='fa fa-heart' style='color:#fd2b58;' ></i>";
    }
    else{
        echo "<i class='fa fa-heart-o' style='color:black;' ></i>";
    }

    $conn->close();

?>