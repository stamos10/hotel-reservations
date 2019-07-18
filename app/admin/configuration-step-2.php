<?php

require "../Controllers/RouteGenerator.php";
require "../Controllers/HandleConfiguration.php";
use App\Controllers\RouteGenerator;
use App\Controllers\HandleConfiguration;
RouteGenerator::check_user();
$handler = new HandleConfiguration();
$data = json_decode($handler->fetch_data());
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Initial Configuration Step 2</title>
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

.fa-thumbs-up{
 
 color: #1e8449;
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
Please specify <strong>Room Number</strong> &amp; <strong>Room Floor</strong> for each Room and click OK</h1>
<div class="step">
 Step 2 of 3   
</div>    
</div>
</div>
<div class="row">
<div class="col-md-12 table-responsive">

<table class="table table-hover">
<tr>
<th>Room Id </th>
<th>Room Type </th>
<th>Room Number </th>
<th>Room Floor </th>
<th></th>
<th></th>
</tr>
<?php
foreach($data as $dt){
echo '<tr>
<td>' . $dt->id . '</td>
<td>' . $dt->room_type . '</td>
<td>
<input type="text" name="room_number" id="room_number' . $dt->id . '" placeholder="Room Number">    
</td>
<td>
<select name="room_floor" id="room_floor' . $dt->id . '">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select>
</td>
<td id="status'. $dt->id . '">
<input type="hidden" name="room_id" id="room_id' . $dt->id . '" value="' . $dt->id . '">
<input type="hidden" name="room_type" id="room_type' . $dt->id . '" value="' . $dt->room_type . '">
<button class="btn btn-primary btn-sm" 
onclick=\'save_room("room_id' . $dt->id . '", "room_floor' . $dt->id . '", "room_number' . $dt->id . '", "room_type' . $dt->id . '", "status'. $dt->id . '");\'>OK</button> 
</td>
<td></td>
</tr>';
}
?>
</table>
<input type="hidden" name="target_url" id="target_url" value="<?php echo RouteGenerator::set_request('HandleConfiguration.php');?>">
<a role="button" href="<?php echo RouteGenerator::set_url('rooms.php')?>" class="btn btn-warning pull-right hidden-xs hidden-sm">Next</a>
<a style="margin:30px 0;"role="button" href="<?php echo RouteGenerator::set_url('rooms.php')?>" class="btn btn-warning btn-block hidden-md hidden-lg">Next</a>
</div>
</div>

<?php require "inc/admin-js-calls.php"?>
<script src="../js/configuration-step-2.js"></script>
</body>
</html>