<?php
session_start();
if( !isset($_SESSION['id']) ){
	header('Location:index.php');
}

$id = $_GET['id'];
if($id){
 	include('database.php');
	$sql = "delete from register where id=$id";
	$result = mysqli_query($conn,$sql);
	header('Location: superadmin.php');	
}

?>