<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

            

<div class='tabs'>
    <ul class="blog-tabs clearfix">
        <li><a href="#tab-1">Latest Stories</a></li>
        <li><a href="#tab-2">Popular Stories</a></li>
    </ul>
    
    
    <div id='tab-1'>
    
     <?php 
// the query
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>10)); ?>

<?php if ( $wpb_all_query->have_posts() ) : ?>
        
        
                <!-- the loop -->
	<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>

             <div class="entry">
                
      <div class="tag"><span><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span></div>
                 
                 			<?php get_template_part( 'content', 'formats' ); ?>

                                    
                
                <div class="upside"><div class="upper">
                  <div class="row">
                      
        <div class="col-sm-2 col-xs-3 col-lg-2 the-date">
            <div class="dated"> <div class="day"><span><?php the_time('j') ?></span></div>  <div class="month"><span><?php the_time('m') ?></span></div> </div>
                      </div>
                      
        <div class="col-sm-10 col-xs-9 col-lg-10 the-title">                
            <h1 class="read"><span> <a href="<?php the_permalink()?>"><?php the_title()?></a></span></h1>
                      </div>
      </div>
                
                    </div></div>
      
                 <div class="content"> <?php the_content()?></div>
        

                
                
                </div>
        
                   
                 <div class="share">
                <div class="row">
                    <div class="col-sm-4 col-xs-4 col-lg-4 col-md-4 dest"><span>By</span><?php the_author()?></div>
        <div class="col-sm-4 col-xs-4 col-lg-4 col-md-4 dest">
                    
                    <ul class="share-social">
                    
                        <li><a href="#" data-type="facebook" data-url="<?php the_permalink()?>" data-title="<?php the_title()?>" data-description="<?php echo get_the_excerpt(); ?>" data-media="http://sonnyt.com/assets/imgs/prettySocial.png" class="prettySocial fa fa-facebook"></a></li>
                        
                        <li><a href="#" data-type="twitter" data-url="<?php the_permalink()?>" data-description="<?php the_title()?>" data-via="afrigalore" class="prettySocial fa fa-twitter"></a></li>

                        <li><a href="#" data-type="googleplus" data-url="<?php the_permalink()?>" data-description="<?php the_title()?>" class="prettySocial fa fa-google-plus"></a></li>
			
                        <li><a href="#" data-type="pinterest" data-url="<?php the_permalink()?>" data-description="<?php the_title()?>" data-media="<?php the_post_thumbnail_url()?>" class="prettySocial fa fa-pinterest"></a></li>

                        <li><a href="#" data-type="linkedin" data-url="<?php the_permalink()?>" data-title="<?php the_title()?>" data-description="<?php echo get_the_excerpt(); ?>" data-via="afrigalore" data-media="<?php the_post_thumbnail_url()?>" class="prettySocial fa fa-linkedin"></a></li>
                
            </ul>
                    
                    </div>
        <div class="col-sm-4 col-xs-4 col-lg-4 col-md-4 dest"><?php comments_popup_link( __( 'No Comments', 'afrigalore' ), __( '1 Comment', 'afrigalore' ), __( '% Comments', 'afrigalore' ) ); ?></div>
      </div>
                 
                 </div>
        
        
    <?php endwhile; ?>
	<!-- end of the loop -->

    
    
    	<?php wp_reset_postdata(); ?>

<?php endif; ?>
        
    
    
    </div>
    <div id='tab-2'>gfrgfh</div>
</div>



            
            
    
                 
      