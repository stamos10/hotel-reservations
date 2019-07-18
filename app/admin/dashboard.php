<?php

require "../Controllers/RouteGenerator.php";
require "../Controllers/HandleConfiguration.php";
use App\Controllers\RouteGenerator;
use App\Controllers\HandleConfiguration;

RouteGenerator::check_user();
$handler = new App\Controllers\HandleConfiguration();
$check = $handler->check_visited();
$visited = $check->rowCount();

$message = null;
if(isset($_GET['message'])){
 $message = $_GET['message'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Control Panel</title>
<meta name="description" content="">    
<?php require "inc/admin-meta.php";?>

</head>
<body>
<?php require "partial/header.php"?>
<div class="container">
<div class="row">
<div class="col-md-12">
<?php
if($message != null){
echo '<div class="alert alert-success" style="30px 0;">' .  $message . '</div>';
}
?>

<div class="option first">    
<a href="<?php
if($visited == 0){
echo RouteGenerator::set_url('configuration.php');
}else{
echo RouteGenerator::set_url('rooms.php');    
}
?>">
<img src="../images/customize.png" alt="App basic configuration" class="blur">
</a>
<a href="
<?php
if($visited == 0){
echo RouteGenerator::set_url('configuration.php');
}else{
echo RouteGenerator::set_url('rooms.php');    
}
?>" class="s-btn">Configuration</a>
</div>

<div class="option">    
<a href="<?php echo RouteGenerator::set_url('view-reservations.php');?>">
<img src="../images/view.png" alt="View reservations" class="blur">
</a>
<a href="<?php echo RouteGenerator::set_url('view-reservations.php');?>" class="s-btn">View Reservations</a>
</div>

<div class="option">    
<a href="<?php echo RouteGenerator::set_url('create-reservation.php');?>">
<img src="../images/create.png" alt="Create a reservation" class="blur">
</a>
<a href="<?php echo RouteGenerator::set_url('create-reservation.php');?>" class="s-btn">New Reservation</a>
</div>

</div>
</div>

</div>
<?php require "partial/footer.php"?>
<?php require "inc/admin-js-calls.php"?>
</body>
</html>