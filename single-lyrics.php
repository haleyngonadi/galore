<?php
/**
 * The template for displaying all artist pages!
 *
 * @package WordPress
 * @subpackage Galore
 * @since Galore 1.0
 */

get_header('lyrics'); ?>

<!--?php setPostViews(get_the_ID()); ?-->


<header class="lyric-header headtea">

    <div class="header-inner">

        <div class="search-fade">

            <div class="col-md-11"><input placeholder="Search" id="search-header"></div>
            <div class="col-md-1">
                <a class="close-button"></a>
            </div>

        </div>

        <div class="logo"><a>  <img src="http://localhost:8888/wordpress/wp-content/uploads/2016/08/logo.png"></a></div>
        <nav class="header-nav">
            <ul class="mt-menu">
                <div class="alphabets">
                    <li><a>A</a></li>
                    <li><a href="">B</a></li>
                    <li><a href="">C</a></li>
                    <li><a href="">D</a></li>
                    <li><a href="">E</a></li>
                    <li><a href="">F</a></li>
                    <li><a href="">G</a></li>
                    <li><a href="">H</a></li>
                    <li><a href="">I</a></li>
                    <li><a href="">J</a></li>
                    <li><a href="">K</a></li>
                    <li><a href="">L</a></li>
                    <li><a href="">M</a></li>
                    <li><a href="">N</a></li>
                    <li><a href="">O</a></li>
                    <li><a href="">P</a></li>
                    <li><a href="">Q</a></li>
                    <li><a href="">R</a></li>
                    <li><a href="">S</a></li>
                    <li><a href="">T</a></li>
                    <li><a href="">U</a></li>
                    <li><a href="">V</a></li>
                    <li><a href="">W</a></li>
                    <li><a href="">X</a></li>
                    <li><a href="">Y</a></li>
                    <li><a href="">Z</a></li>

                    <li><a href="" class="submit"><i class="fa fa-plus" aria-hidden="true"></i> Submit Lyrics</a></li>
                </div>

                <li class="ham" title="Menu" id="hamburger-icon">

                    <span class="line line-1"></span>
                    <span class="line line-2"></span>
                    <span class="line line-3"></span>

                </li>

                <li><a class="drop-here"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                    <ul class="dropdown-content">
                        <li><a href="http://twitter.com/afrigalore" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="http://facebook.com/afrigalore" target="_blank"><i class="fa fa-facebook-official"></i></a></li>

                        <li><a href="http://instagram.com/afrigalore" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </li>




                <li><a class="search-button"><i class="fa fa-search" aria-hidden="true"></i></a></li>

            </ul>
        </nav>


        <div class="mobile-menu">
            <h2 class="related-title pick">Pick An Alphabet </h2>


            <ul>
                <li><a>A</a></li>
                <li><a href="">B</a></li>
                <li><a href="">C</a></li>
                <li><a href="">D</a></li>
                <li><a href="">E</a></li>
                <li><a href="">F</a></li>
                <li><a href="">G</a></li>
                <li><a href="">H</a></li>
                <li><a href="">I</a></li>
                <li><a href="">J</a></li>
                <li><a href="">K</a></li>
                <li><a href="">L</a></li>
                <li><a href="">M</a></li>
                <li><a href="">N</a></li>
                <li><a href="">O</a></li>
                <li><a href="">P</a></li>
                <li><a href="">Q</a></li>
                <li><a href="">R</a></li>
                <li><a href="">S</a></li>
                <li><a href="">T</a></li>
                <li><a href="">U</a></li>
                <li><a href="">V</a></li>
                <li><a href="">W</a></li>
                <li><a href="">X</a></li>
                <li><a href="">Y</a></li>
                <li><a href="">Z</a></li>

            </ul>

            <a href="" class="submit-mobile"><i class="fa fa-plus" aria-hidden="true"></i> Submit Lyrics</a>

        </div>

    </div>

</header>


<div class="page-content md-show" data-post_id="<?php echo $post->ID; ?>">


    <div class="page-title-wrapper">
        <div class="container">
            <div class="page-title option animated pulse"> 
                <?php the_title();?>

                <?php
                $verified = get_post_meta(get_the_id(), 'very-checkbox', true);
         

                if ( $verified ) {
                    echo '<a href="/verified" class="tooltip-toggle" aria-label="Verified Lyrics"><i class="fa fa-check-circle" aria-hidden="true"></i> </a>';
                }

              

                else {echo '';}
                ?>
                
                
               
            
            </div>
            <div class="page-subtitle">
                <ul class="lyricrumbs">
                    <li>Artists</li>  
                    <li><?php $lyric_artist = get_post_meta($post->ID, 'lyric_artist', true);?>
                        <a href="/wordpress/artists/<?php echo strtolower($lyric_artist);?>"> 
                        <?php echo $lyric_artist;?> </a> </li> 
                </ul>



            </div>
        </div>
    </div>


    <div class="container">
        <div class="row site-content">
            <div class="col-md-8 col-sm-8 col-xs-12 animated bounceInLeft">

                <div class="row">
                    <div class="welcome-box col-md-4 col-sm-4 col-xs-4">
                        <div class="artwork" style="background-image:url('<?php the_post_thumbnail_url()?>')"><img src="<?php the_post_thumbnail_url()?>" class="responsive-image"></div>

                    </div>

                    <div class="col-md-8 col-sm-8  col-xs-8 sideways">

                        <ul class="side">
                            <li><span class="line left" data-text="" title="Release Date"><?php echo get_post_meta(get_the_id(), 'lyric_date', true);?></span></li>
                            <li><span class="line left" data-text="" title="Album"><?php echo get_post_meta(get_the_id(), 'lyric_album', true);?></span></li>
                            <li><span class="line left" data-text="" title="Views">
                                
                                <?php getCrunchifyPostViews( __( 'No Comments', 'afrigalore' ), __( '1 Comment', 'afrigalore' ), __(get_the_ID(), '% Comments', 'afrigalore' ) ); ?>
                                
                                <?php echo getPostViews(get_the_ID()); ?>                                
                                </span>
                            
                            </li>
                            <li><span class="line left" data-text="" title="Producer(s)"><?php echo get_post_meta(get_the_id(), 'lyric_producers', true);?></span></li>



                        </ul>

                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="lyric-body">
                            

                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                            
                            <?php the_content(); ?>
                            
                            <!-- Stop The Loop (but note the "else:" - see next line). -->
                            
                            <!--?php comments_template(); ?--> 


                            <?php endwhile; ?>


                        <?php endif; ?>
                        

                        
                        </div>
                        


                        <div class="share">
                            <a href="/" class="twitter social-share"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="/" class="facebook social-share"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                            <a href="/" class="instagram social-share"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="/" class="plus social-share"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a>
                            <a href="/" class="print social-share"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </div>
                   
                     

                        <?php

                        $id = get_the_ID();
                        $artist = get_post_meta($post->ID, 'lyric_artist', true);
                        $args = array(
                            'post_type' => 'lyrics',
                            'posts_per_page' => 5,
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'artist',
                                    'field'    => 'slug',
                                    'terms'    => $artist,
                                ),
                            ),
                            'post__not_in' => array($id),

                        );

                        $the_query = new WP_Query( $args );
                        

                        ?>
                        
                        <?php if ( $the_query->have_posts() ) : ?>


                      <div class="related-lyrics">
                          <h2 class="related-title"><?php _e( 'Related Lyrics' ); ?></h2>

                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                          <li><a href="<?php the_permalink(); ?>">
                              <?php $lyric_artist = get_post_meta($post->ID, 'lyric_artist', true);
                              echo $lyric_artist; 
                              ?> – <?php the_title(); ?></a></li>

                        <?php endwhile; ?>
                        <!-- end of the loop -->
                        </div>

                        <?php wp_reset_postdata(); ?>

                        <?php else : ?>
                        
                        <div class="related-lyrics">
                        <h2 class="related-title"><?php _e( 'Related Lyrics' ); ?></h2>
                        <p><?php _e( 'Sorry, no related lyrics were found |' ); ?>  <a href="/submit-lyrics">Add New?</a></p>
                        </div>                        
                        <?php endif; ?>
                        


                  
                    </div>

                </div>

            </div>
            
            
            
            
            <div class="col-md-4 col-sm-4 col-xs-12 animated bounceInRight">
                <div class="sided">
                
                <?php if ( is_active_sidebar( 'lyric-sidebar' ) ) : ?>
                <?php dynamic_sidebar( 'lyric-sidebar' ); ?>
                <?php endif; ?>
                

           

                <div class="widget">
                    <h2 class="widget-title">
                        <span>Latest News</span>
                    </h2>

                        
                        
                        <?php 
                        // the query
                        $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>4, 'meta_key' => '_thumbnail_id'

                                                           )); ?>

                        <?php if ( $wpb_all_query->have_posts() ) : ?>

                            <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
                        
                    <div class="row latest-news">  
                        <div class="col-md-4 col-xs-4 latest-image">
                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                
                                <div class="photo" style="background-image:url(<?php the_post_thumbnail_url('carousel-image'); ?>)"></div>
                                
                            </a>
                        </div>
                        
                        
                        <div class="col-md-8 col-xs-8 latest-text">
                            <span id="tier"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span>
                            <h3> <a href=" <?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
                            <span id="date"><?php the_date(); ?></span>

                        </div>
                        </div>
            
                        
                            <?php endwhile; ?>



                        <?php wp_reset_postdata(); ?>

                        <?php endif; ?>
                        
                        
                       

                </div>

            </div>
            </div>

        </div>

    </div> 



</div>


<div class="highlight-active"></div>



<div class="annonate-square animated slideInLeft">
    
    <span class="ref"></span>
     
    <div class="the-count"></div>

    <div class="quote-lyrics"></div>
    
    <?php get_template_part( 'content', 'lyric' );?>


    
</div>

<ul class="social-nav model-0">
    <li><a href="https://twitter.com/vineethtrv" class="twitter"><i class="fa fa-twitter"></i></a></li>
    <li><a href="https://www.facebook.com/vini.thekingal" class="facebook"> <i class="fa fa-facebook"></i></a></li>
    <li><a href="https://plus.google.com/u/0/109987289949504261649/posts" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
    <li><a class="linkedin"><i class="fa fa-linkedin"></i></a></li>
    <li><a class="pinterest"><i class="fa fa-pinterest-p"></i></a></li></ul>



<?php get_footer('lyrics'); ?>