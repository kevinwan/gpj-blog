<?php
/**
 * @package WordPress
 * @subpackage sigma
 */
?>
	</div><!-- page-container -->               
</div>
	
<hr />
	
<div class="footer">
	<div class="container container-sixteen">
		<?php if ( is_active_sidebar( 'footer-sidebar' ) ) dynamic_sidebar( 'footer-sidebar' ); ?>
	</div>
</div>
    
<?php wp_footer(); ?>
   
</body>
</html>