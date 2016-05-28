<?php
session_start();
$user=$_SESSION['username']; 
if(!$_SESSION["username"]){
// if (!$user) {
 
header("location:../error/error.php");
}
//else{
//
//// echo "welcome ".$user;  
//}

?>