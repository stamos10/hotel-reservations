<?php
$base_url = $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);

function url($file){
    
    $url = "http://" .$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']) . "/" . $file . ".php";
    return htmlspecialchars($url);
}
?>