<?php
////////////////////////////////////
// DYNAMICALLY CREATE THE CSS //////
////////////////////////////////////
require_once('functions.php');


// base style for shortcode div
echo '
div.fp_sc_div {
	display: inline !important;
	margin: 0 !important;
	padding: 0 !important; 	
}
';


///////////////////////////////////////////////////
/////// CSS RULES /////////////////////////////////
///////////////////////////////////////////////////

$rules = get_option('fp'.FP_BID.'_rules');
if($rules) {
	foreach($rules as $rule) {
		
		// FONTFACE, WEBFONTS AND STANDARD CSS FONT
		if($rule['font_type'] == 'fontface' ||  $rule['font_type'] == 'webfonts' || $rule['font_type'] == 'css_font') {
			
		// font name for font-face
		($rule['font_type'] == 'fontface') ? $font_name = fp_urlToName($rule['font_name']) : $font_name = $rule['font_name'];	
			
		echo '
'.$rule['subj'].' {
	font-family: "'.$font_name.'" !important;';
	
		// font size
		if($rule['font_size'] != '') {
			echo '
		font-size: '.$rule['font_size'].$rule['font_size_type'].' !important;';	
		}
		
		// line height
		if($rule['line_height'] != '') {
			echo '
		line-height: '.$rule['line_height'].$rule['line_height_type'].' !important;';	
		}
		
		// color
		if($rule['text_color'] != '') {
			echo '
		color: '.$rule['text_color'].' !important;';	
		}
		
		// text shadow
		if($rule['shadow_x'] != '' && $rule['shadow_y'] != '' && $rule['shadow_r'] != '' && $rule['shadow_color'] != '') {
			echo '
		text-shadow: '.$rule['shadow_x'].'px '.$rule['shadow_y'].'px '.$rule['shadow_r'].'px '.$rule['shadow_color'].' !important;';		
		}
		
echo'}';				
		}
		
		// CUFON AND INHERITED
		else {
			if($rule['font_size'] != '' || $rule['line_height'] != '' || $rule['text_color'] != '' || ($rule['shadow_x'] != '' && $rule['shadow_y'] != '' && $rule['shadow_r'] != '' && $rule['shadow_color'] != '')) {
				
				echo $rule['subj'].' {';
				
				// fs
				if($rule['font_size'] != '') {
					echo 'font-size: '.$rule['font_size'].$rule['font_size_type'].' !important;	
					';	
				}
				
				// lh
				if($rule['line_height'] != '') {
					echo 'line-height: '.$rule['line_height'].$rule['line_height_type'].' !important;	
					';	
				}
				
				// color
				if($rule['text_color'] != '') {
					echo '
				color: '.$rule['text_color'].' !important;';	
				}
				
				// text shadow
				if($rule['shadow_x'] != '' && $rule['shadow_y'] != '' && $rule['shadow_r'] != '' && $rule['shadow_color'] != '') {
					echo '
				text-shadow: '.$rule['shadow_x'].'px '.$rule['shadow_y'].'px '.$rule['shadow_r'].'px '.$rule['shadow_color'].' !important;';		
				}
				
				echo '}';
			}
		}		
	}
}


/////////////////////////////////////
/////// FONTFACE GLOBAL CLASSES /////
/////////////////////////////////////

$enabled_list = get_option('fp'.FP_BID.'_font_enabled');

if($enabled_list) {
	foreach($enabled_list as $enabled) {
		
		// enabled fontface declaration
		echo fp_fontface_css_creator($enabled);
		
		// global class style
		echo '
font.fp_ff_'.$enabled.', font.fp_ff_'.$enabled.' * {
	font-family: "'.fp_urlToName($enabled).'";
}';	
	}
}


/////////////////////////////////////
/////// WEB FONTS GLOBAL CLASSES ////
/////////////////////////////////////

$enabled_list = get_option('fp'.FP_BID.'_webfonts_enabled');

if($enabled_list) {
	foreach($enabled_list as $enabled) {
		$enabled_id = fp_stringToUrl($enabled);
		
		// global class style
		echo '
font.fp_wf_'.$enabled_id.', font.fp_wf_'.$enabled_id.' * {
	font-family: "'.$enabled.'";
}';	
	} 
}


/////////////////////////////////////
/////// CUSTOM CSS //////////////////
/////////////////////////////////////

echo get_option('fp_custom_css');

?>