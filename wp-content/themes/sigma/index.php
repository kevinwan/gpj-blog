<?php
/**
 * @package WordPress
 * @subpackage sigma
 */
 
get_header();  //the Header ?>

       
<?php if ( is_active_sidebar( 'home-widgets' ) ) : ?>
	<div class="container container-sixteen"> 
		<?php dynamic_sidebar( 'home-widgets-wide' ); ?> 
	</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'home-widgets' ) ) : ?>
	<div class="home-widget-container container container-sixteen"> 
		<?php dynamic_sidebar( 'home-widgets' ); ?> 
	</div>
<?php endif; ?>
	

<div class="content">

	<div class="two-thirds column alpha">
       <div class="main"> 
                        
		<?php get_template_part( 'loop', 'index' ); //the Loop ?>
	
		</div>  <!-- End Main -->
    </div>  <!-- End two-thirds column -->
          	  
    <?php get_template_part( 'sidebar', 'index' ); //the Sidebar ?>
    
</div><!-- End Content -->
        
<?php get_footer(); //the Footer  ?>     
          