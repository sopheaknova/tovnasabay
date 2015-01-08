<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */
?>

<?php $movie_meta = get_post_meta( $post->ID ); ?>
<?php if ( is_single() ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header content-padding-side">
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
		</header>

		<div class="entry-content content-padding-side">
			<div class="movie-info">
				<div class="sp-post-thumb"><?php the_post_thumbnail(); ?></div>
				<h5><?php the_title(); ?></h5>
				<strong>Release Date:</strong> <?php echo esc_html( get_the_date() ); ?>
				<ul>
					<li><strong>Language:</strong> <?php echo $movie_meta['sp_language'][0]; ?></li>
					<li><strong>Rating:</strong> <?php echo strtoupper( $movie_meta['sp_movie_rating'][0] ); ?></li>
					<li><strong>Runtime:</strong> <?php echo (!empty($movie_meta['sp_runtime'][0])) ? $movie_meta['sp_runtime'][0] . ' Minutes' : 'Not available'; ?></li>
                    <?php if ( $movie_meta['sp_genre'][0] != '' ) : ?>
					<li><strong>Genre:</strong> <?php echo $movie_meta['sp_genre'][0]; ?></li>
                    <?php endif; ?>
                    <?php if ( $movie_meta['sp_content_advice'][0] != '' ) : ?>
					<li><strong>Content Advice:</strong> <?php echo $movie_meta['sp_content_advice'][0]; ?></li>
                    <?php endif; ?>
					<?php
						$showtimes = unserialize($movie_meta['sp_showtimes'][0]); 
						if ( !empty($showtimes) ) : ?>
					<li><strong>Movie Ticket:</strong> 
						<?php foreach ($showtimes as $cinema ) { 
							$cinema_term = get_term( $cinema['sp_cinema'], 'sp_cinema' ); ?>
							<a href="<?php echo $cinema['sp_showtime_page']; ?>"><?php echo $cinema_term->name; ?></a>, 
						<?php } ?>
					</li>	
					<?php endif; ?>
				</ul>
			</div> <!-- .movie-info-->
		
			<?php the_content(); ?>
		</div><!-- .entry-content -->
		<center><a id="map-switch" href="#" class="button yellow">
			<span class="show-map">Show available ticket for this movie</span>
			<span class="show-video">Show Video Trailer</span>
		</a></center>

		<div class="video-trailer">
		<?php
			if ( isset($movie_meta['sp_video_trailer'][0]) && !empty($movie_meta['sp_video_trailer'][0]) ) {
				echo sp_add_video($movie_meta['sp_video_trailer'][0]);
			}
		?>
		</div> <!-- .video-trailer -->
		
		<div class="map">
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<script type="text/javascript">					
			  jQuery(document).ready(function ($){
			  		var locations = [
				  		<?php foreach ($showtimes as $cinema ) { 
				  			$cinema_term = get_term( $cinema['sp_cinema'], 'sp_cinema' ); 
				  			$term_meta = get_option( 'taxonomy_' . $cinema_term->term_id ); ?>
				  			['<div class="map-item-info clearfix">'+
				  				'<img src="<?php echo aq_resize($term_meta["sp_cinema_logo"], 147, 102, true); ?>">'+
				  				'<ul class="branch-info">'+
				  				'<li class="name"><h5><?php echo $cinema_term->name; ?></h5><li>'+
				  				'<li class="address"><?php echo $term_meta["sp_address"]; ?><li>'+
				  				'<li><span class="attr">Email</span><span class="value"><?php echo $term_meta["sp_email"]; ?></span><li>'+
				  				'<li><span class="attr">Phone</span><span class="value"><?php echo $term_meta["sp_phone"]; ?></span><li>'+
				  				'<li><span class="attr">Website</span><span class="value"><?php echo $term_meta["sp_website"]; ?></span><li>'+
				  				'<li><span class="attr">Open Hour</span><span class="value"><?php echo $term_meta["sp_openhour"]; ?></span><li>'+
				  				'</ul>'+
				  				'</div>', <?php echo $term_meta['sp_lat_long']; ?>],
				  		<?php } ?>	
				  		];

				  	var map = new google.maps.Map(document.getElementById('cinema-map'), {
						  mapTypeId: google.maps.MapTypeId.ROADMAP
					});	

				  	var map_style = [
                        {
                            "featureType": "landscape",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 65
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 51
                                },
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 30
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 40
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.province",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "lightness": -25
                                },
                                {
                                    "saturation": -100
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "stylers": [
                                {
                                    "color": "#ababab"
                                }
                            ]
                        }
                    ];
				  	var styled_map = new google.maps.StyledMapType(map_style, {name: "Cusmome style"});

                    map.mapTypes.set('map_styles', styled_map);
                    map.setMapTypeId('map_styles');

			  		var infowindow = new google.maps.InfoWindow();
					var bounds = new google.maps.LatLngBounds();
					var marker, i;

					for (i = 0; i < locations.length; i++) {  
					  marker = new google.maps.Marker({
						position: new google.maps.LatLng(locations[i][1], locations[i][2]),
						map: map,
						travelMode: google.maps.TravelMode["Driving"], //Driving or Walking or Bicycling or Transit
						animation: google.maps.Animation.DROP,
					  });

					  bounds.extend(marker.position);

					  google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
						  map.panTo(marker.getPosition());	
						  infowindow.setContent(locations[i][0]);
						  infowindow.open(map, marker);
						}
					  })(marker, i));
					
					    google.maps.event.addListener(map, "click", function(){
						  infowindow.close();
						});
					};

					map.fitBounds(bounds);
			  });
			</script>
			<div id="cinema-map"></div>
		</div>
</article><!-- #post -->

<?php else: ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('sp-post sp-post-movie'); ?>>
	<div class="sp-post-thumb">
    <?php echo get_the_post_thumbnail( $post->ID, 'movie-post-thumb' ); ?>
    </div>
    <div class="sp-post-info">
        <h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <div class="entry-meta">
        <ul>
            <li class="movie-runtime">
                <i class="icon-clock"></i><?php echo (!empty($movie_meta['sp_runtime'][0])) ? $movie_meta['sp_runtime'][0] . ' Minutes' : 'Not available'; ?>
            </li>
            <li>Rating: <?php echo strtoupper($movie_meta['sp_movie_rating'][0]); ?></li>
            <?php if ( $movie_meta['sp_genre'][0] != '' ) : ?>
        	<li>Genre: <?php echo $movie_meta['sp_genre'][0]; ?></li>
            <?php endif; ?>
            <?php if ( $movie_meta['sp_content_advice'][0] != '' ) : ?>
        	<li>Content Advice: <?php echo $movie_meta['sp_content_advice'][0]; ?></li>
            <?php endif; ?>
        	<li>Release Date: <?php echo esc_html( get_the_date() ); ?></li>
        </ul>
        </div>
    </div>
</article><!-- #post -->
<?php endif; ?>
