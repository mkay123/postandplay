	
<table border="1" cellpadding="6" cellspacing="4" rules="none" align="center" id="<?php echo isset($id)?'edittable':'signuptable'?>">
<form name="Rform" id="RegForm" action="" method="POST"  enctype="multipart/form-data" >
	<tr><th> Registration Form </th></tr>
	<input type="hidden" name="hiddenid" value="<?php if($id) echo $id; ?>" >
	<input type="hidden" name="dbImageName" value="<?php echo isset($dbImageName)?$dbImageName:'' ?>">
	<input type="hidden" name="sessionid" value="<?php echo $_SESSION['id']; ?>">
	<input type="hidden" id="isvalid" value="1">
	<?php if(!$id){ ?>
	<tr><td>
		Enter Username <input type="text" name="username" id="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" onblur="Hint(this.value)" value="<?php echo isset($uname)?$uname:''; ?>"><span id="demo"></span>
		<span id="usernameError" style="display: none;color: red"></span>
	</td></tr>
	<tr><td>
		Enter Password <input type="password" name="password" id="password">
		<span id="passwordError" style="display: none;color: red"></span>
	</td></tr>
	<?php } ?>
	<tr><td>
		Enter First Name <input type="text" name="fname" pattern="[a-zA-Z]{1,}" id="fname" value="<?php echo isset($fname)?$fname:''; ?>">
		<span id="fnameError" style="display: none;color: red"></span>
	</td></tr>
	<tr><td>
		Enter Last Name <input type="text" name="lname" pattern="[a-zA-Z]{1,}" id="lname" value="<?php echo isset($lname)?$lname:''; ?>">
		<span id="lnameError" style="display: none;color: red"></span>
	</td></tr>
	<tr><td>
		Enter Address  <textarea name="address" id="address" rows="3" cols="18"><?php echo isset($addr)?$addr:''; ?></textarea>
		<span id="addressError" style="display: none;color: red"></span> 
	</td></tr>
	<tr><td>
		Enter Mobile No <input type="text" name="phnno" id="phnno" value="<?php echo isset($phnno)?$phnno:''; ?>">
		<span id="phnnoError" style="display: none;color: red"></span>
	</td></tr>
	<tr><td>
		Select Picture <input type="file" name="image" id="fileimage" value="<?php echo realpath(this); ?>">
		<span id="imageError" style="display:block;color: red"><?php if(isset($imgerror)) echo $imgerror; ?></span>
		<?php if($id){ ?> <img id="userimage" src="images/<?php echo $dbImageName; ?>" width="100px"><?php } ?>
	</td></tr>
	<tr><td>
		Select Gender 
		 <input type="radio" name="gender" value="male" <?php echo (isset($gender) && $gender=="male")?"checked":""; ?> > Male
		 <input type="radio" name="gender" value="female" <?php echo (isset($gender) && $gender=="female")?"checked":""; ?> > Female
		 <span id="genderError" style="display: none;color: red"></span>
	</td></tr>
	<?php if($_SESSION['id']==1){ 
		$query = "SELECT * FROM module";
		$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_array($result)){ ?>
			<tr><td><input type="checkbox" name="perm[]" class="permissions" value="<?php echo $row['name']; ?>"
				<?php if (in_array($row['name'], $dbperm)){echo 'checked'; } ?>>
				<?php echo " ".$row['name'] ?>
			</td></tr>
	<?php } } ?>

	<tr><td>
		<input type="submit" name="submit" value="<?php echo isset($id)?'Update':'Submit' ?>" id="submitbtn" >
	</td></tr>
</form>
<span id="msg"></span>
</table>
