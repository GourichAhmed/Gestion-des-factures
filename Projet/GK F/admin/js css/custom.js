/**	
	* Template Name: Intensely
	* Version: 1.2	
	* Template Scripts
	* Author: MarkUps
	* Author URI: http://www.markups.io/

	Custom JS
	
	1. SEARCH BOX SLIDE
	2. HOVER DROPDOWN MENU
	3. BOOTSTRAP ACCORDION
	4. SKILL PROGRESS BAR
	5.LIGHTBOX ( FOR PORTFOLIO POPUP VIEW )
	6. MAIN SLIDER (SLICK SLIDER)
	7. LOGIN MODAL WINDOW
	8. COUNTER
	9. TESTIMONIAL SLIDER (SLICK SLIDER)
	10. CLIENTS BRAND SLIDER (SLICK SLIDER) 
	11. SCROLL TOP BUTTON
	12. PRELOADER 
	13. WOW ANIMATION	
	
**/

jQuery(function($){

	/* ----------------------------------------------------------- */
	/*  1. SEARCH BOX SLIDE
	/* ----------------------------------------------------------- */ 

	$('#search-icon').click(function(e){
		e.preventDefault();
     	$('.header-top').slideToggle(500);     
  	});
	
			
	/* ----------------------------------------------------------- */
	/*  2. HOVER DROPDOWN MENU
	/* ----------------------------------------------------------- */ 
	
	// for hover dropdown menu
  	$('ul.nav li.dropdown').hover(function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
    }, function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
    });

  	/* ----------------------------------------------------------- */
	/*  3. BOOTSTRAP ACCORDION
	/* ----------------------------------------------------------- */ 
	
	$('#accordion .panel-collapse').on('shown.bs.collapse', function () {
	$(this).prev().find(".fa").removeClass("fa-plus-square").addClass("fa-minus-square");
	});
	
	//The reverse of the above on hidden event:
	
	$('#accordion .panel-collapse').on('hidden.bs.collapse', function () {
	$(this).prev().find(".fa").removeClass("fa-minus-square").addClass("fa-plus-square");
	});	

	/* ----------------------------------------------------------- */
	/*  4. SKILL PROGRESS BAR
	/* ----------------------------------------------------------- */ 

	$('.progress .progress-bar').progressbar({
		display_text: 'center', percent_format: function(p) {return p + ' %';}});

	/* ----------------------------------------------------------- */
	/*  5. LIGHTBOX ( FOR PORTFOLIO POPUP VIEW ) 
	/* ----------------------------------------------------------- */ 
	
	$('body').append("<div id='portfolio-popup'><div class='portfolio-popup-area'><div class='portfolio-popup-inner'></div></div></div>");
	
	// WHEN CLICK PLAY BUTTON 
	
    jQuery('.view-icon').on('click', function(event) {
      event.preventDefault();
      $('#portfolio-popup').addClass("portfolio-popup-show");
      $('#portfolio-popup').animate({
	      "opacity": 1
      },500);   
      var portfolio_detailscontent = $(this).parent(".single-item-content").find(".portfolio-detail").html();
	  $(".portfolio-popup-inner").html(portfolio_detailscontent);     

    });  
           
    // WHEN CLICK CLOSE BUTTON
    
    $(document).on('click','.modal-close-btn', function(event) {     
	    event.preventDefault();
		$('#portfolio-popup').removeClass("portfolio-popup-show");
		$('#portfolio-popup').animate({
		      "opacity": 0
	    },500);  

    });
    

	/* ----------------------------------------------------------- */
	/*  6. MAIN SLIDER (SLICK SLIDER)
	/* ----------------------------------------------------------- */

	jQuery('.main-slider').slick({
		dots: true,
		infinite: true,
		speed: 500,
		autoplay: true,
		accessibility: false,
		fade: true,
		cssEase: 'linear'
	});

	/* ----------------------------------------------------------- */
	/*  7. LOGIN MODAL WINDOW
	/* ----------------------------------------------------------- */

	$("#signup-btn").on('click', function(e){
		$('#signup-content').show();
		$('#login-content').hide();
		e.preventDefault();		
	});

	$("#login-btn").on('click', function(e){
		$('#login-content').show();
		$('#signup-content').hide();
		e.preventDefault();
				
	});

	/* ----------------------------------------------------------- */
	/*  8. COUNTER
	/* ----------------------------------------------------------- */ 

	  jQuery('.counter').counterUp({
            delay: 10,
            time: 1000
        });

	/* ----------------------------------------------------------- */
	/*  9. TESTIMONIAL SLIDER (SLICK SLIDER)
	/* ----------------------------------------------------------- */   

	jQuery('.testimonial-slider').slick({
		dots: true,
		infinite: true,
		speed: 500,
		autoplay: true,		
		cssEase: 'linear'
	});


	/* ----------------------------------------------------------- */
	/*  10. CLIENTS BRAND SLIDER (SLICK SLIDER)
	/* ----------------------------------------------------------- */   

	$('.clients-brand-slide').slick({
	  dots: false,
	  infinite: false,
	  speed: 300,
	  slidesToShow: 4,
	  slidesToScroll: 4,
	  autoplay: true,	
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 3,
	        infinite: true,
	        dots: true
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});

	/* ----------------------------------------------------------- */
	/*  11. SCROLL TOP BUTTON
	/* ----------------------------------------------------------- */

	//Check to see if the window is top if not then display button

	$(window).scroll(function(){
	    if ($(this).scrollTop() > 300) {
	      $('.scrollToTop').fadeIn();
	    } else {
	      $('.scrollToTop').fadeOut();
	    }
	});	   
	   
	//Click event to scroll to top

	$('.scrollToTop').click(function(){
	    $('html, body').animate({scrollTop : 0},800);
	    return false;
	});

	/* ----------------------------------------------------------- */
	/*  12. PRELOADER 
	/* ----------------------------------------------------------- */ 
	
	jQuery(window).load(function() { // makes sure the whole site is loaded
      $('#status').fadeOut(); // will first fade out the loading animation
      $('#preloader').delay(100).fadeOut('slow'); // will fade out the white DIV that covers the website.
      $('body').delay(100).css({'overflow':'visible'});
    })

   
	/* ----------------------------------------------------------- */
	/*  13. WOW ANIMATION
	/* ----------------------------------------------------------- */ 

	wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        live:         true,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init(); 
	
});