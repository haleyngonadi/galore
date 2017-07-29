$( document ).ready(function() {

$( ".close-button" ).click(function() {
$( ".search-fade" ).removeClass('search-fadein');
});

$( ".search-button" ).click(function() {
$( ".search-fade" ).addClass('search-fadein');
console.log('Search');
});

$( ".drop-here" ).click(function(e) {
$( ".dropdown-content" ).toggleClass("show-menu");
e.stopPropagation();



});


$(".dropdown-content").click(function(e){
e.stopPropagation();
});

});

$(document).click(function(){
    $(".dropdown-content").removeClass("show-menu");
    
});




$(window).scroll(function(){
    var navTop =  $(window).scrollTop();
    $('.model-0').css("top", navTop + 600);


});



$(function() {
    //caches a jQuery object containing the header element
    var header = $(".lyric-header");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 80) {
            header.removeClass('headtea--pinned').addClass("headtea--unpinned");
        } else {
            header.removeClass("headtea--unpinned").addClass('headtea--pinned');
        }
    });
});


$( document ).ready(function() {
    var hamburger = $('#hamburger-icon');
    hamburger.click(function() {
        hamburger.toggleClass('active');
        $('.mobile-menu').toggleClass('menu-active');
        return false;
    });
});


$( document ).ready(function() {


    $( "#btn-top" ).click(function() {
        console.log('Simple');
        jQuery('html, body').animate({
            scrollTop: 0
        },1500)
    });
    
    if ($('.multitab-widget li').length == 2) { 
        
        $('.multitab-tab').addClass('twice');
    }
    
 
    
    $(".lyric-body").hish();
    
    $('.switch label').on('click', function(){
        var indicator = $(this).parent('.switch').find('span');
        if ( $(this).hasClass('right') ){
            $(indicator).addClass('right');
        } else {
            $(indicator).removeClass('right');
        }
    });
    

    
    $('[data-toggle="tooltip"]').tooltip();


    
    $('.highlight').each( function( index ) {

        // generate hashcode
        var para_id = $( this ).text().hashCode();

        // add the hashcode as an id
        $( this ).addClass('para-id-' + para_id );

        // also store the para_id on the p so that we can use it later
        $( this ).attr( 'data-para-id' , para_id );

        // get comments
        var comments = $( 'div.comment-para-id-' + para_id );

        // hide them 
        comments.hide();

        // remove the orphan-comment class (only those comments without a matching p will be left)
        comments.removeClass('orphan-comment');

        // add the number of comments to the link
        $( this ).append('<span class="p-comment-count"><a href="#" class="toggle_comments">' + comments.length + '</a></span>');

    });
    
    
    
    var test_id = $( 'p' ).hashCode();
    console.log(test_id);

    
    if (test_id == '-284938874') {
        console.log('Working great');
    }
    
    else {
     console.log('Nothing found!');   
    }
    

        
});



//<![CDATA[
jQuery(document).ready(function($){ $(".multitab-widget-content-widget-id").hide(); $("ul.multitab-widget-content-tabs-id li:first a").addClass("multitab-widget-current").show(); $(".multitab-widget-content-widget-id:first").show(); $("ul.multitab-widget-content-tabs-id li a").click(function() { $("ul.multitab-widget-content-tabs-id li a").removeClass("multitab-widget-current a"); $(this).addClass("multitab-widget-current"); $(".multitab-widget-content-widget-id").hide(); var activeTab = $(this).attr("href"); $(activeTab).fadeIn(); return false; }); });
//]]>


"use strict";
function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
r(function(){
    if(!document.getElementsByClassName) {
        // IE8 support
        var getElementsByClassName = function(node, classname) {
            var a = [];
            var re = new RegExp('(^| )'+classname+'( |$)');
            var els = node.getElementsByTagName("*");
            for(var i=0,j=els.length; i<j; i++)
                if(re.test(els[i].className))a.push(els[i]);
            return a;
        }
        var videos = getElementsByClassName(document.body,"youtube");
    }
    else {
        var videos = document.getElementsByClassName("youtube");
    }

    var nb_videos = videos.length;
    for (var i=0; i<nb_videos; i++) {
        
        $('.loader').fadeOut();
        // Based on the YouTube ID, we can easily find the thumbnail image
        videos[i].style.backgroundImage = 'url(http://i.ytimg.com/vi/' + videos[i].id + '/sddefault.jpg)';

        // Overlay the Play icon to make it look like a video player
        var play = document.createElement("div");
        play.setAttribute("class","play");
        videos[i].appendChild(play);

        videos[i].onclick = function() {
            // Create an iFrame with autoplay set to true
            var iframe = document.createElement("iframe");
            var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
            if (this.getAttribute("data-params")) iframe_url+='&'+this.getAttribute("data-params");
            iframe.setAttribute("src",iframe_url);
            iframe.setAttribute("frameborder",'0');
            iframe.setAttribute("width",'318');
            iframe.setAttribute("height",'210');

            // The height and width of the iFrame should be the same as parent
            iframe.style.width  = this.style.width;
            iframe.style.height = this.style.height;

            // Replace the YouTube thumbnail with YouTube Player
            this.parentNode.replaceChild(iframe, this);
        }
    }
});


$(function() {

    
    $(window).bind("resize",function(){

        if($(this).width() <768){
            
            $('.sided').removeClass('left-sided');
            
        }
        

    })
    
  

});



$(function() {
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();

        if (scroll >= 398) {
            
            $('.sided').addClass('left-sided');
        } else {
            $('.sided').removeClass('left-sided');
        }
    });
});






/**** Annontation ****/

function replaceSelection(html, selectInserted) {
    var sel, range, fragment;

    if (typeof window.getSelection != "undefined") {
        // IE 9 and other non-IE browsers
        sel = window.getSelection();

        // Test that the Selection object contains at least one Range
        if (sel.getRangeAt && sel.rangeCount) {
            // Get the first Range (only Firefox supports more than one)
            range = window.getSelection().getRangeAt(0);
            range.deleteContents();

            // Create a DocumentFragment to insert and populate it with HTML
            // Need to test for the existence of range.createContextualFragment
            // because it's non-standard and IE 9 does not support it
            if (range.createContextualFragment) {
                fragment = range.createContextualFragment(html);
            } else {
                // In IE 9 we need to use innerHTML of a temporary element
                var div = document.createElement("div"), child;
                div.innerHTML = html;
                fragment = document.createDocumentFragment();
                while ( (child = div.firstChild) ) {
                    fragment.appendChild(child);
                }
            }
            var firstInsertedNode = fragment.firstChild;
            var lastInsertedNode = fragment.lastChild;
            range.insertNode(fragment);
            if (selectInserted) {
                if (firstInsertedNode) {
                    range.setStartBefore(firstInsertedNode);
                    range.setEndAfter(lastInsertedNode);
                }
                sel.removeAllRanges();
                sel.addRange(range);
            }
        }
    } else if (document.selection && document.selection.type != "Control") {
        // IE 8 and below
        range = document.selection.createRange();
        range.pasteHTML(html);
    }
}


jQuery(document).ready(function( $ ){

    // $('#default_add_comment_form textarea').textareaAutoExpand();

    /**
     * Default ajax setup
     */
    $.ajaxSetup({
        type: "POST",
        url: ajaxurl,
        dataType: "html"
    });


    window.inline_comments_ajax_load_template = function( params, my_global ) {
        

        var my_global;
        var request_in_process = false;

        params.action = "inline_comments_load_template";

        $.ajax({
            data: params,
            global: my_global,
            success: function( msg ){
                $( params.target_div ).fadeIn().html( msg );
                request_in_process = false;
                if (typeof params.callback === "function") {
                    params.callback();
                }

                set_up_para_comments();
                

            }
        });
    }

    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'What do you think these lyrics mean?',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                ['link','image', 'video']
            ]
        },
    });
    
    
    /**
     * Submit new comment, note comments are loaded via ajax
     * CK - add para-id to the ajax call
     */
    $( document ).on( 'submit', '#annotate_form', function( event ){
        event.preventDefault();

        var $this = $(this);
        $this.css('opacity','0.5');
        
        var  user_selection = "Meaning";
        
        if (document.getElementById("optionone").checked == true) {
            user_selection = "Meaning";
        }
        else if (document.getElementById("optiontwo").checked == true) {
            user_selection = "Translation";

        }
        
        
        

        data = {
            action: "annotate_lyrics",
            post_id: $('.page-content').attr( 'data-post_id' ),
            user_name: $('#annotate_user_name').val(),
            user_email: $('#annotate_user_email').val(),
           // user_url: $('#inline_comments_user_url').val(),
            user_selection: user_selection,
            comment:  quill.getText(),
            security: $('#inline_comments_nonce').val(),
            para_id: $('.ref').text()
        };

        $.ajax({
            data: data,
            global: false,
            success: function( msg ){
                inline_comments_ajax_load_template({
                    "target_div": "#inline_comments_ajax_target",
                    "template": $( '#inline_comments_ajax_handle' ).attr( 'data-template' ),
                    "post_id": $( '#inline_comments_ajax_handle' ).attr( 'data-post_id' ),
                    "security": $( '#inline_comments_nonce' ).val()
                }, false );

                quill.setText('');

                $this.css('opacity','1');

                // CK - increment the comment count
                var comment_count_holder = $('.the-count');
                var comment_count = parseInt( comment_count_holder.text() );
                comment_count_holder.text( comment_count + 1 );              

            }
        });
        
        

    });

    /**
     * Allow Comment form to be submitted when the user
     * presses the "enter" key.
     */
    $( document ).on('keypress', '#annotate_form textarea, #annotate_form input', function( event ){
        if ( event.keyCode == '13' ) {
            event.preventDefault();
            $('#annotate_form').submit();
        }
    });

    $( window ).load(function(){

        if ( $( '#inline_comments_ajax_handle' ).length ) {
            $( '.inline-comments-loading-icon').show();

            data = {
                "action": "inline_comments_load_template",
                "target_div": "#inline_comments_ajax_target",
                "template": $( '#inline_comments_ajax_handle' ).attr( 'data-template' ),
                "post_id": $( '#inline_comments_ajax_handle' ).attr( 'data-post_id' ),
                "security": $('#inline_comments_nonce').val()
            };

            $.ajax({
                data: data,
                success: function( msg ){
                    $( '.inline-comments-loading-icon').fadeOut();
                    $( "#inline_comments_ajax_target" ).fadeIn().html( msg ); // Give a smooth fade in effect
                    if ( location.hash ){
                        $('html, body').animate({
                            scrollTop: $( location.hash ).offset().top
                        });
                        $( location.hash ).addClass( 'inline-comments-highlight' );
                    }

                    
                }
            });

          
        }
    });

  

    // paragraph commenting additions



    // display comments on top
    $( document ).on('click', '#hish-annotate', function( event ){
        
        event.preventDefault();
        
    
        current_para_id = $('.ref').text();

        var annotations = $( '.comment-para-id-' + current_para_id );



        $( 'div.inline-comments-container .inline-comments-content' ).hide();
        $( 'div.comment-para-id-' + current_para_id ).show();
        $( 'div.inline-comments-content-comment-fields' ).show();

       
        if (annotations.length == 0) {
            $('.the-count').append('0');

        }
        else {
        $('.the-count').append(annotations.length);

        }
        window.set_up_para_comments = function() {


            var current_para_id = $('.ref').text();
            console.log(current_para_id);



            if ( current_para_id ) {

                $( 'div.inline-comments-container .inline-comments-content' ).hide();
                $( 'div.comment-para-id-' + current_para_id ).show();
                $( 'div.inline-comments-content-comment-fields' ).show();

                return;

            }



            // generate hashcode
            var para_id = $('.ref').text();



            // get comments
            var comments = $( 'div.comment-para-id-' + para_id );

            // hide them 
            comments.hide();







            // remove the orphan-comment class (only those comments without a matching p will be left)
            comments.removeClass('orphan-comment');

            // add the number of comments to the link
            $( '.the-count' ).append('<span class="p-comment-count"><a href="#" class="toggle_comments">' + comments.length + '</a></span>');

            var orphans = $('div.orphan-comment');

            if ( orphans.length > 0 ) {

                $('<div class="orphan-comments-container"><p>These are orphan comments - the paragraph they were attached to has either been edited or deleted.</p></div>').insertAfter('div[name="comments"]');
                $('div.orphan-comments-container').append( orphans );	

            }

        }





    });

    // this function courtesu of Werx Limited
    // http://werxltd.com/wp/2010/05/13/javascript-implementation-of-javas-string-hashcode-method/
    String.prototype.hashCode = function(){

        var hash = 0;
        if (this.length == 0) return hash;

        for (i = 0; i < this.length; i++) {
            char = this.charCodeAt(i);
            hash = ((hash<<5)-hash)+char;
            hash = hash & hash; // Convert to 32bit integer
        }

        return hash;
    }

});




