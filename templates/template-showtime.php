<?php
/**
 * Template Name: Showtime
 */
?>

<?php get_header(); ?>
<?php do_action( 'sp_start_content_wrap_html' ); ?>
    <div class="main">

    	<?php
		// Page thumbnail and title.
			the_title( '<header class="entry-header content-padding-side"><h1 class="entry-title">', '</h1></header><!-- .entry-header -->' );
		?>

		<div class="entry-content content-padding-side">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<div class="content-padding-side">
    	<?php
    	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    	$args = array(
				'post_type'			=> 'sp_movie',
				'post_status'		=>	array('publish', 'future'),
				'order'				=> 	'ASC',
				'date_query' 		=> array(
											array(
												'year' => date( 'Y' ),
												'month' => date( 'm' ),
											),
				),
				'paged' => $paged
			);
		$custom_query = new WP_Query( $args );
		$post_count = 1;  
		while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
			<div class="two-fourth<?php echo ($post_count%2 == 0) ? ' last' : ''; ?>">
	            <?php get_template_part( 'templates/posts/content-movie' ); ?>
	        </div>
		<?php 
		$post_count++; 
		endwhile; wp_reset_postdata(); ?>
		<div class="clear"></div>
		<?php	
			// Pagination
            if(function_exists('wp_pagenavi'))
                wp_pagenavi();
            else 
                echo sp_pagination($custom_query->max_num_pages);
		?>
		</div>

	</div><!-- #main -->
	<?php get_sidebar();?>
<?php do_action( 'sp_end_content_wrap_html' ); ?>
	
<?php get_footer(); ?>