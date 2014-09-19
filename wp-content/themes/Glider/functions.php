<?php
/**
 * Crumina themes functions
 */

/*Including other theme components*/

require_once locate_template('/inc/includes.php');


/**
 * Theme Wrapper
 *
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */

function crum_template_path() {
	return Crum_Wrapping::$main_template;
}

function crum_template_base() {
	return Crum_Wrapping::$base;
}


class Crum_Wrapping {

	/**
     * Stores the full path to the main template file
     */
	static $main_template;

	/**
     * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
     */
	static $base;

	static function wrap( $template ) {
		self::$main_template = $template;

		self::$base = substr( basename( self::$main_template ), 0, -4 );

		if ( 'index' == self::$base )
		self::$base = false;

		$templates = array( 'base.php' );

		if ( self::$base )
		array_unshift( $templates, sprintf( 'base-%s.php', self::$base ) );

		return locate_template( $templates );
	}
}

add_filter( 'template_include', array( 'Crum_Wrapping', 'wrap' ), 99 );

// returns WordPress subdirectory if applicable

function wp_base_dir()
{
	preg_match('!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches);
	if (count($matches) === 3) {
		return end($matches);
	} else {
		return '';
	}
}

// opposite of built in WP functions for trailing slashes

function leadingslashit($string)
{
	return '/' . unleadingslashit($string);
}

function unleadingslashit($string)
{
	return ltrim($string, '/');
}

function add_filters($tags, $function)
{
	foreach ($tags as $tag) {
		add_filter($tag, $function);
	}
}

function is_element_empty($element)
{
	$element = trim($element);
	return empty($element) ? false : true;
}

// Limit content function

function content($num)
{
	$theContent = get_the_excerpt();
	if($theContent == ''){
		$theContent = get_the_content();
	}

	$output = preg_replace('/<img[^>]+./', '', $theContent);
	$output = preg_replace('/<blockquote>.*<\/blockquote>/', '', $output);
	$output = preg_replace('|\[(.+?)\](.+?\[/\\1\])?|s', '', $output);
	$output = strip_tags($output);
	$limit = $num + 1;
	$content = explode(' ', $output, $limit);
	array_pop($content);
	$content = implode(" ", $content) . "...";
	echo $content;
}

/* Theme setup options*/


// Make theme available for translation
load_theme_textdomain('crum', get_template_directory() . '/lang');

// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
register_nav_menus(array(
'primary_navigation' => __('Primary Navigation', 'crum'),
'footer_menu' => __('Footer navigation', 'crum'),
));

// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
add_theme_support('post-thumbnails');


// Add post formats (http://codex.wordpress.org/Post_Formats)

add_theme_support('post-formats', array('gallery', 'video'));

// Tell the TinyMCE editor to use a custom stylesheet

add_editor_style('assets/css/editor-style.css');


add_action( 'after_setup_theme', 'the_theme_setup' );
function the_theme_setup()
{
	// First we check to see if our default theme settings have been applied.
	$the_theme_status = get_option( 'crum_theme_setup_status' );
	// If the theme has not yet been used we want to run our default settings.
	if ( $the_theme_status !== '1' ) {
		// Setup Default WordPress settings
		$core_settings = array(
		'avatar_rating' => 'G',
		'default_role' => 'author',
		'comments_per_page' => 20
		);
		foreach ( $core_settings as $k => $v ) {
			update_option( $k, $v );
		}

		// Delete dummy post, page and comment.
		wp_delete_post( 1, true );
		wp_delete_post( 2, true );
		wp_delete_comment( 1 );

		// Once done, we register our setting to make sure we don't duplicate everytime we activate.
		update_option( 'crum_theme_setup_status', '1' );

		/*
		* Dummy menu
		*/

		if (!has_nav_menu('primary_navigation')) {
			$primary_nav_id = wp_create_nav_menu('Primary Navigation', array('slug' => 'primary_navigation'));
			$roots_nav_theme_mod['primary_navigation'] = $primary_nav_id;
		}

		$primary_nav = wp_get_nav_menu_object('Primary Navigation');
		$primary_nav_term_id = (int)$primary_nav->term_id;
		$menu_items = wp_get_nav_menu_items($primary_nav_term_id);
		if (!$menu_items || empty($menu_items)) {
			$pages = get_pages();
			foreach ($pages as $page) {
				$item = array(
				'menu-item-object-id' => $page->ID,
				'menu-item-object' => 'page',
				'menu-item-type' => 'post_type',
				'menu-item-status' => 'publish'
				);
				wp_update_nav_menu_item($primary_nav_term_id, 0, $item);
			}
		}


		/*
		* Create Page with help information on theme activation
		*/
/*

		$default_pages = array('Help');
		$existing_pages = get_pages();
		$temp = array();

		foreach ($existing_pages as $page) {
			$temp[] = $page->post_title;
		}

		$pages_to_create = array_diff($default_pages, $temp);
		$page_demo = <<<EOD

EOD;
		foreach ($pages_to_create as $new_page_title) {
			$add_default_pages = array(
			'post_title' => $new_page_title,
			'post_content' => $page_demo,
			'post_status' => 'publish',
			'post_type' => 'page'
			);

			$result = wp_insert_post( $add_default_pages );
		}


		$home = get_page_by_title('Help');
		update_option('show_on_front', 'page');
		update_option('page_on_front', $home->ID);


		$home_menu_order = array(
		'ID' => $home->ID,
		'menu_order' => -1
		);
		wp_update_post($home_menu_order);



*/

	}
	// Else if we are re-activing the theme
	elseif ( $the_theme_status === '1' and isset( $_GET['activated'] ) ) {

	}
}


add_filter('widget_text', 'do_shortcode');

add_post_type_support('page', 'excerpt');

// Change number or products per row to 3

add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return 3; // 3 products per row
    }
}
// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
    woocommerce_related_products(3,3); // Display 3 products in rows of 3
}

/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'yourtheme_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */
function yourtheme_woocommerce_image_dimensions() {
    $catalog = array(
        'width' 	=> '280',	// px
        'height'	=> '280',	// px
        'crop'		=> 1 		// true
    );

    $single = array(
        'width' 	=> '430',	// px
        'height'	=> '600',	// px
        'crop'		=> 0 		// true
    );

    $thumbnail = array(
        'width' 	=> '120',	// px
        'height'	=> '120',	// px
        'crop'		=> 0 		// false
    );

    // Image sizes
    update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
    update_option( 'shop_single_image_size', $single ); 		// Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

/**
 * Enqueue the Souce sans font.
 */
function crumina_enq_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'glider_source_sans', "$protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic,700italic&subset=latin,latin-ext");
}

add_action( 'wp_enqueue_scripts', 'crumina_enq_fonts' );

function custom_excerpt_length( $length ) {
    return 42;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


add_filter('next_posts_link_attributes', 'posts_link_attributes_1');

add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');


function posts_link_attributes_1() {
    return 'class="older"';
}
function posts_link_attributes_2() {
    return 'class="newer"';
}


/*---------------------------------------------------------
 *   init Mega menu
 ---------------------------------------------------------*/

if (!defined('CRUM_MEGA_MENU_CLASS')) define('CRUM_MEGA_MENU_CLASS', 'Crum_Mega_menu');
 if (!defined('CRUM_EDIT_MENU_WALKER_CLASS')) define('CRUM_EDIT_MENU_WALKER_CLASS', 'Crum_Edit_Menu_Walker');
 if (!defined('CRUM_NAV_MENU_WALKER_CLASS')) define('CRUM_NAV_MENU_WALKER_CLASS', 'Crum_Nav_Menu_Walker');

 if (!function_exists('crum_mega_menu_init')) {
		function crum_mega_menu_init() {
				require_once locate_template('inc/menu/edit_mega_menu_walker.php');
				require_once locate_template('inc/menu/mega_menu.php');

				$class = CRUM_MEGA_MENU_CLASS;
				$mega_menu = new $class();
			}
}

add_action('after_setup_theme', 'crum_mega_menu_init');


/*---------------------------------------------------------
 *   Check theme perfomance
 ---------------------------------------------------------*/


function performance( $visible = false ) {
    $stat = sprintf(  '%d queries in %.3f seconds, using %.2fMB memory',
        get_num_queries(),
        timer_stop( 0, 3 ),
        memory_get_peak_usage() / 1024 / 1024
    );
    echo $visible ? $stat : "<!-- {$stat} -->" ;
}
add_action( 'wp_footer', 'performance', 20 );



/*---------------------------------------------------------
 *   For theme validator
 ---------------------------------------------------------*/

if ( ! isset( $content_width ) ) $content_width = 900;

function crum_custom_dynamic_sidebar($name='Default Sidebar'){
	if(function_exists('dynamic_sidebar') && dynamic_sidebar($name)) :
	endif;
	return true;
}

function crum_vc_add_admin_fonts()
{
	$paths = wp_upload_dir();
	$paths['fonts'] = 'moon_fonts';
	$paths['fonturl'] = trailingslashit($paths['baseurl']) . $paths['fonts'];

	$fonts = get_option('moon_fonts');
	if (is_array($fonts)) {
		foreach ($fonts as $font => $info) {
			$style_url = $info['style'];
			if (strpos($style_url, 'http://') !== false) {
				wp_enqueue_style('crumina-font-' . $font, $info['style']);
			} else {
				wp_enqueue_style('crumina-font-' . $font, trailingslashit($paths['fonturl']) . $info['style']);
			}
		}
	}
}

add_action('admin_enqueue_scripts', 'crum_vc_add_admin_fonts');

function crum_vc_add_front_fonts()
{
	$paths = wp_upload_dir();
	$paths['fonts'] = 'moon_fonts';
	$paths['fonturl'] = trailingslashit($paths['baseurl']) . $paths['fonts'];

	$fonts = get_option('moon_fonts');
	if (is_array($fonts)) {
		foreach ($fonts as $font => $info) {
			$style_url = $info['style'];
			if (strpos($style_url, 'http://') !== false) {
				wp_enqueue_style('crumina-font-' . $font, $info['style']);
			} else {
				wp_enqueue_style('crumina-font-' . $font, trailingslashit($paths['fonturl']) . $info['style']);
			}
		}
	}
}

add_action('wp_enqueue_scripts', 'crum_vc_add_front_fonts');