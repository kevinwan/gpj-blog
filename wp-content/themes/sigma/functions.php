<?php 
/**
 * sigma functions and definitions
 *
 * @package sigma
 * @since 1.0.0
 */

// Useful global constants
define( 'SIGMATHEME_VERSION', '0.1.2' );

/**
 * Set up theme defaults and register supported WordPress features.
 * @since 0.1.0
 */
function sigmatheme_setup() {
	
	//Register navigation menu
	register_nav_menu( 'primary', 'Primary Menu' );
	
	//Set content widget - for uploaded images
	if ( ! isset( $content_width ) ) $content_width = 960;
	
	//Theme supports...
	add_theme_support( 'post-thumbnails' );
	
	set_post_thumbnail_size( 700, 250, true );
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'custom-header', array(
		//'default-image'          => get_template_directory_uri() . '/images/sigma.png',
		'random-default'         => false,
		'width'                  => 300,
		'height'                 => 80,
		'flex-height'            => true,
		'flex-width'             => true,
		'default-text-color'     => '',
		'header-text'            => false,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	));
	
	add_theme_support( 'custom-background' );
	
	add_editor_style("/assets/css/editor-style.css");
	
	load_theme_textdomain( 'sigmatheme', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'sigmatheme_setup' );


/**
 * Enqueue scripts and styles for front-end.
 *
 * @since 0.1.0
 */
function sigmatheme_enqueue_scripts(){
	
	$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';
	
	wp_enqueue_script( 'sigmatheme', get_template_directory_uri() . "/assets/js/sigma{$postfix}.js", array( 'jquery' ), SIGMATHEME_VERSION, true );
	wp_enqueue_style( 'sigmatheme', get_template_directory_uri() . "/assets/css/sigma{$postfix}.css", array(), SIGMATHEME_VERSION );
	
	if ( is_singular() ) 
		wp_enqueue_script( "comment-reply" ); 
}
add_action( 'wp_enqueue_scripts', 'sigmatheme_enqueue_scripts' );


//Returns a "Read more &raquo;" link for excerpts
function sigmatheme_continue_reading_link() {
	return '<p class="read-more"><a href="'. esc_url(get_permalink()) . '">' . __( 'Read more &raquo;', 'sigmatheme' ) . '</a></p>';
}


//Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and sigmatheme_continue_reading_link().
function sigmatheme_auto_excerpt_more( $more ) {
	return ' &hellip;' . sigmatheme_continue_reading_link();
}
add_filter( 'excerpt_more', 'sigmatheme_auto_excerpt_more' );


//Append site title to wp_title.
function sigmatheme_wp_title( $title, $sep, $seplocation ){
	return $title . get_bloginfo('name');	
}
add_filter( 'wp_title', 'sigmatheme_wp_title', 10, 3 );


//Walker class
require_once( get_template_directory() . '/includes/class-sigmatheme-walker-comment.php' );


//Widgets
require_once( get_template_directory() . '/includes/widgetised-areas.php' );


//Theme customiser
//require_once( get_template_directory() . '/includes/theme-customiser.php' );


//Event Organiser integration
require_once( get_template_directory() . '/includes/eo.php' );



function sigmatheme_get_author_id( $post_id = false ){
	
	$post_id = ( $post_id === false ? get_the_ID() : $post_id );
	
	$post_obj = get_post( $post_id );
	
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	
	return (int) $authordata->ID;

}
?>