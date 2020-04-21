<?php
session_start();
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
    <!-- ---------------------------------------------- -->
    <div id="overlay"></div>
    <!-- ---------------------------------------------- -->
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
    <!-- ---------------------------------------------- -->
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
            <button type="submit" class="btn">Sing up</button>
        </form>
    </div>

    <!-- ---------------------------------------------- -->
    <div id="mySidenav" class="sidenav" onmousemove="openNav()" onmouseout="closeNav()">
        <a href="store.php"><img src="img/store.png"></a>
        <a onclick="opencart();"><img src="img/cart.png"></a>
        <a href="#"><i class="fa fa-heart-o"></i></a>  <!-- ❤ -->
        <a href="instruction.php"><img src="img/learn.png"></a>
        <a href="contact.php"><img src="img/contact-us.png"></a>
      </div>
    <!-- ---------------------------------------------- -->
    <div id="mySidecart" class="sidecart">
        <a href="javascript:void(0)" class="closebtn" onclick="closecart()">X</a>
        <h1>ตะกร้าสินค้า</h1>
        <div id="cart">
            
        </div>
    </div>

    <!-- ---------------------------------------------- -->

    <div class="grid-container">
        <div id="header">
            <p class="menu" onmouseover="openNav()" onmouseout="closeNav()">&#9776</p>
            <!-- <img src="img/Menubar.png" alt="Menu" class="menu"> -->
            <a href="index.php"><img src="img/logo.png" alt="Logo" class="logo"></a>
            <a onclick="openForm()" class="user"><img src=<?php echo "user/".$imgfile ?> alt="User">&ensp;<?php echo $username?></a>
        </div>
        <div id="space1"></div>
        <div id="main">
            <img src="img_main/1.png" alt="Cat">
        </div>
        <div id="space2"></div>
        <div id="menu" class="flex_container">
            <div><img src="img/0001.png" alt="Dog">Dog</div>
            <div><img src="img/0002.png" alt="Cat">Cat</div>
            <div><img src="img/0003.png" alt="Rabbit">Rabbit</div>
            <div><img src="img/0004.png" alt="Mouse">Mouse</div>
            <div><img src="img/0005.png" alt="Etc.">Etc.</div>
        </div>
        <div id="info">Info</div>
        <div id="footer">
            <div class="grid_footer">
                <div id="facebook"><img src="img/facebook.png" alt="Facebook">Petto</div>
                <div id="instagram"><img src="img/instagram.png" alt="Instagram">Petto</div>
            </div>
            <img src="img/logo.png" alt="Logo">Copyright&ensp;@&ensp;2020&ensp;PETTO.&ensp;All&ensp;Rights&ensp;Reserved
        </div>
    </div>

    <img src="img/top.png" alt="Back to Top" id="btnTop" onclick="topFunction()">
    
    <!-- ---------------------------------------------- -->

    <script>
        var log = "<?php echo $username?>";
        function openForm(){   //เปิดหน้า Login
            if(log == "Login"){
                document.getElementById("myFormLogin").style.display = "block";
                document.getElementById("myFormRegis").style.display = "none";
                document.getElementById("overlay").style.display = "block";
                document.body.style.overflow = "hidden"
            }
            else{
                location.href = 'profile.php';
            }
        }
        function closeForm(){ //ปิดหน้าทั้งหมด
            document.getElementById("myFormLogin").style.display = "none";
            document.getElementById("myFormRegis").style.display = "none";
            document.getElementById("overlay").style.display = "none";
            document.body.style.overflow = "auto"
        }
        function openRegis(){ //เปิดหน้า Regis
            document.getElementById("myFormRegis").style.display = "block";
            document.getElementById("myFormLogin").style.display = "none";
            document.getElementById("overlay").style.display = "block";
            document.body.style.overflow = "hidden"
        }

        function openNav() { //เปิดเมนู
            document.getElementById("mySidenav").style.height = "210px";
            document.getElementById("mySidenav").style.paddingTop = "35px"
        }
        function closeNav() { //ปิดเมนู
            document.getElementById("mySidenav").style.height = "0";
            document.getElementById("mySidenav").style.paddingTop = "0px"
        }

        function opencart(){
            document.getElementById("mySidecart").style.width = "300px";
            document.getElementById("overlay").style.display = "block";
            
        }
        function closecart(){
            document.getElementById("mySidecart").style.width = "0";
            document.getElementById("overlay").style.display = "none";
        }
    </script>
</body>
</html>