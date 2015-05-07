<?php

/*  Initialize the meta boxes.
/* ------------------------------------ */
add_action( 'admin_init', '_custom_meta_boxes' );

function _custom_meta_boxes() {

	$prefix = 'sp_';
  
/*  Custom meta boxes
/* ------------------------------------ */
$page_layout_options = array(
	'id'          => 'page-options',
	'title'       => 'Page Options',
	'desc'        => '',
	'pages'       => array( 'page', 'post' ),
	'context'     => 'normal',
	'priority'    => 'default',
	'fields'      => array(
		array(
			'label'		=> 'Primary Sidebar',
			'id'		=> $prefix . 'sidebar_primary',
			'type'		=> 'sidebar-select',
			'desc'		=> 'Overrides default'
		),
		array(
			'label'		=> 'Layout',
			'id'		=> $prefix . 'layout',
			'type'		=> 'radio-image',
			'desc'		=> 'Overrides the default layout option',
			'std'		=> 'inherit',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Layout',
					'src'		=> SP_ASSETS . '/images/admin/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> SP_ASSETS . '/images/admin/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> SP_ASSETS . '/images/admin/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> SP_ASSETS . '/images/admin/col-2cr.png'
				)
			)
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: video
/* ---------------------------------------------------------------------- */
$post_format_video = array(
	'id'          => 'format-video',
	'title'       => 'Format: Video',
	'desc'        => 'These settings enable you to embed videos into your posts.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Video URL',
			'id'		=> $prefix . 'video_url',
			'type'		=> 'text',
			'desc'		=> 'Enter Video Embed URL from youtube, vimeo or dailymotion'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Audio
/* ---------------------------------------------------------------------- */
$post_format_audio = array(
	'id'          => 'format-audio',
	'title'       => 'Format: Audio',
	'desc'        => 'These settings enable you to embed audio into your posts. You must provide both .mp3 and .ogg/.oga file formats in order for self hosted audio to function accross all browsers.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Audio URL',
			'id'		=> $prefix . 'audio_url',
			'type'		=> 'upload',
			'desc'		=> 'You can get sound or audio URL from soundcloud'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Gallery
/* ---------------------------------------------------------------------- */
$post_format_gallery = array(
	'id'          => 'format-gallery',
	'title'       => 'Format: Gallery',
	'desc'        => 'Standard post galleries.</i>',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Upload photo',
			'id'		=> $prefix . 'post_gallery',
			'type'		=> 'gallery',
			'desc'		=> 'Upload photos'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Chat
/* ---------------------------------------------------------------------- */
$post_format_chat = array(
	'id'          => 'format-chat',
	'title'       => 'Format: Chat',
	'desc'        => 'Input chat dialogue.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Chat Text',
			'id'		=> $prefix . 'chat',
			'type'		=> 'textarea',
			'rows'		=> '2'
		)
	)
);
/* ---------------------------------------------------------------------- */
/*	Post Format: Link
/* ---------------------------------------------------------------------- */
$post_format_link = array(
	'id'          => 'format-link',
	'title'       => 'Format: Link',
	'desc'        => 'Input your link.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Link Title',
			'id'		=> $prefix . 'link_title',
			'type'		=> 'text'
		),
		array(
			'label'		=> 'Link URL',
			'id'		=> $prefix . 'link_url',
			'type'		=> 'text'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: quote
/* ---------------------------------------------------------------------- */
$post_format_quote = array(
	'id'          => 'format-quote',
	'title'       => 'Format: Quote',
	'desc'        => 'Input your quote.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Quote',
			'id'		=> $prefix . 'quote',
			'type'		=> 'textarea',
			'rows'		=> '2'
		),
		array(
			'label'		=> 'Quote Author',
			'id'		=> $prefix . 'quote_author',
			'type'		=> 'text'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Movie post type
/* ---------------------------------------------------------------------- */
$post_type_movie = array(
	'id'          => 'movie-setting',
	'title'       => 'Movie meta',
	'desc'        => '',
	'pages'       => array( 'sp_movie' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		
		/*array(
			'label'		=> 'Now Showing',
			'id'		=> $prefix . 'showing',
			'type'        => 'on-off',
	        'desc'        => 'Enable to switch movie to be showtime/coming soon',
	        'std'         => 'off'
		),*/
		array(
			'label'		=> 'Movie thumbnail',
			'id'		=> $prefix . 'movie_thumb',
			'type'		=> 'upload',
			'desc'		=> 'Upload photo for thumbnail to show in homepage and archive'
		),
		array(
			'label'		=> 'Language',
			'id'		=> $prefix . 'language',
			'type'		=> 'text',
			'desc'		=> 'e.g: English (Sub Title Khmer)'
		),
		array(
			'label'		=> 'Rating',
			'id'		=> $prefix . 'movie_rating',
			'type'		=> 'select',
			'desc'		=> 'Select movie type(G, PG, PG-13, R or NC-17) who can watch this movie',
			'choices'	=> array( 
	          array(
	            'value'       => '',
	            'label'       => 'none',
	            'src'         => ''
	          ),
	          array(
	            'value'       => 'g',
	            'label'       => 'G - General Audiences Of All Ages',
	            'src'         => ''
	          ),
	          array(
	            'value'       => 'pg',
	            'label'       => 'PG - Not Be Suitable For Children',
	            'src'         => ''
	          ),
	          array(
	            'value'       => 'pg-13',
	            'label'       => 'PG-13 - May Be Inappropriate For Children Under 13',
	            'src'         => ''
	          ),
	          array(
	            'value'       => 'r',
	            'label'       => 'R - Children Under 17 Require Parent Or Adult Guardian',
	            'src'         => ''
	          ),
	          array(
	            'value'       => 'nc-17',
	            'label'       => 'NC-17 - No One 17 And Under Admitted',
	            'src'         => ''
	          )
	        )
		),
		array(
			'label'		=> 'Genre',
			'id'		=> $prefix . 'genre',
			'type'		=> 'text',
			'desc'		=> 'Type of movie. e.g: Advanture, Action...'
		),
		array(
			'label'		=> 'Content Advice',
			'id'		=> $prefix . 'content_advice',
			'type'		=> 'text',
			'desc'		=> 'e.g: American. Use "," for multiple countries'
		),
		array(
			'label'		=> 'Run time',
			'id'		=> $prefix . 'runtime',
			'type'		=> 'text',
			'desc'		=> 'Enter run time. e.g: 108'
		),
		array(
			'label'		=> 'Video trailer',
			'id'		=> $prefix . 'video_trailer',
			'type'		=> 'text',
			'desc'		=> 'Enter url of video'
		),
		array(
			'label'		=> 'Show Times',
			'id'		=> $prefix . 'showtimes',
			'type'		=> 'list-item',
			'desc'		=> 'Add show times link of each cinemas',
			'settings'	=> array( 
	          array(
					'label'		=> 'Cinema',
					'id'		=> $prefix . 'cinema',
					'type'		=> 'taxonomy-select',
					'taxonomy'  => 'sp_cinema',
				),
	          array(
					'label'		=> 'Show time page',
					'id'		=> $prefix . 'showtime_page',
					'type'		=> 'text'
				)
	        )  
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Listing post type
/* ---------------------------------------------------------------------- */
$post_type_listing = array(
	'id'          => 'listing-setting',
	'title'       => 'Listing meta',
	'desc'        => '',
	'pages'       => array( 'sp_listing' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Address',
			'id'		=> $prefix . 'lt_address',
			'type'		=> 'textarea',
			'desc'		=> 'Enter address of listing',
			'rows'      => '2',
		),
		array(
			'label'		=> 'Google Map',
			'id'		=> $prefix . 'lat_long_map',
			'type'		=> 'text',
			'desc'		=> 'Enter Latitute and longitute of google map. You can get it from <a href="http://itouchmap.com/latlong.html" target="_blank">iTouchMap</a>'
		),
		array(
			'label'		=> 'Communication Line',
			'id'		=> $prefix . 'lt_comm_line',
			'type'		=> 'list-item',
			'settings'    => array( 
				array(
					'label'		=> 'Value',
					'id'		=> $prefix . 'lt_comm_type',
					'type'		=> 'select',
					'choices'     => array(
						array(
				            'value'       => 'telephone',
				            'label'       => 'Telephone',
				            'src'         => ''
				          ),
						array(
				            'value'       => 'mobile',
				            'label'       => 'Mobile',
				            'src'         => ''
				          ),
						array(
				            'value'       => 'e-mail',
				            'label'       => 'E-mail',
				            'src'         => ''
				          ),
						array(
				            'value'       => 'fax',
				            'label'       => 'Fax',
				            'src'         => ''
				          ),
						array(
				            'value'       => 'website',
				            'label'       => 'Website',
				            'src'         => ''
				          ),
						array(
				            'value'       => 'hours',
				            'label'       => 'Hours',
				            'src'         => ''
				          )
					)
				),
				array(
					'label'		=> 'Value',
					'id'		=> $prefix . 'lt_comm_value',
					'type'		=> 'text',
				)
			)
		),
		array(
			'label'		=> 'Gallery',
			'id'		=> $prefix . 'gallery',
			'type'		=> 'gallery',
			'desc'		=> 'Upload image gallery for listing'
		),
	)
);	

/* ---------------------------------------------------------------------- */
/*	ATMs post type
/* ---------------------------------------------------------------------- */
$post_type_atm = array(
	'id'          => 'atm-setting',
	'title'       => 'ATMs meta',
	'desc'        => '',
	'pages'       => array( 'sp_atm' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Address',
			'id'		=> $prefix . 'atm_address',
			'type'		=> 'textarea',
			'desc'		=> 'Enter address of listing',
			'rows'      => '2',
		),
		array(
			'label'		=> 'Google Map',
			'id'		=> $prefix . 'atm_lat_long_map',
			'type'		=> 'text',
			'desc'		=> 'Enter Latitute and longitute of google map. You can get it from <a href="http://itouchmap.com/latlong.html" target="_blank">iTouchMap</a>'
		),
		array(
			'label'		=> 'Bank Name',
			'id'		=> $prefix . 'atm_bank',
			'type'		=> 'taxonomy-select',
			'taxonomy' 	=> 'sp_atm_bank',
		),
		array(
			'label'		=> 'Location',
			'id'		=> $prefix . 'atm_bank_location',
			'type'		=> 'taxonomy-select',
			'taxonomy' 	=> 'sp_city',
		)
	)
);	


/*  Register meta boxes
/* ------------------------------------ */
	ot_register_meta_box( $page_layout_options );
	ot_register_meta_box( $post_format_audio );
	ot_register_meta_box( $post_format_chat );
	ot_register_meta_box( $post_format_gallery );
	ot_register_meta_box( $post_format_link );
	ot_register_meta_box( $post_format_quote );
	ot_register_meta_box( $post_format_video );
	ot_register_meta_box( $post_type_movie );
	ot_register_meta_box( $post_type_listing );
	ot_register_meta_box( $post_type_atm );
}