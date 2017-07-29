+function ($) { "use strict";

  var Hish = function (element, options) {
    this.init(element, options)
  }

  Hish.prototype.init = function (element, options) {
    this.$element = $(element)

    this.loadWidgets();
    this.loadPopover();
    this.bindEvents();
  }

  Hish.prototype.bindEvents = function() {
    var _this = this;
    
    // checks for highlighted text
    _this.$element.mouseup(function(e) {
      _this.checkTextSelection(_this);
      e.stopPropagation();
    });

    // hides the popover if user clicks on unregistered elements
    $(document).mouseup(function(e) {
      _this.hide();
    });

    $('#hish-share-facebook').click(function(e) {
      var facebook_dialog_url = "https://www.facebook.com/sharer/sharer.php?u=" + document.URL;
      var facebook_popup = window.open(facebook_dialog_url,'facebook-share','height=600,width=500');
      if (window.focus) {facebook_popup.focus()}
      _this.hide();
    });

    $('#hish-share-twitter').click(function(e) {
      var twitter_intent_url = "https://twitter.com/intent/tweet?text=" + _this.getText() + "&url=" + document.URL;
      var twitter_popup = window.open(twitter_intent_url,'twitter-share','height=600,width=500');
      if (window.focus) {twitter_popup.focus()}
      _this.hide();
    });
      
      $('#hish-annotate').click(function(){
          var highlight = window.getSelection();  
          //var spn = '<span class="highlight">' + highlight + '</span>';
          
      
          
          
          replaceSelection('<span class="highlight">' + _this.gethighlight() + '</span>', true);
          
          
          // generate hashcode
          var para_id = $( '.highlight' ).text().hashCode();

          // add the hashcode as an id
          $( '.highlight' ).addClass('para-id-' + para_id );

          // also store the para_id on the p so that we can use it later
          $( '.highlight' ).attr( 'data-para-id' , para_id );
          
          $( '.ref' ).append(para_id);

         
          
          
          
          $('.site').addClass('md-show');
     
          
          var rect = window.getSelection().getRangeAt(0).getBoundingClientRect();
          var position = rect.bottom - rect.height + document.body.scrollTop -34;
          var x = rect.left + rect.width / 2 + document.body.scrollLeft - 40;

          $('.highlight-active').append('<span class="highlight-text">' + _this.gethighlight() + '</span>');
          $('.quote-lyrics').append('<p>' + _this.gethighlight() + '</p>');

          
          var styles = {
              top : position,
              left: x, 
          };
          
          
          var final = +position;

          $('.annonate-square').css("top", position);

          
          
          $('.highlight-active').css(styles);
          _this.hide();
          window.getSelection().removeAllRanges();

          
          
      });
      
      
      $('.md-overlay').click(function(){
          $('.site').toggleClass('md-show');
          $('.highlight-text').remove();
          $('.quote-lyrics p').remove();
          $( '.ref' ).text('');
          $('.the-count').text('');


 

          $( ".highlight" ).contents().unwrap();


      });
      

    // prevent text from automatically unhighlighting upon sharing
    $('#hish-share-facebook').mousedown(function(e){
      e.preventDefault();
    })
    $('#hish-share-twitter').mousedown(function(e){
      e.preventDefault();
    })
    $('#hish-annotate').mousedown(function(e){
        e.preventDefault();
    })
  }

  Hish.prototype.getText = function() {
    var highlighted = window.getSelection().toString();
    var text = highlighted.length > 115 ? '' + window.getSelection().toString().substring(0, 112) + '...' : highlighted;
    text = '"' + text + '"';
    text = text.replace(/\n/g, " / ");
    return text;
  }
  
  Hish.prototype.gethighlight = function() {
      var highlighted = window.getSelection().toString();
      var text = highlighted.replace(/\n/g, "<br>");
      return text;
  }

  Hish.prototype.loadPopover = function() {
    if (!document.getElementById('hish-share-wrapper')) {
        $("<div id='hish-share-wrapper' class='animated swing'>" +
          "<div id='hish-share-popover-inner'>" + 
          "<div id='hish-annotate' class='hish-share'><i class='fa fa-pencil' title='Annotate'></i></div>" + 
            "<div id='hish-share-facebook' class='hish-share'><i class='fa fa-facebook' title='Share on Facebook'></i></div>" +
          "<div id='hish-share-twitter' class='hish-share'><i class='fa fa-twitter' title='Tweet'></i></div>" + 
          "</div>" +
          "<div id='hish-share-arrow-wrapper'>" +
            "<span id='hish-share-arrow'></span>" +
          "</div>" +
        "</div>"
      ).appendTo('body');
    }
  }


  Hish.prototype.loadWidgets = function() {
    var twitter_widget = "http://platform.twitter.com/widgets.js";
    if (!$("script[src='" + twitter_widget + "']").length) {
      $("<script type='text/javascript' src='" + twitter_widget + "'></script>").appendTo('body');
    }
  }

  Hish.prototype.show = function(x, y) {
    x = x - 40;
    y = y - 20 - 40;
    $("#hish-share-wrapper").css({ top: y+'px', left: x+'px' });
    $("#hish-share-wrapper").fadeIn(100);
  }

  Hish.prototype.hide = function() {
    $("#hish-share-wrapper").fadeOut(100);
  }

  Hish.prototype.checkTextSelection = function(popover) {
    var selected_text = "";
    if (typeof window.getSelection != "undefined") {
      selected_text = window.getSelection().toString();
    } else if (typeof document.selection != "undefined" && document.selection.type == "Text") {
      selected_text = document.selection.createRange().text;
    }

    if (selected_text && selected_text.length > 0) {
      // find the bounding box of the highlighted text
      var rect = window.getSelection().getRangeAt(0).getBoundingClientRect();

      /*
      document.body.scrollTop returns 0 on Firefox, making the popover open in a incorrect Y value

      e.g.: http://stackoverflow.com/questions/7435843/window-top-document-body-scrolltop-not-working-in-chrome-or-firefox
      */

      var isWebkit = 'WebkitAppearance' in document.documentElement.style;

      if(isWebkit) {
        var y = rect.bottom - rect.height + document.body.scrollTop + 6;
        var x = rect.left + rect.width / 2 + document.body.scrollLeft;
      } else {
        var y = rect.bottom - rect.height + document.documentElement.scrollTop + 6;
        var x = rect.left + rect.width / 2 + document.body.scrollLeft;
      }
      
      popover.show(x, y);
    } else {
      popover.hide();
    }
  }

  var old = $.fn.hish
  $.fn.hish = function (option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('hish')
      var options = typeof option == 'object' && option

      if (!data) $this.data('hish', (data = new Hish(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }
  $.fn.hish.Constructor = Hish

}(window.jQuery);