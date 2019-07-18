<?php

//require "../Models/Reservation.php";
require "../Controllers/RouteGenerator.php";
require "../Controllers/ClientController.php";

//use App\Models\Reservation;
use App\Controllers\RouteGenerator;
use App\Controllers\ClientController;


if(isset($_GET['action'])){
$action = $_GET['action'];
}

if(isset($_GET['start_date'])){
$start_date = $_GET['start_date'];
}

if(isset($_GET['end_date'])){
$end_date = $_GET['end_date'];
}

if(isset($_GET['rooms'])){
$rooms = $_GET['rooms'];
}

$start_day_b = explode("/", trim($start_date));
$month_days_s = getMonthTotal(trim($start_day_b[2]), trim($start_day_b[1]));
$start_day = $month_days_s + $start_day_b[0];
$end_day_b = explode("/", trim($end_date));
$month_days = getMonthTotal(trim($end_day_b[2]), trim($end_day_b[1]));
$end_day = $month_days + $end_day_b[0];
$rooms = explode(",", $rooms);

$data = null;
$data_b = array();
if($action == '2'){
$handler = new ClientController();

foreach($rooms as $d){
$data = $handler->fetch_data_for_reservation($d);
while($row = $data->fetch(\PDO::FETCH_ASSOC)){
         extract($row);
         $result_item = array('id' => $id,
                              'room_number' => $room_number,
                              'room_type' => $room_type,
                              'room_price' => $room_price,
                              'deposit' => $deposit,
                              'vat' => $vat
                              );
         array_push($data_b, $result_item);
}
}

$dat = json_encode($data_b);
$data = json_decode($dat);
}

function getMonthTotal($year, $month){
        
        $num_days = 0;
        $num = 0;
        $total = 0;
        
        switch($month){
        case "01":
        $num_days = 0;
        break;
        case "02":
        $num_days = 31;
        break;
        case "03":
        $num_days = 59;
        $num_days = check_disekto($num_days, $year);
        break;
        case "04":
        $num_days = 90;
        $num_days = check_disekto($num_days, $year);
        break;
        case "05":
        $num_days = 120;
        $num_days = check_disekto($num_days, $year);
        break;
        case "06":
        $num_days = 151;
        $num_days = check_disekto($num_days, $year);
        break;
        case "07":
        $num_days = 181;
        $num_days = check_disekto($num_days, $year);
        break;
        case "08":
        $num_days = 212;
        $num_days = check_disekto($num_days, $year);
        break;
        case "09":
        $num_days = 243;
        $num_days = check_disekto($num_days, $year);
        break;
        case "10":
        $num_days = 273;
        $num_days = check_disekto($num_days, $year);
        break;
        case "11":
        $num_days = 304;
        $num_days = check_disekto($num_days, $year);
        break;
        case "12":
        $num_days = 334;
        $num_days = check_disekto($num_days, $year);
        break;
        default:
        $num_days = 0;
        break;
        }
        
     if($year == "2019"){
        $num = 0;
    }else if($year == "2020"){
        $num = 0;
    }else if($year == "2021"){
        $num = 365;
    }else if($year == "2022"){
        $num = 730;
    }else if($year == "2023"){
        $num = 1095;
    }else if($year == "2024"){
        $num = 1460;
    }else if($year == "2025"){
        $num = 1825;
    }else if($year == "2026"){
        $num = 2190;
    }else if($year == "2027"){
        $num = 2555;
    }else if($year == "2028"){
        $num = 2920;
    }       
     
     $total = (int)$num_days + (int)$num;   
     return $total;
    }
    
function check_disekto($days, $year){
     
     $disekta = array('2020', '2024', '2028', '2032', '2036', '2040', '2044', '2048',
                         '2052', '2056', '2060', '2064');
     
     foreach($disekta as $ds){
            if(trim($year == trim($ds))){
                $days += 1;
            }
        }
    return $days;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>New Reservation</title>
<meta name="description" content="">    
<?php require "inc/meta1.php";?>
<?php require "inc/meta2.php";?>


<style>
  
 .container{
 
 padding: 80px 40px; 
 }

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

span.req{
    
color: #c0392b;
font-size: 16px;
font-weight: 600;
}

span.field-value{
    
float: right;
color: #101010;
}

@media (max-width: 991px) {
 
.container{
 
padding: 130px 10px; 
}
}
  
</style>
</head>
<body>
<div class="logo">
<a href="<?php echo RouteGenerator::set_url('welcome-2.php')?>"><img src="../images/nodelook.png" alt="Welcome to Nodelook"></a>   
</div>
<?php require "partial/header.php"?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1 class="page-title"><i class="fas fa-caret-right"></i>&nbsp;
Reservation</h1>
</div>
</div>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="col-md-6">
<?php
foreach($data as $dt){
echo
'<p>Check In Date: <span class="field-value">' . $start_date . '</span></p>
 <p>Check Out Date: <span class="field-value">' . $end_date . '</span></p>
 <p>Room Number: <span class="field-value">' . $dt->room_number . '</span></p>
 <p style="margin-bottom:30px;">Room Price: <span class="field-value">' . $dt->room_price . ' &euro;</span></p>
';
}
?>
</div>
<div class="col-md-6">
<?php
$total_price = 0;
$deposit = 0;
if($data[0]->deposit > 0){
echo '<p><strong>Deposit is required for this Reservation</strong></p>';
echo '<p style="margin-bottom:30px;">VAT applied to total price: ' . $data[0]->vat .  '%</p>';
echo '<input type="hidden" name="depos" value="yes" id="depos">';
}else{
echo '<p><strong>No Deposit is required for this Reservation</strong></p>';
echo '<p style="margin-bottom:30px;">VAT applied to total price: ' . $data[0]->vat .  '%</p>';
echo '<input type="hidden" name="depos" value="no" id="depos">';
}
foreach($data as $dt){
if($dt->deposit > 0){
$total_price += $dt->room_price;
}
}
$total_days = $end_day - $start_day;
$total_price = $total_price * $total_days;
$deposit = $total_price * $data[0]->deposit;
if($deposit > 0){
echo
'<p>Total Price excluding VAT: <span class="field-value">' . $total_price . ' &euro;</span></p>
 <p>Deposit Required: <span class="field-value">' . $deposit . ' &euro;</span></p>
';
}
?>   
</div>
</div>
</div>
<p style="clear:both;"></p>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<form action="<?php echo RouteGenerator::set_request('ClientController.php')?>" method="POST" id="checkout">

<div class="col-md-6">

<div class="form-group">
<label>Surname <span class="req">*</span></label>
<input type="text" class="form-control" id="surname" name="surname" required>    
</div>


<div class="form-group">
<label>First Name</label>
<input type="text" class="form-control" id="firstname" name="firstname">    
</div>

<div class="form-group">
<label>Email <span class="req">*</span></label>
<input type="email" class="form-control" id="email" name="email" required>    
</div>

<div class="form-group">
<label>Phone Number</label>
<input type="text" class="form-control" id="phone" name="phone">  
</div>

</div>

<div class="col-md-6">
<div id="dropin-container"></div>
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
<input type="hidden" name="amount" value="<?php echo $deposit;?>">
<input type="hidden" name="payment_method_nonce">
<input type="hidden" name="action" value="3-winter">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<button class="btn btn-primary pull-right" id="submit" type="submit" name="submit" value="submit">Make Reservation</button>    
</div>
</div>
</div>
</form>
</div>
</div>

</div>
<div class="footer">
<a href="privacy-data-2.php" target="blank">Policies</a>
</div>
<?php require "inc/js-calls.php"?>
<script src="https://js.braintreegateway.com/web/dropin/1.16.0/js/dropin.min.js"></script>
<script>
$(document).ready(function(){
 
var decision = $('#depos').val();
 
if (decision == "yes") {
 
var button = document.querySelector('#submit');
 $.ajax({url: "../Controllers/BraintreeController.php",
           type: "get",
           dataType: 'json',
           success: function(response){
          
             braintree.dropin.create({
              authorization: response.token,
              container: '#dropin-container'
              }, function (createErr, instance) {
               button.addEventListener('click', function () {
               
               instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
         
        document.querySelector('input[name="payment_method_nonce"]').value = payload.nonce;   
               });
              
               });
              }
         
             );
              }
 });
 
}
 });


</script>

</body>
</html>