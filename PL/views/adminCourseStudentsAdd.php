<?php
include_once('../../BLL/courseManager.php');
include_once('login.php');

$errors = array();
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}

if(isset($_POST['assign_Students'])){
    $studentsID= array();
    $studentsName = array();
    $studentsChecked = array();
    foreach ($_POST['userId'] as $i => $value) {
        array_push($studentsID, $value);
    }
    foreach ($_POST['userName'] as $i => $value) {
        array_push($studentsName, $value);
    }
    foreach ($_POST['addStudentCheckbox'] as $i => $value){    
        array_push($studentsChecked, $value);
    }
    $numOfStudents = sizeof($studentsID);
    $studentsID=array_values($studentsID);
    $studentsName=array_values($studentsName);
    $studentsChecked=array_values($studentsChecked);
    for($i=0;$i<$numOfStudents;$i++){
        if($studentsChecked[$i] ==1){
            validation($studentsID[$i],$studentsName[$i]);
            if(count($errors)==0) {
                echo implode(getClassIdFromNumber($_GET['classNumber']))." ".implode(getStudent($studentsID[$i]));
                assignStudentToCourse(getClassIdFromNumber($_GET['classNumber']),getStudent($studentsID[$i]));
            }
        }
    }
}

function validation($studentId,$studentName){
    GLOBAL $errors;
    if ($studentName != checkName($studentId)) { 
        array_push($errors, "Undefined Student of ID: '$studentId' selected"); 
    }
}
