<?php
    $q = $_REQUEST["q"];
    $s = $_REQUEST["s"];
    if($q=="" && $s==""){
        $q="Dog' OR forpet='Cat' OR forpet = 'Rabbit' OR forpet = 'Mouse' OR forpet = 'Other";
        $s="อาหาร' OR type ='ของเล่น' OR type ='ของใช้' OR type ='อื่นๆ";
    }
    // else if($q == "" && !$s==""){
    //     $q="Dog' OR forpet='Cat' OR forpet = 'Rabbit' OR forpet = 'Mouse' OR forpet = 'Other";
    // }
    // else if(!$q == "" && $s==""){
    //     $s="อาหาร' OR type ='ของเล่น' OR type ='ของใช้' OR type ='อื่นๆ";
    // }
    // echo $s;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "store";

    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }
    // echo "Connect successfully <br>";

    if($q=="" && !$s==""){
        $sql = "SELECT * FROM $tablename WHERE type='$s' ";
        // echo "1 $q $s";
    }
    if(!$q=="" && $s==""){
        $sql = "SELECT * FROM $tablename WHERE forpet='$q'";
        // echo "2 $q $s";
    }
    if(!$q=="" && !$s==""){
        $sql = "SELECT * FROM $tablename WHERE (forpet='$q') AND (type='$s') ";
        // echo "3 $q $s";
    }
    
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){
        echo "<div><img src='store/".$row['image']."' onload='UserLike(".$row['id'].")' >
        <span>".$row['name']."</span><br>
        <p>Price : ".$row['price']." บาท</p><br>
        <button type='button' value='".$row['id']."' onclick='AddToCart(value,1)' class='btn'>Add to Cart</button>
        <p id='like".$row['id']."' onclick='ClickLike(".$row['id'].")'></p></div>";
    }
    $conn->close();
?>