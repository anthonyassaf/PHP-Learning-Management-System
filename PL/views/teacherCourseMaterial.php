<?php

include_once("../../BLL/courseManager.php");

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
    addClassMaterial($cid, $materialUrl, $title);

}

?>
