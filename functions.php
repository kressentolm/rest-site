<?php
/**
 * Restaurant Theme functions and definitions
 *
 * @package Restaurant Theme
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'restaurant_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function restaurant_theme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Restaurant Theme, use a find and replace
	 * to change 'restaurant-theme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'restaurant-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'restaurant-theme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'restaurant_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // restaurant_theme_setup
add_action( 'after_setup_theme', 'restaurant_theme_setup' );


/**
 *
 * Replaces the excerpt "more" text by a link
 *
 */
function new_excerpt_more($more) {
       global $post;
	return '...<a class="moretag" href="'. get_permalink($post->ID) . '">Read more &raquo;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 *
 * Change excerpt length to 20 words.
 *
 */
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function restaurant_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'restaurant-theme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'restaurant_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function restaurant_theme_scripts() {
	wp_enqueue_style( 'restaurant-theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'restaurant-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'restaurant-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    wp_enqueue_script( 'restaurant-theme-jquery-fittext', get_template_directory_uri() . '/js/jquery.fittext.js', array('jquery'));

    wp_enqueue_script( 'restaurant-theme-main', get_template_directory_uri() . '/js/scripts.js', array('jquery'), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'restaurant_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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


/**
 * Load Google Fonts
 */
function load_fonts() {
            wp_register_style('et-googleFonts', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic|Pacifico');
            wp_enqueue_style( 'et-googleFonts');
        }
    add_action('wp_print_styles', 'load_fonts');

