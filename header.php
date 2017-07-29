<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Galore
 * @since Galore 1.0
 */
?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?> class="no-js">

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <meta name="description" content="A celebration of the stellar culture that is African.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/main.css">
        <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/queries.css">
        <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/animate.css">
        <script src="https://use.fontawesome.com/7b9bd272e9.js"></script>
        <link rel="icon" type="image/x-icon" href="http://afrigalore.com/favicon.ico" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Anton|Hind+Guntur|Source+Sans+Pro|Inconsolata|Poppins|Fjalla+One|Montserrat|Yanone+Kaffeesatz|Passion+One|Slabo+27px|Abril+Fatface|Domine|Scope+One|Frank+Ruhl+Libre|Great+Vibes|Satisfy|Palanquin|Roboto:100" rel="stylesheet">
        <!-- Important Owl stylesheet -->
        <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/owl-carousel/assets/owl.carousel.css">
        <link rel="stylesheet" href="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.css" />



        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">

    <div class="header">

    <div class="row">
        <div class="col-md-4">



            <ul class="socials">
                <li class="hovicon effect-3 sub-b"><a href="" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li class="hovicon effect-3 sub-b"><a href="" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li class="hovicon effect-3 sub-b"><a href="" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li class="hovicon effect-3 sub-b"><a href="" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li class="hovicon effect-3 sub-b"><a href="" target="_blank"><i class="fa fa-snapchat-ghost" aria-hidden="true"></i></a></li>
                <li class="hovicon effect-3 sub-b"><a href="" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>


            </ul>

        </div>
        <div class="col-md-4">
            <center>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"> <img src="http://localhost:8888/wordpress/wp-content/uploads/2016/08/logo.png" alt="Afrigalore"></a>
            </center>

        </div>


        <div class="col-md-4">
            <div class="query">
                <form action="/search.html" class="search-wrapper cf">
                    <input type="text" placeholder="Search here..." required="">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>

</div>


            <div class="navigation">
                <div class="inner">


                    <nav class="navbar navbar-default" role="navigation"> 
<!-- Brand and toggle get grouped for better mobile display --> 
  <div class="navbar-header"> 
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> 
      <span class="sr-only">Toggle navigation</span> 
      <span class="icon-bar"></span> 
      <span class="icon-bar"></span> 
      <span class="icon-bar"></span> 
    </button> 
    <a  id="brand" class="navbar-brand" href="#">MENU</a> 
  </div> 
  <!-- Collect the nav links, forms, and other content for toggling --> 
  <div class="collapse navbar-collapse navbar-ex1-collapse"> 
                       <?php /* Primary navigation */
wp_nav_menu( array(
  'menu' => 'main_menu',
  'depth' => 2,
  'container' => false,
  'menu_class' => 'nav navbar-nav',
    'link_before' => '<span class="navspan">', 
    'link_after' => '</span>',
  //Process nav menu using our custom nav walker
  'walker' => new wp_bootstrap_navwalker())
);
?>


  </div>
</nav>
                    

                </div>


            </div>