<?php
session_start();
include_once('../../BLL/userManager.php');
$errors = array();
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}elseif($_SESSION['role']!=1){
    header("location:index.php");
}

function validateForm($firstname, $lastname, $userType, $studentFaculty, $studentStatus, $teacherRank)
{
    global $errors;
    if (empty($firstname)) {
        array_push($errors, "First Name is required");
    }
    if (empty($lastname)) {
        array_push($errors, "Last Name is required");
    }
    if (!isset($userType)) {
        array_push($errors, "one of the two options of the user types must be selected");
    } else {
        if ($userType == 'createStudent') {
            if ($studentFaculty == '') {
                array_push($errors, "one of the options of the student faculties must be selected");
            }
            if ($studentStatus == '') {
                array_push($errors, "one of the options of the student statuses must be selected");
            }
        } elseif ($userType == 'createTeacher') {
            if ($teacherRank == '') {
                array_push($errors, "one of the options of the teacher ranks must be selected");
            }
        }
    }
}

if (isset($_POST['add_user'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $userType = $_POST['createUser'];
    $studentFaculty = $_POST['studentFaculty'];
    $studentStatus = $_POST['studentStatus'];
    $teacherRank = $_POST['teacherRank'];

    validateForm($firstname, $lastname, $userType, $studentFaculty, $studentStatus, $teacherRank);

    if (count($errors) == 0) {
        if(addUser($firstname, $lastname, $userType, $studentFaculty, $studentStatus, $teacherRank)){
        echo '<script type="text/javascript"> alert("User successfully added")</script>';
        }
        else  {echo '<script type="text/javascript"> alert("Failure")</script>';
        }
    }
}
