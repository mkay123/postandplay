<?php
$conn = mysqli_connect("localhost", "root", "","form_db");
if (!$conn){
	die("Connection failed: " . mysqli_connect_error());
}
?>