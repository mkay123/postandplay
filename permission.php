<?php
error_reporting(0);
session_start();
if( $_SESSION['id'] != 1 ){
	header('Location: index.php');
}
$userid = $_GET['id'];

	//To Render Permisssions in form
	include('database.php');
	$query = "SELECT Permissions FROM register WHERE id=$userid";
	$result = mysqli_query($conn,$query); 
	if(mysqli_num_rows($result) == 1){
	    	$row = mysqli_fetch_array($result);
	    	$permissions = $row['Permissions'];
	    	$dbperm = explode(',',$permissions);
	} 

	//To Insert Data Into Database
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$getPerm = $_POST['perm'];
		for($i=0; $i<count($getPerm);$i++){
			if($i==0){
				$perm = $perm.$getPerm[$i];
			}
			else{
				$perm = $perm.",".$getPerm[$i];
			}
		}

		$query = "UPDATE register SET Permissions='$perm' WHERE id=$userid";
	    if(mysqli_query($conn,$query) ){  
	    	header('Location:superadmin.php');
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
	<?php include('include/footer.php'); ?>
</body>
</html>
