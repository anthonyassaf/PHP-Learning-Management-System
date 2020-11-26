<?php

include_once('connection.php');

$con = openCon();

function selectUser($email, $password){
    GLOBAL $con;
    $query = "SELECT * FROM `user` WHERE `email`='$email' AND `password`= '$password' AND `isDeleted`=0";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function selectId($idUser){
    GLOBAL $con;
    $query = "SELECT `id` FROM `user` WHERE `userID`= '$idUser' AND `isDeleted`=0";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}
function selectSalt($email){
    GLOBAL $con;
    $query = "SELECT `salt` FROM `user` WHERE `email`='$email'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function selectEmail($email){
    GLOBAL $con;
    $query = "SELECT `email` FROM `user` WHERE `email`='$email'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return true;
    }
    return false;
} 

function selectStudentStatus($id){
    GLOBAL $con;
    $query = "SELECT `studentStatus` FROM `studentStatus` WHERE `id`='$id'";
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

function selectAcademicRank($id){
    GLOBAL $con;
    $query = "SELECT `academicrank` FROM `academicrank` WHERE `id`='$id'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function selectStudentCourses($studentId){
    GLOBAL $con;
    $query = "SELECT `class`.* FROM `class`, `studentenrolment` WHERE `studentenrolment`.idStudent= '$studentId' AND `studentenrolment`.idClass= `class`.id;";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0 ) {
        $courses = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($courses, $row);
        }
        return $courses;
    }
    return array();
}

function selectStudentStatusId($statusName){
    GLOBAL $con;
    $statusName =mysqli_real_escape_string($con,$statusName);
    $query = "SELECT id FROM `studentStatus` WHERE `studentStatus`='$statusName'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function selectFacultyId($facultyName){
    GLOBAL $con;
    $facultyName =mysqli_real_escape_string($con,$facultyName);
    $query = "SELECT id FROM `faculty` WHERE `facultyName`='$facultyName'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function selectTeacherAcademicRankId($rankName){
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
    $firstname = mysqli_real_escape_string($con,$firstname);
    $lastname = mysqli_real_escape_string($con,$lastname);
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

function updateUser($column, $value, $email){
    GLOBAL $con;
    $query = "UPDATE `user` SET `$column`= '$value' WHERE `email`='$email'";
    $results = mysqli_query($con, $query);
    if($results){
        return true;
    }
    else {
        return false;
    }
}

function selectTeachers(){
    GLOBAL $con;
    $query = "SELECT * FROM `user` WHERE `idRole`='2' AND `isDeleted`=0";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0 ) {
        $teachers = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($teachers, $row);
        }
        return $teachers;
    }
    return array();
}

function selectTeacher($id){
    GLOBAL $con;
    $query = "SELECT * FROM `user` WHERE `idRole`='2' AND `id`= '$id' AND `isDeleted`=0";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

?>