<?php

include('../../DAL/userRepository.php');

function signIn($email, $pass){
    $row = selectSalt($email);
    if(verifyEmail($email)){
        $salt = $row['salt'];
        $password = md5($salt.$pass.$salt);
        return selectUser($email, $password);
    }
    else{
        return NULL;
    }
}

function verifyEmail($email){
    return selectEmail($email);
}

function getStudentStatus($id){
    return selectStudentStatus($id);
}

function getFaculty($id){
    return selectFaculty($id);
}

function getStudentCourses($id){
    return selectStudentCourses($id);
}

function getTeacherAcademicRank($id){
    return selectAcademicRank($id);
}

function randomizedSalt(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+'; 
    $randomString = ''; 
  
    for ($i = 0; $i < 6; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}

function generatedUserId(){
    $generatedMin = idate("Y")*pow(10,5);
    $generatedMax  = (idate("Y")+1)*pow(10,5)-1;
    return rand($generatedMin, $generatedMax);
}

function signUp($firstname, $lastname, $userType, $studentFaculty, $studentStatus, $teacherRank){
    $userId = generatedUserId();
    $salt = randomizedSalt();
    $email = $userId.'@ua.edu.lb';
    $password = mb_substr(strtoupper($firstname),0,2).mb_substr(strtoupper($lastname),0,2).substr($userId,5,4);
    $password = md5($salt.$password.$salt);
    
    if($userType == 'createStudent'){
        $studentStatusId = getStudentStatusId($studentStatus);
        $studentFacultyId = getFacultyId($studentFaculty);
        return createStudent($userId, $firstname, $lastname, $studentFacultyId, $studentStatusId, $email, $password, $salt);
    }
    else if($userType == 'createTeacher'){
        $teacherRankId = getTeacherAcademicRankId($teacherRank);
        createTeacher($userId, $firstname, $lastname, $teacherRankId, $email, $password, $salt);
    }
}
?>