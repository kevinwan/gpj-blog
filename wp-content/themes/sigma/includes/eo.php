<?php

//If EO is not installed. Don't do anything.
if( !defined( 'EVENT_ORGANISER_DIR') || apply_filters( 'opmegatheme_disable_eventorgansier_integration', false ) )
	return;


function sigmatheme_register_subfolder_for_stack( $stack ){
	
	$template_dir = get_stylesheet_directory(); //child theme
	$parent_template_dir = get_template_directory(); //parent theme	
	
	array_unshift( $stack, $template_dir . "/event-organiser", $parent_template_dir . "/event-organiser" );
	
	return $stack;
}
add_filter( 'eventorganiser_template_stack', 'sigmatheme_register_subfolder_for_stack' );

/**
 * Checks to see if appropriate templates are present in the root theme directory
 * Otherwises uses templates present in `event-organiser` template directory.
 * Hooked onto `template_include`
 */
function sigmatheme_eventorganiser_templates( $template ){

	//Has EO template handling been turned off?
	if( !eventorganiser_get_option( 'templates' ) )
		return $template;

	$original_template = $template;

	//If WordPress couldn't find an 'event' template use provided templates
	if( is_post_type_archive('event') && !eventorganiser_is_event_template($template,'archive'))
		$template = get_template_directory() . '/event-organiser/archive-event.php';

	if( ( is_tax('event-venue') || eo_is_venue() ) && !eventorganiser_is_event_template($template,'event-venue'))
		$template = get_template_directory() . '/event-organiser/taxonomy-event-venue.php';

	if( is_tax('event-category')  && !eventorganiser_is_event_template($template,'event-category'))
		$template = get_template_directory() . '/event-organiser/taxonomy-event-category.php';

	if( is_tax('event-tag') && eventorganiser_get_option('eventtag') && !eventorganiser_is_event_template($template,'event-tag') )
		$template = get_template_directory() . '/event-organiser/taxonomy-event-tag.php';

	if( is_singular('event') && !eventorganiser_is_event_template($template,'event') )
		$template = get_template_directory() . '/event-organiser/single-event.php';
	
	return file_exists( $template ) ? $template : $original_template;
}
add_filter('template_include', 'sigmatheme_eventorganiser_templates', 5 );

/**
 * Assign appropriate default classes to booking form button
 */
function sigmatheme_booking_button_classes( $class, $form ){
	
	$class = get_post_meta( $form->id, '_eventorganiser_booking_button_classes', true );
	
	if( empty( $class ) ){
		$class = 'btn btn-primary eo-booking-button';
	}
	
	return $class;
}
add_filter( 'eventorganiser_booking_button_classes', 'sigmatheme_booking_button_classes', 10, 2 );


/**
 * Assign appropriate default classes to error/warning notices
 */
function sigmatheme_booking_error_classes( $class, $form ){

	$class = get_post_meta( $form->id, '_eventorganiser_booking_error_classes', true );

	if( empty( $class ) ){
		$class = 'alert alert-error';
	}

	return $class;
}
add_filter( 'eventorganiser_booking_error_classes', 'sigmatheme_booking_error_classes', 10, 2 );


/**
 * Assign appropriate default classes to notices
 */
function sigmatheme_booking_notice_classes( $class, $form ){

	$class = get_post_meta( $form->id, '_eventorganiser_booking_notice_classes', true );

	if( empty( $class ) ){
		$class = 'alert alert-info';
	}

	return $class;
}
add_filter( 'eventorganiser_booking_notice_classes', 'sigmatheme_booking_notice_classes', 10, 2 );