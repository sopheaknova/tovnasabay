<?php

/**
 * ----------------------------------------------------------------------------------------
 * Load Post type and Toxonomy
 * ----------------------------------------------------------------------------------------
 */

//Custom post WordPress admin menu position - 30, 33, 39, 42, 45, 48
if ( ! isset( $cp_menu_position ) )
	$cp_menu_position = array(
			'menu_movie'	=> 30,
            'menu_listing'  => 33,
            'menu_atm'      => 39
		);

//All custom posts
load_template( SP_BASE_DIR . '/library/custom-posts/cp-movie.php' );
/*load_template( SP_BASE_DIR . '/library/custom-posts/cp-listing.php' );
load_template( SP_BASE_DIR . '/library/custom-posts/cp-atm.php' );*/

//Taxonomies
//load_template( SP_BASE_DIR . '/library/custom-posts/taxonomy-classification.php' );
load_template( SP_BASE_DIR . '/library/custom-posts/taxonomy-city.php' );
load_template( SP_BASE_DIR . '/library/custom-posts/taxonomy-cinema.php' );
	
/**
 * ----------------------------------------------------------------------------------------
 * Set Default Terms for your Custom Taxonomies
 * ----------------------------------------------------------------------------------------
 * @author    Michael Fields     http://wordpress.mfields.org/
 *
 * @since     2010-09-13
 * @alter     2010-09-14
 *
 * @license   GPLv2
 */
function sp_set_default_object_terms( $post_id, $post ) {
    if ( 'publish' === $post->post_status ) {
        $defaults = array(
            //'post_tag' => array( 'taco', 'banana' ),
            'sp_classification' => array( 'Uncategorized' ),
            'sp_city' => array( 'Phnom Penh' ),
            'sp_cinema' => array( 'Legend Cinema' )
            );
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
            $terms = wp_get_post_terms( $post_id, $taxonomy );
            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
            }
        }
    }
}
add_action( 'save_post', 'sp_set_default_object_terms', 100, 2 );