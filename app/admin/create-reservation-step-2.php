<?php

require "../Controllers/RouteGenerator.php";
require "../Controllers/HandleReservations.php";
use App\Controllers\RouteGenerator;
use App\Controllers\HandleReservations;

RouteGenerator::check_user();

$start_date = "";
$end_date = "";

if(isset($_GET['action'])){
$action = $_GET['action'];
}

if(isset($_GET['rooms'])){
$rooms = $_GET['rooms'];
}

$rooms = explode(",", $rooms);

$data = null;
$data_b = array();
if($action == '2'){
$handler = new HandleReservations();

foreach($rooms as $d){
$data = $handler->fetch_data_for_reservation($d);
while($row = $data->fetch(\PDO::FETCH_ASSOC)){
         extract($row);
         $result_item = array('id' => $id,
                              'room_number' => $room_number,
                              'room_type' => $room_type,
                              'room_price' => $room_price
                              );
         array_push($data_b, $result_item);
}
}

$dat = json_encode($data_b);
$data = json_decode($dat);

if(isset($_GET['start_date'])){
$start_date = $_GET['start_date'];
}

if(isset($_GET['end_date'])){
$end_date = $_GET['end_date'];
}


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>New Reservation Step 1</title>
<meta name="description" content="">    
<?php require "inc/admin-meta.php";?>

<style>

h1.page-title{
    
margin-bottom: 30px;
font-size: 18px;
color: #909497;
font-weight: 400;
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

.custform input{

display: inline-block;
vertical-align: top;
width: 80%;
}
.custform img{
      
display: inline-block;
vertical-align: top;
width: 15%;
margin-left: 3px;
padding: 3px;
border: solid 2px #e67e22;
border-radius: 2px;
}
    
.custform img:hover{
    
cursor: pointer;
border: solid 2px #1e8449;
}

.bordered{
                    
padding: 20px 0;
border-bottom: solid 1px #808080;
}

span.req{
    
color: #c0392b;
font-size: 16px;
font-weight: 600;
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
Create New Reservation - Step 2 of 2</h1>
</div>
</div>
<div class="row">
<div class="col-md-8 col-md-offset-2 table-responsive">

<table class="table" style="margin-bottom: 30px;">
<tr>
<td>Room Number</td>
<td>Room Type</td>
<td>Room Price</td>
<td>Check In Date</td>
<td>Check Out Date</td>
</tr>
<?php
//if(is_array($data)){
foreach($data as $dt){

echo
'<tr class="success">
<td>' . $dt->room_number . '</td>
<td>' . $dt->room_type . '</td>
<td>' . $dt->room_price . '</td>
<td>' . $start_date . '</td>
<td>' . $end_date . '</td>
</tr>';
}
//}
?>
</table>

<form action="<?php echo RouteGenerator::set_request('HandleReservations.php')?>" method="POST">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Client Surname <span class="req">*</span></label>
<input type="text" class="form-control" id="surname" name="surname" required>    
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Client First Name</label>
<input type="text" class="form-control" id="firstname" name="firstname">    
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Client Email <span class="req">*</span></label>
<input type="email" class="form-control" id="email" name="email" required>    
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Client Phone Number</label>
<input type="text" class="form-control" id="phone" name="phone">  
</div>
</div>
</div>
<?php
$r = "";
foreach($data as $dt){
$r .= $dt->room_number . ',';
}

?>
<input type="hidden" name="rooms" value="<?php echo $r;?>">
<input type="hidden" name="start_date" value="<?php echo $start_date;?>">
<input type="hidden" name="end_date" value="<?php echo $end_date;?>">
<input type="hidden" name="action" value="3">
<div class="form-group">
<button class="btn btn-primary pull-right" id="submit" name="submit" value="submit">Make Reservation</button>    
</div>
</form>
</div>
</div>
</div>

<?php require "inc/admin-js-calls.php"?>
</body>
</html>