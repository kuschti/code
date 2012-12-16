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
		
			<div class="blog-entry">
			
				<div class="post">
				
					<div class="title">
						<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'woothemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						
					</div>
					
					<div class="entry">
						<?php the_content( ' ' ); ?>
					</div>
					
				</div>
				
			</div><!-- End .blog-entry -->
			
		</div>
	
	</div></div><!-- End #blog -->
	
	<?php //comments_template(); ?>
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>