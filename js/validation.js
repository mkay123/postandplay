var isFormValid;

$('#RegForm').submit(function(e){
	e.preventDefault();
	var form = document.forms['Rform'];
	var hiddenId = form['hiddenid'].value;
	var fname = form['fname'].value;
	var lname= form['lname'].value;
	var address= form['address'].value;
	var mobileno= form['phnno'].value;
	var gender= form['gender'].value;
	var image = form['image'].value;
	image = image.replace(/^.*[\\\/]/, '');
	var hiddenImage = form['dbImageName'].value;
	var sessionId = form['sessionid'].value;
	var isUsernameValid = document.getElementById("isvalid").value;
	
	if(isUsernameValid==0){
		isFormValid = 0;
	}

	//Permissions : In admin case
	if(sessionId ==1){
		var checkboxes = form['perm[]'];
		var permissions=[];
		for(var i=0;i<checkboxes.length;i++){
			if(checkboxes[i].checked){
				permissions.push(checkboxes[i].value);
			}		
		}
		permissions=permissions.toString();
	}

	//In case new user
	if(!hiddenId){
		alert("new user");
		var username= form['username'].value;
		var password = form['password'].value;

		//validation
		var un = checkField(username,"usernameError","username");
		var pw = checkField(password,"passwordError","password");
	}

	var fn = checkField(fname,"fnameError","first name");
	var ln = checkField(lname,"lnameError","last name");
	var ad = checkField(address,"addressError","address");
	var mb = checkField(mobileno,"phnnoError","mobile number");
	var gen = checkField(gender,"genderError","gender");
	if(mb){
		if(!/^\d{10}$/.test(mobileno)){
		document.getElementById("phnnoError").style.display="block";
		document.getElementById("phnnoError").innerHTML="Please enter correct mobile no";
		isFormValid = 0;
		mb = 0;
		}
	}
	var isImageValid = 1;
	if(!image){
		if(!hiddenImage){
			document.getElementById("imageError").style.display="block";
			document.getElementById("imageError").innerHTML="Please upload an image";
			isImageValid = 0;
		}
		else{
			var finalimage = hiddenImage;
			document.getElementById("imageError").innerHTML="";
		}
	}
	else{
		var finalimage = image;
		document.getElementById("imageError").innerHTML="";
	}
	
	console.log(finalimage);
	//return false;
	if(finalimage && finalimage==image){
		//extension validation
		var imageType = finalimage.split(".");
		imageType = imageType[imageType.length-1];
		if(imageType != "jpg" && imageType != "jpeg" && imageType != "png" && imageType != "gif"){
			document.getElementById("imageError").style.display="block";
			document.getElementById("imageError").innerHTML="Please upload only image";
			isImageValid = 0;
		}
		else{
			document.getElementById("imageError").innerHTML="";
		}
	}

	//console.log(fn + " " + ln + " " + ad + " "+ mb + " " + gen);
	if(fn && ln && ad && mb && gen && isImageValid){
		$.ajax({
			url:"submit.php",
			type:"POST",
			data: new FormData($('form')[0]),
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(result){
				if(result.type=="newuser"){
					alert("newuser");
					document.getElementById("msg").innerHTML="New User Registered";
					document.getElementById("RegForm").reset();
					window.location.href="index.php";
				}
				else if(result.type =="admin"){
					alert("admin");
					document.getElementById("msg").innerHTML="Data Updated";
					document.getElementById("userimage").setAttribute("src", "images/"+result.img); 
					window.location.href="admin.php";
				}
				else if(result.type =="superadmin"){
					alert("superadmin");
					window.location.href="superadmin.php"; 
				}
				else {
					alert("error");
					document.getElementById("msg").innerHTML="Error in query";
				}
			}	
		});
	}
	else{
		return false;
	}

});

function checkField(fieldName,className,msg){
	if(fieldName==""){
			document.getElementById(className).style.display="block";
			document.getElementById(className).innerHTML="Please enter "+msg;
			return false;
	}
	else{
		document.getElementById(className).innerHTML="";
		return true;
	}
	
}

function login(){
	var form = document.forms['loginform'];
	var username= form['username'].value;
	var password = form['password'].value;
	var isFormValid;
	var un = checkField(username,"usernameError","username");
	var pw = checkField(password,"passwordError","password");

	if(un && pw){
		document.getElementById("loginform").submit();
	}
	else{
		return false;
	}
}