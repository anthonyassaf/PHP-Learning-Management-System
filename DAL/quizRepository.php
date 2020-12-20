<?php

include_once('connection.php');

$con = openCon();

function insertQuiz($classId, $quizTitle, $startDate, $endDate){
    GLOBAL $con;
    $quizTitle = mysqli_real_escape_string($con, $quizTitle);
    $startDate = mysqli_real_escape_string($con, $startDate);
    $endDate = mysqli_real_escape_string($con, $endDate);
    $query = "INSERT INTO `exam`(`idClass`, `quizTitle`, `startDate`, `endDate`) VALUES ('$classId', '$quizTitle', '$startDate', '$endDate')";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return mysqli_insert_id($con);
    }
    return -1; 
}

function insertQuestion($examId, $question, $grade, $idType){
    GLOBAL $con;
    $examId = mysqli_real_escape_string($con, $examId);
    $question = mysqli_real_escape_string($con, $question);
    $grade = mysqli_real_escape_string($con, $grade);
    $idType = mysqli_real_escape_string($con, $idType);
 
    $query = "INSERT INTO `question`(`idExam`, `idType`, `description`, `grade`) VALUES ('$examId', '$idType', '$question', '$grade')";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return mysqli_insert_id($con);
    }
    return -1; 
}

function insertAnswer($idQuestion,$isCorrect,$answer){
    GLOBAL $con;
    $idQuestion = mysqli_real_escape_string($con, $idQuestion);
    $isCorrect = mysqli_real_escape_string($con, $isCorrect);
    $answer = mysqli_real_escape_string($con, $answer);
    $query = "INSERT INTO `answer`(`idQuestion`, `isCorrect`, `description`) VALUES ('$idQuestion', '$isCorrect', '$answer')";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return mysqli_insert_id($con);
    }
    return -1; 
}

function selectClassExams($classId){
    GLOBAL $con;
    $query = "SELECT * FROM `exam` WHERE `idClass`='$classId'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) >0) {
        $exams = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($exams, $row);
        }
        return $exams;
    }
    return array();
}

function selectExam($examId){
    GLOBAL $con;
    $query = "SELECT * FROM `exam` WHERE `id`='$examId'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);
    }
    return NULL;
}

function selectQuestionTypeId($type){
    GLOBAL $con;
    $query = "SELECT * FROM `questiontype` WHERE `type`='$type'";
    $results = mysqli_query($con,$query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);
    }
    return NULL;
}

function selectExamQuestions($examId){
    GLOBAL $con;
    $query = "SELECT * FROM `question` WHERE `idExam`='$examId'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0) {
        $questions = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($questions, $row);
        }
        return $questions;
    }
    return array();
}

function selectQuestionAnswers($questionId){
    GLOBAL $con;
    $query = "SELECT * FROM `answer` WHERE `idQuestion`='$questionId'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0) {
        $answers = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($answers, $row);
        }
        return $answers;
    }
    return array();
}



function insertStudentAnswer($idQuestion,$idExam,$idClass,$idStudent,$answer){
    GLOBAL $con;
    $idQuestion = mysqli_real_escape_string($con, $idQuestion);
    $idExam = mysqli_real_escape_string($con, $idExam);
    $idClass = mysqli_real_escape_string($con, $idClass);
    $idStudent = mysqli_real_escape_string($con, $idStudent);
    $answer = mysqli_real_escape_string($con, $answer);
    $query="INSERT INTO studentanswer(`idQuestion`,`idExam`,`idClassEnrolled`,`idStudentEnrolled`,`answer`) VALUES('$idQuestion','$idExam','$idClass','$idStudent','$answer')";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 
}

function insertStudentExamEntry($idExam,$idClass,$idStudent){
    GLOBAL $con;
    $idExam = mysqli_real_escape_string($con, $idExam);
    $idClass = mysqli_real_escape_string($con, $idClass);
    $idStudent = mysqli_real_escape_string($con, $idStudent);
    $query="INSERT INTO studentenrolledExam(`idExam`,`idClassEnrolled`,`idStudentEnrolled`) VALUES('$idExam','$idClass','$idStudent')";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 
}

function selectStudentExamEntry($idExam,$idClass,$idStudent){
    GLOBAL $con;
    $idExam = mysqli_real_escape_string($con, $idExam);
    $idClass = mysqli_real_escape_string($con, $idClass);
    $idStudent = mysqli_real_escape_string($con, $idStudent);
    $query="SELECT * from studentenrolledexam where idExam='$idExam' AND idClassEnrolled='$idClass' AND idStudentEnrolled='$idStudent' ";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return true;
    }
    return false; 
}

function selectSystemDate(){
    GLOBAL $con;
    $query="SELECT NOW() AS CurrentDate";
    $results = mysqli_query($con,$query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);
    }
    return NULL;
}

function selectExamEntries($idExam){
    GLOBAL $con;
    $query = "SELECT * FROM `studentenrolledexam` WHERE `idExam`='$idExam'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0) {
        $examEntries = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($examEntries, $row);
        }
        return $examEntries;
    }
    return array();

}

function selectStudentAnswers($idExam,$idClass,$idStudent){
    GLOBAL $con;
    $query = "SELECT * FROM `studentanswer` WHERE `idExam`='$idExam' AND `idStudentEnrolled`='$idStudent' AND `idClassEnrolled`='$idClass'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0) {
        $studentAnswers = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($studentAnswers, $row);
        }
        return $studentAnswers;
    }
    return array();
}

function selectStudentEnrolledExam($id){
    GLOBAL $con;
    $query = "SELECT * FROM `studentenrolledexam` WHERE `id`='$id'";
    $results = mysqli_query($con,$query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);
    }
    return NULL;
}

function selectQuestion($id){
    GLOBAL $con;
    $query = "SELECT * FROM `question` WHERE `id`='$id'";
    $results = mysqli_query($con,$query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);
    }
    return NULL;
}

function selectStudentAnswer($id){
    GLOBAL $con;
    $query="SELECT * FROM `studentanswer` where `id`='$id'";
    $results = mysqli_query($con,$query);
    if(mysqli_num_rows($results) == 1){
        return mysqli_fetch_assoc($results);
    }
    return NULL;
}

function selectCorrectAnswer($idQuestion){
    GLOBAL $con;
    $query="SELECT * FROM `answer` where `idQuestion`='$idQuestion' AND `isCorrect`='1'";
    $results = mysqli_query($con,$query);
    if(mysqli_num_rows($results) == 1){
        return mysqli_fetch_assoc($results);
    }
    return NULL;
}

function  updateAnswer($id,$grade){
    GLOBAL $con;
    $query = "UPDATE `studentanswer` SET `grade`='$grade' WHERE `id`='$id'";
    $results = mysqli_query($con, $query);
    if($results){
        return true;
    }
    else {
        return false;
    }
}

function updateQuiz($idStudentExam){
    GLOBAL $con;
    $examInformation = selectStudentEnrolledExam($idStudentExam);
    $idClass=$examInformation['idClassEnrolled'];
    $idExam=$examInformation['idExam'];
    $idStudent=$examInformation['idStudentEnrolled'];
    $query= "UPDATE `studentenrolledexam` SET `isCorrected` = 1,`grade` = (SELECT SUM(`grade`) FROM `studentanswer` WHERE `idExam`=$idExam AND `idStudentEnrolled`=$idStudent AND `idClassEnrolled`=$idClass) where `id` = $idStudentExam";
    $results = mysqli_query($con, $query);
    if($results){
        return true;
    }
    else {
        return false;
    }
}
function selectStudentExamInfo($idExam,$idClass,$idStudent){
    GLOBAL $con;
    $idExam = mysqli_real_escape_string($con, $idExam);
    $idClass = mysqli_real_escape_string($con, $idClass);
    $idStudent = mysqli_real_escape_string($con, $idStudent);
    $query="SELECT * from studentenrolledexam where idExam='$idExam' AND idClassEnrolled='$idClass' AND idStudentEnrolled='$idStudent' ";
    $results = mysqli_query($con, $query);
    if(mysqli_num_rows($results) == 1){
        return mysqli_fetch_assoc($results);
    }
    return NULL;
}

function updateExamGrade($idExam,$grade){
    GLOBAL $con;
    $query="UPDATE `exam` SET `totalGrade`=`totalGrade`+'$grade' WHERE `id`='$idExam'";
    $results = mysqli_query($con, $query);
    if($results){
        return true;
    }
    else {
        return false;
    }
}
?>