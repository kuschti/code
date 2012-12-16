<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

get_header(); ?>

<?php 
	if( have_posts() ) : while ( have_posts() ) : the_post();
		$meta = get_post_meta( $post->ID, 'the_meta', true );
		$live = get_post_meta( $post->ID, 'live', true );
		
?>

	<div id="portfolio"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div id="portfolio-gallery-area" class="container content">
		
			<h1 class="page-title"><?php the_title(); ?></h1>
			
			<p class="desc"><?php echo the_content(); ?></p>
			
			<div id="portfolio-gallery">
				<?php woo_image( 'width=760&height=507' ); ?>
			</div>
			
			<div style="text-align: center; display: none;">
				<span><a id="portfolio-item-next" href="#next" rel="">N&auml;chstes Bild</a></span>
				<span> | </span>
				<span><a id="portfolio-item-last" href="#last" rel="">Letztes Bild</a></span>
				<p></p>
			</div>
			
			<ul id="portfolio-list">
			
			<?php 
				$portfolio = get_posts( array(
					'post_parent' => $post->ID,
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'numberposts' => 100
				));
				
				if( $portfolio ) :
				
					$itemcount = 0;
					foreach( $portfolio as $portfolio_item ) :
						$fullsize = wp_get_attachment_image_src( $portfolio_item->ID, 'portfolio-full' );
			?>
			
				<li class="portfolio-item" id="portfolio-item-<?php echo $itemcount ?>">
					<a href="<?php echo $fullsize[0]; ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'woothemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						
						<span class="overlay">
							<strong><?php $portfolio_item->post_title; ?></strong>
							<small><?php echo get_the_date(); ?></small>
						</span>
						<?php $preview = wp_get_attachment_image_src( $portfolio_item->ID, 'portfolio-thumb' ); ?>
						<img src="<?php echo $preview[0]; ?>" alt=<?php echo $portfolio_item->post_title; ?>" />
					</a>
				</li>
				
				<?php $itemcount ++; ?>
				<?php endforeach; endif; wp_reset_query(); ?>
			
			</ul>
			
			<div id="portfolio-content">
								
				<div id="entry" class="<?php if( !$meta ) : ?> no-meta<?php endif; if( !$live ) : ?> no-live<?php endif; ?>">
					<h2 class="portfolio-title"><?php //_e( 'The Project &amp; Brief', 'woothemes' ); ?></h2>
					<?php //the_content(); ?>
				</div>
				
				

				
				<a href="/was" class="button"><span><?php _e( 'Zur&uuml;ck zur &Uuml;bersicht &nbsp;&rarr;', 'woothemes' ); ?></span></a>
			
			</div><!-- End #portfolio-content -->
			
		</div>
	
	</div></div><!-- End #portfolio -->
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>