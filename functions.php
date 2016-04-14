<?php
/**
 * Aperture functions and definitions
 *
 * @package Aperture
 */

if ( ! function_exists( 'aperture_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aperture_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Aperture, use a find and replace
	 * to change 'aperture' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'aperture', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 640, 9999, false );
	add_image_size( 'aperture-full-width', '1010', '9999', false );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'aperture' ),
		'secondary' => esc_html__( 'Secondary Menu', 'aperture' ),
		'social' => esc_html__( 'Social Menu', 'aperture' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'aperture_custom_background_args', array(
		'default-color' 		=> '000000',
		'default-image' 		=> get_stylesheet_directory_uri() . '/img/default-background.jpg',
		'default-repeat'		=> 'no-repeat',
		'default-position-x' 	=> 'center',
		'default-attachment'	=> 'fixed',
	) ) );
}
endif; // aperture_setup
add_action( 'after_setup_theme', 'aperture_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aperture_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aperture_content_width', 640 );
}
add_action( 'after_setup_theme', 'aperture_content_width', 0 );

/**
 * Adjust content_width value for full width page template.
 *
 * @since Aperture 1.1.1
 */
function aperture_full_width_page_content_width() {
	if ( is_page_template( 'template-parts/page-full-width.php' ) ) {	
		$GLOBALS['content_width'] = apply_filters( 'aperture_full_width_page_content_width', 1010 );
	}
}
add_action( 'template_redirect', 'aperture_full_width_page_content_width' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function aperture_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'aperture' ),
		'id'            => 'sidebar-1',
		'description'   => 'This is the sidebar next to the content area.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Bottom Sidebar', 'aperture' ),
		'id'            => 'sidebar-2',
		'description'   => 'This is the sidebar in the footer area.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'aperture_widgets_init' );

if ( ! function_exists( 'aperture_fonts_url' ) ) :
/**
 * Register Google fonts for Aperture.
 *
 * @since Aperture 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function aperture_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Droid Sans font: on or off', 'aperture' ) ) {
		$fonts[] = 'Droid Sans:400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Oswald font: on or off', 'aperture' ) ) {
		$fonts[] = 'Oswald:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function aperture_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'aperture-fonts', aperture_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

	// Load the theme main stylesheet.
	wp_enqueue_style( 'aperture-style', get_stylesheet_uri() );

	// Load the theme custom script file.
	wp_enqueue_script( 'aperture-script', get_template_directory_uri() . '/js/aperture.js', array( 'jquery' ), '20150720', true );

	wp_enqueue_script( 'aperture-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'aperture-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Only load the Flexslider script file on slider pages and when there are more than two featured posts.
	if ( is_page_template( 'template-parts/page-slider.php' ) && aperture_has_featured_posts( 2 ) ) {
		wp_enqueue_script( 'aperture-slider-script', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ) );
	}

	// Pass data from the customizer to the theme script file on slider pages.
	if ( is_page_template( 'template-parts/page-slider.php' ) && aperture_has_featured_posts( 2 ) ) {
		wp_localize_script( 'aperture-script', 'apertureSlider', array(
			'aperture_animation' => get_theme_mod( 'aperture_slider_animation', 'slide' ),
			'aperture_direction' => get_theme_mod( 'aperture_slider_direction', 'horizontal' ),
			'aperture_slideshow' => get_theme_mod( 'aperture_slider_slideshow', 'true' ),
			'aperture_sliderspeed' => get_theme_mod( 'aperture_slider_speed', '7000' ),
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'aperture_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
