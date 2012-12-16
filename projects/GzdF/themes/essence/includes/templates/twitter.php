<?php global $woo_options; ?>

	<div id="twitter" class="section"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<h2><?php echo $woo_options[ 'woo_twitter_title' ]; ?></h2>
			
			<p class="desc"><?php echo $woo_options[ 'woo_twitter_desc' ]; ?></p>
			
			<?php
				$latest_tweet = woo_get_tweets( 1 );
				if( $latest_tweet ) :
			?>
			
			<div id="tweets">
			
				<div class="most-recent">
					
					<div class="tweet">
						<?php foreach( $latest_tweet as $tweet ) : ?>
						<a href="http://twitter.com/<?php echo $woo_options[ 'woo_tweet' ]; ?>" class="title"><?php printf( __( 'Latest from @%s', 'woothemes' ), $woo_options[ 'woo_tweet' ] ); ?></a>
						
						<p><?php echo $tweet->get_content(); ?></p>
						
						<a href="<?php echo $tweet->get_permalink(); ?>" class="status"><?php printf( __( '%s Ago', 'woothemes' ), human_time_diff( $tweet->get_date( 'U' ), current_time( 'timestamp' ) ) ); ?></a>
						<?php endforeach; ?>
					</div>
					
					<a href="http://twitter.com/<?php echo $woo_options[ 'woo_tweet' ]; ?>" class="button"><span><?php _e( 'Follow me on Twitter &nbsp;&rarr;', 'woothemes' ); ?></span></a>
					
				</div>
				
				<?php
					$other_tweets = woo_get_tweets( 3, 1 );
					if( $other_tweets ) :
				?>
			
				<ul>
					<?php foreach( $other_tweets as $tweet ) : ?>
					
						<li>
							<a href="<?php echo $tweet->get_permalink(); ?>" class="status"><?php printf( __( '%s Ago', 'woothemes' ), human_time_diff( $tweet->get_date( 'U' ), current_time( 'timestamp' ) ) ); ?></a>
							<p><?php echo $tweet->get_content(); ?></p>
						</li>
					
					<?php endforeach; ?>
				</ul>
				
				<?php endif; ?>
			
			</div>
			
			<?php endif; ?>
			
		</div>
		
	</div></div><!-- End #twitter -->