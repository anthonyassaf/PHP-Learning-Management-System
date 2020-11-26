<?php
include_once('connection.php');

function insertCourse($idTeacher,$idSemester,$idFaculty,$className,$classNumber,$maxCapacity,$classDay,$session){
    GLOBAL $con;
    $idSemester=implode($idSemester);
    $idFaculty=implode($idFaculty);
    $className = mysqli_real_escape_string($con,$className);
    $query = "INSERT INTO `class`(`idTeacher`,`idSemester`,`idFaculty`,`className`,`classNumber`,`maxCapacity`,`classDay`,`session`) VALUES('$idTeacher','$idSemester','$idFaculty','$className','$classNumber','$maxCapacity','$classDay','$session');";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 
}

function selectCourseSemester($semester){
    GLOBAL $con;
    $semester = mysqli_real_escape_string($con,$semester);
    $query = "Select id From `semester` where semester='$semester'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);
    }
    return Null; 
}

function selectCourses(){
    GLOBAL $con;
    $query = "SELECT * FROM `class`";
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

function selectClassStudents($classNumber){
    GLOBAL $con;
    $query = "SELECT user.* FROM user, studentenrollment, class WHERE user.id = studentenrollment.idStudent AND studentenrollment.idClass = class.id AND class.classNumber = '$classNumber'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0 ) {
        $students = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($students, $row);
        }
        return $students;
    }
    return array();
}

function selectCourseNumberFaculty($classNumber){
    GLOBAL $con;
    $classNumber = mysqli_real_escape_string($con,$classNumber);
    $query = "SELECT idFaculty FROM `class` where classNumber='$classNumber'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) ==1) {
       return mysqli_fetch_assoc($results);
    }
    return null;
}

function selectClassIdFromNumber($classNumber){
    GLOBAL $con;
    $classNumber = mysqli_real_escape_string($con,$classNumber);
    $query = "SELECT `id` FROM `class` where classNumber='$classNumber'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) ==1) {
       return mysqli_fetch_assoc($results);
    }
    return null;
}

function insertStudentToCourse($classId,$studentId){
    GLOBAL $con;
    $classId= implode($classId);
    $classId = mysqli_real_escape_string($con,$classId);
    $studentId = implode($studentId);
    $studentId = mysqli_real_escape_string($con,$studentId);
    $query = "INSERT INTO `studentenrollment`(`idClass`,`idStudent`) values($classId,$studentId);";
    $results = mysqli_query($con,$query);
    if ($results == 1) :
        return true;
    endif;
    return false;
}
?>