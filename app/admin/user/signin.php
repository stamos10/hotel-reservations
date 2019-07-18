<?php
require "../../Models/FormHandler.php";
require "../../Models/User.php";
require "../../Models/Connection.php";

use \App\Models\FormHandler;
use \App\Models\User;
use \App\Models\Connection;

$validator = new FormHandler();
$username = "";
$password = "";
$error = null;
$response = null;

if(isset($_POST['submit'])){

if(isset($_POST['username'])){
$username = $_POST['username'];
}

if(isset($_POST['password'])){
$password = $_POST['password'];
}

if(strlen($password) < 1){
    $error = "Please specify a password containing at least 7 digits";
}

if(strlen($password) < 7){
    $error = "Password must be at least 7 digits";
}

if(substr($password, 0, 1) == '0' || substr($password, 0, 1) == '1'){
    $error = "Password cannot start woth 0 or 1";
}

if(substr($password, 0, 2) == '19' || substr($password, 0, 2) == '20'){
    $error = "Password cannot start woth 19 or 20";
}

if($error != null){
   
}else{
$username = $validator->prepare_input($username);
$username = $validator->validate_email($username);
$password = $validator->prepare_input($password);
$password = $validator->validate_number($password);

$conn = new Connection();
$con = $conn->getConnection();
$user = new User($con);
$user->setUsername($username);
$user->setPass($password);
if($user->getUsername() != "Invalid email format"){
if($user->getPass() != null){
$result = $user->fetch_user($username);
$num = $result->rowCount();
if($num == 1 ){
$result = json_decode($user->fetch_it($user->getUsername()));
foreach($result as $r){
    if(password_verify($password, $r->secret_t)){
        session_start();
        $_SESSION['username'] = $user->getUsername();
        header("location: ../dashboard.php");
    }else{
       $error = "Please enter a valid password";
        
    }
}
}else{
$error = "No User was found with this email";


}
}
}else{
$error = "Please enter a valid email and/or password";

}

}


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign In</title>
<meta name="description" content="">    
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="googlebot" content="noindex">
<meta name="robots" content="noindex">
<meta name="theme-color" content="#1008bf">
<meta name="msapplication-navbutton-color" content="#1008bf">
<meta name="apple-mobile-web-app-status-bar-style" content="#1008bf">
<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../css/style.css">
<link rel="stylesheet" href="../../css/mobile.css">

<style>

h1.page-title{
    
margin-bottom: 30px;
font-size: 18px;
color: #2471a3;
font-weight: 400;
}


h2{
    
color: #101010;
}

h3{
    
font-size: 16px;
font-weight: 400;
background-color: #2e86c1;
color: #FFFFFF;
text-align: center;
}

p{
    
font-size: 14px;
font-weight: 400;
line-height: 20px;
margin: 8px 0;
color: #404040;
}

p.prompt{

font-size: 14px; 
}

span.req{
    
color: #c0392b;
font-size: 16px;
font-weight: 600;
}

label.pas{
    
    color: #FFFFFF;
}

div.keyboard-container{

display: block;
width: 100%;
margin: 15px 0;
padding: 15px 0;
background-color: #FFFFFF;
}

div.key{
    
display: inline-block;
width: 30%;
padding: 12px;
margin: 3px;
font-size: 12px;
font-weight: 600;
text-align: center;
color: #FFFFFF;
background-color: #2471a3;
border: solid 1px #2471a3;
border-radius: 2px;
outline: none;
}

div.key:hover{
 
cursor: pointer;
color: #FFFFFF;
background-color: #e67e22;
border: solid 1px #e67e22;
outline: none;
}

div.key:focus{
 
cursor: pointer;
color: #FFFFFF;
background-color: #e67e22;
border: solid 1px #e67e22;
outline: none;
}


div.status{
    
    display: block;
    width: 10%;
    float: right;
}

div.status-red{
    
display: inline-block;
padding: 5px;
border-radius: 90px;
background-color: #FF0000;
}

div.status-green{
    
display: inline-block;
padding: 5px;
border-radius: 90px;
background-color: #00FF00;;
}

@media (max-width: 671px) {
 
div.key{
    
width: 30%;
padding: 12px;
margin: 2px;
}
 
p.prompt{

font-size: 10px; 
}
 
}

</style>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1 class="page-title"><i class="fas fa-caret-right"></i>&nbsp; Sign In</h1> 
</div>
</div>
<div class="row">
<div class="col-md-12">
<?php
if($error != null){
 echo ' <div class="alert alert-danger" style="margin:30px 0;">' . $error . '</div>';   
}
if($response != null){
 echo ' <div class="alert alert-success" style="margin:30px 0;">' . $response . '</div>';   
}
?>
</div>
</div>
<div class="row">
<div class="col-md-4 col-md-offset-4">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" id="signup" autocomplete="off">
<input autocomplete="false" name="hidden" type="text" style="display:none;">
<div class="form-group">
<label>Email:<span class="req">*</span></label>
<input type="email" name="username" class="form-control" required>    
</div>

<div class="keyboard-container">
<div class="form-group">
<label>Password: <span class="req">*</span></label>
<div class="status">
<div class="status-red"></div>
<div class="status-green"></div>
</div>
<div style="clear:both;"></div>
<input type="password" id="password" name="password" class="form-control" readonly required>    
</div>
<div class="key">1</div>
<div class="key">2</div>
<div class="key">3</div>
<div class="key">4</div>
<div class="key">5</div>
<div class="key">6</div>
<div class="key">7</div>
<div class="key">8</div>
<div class="key">9</div>
<div class="key">0</div>
<div class="key" id="clear">clear</div>
</div>
<div class="col-md-12">
<p class="prompt" id="prompt-a"><i class="fas fa-caret-right"></i>&nbsp;Password must be at least 7 digits</p>
<p class="prompt" id="prompt-b"><i class="fas fa-caret-right"></i>&nbsp;Password cannot start with digits <strong>19</strong> or <strong>20</strong></p>
<p class="prompt" id="prompt-c"><i class="fas fa-caret-right"></i>&nbsp;Password cannot start with digits <strong>0</strong> or <strong>1</strong></p>
</div>
<div class="form-group">
<button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary pull-right">Sign In </button>    
</div>
<p style="clear:both;"></p>
<p class="prompt" style="margin:40px 0 0 0;float:right;">Do not have an account? <a href="signup.php">Sign Up</a></p>
<p style="clear:both;"></p>
<p class="prompt" style="font-size: 10px;float:right;">Forgot your password? Click<a href="recover.php"> here</a></p>
</form>
</div>
</div>

</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$('document').ready(function(){

var red_id;
var green_id;
var length = 0;
var value = "";
var value_set = "";

function blink_red() {
    $('.status-red').fadeOut(500);
    $('.status-red').fadeIn(500);
}

function blink_green() {
    $('.status-green').fadeOut(500);
    $('.status-green').fadeIn(500);
}

$('.key').on('click' ,function(){

value += $(this).html();
$('#password').val(value);
value_set = $('#password').val(value);
check_length();
  
});

$('#clear').on('click' ,function(){

value = "";
length = 0;
$('#password').val(value);
value_set = $('#password').val(value);
check_length();
});


function check_length() {
    
    length = $('#password').val().length;
    decide_action(length);
    return length;
}

function decide_action(length) {

reset();
if (length < 7) {
if (length == 1) {
if (value_set.val() == '0' || value_set.val() == '1') {
alert("Password cannot start with 0 or 1");
value = "";
$('#password').val(value);
value_set = $('#password').val(value);
}
}
if (length < 3) {
if (value_set.val() == "19" || value_set.val() == "20") {
alert("Password cannot start with 19 or 20");
value = "";
$('#password').val(value);
value_set = $('#password').val(value);
}
}
$('.status-green').css({"display" : "none"});
red_id = setInterval(blink_red, 1000);
}else{
$('.status-red').css({"display" : "none"});
green_id = setInterval(blink_green, 500);
}

 return length;
}

function reset() {
    
clearInterval(red_id);
clearInterval(green_id); 
}



});
</script>
</body>
</html>