<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="blog-entry">
	
		<div class="post">
		
			<div class="title">
				<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'woothemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				<p class="postmetadata"><?php printf( __( 'Written by %s at %s on %s', 'woothemes' ), get_the_author(), get_the_time(), get_the_date() ); ?></p>
			</div>
			
			<div class="entry">
				<?php the_content( ' ' ); ?>
			</div>
			
			<p class="postutlity">
				<a href="<?php the_permalink(); ?>/#more-<?php the_ID(); ?>" class="continue-reading"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a>
				<a href="<?php the_permalink(); ?>/#comments" class="comment-count"><?php comments_number( __( '0 Comments', 'woothemes' ), __( '1 Comment', 'woothemes' ), __( '% Comments', 'woothemes' ) ); ?></a>
			</p>
			
		</div>
		
	</div><!-- End .blog-entry -->

<?php endwhile; ?>

	<div id="pagination">
		
		<div class="alignleft">
			<?php next_posts_link( '<span>&larr; Older Posts</span>' ); ?>
		</div>
		
		<div class="alignright">		
			<?php previous_posts_link( '<span>Newer Posts &rarr;</span>' ); ?>
		</div>
		
		<div class="alignone count">
			<?php
				global $page;
				
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				
				printf( __( '%d of %d', 'woothemes' ), $paged, $wp_query->max_num_pages ); 
			?>
		</div>
		
	</div>

<?php endif; ?>