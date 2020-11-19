<?php

session_start();
    
include_once('../../BLL/userManager.php');

// variable declaration
$id = "";
$fname = "";
$lname = "";
$username = "";
$email    = "";
$gender   = "";
$expiryDate = "";
$remaining = "";
$errors = array(); 
$_SESSION['success'] = "";


function sendMail($fname, $lname, $remaining, $mail){
    $name = $fname + " " + $lname;
    $subject = "Greeting Message";
    $message = "Welcome " + $name + ", your account expires in " + $remaining + " days";
    $headers = "From: ex@example.com";
    mail($mail, $subject, $message, $headers);
}

if (isset($_POST['login_user'])) { 
    $username = $_POST['username'];
    $_SESSION["username"] = $username;
    $password = $_POST['password'];

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    
    if (count($errors) == 0) {
        $salt = 's+(_a*';
        $password = md5($salt.$password.$salt);
        $row = signIn($username, $password);
        if($row != NULL){
            $_SESSION['username'] = $username;
            $_SESSION['fname'] = $row["firstname"];
            $_SESSION['lname'] = $row["lastname"];
            $_SESSION['expiryDate'] = $row["expiryDate"];
            $_SESSION['password'] = $row["password"];
            $_SESSION['email'] = $row["email"];
            $_SESSION['id'] = $row["id"];
            $datetime1 = strtotime($row["tokenExpiryDate"]);
            $today = date("y-m-d");
            $datetime2 = strtotime($today);
            $secs = $datetime1 - $datetime2;
            $days = $secs / 86400;
            $_SESSION['remaining'] = $days;
            $_SESSION['success'] = "You are now logged in";
        //	sendMail($fname, $lname, $remaining, $mail);
            header('location: ../../index.php');
        }
        else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}


?>