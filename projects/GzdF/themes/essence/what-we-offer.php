<?php
/**
 * Template Name: What We Offer
 * 
 * @package Essence
 * @since Essence 0.1
 */

global $woo_options; get_header(); ?>

	<div id="offer" class="section"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		
			<h2><?php the_title(); ?></h2>
			
			<?php
				$offers = get_posts( array(
					'post_parent' => $post->ID,
					'post_type' => 'attachment',
					'post_mime_type' => 'image'
				));
				
				if( $offers ) :
			?>
			
			<div id="offer-scroller">
			
				<div class="scroller">
				
					<ul>
						<?php foreach( $offers as $offer ) : ?>
							<?php $gallery = wp_get_attachment_image_src( $offer->ID, 'full-size' ); ?>
							
							<li><img src="<?php echo $gallery[0]; ?>" alt=<?php echo $offer->post_title; ?>" /></li>
						
						<?php endforeach; ?>
					</ul>
				
				</div>
				
				<a href="#" class="previous">Previous</a>
				<a href="#" class="next">Next</a>
				
			</div>
			
			<?php endif; ?>
			s
			
			<div id="offered-services">
			
				<?php echo do_shortcode( get_the_excerpt() ); ?>
						
			</div>
			
			<div id="entry">
				<?php the_content(); ?>
			</div>
			
			<?php endwhile; endif; ?>
			
		</div>
	
	</div></div><!-- End #offer -->
	
<?php get_footer(); ?>