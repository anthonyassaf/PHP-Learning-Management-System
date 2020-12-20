<?php
session_start();
include_once("../../BLL/userManager.php");

$errors = array();
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}elseif($_SESSION['role']!=3){
    header('location:index.php');
}
if (isset($_POST["add_file"]))
 { 
    #retrieve file title
    $title = $_POST["title"];
    if(empty($title)){
        array_push($errors, "Title is required");
    }

    #file name with a random number so that similar dont get replaced
    $fileUrl = rand(1000,10000)."-".$_FILES["file"]["name"];
 
    #temporary file name to store file
    $tname = $_FILES["file"]["tmp_name"];
   
    #upload directory path
    $uploads_dir = '../assets/studentsFiles';
    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$fileUrl);
 
    $sid = $_SESSION['id'];

    if(count($errors) == 0){
        if(addStudentFile($sid, $fileUrl, $title) == NULL){
            echo '<script>alert("Error")</script>';
        }
        else{
            echo '<script>alert("Successfully Added")</script>';
        }
    }
}

if(isset($_POST["delete_file"])){
    $fileId = $_POST['fileId'];
    if(removeStudentFile($fileId) == NULL){
        echo '<script>alert("Error")</script>';
    }
    else{
        echo '<script>alert("Successfully Deleted")</script>';
    }
}

?>