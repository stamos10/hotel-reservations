<?php

namespace App\Controllers;

abstract class Handler {
    
    
    public function get_contents(){
        
        $data = json_decode(file_get_contents("php://input"));
        
        return $data;
    }
}


?>