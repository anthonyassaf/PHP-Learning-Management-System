<?php
include('../../DAL/courseRepository.php');
include_once('userManager.php');

$generatedClassNumber;

function createCourse($idTeacher,$semester,$faculty,$className,$maxCapacity,$classDay,$session,$sectionNum){
    $idFaculty = selectFacultyId($faculty);
    $idSemester = selectCourseSemester($semester);
    $idTeacher = implode(selectId($idTeacher));
    $classNumber = generateClassNumber($className,$sectionNum);
        return insertCourse($idTeacher,$idSemester,$idFaculty,$className,$classNumber,$maxCapacity,$classDay,$session);
    }

function generateClassNumber($className,$sectionNum){
    GLOBAL $generatedClassNumber; 
    if($sectionNum==1){
        $generatedClassNumber=rand(0,9999).'_1';   
    }
    else $generatedClassNumber = mb_substr($generatedClassNumber,0,-1).$sectionNum;

    return $generatedClassNumber;
}

function getCourses(){
    return selectCourses();
}

function getClassStudents($classNumber){
    return selectClassStudents($classNumber);
}

function getCourseNumberFaculty($classNumber){
    return selectCourseNumberFaculty($classNumber);
}

function assignStudentToCourse($classId,$studentId){
    return insertStudentToCourse($classId,$studentId);
}

function getClassIdFromNumber($classNumber){
    return selectClassIdFromNumber($classNumber);
}

function addClassMaterial($classId, $materialUrl, $title){
    return insertClassMaterial($classId, $materialUrl, $title);
}

function getClassMaterial($classId){
    return selectClassMaterial($classId);
}
?>