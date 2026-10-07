<?php
/**
 * Menu helpers: fallback menu, active states, mega-menu flag.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Default links used when no menu is assigned yet. */
function zawaya_default_links() {
	$links = array(
		array( 'الرئيسية', home_url( '/' ), 'home' ),
		array( 'من نحن', zw_page_url( 'about-us' ), 'about-us' ),
		array( 'خدماتنا', zw_page_url( 'services' ), 'services' ),
		array( 'مشاريعنا', zw_page_url( 'projects' ), 'projects' ),
		array( 'المدونة', zw_page_url( 'blog' ), 'blog' ),
	);
	return $links;
}

function zawaya_current_section() {
	if ( is_front_page() ) {
		return 'home';
	}
	if ( is_singular( 'zawaya_project' ) ) {
		return 'projects';
	}
	if ( is_home() || is_singular( 'post' ) || is_category() || is_tag() || is_author() || is_date() ) {
		return 'blog';
	}
	if ( is_page() ) {
		return get_post_field( 'post_name', get_queried_object_id() );
	}
	return '';
}

/** Fallback for the header menu. */
function zawaya_menu_fallback( $args = array() ) {
	$cur     = zawaya_current_section();
	$include_contact = ! empty( $args['zw_contact'] );
	echo '<ul>';
	foreach ( zawaya_default_links() as $l ) {
		$cls = array();
		if ( $l[2] === $cur ) {
			$cls[] = 'is-active';
		}
		if ( 'projects' === $l[2] && empty( $args['zw_no_mega'] ) ) {
			$cls[] = 'has-mega';
		}
		printf( '<li class="%s"><a href="%s">%s</a></li>', esc_attr( implode( ' ', $cls ) ), esc_url( $l[1] ), esc_html( $l[0] ) );
	}
	if ( $include_contact ) {
		printf( '<li class="%s"><a href="%s">%s</a></li>', 'contact-us' === $cur ? 'is-active' : '', esc_url( zw_contact_url() ), 'تواصل معنا' );
	}
	echo '</ul>';
}

/** Footer fallback includes "contact". */
function zawaya_footer_fallback() {
	zawaya_menu_fallback( array( 'zw_contact' => true, 'zw_no_mega' => true ) );
}

function zawaya_mobile_fallback() {
	zawaya_menu_fallback( array( 'zw_no_mega' => true ) );
}

/** Mark the projects item (mega menu) and fix active states for CPT/blog. */
function zawaya_nav_classes( $classes, $item, $args ) {
	if ( empty( $args->theme_location ) ) {
		return $classes;
	}
	$projects = get_page_by_path( 'projects' );
	$is_projects_item = ( $projects && (int) $item->object_id === (int) $projects->ID && 'page' === $item->object )
		|| false !== strpos( (string) $item->url, '/projects' );
	if ( $is_projects_item && 'primary' === $args->theme_location && empty( $args->zw_no_mega ) ) {
		$classes[] = 'has-mega';
	}
	if ( $is_projects_item && is_singular( 'zawaya_project' ) ) {
		$classes[] = 'is-active';
	}
	// WP marks the blog page as "parent" of every CPT single; undo that.
	if ( ! is_singular( 'post' ) && ! is_home() && ! is_category() && ! is_tag() && ! is_date() && ! is_author() ) {
		$classes = array_diff( $classes, array( 'current_page_parent' ) );
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'zawaya_nav_classes', 10, 3 );


/**
 * Print one half of the primary menu (for the centred-logo header).
 *
 * @param string $part first|second.
 */
function zw_split_menu( $part ) {
	add_filter( 'wp_nav_menu_objects', 'zw_split_menu_objects', 20, 2 );
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => false,
			'depth'          => 1,
			'fallback_cb'    => false,
			'zw_part'        => $part,
		)
	);
	remove_filter( 'wp_nav_menu_objects', 'zw_split_menu_objects', 20 );
	if ( ! has_nav_menu( 'primary' ) || ! get_nav_menu_locations() ) {
		zw_split_menu_fallback( $part );
	}
}

function zw_split_menu_objects( $items, $args ) {
	if ( empty( $args->zw_part ) ) {
		return $items;
	}
	$top  = array_values( array_filter( $items, function ( $i ) {
		return empty( $i->menu_item_parent );
	} ) );
	$half = (int) ceil( count( $top ) / 2 );
	return 'first' === $args->zw_part ? array_slice( $top, 0, $half ) : array_slice( $top, $half );
}

/** Same split when no menu is assigned (uses the default links). */
function zw_split_menu_fallback( $part ) {
	$links = zawaya_default_links();
	$half  = (int) ceil( count( $links ) / 2 );
	$links = 'first' === $part ? array_slice( $links, 0, $half ) : array_slice( $links, $half );
	$cur   = zawaya_current_section();
	echo '<ul>';
	foreach ( $links as $l ) {
		$cls = array();
		if ( $l[2] === $cur ) {
			$cls[] = 'is-active';
		}
		if ( 'projects' === $l[2] ) {
			$cls[] = 'has-mega';
		}
		printf( '<li class="%s"><a href="%s">%s</a></li>', esc_attr( implode( ' ', $cls ) ), esc_url( $l[1] ), esc_html( $l[0] ) );
	}
	echo '</ul>';
}
