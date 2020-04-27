<?php

    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "MyOrder";

    $sum_price = 0;
    $str="";

    if(!isset($_SESSION['username'])){
        $msg[0]="<p>กรุณาลงชื่อเข้าใช้</p>";
        $msg[1]="";

        echo json_encode($msg);
        exit();
    }
    $name=$_SESSION['username'];


    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }
    // echo "Connect successfully <br>";

    $sql = "SELECT * FROM $tablename WHERE name='$name'";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){
        $id=$row['ProductID'];
        $sql1 = "SELECT * FROM store WHERE id='$id' ";
        $result1 = $conn->query($sql1);

        while($row1=$result1->fetch_assoc()){
            // $str="eiei";
            $str=$str.'<div class="cart-container">
            <div id="imagecart"><img src="store/'.$row1['image'].'"></div>
            <div id="datacart"><p>'.$row1['name'].'</p><br>
            <div class="addnumber"><span onclick="AddToCart('.$row1['id'].',-1)">-</span><p>'.$row['Count'].'</p><span onclick="AddToCart('.$row1['id'].',1)">+</span></div>
            <i class="fa fa-trash-o" onclick="AddToCart('.$row1['id'].',0)"></i>
            '.$row['Price'].'฿
            </div>
            </div>';
            $sum_price = $sum_price+($row['Price']*$row['Count']);
        }
    }

    if($result->num_rows==0){
        $msg[0]="<p>ไม่มีสินค้าในตะกร้า</p>";
        $msg[1]="";

        echo json_encode($msg);
    }
    else{
        $msg[0]=$str;
        $msg[1]='<div class="space-between"><div>รวมการสั่งซื้อ</div><div>'.$sum_price.' ฿</div></div>
        <div class="space-between"><div>ค่าจัดส่ง</div><div>ฟรี</div></div>
        <div class="space-between"><div>ยอดชำระเงินทั้งหมด</div><div>'.$sum_price.' ฿</div></div>
        <button type="button" class="btn" onclick="checkOut()">สั่งซื้อสินค้า</button>';
        
        echo json_encode($msg);
    }
    
    $conn->close();
?>