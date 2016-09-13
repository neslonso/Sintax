/*
	JavaScript For Responsive Bootstrap Modal Popup

	Author: szthemes
	Item Name: Responsive Bootstrap Modal Popup
	Author URI: http://codecanyon.net/user/szthemes
	Description: Different Types Of Bootstrap Modal

*/

;(function ($) {

    /*-----------------------------------------------------------------*/
    /* CAROUSEL SLIDING DURATION
    /*-----------------------------------------------------------------*/
    var slideDurationValue = $(".carousel").attr("data-duration");

    if (isNaN(slideDurationValue) || slideDurationValue <= 0){
        $.fn.carousel.Constructor.TRANSITION_DURATION = 1000;
		$(".carousel-inner > .item").css({
		'-webkit-transition-duration': slideDurationValue + '1000ms',
		'-moz-transition-duration': slideDurationValue + '1000ms',
		'transition-duration': slideDurationValue + '1000ms'
		});
    }else{
        $.fn.carousel.Constructor.TRANSITION_DURATION = slideDurationValue;
		$(".carousel-inner > .item").css({
		'-webkit-transition-duration': slideDurationValue + 'ms',
		'-moz-transition-duration': slideDurationValue + 'ms',
		'transition-duration': slideDurationValue + 'ms'
		});
    }

    /*-----------------------------------------------------------------*/
    /* MOBILE SWIPE
    /*-----------------------------------------------------------------*/
    //Enable swiping...
    var verticalSwipe = $(".carousel").find('[class=swipe_y]');
    var horizontalSwipe = $(".carousel").find('[class=swipe_x]');

    if(verticalSwipe){
      $(".swipe_y .carousel-inner").swipe({
        //Generic swipe handler for vertical directions
        swipeUp: function (event, direction, distance, duration, fingerCount) {
          $(this).parent().carousel('next');
        },
        swipeDown: function () {
          $(this).parent().carousel('prev');
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold: 0
      });
    }if(horizontalSwipe){
      $(".swipe_x .carousel-inner").swipe({
        //Generic swipe handler for horizontal directions
        swipeLeft: function (event, direction, distance, duration, fingerCount) {
          $(this).parent().carousel('next');
        },
        swipeRight: function () {
          $(this).parent().carousel('prev');
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold: 0
      });
    }

    /*-----------------------------------------------------------------*/
    /* Thumbnails Indicators Scroll
    /*-----------------------------------------------------------------*/
    "use strict";
    var indicatorPositionY = 0;
    var indicatorPositionX = 0;
    var thumbnailScrollY = $(".carousel").find('[class=thumb_scroll_y]');
    var thumbnailScrollX = $(".carousel").find('[class=thumb_scroll_x]');

    if(thumbnailScrollY){
      $('.thumb_scroll_y').on('slid.bs.carousel', function(){
        var heightEstimate = -1 * $(".thumb_scroll_y .carousel-indicators li:first").position().top + $(".thumb_scroll_y .carousel-indicators li:last").position().top + $(".thumb_scroll_y .carousel-indicators li:last").height();
        var newIndicatorPositionY = $(".thumb_scroll_y .carousel-indicators li.active").position().top + $(".thumb_scroll_y .carousel-indicators li.active").height() / 1;
        var toScrollY = newIndicatorPositionY + indicatorPositionY;
        var adjustedScrollY = toScrollY - ($(".thumb_scroll_y .carousel-indicators").height() / 1);
        if (adjustedScrollY < 0)
          adjustedScrollY = 0;
        if (adjustedScrollY > heightEstimate - $(".thumb_scroll_y .carousel-indicators").height())
          adjustedScrollY = heightEstimate - $(".thumb_scroll_y .carousel-indicators").height();
        $('.thumb_scroll_y .carousel-indicators').animate({ scrollTop: adjustedScrollY }, 800);
          indicatorPositionY = adjustedScrollY;
      });
    } if(thumbnailScrollX){
      $('.thumb_scroll_x').on('slid.bs.carousel', function(){
        var widthEstimate = -1 * $(".thumb_scroll_x .carousel-indicators li:first").position().left + $(".thumb_scroll_x .carousel-indicators li:last").position().left + $(".thumb_scroll_x .carousel-indicators li:last").width();
        var newIndicatorPositionX = $(".thumb_scroll_x .carousel-indicators li.active").position().left + $(".thumb_scroll_x .carousel-indicators li.active").width() / 1;
        var toScrollX = newIndicatorPositionX + indicatorPositionX;
        var adjustedScrollX = toScrollX - ($(".thumb_scroll_x .carousel-indicators").width() / 1);
        if (adjustedScrollX < 0)
          adjustedScrollX = 0;
        if (adjustedScrollX > widthEstimate - $(".thumb_scroll_x .carousel-indicators").width())
          adjustedScrollX = widthEstimate - $(".thumb_scroll_x .carousel-indicators").width();
        $('.thumb_scroll_x .carousel-indicators').animate({ scrollLeft: adjustedScrollX }, 800);
          indicatorPositionX = adjustedScrollX;
      });
    }

    /*-----------------------------------------------------------------*/
    /* SIX SHOWS ONE MOVE
    /*-----------------------------------------------------------------*/
    $('.six_columns .item').each(function(){
        var itemToClone = $(this);
        for (var i=1;i<6;i++) {
            itemToClone = itemToClone.next();
            // wrap around if at end of item collection
            if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
            }
            // grab item, clone, add marker class, add to collection
            itemToClone.children(':first-child').clone()
            .addClass("cloneditem-"+(i))
            .appendTo($(this));
        }
    });

    /*-----------------------------------------------------------------*/
    /* FIVE SHOWS ONE MOVE
    /*-----------------------------------------------------------------*/
    $('.five_columns .item').each(function(){
        var itemToClone = $(this);
        for (var i=1;i<5;i++) {
            itemToClone = itemToClone.next();
            // wrap around if at end of item collection
            if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
            }
            // grab item, clone, add marker class, add to collection
            itemToClone.children(':first-child').clone()
            .addClass("cloneditem-"+(i))
            .appendTo($(this));
        }
    });

    /*-----------------------------------------------------------------*/
    /* FOUR SHOWS ONE MOVE
    /*-----------------------------------------------------------------*/
    $('.four_columns .item').each(function(){
        var itemToClone = $(this);
        for (var i=1;i<4;i++) {
            itemToClone = itemToClone.next();
            // wrap around if at end of item collection
            if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
            }
            // grab item, clone, add marker class, add to collection
            itemToClone.children(':first-child').clone()
            .addClass("cloneditem-"+(i))
            .appendTo($(this));
        }
    });

    /*-----------------------------------------------------------------*/
    /* THREE SHOWS ONE MOVE
    /*-----------------------------------------------------------------*/
    $('.three_columns .item').each(function(){
        var itemToClone = $(this);
        for (var i=1;i<3;i++) {
            itemToClone = itemToClone.next();
            // wrap around if at end of item collection
            if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
            }
            // grab item, clone, add marker class, add to collection
            itemToClone.children(':first-child').clone()
            .addClass("cloneditem-"+(i))
            .appendTo($(this));
        }
    });

    /*-----------------------------------------------------------------*/
    /* TWO SHOWS ONE MOVE
    /*-----------------------------------------------------------------*/
    $('.two_columns .item').each(function(){
        var itemToClone = $(this);
        for (var i=1;i<2;i++) {
            itemToClone = itemToClone.next();
            // wrap around if at end of item collection
            if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
            }
            // grab item, clone, add marker class, add to collection
            itemToClone.children(':first-child').clone()
            .addClass("cloneditem-"+(i))
            .appendTo($(this));
        }
    });
	
    /*-----------------------------------------------------------------*/
    /* VIDEO PAUSING ON SLIDE
    /*-----------------------------------------------------------------*/
    //It will work on .pauseVideo class only
    $(".pauseVideo").on('slide.bs.carousel', function () {
      $("video").each(function(){
        this.pause();
      });
    });

    /*-----------------------------------------------------------------*/
    /* VIDEO PAUSING ON MODAL CLOSE
    /*-----------------------------------------------------------------*/
    //It will work on .pauseVideoM class only
    $(".pauseVideoM").on('hide.bs.modal', function () {
      $("video").each(function(){
        this.pause();
      });
    });

    /*-----------------------------------------------------------------*/
    /* YOUTUBE, VIMEO VIDEO PAUSING ON SLIDE
    /*-----------------------------------------------------------------*/
    //It will work on .onlinePauseVideo class only
    $(".onlinePauseVideo").on('slide.bs.carousel', function (e) {
      var $rbmiFrames = $(e.target).find("iframe");
      $rbmiFrames.each(function(index, iframe){
        $(iframe).attr("src", $(iframe).attr("src"));
      });
    });
	
    /*-----------------------------------------------------------------*/
    /* YOUTUBE, VIMEO VIDEO PAUSING ON MODAL CLOSE
    /*-----------------------------------------------------------------*/
    //It will work on .onlinePauseVideoM class only
    $(".onlinePauseVideoM").on('hide.bs.modal', function (e) {
      var $rbmiFrames = $(e.target).find("iframe");
      $rbmiFrames.each(function(index, iframe){
        $(iframe).attr("src", $(iframe).attr("src"));
      });
    });

})(jQuery);