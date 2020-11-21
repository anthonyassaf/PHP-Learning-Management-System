<?php

include('../../DAL/userRepository.php');

function signIn($email, $password){
    return selectUser($email, $password);
}

?>