<?php
/**
 * @package Essence
 * @since Essence 0.1
 */
?>

<div id="comments"><div class="gradient">

<?php
	if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'woothemes' ); ?></p>
			</div></div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php if( !comments_open() ) return; ?>
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
			
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'woothemes' ); ?></p>
		
		</div>
		
</div></div><!-- #comments -->
	
	<?php return; endif; ?>

	<?php if ( have_comments() ) : ?>
	
		<h3><?php comments_number( __( '0 Comments', 'woothemes' ), __( '1 Comment', 'woothemes' ), __( '% Comments', 'woothemes' ) ); ?></h3>
		
			<br /><br />
	
		<ol class="commentslist">
			<?php wp_list_comments( array( 'callback' => 'woo_comments' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
				<br />
			<div class="comment-navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
			</div><!-- .navigation -->
		<?php endif; ?>

	<?php endif; ?>
	
	<?php 
		$fields =  array(
			'author' => '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . __( 'Name' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="Your Name:" size="30"' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . __( 'Email' ) . '</label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="Your Email:" size="30"' . $aria_req . ' /></p>',
			'url'    => '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . __( 'Website' ) . '</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  placeholder="Your Website:" size="30" /></p>'
		);
		
		$args = array(
			'fields' => apply_filters( 'woo_comment_fields', $fields ),
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'label_submit' => __( 'Submit Message &rarr;', 'woothemes' ),
		);
		
		comment_form( apply_filters( 'woo_comment_form', $args ) ); 
	?>
	
	</div>

</div></div><!-- #comments -->