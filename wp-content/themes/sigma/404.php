<?php
/**
 * @package WordPress
 * @subpackage sigma
 */

get_header(); 
//get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

	<div class="two-thirds column alpha">
		<div id="content">

			<article id="post-0" class="error404">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( "Sorry, we couldn't find it.", 'sigmatheme' ); ?></h1>
				</header>

				<div class="entry-content">
				  <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps try searching for it?', 'sigmatheme' ); ?></p>

				     <?php get_search_form(); ?>

				</div><!-- .entry-content -->
				
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
        

<?php get_template_part( 'sidebar', 'index' ); //the Sidebar ?>
<?php get_footer(); ?>