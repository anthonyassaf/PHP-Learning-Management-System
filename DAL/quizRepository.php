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

?>

