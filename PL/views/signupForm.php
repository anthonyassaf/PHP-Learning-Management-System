<?php include('signup.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../styles/pages/registration-page.css">
</head>

<body>

	<div class="registrationForm">
		<form method="post" id="signupForm" name="signupForm" action="register.php">
		<center style="color: red"><?php include('errors.php'); ?> </center> 
			<h2>Sign Up</h2>
			<p class="hint-text"></p>
			<div class="form-group">
				<input type="text" class="form-control" name="fname" placeholder="First Name*" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="lname" placeholder="Last Name*" required>
			</div>
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="Email*" required>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="pass" name="password" placeholder="Password*" required>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="cpass" name="cpassword" placeholder="Confirm Password*"
					required>
			</div>
			<center>
				<div id="passerror"></div>
			</center>

			<div class="form-group">
				<input type="submit" id="btn" class="btn btn-success btn-lg btn-block" value="Sign Up" name="reg_user">
			</div>
			<center><a href="loginForm.php">Already have an account? Sign in</a></center>
		</form>
	</div>
	
</body>

</html>