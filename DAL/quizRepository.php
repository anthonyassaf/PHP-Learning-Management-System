<?php

include_once('connection.php');

$con = openCon();

function insertQuiz($classId, $quizTitle, $startDate, $endDate, $weight, $totalGrade){
    GLOBAL $con;
    $quizTitle = mysqli_real_escape_string($con, $quizTitle);
    $startDate = mysqli_real_escape_string($con, $startDate);
    $endDate = mysqli_real_escape_string($con, $endDate);
    $weight = mysqli_real_escape_string($con, $weight);
    $totalGrade = mysqli_real_escape_string($con, $totalGrade);

    $query = "INSERT INTO `exam`(`idClass`, `quizTitle`, `weight`, `totalGrade`, `startDate`, `endDate`) VALUES ('$classId', '$quizTitle', '$weight', '$totalGrade', '$startDate', '$endDate')";
    $results = mysqli_query($con, $query);
    if ($results == 1) {
        return true;
    }
    return false; 
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
        return true;
    }
    return false; 
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
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

?>

