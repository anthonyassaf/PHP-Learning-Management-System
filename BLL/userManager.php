<?php

include('../../DAL/userRepository.php');

function signIn($email, $pass){
    $row = getSalt($email);
    if(verifyEmail($email)){
        $salt = $row['salt'];
        $password = md5($salt.$pass.$salt);
        return selectUser($email, $password);
    }
    else{
        return NULL;
    }
}

function addUser($firstname, $lastname, $userType, $studentFaculty, $studentStatus, $teacherRank){
    $userId = generatedUserId();
    $salt = randomizedSalt();
    $email = $userId.'@ua.edu.lb';
    $password = mb_substr(strtoupper($firstname),0,2).mb_substr(strtoupper($lastname),0,2).substr($userId,5,4);
    $password = md5($salt.$password.$salt);
    if($userType == 'createStudent'){
        $studentStatusId = selectStudentStatusId($studentStatus);
        $studentFacultyId = selectFacultyId($studentFaculty);
        return createStudent($userId, $firstname, $lastname, $studentFacultyId, $studentStatusId, $email, $password, $salt);
    }
    else if($userType == 'createTeacher'){
        $teacherRankId = selectTeacherAcademicRankId($teacherRank);
        return createTeacher($userId, $firstname, $lastname, $teacherRankId, $email, $password, $salt);
    }
}

function getSalt($email){
    return selectSalt($email);
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

function getStudentCourses($userId){
    return selectStudentCourses($userId);
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

function edit($column, $x, $email){
    if($column == "password"){
        $row = getSalt($email);
        $salt = $row['salt'];
        $password = md5($salt.$x.$salt);
        return updateUser($column, $password, $email, true);
    }
    else {
        return updateUser($column, $x, $email, false);
    }
}

function getTeachers(){
    return selectTeachers();
}

function getTeacher($id){
    return selectTeacher($id);
}

function getUserRow($userId){
    return selectUserRow($userId);
}

function getCourseFacultyStudents($classNumber){
    return selectFacultyStudents(getCourseNumberFaculty($classNumber));
}

function checkName($userId){
    $row = getUserRow($userId);
    $name = $row['firstname'].','.$row['lastname'];
    return $name;
}

function getStudent($userId){
    return selectStudent($userId);
}

function getTeacherCourses($userId){
    return selectTeacherCourses($userId);
}
function addStudentFile($id, $fileUrl, $description){
    return insertStudentFile($id, $fileUrl, $description);
}
 
function getStudentFiles($id){
    return selectStudentFiles($id);
}
 
function removeStudentFile($fileId){
    return deleteStudentFile($fileId);
}

function getStudentInformation($id){
    return selectStudentInformation($id);
}


