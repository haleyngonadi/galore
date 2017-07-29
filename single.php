<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<?php setCrunchifyPostViews(get_the_ID()); ?>


	<div id="primary" class="content-area">
		<main id="main" class="wrapper" role="main">

	<div class="row">	 <!-- Start the Loop. -->
<div class="col-md-8"> 
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <div class="single-tag"><span><?php the_date(); ?></span></div>

            <h1 class="single-title"><span> <?php the_title()?></span></h1>

	<?php get_template_part( 'content', 'formats' ); ?>    
                     <div class="inner-content"> <?php the_content()?></div>


    
    <?php comments_template(); ?> 

    

 	<!-- Stop The Loop (but note the "else:" - see next line). -->

    <?php endwhile; ?></div>


            <?php endif; ?>
            
        <?php get_sidebar();?>    
        
            </div>


		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>


