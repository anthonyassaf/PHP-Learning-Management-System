<?php

include_once('../../DAL/quizRepository.php');


function createQuiz($classId, $quizTitle, $startDate, $endDate, $weight, $totalGrade){
    $startDate = date("Y-m-d H:i:s", strtotime($startDate));
    $endDate = date("Y-m-d H:i:s", strtotime($endDate));
    return insertQuiz($classId, $quizTitle, $startDate, $endDate, $weight, $totalGrade);
}

?>