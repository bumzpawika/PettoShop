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

    $allpage = $_SESSION['PagePet'];

    $page=1
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
    <!-- ----------------Overlay------------------------------ -->
    <div id="overlay"></div>
    <!-- ------------------Login---------------------------- -->
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
    <!-- -------------------Register--------------------------- -->
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

    <!-- --------------------Menu-------------------------- -->
    <div id="mySidenav" class="sidenav" onmousemove="openNav()" onmouseout="closeNav()">
        <a href="petto_store.php"><img src="img/store.png"></a>
        <a onclick="opencart();"><img src="img/cart.png"></a>
        <a href="petto_like.php"><i class="fa fa-heart-o"></i></a>  <!-- ❤ -->
        <a href="petto_instruction.php"><img src="img/learn.png"></a>
        <a href="petto_contact.php"><img src="img/contact-us.png"></a>
    </div>
    <!-- -------------------Cart--------------------------- -->

    <div id="mySidecart" class="sidecart">
        <a href="javascript:void(0)" class="closebtn" onclick="closecart()">X</a>
        <h1>ตะกร้าสินค้า</h1>
        <div id="cart">
            <!-- <div class="cart-container">
                <div id="imagecart"><img src="store/18.jpg"></div>
                <div id="datacart"><p>ของเล่นไงคะ</p><br>
                    <div class="addnumber"><span>-</span><p>1</p><span>+</span></div>
                    <i class="fa fa-trash-o"></i>
                99฿
                </div>
            </div> -->
        </div>
        <div id="checkout">
            <!-- <div class="space-between"><div>รวมการสั่งซื้อ</div><div>60 ฿</div></div>
            <div class="space-between"><div>ค่าจัดส่ง</div><div>ฟรี</div></div>
            <div class="space-between"><div>ยอดชำระเงินทั้งหมด</div><div>60 ฿</div></div>
            <button type="button" class="btn" onclick="checkOut()">สั่งซื้อสินค้า</button> -->
        </div>
    </div>

    <!-- ------------------Add Pet(admin)---------------------------- -->

    <div class="form-popup" id="myPet">
        <form action="js/addPet.php" class="store-container" method="post" enctype="multipart/form-data">
            <a onclick="closePet()">X</a>
            
            <h3>Add Pet(admin)</h3>

            <label for="type"><b>Type</b></label>
            <select id="type" name="type">
                <option value="สุนัข">สุนัข</option>
                <option value="แมว">แมว</option>
                <option value="กระต่าย">กระต่าย</option>
                <option value="หนู">หนู</option>
                <option value="อื่นๆ">อื่นๆ</option>
            </select>

            <label for="id"><b>ID</b></label>
            <input type="text" placeholder="Enter ID" name="id" maxlength="4" required>

            <label for="sex"><b>Sex</b></label>
            <select id="type" name="sex">
                <option value="เพศผู้">เพศผู้</option>
                <option value="เพศเมีย">เพศเมีย</option>
            </select>

            <label for="color"><b>Color</b></label>
            <input type="text" placeholder="Enter Color" name="color" required>

            <label for="gene"><b>Gene : </b></label>
            <input type="text" placeholder="Enter Gene" name="gene" required>
            
            <label for="age"><b>Ages</b></label>
            <input type="text" placeholder="Enter Ages" name="age" required>

            <label for="image"><b>Image</b></label>
            <input type="file" name="petToUpload" id="petToUpload" class="UploadFile" required>

            <button type="submit" class="btn">Add Pet</button>
        </form>
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

    <!-- -------------------Adopt--------------------------- -->

    <div id="adopt">
        <span onclick="closeForm()">X</span>
        ติดต่อขอรับเลี้ยงสัตว์ได้ที่ : 098-765-4321<br>Facebook : Petto&emsp;&emsp;Instagram : Petto
    </div>

    <!-- ------------------Container---------------------------- -->
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
                <a href="index.php">Petto</a> > สัตว์เลี้ยง
            </div>
        </div>
        <div id="menu" class="flex_container">
        <div><img src="img/0001.png" alt="Dog">Dog</div>
            <div><img src="img/0002.png" alt="Cat">Cat</div>
            <div><img src="img/0003.png" alt="Rabbit">Rabbit</div>
            <div><img src="img/0004.png" alt="Mouse">Mouse</div>
            <div><img src="img/0005.png" alt="Etc.">Etc.</div>
        </div>
        <div id="info">
            <div id="listpet">
                <!-- <div class="grid-pet">
                    <div id="img_pet"><img src="store/18.jpg"></div>
                    <div id="info_pet">
                        <span>รหัสสัตว์เลี้ยง : 101</span>
                        <p>เพศ : เพศผู้</p>
                        <p>สี : ขาว</p>
                        <p>สายพันธุ์ : โกลเด้น</p>
                        <p>อายุ : 3 เดือน</p>
                    </div>
                    <div id="choose_pet">
                        <img src="img/home-run.png">
                    </div>
                </div> -->
            </div>
            <div class="pagination">
                <a onclick="nextprev(-1)">❮</a>
                <a onclick="nextprev(1)">❯</a>
                <span style="font-size:15px;margin-left:10px;" id="showpage"></span>
            </div>
            <button type="submit" onclick="openPet()" id="addpet">Add Pet</button>
        </div>
        <div id="footer">
            <div class="grid_footer">
                <div id="facebook"><img src="img/facebook.png" alt="Facebook">Petto</div>
                <div id="instagram"><img src="img/instagram.png" alt="Instagram">Petto</div>
            </div>
            <img src="img/logo.png" alt="Logo">Copyright&ensp;@&ensp;2020&ensp;PETTO.&ensp;All&ensp;Rights&ensp;Reserved
        </div>
    </div>

    <img src="img/top.png" alt="Back to Top" id="btnTop" onclick="topFunction()">
    
    <!-- --------------JavaScript-------------------------------- -->

    <script>
        var log = "<?php echo $username?>";
        var page = "<?php echo $page?>"
    
        window.onload = pageLoad;
        function pageLoad(){
            showPet(1);
            document.getElementById("showpage").innerHTML = page + " / <?php echo $_SESSION['PagePet']-1;?>";
            if(log == "admin"){
                document.getElementById("addpet").style.display = "block";
            }
            else{
                document.getElementById("addpet").style.display = "none";
            }
        }

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

        function nextprev(c){
            if(c==1){
                var page = "<?php echo $page++;?>";
                showPet(++page);
                document.getElementById("showpage").innerHTML = page + " / <?php echo $_SESSION['PagePet']-1;?>";
            }
            if(c==-1){
                var page = "<?php echo $page--?>";
                showPet(--page);
                document.getElementById("showpage").innerHTML = page + " / <?php echo $_SESSION['PagePet']-1;?>";
            }
        }

        function adopt(){
            document.getElementById("adopt").style.display = "block";
        }

        // function myfunction(){
        //     alert("EIEI");
        // }
    </script>
</body>
</html>