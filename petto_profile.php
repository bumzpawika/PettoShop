<?php
session_start();
    $log = 1;
	if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
    if(isset($_SESSION['img'])){
		$imgfile = $_SESSION['img'];
    }
    else{
        $username = "Login";
        $imgfile = "user.png";
    }

    $servername = "localhost";
    $usernamee = "root";
    $password = "";
    $dbname = "petto";
    $tablename = "userInfo";

    $conn = new mysqli($servername,$usernamee,$password,$dbname);

    if($conn->connect_error){
        die("Connection failed : ".$conn->connect_error);
    }

    $sql = "SELECT name,email FROM $tablename";
    $result = $conn->query($sql);

    if($result->num_rows >0){
        while($row = $result->fetch_assoc()){
            if($username==(string)$row['name']){
                $mail = $row["email"];
                // exit();
            }
        }
    }
    else{
        $mail = "Not have E-mail.";
    }
    $conn->close();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='main.js'></script>
    <title>Petto</title>
</head>
<body>
    <!-- ---------------------Overlay------------------------- -->
    <div id="overlay"></div>
    <!-- -------------------Login--------------------------- -->
    <div class="form-popup" id="myFormLogin">
        <form action="js/checkDB.php" class="form-container">
            <a onclick="closeForm()">X</a>
            
            <h1>Login</h1>

            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <span id="errordisplay"></span><br>

            <p>Not a member?&emsp;</p><a onclick="openRegis()" id="signup">Sign Up</a>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
    <!-- ------------------Register---------------------------- -->
    <div class="form-popup" id="myFormRegis">
        <form action="js/addDB.php" class="form-container">
            <a onclick="closeForm()">X</a>
            
            <h1>Register</h1>

            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="mail"><b>E-mail</b></label>
            <input type="email" placeholder="Enter E-mail" name="mail" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" id="password" required>

            <!-- <label for="psw"><b>Re-Password</b></label>
            <input type="password" placeholder="Re-Enter Password" name="psw" id="confirm-password" required> -->

            <p>Already have an account?&emsp;</p><a onclick="openForm()" id="signup">Login</a>
            <button type="submit" class="btn">Sign up</button>
        </form>
    </div>

    <!-- -----------------Menu----------------------------- -->
    <div id="mySidenav" class="sidenav" onmousemove="openNav()" onmouseout="closeNav()">
        <a href="petto_store.php"><img src="img/store.png"></a>
        <a onclick="opencart();"><img src="img/cart.png"></a>
        <a href="petto_like.php"><i class="fa fa-heart-o"></i></a>  <!-- ❤ -->
        <a href="petto_instruction.php"><img src="img/learn.png"></a>
        <a href="petto_contact.php"><img src="img/contact-us.png"></a>
    </div>
    <!-- -------------------Show Image--------------------------- -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
    </div>
    <!-- ----------------Cart------------------------------ -->

    <div id="mySidecart" class="sidecart">
        <a href="javascript:void(0)" class="closebtn" onclick="closecart()">X</a>
        <h1>ตะกร้าสินค้า</h1>
        <div id="cart">
        </div>
        <div id="checkout">
        </div>
    </div>

    <!-- -------------------Check Out--------------------------- -->
    <div id="FormCheckout">
        <form id="regForm" action="">
            <a onclick="closeForm()">X</a>
            <div class="tab" >ที่อยู่ในการจัดส่ง :
                <p><input placeholder="ชื่อผู้รับ" class="inp" oninput="this.className = ''"></p>
                <p><input placeholder="ที่อยู่" class="inp" oninput="this.className = ''"></p>
                <p><input placeholder="ตำบล" class="inp" oninput="this.className = ''"></p>
                <p><input placeholder="อำเภอ" class="inp" oninput="this.className = ''"></p>
                <p><input placeholder="จังหวัด" class="inp" oninput="this.className = ''"></p>
                <p><input placeholder="รหัสไปรษณีย์" class="inp" oninput="this.className = ''"></p>
                <p><input placeholder="เบอร์โทรศัพท์" class="inp" oninput="this.className = ''"></p>
            </div>
            <div class="tab">Payment :
                <div>
                    <i class="fa fa-cc-visa" style="color:navy;font-size:30px;"></i>
                    <i class="fa fa-cc-paypal" style="color:blue;font-size:30px;"></i>
                    <i class="fa fa-cc-mastercard" style="color:red;font-size:30px;"></i>
                    <i class="fa fa-cc-jcb" style="color:orange;font-size:30px;"></i>
                </div>
                <p><input placeholder="Name on Card" oninput="this.className = ''" required></p>
                <p><input placeholder="Credit card number" oninput="this.className = ''" required></p>
                <p><input placeholder="Exp" oninput="this.className = ''" required></p>
                <p><input placeholder="CVV" oninput="this.className = ''" required></p>
            </div>

            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" class="btn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" class="btn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>

            <div style="text-align:center;">
                <span class="step"></span>
                <span class="step"></span>
            </div>
        </form>
    </div>


    <!-- -------------------Container--------------------------- -->
    <div class="grid-container">
        <div id="header">
            <p class="menu" onmouseover="openNav()" onmouseout="closeNav()">&#9776</p>
            <!-- <img src="img/Menubar.png" alt="Menu" class="menu"> -->
            <a href="index.php"><img src="img/logo.png" alt="Logo" class="logo"></a>
            <a onclick="openForm()" class="user"><img src=<?php echo "user/".$imgfile ?> alt="User">&ensp;<?php echo $username?></a>
        </div>
        <div id="space1"></div>
        <div id="main">
            <div class="profilehead">
                <a href="index.php">Petto</a> > จัดการสมาชิก
            </div>
            
        </div>
        
        <div id="info">
            <div class="grid-profile">
                <div id="imgprofile">
                    <img src=<?php echo "user/".$imgfile ?> alt="User" id="myImg">
                    <div id="editPic">Edit <i class="fa fa-edit"></i></div>
                    <form action="js/profilePic.php" method="post" id="formId" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload" class="hidden">
                        <input type="submit" value="Upload Image" name="submit" id="submit" class="hidden">
					</form>
                </div>
                <div id="infouser">
                    <label for="username"><b>Username</b><br></label>
                    <input type="text" value="<?php echo $username ?>" name="username" disabled>

                    <label for="mail"><br><b>E-mail</b><br></label>
                    <input type="email" value="<?php echo $mail ?>" name="mail" disabled>
                </div>
            </div>
            
            <button type="submit" class="btnlogout" onclick="location.href='js/logout.php';">Log out</button></a>
        </div>
        <footer id="footer" style="position:absolute;bottom:0">
            <div class="grid_footer">
                <div id="facebook"><img src="img/facebook.png" alt="Facebook">Petto</div>
                <div id="instagram"><img src="img/instagram.png" alt="Instagram">Petto</div>
            </div>
            <img src="img/logo.png" alt="Logo">Copyright&ensp;@&ensp;2020&ensp;PETTO.&ensp;All&ensp;Rights&ensp;Reserved
    </footer>
    </div>

    <img src="img/top.png" alt="Back to Top" id="btnTop" onclick="topFunction()">
    
    <!-- ----------------JavaScript------------------------------ -->

    <script>
        var log = "<?php echo $username?>";
        // console.log(log);
        function openForm(){   //เปิดหน้า Login
            if(log == "Login"){
                document.getElementById("myFormLogin").style.display = "block";
                document.getElementById("myFormRegis").style.display = "none";
                document.getElementById("overlay").style.display = "block";
                document.body.style.overflow = "hidden"
            }
            else{
                location.href = 'petto_profile.php';
            }
        }
    </script>
</body>
</html>