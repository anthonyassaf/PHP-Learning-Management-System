<?php
include_once('../../BLL/quizManager.php');

$errors = array(); 
function validateForm($quizTitle, $startDate, $endDate){
    GLOBAL $errors;
    if (empty($quizTitle)) {
        array_push($errors, "Title is required");
    }
    if (empty($startDate)) {
        array_push($errors, "Start Time is required");
    }
    if (empty($endDate)) {
        array_push($errors, "End Time is required");
    }
}

if(isset($_POST['create_quiz'])){
    $quizTitle = $_POST['quizTitle'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $idClass = $_POST['idClass'];
    validateForm($quizTitle, $startDate, $endDate);
    if(count($errors) == 0){
       $results = createQuiz($idClass, $quizTitle, $startDate, $endDate);
       echo $idClass;
        if($results>0){
           header("location: teacherQuizQA-page.php?quizTitle=$quizTitle&exam=$results");
        }
    }

}
