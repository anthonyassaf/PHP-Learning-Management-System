<?php
include_once("login.php");
include_once("../../BLL/quizManager.php");
if (isset($_POST['submitQuizAnswers'])) {
    $questionType = array();
    $questionId = array();
    $mcq = array();
    $upload = array();
    $text = array();
    $boolean = array();
    foreach ($_POST['questionType'] as $i => $value) {
        array_push($questionType, $value);
    }
    foreach ($_POST['questionId'] as $i => $value) {
        array_push($questionId, $value);
    }
    for($mcqPOSTCounter=1;$mcqPOSTCounter<=$_POST['mcqCount'];$mcqPOSTCounter++){
        array_push($mcq,$_POST["mcq".$mcqPOSTCounter]);
    }
    for($booleanPOSTCounter=1;$booleanPOSTCounter<=$_POST['booleanCount'];$booleanPOSTCounter++){
        array_push($boolean,$_POST["bool".$booleanPOSTCounter]);
    }
    foreach ($_POST['text'] as $i => $value) {
        array_push($text, $value);
    }
    foreach ($_POST['file'] as $i => $value){    
        array_push($upload, $value);
    }                                                

    $questionType = array_values($questionType);
    $questionId = array_values($questionId);
    $text = array_values($text);
    $mcq = array_values($mcq);
    $boolean = array_values($boolean);
    $upload = array_values($upload);
    $numOfQuestions = sizeof($questionId);

    $idStudent = $_SESSION['id'];
    $idClass = $_POST['classId'];
    $idExam = $_POST['examId'];
    $questionCounter = 0;
    $mcqCounter = 0;
    $uploadCounter = 0;
    $textCounter = 0;
    $booleanCounter = 0;
    echo "$idExam, $idClass, $idStudent<br>";
    createStudentExamEntry($idExam,$idClass,$idStudent);
    for ($questionCounter; $questionCounter < $numOfQuestions; $questionCounter++) {
        $answer;
        if($questionType[$questionCounter] == '1'){ // mcq\
            $answer = $mcq[$mcqCounter];
            $mcqCounter=$mcqCounter+1;
        }
        elseif($questionType[$questionCounter] == '2'){ // boolean
            $answer = $boolean[$booleanCounter];
            $booleanCounter=$booleanCounter+1;
        }
        elseif($questionType[$questionCounter] =='3'){ // text
            $answer = $text[$textCounter];
            $textCounter = $textCounter + 1;
        } elseif ($questionType[$questionCounter] == '4') {  //@Assaf, upload
            #file name with a random number so that similar dont get replaced
            $answer = rand(1000, 10000) . "-" . $_FILES["file"]["name"];
            #temporary file name to store file
            $tname = $_FILES["file"]["tmp_name"];
            #upload directory path
            $uploads_dir = '../assets/studentsQuizUpload';
            #TO move the uploaded file to specific location
            move_uploaded_file($tname, $uploads_dir . '/' . $answer);
            $uploadCounter = $uploadCounter + 1;
        }
        createStudentAnswer($questionId[$questionCounter], $idExam, $idClass, $idStudent, $answer);
    }
}
?>