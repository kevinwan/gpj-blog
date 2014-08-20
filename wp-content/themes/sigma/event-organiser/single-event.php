<?php
/**
 * @package WordPress
 * @subpackage sigma
 *
 * Displays content for a single post / page / post type
 */
/**
 * The template for displaying a single event
 *
 * Please note that since 1.7, this template is not used by default. You can edit the 'event details'
 * by using the event-meta-event-single.php template.
 *
 * Or you can edit the entire single event template by creating a single-event.php template
 * in your theme. You can use this template as a guide.
 *
 * For a list of available functions (outputting dates, venue details etc) see http://wp-event-organiser.com/documentation/function-reference/
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. See http://wp-event-organiser.com/documentation/editing-the-templates/ for more information
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.0.0
 */
get_header();  //the Header

the_post();
?>
<div class="content">
	<div class="two-thirds column alpha">
       <div class="main"> 
                        
        <article id="post-<?php the_ID(); ?>">
        
			<div class="title">            
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_title('<h2>', '</h2>'); ?>
				</a> <!--Post titles-->
			</div>
			
			<div class="byline">
				<?php echo __( 'By', 'sigmatheme' ); ?> 
				
				<span class="author vcard">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" title="<?php echo esc_attr( get_the_author() ); ?>">
						<?php echo get_the_author();?>
					</a>
				</span> 
				<?php echo __( 'on', 'sigmatheme' ); ?> 
				<span  title="<?php the_date(); ?>"><?php echo get_the_date(); ?></abbr>
			</div>
        
			<?php the_post_thumbnail( 'post-thumbnail' ); ?>
        	     
			<!-- Get event information, see template: event-meta-event-single.php -->
			<?php eo_get_template_part('event-meta','event-single'); ?>
				
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sigmatheme' ) ); ?>
             
             <div class="pagelink"><?php wp_link_pages('pagelink=Page %'); ?></div>
	 
             <!--The Meta, Author, Date, Categories and Comments-->
             <?php  if( !is_page() ): //Don't show meta on pages ?>  
              
				<div class="meta"> 
					Date posted: <?php echo get_the_date(); ?> | Author: <?php the_author_posts_link(); ?> 
					<?php edit_post_link( __( 'Edit', 'sigmatheme' ), '| <span class="edit-link">', '</span>' ); ?>
					
					<?php if( has_category() ){?> <p> <?php echo __( 'Categories:', 'sigmatheme').' '; the_category(' '); ?></p><?php }?>
					
					<?php if( has_tag() ){?> <p>Categories: <?php the_tags(__('Tags:','sigmatheme') . ' ', ' '); ?></p><?php }?>
				</div>
              
              <?php endif; ?>
        </article>
        
        <?php if( !is_page() ): //Don't show navigation on pages ?>
        	<nav id="nav-below" class="nav clearfix">  
        		<?php 
        			/* Display navigation to next/previous pages when applicable */
	        		previous_post_link('<span class="pull-left alpha"> &laquo; <strong>%link</strong> </span>');
    	    		next_post_link('<span class="pull-right sigma"><strong>%link</strong> &raquo; </span>');
        		?>
        	</nav>
  		<?php endif; ?>
            
        <?php /* Only load comments on single post/pages*/ ?>
        <?php if( ( is_page() || is_single() ) && comments_open() ) : comments_template( '', true ); endif; ?>
     
      </div>  <!-- End Main -->
	</div>  <!-- End two-thirds column -->
</div><!-- End Content -->
    
<?php 
get_template_part( 'sidebar', 'index' ); //the Sidebar

get_footer(); //the Foote
?>