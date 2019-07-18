<?php

require "../Controllers/RouteGenerator.php";
require "../Controllers/HandleReservations.php";
use App\Controllers\RouteGenerator;
use App\Controllers\HandleReservations;
RouteGenerator::check_user();
$handler = new HandleReservations();
$data = json_decode($handler->fetch_reservations());

$message = null;
if(!empty($_GET['message'])){
 $message = '<div class="alert alert-success" style="margin:30px 0;">' . $_GET['message'] . '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Reservations Information</title>
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

.bordered{
                    
padding: 20px 0;
border-bottom: solid 1px #808080;
}

table tr td.del>a{

color: #FF0000;
text-align: center;
}

table.table tr td{
 
 padding: 20px 10px;
}

table tr td{
 
 text-align: center;
 
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
View Reservations</h1>
</div>
</div>
<div class="row">
<div class="col-md-10 col-md-offset-1 table-responsive">
<?php
if($message != null){
echo $message;
}
?>
<table class="table" style="margin-bottom: 30px;">
<tr class="info">
<td>Check In Date</td>
<td>Check Out Date</td>
<td>Room Number</td>
<td>Free Room</td>
<td>Payment Id</td>
<td>Client Surname</td>
<td>Client Email</td>
<td>Delete </td>
</tr>
<?php
foreach($data as $dt){

echo
'<tr>
<td>' . $dt->start_date . '</td>
<td class="dte">' . $dt->end_date . '</td>
<td>' . $dt->room_number . '</td>
<td class="h"><a href="../Controllers/update-room-status.php?id=' . $dt->room_number . '" style="color:#1e8449;"><i class="fas fa-hotel"></i></a></td>
<td>' . $dt->payment_id . '</td>
<td>' . $dt->client_surname . '</td>
<td>' . $dt->client_email . '</td>
<td class="del"><a href="../Controllers/delete-reservation.php?id=' . $dt->id . '&room=' . $dt->room_number . '"><i class="fas fa-trash-alt"></i></a></td>
</tr>';
}

?>
</table>
</div>
</div>

</div>

<?php require "inc/admin-js-calls.php"?>
<script>
$('document').ready(function(){

var blink;
var today = new Date();  
var now = {day : today.getDate(),
           month : today.getMonth() + 1,
           year: today.getFullYear()};
if (parseInt(now.month) < 10) {
now.month = "0" + now.month;
}else{
now.month = now.month;
}

var current_day = now.day + "/" + now.month + "/" + now.year; 

var res_dates = "";


$('.dte').each(function(){
 
res_dates = $(this).html();
var c = this;
blink_it(c,res_dates);
});


for (i = 0; i < res_dates.length; i++) {
if ((current_day.trim().toString()) === (res_dates[i].trim()).toString()) {

blink = setInterval(blink_now, 1000);   
}
}

function blink_now(c) {
    
    ($(c).closest("i")).fadeOut(500);
    ($(c).closest("i")).fadeIn(500);
}

function blink_it(c, inp) {


if ((current_day.trim().toString()) == (inp.trim()).toString()) {

blink = setInterval(function(){
  
 ($(c).siblings('.h')).fadeOut(500);
 ($(c).siblings('.h')).fadeIn(500);
 
}, 1000);   
}
    
}


$('.h>a').on('mouseover' ,function(){

clearInterval(blink);
$(this).css({"color" :"#FF0000"});
  
});

$('.h>a').on('mouseout' ,function(){

$(this).css({"color" :"#1e8449"});
  
});
});
</script>
</body>
</html>