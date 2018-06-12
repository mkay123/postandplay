 <?php
 
$q = $_REQUEST["q"];
include('database.php');
$sql = "select Username from register where Username = '$q'";
$result = mysqli_query($conn,$sql);
if( mysqli_num_rows($result) > 0 ){
   echo "Email already exist";
}
else{
	echo "Perfect";
}
?> 