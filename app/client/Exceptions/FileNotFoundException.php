<?php

namespace App\Client\Exceptions;

class FileNotFoundException extends \Exception{
    
    
    public function __construct(){
        
       
    }
    
    public function __destruct(){
        
    }
    
    public function get_message(){
        
         require "Errors/FileNotFound.php";
         die();
    }
}


?>