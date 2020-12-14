<?php

include_once('connection.php');

$con = openCon();

function selectUser($email, $password){
    GLOBAL $con;
    if(checkPassword($email, $password)){
        $query = "SELECT * FROM `user` WHERE `email`='$email' AND `isDeleted`=0";
        $results = mysqli_query($con, $query);
        if (mysqli_num_rows($results) == 1) {
            return mysqli_fetch_assoc($results);;
        }
    }
    return NULL;
}

function checkPassword($email, $password){
    global $con;
    $query = "SELECT `password` FROM `user` WHERE `email`='$email' AND `isDeleted`=0";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        $row = mysqli_fetch_assoc($results);
        return password_verify($password, $row['password']);
    }
    return false;
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
    $query = "SELECT `class`.* FROM `class`, `studentenrollment` WHERE `studentenrollment`.idStudent= '$studentId' AND `studentenrollment`.idClass= `class`.id;";
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

function createStudent($userId, $firstname, $lastname, $studentFacultyId, $studentStatusId, $email, $password, $salt){
    GLOBAL $con;
    $firstname = mysqli_real_escape_string($con, $firstname);
    $lastname = mysqli_real_escape_string($con, $lastname);
    $studentFacultyId = implode($studentFacultyId);
    $studentStatusId = implode($studentStatusId);
    $password = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO `user`(`userID`,`idRole`,`idStudentStatus`,`idFaculty`,`email`,`password`,`firstname`,`lastname`,`salt`) VALUES('$userId','3','$studentStatusId','$studentFacultyId','$email','$password','$firstname','$lastname', $salt');";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 
}

function createTeacher($userId, $firstname, $lastname, $teacherRankId, $email, $password, $salt){
    GLOBAL $con;
    $firstname = mysqli_real_escape_string($con, $firstname);
    $lastname = mysqli_real_escape_string($con, $lastname);
    $teacherRankId = implode($teacherRankId);
    $password = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO user(`userID`,`idRole`,`idTeacherAcademicRank`,`email`,`password`,`firstname`,`lastname`,`salt`) VALUES('$userId','2','$teacherRankId','$email','$password','$firstname','$lastname','$salt');";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 

}

function updateUser($column, $value, $email, $bool){
    GLOBAL $con;
    if($bool){
        $value =  password_hash($value, PASSWORD_BCRYPT);
    }
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

function selectUserRow($userId){
    GLOBAL $con;
    $query = "SELECT * FROM `user` WHERE `userID`= '$userId' AND `isDeleted`=0";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

function selectFacultyStudents($idFaculty){
    GLOBAL $con;
    $idFaculty=implode($idFaculty);
    $query = "SELECT * FROM `user` WHERE `idFaculty`= '$idFaculty' AND `idRole`=3 AND `isDeleted`=0";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) >0) {
        $students = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($students, $row);
        }
        return $students;
    }
    return array();
}

function selectStudent($userId){
    GLOBAL $con;
    $userId=mysqli_real_escape_string($con,$userId);
    $query = "SELECT `id` FROM `user` WHERE `userID`= '$userId' AND `idRole`=3 AND`isDeleted`=0";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);
    }
    return NULL;
}

function selectTeacherCourses($teacherId){
    GLOBAL $con;
    $id = implode(selectId($teacherId));
    $query = "SELECT * FROM `class` WHERE `idTeacher`= '$id'";
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
function insertStudentFile($id, $fileUrl, $description){
    GLOBAL $con;
    $fileUrl = mysqli_real_escape_string($con, $fileUrl);
    $description = mysqli_real_escape_string($con, $description);
    $query = "INSERT INTO `studentfile`(`idStudent`, `fileUrl`, `description`) VALUES ('$id', '$fileUrl', '$description')";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return TRUE;
    }
    return FALSE; 
}
 
function selectStudentFiles($id){
    GLOBAL $con;
    $query = "SELECT * FROM `studentfile` WHERE `idStudent` = '$id'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0) {
        $files = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($files, $row);
        }
        return $files;
    }
    return array();
}
 
function deleteStudentFile($id){
    GLOBAL $con;
    $query = "DELETE FROM `studentfile` WHERE `id`='$id'";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 
}
