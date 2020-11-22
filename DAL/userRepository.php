<?php

include('connection.php');

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
    $query = "SELECT `class`.* FROM `class`, `studentenrolment` WHERE `studentenrolment`.idStudent= '201720145' AND `studentenrolment`.idClass= `class`.id;";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0 ) {
        $courses = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($courses, $row);
        }
        return $courses;
    }
    return NULL ;
}

?>