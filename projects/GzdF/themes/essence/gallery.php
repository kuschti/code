<?php
/**
 * Template Name: Gallery
 * 
 * @package Essence
 * @since Essence 0.1
 */

global $woo_options; get_header(); ?>

	<div id="portfolio" class="section"><div class="gradient">
			
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		
			<h1 class="page-title"><?php the_title(); ?></h1>
			
			<?php the_content(); ?>
			
			<ul id="portfolio-list">
						
				<?php 
					query_posts( array(
						'post_type' => 'portfolio',
						'posts_per_page' => -1
					) ); 
					if( have_posts() ) : while ( have_posts() ) : the_post(); 
				?>
			
				<li class="portfolio-item">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'woothemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<abbr class="date"><?php echo get_the_date( 'M Y' ); ?></abbr>
						<span class="overlay">
							<strong><?php the_title(); ?></strong>
							<small><?php echo get_the_date(); ?></small>
						</span>
						<?php woo_image( 'link=img&width=238&height=324&force=true' ); ?>
					</a>
				</li>
				
				<?php endwhile; endif; wp_reset_query(); ?>
			
			</ul>
			
			<?php endwhile; endif; ?>
				
		</div><!-- End .content -->
	
	</div></div><!-- End #portfolio -->
	
<?php get_footer(); ?>