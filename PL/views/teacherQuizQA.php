<?php
/*
function validateForm($title, $grade, $createQuestion)
{
    global $errors;
    if (empty($title)) {
        array_push($errors, "First Name is required");
    }
    if (empty($grade)) {
        array_push($errors, "Last Name is required");
    }
    if (!isset($createQuestion)) {
        array_push($errors, "one of the four options of the question types must be selected");
    } else {
        if ($createQuestion == 'createStudent') {
            if ($studentFaculty == '') {
                array_push($errors, "one of the options of the student faculties must be selected");
            }
            if ($studentStatus == '') {
                array_push($errors, "one of the options of the student statuses must be selected");
            }
        } elseif ($createQuestion == 'createTeacher') {
            if ($teacherRank == '') {
                array_push($errors, "one of the options of the teacher ranks must be selected");
            }
        }
    }
}
*/

if (isset($_POST['add_question'])){
    $title = $_POST['title'];
    $grade = $_POST['grade'];
    $createQuestion = $_POST['createQuestion'];

    //validateForm($title, $grade, $createQuestion);

    //createQuestion();
}



?>