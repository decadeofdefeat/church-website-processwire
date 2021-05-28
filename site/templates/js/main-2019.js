$(document).ready(function(){

    $("#menuzord").menuzord({
        showSpeed: 300,
        hideSpeed: 300,
        indicatorFirstLevel: "<i class='down-arrow'></i>",
    });

	function chapel_resize() {
		var news_bar_height = $('div#top-news-bar').height();
		news_bar_height = (!isNaN(news_bar_height)) ? news_bar_height : 0;
		var live_bar_height = $('div#live-bar').height();
		live_bar_height = (!isNaN(live_bar_height)) ? live_bar_height : 0;

		if ((news_bar_height + live_bar_height) > 0) {
			if (news_bar_height > 0) {
				$('div#live-bar').css('top', news_bar_height + 'px');
			}
			if ($(window).width() <= 768) {
				$('body > div.wrapper, div#menuzord.menuzord-responsive.menuzord').css('top', news_bar_height + live_bar_height + 'px');
			} else {
				$('body > div.wrapper').css('top', news_bar_height + live_bar_height + 'px');
				$('div#menuzord.menuzord-responsive.menuzord').css('top', '30px');
			}
		}
	}

	chapel_resize();
	$(window).resize(function() {
		chapel_resize();
	});

    $(".container, .container-fluid").fitVids({ customSelector: "iframe[src^='https://livestream.com']"});

    var audioPlayer = $('audio').audioPlayer();

    $(".play-audio").on('click', function(event) {
        event.preventDefault();
        ga('send', 'event', 'button', 'click', 'Open Audio Player');

        $("#media-header").find('.audio-player-series').delay("300").fadeIn();
        $("#media-header").find('.video-holder').fadeOut();

        $(".play-audio").addClass("disabled");
        $(".play-video").removeClass("disabled");

        if ( $('iframe').length )
        {
            var iframe = document.querySelector('iframe');

            var player = new Vimeo.Player(iframe);
            player.pause();   
        }
        
    });


    $(".play-video").on('click', function(event) {
        event.preventDefault();
        ga('send', 'event', 'button', 'click', 'Open Video Player');

        $("#media-header").find('.audio-player-series').fadeOut();
        $("#media-header").find('.video-holder').delay("300").fadeIn();

        $(".play-audio").removeClass("disabled");
        $(".play-video").addClass("disabled");

        $('audio').get(0).pause();
        // make sure the class is now set to pause
        $('.audioplayer').removeClass("audioplayer-playing").addClass("audioplayer-stopped");
    });


    // do any Popups that are found
     $('.video-popup').magnificPopup({
            type:'iframe',
            preloader:true,
            tLoading: ''
    });

    $('.img-popup-link').magnificPopup({
          type: 'image'
    });

    $('.ajax-popup-link').magnificPopup({
      type: 'ajax'
    });

     $('.inline-popup-link').magnificPopup({
          type:'inline',
          midClick: true
    });

     $('.bible-iframe-popup').magnificPopup({
            type:'iframe',
            preloader:true,
            tLoading: ''
    });

    $('.carousel').carousel();


    $( window ).bind('hashchange', function () { 
        const id = window.location.hash.slice(1);
        if( id.length )
        {
            animateToId( id );
        }
    });

    $( window ).on('load', function() {
        const id = window.location.hash.slice(1);
        if( id.length )
        {
            animateToId( id );
        }
    });

    // Search buttons
    $(document).on("click", "#search_nav_btn", function (event) {
        event.preventDefault();
        const search_input = $(this).prev('.input-container').find('input[name=q]');
        if( search_input.val() == '' ) return false;
        $(this).parent().submit();
    });

    $("#search_content_query_btn, #search_query_btn").on('click',
        function(event) {
            event.preventDefault();
            const search_input = $(this).prev('.input-container').find('input[name=q]');
            if( search_input.val() == '' ) return false;
            $(this).parent().submit();
        }
    );

    $( "#open-search" ).off('click').on('click',function(event){
        $( "#search-area" ).fadeToggle();
        $( this ).toggleClass( "close-search" );
        $( this ).children( 'i' ).toggleClass( "icon-close fa-3x" );
    });

    $( ".card-scroll-btn" ).on('click',function(event){
        // slide out existing card triangles
        $( ".triangle" ).filter( ".slide-down" ).addClass( "slide-up-fade-out" ).removeClass( "slide-down" );

        // add triangle for this card
        $triangle = $( event.target ).closest( ".card" ).find( ".triangle" );
        $triangle.removeClass( "slide-up-fade-out" );
        $triangle.addClass( "slide-down" );

        const group_id = $(this).data("id");

        // display corresponding group id
        $( '.animation-element' ).addClass( "d-none" );
        $( '.animation-element' ).removeClass( "in-view" );
        $( '.care-row' ).addClass( "d-none" );
        $( "#" + group_id ).removeClass( "d-none" );
        $( "#" + group_id + " .animation-element" ).removeClass( "d-none" ).addClass("in-view");
    });


    // When the user scrolls the page, execute myFunction 
    window.onscroll = function() {myFunction()};

    // Get the header
    var header = document.getElementById("menuzord");

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }

    // Function to animate elements as the user scrolls
    var $animation_elements = $('.animation-element');
    var $window = $(window);

    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);
        
        $.each($animation_elements, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);
        
            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('in-view');
            } else {
                $element.removeClass('in-view');
            }
        });
    }

    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');
});


// Animate to page section
function animateToId( id )
{
    if ( $("#" + id).length )
    {
        // hide all page sections
        $(".offset-anchor").removeClass( "d-block");

        $("#" + id).addClass( "d-block");

        $('html,body').animate({
            scrollTop: $("#" + id).offset().top
        }, 'slow');
    }
}


function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function grabServerTime() {
    var time = new Date();
    $.ajax({url: '/live/server-time/',
        async: false, dataType: 'text',
        success: function(text) {
            time = new Date(text);
        }, error: function(http, message, exc) {
            time = new Date();
    }});

     return time;
}