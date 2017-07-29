<?php
/**
 * The main template file
 * @package WordPress
 * @subpackage Galore
 * @since Galore 1.0
 */

get_header(); ?>


<div class="slider">
    
    <?php 
// the query
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>3, 'meta_key' => '_thumbnail_id'

)); ?>

<?php if ( $wpb_all_query->have_posts() ) : ?>
    
  <div class="owl-carousel home-slider">
        
            
        <!-- the loop -->
	<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
	        <div class="item"><a href="<?php the_permalink(); ?>"><img data-src="<?php the_post_thumbnail_url('slider-image'); ?>" class="owl-lazy"></a> </div>
	<?php endwhile; ?>
	<!-- end of the loop -->

    </div>
    
    
    	<?php wp_reset_postdata(); ?>

<?php endif; ?>



    <div class="box">
        <div class="arrows">

            <div class="col-md-2">
                <a class="slick-prev slick-arrow" style="display: block;"></a>
            </div>
            <div class="col-md-8">

                    <?php 
// the query
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>3, 'meta_key' => '_thumbnail_id'

)); ?>

<?php if ( $wpb_all_query->have_posts() ) : ?>
                
                <div id="owl-demo" class="owl-text owl-theme">
                   
                    	<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
                    <div class="item">
                        <div class="tag"><span><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span></div>

                        <span class="main-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </span>
                    </div>
	       <?php endwhile; ?>

                </div>


<?php wp_reset_postdata(); ?>

<?php endif; ?>
                <ul id='carousel-custom-dots' class='owl-dots'>
                    <li class='owl-dot'></li>
                    <li class='owl-dot'></li>
                    <li class='owl-dot'></li>
                </ul>

            </div>
            <div class="col-md-2">
                <a class="slick-next slick-arrow" style="display: block;"></a>
            </div>
        </div>





    </div>


</div>



   <div class="wrapper">
            
             <div class="row">
        <div class="col-md-8">
            
            <div class="trending">
              <h2 class="pinline"><span>Trending now</span></h2>
                
                
                <?php $the_query = new WP_Query( 'post_type=post&posts_per_page=3&orderby=meta_value_num&meta_key=post_views_count' ); ?> 
                
                <div class="row">
                    
                    <?php if ( $the_query->have_posts() ) : $i = 0; $post_id = get_the_ID(); while ( $the_query->have_posts() ) : $the_query->the_post(); ?> 
                    
            <div class="col-md-4 post-<?php echo $i; ?>">
                    
            <div class="feature" style="background-image:url('<?php the_post_thumbnail_url(); ?>')">
                
                
   <?php
        $category = get_the_category();
    $term_id  = $category[0]->term_id;
                ?>
                
                
                
                <span class="tagged" data-hover="&#x<?php echo get_term_meta( $term_id, 'icon', true );?>"><i class="<?php echo get_term_meta( $term_id, 'color', true );?>" aria-hidden="true"></i></span>
            </div>
            
            <span class="sub-title line-clamp"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
            
            <ul class="creds">
                <li><i class="fa fa-eye" aria-hidden="true"></i> <?php echo getCrunchifyPostViews(get_the_ID()); ?></li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php the_time('F j, Y') ?></li>

                
            </ul>
                    
                    </div>
                    
                    <?php $i++; endwhile; endif; wp_reset_postdata(); ?>
                    


      </div>
              
               
            </div>

            <!-- End Trending -->
            

			<?php get_template_part( 'content', 'middle' ); ?>

       
            
            </div>
     
                 
                 <?php get_sidebar()?>
                 
      </div>
            
        </div>




     <div class="picks">
            
            <div class="title">Editor Picks</div>
            <span class="hand">Handpicked posts just for you</span>
         
                             <?php 
// the query
$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>4, 'meta_key' => '_thumbnail_id'

)); ?>
   
         <?php if ( $wpb_all_query->have_posts() ) : ?>       
            
            <div class="row">
        
                <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
        <div class="col-xs-12 col-sm-6 col-md-3"><div class="post-">
          <div class="editor" style="background-image:url('<?php the_post_thumbnail_url(); ?>')">
              <div class="overlay">
                  <span class="here"><?php the_time('F j, Y') ?></span>
                  <span class="editor-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                    <span class="editor-tag"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span>

              </div>
            </div>
        </div></div>
                
            <?php endwhile; ?>
                
      </div>
         
         <?php wp_reset_postdata(); ?>

<?php endif; ?>
         
        </div>

<?php get_footer(); ?>

