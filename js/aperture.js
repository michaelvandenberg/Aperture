/* global apertureSlider */
/**
 * Aperture.js
 *
 * Some custom scripts for this theme.
 */
( function( $ ) {

	/*--------------------------------------------------------------
	Back-To-Top.
	--------------------------------------------------------------*/

	// Check to see if the window is top if not then display back-to-top button.
	$(window).scroll(function(){
		if ($(this).scrollTop() > 500) {
			$( ".back-to-top" ).addClass( "show-back-to-top" );
		} else {
			$( ".back-to-top" ).removeClass( "show-back-to-top" );
		}
	});

	// Click event to scroll to top.
	$( '.back-to-top' ).click(function(){
		$( 'html, body' ).animate({scrollTop : 0},800);
		return false;
	});


	/*--------------------------------------------------------------
	Menu and search toggles.
	--------------------------------------------------------------*/
	
	// Open hidden header to reveal mobile menu.
	$( ".menu-toggle" ).click(function() {
		$( "#hidden-header" ).slideToggle( "slow" );
	});

	// Open hidden header to reveal desktop search.
	$( ".search-toggle" ).click(function() {
		$( "#hidden-header" ).slideToggle( "slow" );
	});

	// Close hidden header on window resize.
	$( window ).on( 'resize',function() {

		var windowWidth = window.innerWidth;

		if ( windowWidth >= 800 ) {
			$( "#hidden-header" ).hide();
			$( '#page' ).removeClass( 'menu-toggled' );
		}

	}).trigger( 'resize' );
	

	/*--------------------------------------------------------------
	Accessibility fixes.
	--------------------------------------------------------------*/

	// Add a focus class to sub menu items with children.
	$( ".menu-item-has-children" ).on( 'focusin focusout', function() {
		$( this ).toggleClass( "focus" );
	});

	// Make focus search-toggle more intuitif.
	$('.search-toggle').click(function(){

		// Add class .toggled on toggle.
		$( this ).toggleClass( "toggled" );

		// Only move focus when opened.
		if ( $( this ).hasClass( "toggled" ) ) { 
			$( "#desktop-search input" ).focus();
		}

		// Move focus to search-input.
		$( ".search-toggle" ).on( 'blur', function() {
			$( "#desktop-search input" ).focus();
		});

		// Move focus back to search-toggle.
		$( "#desktop-search .search-submit" ).on( 'blur', function() {
			$( ".search-toggle" ).focus();
		});

	});

	// Make focus menu-toggle more intuitif.
	$('.menu-toggle').click(function(){

		// Move focus to first menu item.
		$( ".menu-toggle" ).on( 'blur', function() {
			$( '#mobile-navigation' ).find( 'a:eq(0)' ).focus();
		});

		// Move focus to menu-toggle.
		$( "#mobile-navigation .search-submit" ).on( 'blur', function() {
			$( ".menu-toggle" ).focus();
		});

	});

	/*--------------------------------------------------------------
	Flexslider.
	--------------------------------------------------------------*/

	// We need a wrapper to absolutely position #masthead and #colophon.
	if ( $( "body" ).hasClass( "fullscreen-slider" ) ) {
		$( "#masthead" ).wrap( "<div class='wrapper'></div>" );
		$( "#colophon" ).wrap( "<div class='wrapper'></div>" );
	}

	// Load flexslider. 
	$(window).load(function() {
		var optionOne = apertureSlider.aperture_animation;
		var optionTwo = apertureSlider.aperture_direction;
		var optionThree = ( apertureSlider.aperture_slideshow === "true" );
		var optionFour = parseInt( apertureSlider.aperture_sliderspeed );

		$('.flexslider').flexslider({
			animation: optionOne,
			direction: optionTwo,
			slideshow: optionThree,
			slideshowSpeed: optionFour,
			controlNav: false,
		});
	});

})( jQuery );