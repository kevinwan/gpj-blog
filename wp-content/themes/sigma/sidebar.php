<?php
/**
 * @package WordPress
 * @subpackage sigma
 */
?>
    <div class="one-third column omega" id="side">
    
        <div class="sidebar"> <!--  the Sidebar -->
            <?php 
				if ( is_active_sidebar( 'right-sidebar' ) ){ 
					dynamic_sidebar( 'right-sidebar' );
				}else{
            		echo '<p>' . esc_html__( 'You need to drag a widget into your sidebar in the WordPress Admin', 'sigmatheme' ). '</p>';
	        	}
	        ?>
       </div>
       
    </div>