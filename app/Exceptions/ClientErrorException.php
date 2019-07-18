<?php

namespace App\Exceptions;

class ClientErrorException extends \Exception{
    
    
    public function __construct(){
        
       
    }
    
    public function __destruct(){
        
    }
    
    public function get_message(){
        
         require "Errors/ClientError.php";
         die();
    }
}


?>