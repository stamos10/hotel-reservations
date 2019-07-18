<?php
require "../Exceptions/ClientErrorException.php";
require "../admin/inc/check_user.php";
require "HandleReservations.php";

use \App\Controllers\HandleReservations;
use \App\Exceptions\ClientErrorException;

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$handler = new HandleReservations();
try{
$handler->delete_client($id);
}catch(\PDOException $p){
  try{
    throw new ClientErrorException();
  }catch(ClientErrorException $e){
    echo $e->get_message();
  }
}
  



$response = 'Action completed succesfully';    
        
header("location: ../admin/view-clients.php?message=" . $response);
?>