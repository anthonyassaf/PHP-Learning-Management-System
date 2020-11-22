<?php

include('../../DAL/userRepository.php');

function signIn($email, $pass){
    $row = selectSalt($email);
    $salt = $row['salt'];
    $password = md5($salt.$pass.$salt);
    return selectUser($email, $password);
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

?>