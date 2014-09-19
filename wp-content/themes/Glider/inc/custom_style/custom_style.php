<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/custom_style/assets/stylechanger.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/custom_style/assets/stylechanger.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/custom_style/assets/colorpicker/farbtastic.css">

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/custom_style/assets/farbtastic.js"></script>


<?php
/*
function wpa82718_scripts() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script(
        'iris',
        admin_url( 'js/iris.min.js' ),
        array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
        false,
        1
    );
    wp_enqueue_script(
        'wp-color-picker',
        admin_url( 'js/color-picker.min.js' ),
        array( 'iris' ),
        false,
        1
    );
    $colorpicker_l10n = array(
        'clear' => __( 'Clear' ),
        'defaultString' => __( 'Default' ),
        'pick' => __( 'Select Color' )
    );
    wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );

}
add_action( 'wp_enqueue_scripts', 'wpa82718_scripts', 100 );
*/


$pattern_dir_path = get_template_directory().'/inc/custom_style/assets/img/body/';
$pattern_dir_url = get_template_directory_uri().'/inc/custom_style/assets/img/thumb/';
$pattern_dir = opendir ($pattern_dir_path);


$foot_pattern_dir_path = get_template_directory().'/inc/custom_style/assets/foot/';
$foot_pattern_dir_url = get_template_directory_uri().'/inc/custom_style/assets/foot/thumb/';
$foot_pattern_dir = opendir ($foot_pattern_dir_path);

$img_path = get_template_directory_uri().'/assets/stylechanger/';
echo '<script> var customStyleImgUrl = "'.$img_path.'";</script>';



$image_patterns = array();
while($file = readdir($pattern_dir)){
    if(is_image($pattern_dir_path.$file)){
        $image_patterns[] = $file;
    }
}

$footer_patterns = array();
while($file = readdir($foot_pattern_dir)){
    if(is_image($foot_pattern_dir_path.$file)){
        $footer_patterns[] = $file;
    }
}

//Checks is current file is image
function is_image($path){
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    if( ($extension == 'jpg') || ($extension == 'png') || ($extension == 'gif') ){
        return true;
    }
    else
        return false;
}
function insert_patterns_block( $image_patterns ){

    echo '<ul class="drop_list">';
    foreach($image_patterns as $image_pattern){
        echo '<li><a href="#"  class="pattern-example pic"><img src = "'. get_template_directory_uri().'/inc/custom_style/assets/img/thumb/'.$image_pattern.'" alt = "" /></a></li>';
    }
    echo '</ul>';
} ?>

<div class="style_changer">
    <a href="#" class="changer_button"></a>

    <a href="#" class="ch_button load-def">Load defaults</a>

    <div class="changer_content">

        <div class="fl">
            <div class="select_layout text_drop drop_list_wrap drop_top">
                <a href="#" class="drop_link">
                    <span class="drop_link_in">Change layout</span>
                    <span class="drop_arrow"><span class="drop_divider"></span></span>
                </a>
                <ul class="drop_list">
                    <li><a class="template-option" href = "http://theme.crumina.net/glider/">Corporate</a></li>
                    <li><a class="template-option" href = "http://theme.crumina.net/glider/layout-2/">Business</a></li>
                    <li><a class="template-option" href = "http://theme.crumina.net/glider/layout-3/">Industrial</a></li>
                    <li><a class="template-option" href = "http://theme.crumina.net/glider/layout-4/">Fundamental</a></li>
                    <li><a class="template-option" href = "http://theme.crumina.net/glider/layout-5/">Commercial</a></li>
                    <li><a class="template-option" href = "http://theme.crumina.net/glider/layout-6/">Stylish</a></li>
                    <li><a class="template-option" href = "http://theme.crumina.net/glider/magazine/">Magazine</a></li>
                </ul>
            </div>

        </div>

        <div class="fl" style="height: 40px">
            <div class="boxed_wrap">
                <div class="check_wrap">
                    <input type="checkbox" id="boxed_layout"  />
                    <label for="boxed_layout" class="boxed_layout">Boxed</label>

                    <input type="checkbox" id="wide_layout"  />
                    <label for="wide_layout" class="wide_layout active">Wide</label>



                </div>
            </div>
            <div class="boxed_bg drop_list_wrap">
                <a href="#" class="drop_link">
                    <span class="drop_link_in">Change Boxed</span>
                    <span class="ch_picker"></span>
                    <span class="drop_arrow"><span class="drop_divider"></span></span>
                </a>
                    <?php insert_patterns_block( $image_patterns ) ?>
            </div>
        </div>


        <div class="fl">

            <div class="body_bg drop_list_wrap drop_top">
                <a href="#" class="drop_link">
                    <span class="drop_link_in">Change body bg</span>
                    <span class="ch_picker color"></span>
                    <span class="drop_arrow"><span class="drop_divider"></span></span>
                </a>
                <?php insert_patterns_block( $image_patterns ) ?>
            </div>
        </div>

        <div class="fl">

            <div class="texture_bg drop_list_wrap drop_top">
                <a href="#" class="drop_link">
                    <span class="drop_link_in">Change footer</span>
                    <span class="ch_picker color"></span>
                    <span class="drop_arrow"><span class="drop_divider"></span></span>
                </a>
                    <?php insert_patterns_block( $footer_patterns ) ?>
            </div>
        </div>

        <div class="color_scheme_wrap">
            <p>Color scheme: </p>
            <a href="#" class="first_color">1st color<span class="round_color"></span></a>
            <a href="#" class="second_color">2st color<span class="round_color"></span></a>
        </div>
        <div class="cl"></div>
    </div>
    <div id="custom-style-colorpicker"></div>

</div>

<style type="text/css" id="font_color_1"></style>
<style type="text/css" id="font_color_2"></style>