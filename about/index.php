<!DOCTYPE html>

<html>
<head>
  <title>Let's Ride</title>
  
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link rel="stylesheet" href="../css/materialize.css">
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="../font/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body onload="">
 <!--start of navbar-->
<div class="top-menu">
  <img src="../image/logo.jpg" width="" height="50px" width="100px">
  <span class="black-text text-darken 2 logo_name ">Let's Ride </span><span class="statement">Plan your Trip</span> 
  <div class="login-welcome welcome"> 
    <a href='../login/'><span class="text-color logout" ><i class="fa fa-user prefix"> </i> Login</span></a>
  </div>
</div>
<nav class="color mynav ">
  <div class="nav-wrapper">
    <!-- <a href="#" class="brand-logo center">Logo </a>   -->
    <!-- <img src="image/logo.jpg" width="100" height="65"> -->
    <!-- These navigation links disappear if the screen gets too small. -->
    <ul class="center hide-on-med-and-down">
      <li class="active"><a  href="../index.php">Home</i>
        <li><a href="about/index.php" onclick="">About us</a></li>

      </ul>
      <!-- Put up a "hamburger" menu when the web page gets too narrow -->
      <a href="#" data-activates="side-menu" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
      <!-- These navigation links appear when the web page gets narrow. -->
      <!-- They appear when the user clicks the hamburger menu. -->
      <ul class="side-nav" id="side-menu">
        <li class="active"><a  href="../index.php">Home</i>
          <li><a href="about/index.php" onclick="">About us</a></li>
          <li>
            <a href='../login/'><span class="text-color logout" ><i class="fa fa-user prefix"> </i> Login</span></a>
          </li>
        </ul>
      </div>
    </nav>
<!-- end of navbar-->
<!-- start of slider-->

<!-- end of slider-->

<!--  start of body division-->
<div class="">
  <div class="col l12 s12 top-search">
    <div class="row">
      <div class="card">
TEMPLATE
      </div>
    </div>
  </div>
</div>

<!--  end of body division-->
<!--  footer section-->        
 <div class="color">
   <div class=" page-footer ">

<div class="footer-copyright color ">
  <div class="container grey-text text-lighten-4">
    © 2016 Copyright 
    <span class="right"><a class="grey-text text-lighten-4 " href="#!">Accra TroTro </a> <span class="by"> By </span><span class="by"> ..... </span></span>
  </div>
</div>
</div>
</div>
<!--  end of footer section-->

<!--  Scripts-->
<script src="../js/jquery.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="j../s/script.js"></script>

<script>

 $(document).ready(function(){

  // showHomeFirstName();
   // Activate the side menu 
   $('select').material_select();
   $(".button-collapse").sideNav();
   $('.modal-trigger').leanModal();
   $(".dropdown-button").dropdown();
   $('.slider').slider({full_width: true});
   $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
   $('.dropdown-button').dropdown({
    inDuration: 300,
    outDuration: 225,
      constrain_width: true, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: false, // Displays dropdown below the button
      //alignment: 'left' // Displays dropdown with edge aligned to the left of button
    }
    );
 });
</script>
</body>
</html>