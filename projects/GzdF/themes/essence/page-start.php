<?php
/**
 * @package Essence
 * @since Essence 0.1
 */

get_header(); ?>

<?php query_posts(array('showposts' => 6, 'post_parent' => 0, 'post_type' => 'page', 'orderby'=>'menu_order', 'order'=>'ASC')); ?>


<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>


	<?php if($post->post_name == 'home') 
	{
		get_template_part( 'includes/templates/home', 'home' ); 
	}
	
	elseif ($post->post_name == 'wir') {
			get_template_part( 'includes/templates/team', 'home' ); 
	}
	
	elseif ($post->post_name == 'was') {
			get_template_part( 'includes/templates/gallery', 'home' ); 
	}
	elseif ($post->post_name == 'wo') {
			get_template_part( 'includes/templates/wo', 'home' ); 
	}
	
	else {?> 
	


	<div id="<?php echo $post->post_name; ?>" class="section gradient"><div class="gradient">
	
		<div class="divider">&nbsp;</div>
		
		<div class="container content">
		
			<h2><?php the_title(); ?></h2>
			
			
			<?php the_content( ' ' ); ?>
			
			
		</div>
	</div></div>	
	
	<?php } ?>	
	
<?php endwhile; endif; ?>
