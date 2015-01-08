<?php
add_action('init', 'sp_city_init', 0);
function sp_city_init() {
	register_taxonomy(
		'sp_city',
		array( 'sp_movie', 'sp_listing', 'sp_atm' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'City', 'sptheme_admin' ),
				'singular_name' => __( 'City', 'sptheme_admin' ),
				'search_items' =>  __( 'Search City', 'sptheme_admin' ),
				'all_items' => __( 'All Cities', 'sptheme_admin' ),
				'parent_item' => __( 'Parent City', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent City:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit City', 'sptheme_admin' ),
				'update_item' => __( 'Update City', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New City', 'sptheme_admin' ),
				'new_item_name' => __( 'City', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'city' )
		)
	);
}