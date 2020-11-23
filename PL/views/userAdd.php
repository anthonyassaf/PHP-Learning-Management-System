<?php
include_once('../../BLL/userManager.php');

$errors = array();

function validateForm($firstname, $lastname, $userType, $studentFaculty, $studentStatus, $teacherRank){
   GLOBAL $errors;
    if (empty($fname)) { array_push($errors, "First Name is required"); }
    if (empty($lname)) { array_push($errors, "Last Name is required"); }
    if (!isset($userType)) { array_push($errors, "one of the two options of the user types must be selected"); }
    else {
        if($userType=='createStudent'){
            if($studentFaculty == ''){
               array_push($errors, "one of the options of the student faculties must be selected");  
            }
            if($studentStatus == ''){
                array_push($errors, "one of the options of the student statuses must be selected");  
            }
        }
        elseif($userType=='createTeacher'){
            if($teacherRank ==''){
                array_push($errors, "one of the options of the teacher ranks must be selected");  
            }
        }
    }
}

if (isset($_POST['add_user'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $userType = $_POST['createUser'];
    $studentFaculty = $_POST['studentFaculty'];
    $studentStatus = $_POST['studentStatus'];
    $teacherRank = $_POST['teacherRank'];

    validateForm($firstname, $lastname, $userType, $studentFaculty, $studentStatus, $teacherRank);

    if(count($errors) == 0){
        signUp($firstname, $lastname, $userType, $studentFaculty, $studentStatus, $teacherRank);
    }
    
}



?>