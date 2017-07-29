<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<?php global $post;

$taxonomies = array();
$data_output = '';
$terms = get_the_terms(get_the_ID(), 'job_listing_category');
$termString = '';
if ( is_array($terms) || is_object($terms) ) {
	$firstTerm = $terms[0];
	if ( ! $firstTerm == NULL ) {
		$term_id = $firstTerm->term_id;

		$data_output .= 'data-icon="' . listable_get_term_icon_url($term_id) .'"';
        $icon_output .= '' . listable_get_term_icon_url($term_id) .'';

		$count = 1;
		foreach ( $terms as $term ) {
			$termString .= $term->name;
			if ( $count != count($terms) ) {
				$termString .= ', ';
			}
			$count++;
		}
	}
} 
?>

<?php setCrunchifyPostViews(get_the_ID()); ?>


	<div id="primary" class="content-area">
        
        
    <?php $attachments = get_posts( array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_parent' => $post->ID ) ); ?>

                     <?php if ( count( $attachments ) > 1) : ?>

        
        <div class="feature-slider">
            <div class="listnav list-prev"><i class="fa fa-2x fa-angle-left" aria-hidden="true"></i></div>
            <div class="listnav list-next"><i class="fa fa-2x fa-angle-right" aria-hidden="true"></i></div>
                    
            
            <div class="entry-featured-gallery">
				<?php
				foreach ( $attachments as $attachment ) : ?>
                    <img class="owl-lazy" data-src="<?php echo wp_get_attachment_url($attachment->ID, 'carousel-image'); ?>">
                    
				<?php endforeach; ?>
			</div>
            
            
            
               <?php elseif ( count( $attachments ) == 1 ) : ?>
            
                <?php ?>

            
        

         <?php endif ; ?>
            
        </div>
        
		<main id="main" class="site-main post-content" role="main">

            
            
		
            
            <div class="single_job_listing"
	data-latitude="<?php echo get_post_meta($post->ID, 'geolocation_lat', true); ?>"
	data-longitude="<?php echo get_post_meta($post->ID, 'geolocation_long', true); ?>"
	data-categories="<?php echo $termString; ?>"
                 data-email="<?php echo get_post_meta( get_the_ID(), '_company_email', true); ?>"
	<?php echo $data_output; ?>>
                
            
            <div class="row">
                <div class="col-md-8">
                         <?php
		// Start the loop.
		while ( have_posts() ) : the_post(); ?>
                    
                    	<header class="entry-header">
					<nav class="single-categories-breadcrumb">
						<a href="<?php echo get_post_type_archive_link( 'job_listing' ) ?>"><?php esc_html_e( 'Listings', 'listable' ); ?></a> >>
						<?php
						$term_list = wp_get_post_terms(
							$post->ID,
							'job_listing_category',
							array(
								"fields" => "all",
								'orderby' => 'parent',
							)
						);

						if ( ! empty( $term_list ) && ! is_wp_error( $term_list ) ) {
							// @TODO make them order by parents
							foreach ( $term_list as $key => $term ) {
								echo '<a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a>';
								if ( count( $term_list ) - 1 !== $key ) {
									echo ' >>';
								}
							}
						} ?>
					</nav>

					<?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
					<?php the_company_tagline( '<span class="entry-subtitle" itemprop="description">', '</span>' ); ?>
                            

                                                    
				
				</header><!-- .entry-header -->
                    
                                  <?php get_template_part( 'content', 'meta' );?>

                    
                    <div class="row mid-section">

    <div class="col-md-4">
        <span class="midlink"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                <a href="#respond" data-hover="Write A Review">Write A Review</a></span></div>

    <div class="col-md-4">
        <span class="midlink"><i class="fa fa-heart-o" aria-hidden="true"></i><a href="#" data-hover="Add To Favorites">Add To Favorites</a></span></div>

    <div class="col-md-4">
        <span class="midlink"><i class="fa fa-share-alt" aria-hidden="true"></i> 
                                <a href="#" data-hover="Share This">Share This</a></span></div>


</div>
                    
                   <div class="job_description" itemprop="description">
			<?php 
                       
            $content = strip_shortcode_gallery( get_the_content() );                                        
            $content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_job_description', $content ) ); 
                       
                       echo $content; ?>
		</div>
                    
                
                <?php comments_template( '/rate-review.php' ); ?> 
                    
                    <span class="category-icon">
                        <?php echo file_get_contents($icon_output); ?>
                       </span>
                
                                    		<?php endwhile;?>

                    
                </div>
                 <div class="col-md-4">
                
                <?php if ( is_active_sidebar( 'listing__sticky_sidebar' ) ) : ?>
					<div class="listing-sidebar  listing-sidebar--top  listing-sidebar--secondary">
						<?php dynamic_sidebar('listing__sticky_sidebar'); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'listing_sidebar' ) ) : ?>
					<div class="listing-sidebar  listing-sidebar--bottom  listing-sidebar--secondary">
						<?php dynamic_sidebar('listing_sidebar'); ?>
					</div>
				<?php endif; ?>
                     
                </div>
            </div>
            
            

            </div>

            
		<!---?php the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) ); ? -->


		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>




