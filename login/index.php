<!DOCTYPE html>
<html>
<head>
  <title> let's Ride Login</title>
  <link rel="stylesheet" href="../css/materialize.min.css">
  <!-- <link rel="stylesheet" href="../css/materialize.css"> -->
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="../font/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
  <!--start of navbar-->
  <div class="top-menu">
    <img src="../image/logo.jpg" width="" height="50px" width="100px">
    <span class="black-text text-darken 2 logo_name ">Let's Ride </span><span class="statement">Plan your Trip</span> 
    <div class="login-welcome welcome"> 
      <!-- <a href='login/'><span class="text-color logout" ><i class="fa fa-user prefix"> </i> Login</span></a> -->
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
          <li class="active"><a  href="index.php">Home</i>
            <li><a href="about/index.php" onclick="">About us</a></li>
            <li>
              <a href='login/'><span class="text-color logout" ><i class="fa fa-user prefix"> </i> Login</span></a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="mybreadcrumb col s12 l12">

      </div>
      <!-- end of navbar-->
      <!--Start of body area-->

      <div class="">
        <div class="row">
          <div class="login_div" id="login_div">

            <div class="col l6 m8 offset-m2 offset-l3">
              <div class="row">
                <div class="col l12">
                  <div class=" white">
                    <ul class="tabs color">
                      <li class="tab col s3"><a class="active text-color"  href="#login">Login</a></li>
                      <li class="tab col s3"><a href="#signup">Sign up</a></li>
                    </ul>

                    <div id="login" class="col s12 textcontainer ">
                      <div class="login_error_area center" id="login_error_area">

                      </div>
                      <div class="input-field col s12">
                        <i class="fa fa-user prefix"></i>
                        <input id="login_username" type="text" class="validate" autocomplete="off">
                        <label for="login_username">Username</label>
                      </div>
                      <div class="input-field col s12 mypass">
                        <i class="fa fa-key prefix"></i>
                        <input id="login_password" type="password" class="validate" autocomplete="off">
                        <label for="login_password">Password</label>
                      </div>
                      <div class="left">
                        <a href="#" onclick="hide('login_div','verification_code_div'); show('reset_pass_div')">
                          <span class="forget-pass" >Forgot password</span></a>
                        </div>
                        <div class="loginfooter right">
                          <button onclick="Login()" type="submit" class=" btn btn-spacer waves-effect wave-dark loginbtn btnColor center-align">Log In</button>

                        </div>
                      </div>
                      <div id="signup" class="col s12 textcontainer">
                        <div class="serror_area center" id="serror_area">
                        </div>

                        <div class="input-field col s12">
                          <i class="fa fa-user prefix"></i>
                          <input id="fname" type="text" class="validate" autocomplete="off">
                          <label for="fname">First name</label>
                        </div>
                        <div class="input-field col s12">
                          <i class="fa fa-user prefix"></i>
                          <input id="lname" type="text" class="validate" autocomplete="off">
                          <label for="lname">Last name</label>
                        </div>

                        <div class="input-field col s12">
                          <i class="fa fa-user prefix"></i>
                          <input id="username" type="text" class="validate" autocomplete="off">
                          <label for="username">Username</label>
                        </div>
                        <div class="input-field col s12">
                          <i class="fa fa-envelope prefix"></i>
                          <input id="email" type="email" class="validate" autocomplete="off">
                          <label for="email">Email</label>
                        </div>
                        <div class="input-field col s12">
                          <i class="fa fa-phone prefix"></i>
                          <input id="phone" type="tel" class="validate" autocomplete="off">
                          <label for="phone">Phone</label>
                        </div>

                        <div class="input-field col s12 mypass">
                          <i class="fa fa-key prefix"></i>
                          <input id="password" type="password" class="validate" autocomplete="off">
                          <label for="password">Password</label>
                        </div>
                        <div class="input-field col s12 mypass">
                          <i class="fa fa-key prefix"></i>
                          <input id="confirm_password" type="password" class="validate" autocomplete="off">
                          <label for="confirm_password">Confirm Password</label>
                        </div>
                        <div class="loginfooter right">
                          <button onclick="addUser()" type="submit" class="btn btn-spacer waves-effect btnColor center-align">Sign Up</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>  

          </div>
        </div> 

        <!--end of body area-->
        <!--  footer section-->  
        <div class="footer-copyright color ">
          <div class="container grey-text text-lighten-4">
            © 2016 Copyright 
            <span class="right"><a class="grey-text text-lighten-4 " href="#!">Accra TroTro </a> <span class="by"> By </span><span class="by"> ..... </span></span>
          </div>
        </div>
        <!--  end of footer section-->

        <!--  Scripts-->
        <script src="../js/jquery.js"></script>
        <script src="../js/materialize.min.js"></script>
        <script src="../js/script.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            $(".button-collapse").sideNav();
            $('select').material_select();
            hide("reset_pass_div","verification_code_div");
            $('.datepicker').pickadate({
selectMonths: true, // Creates a dropdown to control month
selectYears: 15 // Creates a dropdown of 15 years to control year
})
          });
        </script>
      </body>
      </html>