<?php
include_once('../../BLL/quizManager.php');
$errors = array();
function validateForm($question, $grade, $createQuestion)
{​​​​​​​
    global $errors;
    if (empty($question)) {​​​​​​​
        array_push($errors, "First Name is required");
    }​​​​​​​
    if (empty($grade)) {​​​​​​​
        array_push($errors, "Last Name is required");
    }​​​​​​​
    if (!isset($createQuestion)) {​​​​​​​
        array_push($errors, "one of the four options of the question types must be selected");
    }​​​​​​​ else {​​​​​​​
        if ($createQuestion == 'mcq') {​​​​​​​
        }​​​​​​​ 
        elseif ($createQuestion == 'upload') {​​​​​​​
           
        }​​​​​​​
        elseif ($createQuestion == 'text'){​​​​​​​
        }​​​​​​​
        elseif ($createQuestion == 'trueFalse'){​​​​​​​
        }​​​​​​​
    }​​​​​​​
}​​​​​​​
if (isset($_POST['add_question'])){​​​​​​​
    $question = $_POST['question'];
    $grade = $_POST['grade'];
    $createQuestion = $_POST['createQuestion'];
    validateForm($question, $grade, $createQuestion);
    //addQuestion(14, $question, $grade, $createQuestion);
}​​​​​​​


?>