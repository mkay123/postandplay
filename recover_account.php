<?php
error_reporting(0);
session_start();
if( !isset($_SESSION['id']) ){
	header('Location:index.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $username = $_POST['username'];
    include('database.php');
	$sql = "select Password from register where Username = '$username'";
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result) == 1){
		 $msg="Password is sent to your email";
	}
	else{
		 $msg="<span style='color:red'>Your email id doesn't exist<span>";
	}
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Recover Your Password</title>
</head>
</body>
	<?php include('include/header.php'); ?>
<table border="1" cellpadding="6" cellspacing="4" rules="none" align="center">
<form action="" method="POST">
	<tr><th> Recover Password </th></tr>
	<tr><td>
		Enter Your Email <input type="text" name="username">
	</td></tr>
	<tr><td>
		<?php echo $msg; ?>
	</td></tr>
	<tr><td>
		<input type="submit" name="submit" value="Submit" id="submitbtn">
	</td></tr>
</form>
</table>
	<?php include('include/footer.php'); ?>
</body>
</html>

