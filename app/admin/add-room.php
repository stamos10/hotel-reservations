<?php

require "../Controllers/RouteGenerator.php";
use App\Controllers\RouteGenerator;
RouteGenerator::check_user();
$response_img = null;
$response = null;
$img_url = "../images/room.jpg";

if(isset($_POST["submit"])) {
$sub = $_POST["submit"];
if($sub == "upload"){
         $destination = '/nodelook/app/images/'; 
         $destinationPath = $_SERVER['DOCUMENT_ROOT'] . $destination . basename($_FILES['imagefilename']['name']);;
         
         $uploadOk = 1;
         $imageFileType = pathinfo($destinationPath,PATHINFO_EXTENSION);
         
         $check = getimagesize($_FILES['imagefilename']['tmp_name']);
           
            if($check != false) {
                $uploadOk = 1;
            }else{
                $uploadOk = 0;
            }

         
         if (file_exists($destinationPath)) {
            $response_img = "Upload Failed! File already exists..."; 
            $uploadOk = 0;
             
        }
    
         if ($uploadOk == 0) {
            $response_img = "Upload Failed! Please try again...";
          
         }else{
            if (move_uploaded_file($_FILES['imagefilename']['tmp_name'], $destinationPath)) {
            $response_img = "<div class=\"alert alert-success\">Image Uploaded successfully</div>";
            
            $image = $_FILES['imagefilename']['name'];
            $image_b = "../images/".$image;
            $_SESSION['image'] = $image_b;
            if(isset($_SESSION['image'])){
                $img_url = $_SESSION['image'];
            }
            }else{
            
         }
		} 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Room</title>
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
width: 85%;
}
.custform img{
      
display: inline-block;
vertical-align: top;
width: 10%;
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

a.dlt{
 
 margin: 40px 0 30px 0;
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
Add New Room</h1>
</div>
</div>

<div class="row hidden-xs hidden-sm">
<div class="col-md-8 col-md-offset-2 bordered">
<?php
if($response_img != null){
echo $response_img;
}
?>
<h2><i class="fas fa-caret-right"></i>&nbsp;Upload Room Image</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
	  
<div class="form-group">
<input type="file" name="imagefilename" id="imagefilename">
</div>					
<div class="form-group">
<button type="submit" name="submit" id="upload" value="upload" class="btn btn-primary"> Upload</button>
</div>
</form>

</div>
</div>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<?php
if($response != null){
echo $response;
}
?>
<h2><i class="fas fa-caret-right"></i>&nbsp;Fill in Room Details</h2>
<form action="<?php echo RouteGenerator::set_request('HandleConfiguration.php')?>" method="POST">
<input autocomplete="false" name="hidden" type="text" style="display:none;">
<div class="col-md-6">
<div class="form-group">
<label>Room Number <span class="req">*</span></label>
<input type="text" name="room_number" class="form-control" required>    
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Room Floor <span class="req">*</span></label>
<select name="room_floor" class="form-control">
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
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Room Type <span class="req">*</span></label>
<select name="room_type" class="form-control">
<option value="One Bed">One Bed</option>
<option value="Two Beds">Two Beds</option>
<option value="Three Beds">Three Beds</option>
<option value="Four Beds">Four Beds</option>
<option value="Studio">Studio</option>
</select>    
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Room Price <span class="req">*</span></label>
<input type="text" name="room_price" class="form-control" required>    
</div>
</div>
<div class="col-md-6">
<div class="form-group custform">
<label>Available from <span class="req">*</span></label>
<input type="text" class="form-control" id="start_date" name="start_date" readonly required> 
</div>
</div>
<div class="col-md-6">
<div class="form-group custform">
<label>Available to <span class="req">*</span></label>
<input type="text" class="form-control" id="end_date" name="end_date" readonly required> 
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Number of Beds</label>
<select name="no_of_beds" class="form-control">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group custform">
<label>Number of Rooms</label>
<select name="no_of_rooms" class="form-control">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select> 
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>VAT applied (%)</label>
<input type="number" step="1" min="0" max="35" value="20" name="vat" class="form-control">    
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Deposit Required for booking (%) <span class="req">*</span></label>
<input type="number"  step="0.1" min="0.0" max="1.0"
       name="deposit" class="form-control" placeholder="Values from 0.0 to 1.0 e.g. 0.2 = 20%">  
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Room image Url</label>
<input type="text" class="form-control" id="room_image" name="room_image"
       value="<?php echo $img_url;?>"readonly> 
</div>
</div>
<input type="hidden" name="action" value="3">
<button class="btn btn-primary pull-right" type="submit" name="submit" value="submit">Submit</button>    
</form>
</div>
</div>
</div>
<?php
if(isset($_SESSION['image'])){
unset($_SESSION['image']);
}
?>

<?php require "inc/admin-js-calls.php"?>
<script>
$('document').ready(function(){
   
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



});
</script>
</body>
</html>