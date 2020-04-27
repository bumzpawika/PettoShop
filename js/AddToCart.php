<?php
    session_start();

    $val = $_GET["val"];
    $n=$_GET["n"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "MyOrder";
    $tablename1 = "store";
    
    $price=0;

    if(!isset($_SESSION['username'])){
        // echo "Please Log in.";
        // exit("Please Log in");
        exit("Login.");
    }
    $name=$_SESSION['username'];
    

    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }

    $sql1 = "SELECT id,price FROM $tablename1";
    $result1=$conn->query($sql1);

    if($result1->num_rows > 0){
        while($row1 = $result1->fetch_assoc()){
            if($val==$row1["id"]){
                $price=$row1["price"];
            }
        }
    }

    $sql = "CREATE TABLE $tablename (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        ProductID INT(30) NOT NULL,
        Price INT(50),
        Count INT(10)
        )";
        
    if ($conn->query($sql) === TRUE) {
        // echo "Table MyGuests created successfully";
    }
    else {
        // echo "Error creating table: " . $conn->error;
    }

    $cnt=0;
    $cc=0;

    // $sql0 = "SELECT * FROM $tablename";
    // $result0=$conn->query($sql0);
    // if($result0->num_rows > 0){
    //     while($row0=$result0->fetch_assoc()){
    //         if($row0['name']==$name && $row0['ProductID']==$val){
    //             if($n==0){
    //                 $sql2 = "UPDATE $tablename SET Count=Count+$n WHERE name='$name' AND ProductID='$val'";
    //                 $cc=$cc+1;
    //             }
                
    //         }
    //     }
    // }
    
    $sql0 = "SELECT * FROM $tablename WHERE name='$name' AND ProductID='$val' ";
    $result0=$conn->query($sql0);
    if($result0->num_rows > 0){
        while($row0=$result0->fetch_assoc()){
            if($n != 0){
                $sql2 = "UPDATE $tablename SET Count=Count+$n WHERE name='$name' AND ProductID='$val'";
            }
            if($n == 0){
                // echo "delete";
                $sql4 = "DELETE FROM $tablename WHERE name='$name' AND ProductID='$val'";
                
            }
        }
    }

    if($result0->num_rows == 0){
        $sql3 = "INSERT INTO $tablename (name,ProductID,Price,Count) VALUES('$name','$val','$price','1')";
        
    }

    // echo $row0;
    if($conn->query($sql2) === TRUE){
        echo "Plusssssssss";
    }
    if($conn->query($sql3) === TRUE){
        echo "Insertttttttttttttt";
    }
    if($conn->query($sql4) === TRUE){
        echo "Deleteeeeeeeeeee";
    }
    // echo $cc;
    
    $conn->close();
?>