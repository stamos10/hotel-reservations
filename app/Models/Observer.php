<?php

namespace App\Models;

class Observer{
    
    
    
    public function __construct(){
        
     
    }
    
    public function __destruct(){

       
    }
    
    
    public static function evaluate_user($username){
        
        
        if(!isset($username) || empty($username)){
            header("location: user/signin.php");
            exit;
        }
    }
    
    public static function evaluate_token($token){
        
        
        if(!isset($token) || empty($token)){
            header("location: http://localhost/admin/user/signin.php");
            exit;
        }else{
		$data = $token;
		$data_a = $data[1];
		$data_b = $data[3];
		if(preg_match("/^[0-9]*$/",$data_a) && preg_match("/^[0-9]*$/",$data_b)){
			return true;
		}else{
		  header("location: http://localhost/admin/user/signin.php");
            exit;
		}
		
	   }
	  return false;
    }
    
    public static function generate_token(){
        
        $username = "";
        $token = null;
        if(isset($_SESSION['username'])){
            
            $username = $_SESSION['username'];
        }
       
        $username_length = strlen($username);
        
        if($username_length > 0){
            
            $username_section_a = substr($username, 0, ($username_length / 2));
            $username_section_b = substr($username, (($username_length / 2)), $username_length);
            $stone_o = rand(20, 30);
            $stone_a = rand(20, 30);
		  $stone_b = rand(40, 50);
						
		  $tok =  $stone_o . $username_section_a . $stone_a . $username_section_b . $stone_b;
		  $toke = password_hash($tok, PASSWORD_DEFAULT);
		  $token = $stone_o . $stone_a . $toke . $stone_b;
        }
        
        return $token;
    }
}
?>