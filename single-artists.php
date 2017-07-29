<?php
/**
 * The template for displaying all artist pages!
 *
 * @package WordPress
 * @subpackage Galore
 * @since Galore 1.0
 */

get_header('artists'); ?>

<div class="entry-content artist_page"
     data-facebook="<?php echo get_post_meta( get_the_ID(), 'artist_fb', true );?>"
     data-instagram="<?php echo get_post_meta( get_the_ID(), 'artist_ig', true );?>"
     data-youtube="<?php echo get_post_meta( get_the_ID(), 'artist_youtube', true );?>"
     data-channel="<?php echo get_post_meta( get_the_ID(), 'meta-checkbox', true );?>"
     >
    
    <div class="row">
        <div class="col-md-8">
            

        <div class="row">
            <div class="col-md-4 col-sm-4"> 
         <a href="<?php the_post_thumbnail_url('full')?>" class="litebox" target="_self"> 
             <?php the_post_thumbnail('artist-image')?></a>
                
                
            </div>   
             <div class="col-md-8 col-sm-8 "> 
            
                         <?php the_title( '<h1 class="pageline"><span style="text-transform: capitalize;">', '</span></h1>' ); ?>

                 <?php while ( have_posts() ) : the_post(); ?>

                    <?php the_content();?>
                 
                         <?php endwhile; ?>
                 
                 <ul class="artist-socials">
                     
<?php
$twitter = get_post_meta(get_the_id(), 'artist_twitter', true);
$instagram = get_post_meta(get_the_id(), 'artist_ig', true);
$facebook = get_post_meta(get_the_id(), 'artist_fb', true);


if ( $twitter ) {
    echo '<a  class="hvr-float" href="https://twitter.com/' .$twitter.'" target="_blank"><li><i class="fa fa-2x fa-twitter" aria-hidden="true"></i></li></a>';
}
   
    if ( $instagram ) {
    echo '<a  class="hvr-float" href="https://instagram.com/' .$instagram.'" target="_blank"><li><i class="fa fa-2x fa-instagram" aria-hidden="true"></i></li></a>';}
        
         if ( $facebook ) {
    echo '<a  class="hvr-float" href="' .$facebook.'" target="_blank"><li><i class="fa fa-2x fa-facebook" aria-hidden="true"></i></li></a>';
}
        
  
   
                     
else {echo '';}
?>
            
                 
                 </ul>


            
            </div>   
            </div>
            
            
            
            <div class='tabs'>
    <ul class="blog-tabs clearfix">
        <li><a href="#tab-1">Recent Videos</a></li>
        <li><a href="#tab-2">Songs</a></li>
        <li><a href="#tab-3">Related Posts</a></li>

    </ul>
                
                <div id='tab-1'>
                    
                    <div class="loader loader--style6" title="5">
  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
    <rect x="0" y="13" width="4" height="5" fill="#333">
      <animate attributeName="height" attributeType="XML"
        values="5;21;5" 
        begin="0s" dur="0.6s" repeatCount="indefinite" />
      <animate attributeName="y" attributeType="XML"
        values="13; 5; 13"
        begin="0s" dur="0.6s" repeatCount="indefinite" />
    </rect>
    <rect x="10" y="13" width="4" height="5" fill="#333">
      <animate attributeName="height" attributeType="XML"
        values="5;21;5" 
        begin="0.15s" dur="0.6s" repeatCount="indefinite" />
      <animate attributeName="y" attributeType="XML"
        values="13; 5; 13"
        begin="0.15s" dur="0.6s" repeatCount="indefinite" />
    </rect>
    <rect x="20" y="13" width="4" height="5" fill="#333">
      <animate attributeName="height" attributeType="XML"
        values="5;21;5" 
        begin="0.3s" dur="0.6s" repeatCount="indefinite" />
      <animate attributeName="y" attributeType="XML"
        values="13; 5; 13"
        begin="0.3s" dur="0.6s" repeatCount="indefinite" />
    </rect>
  </svg>
</div>
                    
                         <div id="playlist_titles" class="row"> </div>
                    <div id="loadMore"><span>Load More</span></div>
                </div>
                <div id='tab-2'>Tab 2</div>
                
                
                
                <div id='tab-3'>
                
                    
                    
                        <?php 
                    
            $artist_tag =  get_post_meta( get_the_ID(), 'artist_tag', true );
// the query
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'tag' => $artist_tag, 'post_status'=>'publish', 'posts_per_page'=>10, 'meta_key' => '_thumbnail_id'));
                    
                    ?>

<?php if ( $wpb_all_query->have_posts() ) :  ?>
    
        
            
        <!-- the loop -->
	<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
	              <div class="classic-blog-style clear-fix">
            <div class="thumb">
				<a href="<?php the_permalink(); ?>">
                              <?php the_post_thumbnail('slider-image')?>
              </a>
                            </div>
            <div class="post-details  table">

                <div class="table-cell">		
					<div class="tag">
                        <span><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span> 
					</div>					
					<h3 class="read">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>					</a>
					</h3>                                
					<div class="entry-excerpt">
                    Dolor sed, blandit egestas, magna leo sagittis parturient sit consectetuer class, nunc ultrices gravida luctus posuere sed sed ...                    </div>
                    
                    <div class="post-meta">
                        <div class="post-author">
                            <span class="avatar">
                                <i class="fa fa-user"></i>
                            </span>
                           <?php the_author(); ?>                       
                        </div>                                        
                        <div class="date">
                            <span><i class="fa fa-clock-o"></i></span>
            				    <?php the_date(); ?>                          
            			</div>
                        <div class="meta-comment">
                			<span><i class="fa fa-comments-o"></i></span>
                			<?php comments_popup_link( __( '0', 'afrigalore' ), __( '1', 'afrigalore' ), __( '% Comments', 'afrigalore' ) ); ?>
                		</div>
                    </div>
                    
				</div>
            </div>
        </div>
 <?php endwhile; 
 wp_reset_postdata();
 else : ?>

 	<!-- The very first "if" tested to see if there were any Posts to -->
 	<!-- display.  This "else" part tells what do if there weren't any. -->
 	<div style="text-align:center;">
                    <h1 class="read" style="text-align:center; margin-bottom: 0px;"><span>Sorry!</span></h1>
        There are currently no posts about "<?php the_title(); ?>." </div>


 	<!-- REALLY stop The Loop. -->
	<!-- end of the loop -->

    
    

<?php endif; ?>
                    
                    
                    
              
                
                </div>
            </div>
            
            
        </div>
        <div class="col-md-4">
        
        <?php if ( is_active_sidebar( 'artist-sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'artist-sidebar' ); ?>
            <?php endif; ?>
            
            
        </div>
    </div>
    
</div>



<?php get_footer(); ?>