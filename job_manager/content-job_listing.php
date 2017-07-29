<?php 

global $post;

$taxonomies  = array();
$terms       = get_the_terms( get_the_ID(), 'job_listing_category' );
$termString  = '';
$data_output = '';
if ( is_array( $terms ) || is_object( $terms ) ) {
	$firstTerm = $terms[0];
	if ( ! $firstTerm == null ) {
		$term_id = $firstTerm->term_id;
		$data_output .= ' data-icon="' . listable_get_term_icon_url( $term_id ) . '"';
		$count = 1;
		foreach ( $terms as $term ) {
			$termString .= $term->name;
			if ( $count != count( $terms ) ) {
				$termString .= ', ';
			}
			$count ++;
		}
	}
}

?>

<div <?php job_listing_class("col-1-3 grid-item"); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
    
    <div class="module" itemscope itemtype="http://schema.org/LocalBusiness"
	         data-latitude="<?php echo get_post_meta( $post->ID, 'geolocation_lat', true ); ?>"
	         data-longitude="<?php echo get_post_meta( $post->ID, 'geolocation_long', true ); ?>"
	         data-img="<?php echo the_post_thumbnail_url( $post->ID, 'full' ); ?>"
	         data-permalink="<?php the_job_permalink(); ?>"
	         data-categories="<?php echo $termString; ?>"
		<?php echo $data_output; ?>>
        
        	<a href="<?php the_job_permalink(); ?>">

    <div class="listing-header" style="background-image:url(<?php the_post_thumbnail_url('carousel-image'); ?>)">        
        <span class="label label-new">
      <?php echo $termString; ?>
    </span>
        
    </div>
    <div class="inner-listing">
        
      <?php  if ( is_position_featured( $post ) ) {
    echo '<div class="featured">Featured</div>';
	       }
        
        ?>
		<h3 class="listing-title"><?php the_title(); ?></h3>
        <?php the_company_tagline( '<div class="tagline">', '</div>' ); ?>
        
         <footer class="below">
             
             <?php
				$rating = get_average_listing_rating( $post->ID, 1 );
				if ( ! empty( $rating ) ) { ?>
					<div class="rating  card__rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
						<meta itemprop="ratingValue" content = "<?php echo get_average_listing_rating( $post->ID, 1 ); ?>">
						<meta itemprop="reviewCount" content = "<?php echo get_comments_number( $post->ID ) ?>; ?>">
						<span class="js-average-rating"><?php echo get_average_listing_rating( $post->ID, 1 ); ?></span>
					</div>
             <div class="location">
			<?php the_job_location( false ); ?>
		</div>
        
				<?php } else {
					if ( get_post_meta( $post->ID, 'geolocation_street', true ) ) { ?>
						<div class="card__rating  card__pin">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
						</div>
             <div class="location">
			<?php the_job_location( false ); ?>
		</div>
        
					<?php }
				} ?>
             
		
       </footer>
        
		</div>
	</a>
        
        
    </div>
</div>