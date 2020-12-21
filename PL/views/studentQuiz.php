<?php
session_start();
include_once("../../BLL/quizManager.php");
if (($_SESSION['isLoggedIn']) != true) {
    $_SESSION['msg'] = "You must log in first";
    header('location: loginForm.php');
}elseif($_SESSION['role']!=3){
    header('location:index.php');
}

if (isset($_POST['submitQuizAnswers'])) {

    $questionType = array();
    $questionId = array();
    $mcq = array();
    $boolean = array();
    $text = array();
    foreach ($_POST['questionType'] as $i => $value) {
        array_push($questionType, $value);
    }
    foreach ($_POST['questionId'] as $i => $value) {
        array_push($questionId, $value);
    }
    $questionType = array_values($questionType);
    $questionId = array_values($questionId);

    if($_POST['mcqCount']>0){
        
        for($mcqPOSTCounter=1;$mcqPOSTCounter<=$_POST['mcqCount'];$mcqPOSTCounter++){
            if(isset($_POST["mcq".$mcqPOSTCounter]))
            array_push($mcq,$_POST["mcq".$mcqPOSTCounter]);
            else array_push($mcq,"");
        }
        $mcq = array_values($mcq);
    }
    if($_POST['booleanCount']>0){
      
        for($booleanPOSTCounter=1;$booleanPOSTCounter<=$_POST['booleanCount'];$booleanPOSTCounter++){
            if(isset($_POST["bool".$booleanPOSTCounter]))
            array_push($boolean,$_POST["bool".$booleanPOSTCounter]);
            else array_push($boolean,"");
        }
        $boolean = array_values($boolean);
    }
    if($_POST['textCount']>0){
       
        foreach ($_POST['text'] as $i => $value) {
            array_push($text, $value);
        }
        $text = array_values($text);
    }
    $numOfQuestions = sizeof($questionId);
    $idStudent = $_SESSION['id'];
    $idClass = $_POST['classId'];
    $idExam = $_POST['examId'];
    $questionCounter = 0;
    $mcqCounter = 0;
    $uploadCounter = 0;
    $textCounter = 0;
    $booleanCounter = 0;


    createStudentExamEntry($idExam,$idClass,$idStudent);
    for ($questionCounter; $questionCounter < $numOfQuestions; $questionCounter++) {
        $answer;
        if($questionType[$questionCounter] == '1'){ // mcq
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
        } elseif ($questionType[$questionCounter] == '4') { // upload
            $uploadCounter = $uploadCounter + 1;
            #file name with a random number so that similar dont get replaced
            if(empty($_FILES["file".$uploadCounter]["name"])){
                $answer="No Upload";
            }
            else {$answer = rand(1000, 10000) . "-" . $_FILES["file".$uploadCounter]["name"];
            #temporary file name to store file
            $tname = $_FILES["file".$uploadCounter]["tmp_name"];
            #upload directory path
            $uploads_dir = '../assets/studentsQuizUpload';
            #TO move the uploaded file to specific location
            move_uploaded_file($tname, $uploads_dir . '/' . $answer);
            }
        }

        createStudentAnswer($questionId[$questionCounter], $idExam, $idClass, $idStudent, $answer);
    }

}
?>