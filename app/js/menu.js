$(document).ready(function(){
    
$('#show-menu').on('click', function(){
    
$('header').animate({left: '0%'}, 800);   
$('#show-menu').css({"display" : "none"});
$('#close-menu').fadeIn(1500).css({"display" : "block"});


$('#close-menu').on('click', function(){
    
$('header').animate({left: '-30%'}, 500);
$('#close-menu').css({"display" : "none"});
$('#show-menu').fadeIn(1500).css({"display" : "block"});
});
});


$('#show-mmenu').on('click', function(){
    
$('header').animate({left: '0%'}, 800);   
$('#show-mmenu').css({"display" : "none"});
$('#close-mmenu').fadeIn(1500).css({"display" : "block"});


$('#close-mmenu').on('click', function(){
    
$('header').animate({left: '-100%'}, 500);
$('#close-mmenu').css({"display" : "none"});
$('#show-mmenu').fadeIn(1500).css({"display" : "block"});
});
});

    
});