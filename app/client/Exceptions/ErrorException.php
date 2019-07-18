<?php

namespace App\Client\Exceptions;

class ErrorException extends \Exception{
    
    
    public function __construct(){
        
       
    }
    
    public function __destruct(){
        
    }
    
    public function get_message(){
        
         require "Errors/Error.php";
         die();
    }
}


?>