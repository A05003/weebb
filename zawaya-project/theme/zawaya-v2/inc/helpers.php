<?php
/**
 * Template helpers.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Get a theme option (Customizer) with its default. */
function zw_opt( $key ) {
	$d   = zawaya_defaults();
	$def = isset( $d[ $key ] ) ? $d[ $key ] : '';
	$v   = get_theme_mod( 'zw_' . $key, null );
	if ( null !== $v ) {
		return $v;
	}
	// Settings saved in the previous theme ("zawaya") carry over until saved again here.
	static $old = null;
	if ( null === $old ) {
		$old = get_option( 'theme_mods_zawaya', array() );
		$old = is_array( $old ) ? $old : array();
	}
	return array_key_exists( 'zw_' . $key, $old ) ? $old[ 'zw_' . $key ] : $def;
}

/** URL of an image bundled with the theme. */
function zw_img( $file ) {
	return ZAWAYA_URI . '/assets/img/' . $file;
}

/** Image option (attachment id or url) -> url, with a bundled fallback. */
function zw_opt_img( $key, $fallback = '' ) {
	$v = zw_opt( $key );
	if ( is_numeric( $v ) && $v ) {
		$u = wp_get_attachment_image_url( (int) $v, 'full' );
		if ( $u ) {
			return $u;
		}
	} elseif ( $v ) {
		return $v;
	}
	return $fallback ? zw_img( $fallback ) : '';
}

/** Site logo URL. */
function zw_logo_url() {
	$id = get_theme_mod( 'custom_logo' );
	if ( $id ) {
		$u = wp_get_attachment_image_url( $id, 'full' );
		if ( $u ) {
			return $u;
		}
	}
	return zw_img( 'logo-v.png' );
}

/** The curved divider at the bottom of banners. */
function zw_curve( $color = '' ) {
	$style = $color ? ' style="--curve:' . esc_attr( $color ) . '"' : '';
	echo '<svg class="curve" viewBox="0 0 1440 90" preserveAspectRatio="none" aria-hidden="true"' . $style . '><path d="M0,90 L0,40 Q720,-30 1440,40 L1440,90 Z"/></svg>';
}

/** Phone -> tel: link. */
function zw_tel( $phone ) {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', (string) $phone );
}

/** WhatsApp link. */
function zw_wa_link() {
	$n = preg_replace( '/[^0-9]/', '', (string) zw_opt( 'whatsapp' ) );
	return $n ? 'https://api.whatsapp.com/send/?phone=' . $n : '';
}

/** Split a textarea into non-empty lines. */
function zw_lines( $text ) {
	$out = array();
	foreach ( preg_split( '/\r\n|\r|\n/', (string) $text ) as $l ) {
		$l = trim( $l );
		if ( '' !== $l ) {
			$out[] = $l;
		}
	}
	return $out;
}

/** Facts textarea ("label | value" per line) -> array of [k, v]. */
function zw_facts( $post_id ) {
	$out = array();
	foreach ( zw_lines( get_post_meta( $post_id, '_zw_facts', true ) ) as $l ) {
		$parts = array_map( 'trim', explode( '|', $l, 2 ) );
		$out[] = array( $parts[0], isset( $parts[1] ) ? $parts[1] : '' );
	}
	return $out;
}

/** Short name of a project (falls back to title). */
function zw_short( $post_id ) {
	$s = get_post_meta( $post_id, '_zw_short', true );
	return $s ? $s : get_the_title( $post_id );
}

/** CTA label for a project. */
function zw_cta( $post_id ) {
	$s = get_post_meta( $post_id, '_zw_cta', true );
	return $s ? $s : 'احجز الآن';
}

/** Logo (featured image) URL of a project. */
function zw_project_logo( $post_id, $size = 'medium_large' ) {
	$u = get_the_post_thumbnail_url( $post_id, $size );
	return $u ? $u : zw_img( 'logo-v.png' );
}

/** All published projects ordered by menu order. */
function zw_projects( $exclude = 0 ) {
	return get_posts(
		array(
			'post_type'      => 'zawaya_project',
			'posts_per_page' => -1,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
			'post__not_in'   => $exclude ? array( $exclude ) : array(),
		)
	);
}

/** All published services. */
function zw_services() {
	return get_posts(
		array(
			'post_type'      => 'zawaya_service',
			'posts_per_page' => -1,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
		)
	);
}

/** URL of a page by its slug (with a fallback path). */
function zw_page_url( $slug ) {
	$p = get_page_by_path( $slug );
	return $p ? get_permalink( $p ) : home_url( '/' . $slug . '/' );
}

/** Contact page url. */
function zw_contact_url() {
	return zw_page_url( 'contact-us' );
}

/**
 * Page banner (breadcrumb + title + subtitle).
 *
 * @param array $args title, subtitle, image, crumbs (array of [label,url]), type, small.
 */
function zw_banner( $args ) {
	$a = wp_parse_args(
		$args,
		array(
			'title'    => '',
			'subtitle' => '',
			'image'    => '',
			'crumbs'   => array(),
			'type'     => '',
			'small'    => false,
			'curve'    => '',
		)
	);
	?>
	<section class="banner<?php echo $a['small'] ? ' banner--sm' : ''; ?>">
		<?php if ( $a['image'] ) : ?>
			<div class="banner-img" style="background-image:url('<?php echo esc_url( $a['image'] ); ?>')"></div>
		<?php endif; ?>
		<div class="banner-shade"></div>
		<div class="banner-inner">
			<nav class="crumbs" aria-label="مسار التنقل">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">الرئيسية</a>
				<?php foreach ( $a['crumbs'] as $c ) : ?>
					<span class="sep">/</span><a href="<?php echo esc_url( $c[1] ); ?>"><?php echo esc_html( $c[0] ); ?></a>
				<?php endforeach; ?>
				<span class="sep">/</span><span class="cur"><?php echo esc_html( wp_strip_all_tags( $a['title'] ) ); ?></span>
			</nav>
			<?php if ( $a['type'] ) : ?>
				<span class="type"><?php echo esc_html( $a['type'] ); ?></span>
			<?php endif; ?>
			<h1><?php echo esc_html( $a['title'] ); ?></h1>
			<span class="bar"></span>
			<?php if ( $a['subtitle'] ) : ?>
				<p><?php echo esc_html( $a['subtitle'] ); ?></p>
			<?php endif; ?>
		</div>
		<?php zw_curve( $a['curve'] ); ?>
	</section>
	<?php
}

/** Banner for a regular page: featured image + excerpt as subtitle. */
function zw_page_banner( $default_sub = '', $default_img = '' ) {
	$id  = get_queried_object_id();
	$img = get_the_post_thumbnail_url( $id, 'full' );
	if ( ! $img && $default_img ) {
		$img = zw_img( $default_img );
	}
	$sub = has_excerpt( $id ) ? get_the_excerpt( $id ) : $default_sub;
	zw_banner(
		array(
			'title'    => get_the_title( $id ),
			'subtitle' => $sub,
			'image'    => $img,
		)
	);
}

/** Counters data (shared by home + about). */
function zw_counters() {
	$icons = array( 'c_clients.svg', 'c_events.svg', 'c_projects.svg', 'c_staff.svg' );
	$out   = array();
	for ( $i = 1; $i <= 4; $i++ ) {
		$label = zw_opt( "c{$i}_label" );
		if ( '' === trim( (string) $label ) ) {
			continue;
		}
		$out[] = array(
			'label'  => $label,
			'value'  => (int) zw_opt( "c{$i}_value" ),
			'prefix' => (string) zw_opt( "c{$i}_prefix" ),
			'icon'   => zw_img( $icons[ $i - 1 ] ),
		);
	}
	return $out;
}

/** Render counters grid. */
function zw_counters_grid( $animate = true ) {
	echo '<div class="counters-grid">';
	foreach ( zw_counters() as $c ) {
		$final = $c['prefix'] . number_format( $c['value'] );
		printf(
			'<div class="counter"><img src="%1$s" alt="" width="90" height="90" loading="lazy"><div class="num"%2$s>%3$s</div><div class="lbl">%4$s</div></div>',
			esc_url( $c['icon'] ),
			$animate ? ' data-count="' . esc_attr( $c['value'] ) . '" data-prefix="' . esc_attr( $c['prefix'] ) . '"' : '',
			esc_html( $final ),
			esc_html( $c['label'] )
		);
	}
	echo '</div>';
}
