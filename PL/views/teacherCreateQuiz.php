<?php
include_once('../../BLL/quizManager.php');
include_once('teacherCreateQuiz-page.php');

$errors = array(); 

function validateForm($quizTitle, $startDate, $endDate, $weight, $totalGrade, $numbOfQues){
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
    if (empty($totalGrade)) {
        array_push($errors, "Total Grade is required");
    }
    if (empty($numbOfQues)) {
        array_push($errors, "Number Of Questions is required");
    }
}

if(isset($_POST['create_quiz'])){
    $quizTitle = $_POST['quizTitle'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $weight = $_POST['weight'];
    $totalGrade = $_POST['totalGrade'];
    $numbOfQues = $_POST['numbOfQues'];

    validateForm($quizTitle, $startDate, $endDate, $weight, $totalGrade, $numbOfQues);

    if(count($errors) == 0){
       $results = createQuiz($classId, $quizTitle, $startDate, $endDate, $weight, $totalGrade);
        if($results){
           header("location: teacherQuizQA-page.php?quizTitle=$quizTitle&date=$date&startDate=$startDate&endDate=$endDate&weight=$weight&numbOfQues=$numbOfQues");
        }
    }

}
