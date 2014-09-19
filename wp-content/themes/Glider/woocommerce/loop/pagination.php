<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

$options = get_option('maestro');

 if ($wp_query->max_num_pages > 1) : ?>

    <?php if ($options['crum_shop_pagination'] == '0') {?>

	 <nav class="page-nav">

        <?php next_posts_link(''); ?>

        <?php previous_posts_link(''); ?>

    </nav>

	<?php
	 }else{
		 crumin_pagination();
	 }
	?>

<?php endif; ?>