<?php

function sigmatheme_register_widget_sidebars(){

	register_sidebar(array(
		'name' => 'Right SideBar',
		'id' => 'right-sidebar',
		'description' => 'Widgets in this area will be shown on the right-hand side.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',	
		'after_widget'  => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Footer SideBar',
		'id' => 'footer-sidebar',
		'description' => 'Widgets in this area will be shown in the footer.',
		'before_widget' => '<div id="%1$s" class="widget one-third column %2$s">',
		'after_widget'  => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Home Page (wide)',
		'id' => 'home-widgets-wide',
		'description' => 'Widgets in this area will be shown at the top of the home page and span the entire page.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => 'Home Page',
		'id' => 'home-widgets',
		'description' => 'Widgets in this area will be shown at the top of the home page, in grids of three.',
		'before_widget' => '<div id="%1$s" class="widget one-third column %2$s">',
		'after_widget'  => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}
	
add_action( 'widgets_init', 'sigmatheme_register_widget_sidebars' );

//Apply do_shortcode() to widgets so that shortcodes will be executed in widgets
add_filter('widget_text', 'do_shortcode');