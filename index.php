<?php
session_start();
if( isset($_SESSION['id']) ){
	if($_SESSION['id'] ==1)
		header('Location:superadmin.php');
	else
		header('Location:admin.php');
}

if(isset($_GET['code'])){
	$code = $_GET['code'];	
	attempt_login($code);
}

function attempt_login($code){
	$client_id ="38a57204d63740c7b6ed20c04ec1743c";
	$redirect_uri = "http://localhost/mohit2/index.php";
	$client_secret = "1f5f378f629d4251b117ed7bd4de0a00";
	//$code = "a263032ab60044adadd7dddbc0925470"; //code will be new each time 

	$url = 'https://api.instagram.com/oauth/access_token';
		
		$curlPost = 'client_id='. $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);			
		$data = json_decode(curl_exec($ch), true);	
		//print_r($data);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);	
		curl_close($ch); 	
		//exit;	
		if($http_code != '200')			
			throw new Exception('Error : Failed to receive access token');
		
		
		include('database.php');
		$uname = $data['user']['username'];
		$fullname = explode(" ",$data['user']['full_name']);
		$fname =  $fullname[0];
		$lname = $fullname[1];
		$_SESSION['username'] = $data['user']['username'];
		$_SESSION['password'] = $data['access_token'];
		$pswd = $_SESSION['password'];
		
		//store image
		$no = rand(1,1000);
		$imagename = "image".$no;
		$content = file_get_contents($data['user']['profile_picture']);
		file_put_contents('images/'.$imagename, $content);
		
		//insert/update instagram user data
		echo $query = "INSERT into register(Username,Password,FirstName,LastName,ImageName) VALUES('$uname','$pswd','$fname','$lname','$imagename')";
		if(mysqli_query($conn,$query) ){ 
			echo "inner"; 
			$query = "Select id from register where Username ='$uname' AND Password='$pswd'";
			$result = mysqli_query($conn,$query);
			while($row = mysqli_fetch_array($result)){
				$_SESSION['id'] = $row['id'];
			}
			//ini_set('session.gc_maxlifetime', 3600);
			//session_set_cookie_params(3600);
			header('Location: admin.php');
		};
}


$forgot = $errormsg =""; 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$username = $_POST['username'];
		$password = $_POST['password'];
		include('database.php');
		$query = "select id from register where Username='$username' AND Password='$password'";
		$result = mysqli_query($conn, $query);
	    if(mysqli_num_rows($result) == 1 ){
	    		$row = mysqli_fetch_array($result);
	    		$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;
				$_SESSION['id'] = $row['id'];
	    		if($row['id'] == 1){
	    			header('Location: superadmin.php');
	    		}
	    		else{
	    			header('Location: admin.php');
	    		}		
		}
		else{ 
				$errormsg="Invalid Username Or Password";
				$forgot = "Forgot password ?";
		}	
}
?>
<html>
<head>
	<title>
		Login Form
	</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">	
<button style="float: right" onclick="location.href='register.php'">Sign Up</button>
<table border="1" cellpadding="6" cellspacing="4" rules="none" align="center" id="logintable">
<form action="" name="loginform" method="POST" onsubmit="return login()">
	<tr><th> Login </th></tr>
	<tr><td>
		Enter Username <input type="text" name="username">
		<span id="usernameError" style="display: none;color: red"></span>
	</td></tr>
	<tr><td>
		Enter Password <input type="password" name="password">
		<span id="passwordError" style="display: none;color: red"></span>
	</td></tr>
	
	<tr><td>
		<a href="recover_account.php" style="text-decoration: none;color: black"> <?php echo $forgot; ?> </a>
	</td></tr>
	<tr><td>
		<span style="color:red"><?php echo $errormsg ?></span>
	</td></tr>
	<tr><td>
		<input type="submit" name="submit" value="Login" id="submitbtn">
	</td></tr>
</form>
<tr><td><a style="text-decoration:none" href="https://api.instagram.com/oauth/authorize/?client_id=38a57204d63740c7b6ed20c04ec1743c&redirect_uri=http://localhost/mohit2/index.php&response_type=code">Login with instagram</a></td></tr>
</table>

</div>
<script type="text/javascript"  src="js/validation.js"></script>
</body>
</html>
