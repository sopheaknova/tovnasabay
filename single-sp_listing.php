<?php
/**
 * The template for displaying all movie.
 */
?>

<?php get_header(); ?>

<?php do_action( 'sp_start_content_wrap_html' ); ?>
    <div id="main" class="main">
		<?php
			$listing_meta = get_post_meta( $post->ID );
			// Start the Loop.
			while ( have_posts() ) : the_post(); 
		?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-header content-padding-side">
					<div class="one-third">
						<?php the_post_thumbnail( 'medium' ); ?>
					</div>
					
					<div class="two-third last">
						<header class="entry-header">
							<h1 class="entry-title">
								<?php the_title(); ?>
							</h1>
						</header>

						<address><?php echo $listing_meta['sp_lt_address'][0]; ?></address>

						<?php 
							$comm_lines = unserialize($listing_meta['sp_lt_comm_line'][0]);
							if ( !empty($comm_lines) ) :
								$out = '<ul class="comm-line">';
								foreach ($comm_lines as $comm_line ) {
									$comm_type = $comm_line['sp_lt_comm_type'];
									$comm_value = $comm_line['sp_lt_comm_value']; 

									if ( $comm_type == 'e-mail' ) {
										$out .= '<li><span class="attr">' . $comm_type . '</span><span class="value"><a href="mailto:' . $comm_value . '">' . $comm_value . '</a></span></li>';	
									} elseif ( $comm_type == 'website' ) {
										$out .= '<li><span class="attr">' . $comm_type . '</span><span class="value"><a href="http://' . $comm_value . '" target="_blank">' . $comm_value . '</a></span></li>';	
									} else {
										$out .= '<li><span class="attr">' . $comm_type . '</span><span class="value">' . $comm_value . '</span></li>';
									}
								}
								$out .= '</ul>';
								echo $out;
							endif;
						?>

					</div> <!-- .one-third .last -->

					<div class="clear"></div>
					</div> <!-- .content-padding-side -->

					<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
				    <script type="text/javascript">
				    jQuery(document).ready(function ($){
				    	var single_map_coords = "<?php echo $listing_meta['sp_lat_long_map'][0]; ?>"
				    	var _single_map_coords = single_map_coords.split(',');
				    	var pos = new google.maps.LatLng(_single_map_coords[0], _single_map_coords[1]);
						var mapOptions = {
						  zoom: 15,
						  mapTypeId: google.maps.MapTypeId.ROADMAP,
						  center: pos
						}
						var map = new google.maps.Map(document.getElementById("listing-map"), mapOptions);

						// To add the marker to the map, use the 'map' property
						var marker = new google.maps.Marker({
						    position: pos,
						    map: map,
						    title:"Hello World!"
						});
					});	

				    </script>
					<div id="listing-map" style="height:350px;"></div>

					<div class="entry-content listing-profile content-padding-side">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

				</article><!-- #post -->

		<?php		
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
		?>
		
	</div><!-- #main -->
	<?php get_sidebar();?>
<?php do_action( 'sp_end_content_wrap_html' ); ?>
<?php get_footer(); ?>