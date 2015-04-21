<?php
add_action('init', 'sp_classification_init', 0);
function sp_classification_init() {
	register_taxonomy(
		'sp_classification',
		array( 'sp_listing' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Classification', 'sptheme_admin' ),
				'singular_name' => __( 'Classification', 'sptheme_admin' ),
				'search_items' =>  __( 'Search Classification', 'sptheme_admin' ),
				'all_items' => __( 'All Classifications', 'sptheme_admin' ),
				'parent_item' => __( 'Parent Classification', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent Classification:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit Classification', 'sptheme_admin' ),
				'update_item' => __( 'Update Classification', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New Classification', 'sptheme_admin' ),
				'new_item_name' => __( 'Classification', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'listing-category' )
		)
	);
}