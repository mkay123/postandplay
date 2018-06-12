
<?php
session_start();
include('database.php');
/*if(!isset( $_SESSION['username'] ) || $_SESSION['id']==1){
	header('Location: index.php');
}*/

//To get full name from username
$sql = "select FirstName,LastName from register where id='".$_SESSION['id']."'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>=1){
	$row = mysqli_fetch_array($result);
	$fullname = $row['FirstName'].' '.$row['LastName']; 
}
//echo "<span id='welcome'>Welcome $fullname</span>";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="header">
<div>
<button onclick="location.href='logout.php'" style="float: right;">Logout</button>
 	<select id="settings" class="blue">
	 	<option>Settings</option>
	 	<option onclick="location.href='username_setting.php'">Change Username</option>
	 	<option onclick="location.href='password_setting.php'">Change Password</option>
	</select>
</div>
</div>
<div class="adminpanel">	
<table border="2" rules="rows" cellpadding="20" cellspacing="10" align="center" style="width: 400px" id="admintable">
	<tr><th colspan="2">Welcome <?php echo $fullname ?></th></tr>
	<?php  	
			$sql = "select * from register where id='".$_SESSION['id']."'";
			$result = mysqli_query($conn,$sql);
			while ($row = mysqli_fetch_array($result)){ ?>
				<tr><th>Photo</th><td><img src="images/<?php echo $row['ImageName']; ?>" width="100px"></td></tr>
				<tr><th>Full Name</th><td><?php  echo $row['FirstName']." ".$row['LastName']; ?></td></tr>
				<tr><th>Username</th><td><?php  echo $row['Username']; ?></td></tr>
				<tr><th>Phone Number</th><td><?php  echo $row['Phone']; ?></td></tr>
				<tr><th>Address</th><td><?php  echo $row['Address']; ?></td></tr>
				<tr><th>Permissions</th><td><?php  echo $row['Permissions']; ?></td></tr>
				<tr><td><button onclick="location.href='edit.php'">Edit</button></td></tr>
				<?php  
			}
	?>	
</table>
</div>	
	<?php include('include/footer.php'); ?>
</body>
</html>