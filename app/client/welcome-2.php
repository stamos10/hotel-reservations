<?php

require "../Controllers/RouteGenerator.php";
use App\Controllers\RouteGenerator;

$message = null;
if(isset($_GET['message'])){
 $message = $_GET['message'];
}

$error = null;
if(isset($_GET['error'])){
 $error = $_GET['error'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Check Availability Dates</title>
<meta name="description" content="">    
<?php require "inc/meta1.php";?>
<?php require "inc/meta2.php";?>

<style>

body{
margin: 0;
padding: 0;
overflow-x: hidden;
background: url('../images/winter.jpg') no-repeat center center fixed;
background-size: cover;
width: 100%;
height: 100%;

}

.container-promo{
    
display: block;
width: 50%;
position: absolute;
top: 30%;
left: 3%;
background: transparent;
margin: 0;
padding: 0;
}

h1.welcome{
    
margin: 20px 0;
color:   #ecf0f1  ;
font-family: 'Italianno', cursive;
font-size: 40px;
font-weight: 600;
text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
}

p.welcome{

margin: 0 0 45px 0;
color: #FFFFFF;
font-family: 'Italianno', cursive;
font-size: 38px;
font-weight: 400;
text-shadow: 1px 1px 2px #101010, 0 0 25px blue, 0 0 5px darkblue;
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
line-height: 29px;
margin: 8px 0;
color: #101010;
}

p.firs{
 
margin-top: 10px;
}

p.colored{
 
background-color: #354db0;
color: #FFFFFF;
border-radius: 2px;
}

.custform input{

display: inline-block;
vertical-align: top;
width: 85%;
}

.custform img{
      
display: inline-block;
vertical-align: top;
width: 10%;
margin-left: 3px;
padding: 0 3px 3px 3px;

}
    
.custform img:hover{
    
cursor: pointer;
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

button.but{
    
margin: 20px 0 0px 0;
}

span.field-value{
    
float: right;
color: #101010;
}

div.room-a{
 
 display: inline-block;
 width: 24%;
 height: auto;
 margin: 30px 4%;
 padding: 20px 10px;
 background-color: #FFFFFF;
 border-radius: 4px;
 box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
}

div.room-b{
 
 display: inline-block;
 width: 24%;
 height: auto;
 margin: 30px 12%;
 padding: 20px 10px;
 background-color: #FFFFFF;
 box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
}

div.room-c{
 
 display: inline-block;
 position: absolute;
 left: 34%;
 width: 32%;
 height: auto;
 margin: 30px auto;
 padding: 20px 10px;
 background-color: #FFFFFF;
 box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
}

a.proceed{
 
position: absolute;
top: -20px;
right: 5px;
}

@media (max-width: 991px) {
 
.container-promo{
    
display: block;
width: 100%;
position: absolute;
top: 30%;
left: 0;
background: transparent;
margin: 0;
padding: 0 10px;
text-align: center;
}

div.room-a{
 
 display: block;
 position: relative;
 left: 0;
 width: 100%;
 height: auto;
 margin: 30px auto;
 padding: 20px 10px;
}

div.room-b{
 
 display: block;
 position: relative;
 left: 0;
 width: 100%;
 height: auto;
 margin: 30px auto;
 padding: 20px 10px;
}

div.room-c{
 
 display: block;
 position: relative;
 left: 0;
 width: 100%;
 height: auto;
 margin: 30px auto;
 padding: 20px 10px;
}

a.proceed{
 
position: absolute;
top: -20px;
right: 5px;
}
}
</style>
</head>
<body>
<?php
if($message != null){
echo '<div class="alert alert-success" style="30px 0;">' .  $message . '</div>';
}
if($error != null){
  echo '<div class="alert alert-danger">Error: ' . $error . '</div>';
}
?>
<div class="logo">
<a href="<?php echo RouteGenerator::set_url('welcome-2.php')?>"><img src="../images/nodelook.png" alt="Welcome to Nodelook"></a>   
</div>
<div class="container-promo">
<h1 class="welcome">Thank you for using Nodelook</h1>
<p class="welcome">Book your Rooms in 3 steps and let your dream Holidays begin...</p>
<div class="main-btn" id="main-btn">Get Started </div>
</div>

<div class="container-book">
<div class="row">
<div class="col-md-4">
<div class="form-group custform">
<label>Check In Date <span class="req">*</span></label>
<input type="text" class="form-control" id="start_date" name="start_date" readonly required> 
</div>
</div>
<div class="col-md-4">
<div class="form-group custform">
<label>Check Out Date <span class="req">*</span></label>
<input type="text" class="form-control" id="end_date" name="end_date" readonly required> 
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Room Type </label>
<select name="room_type" id="room_type" class="form-control">
<option value="any">Any</option>
<option value="One Bed">One Bed</option>
<option value="Two Beds">Two Beds</option>
<option value="Three Beds">Three Beds</option>
<option value="Four Beds">Four Beds</option>
<option value="Studio">Studio</option>
</select>    
</div>
</div>
<input type="hidden" name="url" id="url" value="<?php echo RouteGenerator::set_request('ClientController.php')?>">
<input type="hidden" name="action" id="action" value="1-winter">
<div class="col-md-2">
<div class="form-group">
<button class="btn btn-success btn-block" id="submit" name="submit" value="submit" style="margin-top:25px;">Submit</button>    
</div>
</div>

</div>    
</div>

<div class="container-rooms">

<div class="row">
<div class="col-md-12" id="links">

</div>    
</div> 
 
<div class="row">
<div class="col-md-12" id="results">

</div>    
</div>

</div>
<div class="footer">
<a href="privacy-data-2.php" target="blank">Policies</a>
</div>
<?php require "inc/js-calls.php"?>
<script>
$('document').ready(function(){

$('#main-btn').on('click' ,function(){
 
$('.container-promo').fadeOut(500);
$('.container-book').fadeIn(1500);
});
 
var rooms = [];
var template;
var partial_completion = "Room Added for booking. Click Proceed to Booking on Top or add Another Room";
   
$('#start_date').datepicker({dateFormat: 'dd/mm/yy',
                     changeYear: true,
                     changeMonth: true,
                     yearRange: "-2:+2",
                     showOn: "button",
                     buttonImage: "../images/calendar-b.png",
                     buttonImageOnly: true,
                     buttonText: "Select date",
                     onSelect: function(){
                     z_date = $('#start_date').val();
                               
                    }
});

$('#end_date').datepicker({dateFormat: 'dd/mm/yy',
                     changeYear: true,
                     changeMonth: true,
                     yearRange: "-2:+2",
                     showOn: "button",
                     buttonImage: "../images/calendar-b.png",
                     buttonImageOnly: true,
                     buttonText: "Select date",
                     onSelect: function(){
                     z_date = $('#end_date').val();
                               
                    }
});

$('#submit').on('click' ,function(){
$('.container-book').fadeOut(1000);  
$('.container-rooms').fadeIn(1000);


var url = $('#url').val();
var action = $('#action').val();
var start_date = $('#start_date').val();
var end_date = $('#end_date').val();
var room_type = $('#room_type').val();
var submit = $('#submit').val();

request = {action : action,
           submit : submit, 
           start_date : start_date,
           end_date : end_date,
           room_type : room_type};

$('.container-book').fadeOut(1000);  
$('.container-rooms').fadeIn(1000);


 $.ajax({url: url,
           type: "post",
           headers : {'CsrfToken': $('meta[name="csrf-token"]').attr('content')},
           data: request,
           success: function(response){
            
           var start_date = $('#start_date').val();
           var end_date = $('#end_date').val();
           var d = response;
           var data_initial = JSON.parse(d);
           var data = data_initial.data;
           var num = data_initial.num;
          
           var error = '<div class="alert alert-danger" style="margin: 30px 0;">'+
            'We are Sorry. No Available Rooms Found with these criteria!</div>';
          
          if (num == 0) {
            $('#results').append(error);
            $('#results').append('<div class="row"><div class="col-md-4 col-md-offset-4">' +
                                 '<a role="button" href="welcome-2.php" class="btn btn-warning btn-block">' +
                                 'New Search</a></div></div>');
          }else{
            $.each(data, function(i, dt){
             if (num == 1) {
              template = '<div class="room-c">' +
                         '<img src="' + dt.room_image + '">' +
                         '<p class="firs">Room Number: <span class="field-value">' + dt.room_number + '</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<p>Room Floor: <span class="field-value">' + dt.room_floor + '</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<p>Room Type: <span class="field-value">' + dt.room_type + '</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<p>Room Price: <span class="field-value">' + dt.room_price + ' &euro;</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<button class="btn btn-info btn-block but" id="' + dt.id + '">' +
                         'Select Room for Booking</button>' +
                         '</div>';
                
             }else if (num == 2) {
                template = '<div class="room-b">' +
                         '<img src="' + dt.room_image + '">' +
                         '<p class="firs">Room Number: <span class="field-value">' + dt.room_number + '</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<p>Room Floor: <span class="field-value">' + dt.room_floor + '</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<p>Room Type: <span class="field-value">' + dt.room_type + '</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<p>Room Price: <span class="field-value">' + dt.room_price + ' &euro;</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<button class="btn btn-info btn-block but" id="' + dt.id + '">' +
                         'Select Room for Booking</button>' +
                         '</div>';
             }else{
            template = '<div class="room-a">' +
                         '<img src="' + dt.room_image + '">' +
                         '<p class="firs">Room Number: <span class="field-value">' + dt.room_number + '</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<p>Room Floor: <span class="field-value">' + dt.room_floor + '</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<p>Room Type: <span class="field-value">' + dt.room_type + '</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<p>Room Price: <span class="field-value">' + dt.room_price + ' &euro;</span></p>' +
                         '<p style="clear:both;"></p>' +
                         '<button class="btn btn-info btn-block but" id="' + dt.id + '">' +
                         'Select Room for Booking</button>' +
                         '</div>';
             }
            
            $('#results').append(template);
            
            $('#' + dt.id).on('click', function(){
            
            rooms.push(dt.room_number);
            $(this).html('');
            $(this).html('Room Selected For Booking');
            $(this).css({"background-color" : "#FFFFFF", "color" : "#101010", "border" : "solid 1px #101010"});
            
            alert(partial_completion);
            $('#links').html('');
            $('#links').append( '<a role="button" class="btn btn-warning pull-right"' +
                                 'href="reservation-2.php?action=2&start_date=' + start_date + '&end_date=' + end_date +'&rooms=' + rooms+ '"' +
                                 'id="booking"> Proceed to Booking' +
                                 '</a>');
            
            });
            
             
            });
           
    
          }
          },
          then: function(response){
           
           }    
		});   
    
   
 

});



});
</script>
</body>
</html>