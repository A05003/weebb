<?php
/**
 * Zawaya Al Maali theme functions (v2: redesigned front end, same content model).
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ZAWAYA_VER', '2.0.0' );
define( 'ZAWAYA_DIR', get_template_directory() );
define( 'ZAWAYA_URI', get_template_directory_uri() );

require ZAWAYA_DIR . '/inc/defaults.php';
require ZAWAYA_DIR . '/inc/helpers.php';
require ZAWAYA_DIR . '/inc/zv.php';
require ZAWAYA_DIR . '/inc/render.php';
require ZAWAYA_DIR . '/inc/post-types.php';
require ZAWAYA_DIR . '/inc/meta-boxes.php';
require ZAWAYA_DIR . '/inc/customizer.php';
require ZAWAYA_DIR . '/inc/contact.php';
require ZAWAYA_DIR . '/inc/menus.php';
require ZAWAYA_DIR . '/inc/demo-content.php';
require ZAWAYA_DIR . '/inc/elementor.php';

/**
 * Theme setup.
 */
function zawaya_setup() {
	load_theme_textdomain( 'zawaya', ZAWAYA_DIR . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 240,
			'width'       => 560,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_post_type_support( 'page', 'excerpt' );

	register_nav_menus(
		array(
			'primary' => 'القائمة الرئيسية (الهيدر)',
			'footer'  => 'روابط سريعة (الفوتر)',
		)
	);

	add_image_size( 'zawaya-card', 720, 450, true );
	add_image_size( 'zawaya-square', 900, 900, true );
}
add_action( 'after_setup_theme', 'zawaya_setup' );

/**
 * Front-end assets.
 * The v2 design lives in assets/site.css + assets/site.js. The old stylesheet is kept only for
 * pages built with Elementor widgets: it is scoped under ".elementor" so it cannot touch the new
 * header, footer or templates.
 */
function zawaya_assets() {
	wp_enqueue_style( 'zawaya-fonts', ZAWAYA_URI . '/assets/fonts/tajawal.css', array(), ZAWAYA_VER );
	wp_enqueue_style( 'zv-site', ZAWAYA_URI . '/assets/site.css', array( 'zawaya-fonts' ), ZAWAYA_VER );
	wp_enqueue_script( 'zv-site', ZAWAYA_URI . '/assets/site.js', array(), ZAWAYA_VER, true );
	if ( is_singular( 'post' ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zawaya_assets' );

/** Handles the custom Elementor widgets depend on (loaded by Elementor only when a widget renders). */
function zawaya_register_legacy_assets() {
	wp_register_style( 'zawaya-fa', ZAWAYA_URI . '/assets/fontawesome/css/all.min.css', array(), '6.5.2' );
	wp_register_style( 'zawaya-style', ZAWAYA_URI . '/assets/css/legacy.css', array( 'zv-site', 'zawaya-fa' ), ZAWAYA_VER );
	wp_register_script( 'zawaya-main', ZAWAYA_URI . '/assets/js/main.js', array(), ZAWAYA_VER, true );
}
add_action( 'wp_enqueue_scripts', 'zawaya_register_legacy_assets', 5 );

/**
 * Meta description for SEO (from excerpt / customizer).
 */
function zawaya_meta_description() {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) {
		return; // An SEO plugin handles it.
	}
	$desc = '';
	if ( is_front_page() ) {
		$desc = zw_opt( 'seo_home_desc' );
	} elseif ( is_singular() ) {
		$post = get_queried_object();
		$desc = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 30, '…' );
	} elseif ( is_home() ) {
		$page = get_option( 'page_for_posts' );
		$desc = $page ? get_the_excerpt( $page ) : '';
	}
	$desc = trim( wp_strip_all_tags( (string) $desc ) );
	if ( $desc ) {
		echo '<meta name="description" content="' . esc_attr( wp_html_excerpt( $desc, 160 ) ) . "\">\n";
		echo '<meta property="og:description" content="' . esc_attr( wp_html_excerpt( $desc, 200 ) ) . "\">\n";
	}
	echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . "\">\n";
	echo '<meta property="og:locale" content="ar_SA">' . "\n";
	echo '<meta name="theme-color" content="#0f3d3e">' . "\n";
	if ( is_singular() && has_post_thumbnail() ) {
		echo '<meta property="og:image" content="' . esc_url( get_the_post_thumbnail_url( null, 'large' ) ) . "\">\n";
	} else {
		echo '<meta property="og:image" content="' . esc_url( ZAWAYA_URI . '/assets/img/hero.jpg' ) . "\">\n";
	}
}
add_action( 'wp_head', 'zawaya_meta_description', 2 );

/**
 * Always render the site RTL + Arabic, even if the WP admin language is English.
 */
function zawaya_language_attributes( $output ) {
	if ( is_admin() ) {
		return $output;
	}
	return 'dir="rtl" lang="ar"';
}
add_filter( 'language_attributes', 'zawaya_language_attributes' );

/**
 * Use the classic editor for projects and services so their detail boxes are visible directly.
 */
add_filter(
	'use_block_editor_for_post_type',
	function ( $use, $post_type ) {
		return in_array( $post_type, array( 'zawaya_project', 'zawaya_service', 'zawaya_partner' ), true ) ? false : $use;
	},
	10,
	2
);

/**
 * Excerpt tweaks.
 */
add_filter(
	'excerpt_length',
	function () {
		return 28;
	}
);
add_filter(
	'excerpt_more',
	function () {
		return '…';
	}
);

/**
 * Old URLs from the previous site: /project/?id=multaqa -> /project/multaqa/
 */
add_action( 'init', function () {
	if ( ! is_admin() && ! empty( $_GET['id'] ) ) {
		$path = trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
		if ( 'project' === $path ) {
			$slug = sanitize_title( wp_unslash( $_GET['id'] ) );
			$post = get_page_by_path( $slug, OBJECT, 'zawaya_project' );
			if ( $post ) {
				wp_safe_redirect( get_permalink( $post ), 301 );
				exit;
			}
		}
	}
}, 99 );

/**
 * Body classes.
 */
add_filter(
	'body_class',
	function ( $classes ) {
		$classes[] = 'zawaya';
		return $classes;
	}
);
