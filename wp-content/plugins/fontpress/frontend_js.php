<?php
///////////////////////////////////////////
// DYNAMICALLY CREATE THE JAVASCRIPT //////
///////////////////////////////////////////
require_once('functions.php');

/////////////////////////////////////
/////// CUFON RULES /////////////////
/////////////////////////////////////
$rules = get_option('fp'.FP_BID.'_rules');
if($rules) {
	foreach($rules as $rule) {
		if($rule['font_type'] == 'cufon') {
			
			echo 'Cufon.replace("'.$rule['subj'].'", {fontFamily : "'.$rule['font_name'].'"});
			';			
		}
	}
}


/////////////////////////////////////
/////// CUFON GLOBAL CLASSES ////////
/////////////////////////////////////
$enabled_list = get_option('fp'.FP_BID.'_cufon_enabled');
$cf_list = fp_cufon_list();

if($enabled_list) {
	foreach($enabled_list as $enabled) {
		$enabled_id = fp_stringToUrl($enabled);
		
		// global class js
		echo 'Cufon.replace("font.fp_cf_'.$enabled_id.', font.fp_cf_'.$enabled_id.' *", {fontFamily : "'.$enabled.'"});
		'; 
	}
}

?>