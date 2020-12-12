/*
*
* Custom js snippets for Startuply v1.1
* by Vivaco 
*
*/
(function(){
	"use strict";
	// Init global DOM elements, functions and arrays
    window.app 			         = {el : {}, fn : {}};
	app.el['window']         = $(window);
	app.el['document']       = $(document);
    app.el['loader']         = $('#loader');
    app.el['mask']           = $('#mask');
	
	app.fn.screenSize = function() {
		var size, width = app.el['window'].width();
		if(width < 320) size = "Not supported";
		else if(width < 480) size = "Mobile portrait";
		else if(width < 768) size = "Mobile landscape";
		else if(width < 960) size = "Tablet";
		else size = "Desktop";
		// $('#screen').html( size + ' - ' + width );
		// console.log( size, width );
	};	
	
    //Preloader
    app.el['loader'].delay(700).fadeOut();
    app.el['mask'].delay(1200).fadeOut("slow");    
      
		// Resized based on screen size
		app.el['window'].resize(function() {
			app.fn.screenSize();
		});		
      

    
    // Headhesive init
    var options = {  // set options
            offset: '#showHere',
            classes: {
                clone:   'fixmenu-clone',
                stick:   'fixmenu-stick',
                unstick: 'fixmenu-unstick'
            }
        };
	
	if($('#registration').length == 0) {
		var fixmenu = new Headhesive('.navigation-header', options); // init
	}

    
    // Animated Appear Element
	if (app.el['window'].width() > 1024){
		
		$('.animated').appear(function() {
		  var element = $(this);
		  var animation = element.data('animation');
		  var animationDelay = element.data('delay');
		  if(animationDelay) {
			  setTimeout(function(){
				  element.addClass( animation + " visible" );
				  element.removeClass('hiding');
			  }, animationDelay);
		  } else {
			  element.addClass( animation + " visible" );
			  element.removeClass('hiding');
		  }               

		}, {accY: -150});
    
	} else {
	
		$('.animated').css('opacity', 1);
		
	}
	
    // fade in .back-to-top
    $(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });

    // scroll body to 0px on click
    $('.back-to-top').click(function () {
        $('html, body').animate({
            scrollTop: 0,
            easing: 'swing'
        }, 750);
        return false;
    });   

})();