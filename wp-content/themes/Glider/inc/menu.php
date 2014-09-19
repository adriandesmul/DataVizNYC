<?php

/*
* Custom Walker to remove all the wp_nav_menu junk
*/
class Crum_Clean_Walker extends Walker_Nav_Menu
{
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$item_id = esc_attr( $item->ID );

		$iconname = get_post_meta($item_id, '_menu_item_iconname', true);

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$current_indicators = array('current-menu-parent', 'current_page_item', 'current_page_parent');

		$newClasses = array();

		foreach($classes as $el){
			//check if it's indicating the current page, otherwise we don't need the class
			if (in_array($el, $current_indicators)){
				array_push($newClasses, $el);
			}
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $newClasses), $item ) );
		if($class_names!='') $class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<li' . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';


		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		if ($iconname){
			$item_output .= '<i class="'.$iconname.'"></i>';
		}
		$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= '<span class="desc"> ' .apply_filters( 'the_title', $item->description, $item->ID ) .'</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

class Crum_Nav_Menu_Walker extends Walker_Nav_Menu {
	private $_last_ul = '';

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

		if ( is_object( $args[0] ) ) {
			//$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

			$args[0]->is_full = ( $element->_crum_mega_menu_full == 1 );

			$args[0]->number_columns = ( $element->_crum_mega_menu_columns );

			$args[0]->megamenu_content = ( $element->_crum_mega_menu_page );

		}

		$element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	function start_lvl( &$output, $depth = 0, $args = array(), $current_page = 0 ) {
		// depth dependent classes
		$indent        = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1 ); // because it counts the first submenu as 0

		$classes = array(
			'menu-depth-' . $display_depth
		);
		$classes[] = 'dropdown';

		$prefix = '';
		if ( $depth == 0 && $args->megamenu_content ) {
			if ( $args->is_full ) {
				$prefix .= '<div class="megamenu full-width"><div class="row">';
			} else {
				$prefix .= '<div class="megamenu half-width"><div class="row">';
			}

			$classes[] = 'twelve columns';
		}

		$class_names = implode( ' ', $classes );

		// build html
		$ul = '<ul class="' . $class_names . '">';

		$output .= "\n" . $indent . $prefix . $ul . "\n";

		if ( $display_depth == 1 ) {
			$this->_last_ul = $ul;
		}

	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$postfix = '';
		if ( $depth == 0 && $args->megamenu_content ) {
			$postfix .= '</div></div>';
		}

		$output .= "{$indent}</ul>{$postfix}\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;


		$icon = $item->_crum_mega_menu_icon;

		if(!$icon){
			$mega_menu_settings = get_option( "crumina_menu_data" );
			$icon = $mega_menu_settings ? $mega_menu_settings["primary-navigation"][$item->ID]["font_icon_name"] :'';
		}
		if ($icon)
			$icon = '<i class="' . $icon . '"></i>';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		// code indent
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

		if ( isset( $item->is_mega_delim ) && $item->is_mega_delim ) {
			$output .= '</ul>' . $this->_last_ul;
		}

		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'nav-item' : 'sub-nav-item' ),
			'menu-item-depth-' . $depth,
		);
		if ( isset( $item->is_mega_unlast ) && $item->is_mega_unlast ) {
			$depth_classes[] = 'unlast';
		}

		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );


		// build html
		if ( $args->has_children ) {
			$class_names = 'has-submenu';
		} else {
			$class_names = "";
		}
		if ( ! empty( $icon ) ) {
			$class_names .= " has-icon";
		}
		if ( ! empty( $item->description ) ) {
			$class_names .= " has-description";
		}

		$class_names .= in_array( 'current-menu-item', $classes ) ? ' active ' : '';


		$output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		// link attributes
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';


		$id_field = $this->db_fields['id'];


		$item_output = sprintf(
			'%1$s<a%2$s>',
			$args->before, $attributes
		);

		$item_output .= $icon;
		$item_output .= '<span class="name"> ' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>';
		if ($item->description){
			$item_output .= '<span class="desc"> ' . apply_filters( 'the_title', $item->description, $item->ID ) . '</span>';
		}
		if( (! $item->description) && $item->attr_title){
			$item_output .= '<span class="desc"> ' . apply_filters( 'the_title', $item->attr_title, $item->ID ) . '</span>';
		}

		$item_output .= sprintf(
			'</a>%1$s',
			$args->after
		);

		if ( $item->_crum_mega_menu_page && $item->_crum_mega_menu_page != '0' ) {
			$post_id_get = get_post( $item->_crum_mega_menu_page );

			if (function_exists('siteorigin_panels_render')){
				$panels_data = get_post_meta( $item->_crum_mega_menu_page, 'panels_data', true );
				$panel_content = siteorigin_panels_render( $item->_crum_mega_menu_page, false, $panels_data  );
			}
			if ( !empty( $panel_content ) ){
				$content = $panel_content;
				$content .= '<style type="text/css" media="all">';
				$content .= siteorigin_panels_generate_css($item->_crum_mega_menu_page, $panels_data);
				$content .= '</style>';
			} else {
				$content = apply_filters('the_content', $post_id_get->post_content);
				$content = str_replace(']]>', ']]>', $content);
			}


			if ( $args->is_full ) {
				$item_output .= '<div class="megamenu full-width"><div class="megamenu-content">';
			} else {
				$item_output .= '<div class="megamenu half-width"><div class="megamenu-content">';
			}
			$item_output .= $content;
			$item_output .= '</div></div>';
		}


		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		$output .= "</li>\n";

	}
}

function crum_menu_fallback() {
	echo '<div class="no-menu-box">';
	// Translators 1: Link to Menus, 2: Link to Customize
	printf( __( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'crum' ),
		sprintf(  __( '<a href="%s">Menus</a>', 'crum' ),
			get_admin_url( get_current_blog_id(), 'nav-menus.php' )
		),
		sprintf(  __( '<a href="%s">Customize</a>', 'crum' ),
			get_admin_url( get_current_blog_id(), 'customize.php' )
		)
	);
	echo '</div>';
}