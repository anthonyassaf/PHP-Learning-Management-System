<?php
session_start();
include_once('../../BLL/userManager.php');
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}elseif($_SESSION['role']!=1){
    header("location:index.php");
}
    $form_data = array();
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $userType = $_POST['createUser'];
    $studentFaculty = $_POST['studentFaculty'];
    $studentStatus = $_POST['studentStatus'];
    $teacherRank = $_POST['teacherRank'];
    
    $form_data = validateForm($firstname,$lastname,$userType,$studentFaculty,$studentStatus,$teacherRank);
    if($form_data['success']==true){
    $result=addUser($firstname, $lastname, $userType, $studentFaculty, $studentStatus, $teacherRank);
        if($result){
            $form_data['success'] = true;
            $form_data['message']  = 'Successful addition of user.';
        }
        else {
            $form_data['success'] = false;
            $form_data['message']  = 'Error adding a user.';
        }
    }

    echo json_encode($form_data);
    
    function validateForm($firstname, $lastname, $userType, $studentFaculty, $studentStatus, $teacherRank)
{
    $form_data = array();
    if (empty($firstname)) {
       
        $form_data['success'] = false;
        $form_data['message']  = 'First name cannot be blank';
        return $form_data;
    }
    if (empty($lastname)) {
        $form_data['success'] = false;
        $form_data['message']  = 'Last name cannot be blank';
        return $form_data;
    }
    if (!isset($userType)) {
        $form_data['success'] = false;
        $form_data['message']  = 'one of the two options of the user types must be selected';
        return $form_data;
    } else {
        if ($userType == 'createStudent') {
            if ($studentFaculty == '') {
                $form_data['success'] = false;
                $form_data['message']  = 'one of the options of the student faculties must be selected';
                return $form_data;
            }
            if ($studentStatus == '') {
                $form_data['success'] = false;
                $form_data['message']  = 'one of the options of the student statuses must be selected';
                return $form_data;
            }
        } elseif ($userType == 'createTeacher') {
            if ($teacherRank == '') {
                $form_data['success'] = false;
                $form_data['message']  = 'one of the options of the teacher ranks must be selected';
                return $form_data;
            }
        }
    }
    $form_data['success'] = true;
    return $form_data;
}
?>
