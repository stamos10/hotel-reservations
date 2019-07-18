<?php

use App\Controllers\RouteGenerator;

?>
<div class="mobile-menu-btn">
    <p style="font-size: 20px;" id="show-mmenu"><i class="fas fa-caret-right"></i></p>
    <p style="font-size: 20px;" id="close-mmenu"><i class="fas fa-caret-left"></i></p>
    <p style="margin-top: -7px;">Menu</p>
</div>
<header>
<nav>
<ul class="menu">
<li><a href="<?php echo RouteGenerator::set_url('dashboard.php');?>"><i class="fas fa-toolbox"></i>&nbsp;Dashboard</a></li>
<li><a href="<?php echo RouteGenerator::set_url('rooms.php');?>"><i class="fas fa-list"></i>&nbsp;View Rooms</a></li>
<li><a href="<?php echo RouteGenerator::set_url('view-clients.php');?>"><i class="fas fa-list"></i>&nbsp;View Clients</a></li>
<li><a href="<?php echo RouteGenerator::set_url('view-reservations.php');?>"><i class="fas fa-list"></i>&nbsp;View Reservations</a></li>
<li><a href="<?php echo RouteGenerator::set_url('create-reservation.php');?>"><i class="far fa-edit"></i>&nbsp;New Reservation</a></li>
<li><a href="<?php echo RouteGenerator::set_url('documentation.php');?>"><i class="far fa-question-circle"></i>&nbsp;Help</a></li>
</ul>
<ul class="mobile-menu">
<li><a href="<?php echo RouteGenerator::set_url('dashboard.php');?>"><i class="fas fa-toolbox"></i>&nbsp;Dashboard</a></li>
<li><a href="<?php echo RouteGenerator::set_url('rooms.php');?>"><i class="fas fa-list"></i>&nbsp;View Rooms</a></li>
<li><a href="<?php echo RouteGenerator::set_url('view-clients.php');?>"><i class="fas fa-list"></i>&nbsp;View Clients</a></li>
<li><a href="<?php echo RouteGenerator::set_url('view-reservations.php');?>"><i class="fas fa-list"></i>&nbsp;View Reservations</a></li>
<li><a href="<?php echo RouteGenerator::set_url('create-reservation.php');?>"><i class="far fa-edit"></i>&nbsp;New Reservation</a></li>
<li><a href="<?php echo RouteGenerator::set_url('documentation.php');?>"><i class="far fa-question-circle"></i>&nbsp;Help</a></li>
</ul>
<div>
<a href="user/signout.php" id="signout" data-toggle="tooltip" data-placement="bottom" title="Sign Out">
<i class="fas fa-sign-out-alt"></i>
</a>
</div>
</nav>
<div class="row hidden-sm hidden-xs">
<div class="col-md-3 promo">
<img src="../images/nodelook.png" alt="Welcome to Nodelook">   
</div>
<div class="col-md-4 col-md-offset-5 logo">
<img src="../images/reception.jpg" alt="Hotel Book Online System">
</div>
</div>
</header>
<div class="row hidden-md hidden-lg">
<div class="col-md-8 promo-mobile">
<img src="../images/nodelook.png" alt="Welcome to Nodelook"> 
</div>
<div class="col-md-4 logo-mobile">
<img src="../images/reception.jpg" alt="Hotel Book Online System">
</div>
</div>  