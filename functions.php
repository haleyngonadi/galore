<?php

 include_once( 'term-metadata.php' );
 require_once('list-functions.php');
require_once('wp_bootstrap_navwalker.php');
 require_once('list-widgets.php');

/**
 * Theme Functions
 *
 * @since Galore 1.0
 */

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}



function galore_setup() {

	
	load_theme_textdomain( 'afrigalore' );
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
        'video','gallery','audio'
	) );

	/*
	 * Enable support for custom logo.
	 *
	 * @since Twenty Fifteen 1.5
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );


}
add_action( 'after_setup_theme', 'galore_setup' );



function my_enqueue( $hook ) {
    if ('edit-tags.php' != $hook) {
        return;
    }
    wp_enqueue_script( 'my_custom_script', 'https://use.fontawesome.com/7b9bd272e9.js' );
}

add_action('admin_enqueue_scripts', 'my_enqueue');

function fontenqueue( $hook ) {
    	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' )  {
        return;
    }

    
    global $post_type;
    if( 'artists' == $post_type || ! is_admin() ) {
    wp_enqueue_script( 'font_script', 'https://use.fontawesome.com/7b9bd272e9.js' );
    wp_enqueue_style( 'slider', get_template_directory_uri() . '/css/artist.css',false,'1.1','all');}
    
    else if( 'lyrics' == $post_type || ! is_admin()) {
        wp_enqueue_script( 'lyric_font', 'https://use.fontawesome.com/7b9bd272e9.js' );
        wp_enqueue_style( 'lyric-style', get_template_directory_uri() . '/css/lyric.css',false,'1.1','all');}


    


}

add_action('admin_enqueue_scripts', 'fontenqueue');


/**
 * Enqueue scripts and styles.
 *
 * @since Galore 1.0
 */
function galore_scripts() {

	// Load our main stylesheet.
	wp_enqueue_style( 'afrigalore-style', get_stylesheet_uri() );
    
    if ( !is_admin()  ) {
  /*  wp_deregister_script('jquery');
    wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', true, '2.1.1', false);
   wp_enqueue_script('jquery'); */
    
    
    wp_deregister_script('leaflet-script');
   wp_register_script('leaflet-script', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://npmcdn.com/leaflet@0.7.7/dist/leaflet.js", false, null);
   wp_enqueue_script('leaflet-script');
    
     global $post_type;
    if( 'artists' == $post_type ) {
            wp_enqueue_script( 'main-script', get_template_directory_uri() . '/js/artists.js', array(), '20160808', true );
        wp_enqueue_script( 'google-script', 'https://apis.google.com/js/client.js?onload=onGoogleLoad', array(), '20160808', true );
        wp_enqueue_script( 'moemnt', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js', array(), '20160903', true );
        wp_enqueue_script( 'litebox', get_template_directory_uri() . '/assets/js/litebox.js', array(), '20160903', true );
        wp_enqueue_script( 'images-loaded', get_template_directory_uri() . '/assets/js/images-loaded.min.js', array(), '20160903', true );

    }
    
        if( !'lyrics' == $post_type  ) {

        wp_enqueue_script( 'main-script', get_template_directory_uri() . '/js/sticky.js', array(), '20160808', true );   
            wp_enqueue_script( 'prettySocial', get_template_directory_uri() . '/js/jquery.prettySocial.min.js', array(), '20160808', true );
            wp_enqueue_script( 'plyr-script', get_template_directory_uri() . '/js/plyr.js', array(), '20160808', true );
            wp_enqueue_script( 'tabslet-script', get_template_directory_uri() . '/js/jquery.tabslet.min.js', array(), '20160808', true );
            wp_enqueue_script( 'owl-caraosuel', get_template_directory_uri() . '/owl-carousel/owl.carousel.min.js', array(), '20160808', true );
            wp_enqueue_script( 'lazy-load', get_template_directory_uri() . '/js/jquery.lazyloadxt.extra.js', array(), '20160808', true ); 
    }
    
    
      wp_enqueue_style( 'hover-css', get_template_directory_uri() . '/css/hover-min.css',false,'1.1','all');


}

	
}
 add_action( 'wp_enqueue_scripts', 'galore_scripts' );





/**
 * Register menu.
 *
 * @since Galore 1.0
 */


register_nav_menus( array(
	'main_menu' => 'Galore Main Menu',
	'social_menu' => 'Social Menu',
) );


/**
 * Register widgets area.
 *
 * @since Galore 1.0
 */

function afrigalore_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'afrigalore' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'afrigalore' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="sidetitle widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
    
    register_sidebar( array(
		'name'          => '👩‍👩‍👧‍👦 ' . esc_html__( 'Artist Widget', 'afrigalore'),
		'id'            => 'artist-sidebar',
		'description'   => __( 'Add artists widgets in your sidebar.', 'afrigalore' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="sidetitle widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
    
    register_sidebar( array(
        'name'          => '📝 ' . esc_html__( 'Lyric Widget', 'afrigalore'),
        'id'            => 'lyric-sidebar',
        'description'   => __( 'Add lyrics widgets in your sidebar.', 'afrigalore' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="sidetitle widget-title"><span>',
        'after_title'   => '</span></h2>',
    ) );
    
}
add_action( 'widgets_init', 'afrigalore_widgets_init' );


/*** Register specific widgets ***/


register_widget( 'Artist_Facebook_Widget' );
register_widget( 'Artist_Instagram_Widget' );
register_widget( 'Artist_Twitter_Widget' );
register_widget( 'Lyrics_Listen_Widget' );
register_widget( 'Lyrics_Video_Widget' );


class Lyrics_Listen_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'lyric-listen', // Base ID
            '🌥 ' . esc_html__( 'Listen', 'afrigalore') . ' &raquo; ' . esc_html__('Listen Widget', 'afrigalore' ), // Name
            array( 'description' => esc_html__( 'Way to listen to this song.', 'afrigalore' ), ) // Args
        );
    }

    public function widget( $args, $instance ) {
        global $post;
        echo $args['before_widget'];

        $spotify = get_post_meta( get_the_ID(), 'lyric_spotify', true );
        $soundcloud = get_post_meta( get_the_ID(), 'lyric_soundcloud', true );
        $tidal = get_post_meta( get_the_ID(), 'lyric_tidal', true );



         { ?>


    <div class='multitab-section'>
       
        <ul class='multitab-widget multitab-widget-content-tabs-id'>
            
            <?php if ( ! empty( $spotify ) ) : ?>
            <li class='multitab-tab'><a href='#multicolumn-widget-id1'><i class="fa fa-spotify" aria-hidden="true"></i></a></li>

                    <?php endif; ?>
                    
    
            <?php if ( ! empty( $soundcloud ) ) : ?>
            <li class='multitab-tab'><a href='#multicolumn-widget-id2'><i class="fa fa-soundcloud" aria-hidden="true"></i></a></li>
            <?php endif; ?>
            
            <?php if ( ! empty( $tidal ) ) : ?>

            <li class='multitab-tab'><a href='#multicolumn-widget-id3'>
                
                <?php endif; ?>
                
               <center> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="1453px" height="707px" viewBox="0 0 1453 707" enable-background="new 0 0 1453 707" xml:space="preserve">
                    <path stroke="#000000" stroke-width="0.0938" d="M596.8,0h0.8c6.102,7,13,13.2,19.5,19.9c14.7,14.7,29.5,29.5,44.2,44.2v0.8	c-21.398,21.3-42.7,42.8-64.1,64.1c-21.5-21.4-42.9-42.9-64.4-64.3c1.102-2.1,3.2-3.5,4.8-5.2C557.3,39.6,577.3,20,596.8,0z"/>
                    <path stroke="#000000" stroke-width="0.0938" d="M725.8,0h0.8c0.602,0.9,1.2,1.7,2,2.5c20.7,20.5,41.102,41.3,62,61.7	c-0.5,1.2-1.6,2-2.5,2.9c-20.698,20.6-41.3,41.3-62,61.9c-21.6-21.3-42.8-43-64.5-64.2C682.6,42.9,704.7,21.8,725.8,0z"/>
                    <path stroke="#000000" stroke-width="0.0938" d="M854.8,0h0.8c4,4.8,8.7,8.9,13,13.4c16.2,16.2,32.302,32.3,48.5,48.5	c0.802,0.9,2.102,1.7,2.4,3c-21.7,21.1-42.7,43-64.5,64.1c-20.5-20.5-41-41-61.5-61.5c-1-1.1-2.3-1.9-2.8-3.3	C801.6,53.6,812.2,42.7,823,32C833.6,21.3,844.4,10.9,854.8,0z"/>
                   <path stroke="#000000" stroke-width="0.0938" d="M662.5,192.5c21.1-21.1,42.3-42.2,63.4-63.4l0.898,0.4	c21.2,21.3,42.4,42.6,63.8,63.7c-0.698,1.6-2.198,2.5-3.3,3.8c-15.398,15.3-30.8,30.8-46.2,46.1c-5,4.8-9.8,10.2-14.898,14.7	c-7.3-6.6-14-14-21.102-20.8C690.7,222.6,676.4,208.2,661.9,193.9C662.1,193.5,662.3,192.9,662.5,192.5z"/></svg></center>
                
                </a></li>

        </ul>
        
        
        <div class='multitab-widget-content multitab-widget-content-widget-id' id='multicolumn-widget-id1'>
            <!--iframe src="https://embed.spotify.com/track/<?php echo get_post_meta( get_the_ID(), 'lyric_spotify', true );?>" width="100%" height="80" frameborder="0" allowtransparency="true"></iframe-->
        </div>
        
<div class='multitab-widget-content multitab-widget-content-widget-id' id='multicolumn-widget-id2'>
    
    <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/284222039&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
    
 
</div>
<div class='-content multitab-widget-content-widget-id' id='multicolumn-widget-id3'>
    <div class="tidal-embed" data-type="t" data-id="<?php echo get_post_meta( get_the_ID(), 'lyric_tidal', true );?>"></div>
    <script src="https://embed.tidal.com/tidal-embed.js"></script>
</div>
</div>


<?php }


        echo $args['after_widget'];
    }

    public function form( $instance ) {
        echo '<p>' . $this->widget_options['description'] . '</p>';
    }
} 



class Lyrics_Video_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'lyric-video', // Base ID
            '🌥 ' . esc_html__( 'Lyric Video', 'afrigalore') . ' &raquo; ' . esc_html__('Lyrics Widget', 'afrigalore' ), // Name
            array( 'description' => esc_html__( 'Music video.', 'afrigalore' ), ) // Args
        );
    }

    public function widget( $args, $instance ) {
        global $post;
        echo $args['before_widget'];

        $video = get_post_meta( get_the_ID(), 'lyric_video', true );


        if ( ! empty( $video ) ) { ?>

<header class="artist__header">
    <h2 class="widget-title"><span><?php esc_html_e( 'Video', 'afrigalore' ); ?></span></h2>
</header>

<div class="youtube" id="<?php echo $video;?>">

    <div class="loader loader--style1" title="0">
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
            <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                                               s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                                               c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
            <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                                 C22.32,8.481,24.301,9.057,26.013,10.047z">
                <animateTransform attributeType="xml"
                                  attributeName="transform"
                                  type="rotate"
                                  from="0 20 20"
                                  to="360 20 20"
                                  dur="0.5s"
                                  repeatCount="indefinite"/>
            </path>
        </svg>
    </div>

</div>


<?php }


        echo $args['after_widget'];
    }

    public function form( $instance ) {
        echo '<p>' . $this->widget_options['description'] . '</p>';
    }
} 




class Artist_Facebook_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'artist_facebook', // Base ID
			'🌥 ' . esc_html__( 'Artist Facebook', 'afrigalore') . ' &raquo; ' . esc_html__('Artist Widget', 'afrigalore' ), // Name
			array( 'description' => esc_html__( 'An artist\'s facebook feed.', 'afrigalore' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];
        
        $facebook = get_post_meta( get_the_ID(), 'artist_fb', true );

        
        if ( ! empty( $facebook ) ) { ?>

        <header class="artist__header">
            <h2 class="widget-title"><span><?php esc_html_e( 'Facebook', 'afrigalore' ); ?></span></h2>
			</header>

<center><iframe data-src="https://www.facebook.com/plugins/page.php?href=<?php echo get_post_meta( get_the_ID(), 'artist_fb', true );?>%2F&tabs=timeline&width=321&height=375&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1736927226556911" width="321" height="375" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></center>


<?php }

		
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} 



class Artist_Instagram_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'artist_instagram', // Base ID
			'🌥 ' . esc_html__( 'Artist Instagram', 'afrigalore') . ' &raquo; ' . esc_html__('Artist Widget', 'afrigalore' ), // Name
			array( 'description' => esc_html__( 'An artist\'s instagram feed.', 'afrigalore' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];
        
        $instagram = get_post_meta( get_the_ID(), 'artist_ig', true );

        
        if ( ! empty( $instagram ) ) { ?>

        <header class="artist__header">
            <h2 class="widget-title"><span><?php esc_html_e( 'Instagram', 'afrigalore' ); ?></span></h2>
			</header>

<div id="instagram-feed"></div>


        <?php }

		
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} 


class Artist_Twitter_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'artist_twitter', // Base ID
			'🌥 ' . esc_html__( 'Artist Twitter', 'afrigalore') . ' &raquo; ' . esc_html__('Artist Widget', 'afrigalore' ), // Name
			array( 'description' => esc_html__( 'An artist\'s twitter feed.', 'afrigalore' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		echo $args['before_widget'];
        
        $tweets = get_post_meta( get_the_ID(), 'artist_twitter', true );

        
        if ( ! empty( $tweets ) ) { ?>

        <header class="artist__header">
            <h2 class="widget-title"><span><?php esc_html_e( 'Tweets', 'afrigalore' ); ?></span></h2>
			</header>

            <?php echo do_shortcode( '[AIGetTwitterFeeds ai_username="' . $tweets . '"]');?>


        <?php }

		
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		echo '<p>' . $this->widget_options['description'] . '</p>';
	}
} 




/**** Track Post Views ****/

function getCrunchifyPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 ";
    }
    return $count.' ';
}
 
function setCrunchifyPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
 
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


function modify_read_more_link() {
    return '<div class="readmore"><a href="' . get_permalink() . '">Continue Reading</a></div>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

/**** Image Sizes  ****/


add_image_size( 'carousel-image', 9999, 800, false );
add_image_size( 'slider-image', 9999, 510, false );
add_image_size( 'artist-image', 300, 300, array( 'center', 'top' ) );
add_image_size( 'latest-image', 101, 71, false );


/**** Register Artists Post Type  ****/



// Our custom post type function
function create_posttype() {

	register_post_type( 'artists',
	// CPT Options
		array(
			'labels' => array(
        'name' => __( 'Artists' ),
        'singular_name' => __( 'Artist' ),
        'menu_name'          => _x( 'Artists', 'admin menu', 'afrigalore' ),
		'name_admin_bar'     => _x( 'Artist', 'add new on admin bar', 'afrigalore' ),
		'add_new'            => _x( 'Add New', 'artist', 'afrigalore' ),
		'add_new_item'       => __( 'Add New Artist', 'afrigalore' ),
		'new_item'           => __( 'New Artist', 'afrigalore' ),
		'edit_item'          => __( 'Edit Artist', 'afrigalore' ),
		'view_item'          => __( 'View Artist', 'afrigalore' ),
		'all_items'          => __( 'All Artists', 'afrigalore' ),
		'search_items'       => __( 'Search Artists', 'afrigalore' ),
		'parent_item_colon'  => __( 'Parent Artists:', 'afrigalore' ),
		'not_found'          => __( 'No artists found.', 'afrigalore' ),
		'not_found_in_trash' => __( 'No artists found in Trash.', 'afrigalore' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'artist'),
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
           // 'taxonomies' => array('artist_category') // this is IMPORTANT


		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );




// Artist Categories


function my_taxonomies_product() {
    
 	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name', 'afrigalore' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'afrigalore' ),
		'search_items'      => __( 'Search Genres', 'textdomain' ),
		'all_items'         => __( 'All Genres', 'afrigalore' ),
		'parent_item'       => __( 'Parent Genre', 'afrigalore' ),
		'parent_item_colon' => __( 'Parent Genre:', 'afrigalore' ),
		'edit_item'         => __( 'Edit Genre', 'afrigalore' ),
		'update_item'       => __( 'Update Genre', 'afrigalore' ),
		'add_new_item'      => __( 'Add New Genre', 'afrigalore' ),
		'new_item_name'     => __( 'New Genre Name', 'afrigalore' ),
		'menu_name'         => __( 'Genre', 'afrigalore' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	register_taxonomy( 'genre', array( 'artists' ), $args );
}

add_action( 'init', 'my_taxonomies_product', 0 );





function wpdocs_register_meta_boxes() {
    add_meta_box( 'basic-info', __( 'Basic Information', 'afrigalore' ), 'wpdocs_information', 'artists' );
    add_meta_box( 'artist-socials', __( 'Socials', 'afrigalore' ), 'wpdocs_my_display_callback', 'artists' );
    add_meta_box( 'album-info', __( 'Information', 'afrigalore' ), 'lyric_information', 'lyrics' );

}
add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );


function wpdocs_information( $post  ) {

        $artist_tag = get_post_meta($post->ID, 'artist_tag', true);

 ?>

<div class="grid">
   <div class="col-1-2">
     <div class="module">
       <i class="fa fa-tag" aria-hidden="true"></i> 
           <?php wp_nonce_field('set_artist_tag', 'artist_tag_nonce'); ?>
         <input type="text" id="artist_input" name="artist_tag" placeholder="Enter artist's slug" value="<?= $artist_tag; ?>">

     </div></div></div>

<?php


}

function wpdocs_my_display_callback( $post  ) {
    
        $artist_twitter = get_post_meta($post->ID, 'artist_twitter', true);
        $artist_fb = get_post_meta($post->ID, 'artist_fb', true);
        $artist_ig = get_post_meta($post->ID, 'artist_ig', true);
        $artist_youtube = get_post_meta($post->ID, 'artist_youtube', true);
        $tube_type = get_post_meta($post->ID, 'tube_type', true);
    $prfx_stored_meta = get_post_meta($post->ID);





 ?>


<div class="grid">
   <div class="col-1-2">
     <div class="module">
       <i class="fa fa-twitter" aria-hidden="true"></i> 
           <?php wp_nonce_field('set_artist_twitter', 'artist_twitter_nonce'); ?>
         <input type="text" id="artist_input" name="artist_twitter" placeholder="@Username" value="<?= $artist_twitter; ?>">

     </div>
       
        <div class="module">
       <i class="fa fa-instagram" aria-hidden="true"></i> 
           <?php wp_nonce_field('set_artist_ig', 'artist_ig_nonce'); ?>
         <input type="text" id="artist_input" name="artist_ig" placeholder="@Username" value="<?= $artist_ig; ?>">

     </div>
       
   </div>
   <div class="col-1-2">
     <div class="module">
       <i class="fa fa-facebook" aria-hidden="true"></i> 
           <?php wp_nonce_field('set_artist_fb', 'artist_fb_nonce'); ?>
         <input type="text" id="artist_input" name="artist_fb" placeholder="Facebook URL" value="<?= $artist_fb; ?>">

     </div>
       
          <div class="module">
       <i class="fa tube" aria-hidden="true">
                      <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $prfx_stored_meta['meta-checkbox'] ) ) checked( $prfx_stored_meta['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( '', 'afrigalore' )?>
        </label>

              </i> 
           <?php wp_nonce_field('set_artist_youtube', 'artist_youtube_nonce'); ?>
         <input type="text" id="artist_input" name="artist_youtube" placeholder="Playlist or Channel ID" value="<?= $artist_youtube; ?>">

     </div>
       
   </div>
</div>



 <?php

}


function wpdocs_save_meta_box($post_id) {
    
if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
} else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
}
 
    
    if (!empty( $_POST['artist_twitter']) && check_admin_referer('set_artist_twitter', 'artist_twitter_nonce')  ) {
        update_post_meta($post_id, 'artist_twitter', $_POST['artist_twitter']);
    }
    
    if (!empty( $_POST['artist_fb']) && check_admin_referer('set_artist_fb', 'artist_fb_nonce')  ) {
        update_post_meta($post_id, 'artist_fb', $_POST['artist_fb']);
    }
    
    if (!empty( $_POST['artist_ig']) && check_admin_referer('set_artist_ig', 'artist_ig_nonce')  ) {
        update_post_meta($post_id, 'artist_ig', $_POST['artist_ig']);
    }
    
    if (!empty( $_POST['artist_youtube']) && check_admin_referer('set_artist_youtube', 'artist_youtube_nonce')  ) {
        update_post_meta($post_id, 'artist_youtube', $_POST['artist_youtube']);
    }
    
    if (!empty( $_POST['artist_tag']) && check_admin_referer('set_artist_tag', 'artist_tag_nonce')  ) {
        update_post_meta($post_id, 'artist_tag', $_POST['artist_tag']);
    }
    
}
add_action( 'save_post', 'wpdocs_save_meta_box'  );







function better_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' : ?>
				<li class="post pingback row">
				<p><?php esc_html_e( 'Pingback:', 'listable' ); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'listable' ), ' ' ); ?></p>
				<?php
				break;
			default :
				if ( 'post' == get_post_type() ) : ?>
					<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" itemprop="review" itemscope itemtype="http://schema.org/Review">
					<div class="comment-wrapper">
						<header class="comment-header col-md-2">
							<div class="comment-author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">
								<?php
								echo get_avatar( $comment, 75 );
								 ?>
                                
							</div><!-- .comment-author .vcard -->
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'listable' ); ?></em>
								<br/>
							<?php endif; ?>
						</header>
					
 
            <footer class="comment-footer col-md-10">
                            <h2 class="comment-author"><?php comment_author(); ?></h2>
            <time <?php comment_time( 'c' ); ?> class="comment-meta-item">
            <span class="date">
            <?php comment_date(); ?>
            </span>
            <span class="time">
            <?php comment_time(); ?>
            </span>
            </time>
            <div class="comment-body">
            <?php comment_text(); ?>
            </div>
                
                 <div class="reply"><?php 
            comment_reply_link( array_merge( $args, array( 
            'reply_text' => 'Reply',
            'depth' => $depth,
            'max_depth' => $args['max_depth'] 
            ) ) ); ?>
            </div><!-- .reply -->
            </footer><!-- .comment-footer -->
					</div>
				
				<?php endif;
				break;
		endswitch;
	}




//**** Register Lyrics Post Type ***//

// Our custom post type function
function create_lyrics() {

    register_post_type( 'lyrics',
                       // CPT Options
                       array(
                           'labels' => array(
                               'name' => __( 'Lyrics' ),
                               'singular_name' => __( 'Lyric' ),
                               'menu_name'          => _x( 'Lyrics', 'admin menu', 'afrigalore' ),
                               'name_admin_bar'     => _x( 'Lyric', 'add new on admin bar', 'afrigalore' ),
                               'add_new'            => _x( 'Add New', 'lyrics', 'afrigalore' ),
                               'add_new_item'       => __( 'Add New Lyrics', 'afrigalore' ),
                               'new_item'           => __( 'New Lyrics', 'afrigalore' ),
                               'edit_item'          => __( 'Edit Lyrics', 'afrigalore' ),
                               'view_item'          => __( 'View Lyrics', 'afrigalore' ),
                               'all_items'          => __( 'All Lyrics', 'afrigalore' ),
                               'search_items'       => __( 'Search Lyrics', 'afrigalore' ),
                               'parent_item_colon'  => __( 'Parent Lyrics:', 'afrigalore' ),
                               'not_found'          => __( 'No lyrics found.', 'afrigalore' ),
                               'not_found_in_trash' => __( 'No lyrics found in Trash.', 'afrigalore' )
                           ),
                           'public' => true,
                           'has_archive' => true,
                           'rewrite' => array('slug' => 'lyrics'),
                           'supports'           => array( 'title', 'editor', 'thumbnail', 'comments' ),
                           // 'taxonomies' => array('artist_category') // this is IMPORTANT


                       )
                      );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_lyrics' );


function lyric_information( $post  ) {

    $lyric_artist = get_post_meta($post->ID, 'lyric_artist', true);
    $lyric_date = get_post_meta($post->ID, 'lyric_date', true);
    $lyric_album = get_post_meta($post->ID, 'lyric_album', true);
    $lyric_producers = get_post_meta($post->ID, 'lyric_producers', true);
    $lyric_spotify = get_post_meta($post->ID, 'lyric_spotify', true);
    $lyric_soundcloud = get_post_meta($post->ID, 'lyric_soundcloud', true);
    $lyric_video = get_post_meta($post->ID, 'lyric_video', true);
    $lyric_tidal = get_post_meta($post->ID, 'lyric_tidal', true);



    $prfx_stored_meta = get_post_meta($post->ID);


                        
?>
         
                        

                        
    <div class="grid">
        
        <div class="col-1-8"><i class="fa tube" aria-hidden="true">
            <label for="very-checkbox">
                <input type="checkbox" name="very-checkbox" id="very-checkbox" value="yes" <?php if ( isset ( $prfx_stored_meta['very-checkbox'] ) ) checked( $prfx_stored_meta['very-checkbox'][0], 'yes' ); ?> />
                <?php _e( '', 'afrigalore' )?>
            </label>

            </i> <span class="very">Artist Verified?</span> </div>
        
   
        <div class="col-1-2">
            <div class="module">
                <i class="fa fa-user" aria-hidden="true"></i>
                <?php wp_nonce_field('set_lyric_artist', 'lyric_artist_nonce'); ?>
                <input type="text" id="artist_input" name="lyric_artist" placeholder="ex. John Doe" value="<?= $lyric_artist; ?>">

            </div>
            
            
            <div class="module">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <?php wp_nonce_field('set_lyric_date', 'lyric_date_nonce'); ?>
                <input type="date" id="artist_input" name="lyric_date" placeholder="ex. Augus 23, 2016" value="<?= $lyric_date; ?>">

            </div>

           

        </div> 
        
        <div class="col-1-2">
            <div class="module">
                <i class="fa fa-users" aria-hidden="true"></i>
                <?php wp_nonce_field('set_lyric_producers', 'lyric_producers_nonce'); ?>
                <input type="text" id="artist_input" name="lyric_producers" placeholder="Producers" value="<?= $lyric_producers; ?>">

            </div>
        
            
            <div class="module">
                <i class="fa fa-folder" aria-hidden="true"></i>
                <?php wp_nonce_field('set_lyric_album', 'lyric_album_nonce'); ?>
                <input type="text" id="artist_input" name="lyric_album" placeholder="Album" value="<?= $lyric_album; ?>">

            </div>
            
        
        </div>
                                
                        
                        </div>
                        
                        <h2 class="heading">Listen</h2>
                        
                        <div class="grid">

                            <div class="col-1-2">
                                <div class="module">
                                    <i class="fa fa-soundcloud" aria-hidden="true"></i>
                                    <?php wp_nonce_field('set_lyric_soundcloud', 'lyric_soundcloud_nonce'); ?>
                                    <input type="text" id="artist_input" name="lyric_soundcloud" placeholder="Soundcloud URL" value="<?= $lyric_soundcloud; ?>">

                                </div>
                                
                                <div class="module">
                                    <i class="fa fa-bolt" aria-hidden="true"></i>
                                    <?php wp_nonce_field('set_lyric_tidal', 'lyric_tidal_nonce'); ?>
                                    <input type="text" id="artist_input" name="lyric_tidal" placeholder="Tidal ID" value="<?= $lyric_tidal; ?>">

                                </div>
                            
                            </div>
                            
                            
                            <div class="col-1-2">
                                <div class="module">
                                    <i class="fa fa-spotify" aria-hidden="true"></i>
                                    <?php wp_nonce_field('set_lyric_spotify', 'lyric_spotify_nonce'); ?>
                                    <input type="text" id="artist_input" name="lyric_spotify" placeholder="Spotify URL" value="<?= $lyric_spotify; ?>">

                                </div>
                                
                                <div class="module">
                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                    <?php wp_nonce_field('set_lyric_video', 'lyric_video_nonce'); ?>
                                    <input type="text" id="artist_input" name="lyric_video" placeholder="Video ID" value="<?= $lyric_video; ?>">

                                </div>

                            </div>
                        </div>


                        

<?php

}




function lyrics_meta_box($post_id) {

    if( isset( $_POST[ 'very-checkbox' ] ) ) {
        update_post_meta( $post_id, 'very-checkbox', 'yes' );
    } else {
        update_post_meta( $post_id, 'very-checkbox', '' );
    }


    if (!empty( $_POST['lyric_video']) && check_admin_referer('set_lyric_video', 'lyric_video_nonce')  ) {
        update_post_meta($post_id, 'lyric_video', $_POST['lyric_video']);
    }

    if (!empty( $_POST['lyric_spotify']) && check_admin_referer('set_lyric_spotify', 'lyric_spotify_nonce')  ) {
        update_post_meta($post_id, 'lyric_spotify', $_POST['lyric_spotify']);
    }

    if (!empty( $_POST['lyric_tidal']) && check_admin_referer('set_lyric_tidal', 'lyric_tidal_nonce')  ) {
        update_post_meta($post_id, 'lyric_tidal', $_POST['lyric_tidal']);
    }

    if (!empty( $_POST['lyric_soundcloud']) && check_admin_referer('set_lyric_soundcloud', 'lyric_soundcloud_nonce')  ) {
        update_post_meta($post_id, 'lyric_soundcloud', $_POST['lyric_soundcloud']);
    }

    if (!empty( $_POST['lyric_album']) && check_admin_referer('set_lyric_album', 'lyric_album_nonce')  ) {
        update_post_meta($post_id, 'lyric_album', $_POST['lyric_album']);
    }
    
    
    if (!empty( $_POST['lyric_producers']) && check_admin_referer('set_lyric_producers', 'lyric_producers_nonce')  ) {
        update_post_meta($post_id, 'lyric_producers', $_POST['lyric_producers']);
    }
    
    if (!empty( $_POST['lyric_artist']) && check_admin_referer('set_lyric_artist', 'lyric_artist_nonce')  ) {
        update_post_meta($post_id, 'lyric_artist', $_POST['lyric_artist']);
    }
    if (!empty( $_POST['lyric_date']) && check_admin_referer('set_lyric_date', 'lyric_date_nonce')  ) {
        update_post_meta($post_id, 'lyric_date', $_POST['lyric_date']);
    }

}
add_action( 'save_post', 'lyrics_meta_box'  );




/*** Post Views Lyrics ***/


// function to display number of posts.
function getPostViews($postID){
    $count_key = 'lyrics_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 views";
    }
    
   else if($count==1){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
        return "1 view";
    }
    
    return $count.' views';
}

// function to count views.
function setPostViews($postID) {
    $count_key = 'lyrics_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('views');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
    if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}


/*** Category for Lyrics ***/


function tier_product() {

    $labels = array(
        'name'              => _x( 'Tiers', 'taxonomy general name', 'afrigalore' ),
        'singular_name'     => _x( 'Tier', 'taxonomy singular name', 'afrigalore' ),
        'search_items'      => __( 'Search Tiers', 'afrigalore' ),
        'all_items'         => __( 'All Tiers', 'afrigalore' ),
        'parent_item'       => __( 'Parent Tier', 'afrigalore' ),
        'parent_item_colon' => __( 'Parent Tier:', 'afrigalore' ),
        'edit_item'         => __( 'Edit Tier', 'afrigalore' ),
        'update_item'       => __( 'Update Tier', 'afrigalore' ),
        'add_new_item'      => __( 'Add New Tier', 'afrigalore' ),
        'new_item_name'     => __( 'New Tier Name', 'afrigalore' ),
        'menu_name'         => __( 'Tiers', 'afrigalore' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite' =>  array('slug' => 'blog/category'), // rewriteを指定
    );

    register_taxonomy( 'tier', array( 'lyrics' ), $args );
    
    
    $artists = array(
        'name'                       => _x( 'Artists', 'Tags for Lyrics', 'afrigalore' ),
        'singular_name'              => _x( 'Artist', 'taxonomy singular name', 'afrigalore' ),
        'search_items'               => __( 'Search Artists', 'afrigalore' ),
        'popular_items'              => __( 'Popular Artists', 'afrigalore' ),
        'all_items'                  => __( 'All Artists', 'afrigalore' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Artist', 'afrigalore' ),
        'update_item'                => __( 'Update Artist', 'afrigalore' ),
        'add_new_item'               => __( 'Add New Artist', 'afrigalore' ),
        'new_item_name'              => __( 'New Artist Name', 'afrigalore' ),
        'separate_items_with_commas' => __( 'Separate artists with commas', 'afrigalore' ),
        'add_or_remove_items'        => __( 'Add or remove artists', 'afrigalore' ),
        'choose_from_most_used'      => __( 'Choose from the most used artists', 'afrigalore' ),
        'not_found'                  => __( 'No artists found.', 'afrigalore' ),
        'menu_name'                  => __( 'Artists', 'afrigalore' ),
    );

    $argue = array(
        'hierarchical'          => false,
        'labels'                => $artists,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'lyrics/artist' ),
    );

    register_taxonomy( 'artist', 'lyrics', $argue );
    
    
}

add_action( 'init', 'tier_product', 0 );




/*** Trying this inline-comments shizz **/


function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}



add_action( 'wp_enqueue_scripts', 'inline_comments_head' );



function inline_comments_head(){
    print '<script type="text/javascript"> var ajaxurl = "'. admin_url("admin-ajax.php") .'";</script>';
    print '<style type="text/css">'.get_option('additional_styling').'</style>';
}



add_action( 'wp_ajax_nopriv_annotate_lyrics', 'annotate_lyrics' );
add_action( 'wp_ajax_annotate_lyrics', 'annotate_lyrics' );

function annotate_lyrics(){

    check_ajax_referer('inline_comments_nonce', 'security');

    $comment = trim(
        wp_kses( $_POST['comment'],
                array(
                    'a' => array(
                        'href'  => array(),
                        'title' => array()
                    ),
                    'br'         => array(),
                    'em'         => array(),
                    'strong'     => array(),
                    'blockquote' => array(),
                    'code'       => array()
                )
               )
    );

    if ( empty( $comment ) ) die();

    if ( get_option('comment_registration') == 1 && ! is_user_logged_in() ) die();

    $data = array(
        'comment_post_ID' => (int)$_POST['post_id'],
        'comment_content' => $comment,
        'comment_type' => $_POST['user_selection'],
        'comment_parent' => 0,
        'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
        'comment_agent' => $_SERVER['HTTP_USER_AGENT'],
        'comment_date' => current_time('mysql'),
        'comment_approved' => 1
    );

    if ( is_user_logged_in() ){
        $current_user = wp_get_current_user();

        $author_email = $current_user->user_email;
        $author_url = $current_user->user_url;
        $author_name = $current_user->user_nicename;

        $data['user_id'] = $current_user->ID;
    } else {
        $author_email = empty( $_POST['user_email'] ) ? null : esc_attr( $_POST['user_email'] );
        $author_url = empty( $_POST['user_url'] ) ? null : esc_url( $_POST['user_url'], array('http','https') );
        $author_name = empty( $_POST['user_name'] ) ? null : esc_attr( $_POST['user_name'] );
    }

    $data['comment_author'] = $author_name;
    $data['comment_author_email'] = $author_email;
    $data['comment_author_url'] = $author_url;

    // ck - catch the new comment id for updating comment meta
    $comment_id = wp_insert_comment( $data );

    // ck - now add the para-id to the comment meta
    add_comment_meta( $comment_id, 'para_id' , $_POST['para_id'] ); 

    die();
}


add_action( 'wp_ajax_nopriv_inline_comments_load_template', 'inline_comments_load_template' );
add_action( 'wp_ajax_inline_comments_load_template', 'inline_comments_load_template' );

/**
 * Load comments and comment form
 *
 * @since 0.1-alpha
 */
function inline_comments_load_template(){

    check_ajax_referer('inline_comments_nonce', 'security');

    $comments = get_comments( array(
        'post_id' => (int)$_POST['post_id'],
        'number'  => 100,
        'status'  => 'approve',
        'order'   => 'ASC'
    ) );

                        ?>
                        <div class="inline-comments-container" id="comments_target">
                            <?php if ( $comments ) : foreach( $comments as $comment) : ?>
                            <?php

    // ck get the paragraph id from the comment meta
    $para_id = get_comment_meta( $comment->comment_ID, 'para_id', true );

    $user = new WP_User( $comment->user_id );
    $class = null;
    if ( ! empty( $user->roles ) && is_array( $user->roles ) ) {
        foreach ( $user->roles as $role ){
            $class = $role;
        }
    } else {
        $class = 'annon';
    }

    // ck -added data-comment-para-id to div
                            ?>
                            <div class="orphan-comment comment-para-id-<?php echo $para_id ?> inline-comments-content inline-comments-<?php echo $class; ?>" id="comment-<?php echo $comment->comment_ID; ?>">
                                <div class="inline-comments-p">
                                    <?php inline_comments_profile_pic( $comment->comment_author_email ); ?>
                                    <?php print $comment->comment_content; ?><br />
                                    <time class="meta">
                                        <strong><?php $user = get_user_by('login', $comment->comment_author ); if ( ! empty( $user->user_url ) ) : ?><a href="<?php print $user->user_url; ?>" target="_blank"><?php print $comment->comment_author; ?></a><?php else : ?><?php print $comment->comment_author; ?><?php endif; ?></strong>
                                        <a href="<?php echo get_permalink( $comment->comment_post_ID); ?>#<?php echo $comment->comment_ID; ?>" class="inline-comments-time-handle" data-comment_id="<?php echo $comment->comment_ID; ?>"><?php print human_time_diff( strtotime( $comment->comment_date ), current_time('timestamp') ); ?> ago.</a>
                                    </time>
                                </div>
                            </div>
                            <?php endforeach; endif; ?>
                        </div>
                        <?php die();
}





function inline_comments_profile_pic( $id_or_email=null, $email=null ){

    if ( is_null( $id_or_email ) ) {
        global $current_user;
        get_currentuserinfo();
        $id_or_email = $current_user->ID;
    }

    $html = get_avatar( $id_or_email, 150 );

    print '<span class="inline-comments-profile-pic-container">' . $html . '</span>';
}
