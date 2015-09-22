<?php
/**
 * Template Name: Contact
 */
?>

<?php get_header(); ?>

<?php 
    //Past meta value into var
    $map_locations = ('11.544283, 104.923957'); 
    $map_loc = explode(',', $map_locations);
    $latitude_center = $map_loc[0] + 0.000;// Variable to align the marker on the right side of the map, instead of the center    
?>    
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        var map_styles = [
            {
                // Style the map with the custom hue
                stylers: [
                    // { "hue":"#f0734b" }
                ]
            },
            {
                // Remove road labels
                featureType:"road",
                elementType:"labels",
                stylers: [
                    { "visibility":"off" }
                ]
            },
            {
                // Style the road
                featureType:"road",
                elementType:"geometry",
                stylers: [
                    { "lightness":100 },
                    { "visibility":"simplified" }
                ]
            }
        ];
        
        var mapOptions = {  
            center: new google.maps.LatLng(<?php echo $latitude_center . ',' . $map_loc[1]; ?>),
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            panControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            streetViewControl:false,
            zoom:15,
            mapTypeControlOptions: {
                mapTypeIds:[]
            }
        }
        var map = new google.maps.Map(document.getElementById("single-map-canvas"), mapOptions);

        var styledMap = new google.maps.StyledMapType(map_styles, { name:"Contact Map" });

        map.mapTypes.set('Contact Map', styledMap);
        map.setMapTypeId('Contact Map');
        
        
        //var image = '<img src="<?php echo SP_ASSETS; ?>/images/google-map-marker.png">';  Marker image

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo $map_loc[0] . ',' . $map_loc[1]; ?>), 
            map: map,
            // icon: image,
            animation: google.maps.Animation.DROP
        });

        /*$('.sp-contact-form').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                message: "required",
            },
            submitHandler: function (form) {
                var data = {
                    action:"sp_send_contact_form",
                    inquiry : $('.sp-contact-form').serialize()
                };
                $.post( theme_objects.ajaxURL, data, function(data) {
                    $('.sp-contact-form').hide();
                    $('#result').html(data);
                });
                return false;
            }
        });*/

    });
</script>

<?php do_action( 'sp_start_content_wrap_html' ); ?>
    <div class="main">
    	<?php
			// Start the Loop.
			while ( have_posts() ) : the_post(); ?>
				<header class="entry-header content-padding-side">
					<h2 class="entry-title"><?php the_title(); ?></h2>
				</header><!-- .entry-header -->
				<div id="single-map-canvas" class="google-map-img-reset" style="width:100%; height: 420px; margin-bottom: 10px;"></div>
				<div class="entry-content content-padding-side">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', SP_TEXT_DOMAIN ) ); ?>
				</div><!-- .entry-content -->


			<?php endwhile;
		?>
	</div><!-- #main -->
	<?php get_sidebar();?>
<?php do_action( 'sp_end_content_wrap_html' ); ?>
	
<?php get_footer(); ?>