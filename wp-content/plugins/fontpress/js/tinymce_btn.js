// closure to avoid namespace collision
(function(){
	// creates the plugin
	tinymce.create('tinymce.plugins.FontPress', {
		// creates control instances based on the control's id.
		// our button's id is "PrivateContent_button"
		createControl : function(id, controlManager) {
			if (id == 'fp_btn') {
				// creates the button
				var button = controlManager.createButton('fp_btn', {
					title : 'FontPress Shortcode', // title of the button
					image : '../wp-content/plugins/fontpress/img/fp_icon_tinymce.png',  // path to the button's image
					onclick : function() {
						tb_show( 'FontPress Shortcode', '#TB_inline?width=380&height=420&inlineId=fontpress-form' );
					}
				});
				return button;
			}
			return null;
		}
	});
	
	// registers the plugin. DON'T MISS THIS STEP!!!
	tinymce.PluginManager.add('FontPress', tinymce.plugins.FontPress);
	
	H = 450;
	W = 400;
	
	// resize and center
	jQuery('body').delegate('#content_fp_btn', "click", function () {
		jQuery('#TB_window').css("height", H);
    	jQuery('#TB_window').css("width", W);	
		
		jQuery('#TB_window').css("top", ((jQuery(window).height() - H) / 4) + 'px');
   		jQuery('#TB_window').css("left", ((jQuery(window).width() - W) / 4) + 'px');
		jQuery('#TB_window').css("margin-top", ((jQuery(window).height() - H) / 4) + 'px');
		jQuery('#TB_window').css("margin-left", ((jQuery(window).width() - W) / 4) + 'px');
	});
	jQuery(window).resize(function() {
		if(jQuery('#fp_tinymce_table').is(':visible')) {
			jQuery('#fp_tinymce_table').parent().parent().css("height", H);
			jQuery('#fp_tinymce_table').parent().parent().css("width", W);	
			
			jQuery('#fp_tinymce_table').parent().parent().css("top", ((jQuery(window).height() - H) / 4) + 'px');
			jQuery('#fp_tinymce_table').parent().parent().css("left", ((jQuery(window).width() - W) / 4) + 'px');
			jQuery('#fp_tinymce_table').parent().parent().css("margin-top", ((jQuery(window).height() - H) / 4) + 'px');
			jQuery('#fp_tinymce_table').parent().parent().css("margin-left", ((jQuery(window).width() - W) / 4) + 'px');
		}
	});
	
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('\
		<div id="fontpress-form">\
			<table id="fp_tinymce_table" class="form-table">\
			<tr>\
				<td style="width: 30%;"><label for="fp-font-type">Font Type</label></td>\
				<td>\
				  <select id="fp_font_type" style="width: 204px;">\
				  	<option value="css_font">Standard CSS Font</option>\
					<option value="cufon">Cufons</option>\
					<option value="webfonts">Web Fonts</option>\
					<option value="fontface">Font-Face Fonts</option>\
					<option value="inherited">Inherited Font</option>\
				  </select>\
				</td>\
			</tr>\
			<tr>\
				<td style="width: 30%;"><label for="fp-font-name">Font Name</label></td>\
				<td id="fp_font_name"><input type="text" id="fp-font-name" name="fp-font-name" size="26" /></td>\
			</tr>\
			<tr>\
				<td style="width: 30%;"><label for="fp-font-size">Font Size</label></td>\
				<td>\
					<input type="text" id="fp-font-size" name="fp-font-size" size="19" />\
					<select name="fp-font-size-ms" id="fp-font-size-ms">\
						<option value="px">px</option>\
						<option value="%">%</option>\
						<option value="em">em</option>\
					</select>\
				</td>\
			</tr>\
			<tr>\
				<td style="width: 30%;"><label for="fp-line-height">Line Height</label></td>\
				<td>\
					<input type="text" id="fp-line-height" name="fp-line-height" size="19" />\
					<select name="fp-line-height-ms" id="fp-line-height-ms">\
						<option value="px">px</option>\
						<option value="%">%</option>\
						<option value="em">em</option>\
					</select>\
				</td>\
			</tr>\
			<tr>\
				<td style="width: 30%;"><label for="fp-color">Text Color</label></td>\
				<td><input type="color" id="fp-color" name="fp-color" size="23" data-hex="true" /></td>\
			</tr>\
			<tr>\
				<td style="width: 30%;"><label>Text Shadow</label></td>\
				<td>\
					<label>X</label>\
					<input type="text" id="shadow_x" name="shadow_x" size="2" />\
					<label style="padding-left: 24px;">Y</label>\
					<input type="text" id="shadow_y" name="shadow_y" size="2" />\
					<label style="padding-left: 24px;">R</label>\
					<input type="text" id="shadow_r" name="shadow_r" size="2" /><br/>\
					<input type="color" id="fp-shadow-color" name="fp-shadow-color" size="23" style="margin-top: 12px;" />\
				</td>\
			</tr>\
			<tr class="tbl_last">\
				<td colspan="2"><input type="button" id="fp-submit" class="button-primary" value="Insert" name="submit" /></td>\
			</tr>\
		</table>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		jQuery('#fp-shadow-color, #fp-color').mColorPicker();
		
		// font list ajax
		jQuery('body').delegate('#fp_tinymce_table #fp_font_type', "change", function() {
			var sel_font = jQuery(this).val();
			
			if(sel_font != 'css_font' && sel_font != 'inherited') {
				jQuery('#fp_font_name').html('<span class="lcwp_loading"></span>');
				var data = {
					action: 'fp_get_font_type_tinymce',
					font_type: sel_font
				};
			
				jQuery.post(ajaxurl, data, function(response) {
					jQuery('#fp_font_name').html(response);
				});
			}
			else if(sel_font == 'css_font') {
				jQuery('#fp_font_name').html('<input type="text" id="fp-font-name" name="fp-font-name" size="26" />');
			}
			else {
				jQuery('#fp_font_name').html('<input type="hidden" id="fp-font-name" name="fp-font-name" value="inherited" />');	
			}
		});
		
		///// submit
		
		form.find('#fp-submit').click(function(){
			// get values
			var font_type		= jQuery('#fp_tinymce_table #fp_font_type').val();
			var font_name 		= jQuery('#fp_tinymce_table #fp-font-name').val();
			var font_size 		= jQuery('#fp_tinymce_table #fp-font-size').val();
			var font_size_ms 	= jQuery('#fp_tinymce_table #fp-font-size-ms').val();
			var line_height 	= jQuery('#fp_tinymce_table #fp-line-height').val();
			var line_height_ms 	= jQuery('#fp_tinymce_table #fp-line-height-ms').val();
			var color 			= jQuery('#fp_tinymce_table #fp-color').val();		
			var shadow_x		= jQuery('#fp_tinymce_table #shadow_x').val();
			var shadow_y		= jQuery('#fp_tinymce_table #shadow_y').val();	
			var shadow_r		= jQuery('#fp_tinymce_table #shadow_r').val();	
			var shadow_col		= jQuery('#fp_tinymce_table #fp-shadow-color').val();		
			
			if(jQuery.trim(font_name) != '') {
				
				if(jQuery.trim(font_type) != 'inherited') { var sc = '[fontpress type="'+ font_type +'" name="'+ font_name +'"'; }
				else {var sc = '[fontpress type="'+ font_type +'"';}
				
				if(jQuery.trim(font_size) != '') {
					sc = sc + ' size="'+ jQuery.trim(font_size) + font_size_ms +'"';	
				}
				
				if(jQuery.trim(line_height) != '') {
					sc = sc + ' lh="'+ jQuery.trim(line_height) + line_height_ms +'"';	
				}
				
				if(jQuery.trim(color) != '') {
					sc = sc + ' color="'+ jQuery.trim(color) +'"';	
				}
				
				if(jQuery.trim(shadow_x) != '' && jQuery.trim(shadow_y) != '' && jQuery.trim(shadow_r) != '' && jQuery.trim(shadow_col) != '') {
					sc = sc + ' shadow="'+ jQuery.trim(shadow_x) +'_'+ jQuery.trim(shadow_y) +'_'+ jQuery.trim(shadow_r) +'_'+ jQuery.trim(shadow_col)+'"';	
				}
				
				sc = sc + '] [/fontpress]';
				
				// inserts the shortcode into the active editor
				tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sc);
				
				// closes Thickbox
				tb_remove();
			}
		});
	});
})()

