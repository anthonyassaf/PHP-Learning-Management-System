<?php
include_once("../../BLL/quizManager.php");
if (isset($_POST['submitQuizAnswers'])) {
    $questionType = array();
    $questionId = array();
    $mcq = array();
    $upload = array();
    $text = array();
    $boolean = array();

    $questionCounter = 0;
    $mcqCounter = 0;
    $uploadCounter = 0;
    $textCounter = 0;
    $booleanCounter = 0;

    foreach ($_POST['questionType'] as $i => $value) {
        array_push($questionType, $value);
    }
    foreach ($_POST['questionId'] as $i => $value) {
        array_push($questionId, $value);
    }
    foreach ($_POST['mcq'] as $i => $value) {
        array_push($mcq, $value);
    }
    foreach ($_POST['text'] as $i => $value) {
        array_push($text, $value);
    }
    foreach ($_POST['bool'] as $i => $value) {
        array_push($boolean, $value);
    }
    // foreach ($_POST['mcq'] as $i => $value){    
    //     array_push($mcq, $value);
    // }                                                @Assaf, fetch the file array

    $questionType = array_values($questionType);
    $questionId = array_values($questionId);
    $text = array_values($text);
    $mcq = array_values($mcq);
    $boolean = array_values($boolean);
    // $upload = array_values($upload)     @Assaf, uncomment when done
    
    $numOfQuestions = sizeof($questionId);

    $idStudent = $_SESSION['id'];
    $idClass = $_POST['classId'];
    $idExam = $_POST['examId'];
    
    for ($questionCounter; $questionCounter < $numOfQuestions; $questionCounter++) {
        $answer;
        if($questionType[$questionCounter] == '1'){ // mcq\
            $answer = $mcq[$mcqcounter];
            $mcqCounter=$mcqCounter+1;
        }
        elseif($questionType[$questionCounter] == '2'){ // boolean
            $answer = $boolean[$booleancounter];
            $booleanCounter=$booleanCounter+1;
        }
        elseif($questionType[$questionCounter] =='3'){ // text
            $answer = $text[$textCounter];
            $textCounter = $textCounter+1;
        }
        // elseif($questionType[$questionCounter]) =='4'){  @Assaf, upload
        //     $answer = $upload[$uploadCounter];
        //    $uploadCounter = $uploadCounter+1;
        //}
        createStudentAnswer($questionId[$i],$idClass,$idExam,$idStudent,$answer);
    }
}
