<?php
session_start();
include_once('../../BLL/userManager.php');

if (isset($_POST["update_pp"])) {
    $email = $_POST['email'];
	 #file name with a random number so that similar dont get replaced
     $ppUrl = rand(1000,10000)."-".$_FILES["file"]["name"];

     #temporary file name to store file
     $tname = $_FILES["file"]["tmp_name"];
    
     #upload directory path
     $uploads_dir = '../assets/images/users';
     #TO move the uploaded file to specific location
     move_uploaded_file($tname, $uploads_dir.'/'.$ppUrl);

     $result = edit('profileImageURL', $ppUrl, $email);
     $_SESSION['ppURL'] = $ppUrl;
    header('location: studentProfile-page.php');
}
