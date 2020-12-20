<?php
include_once('../../BLL/courseManager.php');

$errors = array();
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}elseif($_SESSION['Role']!=1){
    header("location:index.php");
}

if (isset($_POST['add_course'])){
    $courseName = $_POST['courseName'];
    $faculty = $_POST['courseFaculty'];
    $capacity = $_POST['courseCapacity'];
    $sectionCount = $_POST['courseSection'];
    $semester = $_POST['courseSemester'];

    validateForm($courseName, $faculty, $capacity, $sectionCount, $semester);
    if(count($errors) == 0){
       $_SESSION['courseName']=$courseName;
       $_SESSION['courseFaculty']=$faculty;
       $_SESSION['courseCapacity']=$capacity;
       $_SESSION['courseSection']=$sectionCount;
       $_SESSION['courseSemester']=$semester;
       header('location: adminSectionAdd-page.php');
    }
    
}

function validateForm($courseName, $faculty, $capacity, $sectionCount, $semester){
    GLOBAL $errors;
     if (empty($courseName)) { array_push($errors, "Course Name is required"); }
     if (empty($capacity)) { array_push($errors, "Capacity required"); }
     if (empty($sectionCount)) { array_push($errors, "Section number required"); }
     else {
         if($sectionCount<=0) { array_push($errors,"Section number must be positive"); }
     }
     if (!isset($faculty)) { array_push($errors, "Faculty required"); }
     else {
         if($faculty != 'Engineering' && $faculty != 'Public Health' && $faculty!= 'Business' && $faculty!='Sports Science'){
            array_push($errors, "Undefined Faculty Selection");
         }
     }
     if (!isset($semester)) { array_push($errors, "Semester required"); }
     else {
        if($semester != 'Fall' && $semester != 'Spring' && $semester != 'Summer'){
            array_push($errors, "Undefined Semester Selection");
        }
     }
 }
