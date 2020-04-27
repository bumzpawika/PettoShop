window.onscroll = scrollFunction;

function scrollFunction(){
    if(document.body.scrollTop > 200 || document.documentElement.scrollTop > 200){
        document.getElementById("btnTop").style.display = "block";
        
    }
    else{
        document.getElementById("btnTop").style.display = "none";
    }
}

function topFunction(){
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

window.onload = pageLoad;

function pageLoad(){

	var para = getParams();
	if(Object.keys(para).length >0){
		if (para["error"]==1){
			document.getElementById('errordisplay').innerHTML = "Wrong password. Please Try again.";
			openLogin();
		}
		if (para["error"]==2){
			document.getElementById('errordisplay').innerHTML = "Please Register.";
			openLogin();
		}
	}

	showPet(0);
	// ------------------------------------------------- Instruction
	var xhr = new XMLHttpRequest();
	xhr.open("GET","js/Instruction.txt");
	xhr.onload = function(){
		document.getElementById("content").innerHTML=xhr.responseText;
	};
	xhr.onerror = function(){alert("error");};
	xhr.send();

	// ------------------------------------------------- Petto_Profile.php

	document.getElementById('editPic').onclick = fileUpload;
	document.getElementById("fileToUpload").onchange=Upload;

	// ------------------------------------------------- Modal Image
	var modal = document.getElementById("myModal");

    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    img.onclick = function(){
        modal.style.display="block";
        modalImg.src=this.src;
        document.body.style.overflow = "hidden";
    }

    var span = document.getElementsByClassName("close")[0];
    span.onclick = function(){
        modal.style.display = "none";
        document.body.style.overflow = "auto";
	}

	
	// if(Object.keys(para).length >0){
	// 	if (para["error"]==1){
	// 		document.getElementById('errordisplay').innerHTML = "Username and password do not match.";
	// 	}
	// }
	// ------------------------------------------------- Filter Store
	// document.getElementById("filterPet").onchange = FilterPet;
}

function getParams() {
	var idx = document.URL.indexOf('?');
	// return idx;
	var params = new Array();
	if (idx != -1) {
		var pairs = document.URL.substring(idx+1, document.URL.length).split('&');
		for (var i=0; i<pairs.length; i++) {
			nameVal = pairs[i].split('=');
			params[nameVal[0]] = nameVal[1];
		}
	}
	
	return params;
}

function fileUpload(){
	document.getElementById("fileToUpload").click();
}

function Upload(){
	document.getElementById("submit").click();

}
var txt = "";
var text= "";

function FilterPet(){
	var filterPet = document.forms.namedItem("filterPet");
	var cnt=0;
	var x=0;
	txt="";
	for(var i=0;i<filterPet.length;i++){
		if(filterPet[i].checked){
			cnt++;
		}
	}
	for(var j=0;j<filterPet.length;j++){
		if(filterPet[j].checked && (cnt==1 || (cnt!=1 && x==0))){
			txt = txt + filterPet[j].value;
			x++;
		}
		else if(filterPet[j].checked && cnt!=1){
			txt = txt + "' OR forpet = '"+filterPet[j].value;
			x++;
		}
	}
	// alert("txt = " +txt+ "text = "+text);
	showStore(txt,text);
	
}

function FilterType(){
	var filterType = document.forms.namedItem("filterType");
	var cntt=0;
	var x=0;
	text = "";
	for(var i=0;i<filterType.length;i++){
		if(filterType[i].checked){
			cntt++;
		}
	}
	for(var j=0;j<filterType.length;j++){
		if(filterType[j].checked && (cntt==1 || (cntt!=1 && x==0))){
			text = text + filterType[j].value;
			x++;
		}
		else if(filterType[j].checked && cntt!=1){
			text = text + "' OR type = '"+filterType[j].value;
			x++;
		}
	}
	// alert("txt = " +txt+ "text = "+text);
	showStore(txt,text);
}

function AddToCart(val,n){
	var x = new XMLHttpRequest();
	x.open("POST","js/AddToCart.php?val="+val+"&n="+n,true);
	x.onload = function(){
		// showCart();
		// document.getElementById("demo").innerHTML=x.responseText;
		if(x.responseText == "Login."){
			openLogin();
		}
		else{
			// alert(x.responseText);
			showCart();
		}
		
	};
	x.onerror=function(){
		alert("error");
	};
	
	x.send();
}

function openLogin(){
	document.getElementById("myFormLogin").style.display = "block";
    document.getElementById("myFormRegis").style.display = "none";
    document.getElementById("overlay").style.display = "block";
    document.body.style.overflow = "hidden"
}


function showCart(){
	var x = new XMLHttpRequest();

	x.open("POST","js/readCart.php",true);
	x.onload = function(){
		var obj = JSON.parse(x.responseText)
		document.getElementById("cart").innerHTML=obj[0];
		document.getElementById("checkout").innerHTML=obj[1];
	};
	x.onerror=function(){
		alert("error");
	};
	x.send();

}
var currentTab = 0
function checkOut(){
	// alert("CheckOut");
	document.getElementById("FormCheckout").style.display = "block";
	closecart();
	document.body.style.overflow = "hidden"
	document.getElementById("overlay").style.display = "block";
	
	showTab(currentTab);
}

function showTab(n){
	var x=document.getElementsByClassName("tab");
	x[n].style.display = "block";
	if(n==0){
		document.getElementById("prevBtn").style.display = "none";
	}
	else{
		document.getElementById("prevBtn").style.display = "inline";
	}
	if(n==(x.length-1)){
		document.getElementById("nextBtn").innerHTML = "Submit";
	}
	else{
		document.getElementById("nextBtn").innerHTML = "Next";
	}
	fixStepIndicator(n);
}

function nextPrev(n){
	
	var x=document.getElementsByClassName("tab");
	if(n==1 && !validateForm()){
		return false;
	}
	
	currentTab = currentTab+n;
	
	if(currentTab >= x.length){
		document.getElementById("regForm").submit();
		SubmitCheckout();
		// alert("Final");
		return false;
	}

	x[currentTab-n].style.display = "none";
	showTab(currentTab);
}

function validateForm(){
	var x, y, i, valid = true;
	x = document.getElementsByClassName("tab");
	y = x[currentTab].getElementsByClassName("inp");
	for (i = 0; i < y.length; i++) {
		if (y[i].value == "") {
			y[i].className += " invalid";
			valid = false;
		}
	}
	if (valid) {
		document.getElementsByClassName("step")[currentTab].className += " finish";
	}
	return valid;
}

function fixStepIndicator(n){
	var i,x=document.getElementsByClassName("step");
	for(i=0;i<x.length;i++){
		x[i].className = x[i].className.replace(" active","");
	}
	x[n].className += " active";
}

function SubmitCheckout(){
	var x = new XMLHttpRequest();

	x.open("POST","js/CheckOut.php",true);
	x.onload = function(){
			
	};
	x.onerror=function(){
		alert("error");
	};
	
	x.send();
}

function ClickLike(n){
	// alert("Like");

	var xml = new XMLHttpRequest();
	xml.open("POST","js/UserLike.php?ID="+n,true);
	xml.onload = function(){
		// alert(xml.responseText);
		if(xml.responseText == "Login."){
			// alert("Login.");
			openLogin();
		}
		else if(xml.responseText == "Inserted"){
			UserLike(n);
			ShowLike();
		}
		else if(xml.responseText == "Deleted"){
			UserLike(n);
			ShowLike();
		}
	}
	xml.onerror=function(){
		alert("error");
	}
	xml.send();
}

function UserLike(id){
	var x = new XMLHttpRequest();
	x.open("POST","js/CheckLike.php?ProID="+id,true);
	x.onload = function(){
		document.getElementById("like"+id).innerHTML = x.responseText;
	};
	x.onerror=function(){
		alert("error");
	};
	
	x.send();
}

// -------------------------Use every PHP------------------------------------------

function closeForm(){ //ปิดหน้าLogin / Regis
	document.getElementById("myFormLogin").style.display = "none";
	document.getElementById("myFormRegis").style.display = "none";
	// document.getElementById("FormCheckout").style.display = "none";
	document.getElementById("overlay").style.display = "none";
	document.getElementById("adopt").style.display = "none";
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

function opencart(){ //เปิดตะกร้า
	document.getElementById("mySidecart").style.width = "300px";
	document.getElementById("overlay").style.display = "block";
	document.body.style.overflow = "hidden"
	showCart();
	
}
function closecart(){ //ปิดตะกร้า
	document.getElementById("mySidecart").style.width = "0";
	document.getElementById("overlay").style.display = "none";
	document.body.style.overflow = "auto"
}

function closeStore(){ //ปิดหน้า Add Cart (admin)
	document.getElementById("myStore").style.display = "none";
	document.getElementById("overlay").style.display = "none";
	document.body.style.overflow = "auto"
}
function openStore(){ //Add Cart (admin)
	document.getElementById("myStore").style.display = "block";
	document.getElementById("overlay").style.display = "block";
	document.body.style.overflow = "hidden"
}

function closePet(){ //ปิดหน้า Add Pet (admin)
	document.getElementById("myPet").style.display = "none";
	document.getElementById("overlay").style.display = "none";
	document.body.style.overflow = "auto"
}
function openPet(){ //Add Pet (admin)
	document.getElementById("myPet").style.display = "block";
	document.getElementById("overlay").style.display = "block";
	document.body.style.overflow = "hidden"
}

function logout(){
	location.href="index.php"
}

function showStore(str,stt){
	var http = new XMLHttpRequest();
	// alert(stt);
	// alert("'"+str+"'"+"'"+stt+"'");
	http.open("POST","js/readFile.php?q="+str+"&s="+stt,true);
	http.onload = function(){
		document.getElementById("list").innerHTML=http.responseText;
		// alert(str);
	};
	http.onerror=function(){
		alert("error");
	};
	
	http.send();
}

function showPet(x){
	var http = new XMLHttpRequest();
	// alert("showpet"+x);
	http.open("POST","js/readPet.php",true);
	http.onload = function(){
		var myObj = JSON.parse(this.responseText);
		var count=0,i=myObj.length;
		while(i--){
			if(myObj[i] !== null)
			count++;
		}
		if(x==0){
			document.getElementById("NewPet").innerHTML = myObj[0];
		}
		else{
			document.getElementById("listpet").innerHTML = myObj[x];
		}
			
	};
	http.onerror=function(){
		alert("error");
	};
	
	http.send();
}

function ShowLike(){
	var xml = new XMLHttpRequest();
	xml.open("POST","js/readLike.php",true);
	xml.onload = function(){
		if(this.responseText == "Login"){
			document.getElementById("nolike").style.display = "block";
			document.getElementById("UserLike").style.display = "none";
			document.getElementById("nolike").innerHTML = "ไม่มีข้อมูล กรุณาลงชื่อเข้าใช้";
		}
		else{
			document.getElementById("UserLike").style.display = "block";
			document.getElementById("nolike").style.display = "none";
			document.getElementById("UserLike").innerHTML = this.responseText;
			// alert(this.responseText);
		}
	}
	xml.onerror=function(){
		alert("No");
	}
	xml.send();
}
// --------------------------------------------------------------------------------
