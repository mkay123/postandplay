<?php
// To Render User Data in Registration Form 
error_reporting(0);
session_start();
if($_SESSION['id'] == 1)
	 $id = $_GET['id'];
else
	 $id = $_SESSION['id'];
$dbperm=array();


include('database.php'); 
if ( isset( $_SESSION['username'] ) && isset( $_SESSION['password']) ) { ?> 
	<button onclick="location.href='logout.php'" style="float: right;">Logout</button>
	<?php if($_SESSION['id'] ==1 ){ ?>
		<button onclick="location.href='superadmin.php'" style="float: left;">Dashboard</button> 
		<?php } else {?>
		<button onclick="location.href='admin.php'" style="float: left;">Dashboard</button>
		<?php } ?>
	<?php if($_SESSION['id']!=1){ ?>
	 	<select id="settings" class="blue">
	 		<option>Settings</option>
	 		<option onclick="location.href='username_setting.php'">Change Username</option>
	 		<option onclick="location.href='password_setting.php'">Change Password</option>
	 	</select>
	<?php } 
		if($id){
			$sql = "select * from register where id=$id";
			$result = mysqli_query($conn,$sql);
			while ($row = mysqli_fetch_array($result)){
				$uname =   $row['Username'];
				//$dbPassword =  $row['Password'];
				$fname = $row['FirstName'];
				$lname = $row['LastName'];
				$addr = $row['Address'];
				$phnno =  $row['Phone'];
				$gender = $row['Gender'];
				$dbImageName = $row['ImageName'];
				$permissions = $row['Permissions'];
		    	$dbperm = explode(',',$permissions);
			}
		}
				
}

if(!isset($_SESSION['id'])){ ?>
<button onclick="location.href='index.php'" style="float: right;">Log In</button>
<?php } ?>

<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<div class="header"></div>
	<div class="edit-container">
		<!-- START: Registration Form-->
		<?php include('include/form.php'); ?>
		<!-- END: Registration Form-->
	</div>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/emailhint.js"></script>
	<script type="text/javascript" src="js/validation.js"></script>
</body>
</html>