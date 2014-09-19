<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'crum_page_custom_';

	$meta_boxes[] = array(
		'id'         => 'page_bg_metabox',
		'title'      => __('Boxed Page background options','crum'),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
	            'name' => __('Background color', 'crum'),
	            'desc' => __('Color of body of page (page will be set to boxed)', 'crum'),
	            'id'   => $prefix . 'bg_color',
	            'type' => 'colorpicker',
				'std'  => '#ffffff'
	        ),
            array(
                'name' => __('Fixed backrgound','crum'),
                'desc' => __('Check if you want to bg will be fixed on page scroll','crum'),
                'id'   => $prefix . 'bg_fixed',
                'type' => 'checkbox',
            ),
			array(
				'name' => __('Background image','crum'),
				'desc' => __('Upload an image or enter an URL.','crum'),
				'id'   => $prefix . 'bg_image',
				'type' => 'file',
			),
            array(
                'name'    => __('Background image repeat','crum'),
                'desc'    => '',
                'id'      => $prefix . 'bg_repeat',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'All', 'value' => 'repeat', ),
                    array( 'name' => 'Horizontally', 'value' => 'repeat-x', ),
                    array( 'name' => 'Vertically', 'value' => 'repeat-y', ),
                    array( 'name' => 'No-Repeat', 'value' => 'no-repeat', ),
                ),
            ),
		),
	);

    $meta_boxes[] = array(
        'id'         => 'blog_params',
        'title'      => __('Select Blog parameters','crum'),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_on' => array( 'key' => 'page-template', 'value' => array( 'posts-sidebar-sel.php', 'tmp-archive-left-img.php', 'tmp-archive-right-img.php', 'tmp-page-masonry-2.php', 'tmp-page-masonry.php', 'tmp-page-masonry-2-side.php' ) ),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => 'Display posts of certain category?',
                'desc' => 'Check, if you want to display posts from a certain category',
                'id'   => 'blog_sort_category',
                'type' => 'checkbox'
            ),
            array(
                'name' => 'Blog Category',
                'desc'	=> 'Select blog category',
                'id'	=> 'blog_category',
                'taxonomy' => 'category',
                'type' => 'taxonomy_multicheck',
            ),
            array (
                'name' => 'Number of posts ot display',
                'desc'	=> '',
                'id'	=> 'blog_number_to_display',
                'type'	=> 'text'
            ),
        ),
    );

    $meta_boxes[] = array(
        'id'         => 'team_metabox',
        'title'      => __('Boxed Page background options','crum'),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_on' => array( 'key' => 'page-template', 'value' => 'team-member.php' ),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => __('Member profession','crum'),
                'desc' => __('Text that will be displayed under name','crum'),
                'id' => $prefix . 'team_text',
                'type' => 'text'
            ),
            array(
                'name' => __('Small description','crum'),
                'desc' => __('Small description for Contacts page','crum'),
                'id' => $prefix . 'team_desc',
                'type' => 'textarea_code'
            ),
        ),
    );

    $meta_boxes[] = array(
        'id'         => 'cont_text_fields',
        'title'      => __('Additional Text fields','crum'),
        'pages'      => array( 'page', ), // Post type
        'show_on'    => array('key' => 'page-template', 'value' => 'page-contacts.php' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
            'name' => __('Text block 1','crum'),
            'id' =>   'contacts_page_f_1',
            'type' => 'wysiwyg',
            'options' => array(
                'wpautop' => false, // use wpautop?
                'media_buttons' => false, // show insert/upload button(s)
                'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
                'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                ),
                'std' => '<div class="contact-info"><div class="page-block-title"><h2>Contact info</h2></div><div class="contact-desc">Address: Street 9890, New Something 1234, Country <br /> Telephone: +3 (098) 12 10 777<br />Fax: +3 (098) 98 76 432<br /><br />Email: <a href="#">ouremail@planetearth.com</a><br />Twitter: <a href="#">twitter.com/envato</a><br />YouTube: <a href="#">youtube.com/envato</a><br />Facebook: <a href="#">facebook.com/envato</a><br /></div></div>'
            ),
            array(
                'name' => __('Text block 2','crum'),
                'id' =>   'contacts_page_f_2',
                'type' => 'wysiwyg',
                'options' => array(
                    'wpautop' => false, // use wpautop?
                    'media_buttons' => false, // show insert/upload button(s)
                    'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                    'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
                    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                    'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                ),
                'std' => '<div class="contact-info"><div class="page-block-title"><h2>Business hours</h2></div><div class="contact-desc">Monday: 9.00 to 18.00 <br />Tuesday: 9.00 to 18.00<br />Wednesday: 9.00 to 18.00<br />Thursday: 9.00 to 18.00<br />Friday: 9.00 to 18.00<br />Saturday: 9.00 to 15.00</div></div>',
            ),
        ),
    );


	// Add other metaboxes as needed

	return $meta_boxes;
}
