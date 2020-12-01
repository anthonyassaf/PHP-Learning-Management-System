<?php

session_start();    
include_once('../../BLL/userManager.php');

// variable declaration
$id = "";
$fname = "";
$lname = "";
$email    = "";
$errors = array(); 
$role = "";
$imageProfileURL = "";
$studentGpa = "";
$faculty = "";
$teacherAcademicRank = "";
$courses = array();
$userId = "";
$isLoggedIn;
$_SESSION['success'] = "";

function validateSignIn($email, $password){ 
    if (empty($email)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
}

if (isset($_POST['login_user'])) { 
    $email = $_POST['email'];
    $password = $_POST['password'];

    validateSignIn($email, $password);

    if (count($errors) == 0) {
        $row = signIn($email, $password);
        if($row != NULL){
            $_SESSION['id'] = $row['id'];
            $id = $_SESSION['id'];
            $_SESSION['userId'] = $row['userID'];
            $_SESSION['fname'] = $row["firstname"];
            $_SESSION['lname'] = $row["lastname"];
            $_SESSION['password'] = $row["password"];
            $_SESSION['email'] = $row["email"];
            $_SESSION['imageProfileURL'] = $row['profileImageURL'];
            $_SESSION['role'] = $row['idRole'];
            $_SESSION['success'] = "You are now logged in";
            $_SESSION['isLoggedIn'] = true;

            if($row['role'] == "3"){
                $_SESSION['studentGpa'] = $row['studentGpa'];
                $_SESSION['studentStatus'] = getStudentStatus($id);
                $_SESSION['faculty'] = getFaculty($id);
                $_SESSION['courses'] = getStudentCourses($_SESSION['userId']);
            }

            if($row['role'] == "2"){
                $_SESSION['faculty'] = getFaculty($id);
                $_SESSION['teacherAcademicRank'] = getTeacherAcademicRank($id);
            }

         
            header('location: index.php');
        }
        else {
            array_push($errors, "Wrong email/password combination");
        }
    }
}


?>