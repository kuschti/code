<?php
	global $woo_options;
	
	$team_page = get_post( get_page_by_path( $woo_options[ 'woo_team_page' ] ) );
?>

	<div id="wir" class="section"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<h2><?php echo $team_page->post_title; ?></h2>
			
			<p class="desc"><?php echo $woo_options[ 'woo_team_desc' ]; ?></p>
			
			<!--
			<ul id="team-list">
			
				<?php echo do_shortcode( $team_page->post_excerpt ); ?>
				
			</ul>
			-->			
			
			
			<?php the_content( ' ' ); ?>

			
			
			<!--
			<a href="<?php //echo get_permalink( $team_page->ID ); ?>" class="button"><span>Kontakt</span></a>
			-->
		</div>
	
	</div></div><!-- End #the-team -->