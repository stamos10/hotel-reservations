<?php

require "../Controllers/RouteGenerator.php";
require "../Controllers/HandleReservations.php";
use App\Controllers\RouteGenerator;
use App\Controllers\HandleReservations;
RouteGenerator::check_user();
$handler = new HandleReservations();
$data = json_decode($handler->fetch_clients());

$message = null;
$search_results = null;

if(!empty($_GET['message'])){
 $message = '<div class="alert alert-success" style="margin:30px 0;">' . $_GET['message'] . '</div>';
}

if(isset($_POST['search'])){
$email = $_POST['email'];
$search_results = json_decode($handler->search_client($email));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Clients Information</title>
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

table.table tr td{
 
 padding: 20px 10px;
}

table tr td.del>a{

color: #FF0000;
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
View Clients</h1>
</div>
</div>

<div class="row">
<div class="col-md-8 col-md-offset-2">
<h2>Search Client</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="form-inline">
<div class="form-group">
<input type="email" class="form-control" id="email" name="email" placeholder="Please enter email"> 
</div>
<div class="form-group">
<button class="btn btn-primary" id="search" name="search" value="search">Search</button>    
</div>
</form>
<div class="col-md-12 table-responsive">
<?php
if($search_results != null){
echo '
<table class="table" style="margin: 30px 0;">
<tr class="success">
<td>Surname</td>
<td>First Name</td>
<td>Phone</td>
<td>Email</td>
<td>Room Number</td>
</tr>';
foreach($search_results as $sr){

echo'
<tr>
<td>' . $sr->surname . '</td>
<td>' . $sr->firstname . '</td>
<td>' . $sr->phone . '</td>
<td>' . $sr->email . '</td>
<td>' . $sr->room_number . '</td>
</tr>';

}
}
?>  
</div>
</div>
</div>
<?php
if($message != null){
echo $message;
}
?>
<div class="row">
<div class="col-md-8 col-md-offset-2 table-responsive">
<h2>Clients</h2>

<table class="table" style="margin-bottom: 30px;">
<tr class="info">
<td>Surname</td>
<td>First Name</td>
<td>Phone</td>
<td>Email</td>
<td>Room Number</td>
<td></td>
</tr>
<?php
foreach($data as $dt){

echo
'<tr>
<td>' . $dt->surname . '</td>
<td>' . $dt->firstname . '</td>
<td>' . $dt->phone . '</td>
<td>' . $dt->email . '</td>
<td>' . $dt->room_number . '</td>
<td class="del"><a href="../Controllers/delete-client.php?id=' . $dt->email . '"><i class="fas fa-trash-alt"></i></a></td>
</tr>';
}

?>
</table>
</div>
</div>

</div>

<?php require "inc/admin-js-calls.php"?>
</body>
</html>