<?php

include_once('../../DAL/quizRepository.php');


function createQuiz($classId, $quizTitle, $startDate, $endDate, $weight){
    $startDate = date("Y-m-d H:i:s", strtotime($startDate));
    $endDate = date("Y-m-d H:i:s", strtotime($endDate));
    return insertQuiz($classId, $quizTitle, $startDate, $endDate, $weight);
}

function getClassExams($classId){
    return selectClassExams($classId);
}

function getExamDetails($examId){
    return selectExam($examId);
}
function createAnswer($idQuestion,$isCorrect,$answer) {
    return insertAnswer($idQuestion,$isCorrect,$answer);
}

function createQuestion($idExam,$type,$grade,$description){
    $typeRow=selectQuestionTypeId($type);
    return insertQuestion($idExam,$description,$grade,$typeRow['id']);
}
?>