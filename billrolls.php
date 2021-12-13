<?php 
include('database_connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<title>Home Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
 <link href="css/style.css" rel="stylesheet">

<link href='https://fonts.googleapis.com/css?family=Amiri' rel='stylesheet'>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
   
<style>
h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
ul {
  text-align: left;
  font-family: 'Amiri'	
}
h2 {
  text-align: left;
  font-family: 'Sofia'	
}
h1 {
  font-family: 'Sofia'	
}
h5 {
  font-family: 'Amiri'	
}

</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-indigo w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large  w3-hover-white"><i class="fa fa-user w3-margin-right w3-hover-white"></i>UserName</a>
	<div class="w3-right w3-hide-small">
	<a href="homepage.html" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
  <!---
	<p>This is another example paragraph.</p>
   <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Inventory</a>
--->
   
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-button" title="Notifications">Inventory <i class="fa fa-caret-down"></i></button>     
      <div class="w3-dropdown-content w3-card-4 w3-bar-block">
        <a href="billrolls.html" class="w3-bar-item w3-button">Billrolls</a>
        <a href="printers.html" class="w3-bar-item w3-button">Printers</a>
        <a href="#" class="w3-bar-item w3-button">Others</a>
      </div>
    </div>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Print Preview</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Feedback</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large w3-hover-white"><i class="fa fa-sign-out w3-margin-right"></i>Logout</a>

  </div> </div>

 

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <button class="w3-button" title="Notifications">Inventory <i class="fa fa-caret-down"></i></button>     
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
	<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 5</a>
  </div>
</div>



<div class="row">
  <br />
  <br>
  <br>
  <!-- <h2 align="center">Run 'N' Gun</h2> -->
  <br>
  <br>
  <br>
  <br>
  
  
  
          
         
  <div class="col-md-9">
      <br />
      <div class="row filter_data">

      </div>
  </div>
</div>

</div>
<style>
#loading
{
text-align:center; 
background: url('loader.gif') no-repeat center; 
height: 150px;
}
</style>

<script>


$(document).ready(function(){

filter_data();

function showAlert() {
  alert("Message");
}

function filter_data()
{
  $('.filter_data').html('<div id="loading" style="" ></div>');
  var action = 'fetch_data';
  var minimum_price = $('#hidden_minimum_price').val();
  var maximum_price = $('#hidden_maximum_price').val();
  var gsm = get_filter('gsm');
  var material = get_filter('material');
  var length= get_filter('length');
  

  $.ajax({
      url:"billrolls_fetch_data.php",
      method:"POST",
      data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, gsm:gsm, material:material, length:length},
      success:function(data){
          $('.filter_data').html(data);
      }
  });
}

function get_filter(class_name)
{
  var filter = [];
  $('.'+class_name+':checked').each(function(){
      filter.push($(this).val());
  });
  return filter;
}

$('.common_selector').click(function(){
  filter_data();
});


$('#price_range').slider({
  range:true,
  min:5000,
  max:150000,
  values:[10, 150000],
  step:500,
  stop:function(event, ui)
  {
      $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
      $('#hidden_minimum_price').val(ui.values[0]);
      $('#hidden_maximum_price').val(ui.values[1]);
      filter_data();
  }
});

});
</script>

</body>

</html>