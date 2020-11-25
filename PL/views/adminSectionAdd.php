<?php
include_once('../../BLL/courseManager.php');
include_once('login.php');
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}

$errors = array();
if (isset($_POST['add_section'])){
    foreach ($_POST['classSection'] as $i => $value) {
        echo $value;
    }
    /*$courseName = $_SESSION['courseName'];
    $faculty = $_SESSION['courseFaculty'];
    $capacity = $_SESSION['courseCapacity'];
    $sectionCount = $_SESSION['courseSection'];
    $semester = $_SESSION['courseSemester'];
    for($i=1;$i<=$sectionCount; $i++){
        $teacher=$_POST['classTeacher'];
        $number=$_POST['classSection'];
        $day=$_POST['classDay'];
        $session=$_POST['classSession'];
        $idTeacher=validateForm($teacher,$day,$session);
        if(count($errors) == 0){
            return createCourse($idTeacher,$semester,$faculty,$courseName,$capacity,$day,$session,$i);
         }
    }*/
}

function validateForm($teacher,$day,$session){
    GLOBAL $errors;
    $teacher= splitTeacherField($teacher);
    $idTeacher= implode(array_slice($teacher,0,1));
    $firstnameTeacher = implode(array_slice($teacher,1,1));
    $lastnameTeacher = implode(array_slice($teacher,-1,1));
     if (!isset($teacher)) { array_push($errors, "Teacher required"); }
     else {
         if($firstnameTeacher != getTeacher($idTeacher)['firstname'] || $lastnameTeacher !=getTeacher($idTeacher)['firstname']){
            array_push($errors, "Undefined Teacher Selection");
         }
     }
     if (!isset($day)) { array_push($errors, "Day required"); }
     else {
        if($day != 'Monday' || $day!= 'Tuesday' || $day!= 'Wednesday' || $day!= 'Thursday' || $day!= 'Friday' || $day!= 'Saturday' || $day!= 'Sunday'){
            array_push($errors, "Undefined Day Selection");
        }
     }
     if (!isset($session)) { array_push($errors, "Session required"); }
     else {
        if($session != 'S1-S2' || $session!= 'S3-S4' || $session!= 'S5-S6'|| $session!= 'S6-S7'){
            array_push($errors, "Undefined Session Selection");
        }
        return $idTeacher;
     }
}

 function splitTeacherField($teacher){
    $teacherFields = explode(',',$teacher);
    return $teacherFields;
}
?>