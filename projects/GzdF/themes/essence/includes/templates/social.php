<?php global $woo_options; ?>

<ul class="social">
	<li style="display: none;"><a href="<?php $GLOBALS['feedurl'] = get_option('woo_feed_url'); if ( !empty($feedurl) ) { echo $feedurl; } else { echo get_bloginfo_rss('rss2_url'); } ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/rss.png" alt="" /></a></li>
	
	<?php if( $woo_options[ 'woo_facebook' ] ) : ?>
		<li><a href="http://facebook.com/<?php echo $woo_options[ 'woo_facebook' ]; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/facebook.png" alt="" /></a></li>
	<?php endif; ?>

	<?php if( $woo_options[ 'woo_tweet' ] ) : ?>
		<li><a href="http://twitter.com/<?php echo $woo_options[ 'woo_tweet' ]; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/twitter.png" alt="" /></a></li>
	<?php endif; ?>
	
	<?php if( $woo_options[ 'woo_flickr' ] ) : ?>
		<li><a href="http://flickr.com/photos/<?php echo $woo_options[ 'woo_flickr' ]; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/flickr.png" alt="" /></a></li>
	<?php endif; ?>
	
	<?php if( $woo_options[ 'woo_dribbble' ] ) : ?>
		<li><a href="http://dribbble.com/players/<?php echo $woo_options[ 'woo_dribbble' ]; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/dribbble.png" alt="" /></a></li>
	<?php endif; ?>
</ul>