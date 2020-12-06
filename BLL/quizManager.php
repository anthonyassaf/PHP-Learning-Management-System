<?php

include_once('../../DAL/quizRepository.php');


function createQuiz($classId, $quizTitle, $startDate, $endDate, $weight, $totalGrade){
    $startDate = date("Y-m-d H:i:s", strtotime($startDate));
    $endDate = date("Y-m-d H:i:s", strtotime($endDate));
    return insertQuiz($classId, $quizTitle, $startDate, $endDate, $weight, $totalGrade);
}

function addQuestion($examId, $question, $grade, $type){
    $idType = 3;
    return insertQuestion($examId, $question, $grade, $idType);
}

function getClassExams($classId){
    return selectClassExams($classId);
}

function getExamDetails($examId){
    return selectExam($examId);
}

function getExamQuestions($examId){
    return selectExamQuestions($examId);
}

function getQuestionAnswers($questionId){
    return selectQuestionAnswers($questionId);
}

?>