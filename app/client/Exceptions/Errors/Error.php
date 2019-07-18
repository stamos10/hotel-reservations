<!DOCTYPE html>
<html lang="en">
<head>
<title>Server Error</title>
<meta name="description" content="">    
<?php require $_SERVER['DOCUMENT_ROOT']."/nodelook/app/client/inc/meta1.php";?>
<?php require $_SERVER['DOCUMENT_ROOT']."/nodelook/app/client/inc/meta2.php";?>

<style>
    
.fa-frown{
    
    font-size: 24px;
    color: #FFFFFF;
    font-weight: 600;
    margin: 0 20px;
}
.alert-danger{
 
 position: absolute;
 top: 35%;
 left: 0;
 width: 100%;
 padding: 40px 30px;
 text-align: center;
 background-color: #da6a8a;
 color: #FFFFFF;
}
</style>
</head>
<body>
<div class="container">
<div class="alert alert-danger">
 <i class="far fa-frown"></i>&nbsp;&nbsp;We are sorry! It seems the Application is not yet configured.</br>
 Please try again later...    
</div>
</div>
<?php require $_SERVER['DOCUMENT_ROOT']."/nodelook/app/client/inc/js-calls.php"?>
</body>
</html>