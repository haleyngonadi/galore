<?php
/**
 * Add new fields
 * && remove some
 */

function listable_add_hours_field( $fields ) {

	$fields['_company_facebook'] = array(
		'label'       => esc_html__( 'Facebook', 'listable' ),
		'placeholder' => esc_html__( 'add your facebook url', 'listable' ),
		'priority' => 2.5
	);
    
    $fields['_contact_poster'] = array(
		'label'       => esc_html__( 'Let people contact you?', 'afrigalore' ),
        'priority' => 2.4,
        'type'        => 'checkbox',
        'description'       =>  esc_html__( 'An email will be sent to you by interested clients.', 'afrigalore' ),
	);

    
    

	// reorder fields
	$fields['_company_tagline']['priority'] = 2.1;
	$fields['_job_location']['priority']    = 2.2;
	$fields['_company_twitter']['priority'] = 2.6;

	$fields['_job_hours'] = array(
		'label'       => esc_html__( 'Hours', 'listable' ),
		'type'        => 'textarea',
		'placeholder' => esc_html__( "Mon - Fri: 09:00 - 23:00 \nSat - Sun: 17:00 - 23:00", 'listable' ),
//		'description' => '',
		'priority'    => 2.8
	);
    
    	$fields['_company_email'] = array(
		'label'       => esc_html__( 'Email', 'listable' ),
		'placeholder' => esc_html__( "your@email.com", 'listable' ),
		'priority'    => 2.3
	);
    
    

	$fields['_company_phone'] = array(
		'label'       => esc_html__( 'Phone', 'listable' ),
//		'type'        => 'number',
		'placeholder' => esc_html__( 'e.g +42-898-4364', 'listable' ),
//		'description' => ''
		'priority'    => 2.6
	);

	unset( $fields['_company_logo'] );
	unset( $fields['_company_video'] );
	unset( $fields['_company_name'] );
	unset( $fields['_application'] );

	return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'listable_add_hours_field', 1 );
add_filter( 'submit_job_form_fields', 'custom_submit_job_form_fields' );

function listable_add_total_jobs_found_number_to_ajax_response( $results, $jobs ) {
	if ( true === $results['found_jobs'] ) {
		$results['total_found'] = $jobs->found_posts;
	} else {
		$results['total_found'] = 0;
	}

	return $results;
}

add_filter( 'job_manager_get_listings_result', 'listable_add_total_jobs_found_number_to_ajax_response', 10, 2 );

function custom_submit_job_form_fields( $fields ) {
	array_walk_recursive( $fields, 'listable_replace_jobs_with_listenings' );

		$fields['company']['company_facebook'] = array(
		'label' => 'Facebook url',
			'type' => 'text',
		'required' => false,
		'placeholder' => 'http://facebook.com/yourusername',
			'priority' => 6
		);

	// uncomment here to see what you can do
//	var_dump($fields);

	$fields['job']['job_title']['label']       = esc_html__( 'Listing Name', 'listable' );
	$fields['job']['job_title']['placeholder'] = esc_html__( 'Your listing name', 'listable' );

	$fields['company']['company_tagline']['priority']    = 2.1;
	$fields['company']['company_tagline']['placeholder'] = esc_html__( 'e.g Speciality Coffe Shop', 'listable' );
	$fields['company']['company_tagline']['description'] = sprintf( '<span class="description_tooltip left">%s</span>', esc_html__( 'Keep it short and descriptive as it will appear on search results instead of the ling description', 'listable' ) );

	$fields['job']['job_description']['priority']    = 2.2;
	$fields['job']['job_description']['type']        = 'textarea';
	$fields['job']['job_description']['placeholder'] = esc_html__( 'An overview of your listing and the things you love about it.', 'listable' );

	$fields['job']['job_category']['priority']    = 2.3;
	$fields['job']['job_category']['placeholder'] = esc_html__( 'Choose one or more categories', 'listable' );

	$fields['job']['job_category']['description'] = sprintf( '<span class="description_tooltip right">%s</span>', esc_html__( 'Visitors can filter their search by the categories and amenities they want - so make sure you choose them wisely and include all the relevant ones', 'listable' ) );

	$fields['job']['job_tags']['priority']    = 2.4;
	$fields['job']['job_tags']['placeholder'] = esc_html__( 'Add tags', 'listable' );
	$fields['job']['job_tags']['description'] = esc_html__( 'Visitors can filter their search by the amenities too, so make sure you include all the relevant ones.', 'listable' );

	$fields['job']['job_location']['priority']    = 2.5;
	$fields['job']['job_location']['placeholder'] = esc_html__( 'e.g 34 Wigmore Street, London', 'listable' );
	$fields['job']['job_location']['description'] = esc_html__( 'Leave this blank if the location is not important.', 'listable' );

	$fields['company']['company_logo']['label']    = esc_html__( 'Gallery Images', 'listable' );
	$fields['company']['company_logo']['priority']    = 2.6;
	$fields['company']['company_logo']['multiple']    = true;
	$fields['company']['company_logo']['description'] = esc_html__( 'The first image will be shown on listing cards.', 'listable' );

	$fields['job']['job_hours'] = array(
		'label'       => esc_html__( 'Hours of Operation', 'listable' ),
		'type'        => 'textarea',
		'placeholder' => esc_html__( "Mon - Fri: 09:00 - 23:00 \nSat - Sun: 17:00 - 23:00", 'listable' ),
		'description' => sprintf( '<span class="description_tooltip right">%s</span>', esc_html__( 'Feel free to change the text format to fit your needs.', 'listable' ) ),
		'required'    => false,
		'priority'    => 2.7
	);

	$fields['company']['company_phone'] = array(
		'label'       => esc_html__( 'Phone', 'listable' ),
		'type'        => 'text',
		'placeholder' => esc_html__( 'e.g +42-898-4364', 'listable' ),
		'required'    => false,
		'priority'    => 2.8
	);
    
    	$fields['company']['company_email'] = array(
		'label'       => esc_html__( 'email', 'listable' ),
		'type'        => 'text',
		'placeholder' => esc_html__( 'e.g your@email.com', 'listable' ),
		'required'    => false,
		'priority'    => 2.9
	);
    
    $fields['job']['contact_poster'] = array(
		'label'       => esc_html__( 'email', 'afrigalore' ),
		'type'        => 'checkbox',
		'required'    => true,
		'priority'    => 3,
        'description'       =>  esc_html__( 'An email will be sent to you by interested clients.', 'afrigalore' ),


	);
    
    
    

	$fields['company']['company_website']['priority']    = 2.9;
	$fields['company']['company_website']['placeholder'] = esc_html__( 'e.g yourwebsite.com, London', 'listable' );
	$fields['company']['company_website']['description'] = esc_html__( 'You can add more similar panels to better help the user fill the form', 'listable' );


	// temporary unsets
	unset( $fields['company']['company_video'] );
	unset( $fields['job']['job_type'] );
	unset( $fields['company']['company_name'] );
	unset( $fields['job']['application'] );

//	$fields['company']['company_name']['priority'] = 1.5;

	return $fields;
}

function display_average_listing_rating( $post_id = null, $decimals = 2 ) {

	if ( empty( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}

	global $pixreviews_plugin;

	if ( method_exists( $pixreviews_plugin, 'get_average_rating' ) ) {
		$rating = $pixreviews_plugin->get_average_rating( $post_id, $decimals );
	}

	if ( empty( $rating ) ) {
		return;
	} ?>
	<a href="#comments" class="single-rating review_rate display-only" data-pixrating="<?php echo $rating ?>" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
		<span class="rating-value">(<span itemprop="reviewCount"><?php echo get_comments_number() ?></span>)</span>
		<meta itemprop="ratingValue" content = "<?php echo $rating ?>">
	</a>
	<?php
}



/**
 * Returns the rating score for the current post
 *
 * @param null $post_id
 * @param int $decimals
 *
 * @return bool
 */
function get_average_listing_rating( $post_id = null, $decimals = 2 ) {

	if ( empty( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}

	global $pixreviews_plugin;
	if ( method_exists( $pixreviews_plugin, 'get_average_rating' ) ) {
		return $pixreviews_plugin->get_average_rating( $post_id, $decimals );
	}

	return false;
}

if ( ! function_exists( 'shape_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Listable
	 */
	function shape_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' : ?>
				<li class="post pingback">
				<p><?php esc_html_e( 'Pingback:', 'listable' ); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'listable' ), ' ' ); ?></p>
				<?php
				break;
			default :
				if ( 'job_listing' == get_post_type() ) : ?>
					<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" itemprop="review" itemscope itemtype="http://schema.org/Review">
					<div class="comment-wrapper">
						<header class="comment-header">
							<div class="comment-author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">
								<?php
								echo get_avatar( $comment, 75 );
								echo sprintf( '<span class="fn">%s</span>', get_comment_author_link() ); ?>
							</div><!-- .comment-author .vcard -->
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'listable' ); ?></em>
								<br/>
							<?php endif; ?>
						</header>
						<div class="comment-content" itemprop="reviewBody">
							<?php comment_text(); ?>
						</div>
					
					</div>
				
				<?php endif;
				break;
		endswitch;
	}
endif; // ends check for shape_comment()




function listable_move_comment_date( $comment_content ) {
    
    if ( 'job_listing' == get_post_type() ) {
	global $comment;
    
	$commentDateTime = new DateTime( $comment->comment_date );
	$commentIsoDate = $commentDateTime->format(DateTime::ISO8601);

	ob_start(); ?>
	<div class="comment-meta commentmetadata" itemprop="datePublished" content = "<?php echo $commentIsoDate; ?>">
<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>"><?php
		/* translators: 1: date, 2: time */
		printf( esc_html__( 'on %1$s', 'listable' ), get_comment_date() ); ?></time>
	</a><?php edit_comment_link( esc_html__( '(Edit)', 'listable' ), ' ' ); ?></div><?php

	return ob_get_clean() . $comment_content; 
        
    }
    
    else 
        
    {
    	return $comment_content; 

    }
    
    
    
}

add_action( 'comment_text', 'listable_move_comment_date', 9 );



function listable_get_term_icon_id( $term_id = null, $taxonomy = null ) {

	if ( function_exists( 'get_term_meta' ) ) {

		if ( null === $term_id ) {
			global $wp_query;
			$term    = $wp_query->queried_object;
			$term_id = $term->term_id;

		}

		return get_term_meta( $term_id, 'pix_term_icon', true );
	}

	return false;
}

function listable_get_term_icon_url( $term_id = null, $size = 'thumbnail' ) {

	$attachment_id = listable_get_term_icon_id( $term_id );

	if ( ! empty( $attachment_id ) ) {
		$attach_args = wp_get_attachment_image_src( $attachment_id, $size );

		// $attach_args[0] should be the url
		if ( isset( $attach_args[0] ) ) {
			return $attach_args[0];
		}
	}

	return false;
}


/**
 * Display an image from the given url
 * We use this function when the url may contain a svg file
 *
 * @param $url
 * @param string $class A CSS class
 * @param bool|true $wrap_as_img If the function should wrap the url in an image tag or not
 */
function listable_display_image( $url, $class = '', $wrap_as_img = true, $attachment_id = null ) {
	if ( ! empty( $url ) && is_string( $url ) ) {

		//we try to inline svgs
		if ( substr( $url, - 4 ) === '.svg' ) {

			//first let's see if we have an attachment and inline it in the safest way - with readfile
			//include is a little dangerous because if one has short_open_tags active, the svg header that starts with <? will be seen as PHP code
			if ( ! empty( $attachment_id ) && false !== @readfile( get_attached_file( $attachment_id ) ) ) {
				//all good
			} elseif ( false !== ( $svg_code = get_transient( md5( $url ) ) ) ) {
				//now try to get the svg code from cache
				echo $svg_code;
			} else {

				//if not let's get the file contents using WP_Filesystem
				require_once(ABSPATH . 'wp-admin/includes/file.php');

				WP_Filesystem();

				global $wp_filesystem;

				$svg_code = $wp_filesystem->get_contents( $url );

				if ( ! empty( $svg_code ) ) {
					set_transient( md5( $url ), $svg_code, 12 * HOUR_IN_SECONDS );

					echo $svg_code;
				}
			}

		} elseif ( $wrap_as_img ) {

			if ( ! empty( $class ) ) {
				$class = ' class="' . $class . '"';
			}

			echo '<img src="' . $url . '"' . $class . '/>';

		} else {
			echo $url;
		}
	}
}


/**
 * Return the gallery of images attached to the listing
 *
 * @param null $listing_ID
 *
 * @return array|bool
 */
function listable_get_listing_gallery_ids( $listing_ID = null ) {

	if ( empty( $listing_ID ) ) {
		$listing_ID = get_the_ID();
	}

	//bail if we have no valid listing ID
	if ( empty( $listing_ID ) ) {
		return false;
	}

	$gallery_string = trim( get_post_meta( $listing_ID, 'main_image', true ) );
	//no spaces are allowed
	$gallery_string = str_replace( ' ', '', $gallery_string);
	//a little bit of sanity cleanup because sometimes (mainly during preview) an empty entry can be added at the end
	if ( ',' === substr( $gallery_string, -1, 1 ) ) {
		$gallery_string = substr( $gallery_string, 0, -1 );
	}

	if ( ! empty( $gallery_string ) ) {
		$gallery_ids = explode( ',', $gallery_string );

		//now ensure that each entry is a valid ID (positive int)
		$filter_options = array(
				'options' => array( 'min_range' => 1)
		);
		foreach ( $gallery_ids as $key => $value ) {
			if( false === filter_var( $value, FILTER_VALIDATE_INT, $filter_options ) ) {
				unset( $gallery_ids[ $key ] );
			}
		}

		//normalize the array, just in case we've deleted something
		$gallery_ids = array_values( $gallery_ids );
	}

	if ( ! empty( $gallery_ids ) ) {
		return $gallery_ids;
	}

	return false;
}


/**
 * ======  Wp Jobs Manager Filters START  ======
 */
function listable_change_job_into_listing( $args ) {

	$singular = esc_html__( 'Listing', 'listable' );
	$plural   = esc_html__( 'Listings', 'listable' );
    
 

	 $args['labels']      = array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'menu_name'          => $plural,
		'all_items'          => sprintf( esc_html__( 'All %s', 'afrigalore' ), $plural ),
		'add_new'            => esc_html__( 'Add New', 'afrigalore' ),
		'add_new_item'       => sprintf( esc_html__( 'Add %s', 'afrigalore' ), $singular ),
		'edit'               => esc_html__( 'Edit', 'afrigalore' ),
		'edit_item'          => sprintf( esc_html__( 'Edit %s', 'afrigalore' ), $singular ),
		'new_item'           => sprintf( esc_html__( 'New %s', 'afrigalore' ), $singular ),
		'view'               => sprintf( esc_html__( 'View %s', 'afrigalore' ), $singular ),
		'view_item'          => sprintf( esc_html__( 'View %s', 'afrigalore' ), $singular ),
		'search_items'       => sprintf( esc_html__( 'Search %s', 'afrigalore' ), $plural ),
		'not_found'          => sprintf( esc_html__( 'No %s found', 'afrigalore' ), $plural ),
		'not_found_in_trash' => sprintf( esc_html__( 'No %s found in trash', 'afrigalore' ), $plural ),
		'parent'             => sprintf( esc_html__( 'Parent %s', 'afrigalore' ), $singular ),
       'featured_image'        => _x( 'Main Picture', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'afrigalore' ),

	);
    
     
    
	$args['description'] = sprintf( esc_html__( 'This is where you can create and manage %s.', 'listable' ), $plural );
	$args['supports']    = array('title', 'editor', 'custom-fields', 'publicize', 'comments','thumbnail');
	$args['rewrite']     = array( 'slug' => 'listings' );
    
    
    
    

	return $args;
}

add_filter( 'register_post_type_job_listing', 'listable_change_job_into_listing' );



function listable_change_taxonomy_job_listing_type_args( $args ) {
	$singular = esc_html__( 'Listing Type', 'listable' );
	$plural   = esc_html__( 'Listings Types', 'listable' );

	$args['label']  = $plural;
	$args['labels'] = array(
		'name'              => $plural,
		'singular_name'     => $singular,
		'menu_name'         => esc_html__( 'Types', 'listable' ),
		'search_items'      => sprintf( esc_html__( 'Search %s', 'listable' ), $plural ),
		'all_items'         => sprintf( esc_html__( 'All %s', 'listable' ), $plural ),
		'parent_item'       => sprintf( esc_html__( 'Parent %s', 'listable' ), $singular ),
		'parent_item_colon' => sprintf( esc_html__( 'Parent %s:', 'listable' ), $singular ),
		'edit_item'         => sprintf( esc_html__( 'Edit %s', 'listable' ), $singular ),
		'update_item'       => sprintf( esc_html__( 'Update %s', 'listable' ), $singular ),
		'add_new_item'      => sprintf( esc_html__( 'Add New %s', 'listable' ), $singular ),
		'new_item_name'     => sprintf( esc_html__( 'New %s Name', 'listable' ), $singular )
	);

	if ( isset( $args['rewrite'] ) && is_array( $args['rewrite'] ) ) {
		$args['rewrite']['slug'] = _x( 'listing-type', 'Listing type slug - resave permalinks after changing this', 'listable' );
	}

	return $args;
}

add_filter( 'register_taxonomy_job_listing_type_args', 'listable_change_taxonomy_job_listing_type_args' );

function listable_change_taxonomy_job_listing_category_args( $args ) {
	$singular = esc_html__( 'Listing Category', 'listable' );
	$plural   = esc_html__( 'Listings Categories', 'listable' );

	$args['label'] = $plural;

	$args['labels'] = array(
		'name'              => $plural,
		'singular_name'     => $singular,
		'menu_name'         => esc_html__( 'Categories', 'listable' ),
		'search_items'      => sprintf( esc_html__( 'Search %s', 'listable' ), $plural ),
		'all_items'         => sprintf( esc_html__( 'All %s', 'listable' ), $plural ),
		'parent_item'       => sprintf( esc_html__( 'Parent %s', 'listable' ), $singular ),
		'parent_item_colon' => sprintf( esc_html__( 'Parent %s:', 'listable' ), $singular ),
		'edit_item'         => sprintf( esc_html__( 'Edit %s', 'listable' ), $singular ),
		'update_item'       => sprintf( esc_html__( 'Update %s', 'listable' ), $singular ),
		'add_new_item'      => sprintf( esc_html__( 'Add New %s', 'listable' ), $singular ),
		'new_item_name'     => sprintf( esc_html__( 'New %s Name', 'listable' ), $singular )
	);

	if ( isset( $args['rewrite'] ) && is_array( $args['rewrite'] ) ) {
		$args['rewrite']['slug'] = _x( 'listing-category', 'Listing category slug - resave permalinks after changing this', 'listable' );
	}

	return $args;
}

add_filter( 'register_taxonomy_job_listing_category_args', 'listable_change_taxonomy_job_listing_category_args' );

function listable_replace_listing_tags_object_label() {

	global $wp_taxonomies;

	if ( ! isset( $wp_taxonomies['job_listing_tag'] ) ) {
		return;
	}

	$labels = &$wp_taxonomies['job_listing_tag']->labels;

	$labels->name                       = esc_html__( 'Listing Tags', 'listable' );
	$labels->singular_name              = esc_html__( 'Listing Tag', 'listable' );
	$labels->search_items               = esc_html__( 'Search Listing Tags', 'listable' );
	$labels->popular_items              = esc_html__( 'Popular Tags', 'listable' );
	$labels->all_items                  = esc_html__( 'All Listing Tags', 'listable' );
	$labels->parent_item                = esc_html__( 'Parent Listing Tag', 'listable' );
	$labels->parent_item_colon          = esc_html__( 'Parent Listing Tag:', 'listable' );
	$labels->edit_item                  = esc_html__( 'Edit Listing Tag', 'listable' );
	$labels->view_item                  = esc_html__( 'View Tag', 'listable' );
	$labels->update_item                = esc_html__( 'Update Listing Tag', 'listable' );
	$labels->add_new_item               = esc_html__( 'Add New Listing Tag', 'listable' );
	$labels->new_item_name              = esc_html__( 'New Listing Tag Name', 'listable' );
	$labels->separate_items_with_commas = esc_html__( 'Separate tags with commas', 'listable' );
	$labels->add_or_remove_items        = esc_html__( 'Add or remove tags', 'listable' );
	$labels->choose_from_most_used      = esc_html__( 'Choose from the most used tags', 'listable' );
	$labels->not_found                  = esc_html__( 'No tags found.', 'listable' );
	$labels->no_terms                   = esc_html__( 'No tags', 'listable' );
	$labels->menu_name                  = esc_html__( 'Listing Tags', 'listable' );
	$labels->name_admin_bar             = esc_html__( 'Listing Tag', 'listable' );

	$wp_taxonomies['job_listing_tag']->rewrite = array(
		'slug'       => _x( 'listing-tag', 'permalink', 'listable' ),
		'with_front' => false,
		'ep_mask' => 0,
		'hierarchical' => false
	);


	// also unregister listing type since we wont use it
	// @todo try another way another time
	//	unset( $wp_taxonomies['job_listing_type'] );
}

add_action( 'init', 'listable_replace_listing_tags_object_label' );

/**
 * Change "Job" into "Listing" on the wp-job-manager setup pages.
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function theme_change_comment_field_names( $translated_text, $text, $domain ) {

	switch ( $translated_text ) {
		case 'Post a Job' :
			$translated_text = __( 'Post a Listing', 'listable' );
			break;

		case 'Job Dashboard' :
			$translated_text = __( 'Listing Dashboard', 'listable' );
			break;

		case 'Jobs':
			$translated_text = __( 'Listings', 'listable' );
			break;

		default:
			break;
	}

	return $translated_text;
}



/**
 * Change "Job" into "Listing" only on the wp-job-manager setup pages.
 */
function listable_admin_head_thing( $thing ) {
	if ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] === 'job-manager-setup' ) {
		add_filter( 'gettext_with_context', 'theme_change_comment_field_names', 999999, 3 );
	}
}

add_action( 'admin_init', 'listable_admin_head_thing' );

/**
 * Now we are gone replace in all settings descriptions the "Job" with "Listing"
 */
function listabe_filter_wp_jobs_manager_settings_descriptions( $args ) {
	array_walk_recursive( $args, 'listable_replace_jobs_with_listenings' );

	return $args;
}

add_filter( 'job_manager_settings', 'listabe_filter_wp_jobs_manager_settings_descriptions', 9999999 );

function listable_replace_jobs_with_listenings( &$item, $key ) {

	if ( $item === 'Job Listings' ) {
		$item = esc_html__( 'Listing', 'listable' );
	}

	if ( $item === 'Job Submission' ) {
		$item = esc_html__( 'Submission', 'listable' );
	}

	if ( $key === 'desc' || $key === 'any' || $key === 'all' || $key === 'label' ) {
		if ( is_numeric( strpos( $item, 'Job' ) ) ) {
			$item = str_replace( 'Job', esc_html__( 'Listing', 'listable' ), $item );
		}
	}

	return $item;
}


function listable_get_post_image_src( $post_id = null, $size = 'thumbnail' ) {

	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	$attach_id = listable_get_post_image_id( $post_id );

	if ( empty( $attach_id ) || is_wp_error( $attach_id ) ) {
		return false;
	}

	$data = wp_get_attachment_image_src( $attach_id, $size );
	// if this attachment has an url for this size, return it
	if ( isset( $data[0] ) && ! empty ( $data ) ) {
		return $data[0];
	}

	return false;
}





if ( ! function_exists( 'galore_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Twenty Fifteen 1.0
 */
function galore_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'twentyfifteen' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'twentyfifteen' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'twentyfifteen' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;


function strip_shortcode_gallery( $content ) {
    preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if( false !== $pos ) {
                    return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
                }
            }
        }
    }

    return $content;
}