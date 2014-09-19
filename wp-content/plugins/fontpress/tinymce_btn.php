<?php
// implement tinymce button

class fp_tinymce_btn {
	function __construct() {
		add_action( 'admin_init', array( $this, 'action_admin_init' ) );
	}
	
	function action_admin_init() {
		// only hook up these filters if we're in the admin panel, and the current user has permission
		// to edit posts and pages
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter( 'mce_buttons', array( $this, 'filter_mce_button' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_mce_plugin' ) );
		}
	}
	
	function filter_mce_button( $buttons ) {
		array_push( $buttons, '|', 'fp_btn' );
		return $buttons;
	}
	
	function filter_mce_plugin( $plugins ) {
		$plugins['FontPress'] = FP_URL . '/js/tinymce_btn.js';
		return $plugins;
	}
}
$mygallery = new fp_tinymce_btn();


// enqueue the colorpicker

function fp_shortcode_scripts() {
	if(strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php')) :
	?>
    	<script src="<?php echo FP_URL; ?>/js/colorpicker/js/mColorPicker_small.js" type="text/javascript"></script>
    <?php
	endif;
	return true;
}
add_action('admin_footer', 'fp_shortcode_scripts');
?>