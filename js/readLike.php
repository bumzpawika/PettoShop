<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "userlike";
    $tablenames = "store";

    if(!isset($_SESSION['username'])){
        exit("Login");
    }
    $name = $_SESSION['username'];

    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }

    $sql = "SELECT * FROM $tablename WHERE name='$name' ";
    $result = $conn->query($sql);

    

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $sqls="SELECT * FROM $tablenames ";
            $results = $conn->query($sqls);
            if($results->num_rows > 0){
                while($rows = $results->fetch_assoc()){
                    if($row["ProductID"]==$rows["id"]){
                        echo "<div>
                        <img src='store/".$rows['image']."' onload='UserLike(".$rows['id'].");' >
                        <span>".$rows['name']."</span><br>
                        <p>Price : ".$rows['price']." บาท</p><br>
                        <button type='button' value='".$rows['id']."' onclick='AddToCart(value,1)' class='btn'>Add to Cart</button>
                        <p id='like".$rows['id']."' onclick='ClickLike(".$rows['id'].")'></p>
                    </div>";
                    }
                }
            }
        }
    }

    

    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully";
    } else {
        // echo "Error creating table: " . $conn->error;
    }
    
    $conn->close();
?>