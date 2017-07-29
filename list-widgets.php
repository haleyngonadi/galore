<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */
 
register_sidebar( array(
		'name'          => '&#x1F536; ' . esc_html__( 'Listing', 'listable') . ' &raquo; ' . esc_html__('Sidebar Top', 'listable' ),
		'description'   => esc_html__( 'Placed to the top of the right sidebar, this area put each widget in a visually different boxed container.', 'listable' ),
		'id'            => 'listing__sticky_sidebar',
		'before_widget' => '<div id="%1$s" class="widget  %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="listing_sidebar_sticky_title">',
		'after_title'   => '</h2>',
	) );


register_sidebar( array(
		'name'          => '&#x1F536; ' . esc_html__( 'Listing', 'listable') . ' &raquo; ' . esc_html__('Sidebar Bottom', 'listable' ),
		'description'   => esc_html__( 'Placed below the Sidebar Top, this area brings together all the widgets under the same container.', 'listable' ),
		'id'            => 'listing_sidebar',
		'before_widget' => '<div id="%1$s" class="widget  %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="listing_sidebar_title">',
		'after_title'   => '</h2>',
	) );

	register_widget( 'Listing_Sidebar_Map_Widget' );
	register_widget( 'Listing_Sidebar_Categories_Widget' );
    register_widget( 'Listing_Sidebar_Gallery_Widget' );
    register_widget( 'Listing_Sidebar_Contact_Widget' );



class Listing_Sidebar_Map_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_sidebar_map', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable') . '  &raquo; ' . esc_html__('Location Map', 'listable' ), // Name
			array( 'description' => esc_html__( 'A Map View of the listing location along with a Directions link to Google Map.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;

		$address = get_post_meta( get_the_ID(), 'geolocation_formatted_address' );
        

		if ( count( $address ) == 0 ) {
			return;
		}

		$address = $address[0];
        

		$geolocation_lat  = get_post_meta( get_the_ID(), 'geolocation_lat', true );
		$geolocation_long = get_post_meta( get_the_ID(), 'geolocation_long', true );
        

		$get_directions_link = '';
		if ( ! empty( $geolocation_lat ) && ! empty( $geolocation_long ) && is_numeric( $geolocation_lat ) && is_numeric( $geolocation_long ) ) {
			$get_directions_link = '//maps.google.com/maps?daddr=' . $geolocation_lat . ',' . $geolocation_long;
		}

		echo $args['before_widget']; ?>

		<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
			<div id="map" class="listing-map"></div>

			<?php if ( ! empty( $geolocation_lat ) && ! empty( $geolocation_long ) && is_numeric( $geolocation_lat ) && is_numeric( $geolocation_long ) ) : ?>

			<meta itemprop="latitude" content="<?php echo $geolocation_lat; ?>" />
			<meta itemprop="longitude" content="<?php echo $geolocation_long; ?>" />

			<?php endif; ?>

		</div>
		<div class="listing-map-content">
			<address class="listing-address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<?php echo $address; ?>
				<meta itemprop="streetAddress" content = "<?php echo trim( get_post_meta( $post->ID, 'geolocation_street_number', true ), '' ); ?> <?php echo trim( get_post_meta( $post->ID, 'geolocation_street', true ), '' ); ?>">
				<meta itemprop="addressLocality" content = "<?php echo trim( get_post_meta( $post->ID, 'geolocation_city', true ), '' ); ?>">
				<meta itemprop="postalCode" content = "<?php echo trim( get_post_meta( $post->ID, 'geolocation_postcode', true ), '' ); ?>">
				<meta itemprop="addressRegion" content = "<?php echo trim( get_post_meta( $post->ID, 'geolocation_state', true ), '' ); ?>">
				<meta itemprop="addressCountry" content = "<?php echo trim( get_post_meta( $post->ID, 'geolocation_country_short', true ), '' ); ?>">
			</address>
			<?php if ( ! empty( $get_directions_link ) ) { ?>
				<a href="<?php echo $get_directions_link; ?>" class="listing-address-directions" target="_blank"><span class="get">Get directions</span></a>
			<?php } ?>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Sidebar_Map_Widget



class Listing_Sidebar_Categories_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_sidebar_categories', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable') . ' &raquo; ' . esc_html__('Categories', 'listable' ), // Name
			array(
				'description' => esc_html__( 'The listing categories along with the related icon.', 'listable' ),
			) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];

		$term_list = wp_get_post_terms(
			$post->ID,
			'job_listing_category',
			array( 'fields' => 'all' )
		);

		if ( ! empty( $term_list ) && ! is_wp_error( $term_list ) ) { ?>
			<ul class="categories">
				<?php
				foreach ( $term_list as $key => $term ) { ?>
					<li>
						<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
							<?php
							$icon_url = listable_get_term_icon_url( $term->term_id );
							$attachment_id = listable_get_term_icon_id( $term->term_id );
							if ( ! empty( $icon_url ) ) { ?>
								<span class="category-icon">
									<?php listable_display_image( $icon_url, '', true, $attachment_id ); ?>
								</span>
							<?php } ?>
							<span class="category-text"><?php echo $term->name; ?></span>
						</a>
					</li>
				<?php } ?>
			</ul>
			<?php
		}

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Sidebar_Categories_Widget


class Listing_Sidebar_Gallery_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_sidebar_gallery', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable') . ' &raquo; ' . esc_html__('Gallery Images', 'listable' ), // Name
			array( 'description' => esc_html__( 'The attached images in a gallery grid format.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];
        
        $attachments = get_posts( array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_parent' => $post->ID ) );
        
        if ( ! empty( $attachments ) ) { ?>
        <header class="listing-gallery__header">
            <h2 class="widget-title"><span><?php esc_html_e( 'Photo gallery', 'listable' ); ?></span></h2>
			</header>
        <div class="listing-gallery__items  js-widget-gallery">
				<?php
				foreach ( $attachments as $attachment ) : ?>
					<a href="<?php echo wp_get_attachment_url($attachment->ID ); ?>" class="listing-gallery__item">
						<?php echo wp_get_attachment_image( $attachment->ID, 'thumbnail', false, array( 'itemprop' => 'image') ); ?>
					</a>
				<?php endforeach; ?>
			</div>

        <?php }

		
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Sidebar_Hours_Widget




class Listing_Sidebar_Contact_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'listing_sidebar_contact', // Base ID
			'&#x1F536; ' . esc_html__( 'Listing', 'listable') . ' &raquo; ' . esc_html__('Contact', 'listable' ), // Name
			array( 'description' => esc_html__( 'Contact the poster of this listing.', 'listable' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];
        
        $contactme = get_post_meta( get_the_ID(), '_contact_poster', true );
        
       if ($contactme=="1") { ?>
        <header class="listing-contact__header">
            <h2 class="widget-title"><span><?php esc_html_e( 'Get In Touch', 'listable' ); ?></span></h2>
			</header>
      
        <?php echo do_shortcode( '[contact-form-7 id="134" title="Contact form 1"]' ); ?>

        <?php }

		
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} // class Listing_Sidebar_Hours_Widget



