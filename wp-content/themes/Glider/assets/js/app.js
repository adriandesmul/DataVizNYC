;(function ($, window, undefined) {
    'use strict';

    var $doc = $(document),
        Modernizr = window.Modernizr;

    $(document).ready(function() {
        $.fn.foundationAlerts           ? $doc.foundationAlerts() : null;
        $.fn.foundationButtons          ? $doc.foundationButtons() : null;
        $.fn.foundationAccordion        ? $doc.foundationAccordion() : null;
        $.fn.foundationNavigation       ? $doc.foundationNavigation() : null;
        $.fn.foundationTopBar           ? $doc.foundationTopBar() : null;
        $.fn.foundationMediaQueryViewer ? $doc.foundationMediaQueryViewer() : null;
        $.fn.foundationTabs             ? $doc.foundationTabs() : null;
        $.fn.foundationTooltips         ? $doc.foundationTooltips() : null;
        $.fn.foundationMagellan         ? $doc.foundationMagellan() : null;
        $.fn.placeholder                ? $('input, textarea').placeholder() : null;
    });

    // UNCOMMENT THE LINE YOU WANT BELOW IF YOU WANT IE8 SUPPORT AND ARE USING .block-grids
    // $('.block-grid.two-up>li:nth-child(2n+1)').css({clear: 'both'});
    // $('.block-grid.three-up>li:nth-child(3n+1)').css({clear: 'both'});
    // $('.block-grid.four-up>li:nth-child(4n+1)').css({clear: 'both'});
    // $('.block-grid.five-up>li:nth-child(5n+1)').css({clear: 'both'});

    // Hide address bar on mobile devices (except if #hash present, so we don't mess up deep linking).
    if (Modernizr.touch && !window.location.hash) {
        $(window).load(function () {
            setTimeout(function () {
                window.scrollTo(0, 1);
            }, 0);
        });
    }

    $.fn.imagesLoaded = function(callback){
        var elems = this.filter('img'),
            len   = elems.length,
            blank = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";

        elems.bind('load.imgloaded',function(){
            if (--len <= 0 && this.src !== blank){
                elems.unbind('load.imgloaded');
                callback.call(elems,this);
            }
        }).each(function(){
            // cached images don't fire load sometimes, so we reset src.
            if (this.complete || this.complete === undefined){
                var src = this.src;
                // webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
                // data uri bypasses webkit log warning (thx doug jones)
                this.src = blank;
                this.src = src;
            }
        });

        return this;
    };



    $.fn.getRealDimensions = function (outer) {
        var $this = $(this);
        if ($this.length == 0) {
            return false;
        }
        var $clone = $this.clone()
            .show()
            .css('visibility','hidden')
            .appendTo('body');

            var  result = $clone.innerWidth();
            $clone.remove();



        return result;


    };

    $(document).ready(function() {
        var logo_img_real_width = $('#logo').find('.normal').getRealDimensions();
        if (logo_img_real_width) {
            $('#logo').find('.retina').css('width', logo_img_real_width);
        }
    });


})(jQuery, this);


jQuery(document).ready(function() {

    /* Top Menu Toggle */
    (function ($) {
        $('#open-top-panel').bind('click', function () {
            if ($(this).hasClass('active')) {
                $('.top-panel-inner').slideUp('slow');

                $(this).removeClass('active');
            } else {
                $('.top-panel-inner').slideDown('slow');

                $(this).addClass('active');
            }

            return false;
        } );
    } )(jQuery);

    /*---------------------------------
     Widget icons
     -----------------------------------*/

    jQuery(document).ready(function() {

        var icon_name;
        var icon_element;

        jQuery(".widget-title").each(function () {

            icon_name = jQuery(this).css('content');

            jQuery(this).css('content','inherit');

            if(jQuery.browser.msie)
            {
                icon_name = jQuery(this).css('ie');
            }

            icon_element = "<i class=" + icon_name + "></i>";

            if ( !(jQuery(this).parent('div').hasClass('widget_crum_latest_3_news'))) {
                jQuery(this).prepend(icon_element);
            }
        });

    });

    /*---------------------------------
     Lang drop-down
     -----------------------------------*/

    jQuery(".lang-sel").hover(function () {

        jQuery(this).addClass("hovered");

    }, function () {

        jQuery(this).removeClass("hovered");

    });

    /*---------------------------------
     Scroll To Top
     -----------------------------------*/

    jQuery(".backtotop").addClass("hidden");
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() === 0) {
            jQuery(".backtotop").addClass("hidden")
        } else {
            jQuery(".backtotop").removeClass("hidden")
        }
    });

    jQuery('.backtotop').click(function () {
        jQuery('body,html').animate({
            scrollTop:0
        }, 1200);
        return false;
    });


    (function ($) {
        $('#header #searchform .s-submit').bind('click', function () {
            if ($('#header #searchform').hasClass('active')) {
                $('#header #searchform').submit();


            } else {
                $('#header #searchform').addClass('active');
                $('#header .s-field').fadeIn('slow').focus();

            }
        return false;

        } );

    } )(jQuery);

    /*---------------------------------
     Navigation dropdown
     -----------------------------------*/
    jQuery('#header').scrollToFixed( {
        minWidth:'768',
        preFixed: function() { jQuery(this).stop().animate({ top: '0'}, 400);},
        postFixed: function() { jQuery(this).stop().animate({ top: '-=120'}, 400);}
    });
    /*---------------------------------
     Nicescroll run
     -----------------------------------*/

    if (jQuery.fn.niceScroll) {
        jQuery('html').niceScroll({
            styler:'fb',
            cursorcolor:'#616b74',
            cursorborder:'0',
            zindex:9999
        });
    }





} );

jQuery("#loginform a.submit").click( function(){
    jQuery(this).parents("#loginform").submit();
    return false;
});


jQuery(document).ready(function() {
    jQuery("a[class^='prettyPhoto']").prettyPhoto();

    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    jQuery("a.zoom-link").prettyPhoto();
    jQuery("a.thumbnail").prettyPhoto();
});


/*
 By Osvaldas Valutis, www.osvaldas.info
 Available for use under the MIT License
 */

;(function(e,t,n,r){e.fn.doubleTapToGo=function(r){if(!("ontouchstart"in t)&&!navigator.msMaxTouchPoints&&!navigator.userAgent.toLowerCase().match(/windows phone os 7/i))return false;this.each(function(){var t=false;e(this).on("click",function(n){var r=e(this);if(r[0]!=t[0]){n.preventDefault();t=r}});e(n).on("click touchstart MSPointerDown",function(n){var r=true,i=e(n.target).parents();for(var s=0;s<i.length;s++)if(i[s]==t[0])r=false;if(r)t=false})});return this}})(jQuery,window,document);

jQuery( '.widget_crum_block_fetures_box  a.link' ).doubleTapToGo();


jQuery(document).ready(function() {
	jQuery('.entry-thumb .hover-box').hover(function(){
			jQuery('.entry-thumb .hover-box').addClass('hovered');
		});
});


jQuery('.widget_crum_block_fetures_box a.link').on('click ', function(e) {
	var el = $(this);
	if (el.hasClass('hovered')){
		var link = el.attr('href');
		window.location = link;
	} else {
		el.addClass('hovered');
		//return false;
	}
});

// Megamenu
jQuery(document).jetmenu();