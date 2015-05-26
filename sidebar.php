<?php
/**
 * The sidebar containing the main widget area.
 */

global $post;
?>

<?php 
	$choice_sidebar = sp_sidebar_primary();
	$choice_layout = sp_layout_class();
	if ( $choice_layout != 'col-1c'):
?>

	<aside id="sidebar" class="sidebar" role="complementary">
		<div class="widget">
			<div class="widget-title">
				<h4>Search</h4>
			</div>
			<?php get_search_form(); ?>
		</div>
		<?php
			$args = array(
					'post_type'			=> 'sp_movie',
					'posts_per_page'	=>	3,
					'post_status'		=>	array('publish', 'future'),
					'order'				=> 'ASC',
					'orderby'			=> 'rand',
					'post__not_in'		=> array( $post->ID ),
					'date_query'        => array(
	                                            array(
	                                                'year' => date( 'Y' ),
	                                                'month' => date( 'm' ),
	                                            ),
	                )
				);
			$custom_query = new WP_Query( $args );

			if( $custom_query->have_posts() ) : ?>
			<div class="widget sp-widget-post-movie">
				<div class="widget-title">
					<h4>Recently Movie</h4>
				</div>	
					<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('sp-medium-grid-post-1 effect-vanda'); ?>>
							<div class="sp-post-thumb">
							<img src="<?php echo aq_resize(get_post_meta($post->ID, 'sp_movie_thumb', true), 280, 188, true); ?>">
							</div>
							<div class="mask">
								<a class="icon-link-1" title="Movie detail" href="<?php echo esc_url( get_permalink() ); ?>"></a>
								<a class="icon-video video-trailer" title="Movie Trailer" href="<?php echo get_post_meta( $post->ID, 'sp_video_trailer', true ); ?>"></a>
							</div>
							<div class="sp-post-info">
								<h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
								<div class="entry-meta">
									<span class="movie-rate"><?php echo get_post_meta( $post->ID, 'sp_movie_rating', true ); ?></span>
									<?php echo esc_html( get_the_date() ); ?>
								</div>
							</div>
						</article>
					<?php endwhile; wp_reset_postdata(); ?>
			</div>
			<?php endif; ?>

	<?php if ( is_active_sidebar($choice_sidebar) ) :	
			dynamic_sidebar($choice_sidebar);
		else:?>	
			<div class="non-widget widget">
		     <h3><?php _e('Sidebar ', SP_TEXT_DOMAIN); ?></h3>
		    <p class="noside"><?php _e('To edit this sidebar, go to admin backend\'s <strong><em>Appearance -&gt; Widgets</em></strong> and place widgets into the <strong><em> sidebar </em></strong> Area', SP_TEXT_DOMAIN); ?></p>
		    </div>
	<?php endif; ?>
	</aside> <!--End #Sidebar-->

<?php endif; ?>