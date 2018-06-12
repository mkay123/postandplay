<?php 
error_reporting(0);
session_start();
if( isset($_SESSION['id']) ){
	if($_SESSION['id'] ==1)
		header('Location:superadmin.php');
}
else{
	header('Location:index.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $oldpassword = $_POST['oldpassword'];
	$newpswd1 = $_POST['newpassword1'];
	$newpswd2 = $_POST['newpassword2'];

	if($oldpassword ==""){
		$errormsg1 = "Please enter old password";
	}
	else if($oldpassword != $_SESSION['password']){
		$errormsg1 = "Please type correct old password";
	}
	else if($newpswd1 ==""){
		$errormsg2 = "Please enter new password";
	}
	else if($newpswd1 == $oldpassword){
		$errormsg2 ="This is old password. Please enter new";
	}
	else if($newpswd2==""){
		$errormsg3 = "Please re-enter new password";
	}
	else if($newpswd1!=$newpswd2){
		$errormsg4 = "The passwords you entered don't match";
	}
	else{
		include('database.php');
		$sql = "UPDATE register SET Password = '$newpswd1' WHERE id=".$_SESSION['id'];
		if(mysqli_query($conn,$sql)){
			$_SESSION['password'] = $newpswd1;
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
			<tr><th> Password Settings </th></tr>
			<tr><td>
				Enter Old Password <input type="password" name="oldpassword" value="<?php echo isset($_POST['oldpassword'])?$_POST['oldpassword']:'' ?>">
				<span style="display:block;color:red"><?php echo $errormsg1; ?></span>
			</td></tr>
			<tr><td>
				Enter New Password <input type="password" name="newpassword1" value="<?php echo isset($_POST['newpassword1'])?$_POST['newpassword1']:'' ?>">
				<span style="display:block;color:red"><?php echo $errormsg2; ?></span>
			</td></tr>
			<tr><td>
				Confirm New Password <input type="password" name="newpassword2" value="<?php echo isset($_POST['newpassword2'])?$_POST['newpassword2']:'' ?>">
				<span style="display:block;color:red"><?php echo $errormsg3; ?></span>
			</td></tr>
			<tr><td>
				<span style="color:red"><?php echo $errormsg4 ?></span>
			</td></tr>
			<tr><td>
				<input type="submit" name="submit" value="Submit" id="submitbtn">
			</td></tr>
		</form>
		</table>

	</div>
	<?php include('include/footer.php'); ?>

</body>
</html>