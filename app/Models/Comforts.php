<?php

namespace App\Models;

class Comforts{
     
    private $comforts = array();
    
    public function __construct(){
        
        
    }
    
    public function __destruct(){
        
        
    }
    
    public function addComfort($value){
      
      $value = trim($value);
      if(!in_array($value, $this->comforts)){
      array_push($this->comforts, $value);
      }
    }
    
    public function getComforts(){
      
      return $this->comforts;
    }
}

?>