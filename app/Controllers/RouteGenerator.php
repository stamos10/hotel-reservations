<?php

namespace App\Controllers;

require "../Models/Observer.php";
use App\Models\Observer;

class RouteGenerator {
    
    
    

    public static function set_url($file){
   
    $url = "https://" .$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']) . "/" . $file;
    
    return htmlspecialchars($url);
    
    
    }
    
    public static function set_request($file){
        
    $url = "https://" .$_SERVER['HTTP_HOST']. "/nodelook/app/Controllers/" . $file;
    
    return htmlspecialchars($url); 
    }
    
    public static function set_redirect($file){
        
    $url = "https://" .$_SERVER['HTTP_HOST']. "/nodelook/app/client/" . $file;
    
    return htmlspecialchars($url); 
    }
    
    public static function set_admin_redirect($file){
        
    $url = "https://" .$_SERVER['HTTP_HOST']. "/nodelook/app/admin/" . $file;
    
    return htmlspecialchars($url); 
    }
    
    public static function set_reset_url($file){
        
    $url = "https://" .$_SERVER['HTTP_HOST']. "/nodelook/app/admin/user/" . $file;
    
    return htmlspecialchars($url); 
    }
    
    public static function check_user(){
    session_start();
    if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    }

    Observer::evaluate_user($username);
    }
    

}

?>