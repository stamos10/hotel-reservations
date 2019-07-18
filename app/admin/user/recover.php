<?php
require "../../Models/FormHandler.php";
require "../../Models/User.php";
require "../../Models/Connection.php";

use App\Models\FormHandler;
use App\Models\User;
use App\Models\Connection;

$id = null;
$usernamee = null;
$email = null;
$url_recover = null;
$response = null;
$error = null;
$secret = "2047";

$validator = new FormHandler();

if(isset($_POST['submit'])){
if(isset($_POST['usernamee'])){
$usernamee = $_POST['usernamee'];
$usernamee = $validator->prepare_input($usernamee);
$usernamee = $validator->validate_email($usernamee);
}
if($usernamee != null || !empty($usernamee)){
$conn = new Connection();
$conn->getConnection();
$user = new User($con);
$results = $user->fetch_user_b($usernamee);
$data = json_decode($results);
foreach($data as $dt){
    $id = $dt->id;
    $email = $dt->username;
}

if($email != null || $email != ""){
$url_r = htmlspecialchars("https://" .$_SERVER['HTTP_HOST']. "/nodelook/app/admin/user/");
$url_recover = $url_r. "recovery-step-2.php?secret=".$secret."&id=".$id."&username=".$email."&ok=1";   
$headerFields = array('MIME-Version: 1.0', 'Content-Type: text/plain;charset=utf-8');
$from = "info@systemsignite.gr";
$to = $email;
$subject = "Hotel Booking System - User Request";
$email_message = $url_recover; 
$headers = "From:" . $from;
$headers2 = "To:" . $to;
$headers = 'From: '.$from."\r\n".
'Reply-To: '.$from."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($to, '=?UTF-8?B?'. base64_encode($subject).'?=', $email_message, $headers .implode("\r\n", $headerFields));
mail($from, '=?UTF-8?B?' . base64_encode($subject).'?=',$email_message,$headers2. implode("\r\n", $headerFields));
$response = "<div class=\"alert alert-warning\">An email has been sent to your email address. Please follow the link in to your
            email to set a new password.</br><strong>Caution: This link will be active for 30 minutes only!</strong> </br>
            If you do not see an email please check your Spam folder as well</div>";
}else{
$error = "<div class=\"alert alert-danger\">We are sorry. No user was found with this email</div>";
}
}
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
<title>Sign In Process</title>
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

span.req{
    
color: #c0392b;
font-size: 16px;
font-weight: 600;
}

</style>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1 class="page-title"><i class="fas fa-caret-right"></i>&nbsp; Please enter your Email</h1> 
</div>
</div>
<div class="row">
<div class="col-md-12">
<?php
if($error != null){
 echo $error;   
}
if($response != null){
 echo  $response;   
}
?>
</div>
</div>
<div class="row">
<div class="col-md-4 col-md-offset-4">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<div class="form-group">
<label>Please enter your Email: </label> 
<input type="text" name="usernamee" class="form-control">   
</div>
<div class="form-group">
<button type="submit" name="submit" value="submit" class="btn btn-primary pull-right">Submit</button>
</div>
</form>

</div>
</div>

</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>