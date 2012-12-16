<?php 
	global $woo_options; 
	
	$shots = woo_dribbbles();
	
	if( $shots ) :
?>

	<div id="dribbble" class="section"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<h2><?php echo $woo_options[ 'woo_dribbble_title' ]; ?></h2>
			
			<p class="desc"><?php echo $woo_options[ 'woo_dribbble_desc' ]; ?></p>
			
			<ul id="shots">
				<?php foreach( $shots as $shot ) : ?>
					<li><a href="<?php echo $shot->get_permalink(); ?>"><?php 
						$desc = preg_match_all( '/<img[^>]+>/i', $shot->get_content(), $images ); 
						echo $images[0][0]
					?></a></li>
				<?php endforeach; ?>
			</ul>
			
			<a href="http://dribbble.com/players/<?php echo $woo_options[ 'woo_dribbble' ]; ?>" class="button"><span><?php _e( 'See More Shots &nbsp;&rarr;', 'woothemes' ); ?></span></a>
			
			<div id="ball">Dribbble</div>
			
		</div>
		
	</div></div><!-- End #dribbble -->
	
<?php endif; ?>