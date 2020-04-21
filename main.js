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

function getParams() {
  	var idx = document.URL.indexOf('?');
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

function pageLoad(){
	// var para = getParams();
	// if(Object.keys(para).length >0){
	// 	if (para["error"]==1){
	// 		document.getElementById('errordisplay').innerHTML = "Username or password does not match.";
	// 	}
	// }

	document.getElementById('editPic').onclick = fileUpload;
	document.getElementById("fileToUpload").onchange=Upload;

	
}

function fileUpload(){
	document.getElementById("fileToUpload").click();
}

function Upload(){
	document.getElementById("submit").click();

}
