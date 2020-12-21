<?php
session_start();
include_once('../../BLL/courseManager.php');

$errors = array();
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}elseif($_SESSION['role']!=1){
    header("location:index.php");
}
    $courseName = $_POST['courseName'];
    $faculty = $_POST['courseFaculty'];
    $capacity = $_POST['courseCapacity'];
    $sectionCount = $_POST['courseSection'];
    $semester = $_POST['courseSemester'];

   $form_data=validateForm($courseName, $faculty, $capacity, $sectionCount, $semester);
   if($form_data['success']==true){
       $_SESSION['courseName']=$courseName;
       $_SESSION['courseFaculty']=$faculty;
       $_SESSION['courseCapacity']=$capacity;
       $_SESSION['courseSection']=$sectionCount;
       $_SESSION['courseSemester']=$semester;
       
    }
    echo json_encode($form_data);

function validateForm($courseName, $faculty, $capacity, $sectionCount, $semester){
    $form_data = array();
     if (empty($courseName)) { 
         $form_data['success'] = false;
         $form_data['message']  = 'Course Name is required';
         return $form_data;
        }
     if (empty($capacity)) { 
         $form_data['success'] = false;
         $form_data['message']  = 'Capacity required';
         return $form_data;
        }
    else {
        if($capacity<=0){
            $form_data['success'] = false;
            $form_data['message']  = 'Capacity must be positive';
            return $form_data;
        }
    }
     if (empty($sectionCount)) { 
         $form_data['success'] = false;
         $form_data['message']  = 'Section number required';
         return $form_data;
        }
     else {
         if($sectionCount<=0) { 
             $form_data['success'] = false;
             $form_data['message']  = 'Section number must be positive';
             return $form_data;
            }
     }
     if (!isset($faculty)) { 
         $form_data['success'] = false;
         $form_data['message']  = 'Faculty required';
         return $form_data;
        }
     else {
         if($faculty != 'Engineering' && $faculty != 'Public Health' && $faculty!= 'Business' && $faculty!='Sports Science'){
            $form_data['success'] = false;
            $form_data['message']  = 'Undefined Faculty Selection';
            return $form_data;
         }
     }
     if (!isset($semester)) { 
         $form_data['success'] = false;
         $form_data['message']  = 'Semester required';
         return $form_data;
        }
     else {
        if($semester != 'Fall' && $semester != 'Spring' && $semester != 'Summer'){
            $form_data['success'] = false;
            $form_data['message']  = 'Undefined Semester Selection';
            return $form_data;
        }
     }
     $form_data['success'] = true;
     return $form_data;
 }
