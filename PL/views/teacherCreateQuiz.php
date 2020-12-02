<?php

$errors = array(); 

function validateForm($quizTitle, $date, $startTime, $endTime, $weight, $numbOfQues){
    if (empty($quizTitle)) {
        array_push($errors, "Title is required");
    }
    if (empty($date)) {
        array_push($errors, "Date is required");
    }
    if (empty($startTime)) {
        array_push($errors, "Start Time is required");
    }
    if (empty($endTime)) {
        array_push($errors, "End Time is required");
    }
    if (empty($weight)) {
        array_push($errors, "Weight is required");
    }
    if (empty($numbOfQues)) {
        array_push($errors, "Number Of Questions is required");
    }
}

if(isset($_GET['create_quiz'])){
    $quizTitle = $_GET['quizTitle'];
    $date = $_GET['date'];
    $startTime = $_GET['startTime'];
    $endTime = $_GET['endTime'];
    $weight = $_GET['weight'];
    $numbOfQues = $_GET['numbOfQues'];

    validateForm($quizTitle, $date, $startTime, $endTime, $weight, $numbOfQues);

    createQuiz($quizTitle, $date, $startTime, $endTime, $weight, $numbOfQues);
}

?>