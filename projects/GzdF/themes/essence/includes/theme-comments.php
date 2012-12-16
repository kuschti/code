<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

if ( ! function_exists( 'woo_comments' ) ):
/**
 * Create a comment template for the comments loop.
 *
 * @since Essence 0.1
 */
function woo_comments( $comment, $args, $depth ) 
{
	$GLOBALS[ 'comment' ] = $comment;
?>
	<li class="comment-item">
				
		<div id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment-single' ); ?>>
		
			<?php if( $comment->comment_parent ) : ?>
				<div class="replied-to">
					<em><?php printf( __( 'In Reply to %s', 'woothemes' ), woo_replied_to( $comment->comment_id ) ); ?></em>
				</div>
			<?php endif; ?>
		
			<div class="comment-box">
		
				<div class="comment-body">
					<?php comment_text(); ?>
				</div>
				
				<div class="comment-meta">
					
					<div class="comment-author">
						<?php echo get_avatar( $comment, 22 ); ?>
						<cite><?php printf( __( '%s <small>%s ago</small>', 'woothemes' ), get_comment_author(), human_time_diff( get_comment_time('U'), current_time('timestamp') ) ); ?></cite>
					</div>
					
					<div class="comment-reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => sprintf( __( 'Reply to %s', 'woothemes' ), get_comment_author() ), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
					
				</div>
				
			</div>
		
		</div>	
	
<?php
}
endif;

if ( ! function_exists( 'woo_replied_to' ) ):
/**
 * Find the parent comment, and link to it.
 *
 * @since Essence 0.1
 */
function woo_replied_to( $comment_ID ) 
{
	global $wpdb;
	
	if( empty( $comment ) )
		$comment = get_comment_ID();
	
	$comment = get_comment( $comment_ID );
	$id = $comment->comment_parent;
	if( $id != 0 ) 
	{
		$comment = get_comment( $comment->comment_parent) ;
		return $comment->comment_author;
	}
	
}
endif;