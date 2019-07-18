<?php

namespace App\Models;

require "Interfaces/Validator.php";
use \App\Models\Interfaces\Validator;

class FormHandler implements Validator{
    
 
 
    function __construct(){
        
        
    }
    
    function __destruct(){
        
        
    }
    
    function prepare_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    function process_input($request_input){
        
        $request_input_error = "";
        $data = $request_input;
        if (empty($data) || !isset($data)) {
        $request_input_error = "N/A";
        return $request_input_error;
        }else{
        
         return $data;    
        }
    }
    
    function validate_str($request_input){
        
        $request_input_error = "";
        $data = $request_input;
        if (!preg_match("/^[a-zA-Z ]*$/",$data)) {
        $request_input_error = "Only letters and white space allowed";
        return $request_input_error;
        }else{
        
         return $data;
        }
    }
    
     function validate_number($request_input){
        
        $request_input_error = "";
        $data = $request_input;
        if (!preg_match("/^[0-9]*$/",$data)) {
        $request_input_error = "Only numbers allowed";
        return $request_input_error;
        }else{
        
         return $data;
        }
    }
    
    function validate_email($request_input){
        
        $request_input_error = "";
        $data = $request_input;
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
        $request_input_error = "Invalid email format";
        return $request_input_error;
        }else{
        
         return $data;
        }
        
    }
    
    function validate_url($request_input){
        
        $request_input_error = "";
        $data = $request_input;
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$data)) {
        $request_input_error = "Invalid URL format";
        return $request_input_error;
        }else{
        
         return $data;
        }
    }
    
    
 
 
   
}
?>