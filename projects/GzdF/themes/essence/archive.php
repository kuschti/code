<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

global $woo_options; get_header(); ?>

	<div id="blog"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<?php if ( have_posts() ) the_post(); ?>
		
			<h1 class="page-title">
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'woothemes' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'woothemes' ), get_the_date('F Y') ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'woothemes' ), get_the_date('Y') ); ?>
<?php else : ?>
				<?php _e( 'Blog Archives', 'woothemes' ); ?>
<?php endif; ?>
			</h1>
			
			<?php rewind_posts(); ?>
			
			<p class="desc"><?php echo $woo_options[ 'woo_blog_desc' ]; ?></p>
			
			<?php get_template_part( 'includes/templates/loop', 'index' ); ?>
			
		</div>
	
	</div></div><!-- End #blog -->

<?php get_footer(); ?>