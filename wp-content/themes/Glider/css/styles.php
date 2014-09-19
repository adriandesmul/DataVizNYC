<?php
//Function parses header styles

$options = get_option('maestro');

/*
 * Backgrounds
 */
if ($options["wrapper_bg_color"]){
    echo '#change_wrap_div{ background-color: '.$options["wrapper_bg_color"].'}  ';
}
if ($options["wrapper_bg_image"]){
    echo '#change_wrap_div{ background-image: url("'.$options["wrapper_bg_image"].'")} ';
}
if ($options["wrapper_custom_repeat"]){
    echo '#change_wrap_div{ background-repeat: '.$options["wrapper_custom_repeat"].'} ';
}

if ($options["body_bg_color"]){
    echo 'body{ background-color: '.$options["body_bg_color"].'} ';
}
if ($options["body_bg_image"]){
    echo 'body{ background-image: url("'.$options["body_bg_image"].'")} ';
}
if ($options["body_custom_repeat"]){
    echo 'body{ background-repeat: '.$options["body_custom_repeat"].'} ';
}
if ($options["body_bg_fixed"]){
    echo 'body{ background-attachment: fixed;} ';
}

if ($options["footer_font_color"]){
    echo '#footer, #footer .contacts-widget p, #sub-footer{ color: '.$options["footer_font_color"].'} ';
}
if ($options["footer_bg_color"]){
    echo '#footer{ background-color: '.$options["footer_bg_color"].'} ';
    echo '#sub-footer {background:none;}';
}
if ($options["footer_bg_image"]){
    echo '#footer{ background-image: url("'.$options["footer_bg_image"].'")} ';
    echo '#sub-footer {background:none;}';
}
if ($options["footer_custom_repeat"]){
    echo '#footer{ background-repeat: '.$options["footer_custom_repeat"].'} ';
}

if ($options["font_site_color"]){
	echo 'body{color: '.$options["font_site_color"].'}';
}
/*
 * Main theme color
 */

if (($options["main_site_color"]) && ($options["main_site_color"] != "#26bdef")){ ?>

    a.back:hover,
    .button:hover, .submitbutton:hover,
    .button-primary:hover,
    .btn:hover,
    .buttons .button.checkout, #commentform #submit,
    .service-icon:hover span,
    .tags-widget a:hover,
    .comment-author a.comment-reply-link:hover,
    .feature-box.al-center:hover .icon,
    .feature-box.al-left:hover .icon,
    .feature-box.al-right:hover .icon,
    #open-top-panel:hover, #open-top-panel.active
    {
    border-color: <?php echo $options["main_site_color"] ?>;
    }

    h3 span, a,
    .footer-menu a:hover,
    a.back:hover,
    #top-menu>ul>li:hover .tile-icon,
    .recent-block .tabs.horisontal dd a:hover,
    .recent-block .tabs.horisontal dd.active a,
    .dopinfo a.comments, .dopinfo a:hover,
    .entry-title a:hover,
    .post header > h3 a:hover,
    .widget_crum_galleries_widget h4.box-name a:hover,
    .menu-item-wrap:hover:before,
    .filter li a:hover, .filter li.active a,
    .feature-box.al-center:hover .icon,
    .feature-box.al-left:hover .icon,
    .feature-box.al-right:hover .icon,
    .backtotop,
    .share-icons a:hover,
    #open-top-panel:hover, #open-top-panel.active,
	#footer a,
	.menu-primary-navigation > li > a:hover > i,
	.menu-primary-navigation > li.active > a,
	.menu-primary-navigation > li:hover > a,
	.menu-primary-navigation li > .megamenu a:hover
    {
    color: <?php echo $options["main_site_color"] ?>;
    }


    #header .menu > li >ul>li>.menu-item-wrap>a:hover,
    #header .menu > li > ul > li >ul>li>.menu-item-wrap>a:hover,
    #header .menu > li>ul>li.current-menu-item>.menu-item-wrap>a,

    .to-action-block,
    .item .description,
    .tabs.vertical dd.active,
    .tabs.vertical li.active,
    #top-footer,
    #feedburner_subscribe input[type="submit"],
    div.progress .meter,
    .crum_stiky_news .blocks-label,
    .page-nav .older:hover,
    .page-nav .newer:hover,
    .page-nav span:hover a,
    .project-title a:hover,
    #top-panel,
    .button:hover, .submitbutton:hover,
    .button-primary:hover,
    .btn:hover,
    .buttons .button.checkout, #commentform #submit,
    .service-icon:hover span,
    .tags-widget a:hover,
    .comment-author a.comment-reply-link:hover,
    .slider-nav a.active,
    #top-panel .top-panel-inner,
    #open-top-panel:hover, #open-top-panel.active,
    .pricing-table .title,
    .blue-circle,
    .info-item.clickable:hover,
    .styled-widget-list > li:hover,
    .shop-category-widget li a:hover, .category-widget li a:hover, .widget_nav_menu li a:hover, .widget_nav_menu li.current-menu-item>a,
	a.link:hover,
	.menu-primary-navigation > li.showhide,
	.menu-primary-navigation ul.dropdown li:hover > a,
	.menu-primary-navigationli > .megamenu form input[type="submit"]:hover
    {
    background-color: <?php echo $options["main_site_color"] ?>;
    }

	.menu-primary-navigation li > .megamenu form input[type="text"]:focus, .menu-primary-navigation li > .megamenu form textarea:focus
	{
	border-color: <?php echo $options["main_site_color"] ?>;
	}

    ul.accordion > li.active > div.title h6
    {
    border-bottom: 3px solid <?php echo $options["main_site_color"] ?>;
    }
    .ui-tabs .ui-tabs-nav li.ui-tabs-active, .wpb_accordion .ui-accordion .ui-accordion-header-active, .tabs dd.active a, .tabs li.active a{
    border-top: 3px solid <?php echo $options["main_site_color"] ?>;
    }

    .backtotop {
    border: 3px solid <?php echo $options["main_site_color"] ?>;
    }
    .pricing-table .title:after {
    border-top-color: <?php echo $options["main_site_color"] ?>;
    }

    .entry-thumb:hover .hover-box {
    background: rgba(<?php  $string = implode(",",cr_hex2rgb($options["main_site_color"]));   echo $string;  ?>, .8);
    }

<?php }

if (($options["secondary_site_color"]) && ($options["secondary_site_color"] != "#f36f5f")){ ?>


    /*Secondary colors*/

    a:hover,
    ul.accordion > li.active > div.title .icon_wrap .icon,
    #open-top-panel:before
    {
    color: <?php echo $options["secondary_site_color"]  ?>;
    }

    ul.accordion > li.active > div.title .icon_wrap {
    border-bottom: 3px solid <?php echo $options["secondary_site_color"]  ?>;
    }
    .hover-box:after {
    border-top-color: <?php echo $options["secondary_site_color"]  ?>;
    }

    #open-top-panel {
    border: 3px solid <?php echo $options["secondary_site_color"]  ?>;
    }

    .backtotop:hover,
    #stuning-header h1, #stuning-header a.back:hover,
    #stuning-header a.back:before:hover,
    #stuning-header .breadcrumbs a:hover
    {
    color: <?php echo $options["secondary_site_color"]  ?>;
    border-color: <?php echo $options["secondary_site_color"]  ?>;
    }
    .extra-links a:hover {
    border-color: <?php echo $options["secondary_site_color"]  ?>;
    background-color:<?php echo $options["secondary_site_color"]  ?>;
    }
    .buttons .button.checkout:hover, #commentform #submit {
    background-color: <?php echo $options["secondary_site_color"]  ?>;
    border-color: <?php echo $options["secondary_site_color"]  ?>;
    }

    ::-moz-selection {
    background-color: <?php echo $options["secondary_site_color"]  ?>;
    color: #fff;
    }

    ::selection {
    background-color: <?php echo $options["secondary_site_color"]  ?>;
    color: #fff;
    }


<?php }
if ($options["body_font_color"]){ ?>

body,
.tour-block p,
.tabs.vertical dd a,
.tabs.vertical li a,
.button, .submitbutton,
#commentform #submit,
.button-primary,
.btn,
.comment-author a.comment-reply-link,
.wpb_toggle_content,
table tbody tr td,
table thead tr th,
table tfoot tr td,
.skills_widget .skill-percent,
#layout .tags-widget a,
.wpb_content_element .ui-tabs .ui-tabs-nav a,
#content .wpb_accordion .ui-accordion .ui-accordion-header a,
.wpb_accordion .ui-accordion .ui-accordion-header a,
.team-value,
label,
.soc-head-icons a:hover,
.info-box p,
.tabs.vertical dd a:active,
.post header > h3 a,
ul.accordion p,
#header .phone,
.entry-title, .box-name, .comment-author .fn, .project-title a,
#top-menu .link-text,
.quoteCite .quote-author, .entry-title, .box-name,
.about_author_widget .quote-author,
.team-photo h4 a,
.project-info, .project-info a,
.crum_stiky_news .blocks-text,
.wp-caption .wp-caption-text,
.gallery-caption,
.entry-caption,
.person-list,
.person-list strong,
.pricing-table .title,
.pricing-table .bullet-item,
.post-links ul  li a,
.tour-block p,
h4.box-name a {
    <?php echo $options["body_font_color"]; ?>
}

<?php }

/*Icons*/

if ($options["default_widget_icon"]){
    echo '.widget-title{content: "'. $options["default_widget_icon"].'"; ie: "'. $options["default_widget_icon"].'"}';
}
if ($options["search-widget_icon"]){
    echo '.search-widget .widget-title{content: "'. $options["search-widget_icon"].'"; ie:"'. $options["search-widget_icon"].'";}';
}
if ($options["recent_posts_icon"]){
    echo '.widget_crum_recent_posts .widget-title{content: "'. $options["recent_posts_icon"].'"; ie:"'. $options["recent_posts_icon"].'";}';
}
if ($options["rss_mail_subscribe_icon"]){
    echo '.widget_rss_mail_subscribe .widget-title{content: "'. $options["rss_mail_subscribe_icon"].'";ie: "'. $options["rss_mail_subscribe_icon"].'"}';
}

if ($options["recent_block_icon"]){
    echo '.widget_recent_block .widget-title, .widget_crum_recent_desc .widget-title, .recent-block .widget-title{content: "'. $options["recent_block_icon"].'"; ie:"'. $options["recent_block_icon"].'" }';
}
if ($options["crum_news_cat_icon"]){
    echo '.widget_crum_news_cat .widget-title, .widget_crum_news_row .widget-title, .widget_crum_news_desc .widget-title{content: "'. $options["crum_news_cat_icon"].'"; ie: "'. $options["crum_news_cat_icon"].'"}';
}
if ($options["list_widget_icon"]){
    echo '.widget_list_widget .widget-title{content: "'. $options["list_widget_icon"].'"; ie: "'. $options["list_widget_icon"].'"}';
}
if ($options["crum_testimonial_icon"]){
    echo '.widget_crum_testimonial_widget .widget-title{content: "'. $options["crum_testimonial_icon"].'"; ie: "'. $options["crum_testimonial_icon"].'"}';
}
if ($options["crum_partners_widget_icon"]){
    echo '.widget_crum_partners_widget .widget-title{content: "'. $options["crum_partners_widget_icon"].'"; ie: "'. $options["crum_partners_widget_icon"].'"}';
}
if ($options["instagram-widget_icon'"]){
    echo '.widget_instagram-widget .widget-title{content: "'. $options["instagram-widget_icon'"].'"; ie: "'. $options["instagram-widget_icon'"].'"}';
}
if ($options["widget_crum-text-widget_icon"]){
    echo '.widget_crum-text-widget .widget-title{content: "'. $options["widget_crum-text-widget_icon"].'"; ie:"'. $options["widget_crum-text-widget_icon"].'"}';
}
if ($options["contacts-widget_icon"]){
    echo '.widget_roots_vcard_widget .widget-title{content: "'. $options["contacts-widget_icon"].'"; ie:"'. $options["contacts-widget_icon"].'"}';
}
if ($options["tags-widget_icon"]){
    echo '.widget_crum_tags_widget .widget-title{content: "'. $options["tags-widget_icon"].'"; ie:"'. $options["tags-widget_icon"].'"}';
}
if ($options["tabs-widget_icon"]){
    echo '.widget_crum_crum_widget_tabs .widget-title{content: "'. $options["tabs-widget_icon"].'"; ie: "'. $options["tabs-widget_icon"].'"}';
}
if ($options["widget_gallery_widget_icon"]){
    echo '.widget_gallery_widget .widget-title{content: "'. $options["widget_gallery_widget_icon"].'"; ie: "'. $options["widget_gallery_widget_icon"].'"}';
}
if ($options["widget_twitter-widget_icon"]){
    echo '.widget_twitter-widget .widget-title{content: "'. $options["widget_twitter-widget_icon"].'"; ie:"'. $options["widget_twitter-widget_icon"].'"}';
}
if ($options["crum_tabwidget_icon"]){
    echo '.widget_crum_tabwidget .widget-title{content: "'. $options["crum_tabwidget_icon"].'"; ie: "'. $options["crum_tabwidget_icon"].'"}';
}
if ($options["category-widget_icon"]){
    echo '.widget_crum_icon_categories .widget-title{content: "'. $options["category-widget_icon"].'"; ie:"'. $options["category-widget_icon"].'"}';
}
if ($options["widget_facebook_widget_icon"]){
    echo '.widget_facebook_widget .widget-title{content: "'. $options["widget_facebook_widget_icon"].'"; ie:"'. $options["widget_facebook_widget_icon"].'"}';
}
if ($options["widget_crum_widgets_video_icon"]){
    echo '.widget_crum_widgets_video .widget-title{content: "'. $options["widget_crum_widgets_video_icon"].'"; ie:"'. $options["widget_crum_widgets_video_icon"].'";}';
}
if ($options["crum_widget_v_accordion_icon"]){
    echo '.widget_crum_widget_v_accordion .widget-title{content: "'. $options["crum_widget_v_accordion_icon"].'"; ie:"'. $options["crum_widget_v_accordion_icon"].'";}';
}
if ($options["crum_galleries_widget_icon"]){
    echo '.widget_crum_galleries_widget .widget-title{content: "'. $options["crum_galleries_widget_icon"].'"; ie:"'. $options["crum_galleries_widget_icon"].'";}';
}
if ($options["about_author_widget_icon"]){
    echo '.widget_about_author_widget .widget-title{content: "'. $options["about_author_widget_icon"].'"; ie:"'. $options["about_author_widget_icon"].'";}';
}
if ($options["skills_widget_icon"]){
    echo '.widget_skills_widget .widget-title{content: "'. $options["skills_widget_icon"].'"; ie:"'. $options["skills_widget_icon"].'";}';
}
if ($options["crum_shortcode_widget_icon"]){
    echo '.widget_crum_shortcode_widget .widget-title{content: "'. $options["crum_shortcode_widget_icon"].'";ie:"'. $options["crum_shortcode_widget_icon"].'"}';
}
if ($options["crum_widget_features_icon"]){
    echo '.widget_crum_widget_features .widget-title{content: "'. $options["crum_widget_features_icon"].'"; ie:"'. $options["crum_widget_features_icon"].'";}';
}
if ($options["widget_wp_sidebarlogin_icon"]){
    echo '.widget_wp_sidebarlogin .widget-title{content: "'. $options["widget_wp_sidebarlogin_icon"].'"; ie:"'. $options["widget_wp_sidebarlogin_icon"].'";}';
}
if ($options["widget_shopping_cart_icon"]){
    echo '.widget_shopping_cart .widget-title{content: "'. $options["widget_shopping_cart_icon"].'"; ie:"'. $options["widget_shopping_cart_icon"].'";}';
}
if ($options["crum_widget_accordion_icon"]){
    echo '.widget_crum_widget_accordion .widget-title{content: "'. $options["crum_widget_accordion_icon"].'"; ie:"'. $options["crum_widget_accordion_icon"].'";}';
}
if ($options["cont-map_icon"]){
    echo '.widget_crum_map_widget .widget-title{content: "'. $options["cont-map_icon"].'"; ie:"'. $options["cont-map_icon"].'";}';
}



echo $options["custom_css"];


function cr_hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}




?>









