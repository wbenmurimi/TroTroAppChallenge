
<?php require "../model/check.php";?>
<!DOCTYPE html>

<html>
<head>
  <title>City Laundry</title>
  
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link rel="stylesheet" href="../css/materialize.css">
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="../font/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">

</head>
<body onload="">
 <!--start of navbar-->
 <?php 
 if(isset($_SESSION["username"])){
   if($_SESSION["username"]){
     if($_SESSION["type"]=="Regular"){
       header("location:../my-orders/index.php");
     }
     if($_SESSION["type"]=="Admin"){
       include "../header/admin-login.html";
     }
     else{
     include "../header/header-login.html";
  }
}
   
}
else if(!$_SESSION["username"]){
    include "../header/header.html";
  }


?>
<!-- end of navbar-->
<!--  start of body division-->
<div class="mybreadcrumb col s12 l12">

</div>
<!--  start of body division-->
<div class="card ">
  <div class="row">
    <div class=" listAlertsDiv" id="listAlertsDiv">
      <table id="jsontable" class="striped" cellspacing="0" width="" >
        <thead>
          <tr >
            <th>First Name</th>
            <th>Last Name</th>
            <th>Location</th>
            <th>House </th>
            <th>Phone </th>
            <th>Type </th>
            <th>Created</th>
            <th>Status</th>
          </tr>
        </thead>
        
        <tfoot>
             <tr >
            <th>First Name</th>
            <th>Last Name</th>
            <th>Location</th>
            <th>House </th>
            <th>Phone </th>
            <th>Type </th>
            <th>Created</th>
            <th>Status</th>
          </tr>
        </tfoot>
      </table>
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
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/script.js"></script>


<script>

 $(document).ready(function(){
 // loadCounty();
 showFirstName();
showCustomers();
   // Activate the side menu 
   $(".button-collapse").sideNav();
$('.modal-trigger').leanModal();
$(".dropdown-button").dropdown();
  // hide("listAlertsDiv");
  // $('#jsontable').DataTable( {
  //   responsive: true
  // } );
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
});

</script>
</body>
</html>