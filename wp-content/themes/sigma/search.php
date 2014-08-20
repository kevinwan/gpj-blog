<?php
/**
 * @package WordPress
 * @subpackage sigma
 */

get_header(); ?>

<div class="content">

	<div class="two-thirds column alpha">
	
       <div class="main"> 
                        
		<div class="title">
			<h2>		
				<?php printf( __( 'Search Results for: <em>%s</em>', 'sigmatheme' ), get_search_query() ); ?>
			</h2>
		</div>
		
		<?php get_template_part( 'loop', 'index' ); //the Loop ?>
	
		</div>  <!-- End Main -->
		
    </div>  <!-- End two-thirds column -->
    
</div><!-- End Content -->
          	  
<?php get_template_part( 'sidebar', 'index' ); //the Sidebar ?>
            
<?php get_footer(); //the Footer  ?>   