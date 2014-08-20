<?php 
/**
 * @package WordPress
 * @subpackage sigma
 * 
 * Displays content for a single post / page / post type
 */
the_post();
?>

<div class="content">
	<div class="two-thirds column alpha">
       <div class="main"> 
                        
        <article id="post-<?php the_ID(); ?>">
        
        	<div class="title">            
				<h2>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> 
				</h2><!--Post titles-->
			</div>
          
			<?php the_excerpt(); ?>
	
        </article>
        
      </div>  <!-- End Main -->
	</div>  <!-- End two-thirds column -->
</div><!-- End Content -->
    
