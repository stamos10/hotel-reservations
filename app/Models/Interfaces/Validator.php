<?php

namespace App\Models\Interfaces;

interface Validator{
    
    
    public function prepare_input($data);
    public function process_input($request_input);
    public function validate_str($request_input);
    public function validate_number($request_input);
    public function validate_email($request_input);
    public function validate_url($request_input);
                 
}
?>