<?php
	global $woo_options;
	
	$portfolio_page = get_post( get_page_by_path( $woo_options[ 'woo_portfolio_page' ] ) );
?>
	<div id="portfolio" class="section"><div class="gradient">
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<h2><?php echo $portfolio_page->post_title; ?></h2>
			
			<p class="desc"><?php echo $woo_options[ 'woo_portfolio_desc' ]; ?></p>
			
			<div id="slider-wrap" class="portfolio-gallery">
			<div id="slider" class="portfolio-slider-item">
				
			
				<?php 
					//query_posts( array(
					//	'post_type' => 'portfolio',
					//	'posts_per_page' => 6
					//) ); 
					
					
					$args = array( 'post_type' => 'portfolio', 'posts_per_page' => 6 );
					$loop = new WP_Query( $args );
					
					//if( have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();; 
					while ( $loop->have_posts() ) : $loop->the_post();
					
					$captions[] = get_the_title().' - '.get_the_date();


				?>
			
					<a href="<?php the_permalink(); ?>" title="<?php get_the_title() ?>">
						<abbr class="date"><?php echo get_the_title() //.' - '.get_the_date(); ?></abbr>
						<?php woo_image( 'link=img&width=760&height=507' );?>
						
					</a>
					
				
				<?php //endwhile; endif; wp_reset_query(); ?>
				<?php endwhile; ?>
			
			</div>
			
			<?php
				foreach($captions as $key => $caption) :
			?>
				<div id="caption<?php echo $key; ?>" class="nivo-html-caption">
					<?php echo $caption; ?>
					
				</div>
			<?php
				endforeach;
			?>
			
			</div>
			
			<br /><br />
			
			<a href="<?php echo get_permalink( $portfolio_page->ID ); ?>" class="button"><span><?php _e( 'Weitere Bilder &nbsp;&rarr;', 'woothemes' ); ?></span></a>
			
			<?php /*
			<div class="extra">
				<h3>Wenzel Fineart</h3>
				<small>Tel. Katharina Kroll 079 756 75 37</small>
				<div class="clear"></div>
				<ul>
					<li>
						<span class="pic">
							<img src="http://www.galeriezumdickenfisch.ch/wp-content/uploads/2011/03/Stursa_Jan-238x324.jpg" alt="" />
						</span>
		
						<h4>Jan Stursa - melancholy girl</h4>
						<p>
							1910<br />
							terracotta<br />
							<br />
							height 39,9 cm<br />
							wide 20,6 cm<br />
							depth 22,1 cm
						</p>
					</li>
					<li>
						<span class="pic">
							<img src="http://www.galeriezumdickenfisch.ch/wp-content/uploads/2011/03/Levy_ToiletteIschia1938-238x324.jpg" alt="" />
						</span>
		
						<h4>Rudolf Levy - Toilette, Ischa</h4>
						<p>
							1938<br />
							oil on canvas<br />
							<br />
							signed lower right
						</p>
					</li>
				</ul>
				
				<div class="clear"></div>
			</div>
			*/ ?>
				
		</div><!-- End .content -->
	
	</div></div><!-- End #portfolio -->