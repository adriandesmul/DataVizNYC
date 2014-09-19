<?php
/*
 * Pages layout select function
 */


function set_layout( $page, $open = true ) {
	$options = get_option( 'maestro' );
	$page    = $options[$page . "_layout"];

	if ( $page == "1col-fixed" ) {
		$cr_layout = '';
		$cr_width  = 'twelve';
	}
	if ( $page == "3c-l-fixed" ) {
		$cr_layout = 'sidebar-left2';
		$cr_width  = 'six';
	}
	if ( $page == "3c-r-fixed" ) {
		$cr_layout = 'sidebar-right2';
		$cr_width  = 'six';
	}
	if ( $page == "2c-l-fixed" ) {
		$cr_layout = 'sidebar-left';
		$cr_width  = 'nine';
	}
	if ( $page == "2c-r-fixed" ) {
		$cr_layout = 'sidebar-right';
		$cr_width  = 'nine';
	}
	if ( $page == "3c-fixed" ) {
		$cr_layout = 'sidebar-both';
		$cr_width  = 'six';
	}


	if ( $open ) {

		// Open content wrapper


		echo '<div class="blog-section ' . $cr_layout . '">';
		echo '<section id="main-content" role="main" class="' . $cr_width . ' columns">';


	} else {

		// Close content wrapper

		echo ' </section>';

		if ( ( $page == "2c-l-fixed" ) || ( $page == "3c-fixed" ) ) {
			get_template_part( 'templates/sidebar', 'left' );
			echo ' </div>';
		}
		if ( ( $page == "3c-l-fixed" ) ) {
			get_template_part( 'templates/sidebar', 'right' );
			echo ' </div>';
			get_template_part( 'templates/sidebar', 'left' );
		}
		if ( $page == "3c-r-fixed" ) {
			get_template_part( 'templates/sidebar', 'left' );
			echo ' </div>';
		}
		if ( ( $page == "2c-r-fixed" ) || ( $page == "3c-fixed" ) || ( $page == "3c-r-fixed" ) ) {
			get_template_part( 'templates/sidebar', 'right' );
		}
	}
}


/**
 * Add the RSS feed link in the <head> if there's posts
 */
function crum_feed_link() {
	$count = wp_count_posts( 'post' );
	if ( $count->publish > 0 ) {
		echo "\n\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"" . get_bloginfo( 'name' ) . " Feed\" href=\"" . home_url() . "/feed/\">\n";
	}
}

add_action( 'wp_head', 'crum_feed_link', - 2 );


/**
 * Customization of login page
 */

function crum_custom_login_logo() {
	$options = get_option( 'maestro' );

	if ( $options["custom_logo_image"] != '' ) {
		$custom_logo = $options["custom_logo_image"];
	} else {
		$custom_logo = get_template_directory_uri() . '/assets/img/logo.png';
	}


	echo '<style type="text/css">
    .login h1 a {
 	width:300px !important;
	background-image:url(' . $custom_logo . ') !important;
	background-size: contain !important;
}
    </style>';
}

add_action( 'login_head', 'crum_custom_login_logo' );


function crum_home_link() {
	return site_url();
}

add_filter( 'login_headerurl', 'crum_home_link' );

function change_title_on_logo() {
	return get_bloginfo( 'name' );
}

add_filter( 'login_headertitle', 'change_title_on_logo' );


// Add/Remove Contact Methods
function add_remove_contactmethods( $contactmethods ) {

	$contactmethods['twitter']     = 'Twitter';
	$contactmethods['googleplus']  = 'Google Plus';
	$contactmethods['linkedin']    = 'Linked In';
	$contactmethods['vimeo']       = 'Vimeo';
	$contactmethods['lastfm']      = 'LastFM';
	$contactmethods['tumblr']      = 'Tumblr';
	$contactmethods['skype']       = 'Skype';
	$contactmethods['cr_facebook'] = 'Facebook';
	$contactmethods['deviantart']  = 'Deviantart';
	$contactmethods['vkontakte']   = 'Vkontakte';
	$contactmethods['picasa']      = 'Picasa';
	$contactmethods['linkedin']    = 'Linkedin';
	$contactmethods['wordpress']   = 'Wordpress';
	$contactmethods['instagram']   = 'Instagram';

	// Remove Contact Methods
	unset( $contactmethods['aim'] );
	unset( $contactmethods['yim'] );
	unset( $contactmethods['jabber'] );

	return $contactmethods;
}

add_filter( 'user_contactmethods', 'add_remove_contactmethods', 10, 1 );


/**
 * Create pagination
 */

function file_get_contents_curl( $url ) {
	$ch = curl_init();

	curl_setopt( $ch, CURLOPT_HEADER, 0 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 ); //Set curl to return the data instead of printing it to the browser.
	curl_setopt( $ch, CURLOPT_URL, $url );

	$data = curl_exec( $ch );
	curl_close( $ch );

	return $data;
}

function crumin_pagination() {

	global $query;

	$big = 999999999;

	$links = paginate_links(
		array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?paged=%#%',
			'prev_next' => true,
			'prev_text' => __( 'Prev', 'crum' ), //text of the "Previous page" link
			'next_text' => __( 'Next', 'crum' ), //text of the "Next page" link

			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $query->max_num_pages,
			'type'      => 'list'
		)
	);

	$pagination = str_replace( 'page-numbers', 'pagination', $links );

	echo $pagination;

}

function crum_select_pagination() {
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	} // Exit if accessed directly

	global $query;
	$options = get_option( 'maestro' );


	if ( $query->max_num_pages <= 1 )
		return;

	if ( $options['pagination_style'] == '1' ):
		echo '<nav class="page-nav">';

		next_posts_link( '', $query->max_num_pages );
		previous_posts_link( '', $query->max_num_pages );

		echo '</nav>';
	else : crumin_pagination();
	endif;

}

/*
 *
 *
 */

function crumina_breadcrumbs() {

	/* === OPTIONS === */
	$text['home']     = __( 'Home', 'crum' ); // text for the 'Home' link
	$text['category'] = __( 'Archive by Category "%s"', 'crum' ); // text for a category page
	$text['search']   = __( 'Search Results for "%s" Query', 'crum' ); // text for a search results page
	$text['tag']      = __( 'Posts Tagged "%s"', 'crum' ); // text for a tag page
	$text['author']   = __( 'Articles Posted by %s', 'crum' ); // text for an author page
	$text['404']      = __( 'Error 404', 'crum' ); // text for the 404 page

	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = ' <span class="del">&#183;</span> '; // delimiter between crumbs
	$before      = '<span class="current">'; // tag before the current crumb
	$after       = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$homeLink   = home_url() . '/';
	$linkBefore = '<span typeof="v:Breadcrumb">';
	$linkAfter  = '</span>';
	$linkAttr   = ' rel="v:url" property="v:title"';
	$link       = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

	if ( is_home() || is_front_page() ) {

		if ( $showOnHome == 1 )
			echo '<nav id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></nav>';

	} else {

		echo '<nav id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf( $link, $homeLink, $text['home'] ) . $delimiter;

		if ( is_category() ) {
			$thisCat = get_category( get_query_var( 'cat' ), false );
			if ( $thisCat->parent != 0 ) {
				$cats = get_category_parents( $thisCat->parent, true, $delimiter );
				$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
				$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
				echo $cats;
			}
			echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf( $text['search'], get_search_query() ) . $after;


		} elseif ( is_singular( 'topic' ) ) {
			$post_type = get_post_type_object( get_post_type() );
			printf( $link, $homeLink . '/forums/', $post_type->labels->singular_name );
		} /* in forum, add link to support forum page template */
		elseif ( is_singular( 'forum' ) ) {
			$post_type = get_post_type_object( get_post_type() );
			printf( $link, $homeLink . '/forums/', $post_type->labels->singular_name );
		} elseif ( is_tax( 'topic-tag' ) ) {
			$post_type = get_post_type_object( get_post_type() );
			printf( $link, $homeLink . '/forums/', $post_type->labels->singular_name );
		} elseif ( is_day() ) {
			echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
			echo sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ) ) . $delimiter;
			echo $before . get_the_time( 'd' ) . $after;

		} elseif ( is_month() ) {
			echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
			echo $before . get_the_time( 'F' ) . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time( 'Y' ) . $after;

		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug      = $post_type->rewrite;
				printf( $link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name );
				if ( $showCurrent == 1 )
					echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat  = get_the_category();
				$cat  = $cat[0];
				$cats = is_wp_error( $cats = get_category_parents( $cat, true, '' . $delimiter . '' ) ) ? '' : $cats;
				if ( $showCurrent == 0 )
					$cats = preg_replace( "#^(.+)$delimiter$#", "$1", $cats );
				$cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
				$cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
				echo $cats;
				if ( $showCurrent == 1 )
					echo $before . get_the_title() . $after;
			}

		} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() ) {
			$post_type = get_post_type_object( get_post_type() );
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {

			if ( $showCurrent == 1 )
				echo $before . get_the_title() . $after;

		} elseif ( is_page() && ! $post->post_parent ) {
			if ( $showCurrent == 1 )
				echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id   = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page          = get_page( $parent_id );
				$breadcrumbs[] = sprintf( $link, get_permalink( $page->ID ), get_the_title( $page->ID ) );
				$parent_id     = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			for ( $i = 0; $i < count( $breadcrumbs ); $i ++ ) {
				echo $breadcrumbs[$i];
				if ( $i != count( $breadcrumbs ) - 1 )
					echo $delimiter;
			}
			if ( $showCurrent == 1 )
				echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			echo $before . sprintf( $text['author'], $userdata->display_name ) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var( 'paged' ) ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo ' (';
			echo __( 'Page', 'crum' ) . ' ' . get_query_var( 'paged' );
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo ')';
		}

		echo '</nav>';

	}
}

/*
* Gets the excerpt of a specific post ID or object
* @param - $post - object/int - the ID or object of the post to get the excerpt of
* @param - $length - int - the length of the excerpt in words
* @param - $tags - string - the allowed HTML tags. These will not be stripped out
* @param - $extra - string - text to append to the end of the excerpt
*/
function crum_excerpt_by_id( $post, $length = 10, $tags = '<a><em><strong>', $extra = '' ) {

	if ( is_int( $post ) ) {
		// get the post object of the passed ID
		$post = get_post( $post );
	} elseif ( ! is_object( $post ) ) {
		return false;
	}

	if ( has_excerpt( $post->ID ) ) {
		$the_excerpt = $post->post_excerpt;

		return apply_filters( 'the_content', $the_excerpt );
	} else {
		$the_excerpt = $post->post_content;
	}

	$the_excerpt   = strip_shortcodes( strip_tags( $the_excerpt ), $tags );
	$the_excerpt   = preg_split( '/\b/', $the_excerpt, $length * 2 + 1 );
	$excerpt_waste = array_pop( $the_excerpt );
	$the_excerpt   = implode( $the_excerpt );
	$the_excerpt .= $extra;

	return apply_filters( 'the_content', $the_excerpt );
}

/*
 * Get slug of page by ID function
 */

function the_slug( $id ) {
	if ( $id == null )
		$id = $post->ID;
	$post_data = get_post( $id, ARRAY_A );
	$slug      = $post_data['post_name'];

	return $slug;
}

/*-----------------------------------------------------------------------------------*/
# Get Social Counter
/*-----------------------------------------------------------------------------------*/
function tie_curl_subscribers_text_counter( $xml_url ) {
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_HEADER, 0 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $ch, CURLOPT_URL, $xml_url );
	$data = curl_exec( $ch );
	curl_close( $ch );

	return $data;
}

function tie_rss_count( $fb_id ) {
	$feedburner['rss_count'] = get_option( 'rss_count' );

	return $feedburner;
}

function tie_followers_count() {

	$options = get_option( 'maestro' );

	require_once locate_template( '/inc/lib/twitteroauth.php' );
	try {
		$twitter_username    = $options["username"];
		$consumer_key        = $options["twiiter_consumer"];
		$consumer_secret     = $options["twiiter_con_s"];
		$access_token        = $options["twiiter_acc_t"];
		$access_token_secret = $options["twiiter_acc_t_s"];

		$twitterConnection          = new TwitterOAuth( $consumer_key, $consumer_secret, $access_token, $access_token_secret );
		$twitterData                = $twitterConnection->get( 'users/show', array( 'screen_name' => $twitter_username ) );
		$twitter['page_url']        = 'http://www.twitter.com/' . $twitter_username;
		$twitter['followers_count'] = $twitterData->followers_count;;
	} catch ( Exception $e ) {
		$twitter['page_url']        = 'http://www.twitter.com/' . $twitter_username;
		$twitter['followers_count'] = 0;
	}
	if ( ! empty( $twitter['followers_count'] ) && get_option( 'followers_count' ) != $twitter['followers_count'] )
		update_option( 'followers_count', $twitter['followers_count'] );

	if ( $twitter['followers_count'] == 0 && get_option( 'followers_count' ) )
		$twitter['followers_count'] = get_option( 'followers_count' );

	elseif ( $twitter['followers_count'] == 0 && ! get_option( 'followers_count' ) )
		$twitter['followers_count'] = 0;

	return $twitter;
}

function tie_facebook_fans( $page_link ) {
	$face_link = @parse_url( $page_link );

	if ( $face_link['host'] == 'www.facebook.com' || $face_link['host'] == 'facebook.com' ) {
		try {
			$page_name = substr( @parse_url( $page_link, PHP_URL_PATH ), 1 );
			$data      = @json_decode( tie_curl_subscribers_text_counter( "https://graph.facebook.com/" . $page_name ) );
			$fans      = $data->likes;
		} catch ( Exception $e ) {
			$fans = 0;
		}

		if ( ! empty( $fans ) && get_option( 'fans_count' ) != $fans )
			update_option( 'fans_count', $fans );

		if ( $fans == 0 && get_option( 'fans_count' ) )
			$fans = get_option( 'fans_count' );

		elseif ( $fans == 0 && ! get_option( 'fans_count' ) )
			$fans = 0;

		return $fans;
	}
}


function tie_youtube_subs( $channel_link ) {
	$youtube_link = @parse_url( $channel_link );

	if ( $youtube_link['host'] == 'www.youtube.com' || $youtube_link['host'] == 'youtube.com' ) {
		try {
			$youtube_name = substr( @parse_url( $channel_link, PHP_URL_PATH ), 6 );
			$json         = @tie_curl_subscribers_text_counter( "http://gdata.youtube.com/feeds/api/users/" . $youtube_name . "?alt=json" );
			$data         = json_decode( $json, true );
			$subs         = $data['entry']['yt$statistics']['subscriberCount'];
		} catch ( Exception $e ) {
			$subs = 0;
		}

		if ( ! empty( $subs ) && get_option( 'youtube_count' ) != $subs )
			update_option( 'youtube_count', $subs );

		if ( $subs == 0 && get_option( 'youtube_count' ) )
			$subs = get_option( 'youtube_count' );

		elseif ( $subs == 0 && ! get_option( 'youtube_count' ) )
			$subs = 0;

		return $subs;
	}
}


function tie_vimeo_count( $page_link ) {
	$face_link = @parse_url( $page_link );

	if ( $face_link['host'] == 'www.vimeo.com' || $face_link['host'] == 'vimeo.com' ) {
		try {
			$page_name = substr( @parse_url( $page_link, PHP_URL_PATH ), 10 );
			@$data = @json_decode( tie_curl_subscribers_text_counter( 'http://vimeo.com/api/v2/channel/' . $page_name . '/info.json' ) );

			$vimeo = $data->total_subscribers;
		} catch ( Exception $e ) {
			$vimeo = 0;
		}

		if ( ! empty( $vimeo ) && get_option( 'vimeo_count' ) != $vimeo )
			update_option( 'vimeo_count', $vimeo );

		if ( $vimeo == 0 && get_option( 'vimeo_count' ) )
			$vimeo = get_option( 'vimeo_count' );

		elseif ( $vimeo == 0 && ! get_option( 'vimeo_count' ) )
			$vimeo = 0;

		return $vimeo;
	}

}

function tie_dribbble_count( $page_link ) {
	$face_link = @parse_url( $page_link );

	if ( $face_link['host'] == 'www.dribbble.com' || $face_link['host'] == 'dribbble.com' ) {
		try {
			$page_name = substr( @parse_url( $page_link, PHP_URL_PATH ), 1 );
			@$data = @json_decode( tie_curl_subscribers_text_counter( 'http://api.dribbble.com/' . $page_name ) );

			$dribbble = $data->followers_count;
		} catch ( Exception $e ) {
			$dribbble = 0;
		}

		if ( ! empty( $dribbble ) && get_option( 'dribbble_count' ) != $dribbble )
			update_option( 'dribbble_count', $dribbble );

		if ( $dribbble == 0 && get_option( 'dribbble_count' ) )
			$dribbble = get_option( 'dribbble_count' );

		elseif ( $dribbble == 0 && ! get_option( 'dribbble_count' ) )
			$dribbble = 0;

		return $dribbble;
	}
}

// Add lightbox to link on images
add_filter('wp_get_attachment_link', 'crum_addlightboxrel');

function crum_addlightboxrel($content) {
	global $post;
	$pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="prettyPhoto[pp_gal_id'.$post->ID.']" title="'.$post->post_title.'"$6>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}