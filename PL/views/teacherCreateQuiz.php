<?php
include_once('../../BLL/quizManager.php');

$errors = array(); 
function validateForm($quizTitle, $startDate, $endDate, $weight){
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
    if (empty($weight)) {
        array_push($errors, "Weight is required");
    }
}

if(isset($_POST['create_quiz'])){
    $quizTitle = $_POST['quizTitle'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $weight = $_POST['weight'];
    $idClass = $_POST['idClass'];
    validateForm($quizTitle, $startDate, $endDate, $weight);
    if(count($errors) == 0){
       $results = createQuiz($idClass, $quizTitle, $startDate, $endDate, $weight);
       echo $idClass;
        if($results>0){
           header("location: teacherQuizQA-page.php?quizTitle=$quizTitle&exam=$results");
        }
    }

}
