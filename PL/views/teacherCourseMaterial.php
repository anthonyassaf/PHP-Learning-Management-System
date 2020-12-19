<?php

include_once("../../BLL/courseManager.php");
include_once("../../BLL/quizManager.php");

if (isset($_POST["add_material"]))
 {
     #retrieve file title
    $title = $_POST["title"];
     
    #file name with a random number so that similar dont get replaced
    $materialUrl = rand(1000,10000)."-".$_FILES["file"]["name"];
 
    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];
   
    #upload directory path
    $uploads_dir = '../assets/material';
    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$materialUrl);
 
    $cid=  $_POST['cid'];
    $cname=$_POST['cname'];
    addClassMaterial($cid, $materialUrl, $title);
    header("location: teacherCourseMaterial-page.php?classId=$cid&className=$cname");

}

if(isset($_POST["delete"])){
    $materialId = $_POST['materialId'];
    removeClassMaterial($materialId);
    $cid=  $_POST['cid'];
    $cname=$_POST['cname'];
    header("location: teacherCourseMaterial-page.php?classId=$cid&className=$cname");
}

?>
