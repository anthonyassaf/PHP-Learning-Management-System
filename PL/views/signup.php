<?php

session_start();
    
include_once('../../BLL/userManager.php');

// variable declaration
$id = "";
$fname = "";
$lname = "";
$username = "";
$email    = "";
$remaining = "";
$errors = array(); 
$_SESSION['success'] = "";


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


function validateSignup($fname, $lname, $username, $email, $password_1, $password_2){
    GLOBAL $errors;
  // form validation: ensure that the form is correctly filled
  if (empty($fname)) { array_push($errors, "First Name is required"); }
  if (empty($lname)) { array_push($errors, "Last Name is required"); }
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }

  if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Invalid email format");
  }

  if(passStrength($password_1) == false){
      array_push($errors, "6+ lower and upper case characters / contains at least 1 special characters and 1 number");
  }
}

if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password'];
    $password_2 = $_POST['cpassword'];
    $gender = $_POST['gender'];

    $_SESSION["username"] = $username;

    validateSignup($fname, $lname, $username, $email, $password_1, $password_2);

    // register user if there are no errors in the form
    if (count($errors) == 0) {
       
	   //signup
      
    }

}

?>