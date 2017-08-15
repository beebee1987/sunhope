


 /*=========================*/
     /*====main navigation hover dropdown====*/
     /*==========================*/
    $(document).ready(function () {
	
	$('.js-activated').dropdownHover({
		instantlyCloseOthers: false,
		delay: 0
	}).dropdown();
	
});

 /*=========================*/
     /*====flex main slider====*/
     /*==========================*/
    $('.slider-main,.testimonials').flexslider({
      slideshowSpeed: 3000,
      directionNav: false,
      animation: "fade"
    });
    
     /*=========================*/
     /*========portfolio mix====*/
     /*==========================*/
    $('#grid').mixitup();
    
       /*=========================*/
     /*========tooltip and popovers====*/
     /*==========================*/
    $("[data-toggle=popover]").popover();
    
    $("[data-toggle=tooltip]").tooltip();

   /*=========================*/
     /*========flex-gallery slide====*/
     /*==========================*/
 $(window).load(function() {
$('.flexslider').flexslider({
    directionNav: false,
    slideshowSpeed: 3000,
    animation: "fade"
});
});


