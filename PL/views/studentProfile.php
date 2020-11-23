<?php

    
include_once('../../BLL/userManager.php');

include_once('login.php');

$errors = array(); 

function passStrength($password) {
    $returnVal = True;
    if ( strlen($password) < 6) {
        $returnVal = False;
    }
    if ( !preg_match("#[0-9]+#", $password) ) {
        $returnVal = False;
    }/*
    if ( !preg_match("#[a-z]+#", $password) ) {
        $returnVal = False;
    }
    if ( !preg_match("#[A-Z]+#", $password) ) {
        $returnVal = False;
    }
    if ( !preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password) ) {
        $returnVal = False;
    }*/
    return $returnVal;
}

	//UPDATE USER
	if(isset($_POST['update_user'])){
		$email = $_SESSION['email'];
		$new_fname = $_POST['firstname'];
		$new_lname = $_POST['lastname'];
		$current_password = $_POST['currentPassword'];
		$new_password= $_POST['newPassword'];
		
		if (empty($new_fname)) { array_push($errors, "First Name is required"); }
		if (empty($new_lname)) { array_push($errors, "Last Name is required"); }
		if (empty($current_password)) { array_push($errors, "Password is required"); }
	  
		if(passStrength($new_password) == false && $new_password != null){
			array_push($errors, "6+ lower and upper case characters / contains at least 1 special characters and 1 number");
		}		

		$result = null;
		if (count($errors) == 0) {
			if($new_fname != $_SESSION['fname']){
				$_SESSION['fname'] = $new_fname;
				$result = update('firstname', $new_fname, $email);
			}
			if($new_lname != $_SESSION['lname']){
				$_SESSION['lname'] = $new_lname;
				$result = update('lastname', $new_lname, $email);
			}
	
			if($new_password != NULL){
				$result =update('password', $new_password, $email);
			}
			if($result != null )
			  echo '<script type="text/javascript"> alert("User successfully updated")</script>';
			else 
			  echo '<script type="text/javascript"> alert("Error")</script>';
		
		}

	}