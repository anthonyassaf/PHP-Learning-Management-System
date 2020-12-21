<?php

$con = "";

function openCon(){
// Create connection
GLOBAL $con;
$con = mysqli_connect('localhost:3307', 'root', '', 'WebProg1Project');
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
return $con;
}

function closeCon(){
  GLOBAL $con;
  mysqli_close($con);
}

?>