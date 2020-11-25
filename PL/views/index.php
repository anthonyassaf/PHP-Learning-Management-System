<?php 
	include_once('login.php');
	
	if (($_SESSION['isLoggedIn']) != true) {
		$_SESSION['msg'] = "You must log in first";
		header('location: loginForm.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>index</title>
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">

		<!-- logged in user information -->
		<?php  if ($_SESSION['role'] == '3') : 
            header("location: studentDashboard.php");
			endif ?>
		<?php  if ($_SESSION['role'] == '1') : 
            header("location: adminDashboard-page.php");
			endif ?>
		<?php  if ($_SESSION['role'] == '2') : 
            header("location: teacherDashboard.php");
        	endif ?>
		
	</div>
		
</body>
</html>