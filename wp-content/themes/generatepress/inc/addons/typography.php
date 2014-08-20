<?php
/*
 WARNING: This is a core Generate file. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * If Generate Typography isn't activated, set the defaults
 *
 * This file is a core Generate file and should not be edited.
 *
 * @package  WordPress
 * @author   Thomas Usborne
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.generatepress.com
 */
 
if ( !function_exists('generate_get_default_fonts') && !function_exists('generate_font_css') && !function_exists('generate_display_google_fonts') ) :
	/**
	 * Set default options
	 */
	function generate_get_default_fonts()
	{
		$generate_font_defaults = array(
			'font_body' => 'Arial, Helvetica, sans-serif',
			'body_font_weight' => 'normal',
			'body_font_transform' => 'none',
			'body_font_size' => '15',
			'font_site_title' => 'Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic',
			'site_title_font_weight' => 'bold',
			'site_title_font_transform' => 'none',
			'site_title_font_size' => '45',
			'font_site_tagline' => 'Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic',
			'site_tagline_font_weight' => 'normal',
			'site_tagline_font_transform' => 'none',
			'site_tagline_font_size' => '15',
			'font_navigation' => 'Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic',
			'navigation_font_weight' => 'normal',
			'navigation_font_transform' => 'none',
			'navigation_font_size' => '15',
			'font_widget_title' => 'Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic',
			'widget_title_font_weight' => 'normal',
			'widget_title_font_transform' => 'none',
			'widget_title_font_size' => '20',
			'font_heading_1' => 'Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic',
			'heading_1_weight' => '300',
			'heading_1_transform' => 'none',
			'heading_1_font_size' => '40',
			'font_heading_2' => 'Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic',
			'heading_2_weight' => '300',
			'heading_2_transform' => 'none',
			'heading_2_font_size' => '30',
			'font_heading_3' => 'inherit',
			'heading_3_weight' => 'normal',
			'heading_3_transform' => 'none',
			'heading_3_font_size' => '20',
			'font_heading_4' => 'inherit',
			'heading_4_weight' => 'normal',
			'heading_4_transform' => 'none',
			'heading_4_font_size' => '15',
		);
		
		return apply_filters( 'generate_font_option_defaults', $generate_font_defaults );
	}
	/**
	 * Generate the CSS in the <head> section using the Theme Customizer
	 * @since 0.1
	 */
	function generate_font_css()
	{

		$generate_settings = wp_parse_args( 
			get_option( 'generate_settings', array() ), 
			generate_get_default_fonts() 
		);
		
		$space = ' ';
		
		// Start the magic
		$visual_css = array (
		
			// Main title font
			'body, button, input, select, textarea' => array(
				'font-family' => current(explode(':', $generate_settings['font_body'])),
				'font-weight' => $generate_settings['body_font_weight'],
				'text-transform' => $generate_settings['body_font_transform'],
				'font-size' => $generate_settings['body_font_size'] . 'px'
			),
			
			// Main title font
			'.main-title' => array(
				'font-family' => current(explode(':', $generate_settings['font_site_title'])),
				'font-weight' => $generate_settings['site_title_font_weight'],
				'text-transform' => $generate_settings['site_title_font_transform'],
				'font-size' => $generate_settings['site_title_font_size'] . 'px'
			),
			
			// Main tagline font
			'.site-description' => array(
				'font-family' => current(explode(':', $generate_settings['font_site_tagline'])),
				'font-weight' => $generate_settings['site_tagline_font_weight'],
				'text-transform' => $generate_settings['site_tagline_font_transform'],
				'font-size' => $generate_settings['site_tagline_font_size'] . 'px'
			),
			
			// Navigation font
			'.main-navigation a, .menu-toggle' => array(
				'font-family' => current(explode(':', $generate_settings['font_navigation'])),
				'font-weight' => $generate_settings['navigation_font_weight'],
				'text-transform' => $generate_settings['navigation_font_transform'],
				'font-size' => $generate_settings['navigation_font_size'] . 'px'
			),
			
			'.main-navigation .main-nav ul ul li a' => array(
				'font-size' => $generate_settings['navigation_font_size'] - 1 . 'px'
			),
			
			// Widget title font
			'.widget-title' => array(
				'font-family' => current(explode(':', $generate_settings['font_widget_title'])),
				'font-weight' => $generate_settings['widget_title_font_weight'],
				'text-transform' => $generate_settings['widget_title_font_transform'],
				'font-size' => $generate_settings['widget_title_font_size'] . 'px'
			),
			
			// Heading 1 font
			'h1' => array(
				'font-family' => current(explode(':', $generate_settings['font_heading_1'])),
				'font-weight' => $generate_settings['heading_1_weight'],
				'text-transform' => $generate_settings['heading_1_transform'],
				'font-size' => $generate_settings['heading_1_font_size'] . 'px'
			),
			
			// Heading 2 font
			'h2' => array(
				'font-family' => current(explode(':', $generate_settings['font_heading_2'])),
				'font-weight' => $generate_settings['heading_2_weight'],
				'text-transform' => $generate_settings['heading_2_transform'],
				'font-size' => $generate_settings['heading_2_font_size'] . 'px'
			),
			
			// Heading 3 font
			'h3' => array(
				'font-family' => current(explode(':', $generate_settings['font_heading_3'])),
				'font-weight' => $generate_settings['heading_3_weight'],
				'text-transform' => $generate_settings['heading_3_transform'],
				'font-size' => $generate_settings['heading_3_font_size'] . 'px'
			),
			
			// Heading 1 font
			'h4' => array(
				'font-family' => current(explode(':', $generate_settings['font_heading_4'])),
				'font-weight' => $generate_settings['heading_4_weight'],
				'text-transform' => $generate_settings['heading_4_transform'],
				'font-size' => $generate_settings['heading_4_font_size'] . 'px'
			),
			
		);
		
		// Output the above CSS
		$output = '';
		foreach($visual_css as $k => $properties) {
			if(!count($properties))
				continue;

			$temporary_output = $k . ' {';
			$elements_added = 0;

			foreach($properties as $p => $v) {
				if(empty($v))
					continue;

				$elements_added++;
				$temporary_output .= $p . ': ' . $v . '; ';
			}

			$temporary_output .= "}";

			if($elements_added > 0)
				$output .= $temporary_output;
		}

		return $output;
	}
	
	/**
	 * Enqueue scripts and styles
	 */
	add_action( 'wp_enqueue_scripts', 'generate_typography_scripts', 50 );
	function generate_typography_scripts() {

		wp_add_inline_style( 'generate-style', generate_font_css() );
	
	}
	
	/** 
	 * Add Google Fonts to wp_head if needed
	 * @since 0.1
	 */
	add_action('wp_head','generate_display_google_fonts', 0);
	function generate_display_google_fonts() {
		
		if ( is_admin() )
			return;
			
		$not_google = array(
			"inherit",
			"Arial,+Helvetica,+sans-serif",
			"Verdana,+Geneva,+sans-serif",
			"Tahoma,+Geneva,+sans-serif",
			"Georgia,+Times New Roman,+Times,+serif"
		);

		// Force a check to see if the settings exist - if not, populate them.
		$generate_settings = get_option( 'generate_settings' );
		if ( !empty( $generate_settings['font_body'] ) ) :
			$generate_settings = get_option( 'generate_settings', generate_get_default_fonts() );
		else :
			$generate_settings = generate_get_default_fonts();
		endif;
		
		$google_fonts = array();
		if ( !empty($generate_settings) ) :
			foreach($generate_settings as $vkey => $vvalue) {
				if(preg_match('~^font_*~is', $vkey) !== 0 && !empty($vvalue)) {
					$vvalue = str_replace(" ", "+", $vvalue);
					if(!in_array($vvalue, $google_fonts)) {
						$google_fonts[] = $vvalue;
					}
				}
			}
		endif;

		$google_fonts = array_diff($google_fonts, $not_google);
		$google_fonts = implode('|', $google_fonts);
		
		if ($google_fonts) { 
			echo '<link rel="stylesheet" id="generate-fonts" type="text/css" href="//fonts.googleapis.com/css?family=' . $google_fonts . '" />' . "\n";
		}
	}
endif;