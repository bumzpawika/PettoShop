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

    <!-- ------------------Add Cart(admin)---------------------------- -->

    <div class="form-popup" id="myStore">
        <form action="js/addCart.php" class="store-container" method="post" enctype="multipart/form-data">
            <a onclick="closeStore()">X</a>
            
            <h3>Add Cart(admin)</h3>

            <label for="type"><b>Type</b></label>
            <select id="type" name="type">
                <option value="ของเล่น">ของเล่น</option>
                <option value="อาหาร">อาหาร</option>
                <option value="ของใช้">ของใช้</option>
            </select>

            <label for="id"><b>ID</b></label>
            <input type="text" placeholder="Enter ID" name="id" maxlength="4" required>

            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" required>

            <label for="pet"><b>For which animal?</b></label>
            <select id="type" name="pet">
                <option value="Dog">Dog</option>
                <option value="Cat">Cat</option>
                <option value="Rabbit">Rabbit</option>
                <option value="Mouse">Mouse</option>
                <option value="Other">Other</option>
            </select>

            <label for="price"><b>Price</b></label>
            <input type="number" placeholder="Enter Price" name="price" required>

            <label for="image"><b>Image</b></label>
            <input type="file" name="storeToUpload" id="storeToUpload" class="UploadFile" required>

            <button type="submit" class="btn">Add to Cart</button>
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
                <a href="index.php">Petto</a> > ร้านค้า
            </div>
        </div>
        <div id="demo"></div>
        <div id="info">
            <div class="grid-store">
                <div id="filter">
                    Pet :
                    <form id="filterPet">
                        <label class="container">Dog
                        <input type="checkbox" name="pet" value="Dog" onchange="FilterPet()">
                            <span class="checkmark"></span>
                        </label>

                        <label class="container">Cat
                        <input type="checkbox" name="pet" value="Cat" onchange="FilterPet()">
                            <span class="checkmark"></span>
                        </label>
                    
                        <label class="container">Rabbit
                        <input type="checkbox" name="pet" value="Rabbit" onchange="FilterPet()">
                            <span class="checkmark"></span>
                        </label>
                    
                        <label class="container">Mouse
                        <input type="checkbox" name="pet" value="Mouse" onchange="FilterPet()">
                            <span class="checkmark"></span>
                        </label>

                        <label class="container">Other
                        <input type="checkbox" name="pet" value="Other" onchange="FilterPet()">
                            <span class="checkmark"></span>
                        </label>
                    </form>
                    <br>
                    Type :
                    <form id="filterType">
                        <label class="container">Food
                        <input type="checkbox" value="อาหาร" onchange="FilterType()">
                            <span class="checkmark"></span>
                        </label>

                        <label class="container">Toy
                        <input type="checkbox" value="ของเล่น" onchange="FilterType()">
                            <span class="checkmark"></span>
                        </label>

                        <label class="container">Belt
                        <input type="checkbox" value="ของใช้" onchange="FilterType()">
                            <span class="checkmark"></span>
                        </label>

                        <label class="container">Other
                        <input type="checkbox" value="อื่นๆ" onchange="FilterType()">
                            <span class="checkmark"></span>
                        </label>
                    </form>
                </div>
                <div id="list">
                    <!-- <link onload="alert('eiei');"> -->
                    <!-- <img src="store/18.jpg" onload="UserLike()"></img> -->
                    <!-- <div>
                        <img src="store/18.jpg">
                        <span>ของเล่นสัตว์เลี้ยงสีพาสเทล</span><br>
                        <p>Price : 99 บาท</p><br>
                        <button type="button" value="">Add to Cart</button>
                    </div> -->
                </div>
            </div>
            <button type="submit" onclick="openStore()" id="addcart">Add Cart</button>
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
    
        window.onload = pageLoad;
        function pageLoad(){
            if(log == "admin"){
                document.getElementById("addcart").style.display = "block";
            }
            else{
                document.getElementById("addcart").style.display = "none";
            }
            showStore("Dog' OR forpet='Cat' OR forpet = 'Rabbit' OR forpet = 'Mouse' OR forpet = 'Other","อาหาร' OR type ='ของเล่น' OR type ='ของใช้' OR type ='อื่นๆ");
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

        // function myfunction(){
        //     alert("EIEI");
        // }
    </script>
</body>
</html>