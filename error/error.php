<!DOCTYPE html>

<html>
<head>
  <title>City Laundry</title>
  
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link rel="stylesheet" href="../css/materialize.css">
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/bread.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="../font/css/font-awesome.min.css">
  <link rel="stylesheet" href="../plugin/countrycode/build/css/intlTelInput.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body onload="">
 <!--start of navbar-->
 <?php include "../header/header.html";?>
 <div class="mybreadcrumb col s12 l12">
  </div>
</div>
<!-- end of navbar-->
<!--  start of body division-->
<div class="template-container">
  <div class="row">
    <div class="col m12 s12 card">
      <h3 class="center">Please Login to continue with this task</h3> <hr>
      <h4 class="center">Cick <a href="../login/">here</a> to go to the login page </h4>
    </div>
  </div>
</div>
<!--  end of body division-->
<!--  footer section-->        
<?php include "../footer/footer.html";?>
<!--  end of footer section-->

<!--  Scripts-->
<script src="../js/jquery.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/script.js"></script>
<script src="../plugin/countrycode/build/js/intlTelInput.js"></script>

<script>

 $(document).ready(function(){
   // Activate the side menu 
   $(".button-collapse").sideNav();
   $('select').material_select();
   $('.modal-trigger').leanModal();
   $(".dropdown-button").dropdown();

 });

</script>
</body>
</html>