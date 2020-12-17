<?php

include_once('connection.php');

$con = openCon();

function insertQuiz($classId, $quizTitle, $startDate, $endDate, $weight){
    GLOBAL $con;
    $quizTitle = mysqli_real_escape_string($con, $quizTitle);
    $startDate = mysqli_real_escape_string($con, $startDate);
    $endDate = mysqli_real_escape_string($con, $endDate);
    $weight = mysqli_real_escape_string($con, $weight);
    $query = "INSERT INTO `exam`(`idClass`, `quizTitle`, `weight`, `startDate`, `endDate`) VALUES ('$classId', '$quizTitle', '$weight', '$startDate', '$endDate')";
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
        return mysqli_fetch_assoc($results);;
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

function selectQuizsByClass($classId){
    GLOBAL $con;
    $query = "SELECT exam.* FROM exam WHERE exam.idClass ='$classId'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) > 0 ) {
        $quizs = array();
        while($row = mysqli_fetch_assoc($results)){ // loop to store the data in an associative array.
            array_push($quizs, $row);
        }
        return $quizs;
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
    $query="INSERT INTO studentanswer(`idQuestion`,`idExam`,`idClass`,`idStudent`,`answer`) VALUES('$idQuestion','$idExam','$idClass','$idStudent','$answer')";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 
}


?>

