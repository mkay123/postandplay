<?php 
session_start();
if( $_SESSION['id'] != 1 ){
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="header">
	<button onclick="location.href='logout.php'" style="float: right;">Logout</button>
	<button onclick="location.href='createuser.php'" id="newuser">Create User</button>
</div>
<?php

//Delete multiple records
if(isset($_POST['dltmany'])){
	$ids = $_POST['checkbox'];
	$ids = implode(",",$ids);
	include('database.php');
	$query = "Delete from register where id IN ($ids)";
	if(mysqli_query($conn,$query)){
		echo "<span style='color:red'>Records deleted successfully</span>";
	}
	else{
		echo "there is eror in deletion";
	}
}
?>

<div class="adminpanel" style="overflow: scroll;">
	<table border="2" rules="all" cellpadding="10" cellspacing="5" align="center" class="superadmin">
		<tbody>
		<tr><th colspan="10">Users Details</th></tr>
		<tr>
		<th>S.No</th>
		<th>Image</th>
		<th>Email</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Phone No</th>
		<th>Address</th>
		<th colspan="3">Actions</th>
		</tr>
	<?php  		
		include('database.php');
		$sno = 1; 
		$sql = "select * from register where id!=1";
		$result = mysqli_query($conn,$sql);
		?>
		<form name="deleteform" action="" method="post">
		<?php
		while ($row = mysqli_fetch_array($result)){ ?>
			<tr>
				<td><?php  //echo $sno; ?><input type="checkbox" style="margin-left: 40px;" name="checkbox[]" value="<?php echo $row['id']; ?>"></td>
			    <td><img src="images/<?php echo $row['ImageName']; ?>" width="100px"></td>
			    <td> <?php  echo $row['Username']; ?></td>
				<td> <?php  echo $row['FirstName']; ?></td>
				<td> <?php  echo $row['LastName']; ?></td>
				<td> <?php  echo $row['Phone']; ?> </td>
				<td> <?php  echo $row['Address']; ?></td>
				<td><button type="button" onclick="location.href='edit.php?id=<?php echo $row['id']; ?>'">Edit</button></td>
				<td><button type="button" onclick="location.href='permission.php?id=<?php echo $row['id']; ?>'" id="permissions">Permissions</button></td>
				<td><button onclick="confirmationDelete(this.value);" value="<?php echo $row['id']; ?>" style="background:red" >Delete</button></td> 
			</tr>
			<?php $sno++;
		}
	?>	
	<tr><td><input type="submit" value="Delete Selected" name="dltmany" style="background:red;color:white;height:30px;padding:5px;"></form></td></tr>
		</tbody>
	</table>
</div>
<script>
	function confirmationDelete(userId){
   		var conf = confirm('Are you sure want to delete this record?');
   		if(conf)
      	window.location.href="delete.php?id="+userId;
	}	
</script>
<?php include('include/footer.php'); ?>

</body>
</html>