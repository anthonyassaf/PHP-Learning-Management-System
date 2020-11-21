<?php

include('connection.php');

function selectUser($email, $password){
    $con = openCon();
    $query = "SELECT * FROM `student` WHERE `email`='$email' AND `password`= '$password'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
        return mysqli_fetch_assoc($results);;
    }
    return NULL;
}

?>