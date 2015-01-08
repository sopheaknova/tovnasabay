<?php
add_action('init', 'sp_cinema_init', 0);

function sp_cinema_init() {
	register_taxonomy(
		'sp_cinema',
		array( 'sp_movie' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Cinemas', 'sptheme_admin' ),
				'singular_name' => __( 'Cinema', 'sptheme_admin' ),
				'search_items' =>  __( 'Search Cinemas', 'sptheme_admin' ),
				'all_items' => __( 'All Cinemas', 'sptheme_admin' ),
				'parent_item' => __( 'Parent Cinemas', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent Cinemas:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit Cinemas', 'sptheme_admin' ),
				'update_item' => __( 'Update Cinemas', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New Cinemas', 'sptheme_admin' ),
				'new_item_name' => __( 'Cinema', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'cinema' )
		)
	);
}

add_action('sp_cinema_add_form_fields','sp_cinema_add_extra_fields', 10, 2);
add_action('sp_cinema_edit_form_fields','sp_cinema_edit_extra_fields', 10, 2);
add_action('edited_sp_cinema', 'sp_cinema_save_extra_fields', 10, 2);
add_action('create_sp_cinema', 'sp_cinema_save_extra_fields', 10, 2);
add_filter('manage_edit-sp_cinema_columns', 'sp_cinema_edit_columns');
add_action('manage_sp_cinema_custom_column', 'sp_cinema_custom_columns', 5,3);
add_action('admin_enqueue_scripts', 'sp_edit_tags_script');

/** 
 * Adding Custom Meta Fields to Taxonomies
 *
 * @link https://pippinsplugins.com/adding-custom-meta-fields-to-taxonomies/ 
 *
 */

function sp_edit_tags_script($hook) {
	//if ( ('edit-tags.php' != $hook) ) return;
	if ( (isset($_GET['taxonomy']) && $_GET['taxonomy'] != 'sp_cinema') ) return;
    wp_enqueue_media();
    wp_enqueue_script( 'edit-tags-script', SP_ASSETS . '/js/admin-edit-tags-script.js' );
}

function sp_cinema_edit_columns($columns) {
	$columns = array(
		"cb" 		=> "<input type=\"checkbox\" />",
		"name" 		=> __('Name', 'sptheme_admin'),
		"address" 	=> __('Address', 'sptheme_admin'),
		"email" 	=> __('Email', 'sptheme_admin'),
		"phone" 	=> __('Phone', 'sptheme_admin'),
		"posts" 	=> __('Matches', 'sptheme_admin')
	);
	return $columns;
}

function sp_cinema_custom_columns($value, $column, $term_id) {
	global $post;
	$term_meta = get_option( "taxonomy_term_$term_id" );
	switch ($column) {
		case 'address':
			echo $term_meta['sp_address'];
			break;

		case 'email':
			echo $term_meta['sp_email'];
			break;		

		case 'phone':
			echo $term_meta['sp_phone'];
			break;

		default:
			break;		
	}
}

function sp_cinema_add_extra_fields() {
	?>
	<div class="form-field">
        <label for="term_meta[sp_cinema_logo]"><?php _e('Cinema Logo', 'sptheme_admin'); ?></label>
        <input type="text" name="term_meta[sp_cinema_logo]" id="term_meta[sp_cinema_logo]" value=""/>
        <input type="button" class="button tagadd media-select" value="Upload Logo">
    </div>

<?php	
}

function sp_cinema_edit_extra_fields( $term ) {
	$t_id = $term->term_id;
	$term_meta = get_option( "taxonomy_$t_id" );

?>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[sp_address]"><?php _e('Address', 'sptheme_admin'); ?></label>
		</th>
		<td>
			<input name="term_meta[sp_address]" id="term_meta[sp_address]" type="text" value="<?php echo esc_attr($term_meta['sp_address']) ? esc_attr($term_meta['sp_address']) : '' ?>" size="40"><br />
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[sp_email]"><?php _e('Email', 'sptheme_admin'); ?></label>
		</th>
		<td>
			<input name="term_meta[sp_email]" id="term_meta[sp_email]" type="text" value="<?php echo esc_attr($term_meta['sp_email']) ? esc_attr($term_meta['sp_email']) : '' ?>" size="40"><br />
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[sp_phone]"><?php _e('Phone', 'sptheme_admin'); ?></label>
		</th>
		<td>
			<input name="term_meta[sp_phone]" id="term_meta[sp_phone]" type="text" value="<?php echo esc_attr($term_meta['sp_phone']) ? esc_attr($term_meta['sp_phone']) : '' ?>" size="40"><br />
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[sp_openhour]"><?php _e('Open hour', 'sptheme_admin'); ?></label>
		</th>
		<td>
			<input name="term_meta[sp_openhour]" id="term_meta[sp_openhour]" type="text" value="<?php echo esc_attr($term_meta['sp_openhour']) ? esc_attr($term_meta['sp_openhour']) : '' ?>" size="40"><br />
			<p class="description">e.g: 9:00am - 9:00pm</p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[sp_website]"><?php _e('Website', 'sptheme_admin'); ?></label>
		</th>
		<td>
			<input name="term_meta[sp_website]" id="term_meta[sp_website]" type="text" value="<?php echo esc_attr($term_meta['sp_website']) ? esc_attr($term_meta['sp_website']) : '' ?>" size="40"><br />
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top">
			<label for="term_meta[sp_lat_long]"><?php _e('Marker location', 'sptheme_admin'); ?></label>
		</th>
		<td>
			<input name="term_meta[sp_lat_long]" id="term_meta[sp_lat_long]" type="text" value="<?php echo esc_attr($term_meta['sp_lat_long']) ? esc_attr($term_meta['sp_lat_long']) : '' ?>" size="40"> 
			<p class="description">Get the Latitude and Longitude of a Point. You can get it from <a href="http://itouchmap.com/latlong.html" target="_blank">iTouchMap</a></p>
		</td>
	</tr>
	<tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[sp_cinema_logo]"><?php _e('Cinema Logo', 'sptheme_admin'); ?></label></th>
        <td>
            <input type="text" name="term_meta[sp_cinema_logo]" id="term_meta[sp_cinema_logo]" value="<?php echo $term_meta['sp_cinema_logo'] ? $term_meta['sp_cinema_logo'] : '' ?>" style="width: 80%;"/>
            <input type="button" class="button tagadd media-select" value="Upload Logo">
            <img id="tags-thumbnail" src="<?php echo esc_attr($term_meta['sp_cinema_logo']) ? esc_attr($term_meta['sp_cinema_logo']) : '' ?>" width="150" style="background:#ffffff; padding:10px; margin-top:10px;">
        </td>
    </tr>
<?php
}

function sp_cinema_save_extra_fields( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ){
			if ( isset( $_POST['term_meta'][$key] ) ){
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		update_option( "taxonomy_$t_id", $term_meta );
	}
}