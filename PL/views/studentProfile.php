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
    }
    if ( !preg_match("#[a-z]+#", $password) ) {
        $returnVal = False;
    }
    if ( !preg_match("#[A-Z]+#", $password) ) {
        $returnVal = False;
    }
    if ( !preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password) ) {
        $returnVal = False;
    }
    return $returnVal;
}

	//UPDATE USER
	if(isset($_POST['update_user'])){
		$id = $_SESSION['id'];
		$new_fname = $_POST['firstname'];
		$new_lname = $_POST['lastname'];
		$current_password = $_POST['currentPassword'];
		$new_password= $_POST['newPassword'];
		$new_email = $_POST['email'];
		
		if (empty($new_fname)) { array_push($errors, "First Name is required"); }
		if (empty($new_lname)) { array_push($errors, "Last Name is required"); }
		if (empty($new_email)) { array_push($errors, "Email is required"); }
		if (empty($current_password)) { array_push($errors, "Password is required"); }
	  
		if ($current_password != $new_password && $new_password != null) {
			array_push($errors, "The two passwords do not match");
		}
	  
		if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
			array_push($errors, "Invalid email format");
		}
	  
		if(passStrength($new_password) == false && $new_password != null){
			array_push($errors, "6+ lower and upper case characters / contains at least 1 special characters and 1 number");
		}		

		if (count($errors) == 0) {
			if($new_fname != $_SESSION['fname']){
				$_SESSION['fname'] = $new_fname;
				update('firstname', $new_fname, $id);
			}
			if($new_lname != $_SESSION['lname']){
				$_SESSION['lname'] = $new_lname;
				update('lastname', $new_lname, $id);
			}
	
			if($new_password != NULL){
				$_SESSION['password'] = $npassword;
				update('password', $npassword, $id);
			}

			if($new_email != $_SESSION['email']){
				$_SESSION['email'] = $new_email;
				update('email', $new_email, $id);
			}

			  echo '<script type="text/javascript"> alert("User successfully updated")</script>';
		}

	}