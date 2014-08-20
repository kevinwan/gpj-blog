<?php
/**
 * @package WordPress
 * @subpackage sigma
 */
?>
<!DOCTYPE html>

<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
    
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php wp_title('|',true,'right'); ?></title>
        
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/html5.js"></script>
<![endif]-->

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php wp_head(); ?>        

</head>

<body <?php body_class(); ?>><!-- the Body  -->

<div class="container">
   
	<?php get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>
	<div class="page-container">
