<?php

require "../Controllers/RouteGenerator.php";
use App\Controllers\RouteGenerator;

RouteGenerator::check_user();

$message = null;
if(isset($_GET['message'])){
 $message = $_GET['message'];
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

button.but{
    
position: relative;
top: 30px;
left: 0;
}

span.field-value{
    
float: right;
color: #101010;
}

div.res{
 
 margin: 40px 0;
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

button.but{
    
position: relative;
top: -15px;
left: 0;
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
Create New Reservation - Step 1 of 2</h1>
</div>
</div>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="col-md-3">
<div class="form-group custform">
<label>Check In Date <span class="req">*</span></label>
<input type="text" class="form-control" id="start_date" name="start_date" readonly required> 
</div>
</div>
<div class="col-md-3">
<div class="form-group custform">
<label>Check Out Date <span class="req">*</span></label>
<input type="text" class="form-control" id="end_date" name="end_date" readonly required> 
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Room Type <span class="req">*</span></label>
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
<input type="hidden" name="url" id="url" value="<?php echo RouteGenerator::set_request('HandleReservations.php')?>">
<input type="hidden" name="action" id="action" value="1">
<div class="col-md-2">
<div class="form-group">
<button class="btn btn-primary btn-block" id="submit" name="submit" value="submit" style="margin-top:25px;">Submit</button>    
</div>
</div>
</div>
</div>
<?php
if($message != null){
echo '<div class="alert alert-danger" style="30px 0;">' .  $message . '</div>';
}
?>
<div class="row">
<div class="col-md-8 col-md-offset-2" id="results">

</div>    
</div>
<div class="row">
<div class="col-md-8 col-md-offset-2" id="links">

</div>    
</div>
</div>

<?php require "inc/admin-js-calls.php"?>
<script>
$('document').ready(function(){
 
var rooms = [];
var partial_completion = "Room Added for booking. Scroll Down and click Proceed to Booking or add Another Room";
   
$('#start_date').datepicker({dateFormat: 'dd/mm/yy',
                     changeYear: true,
                     changeMonth: true,
                     yearRange: "-2:+2",
                     showOn: "button",
                     buttonImage: "../images/calendar.png",
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
                     buttonImage: "../images/calendar.png",
                     buttonImageOnly: true,
                     buttonText: "Select date",
                     onSelect: function(){
                     z_date = $('#end_date').val();
                               
                    }
});

$('#submit').on('click' ,function(){

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

    
 
 $.ajax({url: url,
           type: "post",
           headers : {'CsrfToken': $('meta[name="csrf-token"]').attr('content')},
           data: request,
           success: function(response){
             $('#results').html('');            
            var action = '2';
            
            
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
          }else{
            $.each(data, function(i, dt){
            var template = '<div class="row res"><div class="col-md-4">' +
                           '<button class="btn btn-info btn-block but" id="' + dt.id + '">' +
                           'Select Room</button></div>' +
                           '<div class="col-md-3"><img src="' + dt.room_image + '"></div>' +
                           '<div class="col-md-4">' +
                           '<p>Room Number: <span class="field-value">' + dt.room_number+ '</span></p>' +
                           '<p style="clear:both;"></p>' +
                           '<p>Room Type: <span class="field-value">' + dt.room_type + '</span></p>' +
                           '<p style="clear:both;"></p>' +
                           '<p>Room Price: <span class="field-value">' + dt.room_price + '</span></p>' +
                           '<p style="clear:both;"></p>' +
                           '</div></div>';
            
            
            $('#results').append(template);
            
            $('#' + dt.id).on('click', function(){
            
            rooms.push(dt.room_number);
            $(this).html('');
            $(this).html('Room Selected For Booking');
            $(this).css({"background-color" : "#FFFFFF", "color" : "#101010", "border" : "solid 1px #101010"});
            
            
            alert(partial_completion);
            $('#links').html('');
             $('#links').append('<div class="row"><div class="col-md-12">' +
                                 '<a role="button" class="btn btn-warning pull-right"' +
                                 'href="create-reservation-step-2.php?action=2&start_date=' + start_date + '&end_date=' + end_date +'&rooms=' + rooms+ '"' +
                                 'id="booking"> Proceed to Booking' +
                                 '</a>' +
                                 '</div>' +
                                 '</div>');
            
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