<?php
/*
*****************************************************
* Movie custom post
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
		add_action( 'init', 'sp_movie_cp_init' );
		
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_movie_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-sp_movie_columns', 'sp_movie_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_movie_cp_init' ) ) {
		function sp_movie_cp_init() {
			global $cp_menu_position;

			
			$labels = array(
				'name'               => __( 'Movies', 'sptheme_admin' ),
				'singular_name'      => __( 'Movie', 'sptheme_admin' ),
				'add_new'            => __( 'Add New', 'sptheme_admin' ),
				'all_items'          => __( 'Movies', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New Movie', 'sptheme_admin' ),
				'new_item'           => __( 'Add New Movie', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit Movie', 'sptheme_admin' ),
				'view_item'          => __( 'View Movie', 'sptheme_admin' ),
				'search_items'       => __( 'Search Movie', 'sptheme_admin' ),
				'not_found'          => __( 'No Movie found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No Movie found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent Movie', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'movie';
			$supports = array('title', 'editor', 'thumbnail'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['menu_movie'],
				'menu_icon'           	=> 'dashicons-format-video',
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
			register_post_type( 'sp_movie' , $args );
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
	if ( ! function_exists( 'sp_movie_cp_columns' ) ) {
		function sp_movie_cp_columns( $columns ) {
			
			$columns['cb']                   	= '<input type="checkbox" />';
			$columns['thumbnail']               = __( 'Cover', 'sptheme_admin' );
			$columns['title']                	= __( 'Title', 'sptheme_admin' );
			$columns['movie_town']              = __( 'Towns/Cities', 'sptheme_admin' );
			$columns['cinema']                	= __( 'Cinema/Theater', 'sptheme_admin' );
			$columns['date']		 			= __( 'Date', 'sptheme_admin' );
			

			return $columns;
		}
	}

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_movie_cp_custom_column' ) ) {
		function sp_movie_cp_custom_column( $column ) {
			global $post;

			switch ( $column ) {
				
				case "thumbnail":
					echo get_the_post_thumbnail( $post->ID, array(70, 70) );
					break;

				case "movie_town":
					the_terms( $post->ID, 'sp_city' );
					break;

				case "cinema":
					the_terms( $post->ID, 'sp_cinema' );
					break;

				default:
				break;
			}
		}
	} // /sp_movie_cp_custom_column

	