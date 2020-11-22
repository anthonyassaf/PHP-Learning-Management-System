<?php
include('../../BLL/userManager.php');

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$userType = $_POST['createUser'];
$studentFaculty = $_POST['studentFaculty'];
$studentStatus = $_POST['studentStatus'];
$teacherRank = $_POST['teacherRank'];
if(validateFields($firstname,$lastname,$userType,$studentFaculty,$studentStatus,$teacherRank)) :
    return signUp($firstname,$lastname,$userType,$studentFaculty,$studentStatus,$teacherRank);
endif;

function validateFields($firstname,$lastname,$userType,$studentFaculty,$studentStatus,$teacherRank) {
    $valid = true;
    if($firstname==null){   
        echo '<script type="text/javascript"> alert("firstname is empty")</script>';
        $valid=false;
    } 
    if($lastname == null){
        echo '<script type="text/javascript"> alert("lastname is empty")</script>';
        $valid=false;
    }
    
    if(!isset($userType)){
        echo '<script type="text/javascript"> alert("one of the two options of the user types must be selected")</script>';
        $valid=false;
    }
    else {
        if($userType=='createStudent'){
            if($studentFaculty == ''){
                echo '<script type="text/javascript"> alert("one of the options of the student faculties must be selected")</script>';
                $valid=false;
            }
            if($studentStatus == ''){
                echo '<script type="text/javascript"> alert("one of the options of the student statuses must be selected")</script>';
                $valid=false;
            }
        }
        elseif($userType=='createTeacher'){
            if($teacherRank ==''){
                echo '<script type="text/javascript"> alert("one of the options of the teacher ranks must be selected")</script>';
                $valid=false;
            }
        }
    }
    return $valid;
}





?>