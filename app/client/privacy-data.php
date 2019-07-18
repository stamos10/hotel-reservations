<?php

require "../Controllers/RouteGenerator.php";
use App\Controllers\RouteGenerator;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Policies</title>
<meta name="description" content="">    
<?php require "inc/meta1.php";?>
<?php require "inc/meta2.php";?>


<style>
  
 .container{
 
 padding: 80px 60px; 
 }

h1.page-title{
    
margin: 40px 0;
font-size: 18px;
color: #000000;
font-weight: 600;
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

.bordered{
                    
padding: 20px 0;
border-bottom: solid 1px #808080;
}

span.req{
    
color: #c0392b;
font-size: 16px;
font-weight: 600;
}

span.field-value{
    
float: right;
color: #101010;
}

@media (max-width: 991px) {
 
.container{
 
padding: 130px 10px; 
}
}
  
</style>
</head>
<body>
<div class="logo">
<a href="<?php echo RouteGenerator::set_url('welcome.php')?>"><img src="../images/nodelook.png" alt="Welcome to Nodelook"></a>   
</div>
 
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<h1 class="page-title">Data Protection Policy &amp; Cookies</h1>
<h2>Use of Cookies</h2>
<p>This Application uses cookies. These are small harmless files that cannot damage your device. </p>
<p> Certain sections of this Application may not function correctly if you do not accept the use of cookies.</p>
<p>You can find information on deleting or controlling cookies at: <a href="http://www.aboutcookies.org" target="_blank">www.AboutCookies.org</a>.</p>
<h2>Analytics</h2>
<p> This Application does not use analytics.</p>
<h2>Reservation</h2>
<p> When making a Reservation with this Application the following personal data are stored:</p>
<p>Surname</p>
<p>First Name</p>
<p>Email</p>
<p>Phone</p>
<p>If you do not wish your personal data to remain out our database you can ask from the reception
to delete your data when you Check Out or in the event of Reservation Cancellation.</p>
<p>This Application uses Braintree to process credit card payments.</p>
<p>You can read more about Braintree <a href="https://www.braintreepayments.com" target="blank">here</a></p>
<p>This Application does not store any data related to Credit Card Information</p>
<h2>Payment Refund</h2>
<p>in the event of Reservation Cancellation payment refund is depended upon the Hotel or Facility
that hosts this Application Refund Policy.</p>
<h2>Disclaimer</h2>
<p>We take the necessary and anticipated measures to protect your data.
Under no circumstances shall we be liable for any kind of damages, including
but not limited to, loss of data or profit arising from or in connection with this Application.</p>
<p><a href="<?php echo RouteGenerator::set_url('welcome.php')?>">Home</a></p>
</div>
 </div>
 </div>
<?php require "inc/js-calls.php"?>
</body>
</html>