<?php 
error_reporting(0);
session_start();
if( isset($_SESSION['id']) ){
	if($_SESSION['id'] ==1)
		header('Location:superadmin.php');
}
else{
	header('Location:logout.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$oldusername = $_POST['oldusername'];
	$newusername = $_POST['newusername'];
	$password = $_POST['password'];

	if($oldusername ==""){
		$errormsg1 = "Please enter old username";
	}
	else if($oldusername != $_SESSION['username']){
		$errormsg1 = "Incorrect username";
	}
	else if($newusername ==""){
		$errormsg2 = "Please enter new username";
	}
	else if($newusername == $oldusername){
		$errormsg2 = "This is your current username. Please try another";
	}
	else{
		//$id=$_GET['id'];
		include('database.php');
		$sql = "UPDATE register SET Username = '$newusername' WHERE id=".$_SESSION['id'];
		if(mysqli_query($conn,$sql)){
			$_SESSION['username'] = $newusername;
			header('Location: admin.php');
		}
		else{
			$errormsg4="please try after some time";
		}
	}
}

?>

<html>
<head>
	<title>
	Settings
</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="header">
	<div>		
		<button onclick="location.href='admin.php'">Dashboard</button>
		<button onclick="location.href='logout.php'" style="float: right;">Logout</button>
		<select id="settings" class="blue">
		 	<option>Settings</option>
		 	<option onclick="location.href='username_setting.php'">Change Username</option>
		 	<option onclick="location.href='password_setting.php'">Change Password</option>
		</select>
	</div>
</div>
<div class="adminpanel">
<table border="1" cellpadding="6" cellspacing="4" rules="none" align="center">
<form action="" method="POST">
	<tr><th> Username Settings </th></tr>
	<tr><td> 
		Enter Old Username <input type="text" name="oldusername" value="<?php echo isset($_POST['oldusername'])?$_POST['oldusername']:'' ?>">
		<span style="display:block;color:red"><?php echo $errormsg1; ?></span>
	</td></tr>
	<tr><td>
		Enter New Username <input type="text" name="newusername"  onblur="Hint(this.value)" value="<?php echo isset($_POST['newusername'])?$_POST['newusername']:'' ?>"><span id="demo"></span>
		<span style="display:block;color:red"><?php echo $errormsg2; ?></span>
	</td></tr>
	<tr><td>
		<span style="display:block;color:red"><?php echo $errormsg4; ?></span>
	</td></tr>
	<tr><td>
		<input type="submit" name="submit" value="Submit" id="submitbtn">
	</td></tr>
</form>
</table>
</div>
<script type="text/javascript" src="js/emailhint.js"></script>
<?php include('include/footer.php'); ?>

</body>
</html>