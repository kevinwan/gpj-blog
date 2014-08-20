<?php 
/**
 * @package WordPress
 * @subpackage sigma
 */
?>

<?php if( have_posts() ): ?>
	 <?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
                        
        <article id="post-<?php the_ID(); ?>" <?php post_class();?>>
        
			<div class="title">            
				<h4>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>  
				</h4><!--Post titles-->
			</div>
        
			<?php the_post_thumbnail( 'post-thumbnail' ); ?>
             
            <?php the_excerpt(); ?> <!--The Content-->
	 
             <!-- Metadata -->
             <?php  if( 'page' != get_post_type() ): ?>        
				
				<div class="meta"> 
				
					<?php 
					printf(
						esc_html__( "Posted on: %s", "sigmatheme" ),
						'<a href="' . get_permalink() .'">' . get_the_date() . '</a>'
					);
					
					if( is_multi_author() && ( $author_id = sigmatheme_get_author_id() ) ){
						printf( 
							" | " . esc_html__( "Author: %s", "sigmatheme" ), 
							'<a href="' . get_author_posts_url( $author_id ) . '">' . get_the_author() .'</a>' 
						);
					}
					
					edit_post_link( __( 'Edit', 'sigmatheme' ), ' | <span class="edit-link">', '</span>' );
					 
					if( has_category() ){
						printf( '<div>' . esc_html__( 'Categories: %s', 'sigmatheme') . '</div>', get_the_category_list(' ') );
					}
					
					if( has_tag() ){
						echo '<div>' . get_the_tag_list( esc_html__( 'Tags:','sigmatheme' ) . ' ', ' ' ) . '</div>';
					}
					?>
					
				</div>
				
              <?php endif; ?>
        </article>
                        
	<?php endwhile; ?><!--  End the Loop -->

	<?php /* Display navigation to next/previous pages when applicable */ ?>
  
	<?php if (  $wp_query->max_num_pages > 1 ) : ?>
		
		<nav id="nav-below" class="nav clearfix">
           	<div class="nav-next pull-right sigma"><?php next_posts_link(); ?></div>
           	<div class="nav-previous5 pull-left alpha"><?php previous_posts_link(); ?></div>
		</nav><!-- #nav-below -->
          
	<?php endif; ?>

<?php else: ?>

        <article id="post-0" <?php post_class();?>>
  
  			<div class="entry-content">
  			
  				<p>
  					<?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'sigmatheme' ); ?>
  				</p>
  				
  				<?php get_search_form(); ?>
  				
        	</div>
			
        </article>

<?php endif; ?>