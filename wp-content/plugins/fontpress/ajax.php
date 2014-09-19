<?php

////////////////////////////////////////////////
////// ADD BASIC RULE BLOCK ////////////////////
////////////////////////////////////////////////

function fp_add_rule_php() {
	require_once(FP_DIR.'/functions.php');
	echo fp_rule_row_form('basic_row');
	die();	
}
add_action('wp_ajax_fp_add_rule', 'fp_add_rule_php');


////////////////////////////////////////////////
////// GET FONT TYPE SELECT ////////////////////
////////////////////////////////////////////////

function fp_get_font_type_php() {
	require_once(FP_DIR.'/functions.php');
	$font_type = trim(addslashes($_POST['font_type']));
	
	echo '<select name="font_name[]">'.
		fp_get_enabled_fonts($font_type).
		'</select>';
	die();	
}
add_action('wp_ajax_fp_get_font_type', 'fp_get_font_type_php');


////////////////////////////////////////////////
////// GET FONT TYPE SELECT  FOR TINYMCE ///////
////////////////////////////////////////////////

function fp_get_font_type_tinymce_php() {
	require_once(FP_DIR.'/functions.php');
	$font_type = trim(addslashes($_POST['font_type']));
	
	echo '<select id="fp-font-name" name="fp-font-name" style="width: 204px;">'.
		fp_get_enabled_fonts($font_type).
		'</select>';
	die();	
}
add_action('wp_ajax_fp_get_font_type_tinymce', 'fp_get_font_type_tinymce_php');


////////////////////////////////////////////////
////// GET FONT SIZE TYPE SELECT ///////////////
////////////////////////////////////////////////

function fp_get_font_size_type_php() {
	require_once(FP_DIR.'/functions.php');
	echo fp_get_fontsize_types('html');
	die();	
}
add_action('wp_ajax_fp_get_font_size_type', 'fp_get_font_size_type_php');


////////////////////////////////////////////////
////// REMOVE WEB FONT /////////////////////////
////////////////////////////////////////////////

// php handler
function fp_delete_webfont_php() {
	require_once(FP_DIR.'/functions.php');

	$font_id = trim(addslashes($_POST['font_id'])); 
	$webfont_array = get_option('fp_webfonts');
	
	foreach($webfont_array as $wf_name => $wf_url) {
		$wf_name_id = fp_stringToUrl($wf_name);
		
		if($wf_name_id == $font_id) {
			$to_remove = $wf_name;
			$success = true;
			unset($webfont_array[$wf_name]);
			break;	
		}
	}
	
	if(isset($success)) {
		fp_remove_enabled($to_remove, 'fp_webfonts_enabled');
		update_option('fp_webfonts', $webfont_array);
		
		echo 'success';
	}
	else {echo 'error';}
	die();	
}
add_action('wp_ajax_fp_delete_webfont', 'fp_delete_webfont_php');


// jquery trigger
function fp_delete_webfont_js() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
	jQuery('.fp_del_webfont').click(function() {
		var font_id = jQuery(this).attr('id').substr(4);
		var font_name = jQuery('#fn_' + font_id).html();
		
		if(confirm('<?php _e('Delete permanently the font', 'fp_ml') ?> ' + font_name +'?')) {
			var data = {
				action: 'fp_delete_webfont',
				font_id: font_id
			};
			
			jQuery.post(ajaxurl, data, function(response) {
				if( jQuery.trim(response) == 'success') {
					jQuery('#del_' + font_id).parent().slideUp(function() {
						jQuery(this).remove();
					});
				}
				else {
					console.log(response);
					alert('<?php _e('Error during font deletion'); ?>');
				}
			});	
		}
	});
});
</script>
<?php
}
add_action('admin_head', 'fp_delete_webfont_js');



////////////////////////////////////////////////
////// REMOVE CUFON ////////////////////////////
////////////////////////////////////////////////

// php handler
function fp_delete_cufon_php() {
	require_once(FP_DIR.'/functions.php');
	
	$font_id = trim(addslashes($_POST['font_id'])); 
	$cufon_list = fp_cufon_list();
	
	foreach($cufon_list as $c_name=>$c_path) {
		$c_name_id = fp_stringToUrl($c_name);
		
		if($c_name_id == $font_id && file_exists(FP_DIR.'/cufon/'.$c_path)) {
			$to_remove = $c_name;
			$success = true;
			unlink(FP_DIR.'/cufon/'.$c_path);
			break;	
		}
	}
	
	if(isset($success)) {
		fp_remove_enabled($to_remove, 'fp_cufon_enabled');
		echo 'success';
	}
	else {echo 'error';}
	die();	
}
add_action('wp_ajax_fp_delete_cufon', 'fp_delete_cufon_php');


// jquery trigger
function fp_delete_cufon_js() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
	jQuery('.fp_del_cufon').click(function() {
		var font_id = jQuery(this).attr('id').substr(4);
		var font_name = jQuery('#fn_' + font_id).html();
		
		if(confirm('<?php _e('Delete permanently the font', 'fp_ml') ?> ' + font_name +'?')) {
			var data = {
				action: 'fp_delete_cufon',
				font_id: font_id
			};
			
			jQuery.post(ajaxurl, data, function(response) {
				if( jQuery.trim(response) == 'success') {
					jQuery('#del_' + font_id).parent().slideUp(function() {
						jQuery(this).remove();
					});
				}
				else {
					console.log(response);
					alert('<?php _e('Error during font deletion'); ?>');
				}
			});	
		}
	});
});
</script>
<?php
}
add_action('admin_head', 'fp_delete_cufon_js');



////////////////////////////////////////////////
////// REMOVE FONTFACE /////////////////////////
////////////////////////////////////////////////

// php handler
function fp_delete_fontface_php() {
	require_once(FP_DIR.'/functions.php');
	
	$font_id = addslashes($_POST['font_id']); 
	$font_list = fp_font_list();
	
	foreach($font_list as $f_name=>$f_path) {
		$f_name_id = fp_stringToUrl($f_name);
		
		if($f_name_id == $font_id && file_exists(FP_DIR.'/fonts/'.$f_path)) {
			$to_remove = $f_name;
			$success = true;
			fp_remove_folder(FP_DIR.'/fonts/'.$f_path);
			break;	
		}
	}
	
	if(isset($success)) {
		fp_remove_enabled($to_remove, 'fp_font_enabled');
		echo 'success';
	}
	else {echo 'error';}
	die();	
}
add_action('wp_ajax_fp_delete_fontface', 'fp_delete_fontface_php');


// jquery trigger
function fp_delete_fontface_js() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
	jQuery('.fp_del_fontface').click(function() {
		var font_id = jQuery(this).attr('id').substr(4);
		var font_name = jQuery('#fn_' + font_id).html();
		
		if(confirm('<?php _e('Delete permanently the font', 'fp_ml') ?> ' + font_name +'?')) {
			var data = {
				action: 'fp_delete_fontface',
				font_id: font_id
			};
			
			jQuery.post(ajaxurl, data, function(response) {
				if( jQuery.trim(response) == 'success') {
					jQuery('#del_' + font_id).parent().slideUp(function() {
						jQuery(this).remove();
					});
				}
				else {
					console.log(response);
					alert('<?php _e('Error during font deletion'); ?>');
				}
			});	
		}
	});
});
</script>
<?php
}
add_action('admin_head', 'fp_delete_fontface_js');



?>