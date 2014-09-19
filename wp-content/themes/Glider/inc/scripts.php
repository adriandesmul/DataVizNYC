<?php
/**
 * Scripts and stylesheets
 */

if ( class_exists( 'woocommerce' ) ) {
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	}
	else {
		define( 'WOOCOMMERCE_USE_CSS', false );
	}
}

function curum_scripts() {

    $options = get_option('maestro');

    /*
     * Css styles
     */

	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style('woocommerce-css', get_template_directory_uri() . '/assets/css/woocommerce.min.css', false, null);
	}

    wp_enqueue_style('foundation', get_template_directory_uri() . '/assets/css/foundation.min.css', false, null);
    wp_enqueue_style('crum_site_style', get_template_directory_uri() . '/assets/css/app.css', false, null);


    if (isset($options['responsive_mode']) &&(($options['responsive_mode'] == 'on')||($options['responsive_mode'] == ''))) {
        wp_enqueue_style('maestro_responsive', get_template_directory_uri() . '/assets/css/responsive.css', false, null);
    }

    /**
     * Check if WooCommerce is active
     **/
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        wp_enqueue_style('crum_wocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', false, null);
    }


    wp_enqueue_style('crum_bbpress', get_template_directory_uri() . '/assets/css/bbpress.css', false, null);
    wp_enqueue_style('isotope_style', get_template_directory_uri() . '/assets/css/jquery.isotope.css', false, null);
    wp_enqueue_style('flexslider_style', get_template_directory_uri() . '/assets/css/flexslider.css', false, null);
    wp_enqueue_style('prettyphoto_style', get_template_directory_uri() . '/assets/css/prettyPhoto.css', false, null);


    if(is_multisite()) {

        $uploads = wp_upload_dir();
        $custom_style_dir = trailingslashit($uploads['baseurl']);
        wp_enqueue_style('crum_theme_options', $custom_style_dir . 'options.css', false, null);

    } else {

        wp_enqueue_style('crum_theme_options', get_template_directory_uri() . '/css/options.css?'.filemtime(get_template_directory() . '/css/options.css'), false, null);

    }



    /*
     * JS register
     */
    wp_register_script('crum_modernizr', get_template_directory_uri() . '/assets/js/modernizr.foundation.js', false, null, false);
    wp_register_script('crum_foundation', get_template_directory_uri() . '/assets/js/foundation.min.js', false, null, true);
    wp_register_script('crum_effects', get_template_directory_uri() . '/assets/js/animation.js', false, null, true);
    wp_register_script('crum_main', get_template_directory_uri() . '/assets/js/app.js', false, null, true);
    wp_register_script('isotope', ''.get_template_directory_uri().'/assets/js/jquery.isotope.min.js', false, null, true);
    wp_register_script('isotope-run', ''.get_template_directory_uri().'/assets/js/jquery.isotope.run.js', false, null, true);
    wp_register_script('cr-masonry', ''.get_template_directory_uri().'/assets/js/jquery.masonry.min.js', true, null, false);
    wp_register_script('flexslider', ''.get_template_directory_uri().'/assets/js/jquery.flexslider-min.js', false, null, true);
    wp_register_script('gmap3', ''.get_template_directory_uri().'/assets/js/gmap3.min.js', false, null, true);
    wp_register_script('prettyphoto', ''.get_template_directory_uri().'/assets/js/jquery.prettyPhoto.js', false, null, true);


    /*
     * JS enquene
     */


    wp_enqueue_script('retina');
    wp_enqueue_script('jquery');
    wp_enqueue_script('crum_foundation');
    wp_enqueue_script('crum_effects');


    wp_enqueue_script('crum_main');
    wp_enqueue_script('gmap3');
    wp_enqueue_script('jquery-color');
    wp_enqueue_script('flexslider');
    wp_enqueue_script('prettyphoto');


}

add_action('wp_enqueue_scripts', 'curum_scripts', 100);


add_action( 'admin_head', 'crum_admin_css' );

function crum_admin_css()
{
	wp_register_style( 'crum-admin-style', get_template_directory_uri() . '/assets/css/admin-panel.css' );
	wp_enqueue_style( 'crum-admin-style' );

}