<?php
include_once('../../BLL/quizManager.php');

$errors = array();

function validateForm($description, $grade, $questionType)
{
    global $errors;
    if (empty($description)) {
        array_push($errors, "Question title required");
    }
    if (empty($grade)) {
        array_push($errors, "Grade required");
    }
    if (!isset($questionType)) {
        array_push($errors, "one of the four options of the question types must be selected");
    } else {
        if ($questionType != 'MCQ' && $questionType != 'Upload' && $questionType != 'Text' && $questionType != 'True/False') {
            array_push($errors, "undefined question type");
        }
    }
}

function validateChoice($correct)
{
    global $errors;
    if (!isset($correct)) {
        array_push($errors, "You must choose a correct answer");
    }
}

function validateAnswers(array $answers)
{
    global $errors;
    for ($i = 0; $i < count($answers); $i++) {
        if (empty($answers[$i])) {
            array_push($errors,  "Answer " + ($i + 1) + " is empty, please fill it");
        }
    }
}
function validateTrueFalse($bool)
{
    global $errors;
    if (!isset($bool)) {
        array_push($errors, "one of the two options of the true false answer types must be selected");
    } else {
        if ($bool != 'true' && $bool != 'false') {
            array_push($errors, "undefined true false answer");
        }
    }
}

function addQuestion($number)
{
    global $errors;
    $idExam = $_POST['idExam'];
    $quizTitle = $_GET['quizTitle'];
    $description = $_POST['description'];
    $grade = $_POST['grade'];
    $questionType = $_POST['questionType'];
    validateForm($description, $grade, $questionType);
    if (count($errors) == 0) {
        if ($questionType == 'Text' || $questionType == 'Upload') {
            createQuestion($idExam, $questionType, $grade, $description);
        }
        elseif ($questionType == 'True/False') {
            $bool = $_POST['bool'];
            validateTrueFalse($bool);
            if (count($errors) == 0) {
                $idQuestion = createQuestion($idExam, $questionType, $grade, $description);
                if ($bool == 'true') {
                    echo "test";
                    createAnswer($idQuestion, 1, 'true');
                    createAnswer($idQuestion, 0, 'false');
                } else {
                    echo "false test";
                    createAnswer($idQuestion, 1, 'false');
                    createAnswer($idQuestion, 0, 'true');
                }
            }
        }
        elseif ($questionType == 'MCQ') {
            $correctAns = $_POST['isTrue'];
            validateChoice($correctAns);
            if (count($errors) == 0) {
                $idQuestion = createQuestion($idExam, $questionType, $grade, $description);
                $answers = array();
                foreach ($_POST['answer'] as $i => $value) {
                    array_push($answers, $value);
                }
                $answers = array_values($answers);
                validateAnswers($answers);
                if (count($errors) == 0) {
                    for ($i = 0; $i < count($answers); $i++) {
                        if ($i == $correctAns) {
                            createAnswer($idQuestion, 1, $answers[$i]);
                        } else {
                            createAnswer($idQuestion, 0, $answers[$i]);
                        }
                    }
                }
            }
        }
    }
    if (count($errors) == 0) {
        updateExam($idExam,$grade);
        if ($number == 1)
            header('location: teacherDashboard-page.php');
        if ($number == 2)
            header("locationteacherQuizQA-page.php?quizTitle=$quizTitle&exam=$idExam");
    }
}
if (isset($_POST['finishAddQuestion'])) {
    addQuestion(1);
}

if (isset($_POST['addQuestion'])) {
    addQuestion(2);
}
