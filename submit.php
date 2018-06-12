<?php

echo "<pre>";print_r($_POST);
print_r($_FILES);
session_start();
if(isset($_REQUEST)){
    if(isset($_POST['username'])){
    	$uname = $_POST['username'];
    }
    if(isset($_POST['password'])){
		$password = $_POST['password'];
	}
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$addr = $_POST['address'];
	$phnno = $_POST['phnno'];
	$gender = $_POST['gender'];
	$dbImageName = $_POST['dbImageName'];
	$imgname = $_FILES['image']['name'];
	$hiddenid = $_POST['hiddenid'];

	if(isset($_POST['perm'])){
		$permissions = implode(",",$_POST['perm']);
	}

		include('database.php');
		if($hiddenid){
			if(isset($permissions)){
				$query = "UPDATE register SET FirstName='$fname' ,LastName='$lname' ,Address = '$addr' ,Phone = '$phnno' , Gender ='$gender' , ImageName ='$imgname' ,Permissions='$permissions' WHERE id='$hiddenid'";
			}
			else{
				$query = "UPDATE register SET FirstName='$fname' ,LastName='$lname' ,Address = '$addr' ,Phone = '$phnno' , Gender ='$gender' , ImageName ='$imgname' WHERE id='$hiddenid'";
			}
		}
		else{
			if(isset($permissions)){
				$query = "INSERT into register(Username,Password,FirstName,LastName,Address,Phone,Gender,ImageName,Permissions) VALUES('$uname','$password','$fname','$lname','$addr','$phnno','$gender','$imgname','$permissions')";
			}
			else{
				$query = "INSERT into register(Username,Password,FirstName,LastName,Address,Phone,Gender,ImageName) VALUES('$uname','$password','$fname','$lname','$addr','$phnno','$gender','$imgname')";
			}		
		}

	    if(mysqli_query($conn,$query) ){  
	    		//move_uploaded_file($_FILES["image"]["tmp_name"], "images/".$_FILES["image"]["name"]);
			    if($hiddenid){ 
						if($_SESSION['id']==1)
							$response['type'] = "superadmin";
						else{
							$response['type'] = "admin";
							$response['img'] = $imgname;
						} 	
				}
				else{  
					$response['type'] = "newuser";
				}
		}
		else{
			$response['type'] = "error";
		}
		echo json_encode($response);


	//}
}

?>