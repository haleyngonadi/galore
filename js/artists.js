/*** Facebook Widget JS ****/



/*** Instagram Widget JS ****/
 
if (typeof Object.create !== "function") {
    Object.create = function(obj) {
        function F() {}
        F.prototype = obj;
        return new F();
    };
}

var InstaFeedJS = function(username) {
    this.username = username;
    this.jsonp_proxy = "http://whateverorigin.org/get";
};

InstaFeedJS.prototype.getRecentMedia = function(maxMedia, callback) {
    $.getJSON(this.jsonp_proxy + '?url=' + encodeURIComponent("https://www.instagram.com/" + this.username + "/") + '&callback=?', function(data) {
        var myRe = /window\._sharedData = (\{.*\})/;
        var lines = data.contents.split("\n");
        var instagram = undefined;
        for (var l in lines) {
            var r = myRe.exec(lines[l]);
            if (r) {
                instagram = JSON.parse(r[1]);
                break;
            }
        }
        result = new Array();
        if (instagram) {
            user = instagram["entry_data"]["ProfilePage"][0]["user"];
            media = user["media"]["nodes"];
            for (m in media) {
                if (m >= maxMedia)
                    break;
                image = media[m];
                r = {
                    imageCaption: image["caption"],
                    imageUrl: image["thumbnail_src"],
                    imageTarget: "https://www.instagram.com/p/" + image["code"],
                    isVideo: image["is_video"]
                };
                result.push(r);
            }
        }
        callback(result);
    });
};


$( document ).ready(function() {
    
   
        $( "#btn-top" ).click(function() {
            console.log('Simple');
         jQuery('html, body').animate({
            scrollTop: 0
        },1500)
});

    
    
    
  //  $.lazyLoadXT.onload.addClass = 'animated flipInX';
$('.tabs').tabslet();

    
    
    var $item = $('.artist_page');
    var instagram = $item.data('instagram');
    
     insta = new InstaFeedJS(instagram);
        insta.getRecentMedia(9, function(media) {
            for (m in media) {
                image = media[m];
                $img = $("<img>", {
                    alt: image["imageCaption"],
                    attr: {
                        height: 150,
                        width: 150
                    },
                    'data-src': image["imageUrl"],
                    src: image["imageUrl"],
                });

                $a = $("<a>", {
                    href: image["imageTarget"],
                    target: "_blank",
                    title: image["imageCaption"]
                }).append($img);
                $div = $("<div class='instagram__item'>").append($a);
                $("#instagram-feed").append($div);
            }
        });
    
    
});



   function onGoogleLoad() {
            gapi.client.setApiKey('AIzaSyCvhvWYtnZzCe-3IQLpJM_CBSb3nl_x1iI');
            gapi.client.load('youtube', 'v3', function() {
                
              
    var $item = $('.artist_page');
    var type = $item.data('channel');
                    var playlistID = $item.data('youtube');

                
                if (type == 'yes') {
                    
                    
            var request = gapi.client.youtube.search.list({
          part: "snippet",
          channelId: playlistID,
          type: "video",
          maxResults: 50,
          order: "date"
        });
                
                

    request.execute(function(response) {
        

        
      if ('error' in response) {
        console.log(response.error.message);
      } else {
          
          
        if ('items' in response) {
          // jQuery.map() iterates through all the items in the response and creates a new array
          // that contains only the specific property we're looking for: videoId.
          var videoIds = $.map(response.items, function(item) {
            return item.id.videoId;
          });

          // Now that we know the ids of all the videos in the uploads list, we can retrieve info
          // about each video.
          getMetadataForVideos(videoIds);
        } else {
          console.log('There are no videos in your channel.');
        }
      }
    });
                    
                }
                
                else {
                
      var request = gapi.client.youtube.playlistItems.list({
      playlistId: playlistID,
      part: 'snippet',
        maxResults: 50
    }); 
                
       
      

    request.execute(function(response) {
        

      if ('error' in response) {
        console.log(response.error.message);
      } else {
          
          
        if ('items' in response) {
          // jQuery.map() iterates through all the items in the response and creates a new array
          // that contains only the specific property we're looking for: videoId.
          var videoIds = $.map(response.items, function(item) {
            return item.snippet.resourceId.videoId;
          });

          // Now that we know the ids of all the videos in the uploads list, we can retrieve info
          // about each video.
          getMetadataForVideos(videoIds);
        } else {
          console.log('There are no videos in your channel.');
        }
      }
    });

                }
                
            });
        }
        
    function getMetadataForVideos(videoIds) {
    var request = gapi.client.youtube.videos.list({
      id: videoIds.join(','),
      part: 'id,snippet,statistics,contentDetails',
        
    });

    request.execute(function(response) {
      if ('error' in response) {
        console.log(response.error.message);
      } else {
        var videoList = $('#playlist_titles');
          
                   
        
          
          
        $.each(response.items, function() {
     

          var title = this.snippet.title;
          var videoId = this.id;
            var imgsrc = this.snippet.thumbnails.high.url;
            var viewCount = numberWithCommas(this.statistics.viewCount);
            var likeCount = numberWithCommas(this.statistics.likeCount);

            var duration = parseDuration(this.contentDetails.duration);
                var uploader = this.snippet.channelTitle;


            
     videoList.append('<div class="col-md-6 col-sm-6 col-xs-12 element element-in">' + '<div class="flex-card">' +
                      '<div class="screenshot">' + '<div class="media-length">' + duration + '</div>' + '<img src="' +imgsrc+ '">' + '<a href="https://www.youtube.com/watch?v='+videoId + '"'+ 'target="_self" class="litebox" data-litebox-group="recent-videos">' + '<i class="play-icon"></i>' + '</a>'+ '</div>' +
                      '<div class="card-content">'  +'<div class="text">'+  title + '</div>'  + '<div id="upload">'+'by ' + '<span>' + uploader+ '</span>' + '</div>'+ '<div class="d-flex-card-button">' + 
                      '<div class="fleft stats">' + '<i class="fa fa-heart" aria-hidden="true"></i> '+likeCount +'</div>'+ '<div class="fright stats">' +'<i class="fa fa-eye" aria-hidden="true"></i> ' + viewCount +'</div>' + '</div>' + '</div>' + '</div>');


                $(".element").slice(0, 6).css('display', 'flex');
              			$('.litebox').liteBox();

                         var n = $( ".element" ).length;
                      console.log(n);
            
                     if ($(".element").length > 6) {
                
                  $("#loadMore").animate({
    opacity: 1,
  }, 100, function() {
  });
      
            }

              			$('.loader').hide();

            
        });

        if (videoList.children().length == 0) {
          console.log('There are no videos in your channel that have been viewed.');
        }
          
     
          
          
      }
    });
  }
        
        
        function parseDuration(duration) {
  let m_duration = moment.utc(moment.duration(duration).asMilliseconds());
  return (m_duration.hours() > 0) ? m_duration.format('HH:mm:ss') : m_duration.format('mm:ss');
}
        
        
function numberWithCommas(count) {
    return count.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

     $(function () {

                      
    $("#loadMore").on('click', function (e) {
        console.log('Clicked');
        e.preventDefault();
        $(".element:hidden").slice(0, 4).slideDown();
        if ($(".element:hidden").length == 0) {
            $("#loadMore").animate({
                opacity: 0,
    }, 100, function() {
    });
        
        }
        
   
        
        
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
       

            
});
