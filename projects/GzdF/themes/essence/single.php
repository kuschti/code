<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

get_header(); ?>

<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div id="blog"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<h2><?php _e( 'Blog Entries', 'woothemes' ); ?></h2>
			
			<p class="desc"><?php bloginfo( 'description' ); ?></p>
						
			<div id="inner" class="blog-entry">
			
				<div class="post">
				
					<div class="title">
						<h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'quality' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						<p class="postmetadata"><?php printf( __( 'Written by %s at %s on %s', 'woothemes' ), get_the_author(), get_the_time(), get_the_date() ); ?></p>
					</div>
					
					<div class="entry">
						<?php the_content( ' ' ); ?>
					</div>
					
					<p class="postutlity">
						<?php foreach(  get_the_category() as $cat ) : ?><a href="<?php echo get_category_link( $cat->cat_ID ); ?>" class="continue-reading"><?php printf( __( 'in %s &rarr;', 'woothemes' ), $cat->cat_name ); ?></a><?php break; endforeach; ?>
						
						<a href="#comments" class="comment-count"><?php comments_number( __( '0 Comments', 'woothemes' ), __( '1 Comment', 'woothemes' ), __( '% Comments', 'woothemes' ) ); ?></a>
						
						<a href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php echo urlencode( get_the_title( $post->ID ) ); ?>" class="tweet-this"><?php _e( 'Tweet This', 'woothemes' ); ?></a>
						
						<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php echo urlencode( get_the_title( $post->ID ) ); ?>" class="like-this"><?php _e( 'Like This', 'woothemes' ); ?></a>
					</p>
					
				</div>
				
			</div><!-- End .blog-entry -->
			
		</div>
	
	</div></div><!-- End #blog -->
	
	<?php //comments_template(); ?>
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>