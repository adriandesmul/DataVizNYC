<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'crum_headers_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

function crum_headers_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'crum_headers_';

	$meta_boxes[] = array(
		'id'         => 'header_img_metabox',
		'title'      => __('Page header background','crum'),
		'pages'      => array( 'page','post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
	            'name' => 'Background image',
	            'desc' => __('Select image pattern for header background','crum'),
	            'id'   => $prefix . 'bg_img',
                'type' => 'file',
                'save_id' => false, // save ID using true
				'std'  => ''
	        ),
            array(
                'name' => 'Background color',
                'desc' => __('Select color for header background','crum'),
                'id'   => $prefix . 'bg_color',
                'type' => 'colorpicker',
                'save_id' => false, // save ID using true
                'std'  => ''
            ),
		),
	);

	$meta_boxes[] = array(
		'id'      => 'stun_header_select',
		'title'   => __('Stuning header','crum'),
		'pages'   => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_on' => array( 'key' => 'page-template', 'value' => array( 'large-right-aside.php' ) ),
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Display stunning header',
				'desc' => __('Check to display stunning hader','crum'),
				'id'   => 'crum_stun_head',
				'type' => 'checkbox',
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}
