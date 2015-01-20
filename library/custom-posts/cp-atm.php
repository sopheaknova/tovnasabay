<?php
/*
*****************************************************
* ATMs custom post
*
* CONTENT:
* - 1) Actions and filters
* - 2) Creating a custom post
* - 3) Custom post list in admin
*****************************************************
*/





/*
*****************************************************
*      1) ACTIONS AND FILTERS
*****************************************************
*/
	//ACTIONS
		//Registering CP
		add_action( 'init', 'sp_atm_cp_init' );
		
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_atm_cp_custom_column' );

		// Remove/Unset ATMs taxonomy
		add_action( 'admin_init', 'sp_remove_atm_taxonomy' );

		// Save ATMs post
		add_action( 'save_post', 'sp_save_atm' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-sp_atm_columns', 'sp_atm_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_atm_cp_init' ) ) {
		function sp_atm_cp_init() {
			global $cp_menu_position;

			
			$labels = array(
				'name'               => __( 'ATMs', 'sptheme_admin' ),
				'singular_name'      => __( 'ATM', 'sptheme_admin' ),
				'add_new'            => __( 'Add New', 'sptheme_admin' ),
				'all_items'          => __( 'ATMs', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New ATM', 'sptheme_admin' ),
				'new_item'           => __( 'Add New ATM', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit ATM', 'sptheme_admin' ),
				'view_item'          => __( 'View ATM', 'sptheme_admin' ),
				'search_items'       => __( 'Search ATM', 'sptheme_admin' ),
				'not_found'          => __( 'No ATM found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No ATM found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent ATM', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'atm';
			$supports = array('title'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['menu_atm'],
				'menu_icon'           	=> 'dashicons-welcome-view-site',
				'supports'              => $supports,
				'capability_type'     	=> $role,
				'query_var'           	=> true,
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_nav_menus'	    => false,
				'publicly_queryable'	=> true,
				'exclude_from_search'   => false,
				'has_archive'			=> true,
				'can_export'			=> true
			);
			register_post_type( 'sp_atm' , $args );
		}
	} 


/*
*****************************************************
*      3) CUSTOM POST LIST IN ADMIN
*****************************************************
*/
	/*
	* Registration of the table columns
	*
	* $Cols = ARRAY [array of columns]
	*/
	if ( ! function_exists( 'sp_atm_cp_columns' ) ) {
		function sp_atm_cp_columns( $columns ) {
			
			$columns['cb']                   	= '<input type="checkbox" />';
			$columns['title']                	= __( 'Title', 'sptheme_admin' );
			$columns['atm_address']             = __( 'address', 'sptheme_admin' );
			$columns['atm_town']                = __( 'Towns/Cities', 'sptheme_admin' );
			$columns['date']		 			= __( 'Date', 'sptheme_admin' );
			

			return $columns;
		}
	}

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_atm_cp_custom_column' ) ) {
		function sp_atm_cp_custom_column( $column ) {
			global $post;

			switch ( $column ) {
				
				case "atm_address":
					echo get_post_meta( $post->ID, 'sp_atm_address', true );
					break;

				case "atm_town":
					the_terms( $post->ID, 'sp_city' );
					break;

				default:
				break;
			}
		}
	} // /sp_atm_cp_custom_column


	/*
	* Custom function
	*
	*/
	if ( ! function_exists( 'sp_remove_atm_taxonomy' ) ) {
		function sp_remove_atm_taxonomy(){
			remove_meta_box( 'sp_atm_bankdiv', 'sp_atm', 'side' );
			remove_meta_box( 'sp_citydiv', 'sp_atm', 'side' );
		}
	}

	/*
	* Update meta position value on position term
	* 
	*/
	if ( ! function_exists( 'sp_save_atm' ) ) {
		function sp_save_atm( $post_id ) {
			global $post;
			if (get_post_type() == 'sp_atm') {
				if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
				wp_set_post_terms( $post->ID, $_POST['sp_atm_bank'], 'sp_atm_bank' );
				wp_set_post_terms( $post->ID, $_POST['sp_atm_bank_location'], 'sp_city' );
			}
		}
	}

	