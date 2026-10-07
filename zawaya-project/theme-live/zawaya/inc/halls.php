<?php
/**
 * Halls (projects): accent colours, light cards for the projects page, and helpers for the
 * single hall page. Each hall gets its own colour next to the navy + gold identity.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Accent colours by project slug: array( day, night ).
 * Day is the deep tone (readable on the light page), night is its light opposite (readable on navy).
 */
function zawaya_hall_accents() {
	return array(
		'almasa'  => array( '#3F63C9', '#9DB6FF' ), // sapphire.
		'multaqa' => array( '#C94F72', '#FFA9BE' ), // rose.
		'mawadda' => array( '#8E2D55', '#F08AB0' ), // wine.
		'diyar'   => array( '#C96A3A', '#FFB88A' ), // copper.
		'helon'   => array( '#6D55C8', '#C3B4FF' ), // lilac.
		'maali'   => array( '#B8821F', '#F5CD7E' ), // amber.
		'manar'   => array( '#4A6A94', '#A9C3E6' ), // steel blue.
	);
}

/** Accent pair (day, night) of a project. */
function zw_hall_accent_pair( $post ) {
	$post = get_post( $post );
	$map  = zawaya_hall_accents();
	if ( $post && isset( $map[ $post->post_name ] ) ) {
		return $map[ $post->post_name ];
	}
	$fallback = array_values( $map );
	return $fallback[ $post ? abs( crc32( $post->post_name ) ) % count( $fallback ) : 0 ];
}

/** Day accent of a project. */
function zw_hall_accent( $post ) {
	$pair = zw_hall_accent_pair( $post );
	return $pair[0];
}

/** Inline style that sets both accents; the stylesheet picks one by day/night mode. */
function zw_hall_style( $post ) {
	$pair = zw_hall_accent_pair( $post );
	return 'style="--acc-d:' . esc_attr( $pair[0] ) . ';--acc-n:' . esc_attr( $pair[1] ) . '"';
}

/** One light card for the projects page. */
function zw_render_hall_card( $p ) {
	$type = get_post_meta( $p->ID, '_zw_type', true );
	$text = has_excerpt( $p ) ? get_the_excerpt( $p ) : wp_strip_all_tags( strip_shortcodes( $p->post_content ) );
	?>
	<a class="hall-card" href="<?php echo esc_url( get_permalink( $p ) ); ?>" <?php echo zw_hall_style( $p ); // phpcs:ignore ?>>
		<span class="hall-card-top"><img src="<?php echo esc_url( zw_project_logo( $p->ID, 'medium_large' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $p ) ); ?>" loading="lazy"></span>
		<span class="hall-card-body">
			<?php if ( $type ) : ?><span class="hall-pill"><?php echo esc_html( $type ); ?></span><?php endif; ?>
			<h3><?php echo esc_html( get_the_title( $p ) ); ?></h3>
			<?php zw_render_rating_chip( $p->ID ); ?>
			<span class="hall-card-text"><?php echo esc_html( wp_trim_words( $text, 16, '…' ) ); ?></span>
			<span class="hall-card-more">صفحة القاعة <i class="fa-solid fa-arrow-left"></i></span>
		</span>
	</a>
	<?php
}
