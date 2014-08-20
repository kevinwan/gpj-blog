<?php
/**
 * @package WordPress
 * @subpackage sigma
 */
?>
<?php if ( post_password_required() ) return; ?>

<div id="comments">

	<?php if ( have_comments() ) : ?>
	
		<h6 id="comments-title">
			<?php
			    printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'sigmatheme' ),
			        number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?>
		</h6>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'sigmatheme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'sigmatheme' ) ); ?></div>
			</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php wp_list_comments( array(
				'avatar_size' => '60',
				'type' => 'comment',
				'walker' => new SigmaTheme_Walker_Comment(),
			)); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'sigmatheme'  ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'sigmatheme'  ) ); ?></div>
			</nav>
		<?php endif; // check for comment navigation ?>

	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ( ! comments_open() && is_single() ) : ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'sigmatheme' ); ?></p>
		<?php endif; // end ! comments_open() && ! is_page() ?>

	<?php endif; ?>

	<?php comment_form(array(
			'comment_notes_after' => '',
			'id_submit' => 'comment-submit',
			'must_log_in'          => '<div class="alert alert-info must-log-in"> <p>' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'sigmatheme'  ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p></div>',
			'logged_in_as'         => '<div class="alert alert-info logged-in-as"> <p>' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'sigmatheme' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p></div>',
			'id_form'              => 'commentform',
 		)); ?>
 		
</div><!-- .comments -->