<?php
	global $woo_options;
	
	$offer_page = get_post( get_page_by_path( $woo_options[ 'woo_offer_page' ] ) );
?>
	<div id="was" class="section"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<h2><?php echo $offer_page->post_title; ?></h2>
			
			<p class="desc"><?php echo $woo_options[ 'woo_offer_desc' ]; ?></p>
			
			<?php
				$offers = get_posts( array(
					'post_parent' => $offer_page->ID,
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
			
			<div id="offered-services">
			
				<?php echo do_shortcode( $offer_page->post_excerpt ); ?>
						
			</div>
			
			<a href="<?php echo get_permalink( $offer_page->ID ); ?>" class="button"><span>Weitere Bilder</span></a>
			
		</div>
	
	</div></div><!-- End #offer -->