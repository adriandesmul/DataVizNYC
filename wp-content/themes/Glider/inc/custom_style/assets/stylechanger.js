jQuery(document).ready(function ($) { 
	$('.load-def').click(function () {

		if ($('.boxed_layout').hasClass('active')) {
			$('.boxed_layout').removeClass('active');
			$('#change_wrap_div').removeClass('boxed_lay');
			$('.boxed_bg').css('visibility','hidden');
		}
		$('#change_wrap_div, body').css('background','#ffffff');
        $('section#footer,#sub-footer').css('background','#79848e');

        /*Main color*/
        $(".first_color .round_color").css("color","#26bdef");

        $("#font_color_1").text('#header .menu > li >ul>li>.menu-item-wrap>a:hover, #header .menu > li > ul > li >ul>li>.menu-item-wrap>a:hover, #header .menu > li>ul>li.current-menu-item>.menu-item-wrap>a, .to-action-block, .tabs.vertical dd.active, .tabs.vertical li.active, #top-footer, #feedburner_subscribe input[type="submit"], div.progress .meter, .crum_stiky_news .blocks-label, .page-nav .older:hover, .page-nav .newer:hover, .page-nav span:hover a, .project-title a:hover, #top-panel, .button:hover, .submitbutton:hover, .button-primary:hover, .btn:hover, .buttons .button.checkout, #commentform #submit, .service-icon:hover span, .tags-widget a:hover, .comment-author a.comment-reply-link:hover, .slider-nav a.active, #top-panel .top-panel-inner, #open-top-panel:hover, #open-top-panel.active, .pricing-table .title, .blue-circle {background-color:#26bdef;} ' +
            'h3 span, a, .footer-menu a:hover, a.back:hover,  #top-menu>ul>li:hover .tile-icon, .recent-block .tabs.horisontal dd a:hover, .recent-block .tabs.horisontal dd.active a, .dopinfo a.comments, .dopinfo a:hover, .entry-title a:hover, .post header > h3 a:hover, .widget_crum_galleries_widget h4.box-name a:hover, .menu-item-wrap:hover:before, .filter li a:hover, .filter li.active a, .feature-box.al-center:hover .icon, .feature-box.al-left:hover .icon, .feature-box.al-right:hover .icon, .backtotop, .share-icons a:hover, #open-top-panel:hover, #open-top-panel.active {color:#26bdef;} ' +
            'a.back:hover, .button:hover, .submitbutton:hover, .button-primary:hover, .btn:hover, .buttons .button.checkout, #commentform #submit, .service-icon:hover span, .tags-widget a:hover, .comment-author a.comment-reply-link:hover, .feature-box.al-center:hover .icon, .feature-box.al-left:hover .icon, .feature-box.al-right:hover .icon, #open-top-panel:hover, #open-top-panel.active{border-color:#26bdef;} ' +
            '#top-menu>ul>li>ul:before {border-bottom-color:#26bdef;} ' +
            'ul.accordion > li.active > div.title h6 { border-bottom: 3px solid #26bdef; } .ui-tabs .ui-tabs-nav li.ui-tabs-active, .wpb_accordion .ui-accordion .ui-accordion-header-active { border-top: 3px solid #26bdef; } .backtotop { border: 3px solid #26bdef; } .pricing-table .title:after { border-top-color: #26bdef;}');

        /*Secondary color*/
        $(".second_color .round_color").css("color","#f36f5f");

        $("#font_color_2").text('a:hover, ul.accordion > li.active > div.title .icon_wrap .icon, #open-top-panel:before { color: #f36f5f; } ul.accordion > li.active > div.title .icon_wrap { border-bottom: 3px solid #f36f5f; } .hover-box:after { border-top-color: #f36f5f; } #open-top-panel { border: 3px solid #f36f5f; } .backtotop:hover{ color: #f36f5f; border-color: #f36f5f; } .extra-links a:hover { border-color: #f36f5f; background-color:#f36f5f; } .buttons .button.checkout:hover, #commentform #submit { background-color: #f36f5f; border-color: #f36f5f; } ::-moz-selection { background-color: #f36f5f; color: #fff;} ::selection { background-color: #f36f5f; color: #fff; }"');

        return false;

	} );
	
	$('.text_drop .drop_list a').click(function () { 
		var text = $(this).text(), 
			filter_el = $(this).parent().parent().parent().find('.drop_link_in');
		
		$(this).parent().parent().find('>li.current').removeClass('current');
		$(this).parent().addClass('current');
		
		filter_el.attr( { 
			title : text
		} ).text(text);
		
	} );




	$('.changer_button').bind('click', function () { 
		if ($(this).hasClass('active')) {

            $(this).removeClass('active');

			$('.changer_content').slideUp('fast', function(){ $('.changer_content').css('overflow','visible') });

			$('.load-def').removeClass('active');
		} else {
            $(this).addClass('active');


			$('.changer_content').slideDown('slow', function(){ $('.changer_content').css('overflow','visible') });
            $('.load-def').addClass('active');

		}
		
		return false;
	} );

	/*Setting clorpicker*/
    colorpicker = $.farbtastic("#custom-style-colorpicker");
    $("#custom-style-colorpicker").append("<a class='close'>X</a>");

	jQuery("#tempate-switcher").show();
	
    $("#custom-style-wrapper").on({
        mouseenter:function(){
            $(this).stop();
            $(this).animate({left:0},'fast');
        },
        mouseleave:function(){
            $(this).stop();
            $(this).animate({left:"-290px"},'fast');
            $("#custom-style-colorpicker").hide();
            $(".pattern-select").hide();
            $(".pattern-example.image img").attr("src", customStyleImgUrl + 'title-icon.png');
        }
    });

    $(".template-option").each(function(){
        if( $(this).attr('href') == location.href ){
            $(this).find('img').attr("src", customStyleImgUrl + 'checkbox_1.png' )
        }
    });

    $("#custom-style-colorpicker a.close").on("click",function(){
        $("#custom-style-colorpicker").hide();
    });

	$('.check_wrap label').bind('click', function () {
		if ($('.boxed_layout').hasClass('active')) {
            $('.boxed_layout').removeClass('active');
            $('.wide_layout').addClass('active');
			$('#change_wrap_div').removeClass('boxed_lay');
			$('.boxed_bg').css('visibility','hidden');
		} else {
			$(this).addClass('active');
            $('.wide_layout').removeClass('active');
			$('#change_wrap_div').addClass('boxed_lay');
			$('.boxed_bg').css('visibility','visible');
		}

		return false;
	} );
	

    $(".texture_bg .ch_picker.color").on("click", function(){
        $("#custom-style-colorpicker").show();
        $this = $(this);
        colorpicker.linkTo(function(){
            $('#footer,#sub-footer').css("background-color",colorpicker.color);
        });
        try{
            colorpicker.setColor( rgb2hex( $('#footer,#sub-footer').css("background-color") ) );
        } catch (e){
            console.log($('#footer,#sub-footer').css("background-color"));
        }

        $(".texture_bg .ch_picker.color").removeClass("active");
        $(this).addClass("active");
        $('#footer,#sub-footer').css("background-image","none");

        return false;
    });

	
	$(".boxed_bg .ch_picker").on("click", function(){
		$("#custom-style-colorpicker").show();
		$this = $(this);
		colorpicker.linkTo(function(){
			$('body').css("background-color",colorpicker.color);
		});

		$(".boxed_bg .ch_picker").removeClass("active");
		$(this).addClass("active");
		$('body').css("background-image","none");

        return false;
	});

    $(".body_bg .ch_picker").on("click", function(){
        $("#custom-style-colorpicker").show();
        $this = $(this);
        colorpicker.linkTo(function(){
            $('#change_wrap_div').css("background-color",colorpicker.color);
        });

        $(".body_bg .ch_picker").removeClass("active");
        $(this).addClass("active");
        $('#change_wrap_div').css("background-image","none");

        return false;
    });
	
	$(".first_color .round_color").on("click", function(){
		$("#custom-style-colorpicker").show();
		$this = $(this);
		colorpicker.linkTo(function(){

            $(".first_color .round_color").css("color",colorpicker.color);

			$("#font_color_1").text("#header .menu > li >ul>li>.menu-item-wrap>a:hover, #header .menu > li > ul > li >ul>li>.menu-item-wrap>a:hover, #header .menu > li>ul>li.current-menu-item>.menu-item-wrap>a, .to-action-block, .tabs.vertical dd.active, .tabs.vertical li.active, #top-footer, #feedburner_subscribe input[type='submit'], div.progress .meter, .crum_stiky_news .blocks-label, .page-nav .older:hover, .page-nav .newer:hover, .page-nav span:hover a, .project-title a:hover, #top-panel, .button:hover, .submitbutton:hover, .button-primary:hover, .btn:hover, .buttons .button.checkout, #commentform #submit, .service-icon:hover span, .tags-widget a:hover, .comment-author a.comment-reply-link:hover, .slider-nav a.active, #top-panel .top-panel-inner, #open-top-panel:hover, #open-top-panel.active, .pricing-table .title, .blue-circle {background-color:" + colorpicker.color + ';} ' +
                'h3 span, a, .footer-menu a:hover, a.back:hover,  #top-menu>ul>li:hover .tile-icon, .recent-block .tabs.horisontal dd a:hover, .recent-block .tabs.horisontal dd.active a, .dopinfo a.comments, .dopinfo a:hover, .entry-title a:hover, .post header > h3 a:hover, .widget_crum_galleries_widget h4.box-name a:hover, .menu-item-wrap:hover:before, .filter li a:hover, .filter li.active a, .feature-box.al-center:hover .icon, .feature-box.al-left:hover .icon, .feature-box.al-right:hover .icon, .backtotop, .share-icons a:hover, #open-top-panel:hover, #open-top-panel.active {color:' + colorpicker.color + ';} ' +
                'a.back:hover, .button:hover, .submitbutton:hover, .button-primary:hover, .btn:hover, .buttons .button.checkout, #commentform #submit, .service-icon:hover span, .tags-widget a:hover, .comment-author a.comment-reply-link:hover, .feature-box.al-center:hover .icon, .feature-box.al-left:hover .icon, .feature-box.al-right:hover .icon, #open-top-panel:hover, #open-top-panel.active{border-color:' + colorpicker.color + ';} ' +
                '#top-menu>ul>li>ul:before {border-bottom-color:' + colorpicker.color + ';} ' +
                'ul.accordion > li.active > div.title h6 { border-bottom: 3px solid ' + colorpicker.color + '; } .ui-tabs .ui-tabs-nav li.ui-tabs-active, .wpb_accordion .ui-accordion .ui-accordion-header-active { border-top: 3px solid ' + colorpicker.color + '; } .backtotop { border: 3px solid ' + colorpicker.color + '; } .pricing-table .title:after { border-top-color: ' + colorpicker.color + ';}"');
        });

        return false;

	});

	$(".second_color .round_color").on("click", function(){
		$("#custom-style-colorpicker").show();
		$this = $(this);
		colorpicker.linkTo(function(){

            $(".second_color .round_color").css("color",colorpicker.color);

            $("#font_color_2").text('a:hover, ul.accordion > li.active > div.title .icon_wrap .icon, #open-top-panel:before { color: ' + colorpicker.color + '; } ul.accordion > li.active > div.title .icon_wrap { border-bottom: 3px solid ' + colorpicker.color + '; } .hover-box:after { border-top-color: ' + colorpicker.color + '; } #open-top-panel { border: 3px solid ' + colorpicker.color + '; } .backtotop:hover{ color: ' + colorpicker.color + '; border-color: ' + colorpicker.color + '; } .extra-links a:hover { border-color: ' + colorpicker.color + '; background-color:' + colorpicker.color + '; } .buttons .button.checkout:hover, #commentform #submit { background-color: ' + colorpicker.color + '; border-color: ' + colorpicker.color + '; } ::-moz-selection { background-color: ' + colorpicker.color + '; color: #fff;} ::selection { background-color: ' + colorpicker.color + '; color: #fff; }"');
		});

        return false;

	});
	
    /*Background image switching*/
    $(".boxed_bg .pattern-example.pic").on("click", function(){
        $(this).closest(".pattern-select").find(".pattern-example.pic").removeClass("current");
        $(this).addClass("current");
        var pic = $(this).find("img").attr("src");
        $('body').css("background-image", "url(" + pic.split("thumb/").join("") + ")").css("background-repeat","repeat");

    });

    /*Background image switching*/
    $(".body_bg .pattern-example.pic").on("click", function(){
        $(this).closest(".pattern-select").find(".pattern-example.pic").removeClass("current");
        $(this).addClass("current");
        var pic = $(this).find("img").attr("src");
        $('#change_wrap_div').css("background-image", "url(" + pic.split("thumb/").join("") + ")").css("background-repeat","repeat");

    });

    /*Background image switching*/
    $(".texture_bg .pattern-example.pic").on("click", function(){
        $(this).closest(".pattern-select").find(".pattern-example.pic").removeClass("current");
        $(this).addClass("current");
        var pic = $(this).find("img").attr("src");
        $('#footer, #sub-footer').css("background-image", "url(" + pic.split("thumb/").join("") + ")").css("background-repeat","repeat");

        return false;
    });
	
	var imagesForPreload = new Array();
	$(".pattern-select:eq(0) .pattern-example.pic img").each(function(){
		imagesForPreload.push( $(this).attr("src") );
	});

	preload( imagesForPreload );

} );

/*RGB to HEX */
var hexDigits = new Array
    ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");


function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}

function preload(arrayOfImages) {
    jQuery(arrayOfImages).each(function(){
        jQuery('<img/>')[0].src = this;
        // Alternatively you could use:
        // (new Image()).src = this;
    });
}