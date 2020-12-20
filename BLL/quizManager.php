<?php

include_once('../../DAL/quizRepository.php');


function createQuiz($classId, $quizTitle, $startDate, $endDate){
    $startDate = date("Y-m-d H:i:s", strtotime($startDate));
    $endDate = date("Y-m-d H:i:s", strtotime($endDate));
    return insertQuiz($classId, $quizTitle, $startDate, $endDate);
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
function getExamQuestions($examId){
    return selectExamQuestions($examId);
}

function getQuestionAnswers($questionId){
    return selectQuestionAnswers($questionId);
}

function createStudentAnswer($idQuestion,$idExam,$idClass,$idStudent,$answer){
    return insertStudentAnswer($idQuestion,$idExam,$idClass,$idStudent,$answer);
}

function createStudentExamEntry($idExam,$idClass,$idStudent){
    return insertStudentExamEntry($idExam,$idClass,$idStudent);
}

function getSystemDate(){
    return strtotime(selectSystemDate()["CurrentDate"]);
}

function getStudentExamEntry($idExam,$idClass,$idStudent){
   return selectStudentExamEntry($idExam,$idClass,$idStudent);
}

function getExamEntries($idExam){
    return selectExamEntries($idExam);
}

function getStudentAnswers($idExam,$idClass,$idStudent){
    return selectStudentAnswers($idExam,$idClass,$idStudent);
}

function getExamEntryDetails($id){
    return selectStudentEnrolledExam($id);
}

function getQuestion($id){
    return selectQuestion($id);
}

function getStudentAnswer($id){
    return selectStudentAnswer($id);
}
function getCorrectAnswer($idQuestion){
    return selectCorrectAnswer($idQuestion);
 }
 
function correctAnswer($idStudentAnswer,$grade){
    return updateAnswer($idStudentAnswer,$grade);
}
function autoCorrectAnswer($id){
    $studentAnswer = getStudentAnswer($id);
    $question = getQuestion($studentAnswer['idQuestion']);
    $correctAnswer = getCorrectAnswer($question['id']);
    if($correctAnswer['description'] == $studentAnswer['answer']){
        correctAnswer($studentAnswer['id'],$question['grade']);
    }
    else {
        correctAnswer($studentAnswer['id'],0);
    }
}

function correctQuiz($idStudentExam){
    return updateQuiz($idStudentExam);
}

function getStudentExamInfo($idExam,$idClass,$idStudent){
    return selectStudentExamInfo($idExam,$idClass,$idStudent);
}

function updateExam($idExam,$grade){
    return updateExamGrade($idExam,$grade);
}
?>