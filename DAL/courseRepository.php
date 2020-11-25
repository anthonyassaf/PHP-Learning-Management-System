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
?>