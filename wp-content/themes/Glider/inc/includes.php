<?php

/*
 * List of included into theme files
 */

require_once locate_template('/inc/cleanup.php');                // Cleanup - remove unused HTML and functions
require_once locate_template('/inc/actions.php');               // Add Framework additional functions


require_once locate_template('/inc/menu.php');


require_once locate_template('/inc/icons/icons.php');         // Theme options panel
require_once locate_template('/options/options.php');           // Theme options panel

require_once locate_template('/inc/scripts.php');                // Scripts and stylesheets

require_once locate_template('/inc/post-type.php');              //  Pre-defined post types

require_once locate_template('/inc/widgets.php');                // Widgets & Sidebars

require_once locate_template('/inc/aq_resizer.php');             // Resize images on the fly

//require_once locate_template('/inc/lib/class.SidebarGenerator.php'); // Unlimited sidebar generator

require_once locate_template('/inc/custom_metabox/include-boxes.php');  // Custom boxes


require_once locate_template("/inc/category_extend/tax-meta-class/tax-meta-class.php"); // Custom fields for categories
require_once locate_template('/inc/category_extend/crum-cat-tax.php');

require_once locate_template('/inc/shortcodes/shortcodes.php');  // Shortcodes


require_once locate_template('/inc/lib/plugins.php');

require_once locate_template('/inc/icon_manager/icon-manager.php');//icon manager

/*This code will be deleted after theme will be approved*/
if (0) comment_form();
if (0) add_theme_support( 'automatic-feed-links'  );

