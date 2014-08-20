<?php
/**
 * HTML comment list class.
 *
 * @package WordPress
 * @uses Walker
 * @since 2.7.0
 */
class SigmaTheme_Walker_Comment extends Walker{

	/**
	 * @see Walker::$tree_type
	 * @since 2.7.0
	 * @var string
	 */
	var $tree_type = 'comment';

	/**
	 * @see Walker::$db_fields
	 * @since 2.7.0
	 * @var array
	 */
	var $db_fields = array ('parent' => 'comment_parent', 'id' => 'comment_ID');

	/**
	 * @see Walker::start_lvl()
	 * @since 2.7.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of comment.
	 * @param array $args Uses 'style' argument for type of HTML list.
	*/
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;

		switch ( $args['style'] ) {
			case 'div':
				break;
			case 'ol':
				echo '<ol class="children">' . "\n";
				break;
			default:
			case 'ul':
				echo '<ul class="children">' . "\n";
				break;
		}
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 2.7.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of comment.
	 * @param array $args Will only append content if style argument value is 'ol' or 'ul'.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;

		switch ( $args['style'] ) {
			case 'div':
				break;
			case 'ol':
				echo "</ol><!-- .children -->\n";
				break;
			default:
			case 'ul':
				echo "</ul><!-- .children -->\n";
				break;
		}
	}

	/**
	 * This function is designed to enhance Walker::display_element() to
	 * display children of higher nesting levels than selected inline on
	 * the highest depth level displayed. This prevents them being orphaned
	 * at the end of the comment list.
	 *
	 * Example: max_depth = 2, with 5 levels of nested content.
	 * 1
	 *  1.1
	 *    1.1.1
	 *    1.1.1.1
	 *    1.1.1.1.1
	 *    1.1.2
	 *    1.1.2.1
	 * 2
	 *  2.2
	 *
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];
		$id = $element->$id_field;

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

		// If we're at the max depth, and the current element still has children, loop over those and display them at this level
		// This is to prevent them being orphaned to the end of the list.
		if ( $max_depth <= $depth + 1 && isset( $children_elements[$id]) ) {
			foreach ( $children_elements[ $id ] as $child )
				$this->display_element( $child, $children_elements, $max_depth, $depth, $args, $output );

			unset( $children_elements[ $id ] );
		}

	}

	/**
	 * @see Walker::start_el()
	 * @since 2.7.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $comment Comment data object.
	 * @param int $depth Depth of comment in reference to parents.
	 * @param array $args
	 */
	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;

		if ( !empty( $args['callback'] ) ) {
			call_user_func( $args['callback'], $comment, $args, $depth );
			return;
		}

		if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args['short_ping'] ) {
			$this->ping( $comment, $depth, $args );
		} else {
			$this->comment( $comment, $depth, $args );
		}
	}

	/**
	 * @see Walker::end_el()
	 * @since 2.7.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $comment
	 * @param int $depth Depth of comment.
	 * @param array $args
	 */
	function end_el( &$output, $comment, $depth = 0, $args = array() ) {
		if ( !empty( $args['end-callback'] ) ) {
			call_user_func( $args['end-callback'], $comment, $args, $depth );
			return;
		}
		if ( 'div' == $args['style'] )
			echo "</div><!-- #comment-## -->\n";
		else
			echo "</li><!-- #comment-## -->\n";
	}

	/**
	 * @since 3.6
	 * @access protected
	 *
	 * @param object $comment
	 * @param int $depth Depth of comment.
	 * @param array $args
	 */
	protected function ping( $comment, $depth, $args ) {
		$tag = ( 'div' == $args['style'] ) ? 'div' : 'li';
		?>
			<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<div class="comment-body">
					<?php _e( 'Pingback:', 'sigmatheme' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'sigmatheme' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
	<?php
		}
	
	/**
	 * @since 3.6
	 * @access protected
	 *
	 * @param object $comment Comment to display.
	 * @param int $depth Depth of comment.
	 * @param array $args Optional args.
	 */
	protected function comment( $comment, $depth, $args ) {

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
		
			<?php if ( 'div' != $args['style'] ):?>
				<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<?php endif; ?>
			
			<div class="comment-author vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
			
			<div class="comment-main-body">
			
				<div class="comment-meta commentmetadata">
					<span> <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>', 'sigmatheme' ), get_comment_author_link() ); ?> </span>
				</div>
								
				<div class="comment-text">
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sigmatheme'  ) ?></em>
						<br />
					<?php endif; ?>
					<?php comment_text() ?>
				</div>
				
				<div class="comment-actions">
				
					<span class="comment-time">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 'sigmatheme' ), get_comment_date(),  get_comment_time() ); ?>
						</a>
					</span>
					
					<span class="comment-edit">
						<?php edit_comment_link( __( 'Edit', 'sigmatheme' ), '&nbsp;&nbsp;|&nbsp;&nbsp;', '' );?>
					</span>
					
					<span class="comment-reply">
						<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span>
					
				</div>
			
			</div>
			
			<div style="clear:both"></div>
			
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
<?php
	}

}
add_filter( 'wp_page_menu_args', 'sigmatheme_page_menu_args' );
function sigmatheme_page_menu_args( $args ){
	
	$set = array( 'menu_class' => 'container thmfdn-menu dropdown menu-hover' );
	$args = wp_parse_args( $set, $args );
	
	return $args;
}

function sigmatheme_page_menu( $args = array() ) {
	
	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$menu = '';

	$list_args = $args;

	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = __( 'Home', 'sigmatheme' );
		else
			$text = $args['show_home'];
		
		$class = '';
		if ( is_front_page() && !is_paged() ){
			$class = 'class="menu-item current_page_item"';
		}
		
		$menu .= '<li ' . $class . '><a href="' . esc_url( home_url( '/' ) ). '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}

	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

	if ( $menu )
		$menu = '<ul class="' . esc_attr( $args['menu_class'] ) . '">' . $menu . '</ul>';

	$menu = '<div class="' . esc_attr( $args['container_class'] ) . '">' . $menu . "</div>\n";

	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}