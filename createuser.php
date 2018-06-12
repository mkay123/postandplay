<?php
error_reporting(0);
session_start();
if( $_SESSION['id'] != 1 ){
	header('Location: index.php');
}
		include('database.php');
//$userid = $_GET['id'];

	//To Render Permisssions in form
	//include('database.php');
	/*$query = "SELECT permissions FROM register WHERE id=$userid";
	$result = mysqli_query($conn,$query); 
	if(mysqli_num_rows($result) == 1){
	    	$row = mysqli_fetch_array($result);
	    	$permissions = $row['permissions'];
	    	$dbperm = explode(',',$permissions);
	} */

	//To Insert Data Into Database
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$uname =   $_POST['username'];
		$password =   $_POST['password'];
		$phnno =   $_POST['phnno'];
		$getPerm = $_POST['perm'];

		for($i=0; $i<count($getPerm);$i++){
			if($i==0){
				$perm = $perm.$getPerm[$i];
			}
			else{
				$perm = $perm.",".$getPerm[$i];
			}
		}
		$query = "INSERT into register(Username,Password,Phone,Permissions) VALUES('$uname','$password','$phnno','$perm')";
	   	if(mysqli_query($conn,$query) ){ 
	    	header('Location:superadmin.php');
		}
		else{
			echo "error in query";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="header">	
	<button onclick="location.href='logout.php'" style="float: right;">Logout</button>
	<button onclick="location.href='superadmin.php'" style="float: left;">Dashboard</button>
</div>
<div class="adminpanel">	
<table border="1" cellpadding="6" cellspacing="4" rules="none" align="center" id="permissionform">
<form name="userForm" id="userForm" action="" onsubmit="return formValidation()" method="POST"  enctype="multipart/form-data" >
	<tr><th> Permisssions Form</th></tr>
	<tr><td>
		Enter Username <input type="text" name="username" id="Email" onkeyup="Hint(this.value)"><span id="demo"></span>
		<span id="usernameError" style="display: none;color: red"></span>
	</td></tr>
	<tr><td>
		Enter Password <input type="password" name="password" id="password">
		<span id="passwordError" style="display: none;color: red"></span>
	</td></tr>
	<tr><td>
		Enter Mobile No <input type="text" name="phnno" id="phnno">
		<span id="phnnoError" style="display: none;color: red"></span>
	</td></tr>

	<?php
		$query = "SELECT * FROM module";
		$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_array($result)){ ?>
			<tr><td><input type="checkbox" name="perm[]" value="<?php echo $row['name']; ?>" <?php if (in_array($row['name'], $dbperm)){echo 'checked'; } ?>><?php echo " ".$row['name'] ?> </td></tr>
	<?php } ?>
	<tr><td>
		<input type="submit" name="submit" value="Create" id="submitbtn" >
	</td></tr>
</form>
</table>
</div>
<script type="text/javascript" src="js/emailhint.js"></script>
<script type="text/javascript" src="js/create.js"></script>
<?php include('include/footer.php'); ?>
</body>
</html>
