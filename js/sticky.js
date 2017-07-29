$(window).scroll(function(){
    if ($(this).scrollTop() > 220) {
       $('.navigation').addClass('stick');
    } else {
       $('.navigation').removeClass('stick');
    }
});


$(document).ready(function() {
        
    
    var owl = $('.owl-carousel');
    
    

owl.owlCarousel({
    loop:true,
    margin:0,
    nav:false,
    items:1,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:false,
        dotsContainer: '#carousel-custom-dots',



    lazyLoad: true,
 responsive:{
        0:{
            items:1,
        stagePadding: 0,

            
        },
        600:{
            items:1,
           stagePadding: 0,

        },
     
      800:{
            items:1,

                    stagePadding: 100,

        },
     
        1000:{
            items:1,
                    stagePadding: 150,

        }
    }
});

$(".slick-prev").click(function () {
    owl.trigger('prev.owl.carousel');
});

$(".slick-next").click(function () {
    owl.trigger('next.owl.carousel');
});

    $('.owl-dot').click(function () {
    owl.trigger('to.owl.carousel', [$(this).index(), 300]);
});
    
    
 $('.post-0 .sub-title a').mouseover(function(e) {
   $( ".post-0 .tagged" ).first().addClass( "rotate" );

});
    
    
$('.post-1 .sub-title a').mouseover(function(e) {
   $( ".post-1 .tagged" ).first().addClass( "rotate" );

});
    
$('.post-2 .sub-title a').mouseover(function(e) {
$( ".post-2 .tagged" ).first().addClass( "rotate" );

});
    
    
    $( ".sub-title a" ).mouseleave(function() {
   $( ".tagged" ).removeClass( "rotate" );
});



    var slider = $('.entry-featured-gallery');

    
   slider.owlCarousel({
    center: true,
    items:3,
    loop:true,
    lazyLoad: true,
    margin:3,
    animateIn: 'fadeInLeft',
  //  autoWidth: true,
   
});
    
    
    $(".list-prev").click(function () {
    slider.trigger('prev.owl.carousel');
});

$(".list-next").click(function () {
    slider.trigger('next.owl.carousel');
});
    
  $('#Container').mixItUp();
                    
  $('.search-box').click(function() {
    $('.filter-list').addClass("become");
}); 
    
    
    
    
var options = {
  valueNames: [ 'name', 'genre']
};

var userList = new List('primary', options);
    
        $('li.search-close').click(function() {
    $('ul.filter-list').removeClass("become");
           userList.search();
            $('.search').val('');
            
}); 
    
        $( "#btn-top" ).click(function() {
            console.log('Simple');
         jQuery('html, body').animate({
            scrollTop: 0
        },1500)
});

    
    
    
});


$(document).ready(function() {

        var slider = $('.bxslider');
    
slider.owlCarousel({
    loop:true,
    margin:0,
    nav:false,
    items: 1,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    lazyLoad:true,

});
    
    
    $(".bx-prev").click(function () {
    slider.trigger('prev.owl.carousel');
});

$(".bx-next").click(function () {
    slider.trigger('next.owl.carousel');
});
    
    
        jQuery( ".post-image" ).mouseover(function() {
            
            var $_this = jQuery(this);
            $_this.parents('.entry').addClass('tz_post_inc_blog_play');

            console.log('Hover here');
            
        });
    
     jQuery( ".post-image" ).mouseleave(function() {
            $(".entry").removeClass('tz_post_inc_blog_play');
            console.log('UnHover here');
            
        });
 
    });
    
$(document).ready(function() {

        var owl = $('.owl-text');

    owl.owlCarousel({
    loop:true,
    nav:false,
        items: 1,
     stagePadding: 0,
        autoplay: true,
        autoplayTimeout:2980,
    autoplayHoverPause:false,
        dotsContainer: '#carousel-custom-dots',
       // animateIn: 'flipInX',
     dotsContainer: '#carousel-custom-dots',



  
});
    
    $(".slick-prev").click(function () {
    owl.trigger('prev.owl.carousel');
});

$(".slick-next").click(function () {
    owl.trigger('next.owl.carousel');
});

    $('.owl-dot').click(function () {
    owl.trigger('to.owl.carousel', [$(this).index(), 300]);
});
    
    
$('.prettySocial').prettySocial();

    plyr.setup(document.querySelectorAll('.js-player'),{
		debug: 	false,
		title: 	"Video demo",
	autoplay: 	false,
        displayDuration: false,
	fullscreen: {
		enabled: false
	}
	});
    
    
    

});



jQuery(document.documentElement).keyup(function (event) {    
    
    

    var owl = jQuery(".owl-carousel");

    // handle cursor keys
    if (event.keyCode == 37) {
       // go left
    owl.trigger('prev.owl.carousel');
    } else if (event.keyCode == 39) {
       // go right
    owl.trigger('next.owl.carousel');
    }
    
})


$(document).ready(function() {
   $('.tabs').tabslet({
  mouseevent: 'click',
  attribute: 'href',
  animation: true
});
});

$(document).ready(function() {
   "use strict";



    /* Method for video */
    jQuery('.tz_play_btn').click(function(){

        var $_this = jQuery(this);

        jQuery(this).hide();
        
        
         var postID = $_this.parents('.video-image').find('.videoID').attr('data-id');
        
        $_this.parents('.video-image').find('.play-section').css('opacity',0);
        $_this.parents('.video-image').find('.tz_pause_btn').show();
        $_this.parents('.video-image').addClass(postID);
        $_this.parents('.tz-life-gate-blog-detail').addClass('tz-blog-detail-play');
        $_this.parents('.entry').addClass('tz_post_inc_blog_play');
        
   
        var player = jQuery('.' + postID).data('ytPlayer').player;

      player.playVideo();



    }) ;

    jQuery('.tz_pause_btn').click(function(){

        jQuery(this).hide();
        var $_this = jQuery(this);
        $_this.parents('.video-image').find('.play-section').css('opacity',1);
        $_this.parents('.video-image').find('.tz_play_btn').show();
        $_this.parents('.tz-life-gate-blog-detail').removeClass('tz-blog-detail-play');
        $_this.parents('.entry').removeClass('tz_post_inc_blog_play');
        
        
        

    });
    
    
});


/*$(document).ready(function() {
    
    
    jQuery( ".tz_play_btn" ).mouseover(function() {
        
           var $_this = jQuery(this);
        
        
          var videoID =   $_this.parents('.video-image').find('.videoID').attr('data-slide');
        
                var postID = $_this.parents('.video-image').find('.videoID').attr('data-id');


        
        $('.' + postID).YTPlayer({
  fitToBackground: true,
  videoId: videoID,
  pauseOnScroll: false,
  playerVars: {
    modestbranding: 0,
    autoplay: 0,
    controls: 1,
    showinfo: 0,
    wmode: 'transparent',
    branding: 0,
    rel: 0,
    autohide: 0,
    origin: window.location.origin
  }
});
        

});
    
    
    
    });*/


$(document).ready(function() {
    L.Icon.Default.imagePath = '/wp-content/themes/listable/assets/img/';
    
    var map, markers, CustomHtmlIcon;

      map = L.map('map', {
                scrollWheelZoom: true
            });
    
 
     
    
    var $item = $('.single_job_listing');
    var latitude = $item.data('latitude');
    console.log (latitude);
    

               
    
            if (typeof $item.data('latitude') !== "undefined" && typeof $item.data('longitude') !== "undefined") {

                map.setView([$item.data('latitude'), $item.data('longitude')], 13);

                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);




                $(window).on('update:map', function () {
                    map.setView([$item.data('latitude'), $item.data('longitude')], 13);
                });


                var categories = $item.data('categories'),
                    iconClass, m;


                var $icon = $('.selected-icon-svg'),
                    $tags = $item.find('.card__tag'),
                    $categories = $item.find('.category-icon'),

                    $tag, iconHTML = "<div class='" + iconClass + "'>" + $('.empty-icon-svg').html() + "</div>";


                if (categories === undefined || categories === null) {
                    iconClass = 'pin pin--empty'
                } else {
                    iconClass = 'pin'
                }

                iconHTML = "<div class='" + iconClass + "'>" + $icon.html() + "<div class='pin__icon'>" + $categories.html() + "</div></div>";

                var myIcon = L.divIcon({
                    html: iconHTML
                });

                L.marker([$item.data('latitude'), $item.data('longitude')], {
                    icon: myIcon
                }).addTo(map);



            } else {
                console.log('no');

            }
    
    
    
});




$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});