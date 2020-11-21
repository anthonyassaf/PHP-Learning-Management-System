<?php

session_start();
    
include_once('../../BLL/userManager.php');

// variable declaration
$id = "";
$fname = "";
$lname = "";
$email    = "";
$errors = array(); 
$user = "";
$_SESSION['success'] = "";

if (isset($_POST['login_user'])) { 
    $email = $_POST['email'];
    $_SESSION["email"] = $email;
    $password = $_POST['password'];
    $_SESSION["user"] = "admin";

    if (empty($email)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    
    if (count($errors) == 0) {
        //$salt = 's+(_a*';
        //$password = md5($salt.$password.$salt);
        $row = signIn($email, $password);
        if($row != NULL){
            $_SESSION['fname'] = $row["firstname"];
            $_SESSION['lname'] = $row["lastname"];
            $_SESSION['password'] = $row["password"];
            $_SESSION['email'] = $row["email"];
            $_SESSION['id'] = $row["id"];
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
        else {
            array_push($errors, "Wrong email/password combination");
        }
    }
}


?>