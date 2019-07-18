<?php

require "../Controllers/RouteGenerator.php";
use App\Controllers\RouteGenerator;

RouteGenerator::check_user();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Documentation</title>
<meta name="description" content="">    
<?php require "inc/admin-meta.php";?>

<style>

h1.page-title{
    
margin-bottom: 30px;
font-size: 22px;
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

@media (max-width: 991px) {

div.page-cont{

margin-bottom: 30px;    
padding: 20px 10px;
border: none;
border-radius: 3px;
}

h1.page-title{
 
padding: 10px;
font-size: 18px;
margin: 25px 0;
}
}
    
  
</style>
</head>
<body>
<?php require "partial/header.php"?>
<div class="container">
<div class="row">
<div class="col-md-12">
<h1 class="page-title"><i class="fas fa-caret-right"></i>&nbsp;
Documentation</h1>
</div>
</div>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<h2>Contents</h2>
<ol>
<li><a href="#prequisities">Prequisities</a></li>
<li><a href="#signup">Sign Up Process</a></li>
<li><a href="#configuration">Configuration </a></li>
<li><a href="#rooms">Editing Rooms</a></li>
<li><a href="#reservations">Reservations</a></li>
<li><a href="#clients">Clients</a></li>
<li><a href="#themes">Themes</a></li>
<li><a href="#links">Application Links</a></li>
<li><a href="#support">Support</a></li>
</ol>
</div>
</div>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<h2 id="prequisities">Prequisities</h2>
<p>1. You have succesfully created a production Account with
<a href="https://www.braintreepayments.com" target="blank">Braintree</a>.</p>
<p>2. The Nodelook Application is uploaded to the root folder of you Server.</p>
<p>3. A button or link has been added to your main website pointing to the Clients Side Page of Nodelook
Application. See the last Section of this Document for more info.</p>
<p>4. A Database and a Database User dedicated to Nodelook Application has been created on your website server.</p>
<p>In case you do not know how to complete steps 2, 3 and 4, you can ask your web developer or
administrator to do this for you.</p>
<p>We can complete steps 2, 3 and 4 as well for you at no extra cost.</p>
<p>5. An SSL Certificate to be installed on your website (your website url starts with https://).</p>

<h2 id="signup">Sign Up Process</h2>
<p>1. In Braintree Website, after you have logged in,  on the top right corner click your User Icon</p>
<p>2. Select "My User" from the dropdown menu</p>
<p>3. Scroll Down to the Section "API Keys, Tokenization Keys, Encryption Keys" and click "View Authorizations"</p>
<p>4. Click on the button "Generate Api Keys"</p>
<p>5. Repeat steps 1, 2 and 3.</p>
<p>6. Copy and Paste carefully the Merchant Id, Private and Public Key as shown in the image below,
in to the "config.ini" (Section Payment) file inside main Nodelook folder.</p>
<p>7. Copy and Paste carefully your Database credentials in to the "config.ini" file (Section Database) inside main Nodelook folder.</p>
<p>8. Complete the Nodelook Sign up process.</p>

<img src="" alt="Braintree Directions">

<h2 id="configuration">Configuration</h2>
<p>After you have succesfully logged in into Nodelook Application you must configure your
settings for the Application to work properly.</p>
<p>Click on "Configuration" on the top menu or by selecting the relevant icon from the Dashboard Page.</p>
<p><strong>Step 1:</strong> Just select the number of each type of available rooms of your Hotel or Rooms To Let</p>
<p><strong>Step 2:</strong> Complete the required Information - Room Number and Room Floor - and
click Ok for each Room, as shown in the image below.</p>
<img src="" alt="Step 2 Directions">
<p>Please note that these two pages, Step One and Step Two, are shown to the Administrator only in
the first time Configuration is visited. Once these two steps are completed, then the administrator every time he/she clicks
on "Configuration" will automatically be transferred to the Step 3 Page of the Configuration
Process, which is mentioned in the next paragraph.</p>
<p><strong>Step 3:</strong> Select the first Room and click "Edit".</p>

<h2 id="rooms">Editing Rooms</h2>
<p>You can upload your own image for each room or leave the default one. For better display results
the image you upload - should you choose to do so - must be at a resolution of 1280px x 720px.</p>
<p><strong>Room Availability Start Date:</strong> If you are a Full Season Operating Facility, select the
date you uploaded the Application to your Server.</p>
<p><strong>Room Availability Start Date:</strong> If you are a Season Operating Facility, select the
date you expect your Facility to start accepting Reservations.</p>
<p><strong>Room Availability End Date:</strong> If you are a Full Season Operating Facility, select a
date in the future but before 31 of December of 2028.</p>
<p><strong>Room Availability End Date:</strong> If you are a Season Operating Facility, select the
date you expect your Facility to stop accepting Reservations. </p>
<p>Note for Season Operating Facilities: after current season end date, set the start and end dates for next season early enough, for
example at least 5 months before next season start day.</p>
<p><strong>Room Price Field:</strong> Accepts positive integer values</p>
<p><strong>Number of Beds Field: </strong> Applicable only to Studio. Leave default otherwise</p>
<p><strong>Number of Rooms Field: </strong> Applicable only to Studio. Leave default otherwise</p>
<p><strong>Vat Applied Field: </strong> Accepts positive integer values</p>
<p><strong>Deposit Required for booking Field: </strong> Take special care with this field.
If you require a deposit to be made by the user at the time of Reservation by credit card, update
this field. It accepts float values between 0.0 ansd 1.0. For example if you select 0.2, this
value means 20% of the Total Price of the Reservation excluding VAT.</p>
<p>Select one of the three Options at the bottom and click Submit.</p>
<p>Please continue this process as appropriate.</p>

<h2 id="reservations">Reservations</h2>
<p>In the web page "View Reservations" you can see information about your current reservations.</p>
<p>In this page there is a column called "Free Room".</p>
<p>If the current Date matches the Date of Checkout of a Reservation, you will see the Icon
of this column blinking.</p>
<p>If you click on it you make the Check Room Availability Algorithm work faster.</p>
<p><strong>Important: </strong>For Nodelook Application to function correctly, if you are making a
Reservation over Phone, you must use the "Create Application" web page.</p>
<p><strong>Important: </strong>For Nodelook Application to function correctly, if you are using a third 
party Reservations Online Tool, you must use the "Create Application" web page to update Nodelook with
these Reservations as well.</p>

<h2 id="clients">Clients</h2>
<p>In the web page "View Clients" you can see information about your clients.</p>
<p>Attempting to Delete a Client will result to an error indicating that you must first delete
the Reservations that the specific Client is involved.</p>
<p>Please act accordingly.</p>

<h2 id="themes">Themes</h2>
<p>The Application supports two Background Themes for the Client Side of the Application.</p>
<p>By Default the Summer Theme is enabled.</p>
<p>If you wish to switch to Winter Theme you can do so from the View Rooms Page.</p>

<h2 id="links">Links to the Application</h2>
<p><strong>Administrator Section/Page:</strong> https://example.com/nodelook/app/admin</p>
<p><strong>Client Section/Page:</strong> https://example.com/nodelook/app/client</p>
<p>Replace in the above example links <strong>example.com</strong> with <strong>your website url</strong>.</p

<h2 id="support">Support and Contact SYSTEMSignite</h2>
<p>For further support you can contact us by clicking <a href="https://systemsignite.gr/en/support" target="blank">here</a></p>
<p>For further information you can contact us by clicking <a href="https://systemsignite.gr/en/contact" target="blank">here</a></p>

</div>
</div>
</div>

<?php require "inc/admin-js-calls.php"?>
</body>
</html>
