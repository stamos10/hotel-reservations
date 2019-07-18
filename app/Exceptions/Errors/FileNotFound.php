<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Not Found Error 404</title>
<meta name="description" content="">    
<?php require $_SERVER['DOCUMENT_ROOT']."/nodelook/app/admin/inc/admin-meta.php";?>

<style>
    
.fa-frown{
    
    font-size: 24px;
    color: #FFFFFF;
    font-weight: 600;
    margin: 0 20px;
}
.alert-danger{
 
 margin: 80px 0;
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
 <i class="far fa-frown"></i>&nbsp;&nbsp;The File you are looking was not found on this Server    
</div>
</div>
<?php require $_SERVER['DOCUMENT_ROOT']."/nodelook/app/admin/inc/admin-js-calls.php"?>
</body>
</html>