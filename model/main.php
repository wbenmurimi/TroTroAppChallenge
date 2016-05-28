<?php
session_start();
ob_start();

if(!isset($_REQUEST['cmd'])){
	echo '{"result": 0, "message": "Unknown command"}';
	return;
}

$cmd = $_REQUEST['cmd'];

switch ($cmd) {
	case 1:
  login();
  break;
  case 2:
  userSignUp();
  break;
  case 3:
  logout();
  break;
  case 4:

  break;
  case 5:
  resetPassword();
  break;
  case 6:
  subscribeAlert();
  break;
  case 7:
  showCustomers();
  break;
  case 8:
  addOrder();
  break;
  case 9:
  fetchOrders();
  break;
  case 10:
  fetchMyOrders();
  break;
  case 11:
  fetchItems();
  break;
  case 12:
  getOnlyOneItem();
  break;
  case 13:
  returnUserFirstName();
  break;
  default:
  echo '{"result": 0, "message": "Unknown command"}';
  return;
  break;
}


function login(){
	include "../classes/user.php";

  $myuser = new users();

  $username = $_GET['username'];
  $password = $_GET['password'];
  $myuser->Login($username, $password);
  $row=$myuser->fetch();

  if($row){
    session_destroy();
    session_start();

    $_SESSION['username'] = $username;
    $_SESSION['userId']= $row['xx_user_id'];
    $_SESSION['fname']= $row['xx_fname'];
     $_SESSION['type']= $row['xx_user_type'];
     $_SESSION['ulocation']= $row['xx_location'];
    echo '{"result": 1, "user": [';
    while($row){
      echo json_encode($row);
      $row = $myuser->fetch();
      if($row){
        echo ',';
      }
    }
    echo "]}";
    return; 
  }
  echo '{"result": 0, "message": "Wrong details! Please try again"}';
  return;

}

function userSignUp(){
  include "../classes/user.php";

  $myuser = new users();
  $fname = $_GET['fname'];
  $lname = $_GET['lname'];
  $houseno = $_GET['houseno'];
  $location = $_GET['location'];
  $username = $_GET['username'];
  $password = $_GET['password'];
  $phone = $_GET['phone'];
  $user_email = $_GET['email'];
  $usertype="Regular";
  $user_status="Enabled";

  if(!$myuser->signUp($fname,$lname,$username,$password,$user_email,$phone,$usertype,$user_status)){
    echo '{"result": 0, "message": "User not created"}';
    return;
  }
  echo '{"result": 1, "message": "Sign up was successful"}';

  return;
}

function returnUserFirstName(){
  if (  $_SESSION['fname']) {
    $loginName[] =array("person"=>$_SESSION['fname']);
    echo '{"result": 1, "uname": ';   
    echo json_encode($loginName);

    echo "}";
    return; 
  }
  else{
    echo '{"result": 0, "message": "User not logged in"}';
    return;
  }
}


function logout(){

  if(!$_SESSION['username']){
    echo '{"result": 0, "message": "The user is not loged in"}';
    return;
  }
  session_destroy();
  unset($_SESSION['userId']);
   unset($_SESSION['fname']);
    unset($_SESSION['type']);
  echo '{"result": 1, "message": "The user Loged out successfully"}';
  return;
}



function fetchOrders(){
  include "../classes/data.php";

  $data = new data();

  $row = $data->fetchOrders();
  if(!$row){
    echo '{"result": 0, "message": "You have not made any orders"}';
    return;
  }

  echo '{"result": 1, "order": [';
  while($row){
    echo json_encode($row);
    $row = $data->fetch();
    if($row){
      echo ',';
    }
  }
  echo "]}";
  return;
}

function getuserSession(){
  if(!$_SESSION["username"]){
    echo '{"result": 0, "message": "No session stored"}';
    return;  
  }
  echo '{"result": 1, "message": "'.$_SESSION["username"].'"}';

  return;

}

  

ob_end_flush();

?>