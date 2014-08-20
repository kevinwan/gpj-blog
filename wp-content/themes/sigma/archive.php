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
			<?php 
				if( is_post_type_archive() ){
					post_type_archive_title( );
					
				}elseif( is_tax() || is_category() || is_tag() ){
					$taxonomy_name = get_queried_object()->taxonomy;
					$taxonomy = get_taxonomy( $taxonomy_name );
					single_term_title( $taxonomy->labels->singular_name . ': ' );
						
				}elseif ( is_day() ) {
					printf( __( 'Daily Archives: %s', 'sigmatheme' ), '<span>' . get_the_date() . '</span>' );
					
				}elseif ( is_month() ){ 
					printf( __( 'Monthly Archives: %s', 'sigmatheme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'sigmatheme' ) ) . '</span>' );
			
				}elseif ( is_year() ){
					printf( __( 'Yearly Archives: %s', 'sigmatheme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'sigmatheme' ) ) . '</span>' );
					
				}elseif( is_search() ){
					printf( __( 'Search Results for: %s', 'sigmatheme' ), '<span>' . get_search_query() . '</span>' );
				}else{
					_e( 'Archives', 'sigmatheme' );
				}
			?>
			</h2>
		</div>
		
		<?php get_template_part( 'loop', 'index' ); //the Loop ?>
	
		</div>  <!-- End Main -->
    </div>  <!-- End two-thirds column -->
</div><!-- End Content -->
          	  
    <?php get_template_part( 'sidebar', 'index' ); //the Sidebar ?>

            
<?php get_footer(); //the Footer  ?>                        
           
