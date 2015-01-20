<?php
add_action('init', 'sp_atm_init', 0);
function sp_atm_init() {
	register_taxonomy(
		'sp_atm_bank',
		array( 'sp_atm' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'ATM Bank', 'sptheme_admin' ),
				'singular_name' => __( 'ATM Bank', 'sptheme_admin' ),
				'search_items' =>  __( 'Search ATM Bank', 'sptheme_admin' ),
				'all_items' => __( 'All Cities', 'sptheme_admin' ),
				'parent_item' => __( 'Parent ATM Bank', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent ATM Bank:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit ATM Bank', 'sptheme_admin' ),
				'update_item' => __( 'Update ATM Bank', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New ATM Bank', 'sptheme_admin' ),
				'new_item_name' => __( 'ATM Bank', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'atm' )
		)
	);
}