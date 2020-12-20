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
    $query = "SELECT id FROM `semester` WHERE semester='$semester'";
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

function selectClassStudents($classId){
    GLOBAL $con;
    $query = "SELECT user.* FROM user, studentenrollment, class WHERE user.id = studentenrollment.idStudent AND studentenrollment.idClass = class.id AND class.classNumber = '$classId'";
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

function insertClassMaterial($classId, $materialUrl, $title){
    GLOBAL $con;
    $query = "INSERT INTO `classmaterial`(`idClass`, `materialUrl`, `description`) VALUES ('$classId', '$materialUrl', '$title')";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 
}

function selectClassMaterial($classId){
    GLOBAL $con;
    $query = "SELECT * FROM `classmaterial` WHERE `idClass` = '$classId'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0 ) {
        $material = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($material, $row);
        }
        return $material;
    }
    return array();
}

function deleteClassMaterial($id){
    GLOBAL $con;
    $query = "DELETE FROM `classmaterial` WHERE `id`='$id'";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 
}

function selectTeacherClassStudents($id){
    GLOBAL $con;
    $query = "SELECT user.* FROM user, studentenrollment, class WHERE user.id = studentenrollment.idStudent AND studentenrollment.idClass = class.id AND class.id = '$id'";
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

function selectClassTeacher($classNumber){
    GLOBAL $con;
    $query = "SELECT user.* FROM `user` , `class` WHERE user.id = class.idTeacher AND  class.classNumber='$classNumber'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) ==1) {
       return mysqli_fetch_assoc($results);
    }
    return null;
}

function selectUnenrolledClassStudents($classNumber){
    GLOBAL $con;
    $query = "SELECT `user`.* 
	FROM `user`
    	WHERE `user`.idRole=3 
        	AND `user`.id NOT IN (SELECT `studentenrollment`.idStudent 
                                	FROM `studentenrollment`,`class`
                                	WHERE `studentenrollment`.idClass = `class`.id 
                                        AND `class`.classNumber='$classNumber')
            AND `user`.idFaculty = (SELECT `class`.idFaculty FROM `class` WHERE `class`.classNumber='$classNumber');";
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

?>