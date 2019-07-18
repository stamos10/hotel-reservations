<?php

require "Exceptions/ErrorException.php";
require "../Controllers/RouteGenerator.php";
require "../Models/Connection.php";
require "../Models/Theme.php";

use App\Client\Exceptions\ErrorException;
use App\Controllers\RouteGenerator;
use App\Models\Connection;
use App\Models\Theme;

$conn = new Connection();
if($conn == null){
try{
throw new ErrorException;
}catch(ErrorException $e){
echo $e->get_message();
die();
} 
}
$con = $conn->getConnection();
$themes = new Theme($con, null);



$theme = json_decode($themes->fetch_theme());
foreach($theme as $th){
if($th->theme == "summer"){
header("location: " . RouteGenerator::set_redirect("welcome.php"));    
}else if($th->theme == "winter"){
header("location: " . RouteGenerator::set_redirect("welcome-2.php"));
}else{
try{
throw new ErrorException;
}catch(ErrorException $e){
echo $e->get_message();
}
}
}
?>