<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

	</div><!-- .site-content -->

<footer id="colophon" class="site-footer footer" role="contentinfo">
        
         <div class="outer">
            <div class="row">
        <div class="col-md-5">
            <i class="fa fa-map-pin" aria-hidden="true"></i> <span>Web developers from around the world</span>
                </div>
        <div class="col-md-3">
        <i class="fa fa-twitter" aria-hidden="true"></i> <span>@afrigalore</span>
                </div>
        <div class="col-md-4"> <i class="fa fa-envelope" aria-hidden="true"></i> <span>contact@afrigalore.com</span></div>
      </div>
        </div> 
        
        <div class="outside">
            <b>Afrigalore</b> &copy; 2015 All Rights Reserved <b>Terms of Use</b> and <b>Privacy Policy</b>
            
            <div id="btn-top"> <i class="fa fa-2x fa-angle-up" aria-hidden="true"></i></div>
            </div>
        
  
	</footer><!-- .site-footer -->

</div><!-- .site -->

<?php if(!is_page('76')) { ?>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<?php } ?>


<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.mixitup.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/list.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<?php wp_footer(); ?>


<div class="hide">
	<div class="arrow-icon-svg"><?php get_template_part( 'assets/svg/carousel-arrow-svg' ); ?></div>
	<div class="cluster-icon-svg"><?php get_template_part( 'assets/svg/map-pin-cluster-svg' ); ?></div>
	<div class="selected-icon-svg"><?php get_template_part( 'assets/svg/map-pin-selected-svg' ); ?></div>
	<div class="empty-icon-svg"><?php get_template_part( 'assets/svg/map-pin-empty-svg' ); ?></div>
	<div class="card-pin-svg"><?php get_template_part( 'assets/svg/pin-simple-svg' ); ?></div>
</div>

<!-- Latest compiled and minified JavaScript -->


</body>
</html>
