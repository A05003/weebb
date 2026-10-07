<?php
/**
 * Small helpers that build Elementor element arrays (containers + widgets).
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Random 7-char Elementor element id. */
function zwe_id() {
	static $used = array();
	do {
		$id = substr( md5( uniqid( 'zw', true ) . wp_rand() ), 0, 7 );
	} while ( isset( $used[ $id ] ) );
	$used[ $id ] = true;
	return $id;
}

/** Deep-merge settings arrays (keeps every __globals__ entry). */
function zwe_m( ...$arrays ) {
	$out = array();
	foreach ( $arrays as $a ) {
		foreach ( (array) $a as $k => $v ) {
			if ( '__globals__' === $k && isset( $out[ $k ] ) ) {
				$out[ $k ] = array_merge( $out[ $k ], $v );
			} else {
				$out[ $k ] = $v;
			}
		}
	}
	return $out;
}

/** Global colour reference(s): array( setting_key => color_id ). */
function zwe_glob( array $map ) {
	$g = array();
	foreach ( $map as $k => $id ) {
		$g[ $k ] = 'globals/colors?id=' . $id;
	}
	return array( '__globals__' => $g );
}

function zwe_size( $size, $unit = 'px' ) {
	return array( 'unit' => $unit, 'size' => $size, 'sizes' => array() );
}

function zwe_box( $t, $r = null, $b = null, $l = null, $unit = 'px' ) {
	$r = null === $r ? $t : $r;
	$b = null === $b ? $t : $b;
	$l = null === $l ? $r : $l;
	return array(
		'unit'     => $unit,
		'top'      => (string) $t,
		'right'    => (string) $r,
		'bottom'   => (string) $b,
		'left'     => (string) $l,
		'isLinked' => ( $t === $r && $r === $b && $b === $l ),
	);
}

function zwe_gap( $row, $col = null ) {
	$col = null === $col ? $row : $col;
	return array(
		'column'   => (string) $col,
		'row'      => (string) $row,
		'isLinked' => $row === $col,
		'unit'     => 'px',
		'size'     => $col,
	);
}

/** Typography group values. Sizes: array( desktop, tablet, mobile ). */
function zwe_typo( $prefix, $sizes, $weight = '', $line_height = null ) {
	$sizes = (array) $sizes;
	$o     = array(
		$prefix . '_typography' => 'custom',
		$prefix . '_font_size'  => zwe_size( $sizes[0] ),
	);
	if ( isset( $sizes[1] ) ) {
		$o[ $prefix . '_font_size_tablet' ] = zwe_size( $sizes[1] );
	}
	if ( isset( $sizes[2] ) ) {
		$o[ $prefix . '_font_size_mobile' ] = zwe_size( $sizes[2] );
	}
	if ( $weight ) {
		$o[ $prefix . '_font_weight' ] = (string) $weight;
	}
	if ( null !== $line_height ) {
		$o[ $prefix . '_line_height' ] = zwe_size( $line_height, 'em' );
	}
	return $o;
}

function zwe_icon( $fa ) {
	$lib = 0 === strpos( $fa, 'fab ' ) ? 'fa-brands' : ( 0 === strpos( $fa, 'far ' ) ? 'fa-regular' : 'fa-solid' );
	return array( 'value' => $fa, 'library' => $lib );
}

function zwe_link( $url, $external = false ) {
	return array( 'url' => $url, 'is_external' => $external ? 'on' : '', 'nofollow' => '', 'custom_attributes' => '' );
}

/** A container. */
function zwe_con( array $settings, array $children = array() ) {
	return array(
		'id'       => zwe_id(),
		'elType'   => 'container',
		'isInner'  => false,
		'settings' => $settings,
		'elements' => $children,
	);
}

/** A widget. */
function zwe_w( $type, array $settings ) {
	return array(
		'id'         => zwe_id(),
		'elType'     => 'widget',
		'widgetType' => $type,
		'settings'   => $settings,
		'elements'   => array(),
	);
}

/** Mark nested containers as inner. */
function zwe_finalize( array $elements, $depth = 0 ) {
	foreach ( $elements as &$el ) {
		if ( 'container' === $el['elType'] ) {
			$el['isInner'] = $depth > 0;
			// Containers keep their CSS classes in "css_classes" (widgets use "_css_classes").
			if ( isset( $el['settings']['_css_classes'] ) ) {
				$el['settings']['css_classes'] = $el['settings']['_css_classes'];
				unset( $el['settings']['_css_classes'] );
			}
		}
		if ( ! empty( $el['elements'] ) ) {
			$el['elements'] = zwe_finalize( $el['elements'], $depth + 1 );
		}
	}
	return $elements;
}

/* ---------- Layout shortcuts ---------- */

/** Full-width page section with a boxed inner area. */
function zwe_section( $bg, array $children, array $extra = array() ) {
	return zwe_con(
		zwe_m(
			array(
				'content_width'         => 'boxed',
				'flex_direction'        => 'column',
				'flex_gap'              => zwe_gap( 44 ),
				'flex_gap_mobile'       => zwe_gap( 32 ),
				'padding'               => zwe_box( 104, 16, 104, 16 ),
				'padding_tablet'        => zwe_box( 80, 16, 80, 16 ),
				'padding_mobile'        => zwe_box( 60, 16, 60, 16 ),
				'background_background' => 'classic',
			),
			zwe_glob( array( 'background_color' => $bg ) ),
			$extra
		),
		$children
	);
}

/** Inner flex box (no padding of its own). */
function zwe_box_con( $direction, array $children, array $extra = array() ) {
	return zwe_con(
		zwe_m(
			array(
				'content_width'  => 'full',
				'flex_direction' => $direction,
				'padding'        => zwe_box( 0 ),
				'flex_gap'       => zwe_gap( 20 ),
			),
			$extra
		),
		$children
	);
}

/** CSS grid container. $cols = array( desktop, tablet, mobile ). */
function zwe_grid( array $cols, array $children, $gap = 24, array $extra = array() ) {
	$n    = max( 1, count( $children ) );
	$rows = array();
	foreach ( array( '', '_tablet', '_mobile' ) as $i => $dev ) {
		$c                           = $cols[ $i ];
		$rows[ 'grid_columns_grid' . $dev ] = zwe_size( $c, 'fr' );
		$rows[ 'grid_rows_grid' . $dev ]    = zwe_size( (int) ceil( $n / $c ), 'fr' );
	}
	return zwe_con(
		zwe_m(
			array(
				'container_type' => 'grid',
				'content_width'  => 'full',
				'padding'        => zwe_box( 0 ),
				'grid_gaps'      => zwe_gap( is_array( $gap ) ? $gap[0] : $gap, is_array( $gap ) ? $gap[1] : $gap ),
				'grid_auto_flow' => 'row',
			),
			$rows,
			$extra
		),
		$children
	);
}

/** Section heading (with optional gold bar under it). */
function zwe_title( $text, $color = 'zwhead', $bar = false, $tag = 'h2', $align = 'center' ) {
	return zwe_w(
		'heading',
		zwe_m(
			array(
				'title'        => $text,
				'header_size'  => $tag,
				'align'        => $align,
				'_css_classes' => 'zw-sec-title' . ( $bar ? ' zw-bar' : '' ),
			),
			zwe_typo( 'typography', array( 44, 34, 28 ), 700, 1.35 ),
			zwe_glob( array( 'title_color' => $color ) )
		)
	);
}

function zwe_heading( $text, $tag, $color, $sizes, $weight = 700, $lh = 1.4, array $extra = array() ) {
	return zwe_w(
		'heading',
		zwe_m(
			array( 'title' => $text, 'header_size' => $tag ),
			zwe_typo( 'typography', $sizes, $weight, $lh ),
			zwe_glob( array( 'title_color' => $color ) ),
			$extra
		)
	);
}

function zwe_text( $html, $color = 'zwtext', $size = 17, $lh = 2, array $extra = array() ) {
	return zwe_w(
		'text-editor',
		zwe_m(
			array( 'editor' => $html ),
			zwe_typo( 'typography', array( $size, $size, $size - 1 ), '', $lh ),
			zwe_glob( array( 'text_color' => $color ) ),
			$extra
		)
	);
}

/**
 * Button. $style: gold | navy | outline | link.
 */
function zwe_button( $text, $url, $style = 'gold', array $extra = array(), $external = false ) {
	$styles = array(
		'gold'    => array( 'zwgold', 'zwnavydk', '' ),
		'navy'    => array( 'zwnavy', 'zwgold', '' ),
		'outline' => array( '', 'zwhead', 'zwhead' ),
		'link'    => array( '', 'zwhead', '' ),
	);
	list( $bg, $fg, $border ) = $styles[ $style ];
	$g = array( 'button_text_color' => $fg );
	$s = array(
		'text'          => $text,
		'link'          => zwe_link( $url, $external ),
		'border_radius' => zwe_box( 11 ),
		'text_padding'  => 'link' === $style ? zwe_box( 0 ) : zwe_box( 13, 30, 13, 30 ),
		'_css_classes'  => 'zw-btn zw-btn-' . $style,
	);
	$s = zwe_m( $s, zwe_typo( 'typography', array( 16 ), 700, 1.2 ) );
	if ( $bg ) {
		$s['background_background'] = 'classic';
		$g['background_color']      = $bg;
	} else {
		$s['background_background'] = 'classic';
		$s['background_color']      = '#00000000';
	}
	if ( $border ) {
		$s['border_border']  = 'solid';
		$s['border_width']   = zwe_box( 1.5 );
		$g['border_color']   = $border;
	}
	return zwe_w( 'button', zwe_m( $s, zwe_glob( $g ), $extra ) );
}

/** Image widget. $img = array( url, id ). */
function zwe_image( $img, array $extra = array() ) {
	return zwe_w(
		'image',
		zwe_m(
			array(
				'image'      => array( 'url' => $img['url'], 'id' => $img['id'], 'alt' => '', 'source' => 'library' ),
				'image_size' => 'full',
			),
			$extra
		)
	);
}
