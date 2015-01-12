<?php
/**
 * The main template file.
 */
?>

<?php get_header(); ?>
<?php do_action( 'sp_start_content_wrap_html' ); ?>
	<div class="movie-featured clearfix">

    <!-- START BIG GRID POST -->
    <?php
    	$args = array(
				'post_type'			=> 'sp_movie',
				'posts_per_page'	=>	1,
				'post_status'		=>	array('publish', 'future'),
				'order'				=> 	'ASC',
				'date_query' 		=> array(
											array(
												'year' => date( 'Y' ),
												'month' => date( 'm' ),
											),
				)
			);
		$custom_query = new WP_Query( $args );

		if( $custom_query->have_posts() ) :
			while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('sp-big-grid-post-1 effect-vanda'); ?>>
				<div class="sp-post-thumb">
				<img src="<?php echo aq_resize(get_post_meta($post->ID, 'sp_movie_thumb', true), 560, 386, true); ?>">
				</div>
				<div class="mask">
					<a class="icon-link-1" title="Movie detail" href="<?php echo esc_url( get_permalink() ); ?>"></a>
					<a class="icon-video video-trailer" title="Movie Trailer" href="<?php echo get_post_meta( $post->ID, 'sp_video_trailer', true ); ?>"></a>
				</div>
				<div class="sp-post-info">
					<h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<div class="entry-meta">
						<span class="movie-rate"><?php echo get_post_meta( $post->ID, 'sp_movie_rating', true ); ?></span>
						<?php echo esc_html( get_the_date() ) . ' - ' . get_the_date('m') . ' - ' . date('m'); ?>
					</div>
				</div>
			</article>

	<?php 
		endwhile; wp_reset_postdata();
		endif; ?>

	<!-- START MEDIUM GRID POST -->
	<?php
		$args = array(
				'post_type'			=> 	'sp_movie',
				'posts_per_page'	=>	4,
				'offset'			=> 	1,
				'post_status'		=>	array('publish', 'future'),
				'order'				=> 	'ASC',
				'date_query' 		=> array(
											array(
												'year' => date( 'Y' ),
												'month' => date( 'm' ),
											),
				),
			);
		$custom_query = new WP_Query( $args );

		if( $custom_query->have_posts() ) :
			while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>

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

	<?php 
		endwhile; wp_reset_postdata();
		endif; ?>

		<?php $showtime_page = ot_get_option('showtime_page'); ?>
		<center><a class="button" href="<?php echo get_permalink($showtime_page); ?>">More movie in Showtime</a></center>

	</div>

	<div class="coming-soon clearfix">
		<h4 class="sp-block-title"><span>Coming Soon</span></h4>
		<div id="flexisel" class="clearfix">
		<script type="text/javascript">
			jQuery('document').ready(function($) {
  
			    $("#flexisel-comingsoon").flexisel({
					visibleItems: 4,
					animationSpeed: 1500,
					autoPlay: true,
					autoPlaySpeed: 4000,            
					pauseOnHover: true,
					enableResponsiveBreakpoints: true,
					responsiveBreakpoints: { 
						portrait: { 
							changePoint:380,
							visibleItems: 1
						},
						iphone: { 
							changePoint:580,
							visibleItems: 2
						}, 
						tablet: { 
							changePoint:780,
							visibleItems: 3
						},
						computor: { 
							changePoint:940,
							visibleItems: 3
						}
					}
				});
			});	
		</script>

		<ul id="flexisel-comingsoon">
		<?php
		$args = array(
				'post_type'			=> 'sp_movie',
				'posts_per_page'	=>	8,
				'post_status'		=>	'future',
				'order'				=> 'ASC',
				'date_query' 		=> array(
											array(
												'month' => date( 'm' ),
												'compare' => '>'
											),
				)
			);
		$custom_query = new WP_Query( $args );

		if( $custom_query->have_posts() ) :
			while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
			<li>
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
			</li>
		<?php 
		endwhile; wp_reset_postdata();
		endif; ?>	
		</ul>
		</div> <!-- #flexisel -->	
	</div> <!-- .coming-soon .clearfix -->

    <div class="cinema clearfix">
    	<h4 class="sp-block-title"><span>All Cinemas</span></h4>
    	<div class="clear"></div>
    	<?php $args = array( 'hide_empty=0' );
	        $terms = get_terms('sp_cinema', $args); ?>
	    <?php if ( !empty($terms) ) : 
	    	$count = 1;
	    	foreach ($terms as $term) : 
	    		$t_id = $term->term_id;
	    		$term_meta = get_option( 'taxonomy_' . $t_id );
	    ?>
	    	<div class="one-third<?php echo ($count == 3) ? ' last' : ''; ?> ">
	    		<a href="<?php echo get_term_link($term); ?>" class="cinema-logo">
	    		<img src="<?php echo aq_resize($term_meta['sp_cinema_logo'], 560, 336, true); ?>">
	    		</a>
	    		<div class="content-padding-side">
	    		<!-- <h4><?php echo $term->name; ?></h4> -->

	    		<?php 
					$args = array(
						'post_type' 	 => 'sp_movie',
						'posts_per_page' => 3,
						'post_status'	 =>	array('publish', 'future'),
						'tax_query' 	 => array(
								array(
									'taxonomy' => 'sp_cinema',
									'field'    => 'term_id',
									'terms'    => $t_id
								),
						),
						'order'				=> 	'ASC',
						'orderby'			=> 	'rand'
					);
					$custom_query = new WP_Query( $args ); ?>

	              <?php if ( $custom_query->have_posts() ) : ?>
	              <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
		              	<?php get_template_part( 'templates/posts/content-movie' ); ?>
	              <?php endwhile; wp_reset_postdata(); ?>
				  <?php endif; ?>
				  <a href="<?php echo get_term_link( $term ); ?>" class="more">More movies</a>
				 </div> <!-- .content-padding-side --> 
	    	</div>
	    <?php $count++; endforeach; endif; ?>	
    </div>


<?php do_action( 'sp_end_content_wrap_html' ); ?>
	
<?php get_footer(); ?>