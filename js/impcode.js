function validation(){
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
		if( username==""){
			document.getElementById("usernameError").style.display="block";
			document.getElementById("usernameError").innerHTML="Please enter username ";
			isFormValid = 0;
		}
		else{
			document.getElementById("usernameError").innerHTML="";
		}

		if(password==""){
			document.getElementById("passwordError").style.display="block";
			document.getElementById("passwordError").innerHTML="Please enter password";
			isFormValid = 0;
		}
		else{
			document.getElementById("passwordError").innerHTML="";
		}

	}
	if(fname == ""){
		document.getElementById("fnameError").style.display="block";
		document.getElementById("fnameError").innerHTML="Please enter first name";
		isFormValid = 0;
	}
	else{
		document.getElementById("fnameError").innerHTML="";
	}

	if(lname == ""){
		document.getElementById("lnameError").style.display="block";
		document.getElementById("lnameError").innerHTML="Please enter last name ";
		isFormValid = 0;
	}
	else{
		document.getElementById("lnameError").innerHTML="";
	}

	if(address == ""){
		document.getElementById("addressError").style.display="block";
		document.getElementById("addressError").innerHTML="Please enter address";
		isFormValid = 0;
	}
	else{
		document.getElementById("addressError").innerHTML="";
	}

	if(mobileno == ""){
		document.getElementById("phnnoError").style.display="block";
		document.getElementById("phnnoError").innerHTML="Please enter mobile no";
		isFormValid = 0;
	}
	else if(!/^\d{10}$/.test(mobileno)){
		document.getElementById("phnnoError").style.display="block";
		document.getElementById("phnnoError").innerHTML="Please enter correct mobile no";
		isFormValid = 0;
	}
	else{
		document.getElementById("phnnoError").innerHTML="";
	}

	if(gender == ""){
		document.getElementById("genderError").style.display="block";
		document.getElementById("genderError").innerHTML="Please enter gender";
		isFormValid = 0;
	}
	else{
		document.getElementById("genderError").innerHTML="";
	}

	if(!image){
		if(!hiddenImage){
			document.getElementById("imageError").style.display="block";
			document.getElementById("imageError").innerHTML="Please upload an image";
			isFormValid = 0;
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

	if(finalimage){
		var imageType = finalimage.split(".");
		imageType = imageType[imageType.length-1];
		if(imageType != "jpg" && imageType != "jpeg" && imageType != "png" && imageType != "gif"){
			document.getElementById("imageError").style.display="block";
			document.getElementById("imageError").innerHTML="Please upload only image";
			isFormValid = 0;
		}
		else{
			document.getElementById("imageError").innerHTML="";
		}
	}
	checkField(fname,"fnameError","first name");
	if(isFormValid){
		var alldata =document.forms['Rform'];
		processUser(alldata);
		
		/*
		if(sessionId ==1 ){
			var data = "username="+username+"&password="+password+"&fname="+fname+"&lname="+lname+"&address="+address+"&mobileno="+mobileno+"&gender="+gender+"&hiddenId="+hiddenId+"&image="+image+"&permissions="+permissions;
		}
		else{
			if(!username){
				var data ="fname="+fname+"&lname="+lname+"&address="+address+"&mobileno="+mobileno+"&gender="+gender+"&hiddenId="+hiddenId+"&image="+image;
			}
			else{
				var data = "username="+username+"&password="+password+"&fname="+fname+"&lname="+lname+"&address="+address+"&mobileno="+mobileno+"&gender="+gender+"&hiddenId="+hiddenId+"&image="+image;
			}	
		}*/
		
	}
	else{
		return false;
	}
}

/*xhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200 ){
				var result = JSON.parse(this.responseText);
				console.log(result);
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
		};	

		xhttp.open("POST","submit.php", true); 
		xhttp.send(formData);
		*/

/*
function processUser(FormData){
	alert("fdfsdfd");
		$.ajax({
			url:"submit.php",
			type:"POST",
			data: FormData,
			contentType: false,
			processData: false,
			success: function(response){
				console.log(response);
			}	
		});

}
*/