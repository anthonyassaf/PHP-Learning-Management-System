<?php
session_start();
include_once('../../BLL/userManager.php');


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

$form_data = array();
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
	$form_data['message']  = 'Current password cannot be blank';
} elseif (passStrength($new_password) == false && $new_password != null) {
	$form_data['success'] = false;
	$form_data['message'] = "6+ lower and upper case characters / contains at least 1 special characters and 1 number";
} elseif (!samePass($email, $current_password)){
	$form_data['success'] = false;
	$form_data['message'] = "Incorrect Password";
} 
else {
	$form_data['success'] = true;
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
	$form_data['message'] = 'Successfully Updated';
}
echo json_encode($form_data);

