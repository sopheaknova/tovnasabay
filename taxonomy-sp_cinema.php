<?php
/**
 * The template for displaying Archive pages
 */
?>

<?php get_header(); ?>

    <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

	<?php do_action( 'sp_start_content_wrap_html' ); ?>
    <div id="main" class="main">
        
    <div class="page-header entry-content content-padding-side">
        <?php $term_meta = get_option( 'taxonomy_' . $term->term_id ); ?>
        <div class="two-fourth">
            <img src="<?php echo $term_meta['sp_cinema_logo']; ?>">
        </div>
        <div class="two-fourth last">
        <h2 class="title"><?php echo $term->name; ?></h2>
        <address><?php echo $term_meta['sp_address']; ?></address>
        <ul class="comm-line">
           <li><span class="attr">Email:</span> <span class="value"><a href="mailto:<?php echo $term_meta['sp_email']; ?>"><?php echo $term_meta['sp_email']; ?></a></span></li> 
           <li><span class="attr">Phone:</span> <span class="value"><?php echo $term_meta['sp_phone']; ?></span></li> 
           <li><span class="attr">Open hour:</span> <span class="value"><?php echo $term_meta['sp_openhour']; ?></span></li> 
           <li><span class="attr">Website:</span> <span class="value"><a href="<?php echo $term_meta['sp_website']; ?>"><?php echo $term->name; ?></a></span></li> 
        </ul>
        </div>
        <div class="clearfix"></div>
    </div>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
             jQuery(document).ready(function ($)
                {
                    
                    
                    <?php $cinema_latlong = explode(',', $term_meta['sp_lat_long']); ?>
                    var coordLat = <?php echo $cinema_latlong[0]; ?>;
                    var coordLng = <?php echo $cinema_latlong[1]; ?>;

                    var point = new google.maps.LatLng(coordLat,coordLng);
                    var center = new google.maps.LatLng(coordLat,coordLng);
                    var styles = [
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
                    
                    var mapOptions = {  
                        zoom: 14,
                        center: center,
                        // styles: styles,
                        scrollwheel: false,
                        zoomControl: true,
                        disableDefaultUI: true,
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.LARGE,
                            position: google.maps.ControlPosition.LEFT_CENTER
                        },
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                  }
                  var map = new google.maps.Map(document.getElementById('cinema-map'), mapOptions);            
                  var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    title: "<?php echo $term->name;?>"
                  });
                  //infowindow.open(map,marker);
                });
        </script>

    <div id="cinema-map"></div>

    <div class="content-padding-side">
    <h4 class="sp-block-title"><span>What's Showing in <?php echo $term->name; ?></span></h4>
    <?php
        $args = array(
                'post_type'         => 'sp_movie',
                'posts_per_page'    =>  -1,
                'post_status'       =>  array('publish', 'future'),
                'order'             =>  'ASC',
                'date_query'        => array(
                                            array(
                                                'year' => date( 'Y' ),
                                                'month' => date( 'm' ),
                                            ),
                )
            );
        $custom_query = new WP_Query( $args );
        $post_count = 1; 
        while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
            <div class="two-fourth<?php echo ($post_count%2 == 0) ? ' last' : ''; ?>">
                <?php get_template_part( 'templates/posts/content-movie' ); ?>
            </div>
    <?php
        $post_count++; 
        endwhile; wp_reset_postdata();
    
            // Pagination
            if(function_exists('wp_pagenavi'))
                wp_pagenavi();
            else 
                echo sp_pagination();
    ?>
    <div class="clear"></div>

    <h4 class="sp-block-title"><span>Coming Soon</span></h4>
    <?php
        $post_count = 1;
        $args = array(
                'post_type'         => 'sp_movie',
                'posts_per_page'    =>  -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'sp_cinema',
                        'field'    => 'id',                         
                        'terms'    => array( $term->term_id ),
                    ),
                ),
                'post_status'       =>  'future',
                'order'             =>  'ASC',
                'date_query'        => array(
                                            array(
                                                'month' => date( 'm' ),
                                                'compare' => '<'
                                            ),
                )
            );
        $custom_query = new WP_Query( $args );

        if( $custom_query->have_posts() ) :
            while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
            <div class="two-fourth<?php echo ($post_count%2 == 0) ? ' last' : ''; ?>">
            <?php get_template_part( 'templates/posts/content-movie' ); ?>
            </div>
        <?php
            $post_count++;
            endwhile; wp_reset_postdata();
        endif; ?>   
    </div> <!-- .content-padding-side -->

    </div> <!-- #main -->
    <?php get_sidebar(); ?>
    <?php do_action( 'sp_end_content_wrap_html' ); ?>
<?php get_footer(); ?>