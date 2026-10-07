<?php
/**
 * Guest reviews and Google rating for each hall (shown on its own project page).
 * Defaults are used until the project's own fields are filled in (project edit screen).
 * Ratings and counts come from Google Places (2026-10-06); quotes are translated excerpts.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Default data by project slug: rating, review count, Google place id, quotes. */
function zawaya_default_project_reviews() {
	return array(
		'almasa'  => array( '4.4', '1,168', 'ChIJFxXQuahVLj4RgLuvd6L65zg', array( 'قاعة أفراح كبيرة جداً بصالة طعام ومواقف واسعة.' ) ),
		'multaqa' => array( '4.2', '2,058', 'ChIJz4SgnpCqLz4RfZI4qZWblVg', array( 'خدمة رائعة وقيمة مقابل السعر.', 'سعدت بتجربتي في زواج صديق، وأقيّمها خمس نجوم.' ) ),
		'mawadda' => array( '4.1', '2,284', 'ChIJAeKfYLEQLz4R-v-M_03KlTo', array( 'مكان نظيف وجميل جداً.', 'ليلة جميلة.' ) ),
		'diyar'   => array( '4.4', '1,347', 'ChIJr0Da5okRLz4RU4TXX8BSoDk', array( 'ممتاز بشكل عام: الخدمات رائعة والمواقف واسعة والطاقم محترف جداً، وما عندي أي ملاحظة.', 'مكان رائع ومنظّم، وإدارة ممتازة.', 'مكان مذهل ومناسب للمناسبات الكبيرة.' ) ),
		'helon'   => array( '4.3', '1,432', 'ChIJUevfTG8OLz4RV881J2weL3c', array( 'مكان جميل للتجمعات.', 'مكان مناسب للحفلات والأفراح.' ) ),
	);
}

/**
 * Reviews for one project: the project's own fields win, otherwise the defaults by slug.
 *
 * @param int $id Project id.
 * @return array|false rating, count, map url, quotes
 */
function zw_project_reviews( $id ) {
	$post     = get_post( $id );
	$defaults = zawaya_default_project_reviews();
	$d        = $post && isset( $defaults[ $post->post_name ] ) ? $defaults[ $post->post_name ] : array( '', '', '', array() );
	$rating   = trim( (string) get_post_meta( $id, '_zw_rating', true ) );
	$count    = trim( (string) get_post_meta( $id, '_zw_rating_count', true ) );
	$place    = trim( (string) get_post_meta( $id, '_zw_place_id', true ) );
	$quotes   = zw_lines( get_post_meta( $id, '_zw_reviews', true ) );
	$rating   = '' !== $rating ? $rating : $d[0];
	$count    = '' !== $count ? $count : $d[1];
	$place    = '' !== $place ? $place : $d[2];
	$quotes   = $quotes ? $quotes : $d[3];
	if ( ! $quotes && '' === $rating ) {
		return false;
	}
	$map = $place ? 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( get_the_title( $id ) ) . '&query_place_id=' . rawurlencode( $place ) : '';
	return array( $rating, $count, $map, $quotes );
}

/** Small rating chip under a project title in lists. */
function zw_render_rating_chip( $id ) {
	$r = zw_project_reviews( $id );
	if ( ! $r || '' === $r[0] ) {
		return;
	}
	printf(
		'<div class="zw-prj-chip"><span class="zw-prj-stars" aria-hidden="true">★</span><b>%s</b><span>%s</span></div>',
		esc_html( $r[0] ),
		$r[1] ? esc_html( $r[1] . ' تقييم في Google' ) : ''
	);
}

/** The reviews section of a project page. */
function zw_render_project_reviews( $id ) {
	$r = zw_project_reviews( $id );
	if ( ! $r ) {
		return;
	}
	list( $rating, $count, $map, $quotes ) = $r;
	?>
	<section class="section bg-soft zw-prj-rev">
		<div class="wrap">
			<div class="sec-title"><h2>آراء الضيوف في <?php echo esc_html( zw_short( $id ) ); ?></h2><span class="bar"></span></div>
			<?php if ( '' !== $rating ) : ?>
				<div class="zw-prj-sum">
					<span class="zw-prj-stars zw-prj-meter" style="--p:<?php echo esc_attr( min( 100, max( 0, (float) $rating * 20 ) ) ); ?>%" aria-hidden="true">★★★★★</span>
					<b><?php echo esc_html( $rating ); ?></b>
					<span>من 5<?php echo $count ? ' · ' . esc_html( $count ) . ' تقييم في Google' : ''; ?></span>
					<?php if ( $map ) : ?>
						<a class="zw-prj-maplink" href="<?php echo esc_url( $map ); ?>" target="_blank" rel="noopener">كل التقييمات على خرائط Google <i class="fa-solid fa-arrow-left"></i></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( $quotes ) : ?>
				<div class="zw-prj-quotes">
					<?php foreach ( $quotes as $q ) : ?>
						<figure class="zw-prj-quote"><blockquote><p>«<?php echo esc_html( $q ); ?>»</p></blockquote><figcaption>من تقييمات Google (مترجم)</figcaption></figure>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
}


/** Compact reviews block for a project row on the projects page. */
function zw_render_project_reviews_inline( $id ) {
	$r = zw_project_reviews( $id );
	if ( ! $r ) {
		return;
	}
	list( $rating, $count, $map, $quotes ) = $r;
	echo '<div class="zw-prj-inrev"><h3>آراء الضيوف</h3>';
	if ( '' !== $rating ) {
		echo '<div class="zw-prj-sum"><span class="zw-prj-stars zw-prj-meter" style="--p:' . esc_attr( min( 100, max( 0, (float) $rating * 20 ) ) ) . '%" aria-hidden="true">★★★★★</span><b>' . esc_html( $rating ) . '</b><span>من 5' . ( $count ? ' · ' . esc_html( $count ) . ' تقييم في Google' : '' ) . '</span>';
		if ( $map ) {
			echo '<a class="zw-prj-maplink" href="' . esc_url( $map ) . '" target="_blank" rel="noopener">كل التقييمات على خرائط Google</a>';
		}
		echo '</div>';
	}
	if ( $quotes ) {
		echo '<div class="zw-prj-quotes">';
		foreach ( $quotes as $q ) {
			echo '<figure class="zw-prj-quote"><blockquote><p>«' . esc_html( $q ) . '»</p></blockquote><figcaption>من تقييمات Google (مترجم)</figcaption></figure>';
		}
		echo '</div>';
	}
	echo '</div>';
}

/** Photo gallery of a project (thumbnails open in the lightbox). */
function zw_render_project_gallery( $id ) {
	$ids = array_filter( array_map( 'intval', explode( ',', (string) get_post_meta( $id, '_zw_gallery', true ) ) ) );
	if ( ! $ids ) {
		return;
	}
	echo '<div class="prj-gal">';
	foreach ( $ids as $img ) {
		$full = wp_get_attachment_image_url( $img, 'full' );
		if ( $full ) {
			echo '<a href="' . esc_url( $full ) . '" data-lightbox>' . wp_get_attachment_image( $img, 'zawaya-card', false, array( 'loading' => 'lazy' ) ) . '</a>'; // phpcs:ignore
		}
	}
	echo '</div>';
}

/** Single project URLs now lead to the project's block on the projects page. */
function zawaya_projects_redirect() {
	if ( ! is_singular( 'zawaya_project' ) || is_preview() || isset( $_GET['elementor-preview'] ) || is_customize_preview() ) { // phpcs:ignore
		return;
	}
	$post = get_queried_object();
	wp_safe_redirect( zw_page_url( 'projects' ) . '#' . $post->post_name, 301 );
	exit;
}
add_action( 'template_redirect', 'zawaya_projects_redirect' );
