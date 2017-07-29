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

<div class="md-overlay"></div><!-- the overlay element -->


</div><!-- .site-content -->


<?php wp_footer(); ?>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/hish.js"></script>
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/lyric.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdn.quilljs.com/1.0.4/quill.js"></script>





</body>
</html>
