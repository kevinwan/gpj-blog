<?php
/**
 * Template Name: Full-width, no sidebar
 * Description: A full-width template with no sidebar
 *
 * @package WordPress
 * @subpackage sigma
 */
    get_header();  //the Header 
    
    get_template_part( 'content', 'full-width-page' ); //the Loop  
    get_template_part( 'sidebar', 'index' ); //the Sidebar 
            
    get_footer(); //the Footer 
   
?>