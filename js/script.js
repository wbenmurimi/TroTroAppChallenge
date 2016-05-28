
var myurl = "http://10.249.226.168/TroTroAppChallenge/model/main.php?";
var urlHome = "model/main.php?";
function sendRequest(u) {
    // Send request to server
    var obj = $.ajax({url: u, async: false});
    //Convert the JSON string to object
    var result = $.parseJSON(obj.responseText);
    return result;	//return object
  }

  function hide(){

    for (var i = 0; i < arguments.length; i++) {

      var input = arguments[i];
        $('#'+input).addClass('hide'); //jquery way
      }
    }

    function show(){

      for (var i = 0; i < arguments.length; i++) {

        var input = arguments[i];
        $('#'+input).removeClass('hide');
        $('#'+input).show();
      }
    }



    function Login(){
      /*username*/
      var user_name = $("#login_username").val();
      /*password*/
      var pass_word = $("#login_password").val();

      /* empty username */
      if(user_name.length == 0){
        document.getElementById("error_area").innerHTML = '<div class="chip red white-text">Empty username<i class="material-icons">close</i></div>';
        return
      }
      /*password*/
      if(pass_word.length == 0){
        document.getEl

        ementById("error_area").innerHTML = '<div class="chip red white-text">Empty password<i class="material-icons">close</i></div>';
        return;
      }

      var strUrl = myurl+"cmd=1&username="+user_name+"&password="+pass_word;
      // prompt("url",strUrl);
      var objResult = sendRequest(strUrl);
      var errorArea = document.getElementById("login_error_area");
      document.getElementById("login_error_area").innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
      if(objResult.result == 0) {
        document.getElementById("login_error_area").innerHTML = '<div class="chip red white-text">'+objResult.message+'<i class="material-icons">close</i></div>';
        return;
      }
      var my_user_type=objResult.user[0].xx_user_type;
  // alert(my_user_type);

  if (my_user_type.localeCompare("Admin")==0) {
    window.location.href ="../about/bus.html"
  }
  else if (my_user_type.localeCompare("Regular")==0) {
    window.location.href = "../about/bus.html";
  }

}

function getUser(){
  var strUrl = myurl+"cmd=5";
  var objResult = sendRequest(strUrl);

  if(objResult.result == 0){
    alert(objResult.message);
    return;
  }
  document.getElementById("username").innerHTML=objResult.message;
}

function addUser(){

 /*first name*/
 var f_name = $("#fname").val();
 /*Last name*/
 var l_name = $("#lname").val();
 /*password*/
 var password = $("#password").val();
 /*password2*/
 var password2 = $("#confirm_password").val();
 /*username*/
 var user_name = $("#username").val();
 /*email*/
 var email = $("#email").val();
 /*phone*/
 var phone = $("#phone").val();

 if(f_name.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty First name field<i class="material-icons">close</i></i></div>';
  return
}
if(l_name.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty last name field<i class="material-icons">close</i></i></div>';
  return
}

/* empty username */
if(user_name.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty Username field<i class="material-icons">close</i></i></div>';
  return
}
/* empty password */
if(password.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty password field<i class="material-icons">close</i></div>';
  return;
}
/* empty confirm password */
if(password2.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty confirm password field<i class="material-icons">close</i></div>';
  return;
}
/* different password */
if(password!=password2){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">The entered passwords do not match<i class="material-icons">close</i></div>';
  return;
}
/* empty phone */
if(phone.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty Phone Field<i class="material-icons">close</i></div>';
  return;
}
var strUrl = myurl+"cmd=2&fname="+f_name+"&lname="+l_name+"&username="+
user_name+"&password="+password+"&email="+email+"&phone="+phone;
// prompt("url",strUrl);
var objResult = sendRequest(strUrl);
var errorArea = document.getElementById("serror_area");
document.getElementById("serror_area").innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
if(objResult.result == 0) {
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">'+objResult.message+'<i class="material-icons">close</i></div>';
  return;
}
else{
  window.location.href="index.html";
}
}

function sendVerificationCode(){
  var send_option = document.getElementsByName("reset"); 
  var user_email ;
  var user_phone;
  var strUrl;
  if (send_option[0].checked == true) {
    /*email*/
    user_email = $("#reset_email").val();
    if(user_email.length == 0){
      document.getElementById("error_div_reset").innerHTML = '<div class="chip red white-text">Please provide email<i class="material-icons">close</i></div>';
      return
    }
    strUrl = myurl+"cmd=4&email="+user_email;
  }
  /*phone*/
  if (send_option[1].checked == true) {
   user_phone= $("#reset_phone").val();
   if(user_phone.length == 0){
    document.getElementById("error_div_reset").innerHTML = '<div class="chip red white-text">Please provide phone number<i class="material-icons">close</i></div>';
    return;
  }
  strUrl = myurl+"cmd=4&phone="+user_phone;
}
/* email */
prompt("url",strUrl);
var objResult = sendRequest(strUrl);
if(objResult.result == 0) {
  document.getElementById("error_div_reset").innerHTML = '<div class="chip red white-text">'+objResult.message+'<i class="material-icons">close</i></div>';
  return;
}
alert(objResult.message); 
$("#reset_email").val("");
$("#reset_phone").val("");
}


function showFirstName(){

  var strUrl = myurl+"cmd=13";
 // prompt("url", strUrl);
 var objResult = sendRequest(strUrl);

 if(objResult.result == 0){
  alert(objResult.message);
  return;
}
$("#LoggedUser").text(objResult.uname[0].person);
}
function showHomeFirstName(){

  var strUrl = urlHome+"cmd=13";
 // prompt("url", strUrl);
 var objResult = sendRequest(strUrl);

 if(objResult.result == 0){
  alert(objResult.message);
  return;
}
$("#LoggedUser").text(objResult.uname[0].person);
}

  function logout(){
   var strUrl = myurl+"cmd=3";
 // prompt("url",strUrl);
 var objResult = sendRequest(strUrl);

 if(objResult.result == 0){
  alert(objResult.message);
  return;
}
alert(objResult.message);
window.location.href = "../index.php";

}
function logout_Home(){
 var strUrl = myurl+"cmd=3";
 // prompt("url",strUrl);
 var objResult = sendRequest(strUrl);

 if(objResult.result == 0){
  alert(objResult.message);
  return;
}
alert(objResult.message);
window.location.href = "index.php";

}




// Implementing data functionality


function showPrices(){

  var strUrl = myurl+"cmd=4";
  // prompt("url", strUrl);
  var objResult = sendRequest(strUrl);

  if(objResult.result == 0){
    alert(objResult.message);
    return;
  }

  var mytable=$('#jsontable').dataTable();
  mytable.fnClearTable();
  for(i=1;i<objResult.data.length;i++){

    var station = objResult.data[i].route_long_name.split("to");
       var from = station[0];
     var to = station[station.length-1];
    mytable.fnAddData([ from, to, objResult.data[i].Price]);
  }
}



function showStops(){

  var strUrl = myurl+"cmd=5";
  // prompt("url", strUrl);
  var objResult = sendRequest(strUrl);

  if(objResult.result == 0){
    alert(objResult.message);
    return;
  }

  for(i=1;i<objResult.stops.length;i++){

     objResult.stops[i].stop_name;
     objResult.stops[i].stop_lat;
     objResult.stops[i].stop_lon;
  }
}


function showBuses(){

  var strUrl = myurl+"cmd=6";
  // prompt("url", strUrl);
  var objResult = sendRequest(strUrl);

  if(objResult.result == 0){
    alert(objResult.message);
    return;
  }

  var mytable=$('#jsontable').dataTable();
  mytable.fnClearTable();
  for(i=1;i<objResult.bus.length;i++){
   
    mytable.fnAddData([ objResult.bus[i].b_id, objResult.bus[i].bus_number,objResult.bus[i].agency_name, objResult.bus[i].driver_name]);
  }
}

function addBus(){



 var did = $("#did").val();

 var aid = $("#aid").val();
 
 var bid = $("#bid").val();
 var deviceId = $("#deviceId").val();

 if(did.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty Driver Id field<i class="material-icons">close</i></i></div>';
  return
}
if(bid.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty Bus Id field<i class="material-icons">close</i></i></div>';
  return
}

if(aid.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty Agency Id field<i class="material-icons">close</i></i></div>';
  return
}
    
if(deviceId.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty Agency Id field<i class="material-icons">close</i></i></div>';
  return
}

var strUrl = myurl+"cmd=7&did="+did+"&bid="+bid+"&aid="+aid+"&device_id="+deviceId;
// prompt("url",strUrl);
var objResult = sendRequest(strUrl);
var errorArea = document.getElementById("serror_area");
document.getElementById("serror_area").innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
if(objResult.result == 0) {
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">'+objResult.message+'<i class="material-icons">close</i></div>';
  return;
}
else{
   $("#did").val("");

 $("#aid").val("");
 
 $("#bid").val("");
}
}


function showDrivers(){

  var strUrl = myurl+"cmd=8";
  // prompt("url", strUrl);
  var objResult = sendRequest(strUrl);

  if(objResult.result == 0){
    alert(objResult.message);
    return;
  }

  var mytable=$('#jsontable').dataTable();
  mytable.fnClearTable();
  for(i=1;i<objResult.driver.length;i++){
   
    mytable.fnAddData([ objResult.driver[i].driver_id, objResult.driver[i].driver_name,objResult.driver[i].driver_email, objResult.driver[i].driver_phone]);
  }
}

function addDriver(){


 var dn = $("#dn").val();

 var de = $("#de").val();
 
 var dp = $("#dp").val();

 if(dn.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty Driver Name field<i class="material-icons">close</i></i></div>';
  return
}


if(dp.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty Agency Driver Phone field<i class="material-icons">close</i></i></div>';
  return
}

var strUrl = myurl+"cmd=9&dn="+dn+"&de="+de+"&dp="+dp;
prompt("url",strUrl);
var objResult = sendRequest(strUrl);
var errorArea = document.getElementById("serror_area");
document.getElementById("serror_area").innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
if(objResult.result == 0) {
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">'+objResult.message+'<i class="material-icons">close</i></div>';
  return;
}
else{
   $("#dn").val("");

 $("#de").val("");
 
 $("#dp").val("");
}
}

    /**
    *function to addTraffic
    */
    
function addTraffic(){


 var desc = $("#desc").val();

 var lev = document.getElementById("level");
 var level = lev.options[lev.selectedIndex].value;;

 if(desc.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty Description field<i class="material-icons">close</i></i></div>';
  return
}


if(level.length == 0){
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">Empty Level field<i class="material-icons">close</i></i></div>';
  return
}

var strUrl = urlHome+"cmd=10&desc="+desc+"&lev="+level;
prompt("url",strUrl);
var objResult = sendRequest(strUrl);
var errorArea = document.getElementById("serror_area");
document.getElementById("serror_area").innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
if(objResult.result == 0) {
  document.getElementById("serror_area").innerHTML = '<div class="chip red white-text">'+objResult.message+'<i class="material-icons">close</i></div>';
  return;
}
else{
   $("#desc").val("");
}

}













