<?php $options = get_option( 'maestro' );
$image_crop    = isset( $options['thumb_image_crop'] );
if ( $image_crop == "" ) {
	$image_crop = true;
}
?>
<div class="entry-thumb">
	<?php
	global $post;

	$image_list = '<div class="slide-post">';

	if ( ! has_shortcode( $post->post_content, 'gallery' ) ) {

		$args        = array(
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_parent'    => $post->ID,
			'post_mime_type' => 'image',
			'post_status'    => null,
			'numberposts'    => - 1,
		);
		$attachments = get_posts( $args );


		if ( $attachments ) {


			foreach ( $attachments as $attachment ) {
				$img_url = wp_get_attachment_url( $attachment->ID ); //get img URL

				if ( $options['post_thumbnails_width'] != '' && $options['post_thumbnails_height'] != '' ) {
					$article_image = aq_resize( $img_url, $options['post_thumbnails_width'], $options['post_thumbnails_height'], $image_crop );
				} else {
					$article_image = aq_resize( $img_url, 1200, 600, true );
				}

				$image_list .= '<div><a href="' . $img_url . '" rel="prettyPhoto[pp_gal]"><img src="' . $article_image . '" alt="' . get_the_title() . '"/></a></div>';


			}
		}
	} else {
		// Retrieve the first gallery in the post
		$gallery = get_post_gallery_images( $post );

// Loop through each image in each gallery
		foreach ( $gallery as $img_url ) {

			$img_url = str_replace( '-150x150', '', $img_url );

			if ( $options['post_thumbnails_width'] != '' && $options['post_thumbnails_height'] != '' ) {
				$article_image = aq_resize( $img_url, $options['post_thumbnails_width'], $options['post_thumbnails_height'], $image_crop );
			} else {
				$article_image = aq_resize( $img_url, 1200, 600, true );
			}

			$image_list .= '<div><a href="' . $img_url . '" rel="prettyPhoto[pp_gal]"><img src="' . $article_image . '" alt="' . get_the_title() . '"/></a></div>';

		}
	}
	?>



	<?php

	$image_list .= '</div>';

	echo $image_list;

	$postid = get_the_ID(); ?>

	<script type="text/javascript">
		jQuery(document).ready(function () {
			jQuery(".post-<?php echo $postid; ?> .slide-post").orbit({
				fluid: true,
				advanceSpeed: 6000, 		 // if timer is enabled, time between transitions
				directionalNav: false
			});

		});

	</script>
</div>
