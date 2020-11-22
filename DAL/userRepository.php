<?php

include('connection.php');

$con = openCon();

function selectUser($email, $password){
    GLOBAL $con;
    $query = "SELECT * FROM `user` WHERE `email`='$email' AND `password`= '$password' AND `isDeleted` = 0";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function selectSalt($email){
    GLOBAL $con;
    $query = "SELECT salt FROM `user` WHERE `email`='$email'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function selectStudentStatus($id){
    GLOBAL $con;
    $query = "SELECT studentStatus FROM `studentStatus` WHERE `id`='$id'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function selectFaculty($id){
    GLOBAL $con;
    $query = "SELECT `facultyName` FROM `faculty` WHERE `id`='$id'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function selectStudentCourses($studentId){
    GLOBAL $con;
    $query = "SELECT * FROM `studentEnrolment` WHERE `id`='$idStudent'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0) {
        $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
        return $row;
    }
    return NULL;
}

function getStudentStatusId($statusName){
    GLOBAL $con;
    $statusName =mysqli_real_escape_string($con,$statusName);
    $query = "SELECT id FROM `studentStatus` WHERE `studentStatus`='$statusName'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function getFacultyId($facultyName){
    GLOBAL $con;
    $facultyName =mysqli_real_escape_string($con,$facultyName);
    $query = "SELECT id FROM `faculty` WHERE `facultyName`='$facultyName'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function getTeacherAcademicRankId($rankName){
    GLOBAL $con;
    $rankName =mysqli_real_escape_string($con,$rankName);
    $query = "SELECT id FROM `AcademicRank` WHERE `academicRank`='$rankName'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function createStudent($userId,$firstname,$lastname,$studentFacultyId,$studentStatusId,$email,$password,$salt){
    GLOBAL $con;
    $firstname =mysqli_real_escape_string($con,$firstname);
    $lastname =mysqli_real_escape_string($con,$lastname);
    $studentFacultyId = implode($studentFacultyId);
    $studentStatusId = implode($studentStatusId);
    $query = "INSERT INTO `user`(`userID`,`idRole`,`idStudentStatus`,`idFaculty`,`email`,`password`,`firstname`,`lastname`,`profileImageURL`,`salt`) VALUES('$userId','3','$studentStatusId','$studentFacultyId','$email','$password','$firstname','$lastname','1','$salt');";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 
}

function createTeacher($userId,$firstname,$lastname,$teacherRankId,$email,$password,$salt){
    GLOBAL $con;
    $firstname =mysqli_real_escape_string($con,$firstname);
    $lastname =mysqli_real_escape_string($con,$lastname);
    $teacherRankId=implode($teacherRankId);
    $query = "INSERT INTO user(`userID`,`idRole`,`idTeacherAcademicRank`,`email`,`password`,`firstname`,`lastname`,`profileImageURL`,`salt`) VALUES('$userId','2','$teacherRankId','$email','$password','$firstname','$lastname','1','$salt');";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 

}

?>