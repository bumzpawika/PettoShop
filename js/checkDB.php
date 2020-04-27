<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "userInfo";

    $conn = new mysqli($servername,$username,$password,$dbname);

    $name = $_GET["username"];
    $pass = $_GET["psw"];

    $x=0;

    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }

    $sql = "SELECT * FROM $tablename";
    $result = $conn->query($sql);

    if($result->num_rows >0){
        $sql = "SELECT id,name,email,password,image FROM $tablename";
        $result = $conn->query($sql);

        if($result->num_rows >0){
            $output = array();
            while($row = $result->fetch_assoc()){
                $output[$row["id"]] = $row;
                if($name == (string)$row['name']){
                    if($pass == (string)$row['password']){
                        $_SESSION['username'] = $name;
                        $_SESSION['img'] = $row['image'];
                        header("Location:../index.php");
                        exit();
                    }
                    else{
                        header('Location: ..?error=1');
                        exit();
                    }
                    $x++;
                }
            }
        }else{
            echo "0 results";
        }
    }
    if($x==0){
        header("Location:..?error=2");
        exit();
    }

    $conn->close();
?>