<?php

    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "pet";

    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }
    
    $str1 = array_fill(0, 10, NULL);
    $str2="";
    $n=1; //นับจำนวนข้อมูลในแต่ละหน้า มี 5 ชุด
    $x=1; //ช่อง array เก็บแต่ละหน้าของ pet

    $sql = "SELECT * FROM $tablename";
    $result = $conn->query($sql);

    $count=$result->num_rows;

    while($row = $result->fetch_assoc()){
        if($n<=5){
            if($count<=5){
                $str2 .='<div>
                <img src="pet/'.$row["image"].'">
                <span style="color:#ea7d3b">รหัสสัตว์เลี้ยง '.$row["id"].'</span>
                <p>
                <span style="color:#ea7d3b;">สี</span>
                <span style="color:black;">'.$row["color"].'</span>
                </p>
                <p>
                <span style="color:#ea7d3b;">สายพันธุ์</span>
                <span style="color:black;">'.$row["gene"].'</span>
                </p>
                </div>';

            }

            $str1[$x] = $str1[$x].'
                <div class="grid-pet">
                    <div id="img_pet"><img src="pet/'.$row["image"].'"></div>
                    <div id="info_pet">
                        <span>รหัสสัตว์เลี้ยง '.$row["id"].'</span>
                        <p>เพศ : '.$row["sex"].'</p>
                        <p>สี : '.$row["color"].'</p>
                        <p>สายพันธุ์ : '.$row["gene"].'</p>
                        <p>อายุ : '.$row["age"].'</p>
                    </div>
                    <div id="choose_pet">
                        <img src="img/home-run.png" onclick="adopt();">
                    </div>
                </div>';
            $count--;
            $n++;
        }
        if($n>5){
            $n=0;
            $x++;
        }
    }

    $_SESSION['PagePet'] = $x+1;

    $str1[0] = $str2;

    $myJSON = json_encode($str1);

    echo $myJSON;

    $conn->close();
?>