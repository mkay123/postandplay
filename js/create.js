function formValidation(){
	var form = document.forms['userForm'];
	var username= form['username'].value;
	var password = form['password'].value;
	var mobileno= form['phnno'].value;
	var isFormValid;
	
	if(username== ""){
			document.getElementById("usernameError").style.display="block";
			document.getElementById("usernameError").innerHTML="Please enter username ";
			isFormValid = 0;
	}
	else{
			document.getElementById("usernameError").innerHTML="";
	}

	if(password == ""){
			document.getElementById("passwordError").style.display="block";
			document.getElementById("passwordError").innerHTML="Please enter password";
			isFormValid = 0;
	}
	else{
			document.getElementById("passwordError").innerHTML="";
	}

	if(mobileno == ""){
		document.getElementById("phnnoError").style.display="block";
		document.getElementById("phnnoError").innerHTML="Please enter mobile no";
		isFormValid = 0;
	}
	else{
		document.getElementById("phnnoError").innerHTML="";
	}


	if(isFormValid == 0){
		return false;
	}
	else{
		document.getElementById("userForm").submit();
	}
}