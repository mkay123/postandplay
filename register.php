<?php error_reporting(0);  ?>

<button onclick="location.href='index.php'" style="float: right;">Log In</button>
<!DOCTYPE html>
<html>
<head>
	<title>Registraion Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">	
	<!-- START: Registration Form-->
		<?php include('include/form.php'); ?>
	<!-- END: Registration Form-->
</div>

<script type="text/javascript" src="js/emailhint.js"></script>
<script type="text/javascript" src="js/validation.js"></script>
</body>
</html>
