<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="wrapper" role="main">
          

            <header class="main-header">
		<?php the_title( '<h1 class="pageline" style="margin-bottom: 0px; margin-top: 0;"><span>', '</span></h1>' ); ?>

            
            <ul class="filter-list clearfix">
                <li class="search-hidden">     <input class="search search-field" placeholder="Search" /></li>
            <li class="filter" data-filter="all">Show All</li>
            <li class="filter" data-filter=".category-digit">#</li>
            <li class="filter" data-filter=".category-A">A</li>
            <li class="filter" data-filter=".category-B">B</li>
            <li class="filter" data-filter=".category-C">C</li>
                <li class="filter" data-filter=".category-D">D</li>
                <li class="filter" data-filter=".category-E">E</li>
                <li class="filter" data-filter=".category-F">F</li>
                <li class="filter" data-filter=".category-G">G</li>
                <li class="filter" data-filter=".category-H">H</li>
                <li class="filter" data-filter=".category-I">I</li>
                <li class="filter" data-filter=".category-J">J</li>
                <li class="filter" data-filter=".category-K">K</li>
                <li class="filter" data-filter=".category-L">L</li>
                <li class="filter" data-filter=".category-M">M</li>
                <li class="filter" data-filter=".category-N">N</li>
                <li class="filter" data-filter=".category-O">O</li>
                <li class="filter" data-filter=".category-P">P</li>
                <li class="filter" data-filter=".category-Q">Q</li>
                <li class="filter" data-filter=".category-R">R</li>
                <li class="filter" data-filter=".category-S">S</li>
                <li class="filter" data-filter=".category-T">T</li>
                <li class="filter" data-filter=".category-U">U</li>
                <li class="filter" data-filter=".category-V">V</li>
                <li class="filter" data-filter=".category-W">W</li>
                <li class="filter" data-filter=".category-X">X</li>
                <li class="filter" data-filter=".category-Y">Y</li>
                <li class="filter" data-filter=".category-Z">Z</li>

            <li class="search-close search-hidden"><i class="fa fa-close" aria-hidden="true"></i></li>
            <li class="search-filter"><i class="fa fa-search search-box" aria-hidden="true"></i></li>


          </ul>
            	</header><!-- .entry-header -->

                

       <ul class="row list" id="Container">     

             <?php $query = new WP_Query( array( 'post_type' => 'artists', 'orderby'=>'title','order'=>'ASC')); ?>
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
            
           

           
           <li class="mix col-md-3 col-sm-4 col-xs-12 category-<?php $str = get_the_title(); if (ctype_digit(substr($str, 0, 1) )) { echo 'digit'; } else { echo $str[0];} ?>">
               <div class="artist-image">
                   <?php the_post_thumbnail('artist-image'); ?>
                   <a href="<?php the_permalink() ?>"></a>

                   <div class="round-arrow-wrapper">
                    <div class="arrow-right"></div>
                       <div class="circle-anim"></div>
                   </div>


               </div>  
     

 <div id="artist-line">
     
          
 <!-- Display the Title as a link to the Post's permalink. -->
     <h2 class="artist-title name"><span style="padding-right: 8px; padding-left: 6px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></span></h2>
     

  <p class="postmetadata genre"><?php the_terms( $post->ID, 'genre', '', ', ', ' ' ); ?></p>
     
     <div class="title-icon">
					<div class="title-icon-line"></div>
					<div class="title-icon-line line-short"></div>
					<div class="title-icon-line line-short"></div>
					<div class="title-icon-line"></div>
				</div>
     
                      <ul class="artists-socials">
                     
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
    echo '<a  class="hvr-float" href="' .$facebook.'" target="_blank"><li><i class="fa fa-2x fa-facebook-square" aria-hidden="true"></i></li></a>';
}
        
  
   
                     
else {echo '';}
?>
            
                 
                 </ul>

     </div>
 </li> <!-- closes the first div box -->
           
           
 <?php endwhile; 
 wp_reset_postdata();
 else : ?>
           
           
 <p><?php _e( 'Sorry, no artists matched your criteria.' ); ?></p>
 <?php endif; ?>
            
                </ul>     </main></div>


            
<?php get_footer(); ?>
