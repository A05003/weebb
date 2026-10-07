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

/** Accent colour by project slug (blends with navy + gold). */
function zawaya_hall_accents() {
	return array(
		'almasa'  => '#6F8FE8', // sapphire.
		'multaqa' => '#E0869F', // rose.
		'mawadda' => '#B24A72', // wine.
		'diyar'   => '#E08F5E', // copper.
		'helon'   => '#9B86E6', // lilac.
		'maali'   => '#E6B05A', // amber.
		'manar'   => '#6E8BB5', // steel blue.
	);
}

/** Accent colour of a project. */
function zw_hall_accent( $post ) {
	$post = get_post( $post );
	$map  = zawaya_hall_accents();
	if ( $post && isset( $map[ $post->post_name ] ) ) {
		return $map[ $post->post_name ];
	}
	$fallback = array_values( $map );
	return $fallback[ $post ? abs( crc32( $post->post_name ) ) % count( $fallback ) : 0 ];
}

/** One light card for the projects page. */
function zw_render_hall_card( $p ) {
	$type = get_post_meta( $p->ID, '_zw_type', true );
	$text = has_excerpt( $p ) ? get_the_excerpt( $p ) : wp_strip_all_tags( strip_shortcodes( $p->post_content ) );
	?>
	<a class="hall-card" href="<?php echo esc_url( get_permalink( $p ) ); ?>" style="--acc:<?php echo esc_attr( zw_hall_accent( $p ) ); ?>">
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
