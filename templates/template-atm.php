<?php
/*
Template Name: ATM page
*/
/**
 * The template for displaying Archive pages
 */
?>
<?php get_header(); ?>
    <div id="content-container">
        <div class="container clearfix">
            <form id="category_panel" action="" method="POST" class="clearfix">
                <h2 class="entry-title">ATMs</h2>
                <select id="atm-bank" name="atm_bank" class="one-fourth">
                  <option value="all" selected="selected">All ATMs</option>
                  <?php $taxonmies = get_terms( 'sp_atm_bank' ); ?>
                  <?php foreach ($taxonmies as $term) { ?>
                    <option <?php if($_POST['atm_bank'] == $term->term_id ) { echo ' selected="selected"'; } ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                  <?php } ?>
                </select>
                <select id="atm-location" name="atm_location" class="one-fourth">
                  <option value="all" selected="selected">All Locations</option>
                  <?php $taxonmies = get_terms( 'sp_city' ); ?>
                  <?php foreach ($taxonmies as $term) { ?>
                    <option <?php if($_POST['atm_location'] == $term->term_id ) { echo ' selected="selected"'; } ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                  <?php } ?>
                </select>
                <input id="submit" type="submit" value="Search" name="is_submit" class="one-fourth last">
            </form>
            
            <div id="map-canvas"></div>
        </div>
    </div>
    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/data.json"></script>
    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript">

        jQuery(document).ready(function ($){

          var LocationData = [

                        <?php 
                          if ( isset($_POST['is_submit']) ) :
                              if ( $_POST['atm_bank'] != 'all' && $_POST['atm_location'] != 'all' ) :
                                $args = array( 
                                          'post_type' => 'sp_atm', 
                                          'tax_query' => array(
                                                'relation' => 'AND',
                                                array(
                                                  'taxonomy' => 'sp_atm_bank',
                                                  'field'    => 'id',
                                                  'terms'    => array( $_POST['atm_bank'] ),
                                                ),
                                                array(
                                                  'taxonomy' => 'sp_city',
                                                  'field'    => 'id',
                                                  'terms'    => array( $_POST['atm_location'] ),
                                                ),
                                              ),
                                          'posts_per_page' => -1, 
                                );
                                elseif ( $_POST['atm_bank'] != 'all' && $_POST['atm_location'] == 'all' ) : 
                                  $args = array( 
                                          'post_type' => 'sp_atm', 
                                          'tax_query' => array(
                                                array(
                                                  'taxonomy' => 'sp_atm_bank',
                                                  'field'    => 'id',
                                                  'terms'    => array( $_POST['atm_bank'] ),
                                                )
                                              ),
                                          'posts_per_page' => -1, 
                                  );

                                elseif ( $_POST['atm_bank'] == 'all' && $_POST['atm_location'] != 'all' ) : 
                                  $args = array( 
                                          'post_type' => 'sp_atm', 
                                          'tax_query' => array(
                                                array(
                                                  'taxonomy' => 'sp_city',
                                                  'field'    => 'id',
                                                  'terms'    => array( $_POST['atm_location'] ),
                                                )
                                              ),
                                          'posts_per_page' => -1, 
                                  );
                                else : 
                                  $args = array(
                                      'post_type' => 'sp_atm',
                                      'posts_per_page' => -1, 
                                  );
                                endif; 
                            else : 
                                $args = array(
                                    'post_type' => 'sp_atm',
                                    'posts_per_page' => -1, 
                                );    
                            endif;
                            $loop = new WP_Query( $args );
                            while ( $loop->have_posts() ) : $loop->the_post(); 
                            ?>
                            [<?php echo get_post_meta($post->ID, 'sp_atm_lat_long_map', true); ?>, 
                                    '<div class="info-content">' + 
                                    '<h4><?php the_title(); ?></h4>' + 
                                    '<p><?php echo get_post_meta($post->ID, "sp_atm_address", true); ?></p>' ],
                            <?php endwhile;   
                            wp_reset_postdata(); ?>
        ];

        function initialize()
        {
            var map =
                new google.maps.Map(document.getElementById('map-canvas'));
            var bounds = new google.maps.LatLngBounds();
            var infowindow = new google.maps.InfoWindow();

            var markers = [];
            for (var i in LocationData)
            {
                var p = LocationData[i];
                var latlng = new google.maps.LatLng(p[0], p[1]);
                bounds.extend(latlng);
                 
                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: p[2]
                });
                markers.push(marker);

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(this.title);
                    infowindow.open(map, this);
                });
            }var markerCluster = new MarkerClusterer(map, markers);

            map.fitBounds(bounds);
        }
        google.maps.event.addDomListener(window, 'load', initialize);

      });
    </script>

    <style type="text/css">
      #map-canvas {
        width: 100%;
        height: 500px;
      }
      .info-content {
        width: 250px;
        height: auto;
      }
      #category_panel {
        padding: 10px;
      }
      #category_panel input {
        width: 100px;
      }
      #category_panel #atm-bank, #category_panel #atm-location  {
        /*padding: 1px;*/
      }
      @media screen and (max-width: 580px) {
        #category_panel {
          padding: 0;
        }
        #category_panel .one-fourth {
          margin-bottom: 10px;
        }
      }
    </style>
<?php get_footer(); ?>