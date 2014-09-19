<?php

$options = get_option( 'maestro' );

global $data;

get_template_part( 'templates/top', 'page' ); ?>

<section id="layout">
	<div class="row">

		<?php  set_layout( 'pages' ); ?>

<?php
		global $post;

		$img_width  = 232;
		$img_height = 232;

		if( has_shortcode( $post->post_content, 'gallery' ) ) {
			the_content();

		} else {

			$args              = array(
				'post_type'      => 'attachment',
				'post_parent'    => $post->ID,
				'post_mime_type' => 'image',
				'post_status'    => null,
				'numberposts'    => - 1,
			);
			$attachments       = get_posts( $args );
			$attachments_count = '0';
			if ( $attachments ) {
				foreach ( $attachments as $attachment ) {

					$img_url = wp_get_attachment_url( $attachment->ID ); //get img URL
					$attachments_count ++;

					?>

					<a href="<?php echo $img_url; ?>" rel="prettyPhoto[pp_gal]">
						<img src="<?php echo aq_resize( $img_url, $img_width, $img_height, true ); ?>"
						     alt="<?php the_title(); ?>"/>
					</a>

				<?php
				}
			}} ?>

		<?php
		set_layout( 'pages', false );

		?>

	</div>
</section>