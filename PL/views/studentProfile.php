<?php
session_start();
include_once('../../BLL/userManager.php');

$errors = array();

$form_data = array(); //Pass back the data to `form.php`


$email = $_SESSION['email'];
$new_fname = $_POST['firstname'];
$new_lname = $_POST['lastname'];
$current_password = $_POST['password'];
$new_password = $_POST['newpassword'];

if (empty($new_fname)) {
	$form_data['success'] = false;
	$form_data['message']  = 'First name cannot be blank';
} elseif (empty($new_lname)) {
	$form_data['success'] = false;
	$form_data['message']  = 'Last name cannot be blank';
} elseif (empty($current_password)) {
	$form_data['success'] = false;
	echo "hi";
	$form_data['message']  = 'Current password cannot be blank';
} elseif (passStrength($new_password) == false && $new_password != null) {
	$form_data['success'] = false;
	$form_data['message'] = "6+ lower and upper case characters / contains at least 1 special characters and 1 number";
} else {
	$form_data['success'] = true;
	$result = NULL;
	if ($new_fname != $_SESSION['fname']) {
		$_SESSION['fname'] = $new_fname;
		$result = edit('firstname', $new_fname, $email);
	}
	if ($new_lname != $_SESSION['lname']) {
		$_SESSION['lname'] = $new_lname;
		$result = edit('lastname', $new_lname, $email);
	}
	if ($new_password != NULL) {
		$result = edit('password', $new_password, $email);
	}

	#file name with a random number so that similar dont get replaced
	$ppUrl = rand(1000, 10000) . "-" . $_FILES["file"]["name"];
	#temporary file name to store file
	$tname = $_FILES["file"]["tmp_name"];
	#upload directory path
	$uploads_dir = '../assets/images/users';
	#TO move the uploaded file to specific location
	move_uploaded_file($tname, $uploads_dir . '/' . $ppUrl);

	$result = edit('profileImageURL', $ppUrl, $email);

	$form_data['message'] = 'Successfully Updated';
	echo json_encode($form_data);
}
/*
if ($result != null) {
	$_SESSION['ppURL'] = $ppUrl;
	echo '<script type="text/javascript"> alert("User successfully updated")</script>';
} else
	echo '<script type="text/javascript"> alert("Error")</script>';
	*/

	function passStrength($password)
{
	if (strlen($password) < 6) {
		return False;
	}
	if (!preg_match("#[0-9]+#", $password)) {
		return False;
	}
	if (!preg_match("#[a-z]+#", $password)) {
		return False;
	}
	if (!preg_match("#[A-Z]+#", $password)) {
		return False;
	}
	if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password)) {
		return False;
	}
	return true;
}
?>