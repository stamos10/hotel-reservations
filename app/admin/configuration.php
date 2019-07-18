<?php

require "../Controllers/RouteGenerator.php";
use App\Controllers\RouteGenerator;
RouteGenerator::check_user();
$message = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Initial Configuration Step 1</title>
<meta name="description" content="">    
<?php require "inc/admin-meta.php";?>

<style>
    
div.step{
 
position: relative;
left: 80%;
top: 0;
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

label{
    
width: 150px;
font-weight: 400;
}

input.num{

width: 100px;
margin: 10px 0px;
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
<div class="col-md-8 col-md-offset-2 page-cont">
<div class="step">
 Step 1 of 3   
</div>
<?php

if($message!= null){
 echo $message;
}
?>
<h1 class="page-title"><i class="fas fa-caret-right"></i>&nbsp;
Please Select Number Of Rooms</h1> 
<form action="<?php echo RouteGenerator::set_request('HandleConfiguration.php')?>" method="POST">
<div class="form-group">
<label>One Bed</label> <input type="number" name="one_beds" id="one_beds" value="0" min="0" max="30" class="num"></br>
</div>
<div class="form-group">
<label>Two Beds</label> <input type="number" name="two_beds" id="two_beds" value="0" min="0" max="30" class="num"></br>
</div>
<div class="form-group">
<label>Three Beds</label> <input type="number" name="three_beds" id="three_beds" value="0" min="0" max="30" class="num"></br>
</div>
<div class="form-group">
<label>Four Beds</label> <input type="number" name="four_beds" id="four_beds" value="0" min="0" max="30" class="num"></br>
</div>
<div class="form-group">
<label>Studio</label> <input type="number" name="studio" id="studio" value="0" min="0" max="30" class="num"></br>
</div>
<input type="hidden" name="action" value="1">
<button type="submit" name="submit" id="submit" value="submit" class="btn btn-warning pull-right">Next</button>   
</form>
</div>

<?php require "inc/admin-js-calls.php"?>
</body>
</html>