<?php
	global $woo_options;
?>


<div id="<?php echo $post->post_name; ?>" class="section"><div class="gradient">
			
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<h2><?php the_title(); ?></h2>
			
			<div class="columnleft">			
			<?php the_content( ' ' ); ?>
			</div>
			
			<div class="columnright">
				
			<ul id="portfolio-list">
				<li class="portfolio-item">
					<a href="http://goo.gl/maps/pvUSv" title="Google Maps" rel="bookmark">
						<abbr class="date">Karte</abbr>
						<span class="overlay">
							<strong>Albisstrasse 19</strong>
							<small>8915 Hausen am Albis</small>
						</span>
						<?php woo_image('link=img&width=395&height=126' ); ?>
					</a>
				</li>
			
			</ul>
			</div>
			<div style="clear: both;"></div>
				
		</div><!-- End .content -->
	
	</div></div><!-- End #portfolio -->	