<?php

require "../Controllers/RouteGenerator.php";
require "../Controllers/HandleConfiguration.php";
use App\Controllers\RouteGenerator;
use App\Controllers\HandleConfiguration;
RouteGenerator::check_user();
$handler = new HandleConfiguration();
$data = json_decode($handler->fetch_data());
$message = null;
if(!empty($_GET['message'])){
 $message = '<div class="alert alert-success" style="margin:30px 0;">' . $_GET['message'] . '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>View Rooms</title>
<meta name="description" content="">    
<?php require "inc/admin-meta.php";?>

<style>
    
div.step{
 
position: relative;
left: 80%;
top: -50px;
width: 20%;
padding: 10px 20px;
margin: 0 0 30px 0;
background-color: #2e86c1;
color: #FFFFFF;
text-align: center;
}

div.page-cont{

margin-bottom: 30px;    
padding: 20px 50px;
border: solid 1px #ccd1d1;
border-radius: 3px;
}

h1.page-title{
    
margin-bottom: 30px;
font-size: 18px;
color: #909497;
font-weight: 400;
}

div.room-cont{
    
padding: 25px;
}

h2{
    
color: #101010;
}

h3{
    
font-size: 16px;
font-weight: 400;
background-color: #2e86c1;
color: #FFFFFF;
text-align: center;
}

p{
    
font-size: 14px;
font-weight: 400;
line-height: 20px;
margin: 8px 0;
color: #404040;
}

span.field-value{
    
    float: right;
    color: #101010;
}

@media (max-width: 991px) {

div.page-cont{

margin-bottom: 30px;    
padding: 20px 10px;
border: none;
border-radius: 3px;
}

div.step{
 
position: relative;
left: 0;
top: 20px;
width: 100%;
padding: 10px 20px;
margin: 0 0 30px 0;
background-color: #2e86c1;
color: #FFFFFF;
text-align: center;
}

h1.page-title{
 
padding: 10px;
font-size: 14px;
margin: 25px 0;
}


p.prompt{

font-size: 10px; 
}
 
}
  
@media (max-width: 991px) {

div.page-cont{

margin-bottom: 30px;    
padding: 20px 10px;
border: none;
border-radius: 3px;
}

div.step{
 
position: relative;
left: 0;
top: 20px;
width: 100%;
padding: 10px 20px;
margin: 0 0 30px 0;
background-color: #2e86c1;
color: #FFFFFF;
text-align: center;
}

h1.page-title{
 
padding: 10px;
font-size: 14px;
margin: 25px 0;
}


p.prompt{

font-size: 10px; 
}
 
}
    @media (max-width: 991px) {

div.page-cont{

margin-bottom: 30px;    
padding: 20px 10px;
border: none;
border-radius: 3px;
}

div.step{
 
position: relative;
left: 0;
top: 20px;
width: 100%;
padding: 10px 20px;
margin: 0 0 30px 0;
background-color: #2e86c1;
color: #FFFFFF;
text-align: center;
}

h1.page-title{
 
padding: 10px;
font-size: 14px;
margin: 25px 0;
text-align: center;
}


p.prompt{

font-size: 10px; 
}
 
}
       
</style>
</head>
<body>
<?php require "partial/header.php"?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1 class="page-title"><i class="fas fa-caret-right"></i>&nbsp;
Please Select Rooms And Update <strong>Availability Dates</strong> and <strong>Prices</strong></h1>
<div class="step">
 Step 3 of 3   
</div>    
</div>
</div>

<div class="row">
<div class="col-md-12">
<p><a class="s-btn right" href="<?php echo RouteGenerator::set_url('add-room.php')?>">Add Room</a></p>
</div> 
</div>

<div class="row">
<div class="col-md-12">
<form action="<?php echo RouteGenerator::set_request('HandleConfiguration.php')?>" method="POST" class="form-inline">
<div class="form-group">
<label>Clients Application Background Theme:</label>
<select name="theme" class="form-control">
<option value="summer">summer</option>
<option value="winter">winter</option>
</select> 
</div>
<input type="hidden" name="action" value="5"> 
<div class="form-group">
<button class="btn btn-primary" id="submit" name="submit" value="submit">Update Theme</button>    
</div>
</form>
</div>
</div>

<?php
if($message != null){
echo $message;
}
?>
<div class="row">

<?php
if(is_array($data)){
foreach($data as $dt){
if($dt->start_date == NULL){
 $dt->start_date = "";
}
if($dt->end_date == NULL){
 $dt->end_date = "";
}
if($dt->room_price == NULL){
 $dt->room_price = 0;
}
echo '<div class="col-md-4 room-cont">
<img src="' . $dt->room_image . '" alt="room">   
<h2> Room Id: ' . $dt->id . '</h2>
<h3>Room Number: ' . $dt->room_number . '</h3>
<p>Room Type: <span class="field-value">' . $dt->room_type . '</span></p>
<p>Room Floor: <span class="field-value">' . $dt->room_floor . '</span></p>
<p>Available From: <span class="field-value">' .$dt->start_date . '</span></p>
<p>Available To: <span class="field-value">' .$dt->end_date . '</span></p>
<p>Room Price: <span class="field-value">' .$dt->room_price . '&euro;</span></p>
<p><a class="s-btn" href="update-room.php?id=' . $dt->id . '">Edit</a></p>
</div>';
}
}
?>

</div>

<?php require "inc/admin-js-calls.php"?>
</body>
</html>