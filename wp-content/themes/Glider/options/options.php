<?php
/*
 *
 * Set the text domain for the theme or plugin.
 *
 */
define('Redux_TEXT_DOMAIN', 'crum');

/*
 *
 * Require the framework class before doing anything else, so we can use the defined URLs and directories.
 * If you are running on Windows you may have URL problems which can be fixed by defining the framework url first.
 *
 */
//define('Redux_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('Redux_Options')) {
    require_once(dirname(__FILE__) . '/options/defaults.php');
}

/*
 *
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 *
 */
/*
function add_another_section($sections) {
    //$sections = array();
    $sections[] = array(
        'title' => __('A Section added by hook', 'crum'),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'crum'),
		'icon' => 'paper-clip',
		'icon_class' => 'awesome-large',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}
//add_filter('redux-opts-sections-twenty_eleven', 'add_another_section');
*/



/*
 * 
 * Custom function for filtering the args array given by a theme, good for child themes to override or add to the args array.
 *
 */
/*
function change_framework_args($args) {
    $args['dev_mode'] = true;
    
    return $args;
}
//add_filter('redux-opts-args-twenty_eleven', 'change_framework_args');*/


/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be over ridden if needed.
 *
 */
function setup_framework_options() {
    $args = array();

    // Setting dev mode to true allows you to view the class settings/info in the panel.
    // Default: true
    $args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	$args['icon_type'] = 'iconfont';
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['dev_mode_icon_class'] = 'icon-large';

    // If you want to use Google Webfonts, you MUST define the api key.
    //$args['google_api_key'] = 'xxxx';

    // Define the starting tab for the option panel.
    // Default: '0';
    //$args['last_tab'] = '0';

    // Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
    // If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
    // If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
    // Default: 'standard'
    //$args['admin_stylesheet'] = 'standard';

    // Add HTML before the form.
    /*
    $args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'crum');

    // Add content after the form.
    $args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'crum');

    // Set footer/credit line.
    //$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', 'crum');

    // Setup custom links in the footer for share icons
    $args['share_icons']['twitter'] = array(
        'link' => 'http://twitter.com/ghost1227',
        'title' => __('Follow me on Twitter', 'crum'),
        'img' => Redux_OPTIONS_URL . 'img/social/Twitter.png'
    );
    $args['share_icons']['linked_in'] = array(
        'link' => 'http://www.linkedin.com/profile/view?id=52559281',
        'title' => __('Find me on LinkedIn', 'crum'),
        'img' => Redux_OPTIONS_URL . 'img/social/LinkedIn.png'
    );
*/
    // Enable the import/export feature.
    // Default: true
    $args['show_import_export'] = true;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	$args['import_icon_type'] = 'iconfont';
	// Default: refresh
	$args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['import_icon_class'] = 'icon-large';

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = 'maestro';

    // Set a custom menu icon.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Options', 'crum');

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Options', 'crum');

    // Set a custom page slug for options page (wp-admin/themes.php?page=***).
    // Default: redux_options
    $args['page_slug'] = 'redux_options';

    // Set a custom page capability.
    // Default: manage_options
    //$args['page_cap'] = 'manage_options';

    // Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
    // Default: menu
    //$args['page_type'] = 'submenu';

    // Set the parent menu.
    // Default: themes.php
    // A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    //$args['page_parent'] = 'options-general.php';

    // Set a custom page location. This allows you to place your menu where you want in the menu order.
    // Must be unique or it will override other items!
    // Default: null
    //$args['page_position'] = null;

    // Set a custom page icon class (used to override the page icon next to heading)
    //$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Font Awesome, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$args['icon_type'] = 'image';
	//$args['dev_mode_icon_type'] = 'image';
	//$args['import_icon_type'] == 'image';

    // Disable the panel sections showing as submenu items.
    // Default: true
    //$args['allow_sub_menu'] = false;

    $assets_folder = get_template_directory_uri() .'/assets/';
        
    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
   /* $args['help_tabs'][] = array(
        'id' => 'redux-opts-1',
        'title' => __('Theme Information 1', 'crum'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'crum')
    );
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-2',
        'title' => __('Theme Information 2', 'crum'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'crum')
    );

    // Set the help sidebar for the options page.                                        
    $args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'crum');
*/
    $sections = array();

    $sections[] = array(
		// Redux uses the Font Awesome iconfont to supply its default icons.
		// If $args['icon_type'] = 'iconfont', this should be the icon name minus 'icon-'.
		// If $args['icon_type'] = 'image', this should be the path to the icon.
		// Icons can also be overridden on a section-by-section basis by defining 'icon_type' => 'image'
		'icon_type' => 'iconfont',
		'icon' => 'cog',
		// Set the class for this icon.
		// This field is ignored unless $args['icon_type'] = 'iconfont'
		'icon_class' => 'icon-large',
        'title' => __('Getting Started', 'crum'),
		'desc' => __('<p class="description">This is the description field for this section. HTML is allowed</p>', 'crum'),
		'fields' => array(
			array(
				'id' => 'font_awesome_info',
				'type' => 'raw_html',
				'html' => '<h3 style="text-align: center; border-bottom: none;">Welcome to the Options panel of the Glider theme!</h3><h4 style="text-align: center; font-size: 1.3em;">What does this mean to you?</h4>
				<p> From here on you will be able to regulate the main options of all the elements of the theme. </p>
				<p>Theme documentation you will find in the archive with the theme, which you have downloaded from <a href="http://themeforest.net">Themeforest.net</a> after purchase. </p>
				<p>The support rules as well as FAQs you can read on <a href="http://themeforest.net">Themeforest.net</a> in the "Support" tab. </p>
				<p>If you have some questions, you can reach us in the comments section on <a href="http://themeforest.net">Themeforest.net</a>, you can send us email to <a href="mailto:info@crumina.net">info@crumina.net</a>, or you can post your questions on our <a href="http://support.crumina.net">Support Forum</a>.</p>'
			)
		)
    );
    $sections[] = array(
        'title' => __('Main Options', 'crum'),
        'desc' => __('<p class="description">Main options of site</p>', 'crum'),
        //all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
        //You dont have to though, leave it blank for default.
        'icon' => 'globe',
        //Lets leave this as a blank section, no options just some intro text set above.
        'fields' => array(

            array(
                'id' => 'scroll_animation',
                'type' => 'button_set',
                'title' => __('Page scroll animation', 'crum'),
                'desc' => __('Enable or disable page scroll animation', 'crum'),
                'options' => array('off' => 'Off', 'on' => 'On'),
                'std' => 'on'
            ),
            array(
                'id' => 'responsive_mode',
                'type' => 'button_set',
                'title' => __('Responsive CSS', 'crum'),
                'desc' => __('Enable or disable site responsive design', 'crum'),
                'options' => array('off' => 'Off', 'on' => 'On'),
                'std' => 'on'
            ),

            array(
                'id' => 'touch-device-icon',
                'type' => 'upload',
                'title' => __('App icon for mobile devices', 'crum'),
                'desc' => __('APP icon on the home screen of the phone. One that when clicked opens the site on the phone (recommended size - 152x152 px)', 'crum')
            ),

	        array(
		        'id' => 'custom_favicon',
		        'type' => 'upload',
		        'title' => __('Favicon', 'crum'),
		        'desc' => __('Select a 16px X 16px image from the file location on your computer and upload it as a favicon of your site', 'crum')
	        ),

            array(
                'id' => 'custom_logo_image',
                'type' => 'upload',
                'title' => __('Header Logotype image', 'crum'),
                'desc' => __('Select an image from the file location on your computer and upload it as a header logotype', 'crum'),
                'std'  => $assets_folder.'img/logo.png',
            ),
	        array(
		        'id' => 'custom_logo_retina',
		        'type' => 'upload',
		        'title' => __('Logotype image for Retina displays', 'crum'),
		        'desc' => __('It should be double size from main logo', 'crum'),
		        'std'  => $assets_folder.'img/logo@2x.png',
	        ),
            array(
                'id' => 'custom_logo_text',
                'type' => 'text',
                'title' => __('Logotype text', 'crum'),
                
                'desc' => __('If you do not use logo image - you can type text here', 'crum'),
                'std'  => 'Glider',
            ),

            array(
                'id' => 'logotype_style',
                'type' => 'button_set',
                'title' => __('Logotype style', 'crum'),
                
                'desc' => __('Select what type of logo you want.', 'crum'),
                'options' => array('img' => 'Image','txt' => 'Text','no' => 'No logo'),//Must provide key => value pairs for radio options
                'std' => 'img',
            ),
            array(
                'id' => 'top_adress_block',
                'type' => 'button_set',
                'title' => __('Top block with address', 'crum'),
                
                'desc' => __('Enable or disable address block', 'crum'),
                'options' => array('off' => 'Off', 'on' => 'On'),
                'std' => 'on'
            ),
            array(
                'id' => 'custom_portfolio-slug',
                'type' => 'text',
                'title' => __('Custom slug for portfolio items', 'crum'),
                'sub_desc' => __('Note: Current portfolio items will be Hidden after slug change. You can convert current portfolio items to new post type by plugin <a href="http://wordpress.org/plugins/convert-post-types/">Convert Post Types</a>', 'crum'),
                'desc' => __('<p>After change please go to Settings -> Permalinks and press "Save changes" button and open Theme folder via FTP find [single-my-product.php] and Rename it. Instead of "my-product" please write your slug (same as you type in field above)</p>', 'crum'),
                'std' => ''
            ),
            array(
                'id' => 'top_adress_field',
                'type' => 'textarea',
                'title' => __('Top adress panel', 'crum'),
                'sub_desc' => __('Please do not use single qoute here', 'crum'),
                'desc' => __('This is top adress info block.', 'crum'),
                'validate' => 'html',
                'std' => '<span class="phone"><span class="icon-mobile"></span>+6 948-456-2354</span><div class="lang-sel"><a href="#"><img src="http://dev.crumina.net/glider/wp-content/themes/maestro/assets/img/lang-icon.png" alt="GB"></a></div>'
            ),
            array(
                'id' => 'lang_shortcode',
                'type' => 'text',
                'title' => __('Language selection shortcode', 'crum'),
                
                'desc' => __('You can type shortcode of language select tht your translating plugin provide', 'crum'),
                'std'  => '',
            ),

            array(
                'id' => 'wpml_lang_show',
                'type' => 'button_set',
                'title' => __('WPML language switcher', 'crum'),
                
                'desc' => __('WPML plugin must be installed. It is not packed with theme. You can find it here: http://wpml.org/', 'crum'),
                'options' => array('0' => 'Off', '1' => 'On'),
                'std' => '0'
            ),
            array(
                'id' => 'custom_js',
                'type' => 'textarea',
                'title' => __('Custom JS', 'crum'),
                
                'desc' => __('Generate your tracking code at Google Analytics Service and insert it here.', 'crum'),
            ),
            array(
                'id' => 'custom_css',
                'type' => 'textarea',
                'title' => __('Custom CSS', 'crum'),
                
                'desc' => __('You may add any other styles for your theme to this field.', 'crum'),
            ),

			array(
				'id' => 'crum_shop_pagination',
				'type' => 'button_set',
				'options' => array('0' => 'Arrows', '1' => 'Next/Prev'),
				'std' => '0',
				'title' => __('Shop pagination','crum'),
				'desc' => __('Select pagination style for shop page','crum'),
			),
        ),

    );
    $sections[] = array(
        'title' => __('Top panel Options', 'crum'),
        
        //all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
        //You dont have to though, leave it blank for default.
        'icon' => 'arrow-down',
        //Lets leave this as a blank section, no options just some intro text set above.
        'fields' => array(
            array(
                'id' => 'top_panel',
                'type' => 'button_set',
                'title' => __('Display top panel', 'crum'),
                
                'desc' => __('Enable or disable top slidin', 'crum'),
                'options' => array('0' => 'Off', '1' => 'On'),
                'std' => '1'
            ),
            array(
                'id' => 'top_panel_login',
                'type' => 'button_set',
                'title' => __('Display login panel', 'crum'),
                
                'desc' => __('Enable or disable login form', 'crum'),
                'options' => array('off' => 'Off', 'on' => 'On'),
                'std' => 'on'
            ),
            array(
                'id' => 'top_panel_icon',
                'type' => 'icon',
                'title' => __('Icon for panel text', 'crum'),
                
                'desc' => __('You can select icon here', 'crum'),
                'std' =>  'awesome-list'
            ),
            array(
                'id' => 'top_panel_title',
                'type' => 'text',
                'title' => __('Title top panel', 'crum'),
                
                'desc' => __('Title of right column', 'crum'),
                'std' => 'A few words about anything'
            ),
            array(
                'id' => 'top_panel_text',
                'type' => 'editor',
                'title' => __('Text for top panel', 'crum'),
                
                'desc' => __('Text, that will displayed in top panel', 'crum'),
                'std' => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>'
            ),
        ),
    );
    $sections[] = array(
        'title' => __('Social accounts', 'crum'),
        'desc' => __('<p class="description">Type links for social accounts</p>', 'crum'),
        //all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
        //You dont have to though, leave it blank for default.
        'icon' => 'user',
        //Lets leave this as a blank section, no options just some intro text set above.
        'fields' => array(
            array(
                'id' => 'fb_link',
                'type' => 'text',
                'title' => __('Facebook link', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://facebook.com'
            ),
            array(
                'id' => 'fb_icon',
                'type' => 'icon',
                'title' => __('Facebook icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-facebook-rect'
            ),
            array(
                'id' => 'fb_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'tw_link',
                'type' => 'text',
                'title' => __('Twitter link', 'crum'),
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://twitter.com'
            ),
            array(
                'id' => 'tw_icon',
                'type' => 'icon',
                'title' => __('Twitter icon', 'crum'),
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-twitter-bird'
            ),
            array(
                'id' => 'tw_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'in_link',
                'type' => 'text',
                'title' => __('Instagram link', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://instagram.com'
            ),
            array(
                'id' => 'in_icon',
                'type' => 'icon',
                'title' => __('Instagram icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-instagram'
            ),
            array(
                'id' => 'in_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'vi_link',
                'type' => 'text',
                'title' => __('Vimeo link', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://vimeo.com'
            ),
            array(
                'id' => 'vi_icon',
                'type' => 'icon',
                'title' => __('Vimeo icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-vimeo'
            ),
            array(
                'id' => 'vi_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'lf_link',
                'type' => 'text',
                'title' => __('Last FM link', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://lastfm.com'
            ),
            array(
                'id' => 'lf_icon',
                'type' => 'icon',
                'title' => __('LastFM icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-lastfm'
            ),
            array(
                'id' => 'lf_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'vk_link',
                'type' => 'text',
                'title' => __('Vkontakte link', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://vk.com'
            ),
            array(
                'id' => 'vk_icon',
                'type' => 'icon',
                'title' => __('Vkontakte icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-vkontakte-rect'
            ),
            array(
                'id' => 'vk_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'yt_link',
                'type' => 'text',
                'title' => __('YouTube', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://youtube.com'
            ),
            array(
                'id' => 'yt_icon',
                'type' => 'icon',
                'title' => __('Youtube icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-youtube'
            ),
            array(
                'id' => 'yt_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'de_link',
                'type' => 'text',
                'title' => __('Deviantart link', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'https://deviantart.com/'
            ),
            array(
                'id' => 'de_icon',
                'type' => 'icon',
                'title' => __('Deviantart', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-deviantart'
            ),
            array(
                'id' => 'de_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'li_link',
                'type' => 'text',
                'title' => __('LinkedIN', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://linkedin.com'
            ),
            array(
                'id' => 'li_icon',
                'type' => 'icon',
                'title' => __('LinkedIN', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-linkedin-rect'
            ),
            array(
                'id' => 'li_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'gp_link',
                'type' => 'text',
                'title' => __('Google +', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'https://accounts.google.com/'
            ),
            array(
                'id' => 'gp_icon',
                'type' => 'icon',
                'title' => __('Google +', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-googleplus-rect'
            ),
            array(
                'id' => 'gp_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'pi_link',
                'type' => 'text',
                'title' => __('Picasa', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://picasa.com'
            ),
            array(
                'id' => 'pi_icon',
                'type' => 'icon',
                'title' => __('Picasa icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-picasa'
            ),
            array(
                'id' => 'pi_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'pt_link',
                'type' => 'text',
                'title' => __('Pinterest', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://pinterest.com'
            ),
            array(
                'id' => 'pt_icon',
                'type' => 'icon',
                'title' => __('Pinterest icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-pinterest'
            ),
            array(
                'id' => 'pt_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'wp_link',
                'type' => 'text',
                'title' => __('Wordpress', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://wordpress.com'
            ),
            array(
                'id' => 'wp_icon',
                'type' => 'icon',
                'title' => __('WP icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-wordpress'
            ),
            array(
                'id' => 'wp_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'db_link',
                'type' => 'text',
                'title' => __('Dropbox', 'crum'),
                
                'desc' => __('Paste link to your account', 'crum'),
                'std' => 'http://dropbox.com'
            ),
            array(
                'id' => 'db_icon',
                'type' => 'icon',
                'title' => __('Dropbox icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-dropbox'
            ),
            array(
                'id' => 'db_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '0'// 1 = on | 0 = off
            ),
            array(
                'id' => 'rss_link',
                'type' => 'text',
                'title' => __('RSS', 'crum'),
                
                'desc' => __('Paste alternative link to Rss', 'crum'),
                'std' => ''
            ),
            array(
                'id' => 'rss_icon',
                'type' => 'icon',
                'title' => __('RSS icon', 'crum'),
                
                'desc' => __('Type icon name here', 'crum'),
                'std' => 'icon-rss'
            ),
            array(
                'id' => 'rss_show',
                'type' => 'checkbox',
                'title' => __('Show in header', 'crum'),
                'sub_desc' => __('If checked - will be display in header of theme ', 'crum'),
                
                'std' => '0'// 1 = on | 0 = off
            ),
        ),
    );

    $sections[] = array(
        'title' => __('Posts list options', 'crum'),
        'desc' => __('<p class="description">Parameters for posts and archives (social share etc)</p>', 'crum'),
        //all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
        //You dont have to though, leave it blank for default.
        'icon' => 'folder-open-alt',
        //Lets leave this as a blank section, no options just some intro text set above.
        'fields' => array(


            array(
                'id' => 'post_share_button',
                'type' => 'button_set',
                'title' => __('Social share buttons', 'crum'),
                
                'desc' => __('With this option you may activate or deactivate social share buttons.', 'crum'),
                'options' => array('0' => 'Off','1' => 'On'),
                'std' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'custom_share_code',
                'type' => 'textarea',
                'title' => __('Custom share code', 'crum'),
                
                'desc' => __('You may add any other social share buttons to this field.', 'crum'),
            ),

            array(
                'id' => 'autor_box_disp',
                'type' => 'button_set',
                'title' => __('Author Info', 'crum'),
                
                'desc' => __('This option enables you to insert information about the author of the post.', 'crum'),
                'options' => array('0' => 'Off','1' => 'On'),
                'std' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'links_box_disp',
                'type' => 'button_set',
                'title' => __('Links in author info', 'crum'),
                
                'desc' => __('Enable or disable additional links in author box', 'crum'),
                'options' => array('0' => 'Off','1' => 'On'),
                'std' => '0'// 1 = on | 0 = off
            ),
			array(
				'id' => 'pagination_style',
				'type' => 'button_set', //the field type
				'title' => __('Pagination type', 'crum'),

				'desc' => __('This option enables you to choose pagination type.', 'crum'),
				'options' => array('1' => __('Prev/next butt.', 'crum'), '2' => __('Pages list', 'crum')),
				'std' => '1'//this should be the key as defined above
			),
            array(
                'id' => 'thumb_inner_disp',
                'type' => 'button_set', //the field type
                'title' => __('Thumbnail on inner page', 'crum'),
                
                'desc' => __('Display featured image on single post', 'crum'),
                'options' => array('1' => __('On', 'crum'), '0' => __('Off', 'crum')),
                'std' => '0'//this should be the key as defined above
            ),

            array(
                'id' => 'post_thumbnails_width',
                'type' => 'text',
                'title' => __('Post thumbnail width (in px)', 'crum'),
                
                
                'validate' => 'numeric',
                'std' => '1200'
            ),
            array(
                'id' => 'post_thumbnails_height',
                'type' => 'text',
                'title' => __('Post  thumbnail height (in px)', 'crum'),
                
                
                'validate' => 'numeric',
                'std' => '300',
            ),
            array(
                'id' => 'post_inner_header',
                'type' => 'button_set',
                'title' => __('Post info', 'crum'),
                
                'desc' => __('It is information about the post (time and date of creation, author, comments on the post).', 'crum'),
                'options' => array('1' => __('On', 'crum'), '0' => __('Off', 'crum')),
                'std' => '0'//this should be the key as defined above
            ),


        ),
    );

    $sections[] = array(
        'title' => __('Portfolio Options', 'crum'),
        
        //all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
        //You dont have to though, leave it blank for default.
        'icon' => 'camera',
        //Lets leave this as a blank section, no options just some intro text set above.
        'fields' => array(
            array(
                'id' => 'portfolio_page_select',
                'type' => 'pages_select',
                'title' => __('Portfolio page', 'crum'),
                
                'desc' => __('Please select main portfolio page (for proper urls)', 'crum'),
                'args' => array()//uses get_pages
            ),
            array(
                'id' => 'folio_sorting',
                'type' => 'button_set',
                'title' => __('Items Sorting', 'crum'),
                'sub_desc' => __('Disable or enable items sort on portfolio page templates that allow that', 'crum'),
                
                'options' => array('1' => __('On', 'crum'), '0' => __('Off', 'crum')),
                'std' => '1'//this should be the key as defined above
            ),
            array(
                'id' => 'folio_date',
                'type' => 'button_set',
                'title' => __('Date in portfolio', 'crum'),
                'sub_desc' => __('Display date in portfolio items?', 'crum'),
                
                'options' => array('1' => __('On', 'crum'), '0' => __('Off', 'crum')),
                'std' => '1'//this should be the key as defined above
            ),
            array(
                'id' => 'portfolio_single_style',
                'type' => 'button_set', //the field type
                'title' => __('Portfolio text location', 'crum'),
                'sub_desc' => __('Select text layout on inner page', 'crum'),
                
                'options' =>array(
                    'left'=>'To the right',
                    'full'=>'Full width',
                ),
                'std' => 'left',
            ),
            array(
                'id' => 'portfolio_single_featured',
                'type' => 'button_set', //the field type
                'title' => __('Featured image', 'crum'),
                'sub_desc' => __('Display featured image on inner page?', 'crum'),
                
                'options' => array('1' => __('On', 'crum'), '0' => __('Off', 'crum')),
                'std' => '1'//this should be the key as defined above
            ),
            array(
                'id' => 'portfolio_single_slider',
                'type' => 'button_set', //the field type
                'title' => __('Portfolio image display', 'crum'),
                'sub_desc' => __('Display attached images of inner portfolio page as:', 'crum'),
                
                'options' =>array(
                    'slider'=>'Slider',
                    'full'=>'Items',
                ),
                'std' => 'slider',
            ),
            array(
                'id' => 'order_folio_images',
                'type' => 'select',
                'title' => __('Portfolio Images sort', 'crum'),
                'sub_desc' => __('Sort images on portfolio single page', 'crum'),
                
                'options' => array('post_date'=>'Date of publication','title' => 'Title','rand' => 'Display random','menu_order' => 'As in gallery'),
                'std' => 'menu_order'
            ),
            array(
                'id' => 'sort_order_folio_images',
                'type' => 'button_set', //the field type
                'title' => __('Portfolio Images order', 'crum'),
                'sub_desc' => __('Order images on portfolio single page', 'crum'),
                
                'options' =>array(
                    'ASC'=>'Sort ascending',
                    'DESC'=>'Sort descending',
                ),
                'std' => 'DESC',
            ),
            array(
                'id' => 'recent_items_disp',
                'type' => 'button_set', //the field type
                'title' => __('Recent items', 'crum'),
                'sub_desc' => __('Block with recent items', 'crum'),
                
                'options' => array('1' => __('On', 'crum'), '0' => __('Off', 'crum')),
                'std' => '1'//this should be the key as defined above
            ),
        ),
    );

    $sections[] = array(
        'title' => __('Styling Options', 'crum'),
        'desc' => __('<p class="description">Style parameters of body and footer</p>', 'crum'),
        //all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
        //You dont have to though, leave it blank for default.
        'icon' => 'cogs',
        //Lets leave this as a blank section, no options just some intro text set above.
        'fields' => array(


            array(
                'id' => 'info_msc',
                'type' => 'info',
                'desc' => __('<p class="description">Main site colors setup</p>', 'crum')
            ),

            array(
                'id' => 'main_site_color',
                'type' => 'color',
                'title' => __('Main site color', 'crum'),
                'desc' => __('Color of buttons, tabs, links, borders etc.', 'crum'),
                'std' => '#26bdef'
            ),
            array(
                'id' => 'secondary_site_color',
                'type' => 'color',
                'title' => __('Secondary site color', 'crum'),
                
                'desc' => __('Color of inactive or hovered elements', 'crum'),
                'std' => '#f36f5f'
            ),
            array(
                'id' => 'font_site_color',
                'type' => 'color',
                'title' => __('Color of text', 'crum'),
                
                'desc' => __('Color of body text', 'crum'),
                'std' => '#828a93'
            ),

            array(
                'id' => 'info_sth',
                'type' => 'info',
                'desc' => __('<p class="description">Page title background options</p>', 'crum')
            ),

            array(
                'id' => 'stan_header',
                'type' => 'button_set',
                'title' => __('Page title background', 'crum'),
                'options' => array('0' => 'Off','1' => 'On'),
                'std' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'stan_header_color',
                'type' => 'color',
                'title' => __('Default background color for header', 'crum'),
                'std' => '#20bce3'
            ),
            array(
                'id' => 'stan_header_image',
                'type' => 'upload',
                'title' => __('Default background image for header', 'crum'),
                'desc' => __('Upload your own background image or pattern.', 'crum'),
                'std' => $assets_folder.'img/page-header-default.jpg'
            ),


            array(
                'id' => 'site_boxed',
                'type' => 'button_set',
                'title' => __('Body layout', 'crum'),
                
                
                'options' => array('0' => 'Full width', '1' => 'Boxed'),
                'std' => '0',
            ),

            array(
                'id' => 'info_bxd',
                'type' => 'info',
                'desc' => __('<p class="description">Boxed site options</p>', 'crum')
            ),

            //Body wrapper
            array(
                'id' => 'wrapper_bg_color',
                'type' => 'color',
                'title' => __('Content background color', 'crum'),
                'desc' => __('Select background color.', 'crum'),
                'std' => ''
            ),
            array(
                'id' => 'wrapper_bg_image',
                'type' => 'upload',
                'title' => __('Content background image', 'crum'),
                'desc' => __('Upload your own background image or pattern.', 'crum')
            ),
            array(
                'id' => 'wrapper_custom_repeat',
                'type' => 'select',
                'title' => __('Content bg image repeat', 'crum'),
                'desc' => __('Select type background image repeat', 'crum'),
                'options' => array('repeat-y' => 'vertically','repeat-x' => 'horizontally','no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally', ),//Must provide key => value pairs for select options
                'std' => 'repeat'
            ),


            array(
                'id' => 'info_bxd',
                'type' => 'info',
                'desc' => __('<p class="description">Not Boxed site options</p>', 'crum')
            ),

            array(
                'id' => 'body_bg_color',
                'type' => 'color',
                'title' => __('Body background color', 'crum'),
                'desc' => __('Select background color.', 'crum'),
                'std' => ''
            ),
            array(
                'id' => 'body_bg_image',
                'type' => 'upload',
                'title' => __('Custom background image', 'crum'),
                
                'desc' => __('Upload your own background image or pattern.', 'crum')
            ),
            array(
                'id' => 'body_custom_repeat',
                'type' => 'select',
                'title' => __('Background image repeat', 'crum'),
                'desc' => __('Select type background image repeat', 'crum'),
                'options' => array('repeat-y' => 'vertically','repeat-x' => 'horizontally','no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally', ),//Must provide key => value pairs for select options
                'std' => ''
            ),
            array(
                'id' => 'body_bg_fixed',
                'type' => 'button_set',
                'title' => __('Fixed body background', 'crum'),
                'options' => array('0' => 'Off','1' => 'On'),
                'std' => '0'// 1 = on | 0 = off
            ),

            array(
                'id' => 'info_foot',
                'type' => 'info',
                'desc' => __('<p class="description">Footer section options</p>', 'crum')
            ),

            array(
                'id' => 'footer_bg_color',
                'type' => 'color',
                'title' => __('Footer background color', 'crum'),
                
                'desc' => __('Select footer background color. ', 'crum'),
                'std' => ''
            ),
            array(
                'id' => 'footer_font_color',
                'type' => 'color',
                'title' => __('Footer font color', 'crum'),
                
                'desc' => __('Select footer font color.', 'crum'),
                'std' => ''
            ),
            array(
                'id' => 'footer_bg_image',
                'type' => 'upload',
                'title' => __('Custom footer background image', 'crum'),
                
                'desc' => __('Upload your own footer background image or pattern.', 'crum')
            ),
            array(
                'id' => 'footer_custom_repeat',
                'type' => 'select',
                'title' => __('Footer background image repeat', 'crum'),
                
                'desc' => __('Select type background image repeat', 'crum'),
                'options' => array('repeat-y' => 'vertically','repeat-x' => 'horizontally','no-repeat' => 'no-repeat', 'repeat' => 'both vertically and horizontally', ),//Must provide key => value pairs for select options
                'std' => ''
            ),
        ),
    );
	
    $sections[] = array(
        'title' => __('Contact page options', 'crum'),
        'desc' => __('<p class="description">Contact page options</p>', 'crum'),
        //all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
        //You dont have to though, leave it blank for default.
        'icon' => 'map-marker',
        //Lets leave this as a blank section, no options just some intro text set above.
        'fields' => array(
            array(
                'id' => 'custom_form_shortcode',
                'type' => 'text',
                'title' => __('Custom Form Shortcode', 'crum'),
                
                'desc' => __('You can paste your shorcode custom form', 'crum'),
                'std' =>''
            ),
            array(
                'id' => 'cont_m_disp',
                'type' => 'button_set',
                'title' => __('Display map on contacts page?', 'crum'),
                'options' => array('0' => 'Off','1' => 'On'),
                'std' => '1'// 1 = on | 0 = off
            ),
            array(
                'id' => 'cont_m_height',
                'type' => 'text',
                'title' => __('Height of Google Map (in px)', 'crum'),
                
                'std' =>''
            ),
            array(
                'id' => 'map_address',
                'type' => 'text',
                'title' => __('Address on Google Map ', 'crum'),
                
                'desc' => __('Fill in your address to be shown on Google map.', 'crum'),
                'std' =>'London, Downing street, 10'
            ),
            array(
                'id' => 'contacts_form_mail',
                'type' => 'text',
                'title' => __('Form address', 'crum'),
                
                'desc' => __('Email address for contact form', 'crum'),
                'std' => get_option('admin_email')
            ),
            array(
                'id' => 'antispam_question',
                'type' => 'text',
                'title' => __('Type the antispam question', 'crum'),
                
                'desc' => __('Antispam question will protect you from spamers', 'crum'),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'std' => 'How many legs does elephant have? (number)'
            ),
            array(
                'id' => 'antispam_answer',
                'type' => 'text',
                'title' => __('Type the answer for antispam question', 'crum'),
                
                'desc' => __('Antispam question will protect you from spamers', 'crum'),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'std' =>'4'
            ),

        ),
    );

    $sections[] = array(
        'title' => __('Footer section options', 'crum'),
        'desc' => __('<p class="description">Footer section options</p>', 'crum'),
        //all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
        //You dont have to though, leave it blank for default.
        'icon' => 'tasks',
        //Lets leave this as a blank section, no options just some intro text set above.
        'fields' => array(

            array(
                'id' => 'logo_footer',
                'type' => 'upload',
                'title' => __('Logotype in footer', 'crum'),
                'desc' => __('Will be displayed before copyright text', 'crum'),
                'std'  => $assets_folder.'img/logo-footer.png',
            ),

            array(
                'id' => 'copyright_footer',
                'type' => 'text',
                'title' => __('Show copyright', 'crum'),
                
                'desc' => __('Fill in the copyright text.', 'crum'),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'std' => 'My copyright info 2013'
            ),

        ),
    );


    $sections[] = array(
        'icon' => 'wrench',
        'title' => __('Layouts Settings', 'crum'),
        'desc' => __('<p class="description">Configure layouts of different pages</p>', 'crum'),
        'fields' => array(
            array(
                'id' => 'pages_layout',
                'type' => 'radio_img',
                'title' => __('Single pages layout', 'crum'),
                'sub_desc' => __('Select one type of layout for single pages', 'crum'),
                
                'options' => array(
                    '1col-fixed' => array('title' => 'No sidebars', 'img' => Redux_OPTIONS_URL.'img/1col.png'),
                    '2c-l-fixed' => array('title' => 'Sidebar on left', 'img' => Redux_OPTIONS_URL.'img/2cl.png'),
                    '2c-r-fixed' => array('title' => 'Sidebar on right', 'img' => Redux_OPTIONS_URL.'img/2cr.png'),
                    '3c-l-fixed' => array('title' => '2 left sidebars', 'img' => Redux_OPTIONS_URL.'img/3cl.png'),
                    '3c-fixed' => array('title' => 'Sidebar on either side', 'img' => Redux_OPTIONS_URL.'img/3cc.png'),
                    '3c-r-fixed' => array('title' => '2 right sidebars', 'img' => Redux_OPTIONS_URL.'img/3cr.png'),
                ),//Must provide key => value(array:title|img) pairs for radio options
                'std' => '1col-fixed'
            ),
            array(
                'id' => 'archive_layout',
                'type' => 'radio_img',
                'title' => __('Archive Pages Layout', 'crum'),
                'sub_desc' => __('Select one type of layout for archive pages', 'crum'),
                
                'options' => array(
                    '1col-fixed' => array('title' => 'No sidebars', 'img' => Redux_OPTIONS_URL.'img/1col.png'),
                    '2c-l-fixed' => array('title' => 'Sidebar on left', 'img' => Redux_OPTIONS_URL.'img/2cl.png'),
                    '2c-r-fixed' => array('title' => 'Sidebar on right', 'img' => Redux_OPTIONS_URL.'img/2cr.png'),
                    '3c-l-fixed' => array('title' => '2 left sidebars', 'img' => Redux_OPTIONS_URL.'img/3cl.png'),
                    '3c-fixed' => array('title' => 'Sidebar on either side', 'img' => Redux_OPTIONS_URL.'img/3cc.png'),
                    '3c-r-fixed' => array('title' => '2 right sidebars', 'img' => Redux_OPTIONS_URL.'img/3cr.png'),
                ),//Must provide key => value(array:title|img) pairs for radio options
                'std' => '2c-l-fixed'
            ),
            array(
                'id' => 'single_layout',
                'type' => 'radio_img',
                'title' => __('Single posts layout', 'crum'),
                'sub_desc' => __('Select one type of layout for single posts', 'crum'),
                
                'options' => array(
                    '1col-fixed' => array('title' => 'No sidebars', 'img' => Redux_OPTIONS_URL.'img/1col.png'),
                    '2c-l-fixed' => array('title' => 'Sidebar on left', 'img' => Redux_OPTIONS_URL.'img/2cl.png'),
                    '2c-r-fixed' => array('title' => 'Sidebar on right', 'img' => Redux_OPTIONS_URL.'img/2cr.png'),
                    '3c-l-fixed' => array('title' => '2 left sidebars', 'img' => Redux_OPTIONS_URL.'img/3cl.png'),
                    '3c-fixed' => array('title' => 'Sidebar on either side', 'img' => Redux_OPTIONS_URL.'img/3cc.png'),
                    '3c-r-fixed' => array('title' => '2 right sidebars', 'img' => Redux_OPTIONS_URL.'img/3cr.png'),
                ),//Must provide key => value(array:title|img) pairs for radio options
                'std' => '2c-l-fixed'
            ),
            array(
                'id' => 'search_layout',
                'type' => 'radio_img',
                'title' => __('Search results layout', 'crum'),
                'sub_desc' => __('Select one type of layout for search results', 'crum'),
                
                'options' => array(
                    '1col-fixed' => array('title' => 'No sidebars', 'img' => Redux_OPTIONS_URL.'img/1col.png'),
                    '2c-l-fixed' => array('title' => 'Sidebar on left', 'img' => Redux_OPTIONS_URL.'img/2cl.png'),
                    '2c-r-fixed' => array('title' => 'Sidebar on right', 'img' => Redux_OPTIONS_URL.'img/2cr.png'),
                    '3c-l-fixed' => array('title' => '2 left sidebars', 'img' => Redux_OPTIONS_URL.'img/3cl.png'),
                    '3c-fixed' => array('title' => 'Sidebar on either side', 'img' => Redux_OPTIONS_URL.'img/3cc.png'),
                    '3c-r-fixed' => array('title' => '2 right sidebars', 'img' => Redux_OPTIONS_URL.'img/3cr.png'),
                ),//Must provide key => value(array:title|img) pairs for radio options
                'std' => '2c-l-fixed'
            ),
            array(
                'id' => '404_layout',
                'type' => 'radio_img',
                'title' => __('404 Page Layout', 'crum'),
                'sub_desc' => __('Select one of layouts for 404 page', 'crum'),
                
                'options' => array(
                    '1col-fixed' => array('title' => 'No sidebars', 'img' => Redux_OPTIONS_URL.'img/1col.png'),
                    '2c-l-fixed' => array('title' => 'Sidebar on left', 'img' => Redux_OPTIONS_URL.'img/2cl.png'),
                    '2c-r-fixed' => array('title' => 'Sidebar on right', 'img' => Redux_OPTIONS_URL.'img/2cr.png'),
                    '3c-l-fixed' => array('title' => '2 left sidebars', 'img' => Redux_OPTIONS_URL.'img/3cl.png'),
                    '3c-fixed' => array('title' => 'Sidebar on either side', 'img' => Redux_OPTIONS_URL.'img/3cc.png'),
                    '3c-r-fixed' => array('title' => '2 right sidebars', 'img' => Redux_OPTIONS_URL.'img/3cr.png'),
                ),//Must provide key => value(array:title|img) pairs for radio options
                'std' => '2c-l-fixed'
            )
        ),
    );

    $sections[] = array(
        'title' => __('Icons customization', 'crum'),
        
        //all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
        //You dont have to though, leave it blank for default.
        'icon' => 'info-sign',
        //Lets leave this as a blank section, no options just some intro text set above.
        'fields' => array(
            array(
                'id' => 'default_widget_icon',
                'type' => 'icon',
                'title' => __('Default widget icon', 'crum'),
                'std'  => 'linecon-diamond',
            ),
            array(
                'id' => 'search-widget_icon',
                'type' => 'icon',
                'title' => __('Search widget', 'crum'),
                'std'  => '',
            ),
            array(
                'id' => 'recent_posts_icon',
                'type' => 'icon',
                'title' => __('Recent posts widget', 'crum'),
                'std'  => 'linecon-doc',
            ),
            array(
                'id' => 'rss_mail_subscribe_icon',
                'type' => 'icon',
                'title' => __('RSS Feed subscribe widget', 'crum'),
                'std'  => 'awesome-rss',
            ),
            array(
                'id' => 'recent_block_icon',
                'type' => 'icon',
                'title' => __('Recent from portfolio block', 'crum'),
                'std'  => 'linecon-camera',
            ),
            array(
                'id' => 'crum_news_cat_icon',
                'type' => 'icon',
                'title' => __('News from category block', 'crum'),
                'std'  => 'linecon-note',
            ),
            array(
                'id' => 'crum_tabwidget_icon',
                'type' => 'icon',
                'title' => __('Horizontal Tabs block', 'crum'),
                
                
                'std'  => '',
            ),
            array(
                'id' => 'list_widget_icon',
                'type' => 'icon',
                'title' => __('Styled list widget', 'crum'),
                'std'  => 'linecon-money',
            ),
            array(
                'id' => 'crum_testimonial_icon',
                'type' => 'icon',
                'title' => __('Testimonial block', 'crum'),
                'std'  => 'linecon-thumbs-up',
            ),
            array(
                'id' => 'crum_partners_widget_icon',
                'type' => 'icon',
                'title' => __('Partners logo block', 'crum'),
                'std'  => 'linecon-globe',
            ),
            array(
                'id' => 'instagram-widget_icon',
                'type' => 'icon',
                'title' => __('Flickr widget', 'crum'),
                'std'  => '',
            ),
            array(
                'id' => 'widget_crum-text-widget_icon',
                'type' => 'icon',
                'title' => __('Text widget', 'crum'),
                'std'  => 'linecon-clock',
            ),
            array(
                'id' => 'contacts-widget_icon',
                'type' => 'icon',
                'title' => __('VCard widget', 'crum'),
                'std'  => 'linecon-diamond',
            ),
            array(
                'id' => 'tags-widget_icon',
                'type' => 'icon',
                'title' => __('Tags widget', 'crum'),
                'std'  => 'linecon-tag',
            ),
            array(
                'id' => 'tabs-widget_icon',
                'type' => 'icon',
                'title' => __('Tabs-posts widget', 'crum'),
                'std'  => 'linecon-calendar',
            ),
            array(
                'id' => 'widget_gallery_widget_icon',
                'type' => 'icon',
                'title' => __('From portfolio widget', 'crum'),
                'std'  => 'linecon-paper-plane',
            ),
            array(
                'id' => 'widget_twitter-widget_icon',
                'type' => 'icon',
                'title' => __('Twitter widget', 'crum'),
                'std'  => 'moon-twitter',
            ),
            array(
                'id' => 'category-widget_icon',
                'type' => 'icon',
                'title' => __('Category widget', 'crum'),
                'std'  => 'awesome-list-ul',
            ),
            array(
                'id' => 'widget_facebook_widget_icon',
                'type' => 'icon',
                'title' => __('Facebook widget', 'crum'),
                'std'  => 'moon-facebook',
            ),
            array(
                'id' => 'widget_crum_widgets_video_icon',
                'type' => 'icon',
                'title' => __('oEmbed widget', 'crum'),
                'std'  => 'linecon-videocam',
            ),
            array(
                'id' => 'crum_widget_v_accordion_icon',
                'type' => 'icon',
                'title' => __('Vertical tabs block', 'crum'),
                'std'  => 'linecon-lightbulb',
            ),
            array(
                'id' => 'crum_galleries_widget_icon',
                'type' => 'icon',
                'title' => __('Galleries block', 'crum'),
                'std'  => 'linecon-photo',
            ),
            array(
                'id' => 'about_author_widget_icon',
                'type' => 'icon',
                'title' => __('About author block', 'crum'),
                'std'  => 'linecon-sound',
            ),
            array(
                'id' => 'skills_widget_icon',
                'type' => 'icon',
                'title' => __('My skills block', 'crum'),
                'std'  => 'linecon-params',
            ),
            array(
                'id' => 'crum_shortcode_widget_icon',
                'type' => 'icon',
                'title' => __('Shortcode block', 'crum'),
                'std'  => 'linecon-diamond',
            ),
            array(
                'id' => 'crum_widget_features_icon',
                'type' => 'icon',
                'title' => __('Features list block', 'crum'),
                'std'  => 'linecon-tv',
            ),
            array(
                'id' => 'widget_wp_sidebarlogin_icon',
                'type' => 'icon',
                'title' => __('Login widget', 'crum'),
                'std'  => 'linecon-diamond',
            ),
            array(
                'id' => 'widget_shopping_cart_icon',
                'type' => 'icon',
                'title' => __('Shopping cart widget', 'crum'),
                'std'  => 'linecon-diamond',
            ),
            array(
                'id' => 'crum_widget_accordion_icon',
                'type' => 'icon',
                'title' => __('Accordion block', 'crum'),
                'std'  => '',
            ),array(
                'id' => 'cont-map_icon',
                'type' => 'icon',
                'title' => __('Map block', 'crum'),
                'std'  => '',
            ),

        ),
    );

    $sections[] = array(
        'title' => __('Twitter panel options', 'crum'),
        'desc' => __('<p class="description">More information about api kays and how to get it you can find in that tutorial <a href="http://crumina.net/how-do-i-get-consumer-key-for-sign-in-with-twitter/">http://crumina.net/how-do-i-get-consumer-key-for-sign-in-with-twitter/</a></a></p>', 'crum'),
        //all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
        //You dont have to though, leave it blank for default.
        'icon' =>'twitter',
        //Lets leave this as a blank section, no options just some intro text set above.
        'fields' => array(

            array(
                'id' => 'footer_tw_disp',
                'type' => 'button_set',
                'title' => __('Display twitter statuses before footer', 'crum'),
                'options' => array('1' => 'On','0' => 'Off'),
                'std' => '0'// 1 = on | 0 = off
            ),

            array(
                'id' => 'cachetime',
                'type' => 'text',
                'title' => __('Cache Tweets in every:', 'crum'),
                'sub_desc' => __('In minutes', 'crum'),
                'std' => '1'
            ),
            array(
                'id' => 'numb_lat_tw',
                'type' => 'text',
                'title' => __('Number of latest tweets display:', 'crum'),
                
                'std' => '10'
            ),
            array(
                'id' => 'username',
                'type' => 'text',
                'title' => __('Username:', 'crum'),
                'std' => 'Envato'
            ),

            array(
                'id' => 'twiiter_consumer',
                'type' => 'text',
                'title' => __('Consumer key:', 'crum'),
                'std' => 'NUpqyogOrudpewmXjsa1w',

            ),
            array(
                'id' => 'twiiter_con_s',
                'type' => 'text',
                'title' => __('Consumer secret:', 'crum'),
                'std' => 'guBaK4hoLTaPPxUt6DjSnid6RTNXXTvUzqDavhvM',
            ),
            array(
                'id' => 'twiiter_acc_t',
                'type' => 'text',
                'title' => __('Access token:', 'crum'),
                
                'std' => '491190981-AMje5HGKBsOBQBefYywDV1sOf0awdV095lcXFwQn',
            ),
            array(
                'id' => 'twiiter_acc_t_s',
                'type' => 'text',
                'title' => __('Access token secret:', 'crum'),
                'std' => 'T2q6Q9TfdRmubaPGqsiiFcrH1aYvCa8XNJURLgpS9wQ',
            ),
        ),
    );

                
    $tabs = array();

    if (function_exists('wp_get_theme')){
        $theme_data = wp_get_theme();
        $item_uri = $theme_data->get('ThemeURI');
        $description = $theme_data->get('Description');
        $author = $theme_data->get('Author');
        $author_uri = $theme_data->get('AuthorURI');
        $version = $theme_data->get('Version');
        $tags = $theme_data->get('Tags');
    }else{
        $theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()) . 'style.css');
        $item_uri = $theme_data['URI'];
        $description = $theme_data['Description'];
        $author = $theme_data['Author'];
        $author_uri = $theme_data['AuthorURI'];
        $version = $theme_data['Version'];
        $tags = $theme_data['Tags'];
     }
    
    $item_info = '<div class="redux-opts-section-desc">';
    $item_info .= '<p class="redux-opts-item-data description item-uri">' . __('<strong>Theme URL:</strong> ', 'crum') . '<a href="' . $item_uri . '" target="_blank">' . $item_uri . '</a></p>';
    $item_info .= '<p class="redux-opts-item-data description item-author">' . __('<strong>Author:</strong> ', 'crum') . ($author_uri ? '<a href="' . $author_uri . '" target="_blank">' . $author . '</a>' : $author) . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-version">' . __('<strong>Version:</strong> ', 'crum') . $version . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-description">' . $description . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-tags">' . __('<strong>Tags:</strong> ', 'crum') . implode(', ', $tags) . '</p>';
    $item_info .= '</div>';

    $tabs['item_info'] = array(
		'icon' => 'info-sign',
		'icon_class' => 'icon-large',
        'title' => __('Theme Information', 'crum'),
        'content' => $item_info
    );
    
    if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
        $tabs['docs'] = array(
			'icon' => 'book',
			'icon_class' => 'icon-large',
            'title' => __('Documentation', 'crum'),
            'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
        );
    }

    global $Redux_Options;
    $Redux_Options = new Redux_Options($sections, $args, $tabs);

}
add_action('init', 'setup_framework_options', 0);
/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value) {
    print_r($field);
    print_r($value);
}

	function btnL($top) {
		if($top === true) submit_button('', 'primary', '', false);
		else return false;
    }

add_action('admin_notices', 'btnL');
/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value) {
    $error = false;
    $value =  'just testing';
    /*
    do your validation
    
    if(something) {
        $value = $value;
    } elseif(somthing else) {
        $error = true;
        $value = $existing_value;
        $field['msg'] = 'your custom error message';
    }
    */
    
    $return['value'] = $value;
    if($error == true) {
        $return['error'] = $field;
    }
    return $return;
}