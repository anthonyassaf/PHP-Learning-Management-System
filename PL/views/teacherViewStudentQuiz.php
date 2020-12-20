<?php
include_once("../../BLL/quizManager.php");
$errors = array();

function validateForm($maxGrade,$grade){
    global $errors;
    if(empty($grade)){
        array_push($errors, "You did not set a grade");
    }elseif($grade<0){
        array_push($errors, "You cannot set a negative grade");
    }elseif($grade>$maxGrade){
        array_push($errors, "You cannot set a grade over the maximum grade");
    }
}

if(isset($_POST["SubmitAnswerCorrection"])){
$correctedAnswers = $_POST['numCorrectableAnswers'];
$quizId = $_POST['quizId'];
$studentQuizid=$_POST['idStudentQuiz'];
if($correctedAnswers>0){
    $idStudentAnswers = array();
    $maxGrades = array();
    $grades= array();
    foreach ($_POST['studentAnswerId'] as $i => $value) {
        array_push($idStudentAnswers, $value);
    }
    
    foreach ($_POST['maxGrade'] as $i => $value) {
        array_push($maxGrades, $value);
    }
   
    foreach ($_POST['grade'] as $i => $value) {
        array_push($grades, $value);
    }
    $idStudentAnswers = array_values($idStudentAnswers);
    $maxGrades = array_values($maxGrades);
    $grades = array_values($grades);

    for($i =0;$i<$correctedAnswers;$i++){
        validateForm($maxGrades[$i],$grades[$i]);
    }
    if(count($errors)==0){
        for($i =0;$i<$correctedAnswers;$i++){
            updateAnswer($idStudentAnswers[$i],$grades[$i]);
        }
        if(correctQuiz($studentQuizid)){
        header("location:teacherListQuizEntries-page.php?quizId=$quizId");
        }
        else {array_push($errors,"Error updating");}
    }
}else header("location:teacherListQuizEntries-page.php?quizId=$quizId");
}










?>