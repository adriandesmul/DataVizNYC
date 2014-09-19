<?php

	/*	
	*	---------------------------------------------------------------------
	*	Compatibility mode
	*	Set to TRUE to enable compatibility mode - [v_icon]
	*	--------------------------------------------------------------------- 
	*/

	define( 'VI_SAFE_MODE', apply_filters( 'vi_safe_mode', FALSE ) );
	
	
	/* Setup perfix */
	function crum_i_compatibility_mode() {
		$prefix = ( VI_SAFE_MODE == true ) ? 'v_' : '';
		return $prefix;
	}

	

	/*	
	*	---------------------------------------------------------------------
	*	Setup plugin
	*	--------------------------------------------------------------------- 
	*/
		
	function crum_i_plugin_init() {

		wp_register_style( 'icon-font-style', get_template_directory_uri() . '/inc/icons/css/icon-font-style.css', false, '', 'all' );
		wp_register_style( 'mnky-icon-generator', get_template_directory_uri() . '/inc/icons/css/generator.css', false, '', 'all' );
		wp_register_script( 'mnky-icon-generator', get_template_directory_uri() . '/inc/icons/js/generator.js', array( 'jquery' ), '', false );

		if ( !is_admin() ) {
		
			wp_enqueue_style( 'icon-font-style' );
			
		} elseif ( is_admin() ) {
		
			wp_enqueue_style( 'icon-font-style' );

				wp_enqueue_style( 'thickbox' );
				wp_enqueue_style( 'farbtastic' );
				wp_enqueue_style( 'mnky-icon-generator' );

				wp_enqueue_script( 'jquery' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_script( 'farbtastic' );		
				wp_enqueue_script( 'mnky-icon-generator' );
		}
	}
	
	add_action( 'init', 'crum_i_plugin_init' );
	
	
	
	/*	
	*	---------------------------------------------------------------------
	*	IE7 compatibility
	*	--------------------------------------------------------------------- 
	*/

	function crum_i_ie7() { ?>
		<!--[if lte IE 7]>
			<link href="<?php echo crum_i_plugin_url() ?>/css/ie7.min.css" media="screen" rel="stylesheet" type="text/css">
		<![endif]-->
	<?php }
	
	add_action('wp_head', 'crum_i_ie7');

	
	/*	
	*	---------------------------------------------------------------------
	*	Plugin URL
	*	--------------------------------------------------------------------- 
	*/
	
	function crum_i_plugin_url() {
		return locate_template('/inc/icons/icons.php');
    }

	/*
	*	---------------------------------------------------------------------
	*	Icon generator box
	*	---------------------------------------------------------------------
	*/

	function crum_i_generator() {

		include_once 'inc/list.php'; ?>
		<div id="mnky-generator-overlay" class="mnky-overlay-bg" style="display:none"></div>
		<div id="mnky-generator-wrap" style="display:none">
			<div id="mnky-generator">
				<a href="#" id="mnky-generator-close"><span class="mnky-close-icon"></span></a>
				<div id="mnky-generator-shell">

					<table border="0">
						<tr>
							<td class="generator-title">
								<span>Icon pack:</span>
							</td>
							<td>
								<select name="icon-pack" id="mnky-generator-select-pack">
                                    <option value=".linecons-icon-list">Linecons icons</option>
								   <option value=".fontawesome-icon-list">Font Awesome icons</option>
								   <option value=".moon-icon-list">Moon icons</option>
								   <option value=".zocial-icon-list">Zocial icons</option>
								   <option value=".loop-icon-list">Loop icons</option>

									<?php

									$uploaded_fonts = get_option('moon_fonts');
									if (is_array($uploaded_fonts)){
										foreach ($uploaded_fonts as $uploaded_font => $info){
											echo '<option value=".'.$uploaded_font.'-icon-list">'.$uploaded_font.'</option>';

										}
									}
									?>

								</select>
							</td>
						</tr>
					</table>
					
					<div class="mnky-generator-icon-select">

                        <ul class="linecons-icon-list current-menu-show">
                            <?php
                            foreach ( $crum_i_icon_list['linecons'] as $linecons_icon ) {
                                $selected_icon = ( 'linecons-adjust' == $linecons_icon ) ? ' checked' : '';
                                echo '<li><input name="name" type="radio" value="' . $linecons_icon . '" id="' . $linecons_icon . '" '. $selected_icon .' ><label for="' . $linecons_icon . '"><i class="' . $linecons_icon . '"></i></label></li>';
                            }
                            ?>
                        </ul>
						<ul class="fontawesome-icon-list">
						<?php 
						foreach ( $crum_i_icon_list['fontawesome'] as $font_awesome_icon ) {
							$selected_icon = ( 'awesome-adjust' == $font_awesome_icon ) ? ' checked' : '';
							echo '<li><input name="name" type="radio" value="' . $font_awesome_icon . '" id="' . $font_awesome_icon . '" '. $selected_icon .' ><label for="' . $font_awesome_icon . '"><i class="' . $font_awesome_icon . '"></i></label></li>';
						} 
						?>
						</ul>
						<ul class="zocial-icon-list">
						<?php 
						foreach ( $crum_i_icon_list['zocial'] as $zocial_icon ) {
							echo '<li><input name="name" type="radio" value="' . $zocial_icon . '" id="' . $zocial_icon . '"><label for="' . $zocial_icon . '"><i class="' . $zocial_icon . '"></i></label></li>';
						} 
						?>
						</ul>
						<ul class="loop-icon-list">
						<?php 
						foreach ( $crum_i_icon_list['loop'] as $loop_icon ) {
							echo '<li><input name="name" type="radio" value="' . $loop_icon . '" id="' . $loop_icon . '"><label for="' . $loop_icon . '"><i class="' . $loop_icon . '"></i></label></li>';
						} 
						?>
						</ul>
						<ul class="moon-icon-list">
						<?php 
						foreach ( $crum_i_icon_list['moon'] as $moon_icon ) {
							echo '<li><input name="name" type="radio" value="' . $moon_icon . '" id="' . $moon_icon . '"><label for="' . $moon_icon . '"><i class="' . $moon_icon . '"></i></label></li>';
						} 
						?>
						</ul>

						<?php //$uploaded_fonts = get_option('moon_fonts');
							if (is_array($uploaded_fonts)){


									foreach($uploaded_fonts as $font => $info)
									{
										$icon_set = array();
										$icons = array();
										$upload_dir = wp_upload_dir();
										$path		= trailingslashit($upload_dir['basedir']);
										$file = $path.$info['include'].'/'.$info['config'];
										include($file);
										if(!empty($icons))
										{
											$icon_set = array_merge($icon_set,$icons);
										}
										if(!empty($icon_set))
										{
											echo '<ul class="'.$font.'-icon-list">';
											foreach($icon_set as $icons)
											{
												foreach($icons as $icon)
												{
													echo '<li><input name="name" type="radio" value="'.$font.'-'.$icon['class'].'" id="'.$font.'-'.$icon['class'].'"><label for="'.$font.'-'.$icon['class'].'"><i class="icon '.$font.'-'.$icon['class'].'"></i></label></li>';
													//echo '<li title="'.$icon['class'].'" data-icon="'.$font.'-'.$icon['class'].'" data-icon-tag="'.$icon['tags'].'">';
													//echo '<i class="icon '.$font.'-'.$icon['class'].'"></i><label class="icon">'.$icon['class'].'</label></li>';
												}
											}
											echo '</ul>';
										}
									}


							}



						?>
					</div>

					<input name="mnky-generator-insert" type="submit" class="button button-primary button-large" id="mnky-generator-insert" value="Insert Icon">
				</div>
			</div>
		</div>
		
	<?php
	}

	add_action( 'admin_footer', 'crum_i_generator' );

?>