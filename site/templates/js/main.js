var currMqIdx = undefined;
var currentVisibleQuery = undefined;
var mqDetector = undefined;
var mqSelectors = undefined;

$("document").ready(function() {
    //Setup everything
    init_js();
    //reset search field
    $('.search input#search_term').val('Search');
    $('#search_term').removeClass('clearClick').addClass('clickClear');

});

 /*============================================
 * init function
 *=============================================
 */
function init_js(){


    mqDetector = $("#mq-detector");
    mqSelectors = [
        mqDetector.find(".visible-xs"),
        mqDetector.find(".visible-sm"),
        mqDetector.find(".visible-md"),
        mqDetector.find(".visible-lg")
    ];

    $(window).on('resize', checkForResize);
    checkForResize();

    if (!Modernizr.svg) {
        //alert("NOT SUPPORTED svg");
    }
    else
    {
     $('img.svg').each(function(){
        var $img = $(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            $.get(imgURL, function(data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');

                // Add replaced image's ID to the new SVG
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                // Replace image with new SVG
                $img.replaceWith($svg);

            }, 'xml');

        });
    }


    navigationFunctions();

    $("body").fitVids();



     // placeholder fix for older browsers that don't support it

    if(!Modernizr.input.placeholder){
         $('[placeholder]').focus(function() {
          var input = $(this);
          if (input.val() == input.attr('placeholder')) {
            input.val('');
            input.removeClass('placeholder');
          }
        }).blur(function() {
          var input = $(this);
          if (input.val() == '' || input.val() == input.attr('placeholder')) {
            input.addClass('placeholder');
            input.val(input.attr('placeholder'));
          }
        }).blur().parents('form').submit(function() {
          $(this).find('[placeholder]').each(function() {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
              input.val('');
            }
          })
        });
    }


}


function checkForResize(){
            for (var i = 0; i <= mqSelectors.length; i++) {
                if (mqSelectors.length && mqSelectors[i].is(":visible")) {
                    if (currMqIdx != i) {
                        currMqIdx = i;
                        currentVisibleQuery = mqSelectors[currMqIdx].attr("class");
                        //console.log(currentVisibleQuery);
                    }
                    break;
                }
            }
        };


function toggleMenu()
{
    $('.nav-content-holder').slideToggle(350, 'swing');

    $('#menu-btn-icon').toggleClass("icon-menu-3");
    $('#menu-btn-icon').toggleClass("icon-x-1");

    $('.nav-content-holder').toggleClass("open");


}

function toggleSearch()
{
     $('#search-area').show();

        var curTop = $('#top-area').css('margin-top');
        if(curTop!='0px')
        {
            $('#top-area').animate({"margin-top": "0px"}, 450);
        }
        else
        {
            $('#top-area').animate({"margin-top": "90px"}, 450);
        }

        $('#search-area').toggleClass(".open");
}



function navigationFunctions(){


    // for small screen, the account menu is a select box
    if($("#account-menu-select").length){
        $("#account-menu-select").change(function() {
              window.location = $(this).find("option:selected").val();
        });
    }


    $('html').on('click', function(event) {
        var otarget = $(event.target);
        if ( !otarget.parents('#search-area').length && !otarget.parents('#top-quick-menu').length &&  !otarget.parents('#floating-bar-nav').length &&   otarget.attr('id')!="nav-main-menu" ) {
            if($('#menu-btn-icon').hasClass("icon-x-1"))
            {
                event.preventDefault();
                toggleMenu();
             }
        }

    });





   $('#menu-btn').fastClick( toggleMenu );


   $("#search_query_btn").on('click', function(event) {
        //alert("called this button ");
        event.preventDefault();
         if( $('#search-site-input').val() == '' ) return false;

        if(event.type == "touchstart") {
             $( "#search-form-top" ).submit();
        } else if(event.type == "click") {
             $( "#search-form-top" ).submit();
        }

    });

   $("#search_content_query_btn").on('click', function(event) {
        //alert("called this button ");
        event.preventDefault();
        if(event.type == "touchstart") {
            $( "#search-content" ).submit();
        } else if(event.type == "click") {
            $( "#search-content" ).submit();
        }
    });




    $('#search-btn').fastClick( toggleSearch );


    /*Mobile */

   $('#nav-pullout > li.dropdown > a').fastClick( function(event) {

        //event.preventDefault();
        //event.stopPropagation();

        if (currentVisibleQuery == 'visible-sm' || currentVisibleQuery == 'visible-xs' ) {
             var current = $(this).next('ul');

               $('#nav-pullout > li.dropdown > ul').not(current).filter(":visible").slideToggle(350, 'swing');
                $(this).next('ul').slideToggle(350, 'swing');
                $(this).parent('li').toggleClass('open');
        }

    });



}






function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

