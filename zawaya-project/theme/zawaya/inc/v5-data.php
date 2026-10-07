<?php
/**
 * Venue and review data for the v2 design (editable afterwards from Elementor).
 * Ratings and review counts come from Google Places (fetched 2026-10-06).
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** The five palaces. */
function zawaya_default_venues() {
	return array(
		array( 'lg-almasa.png', 'قصر الماسة', 'حي الجنادرية', '350-400 ضيف لكل قسم، وحديقة خارجية', '4.4', '1,168', 'ChIJFxXQuahVLj4RgLuvd6L65zg' ),
		array( 'lg-multaqa.png', 'قصر روعة الملتقى', 'حي المعيزيلة', 'حتى 400 ضيفة، وصالة طعام لـ 450', '4.2', '2,058', 'ChIJz4SgnpCqLz4RfZI4qZWblVg' ),
		array( 'lg-mawadda.png', 'قصر مودة', 'ظهرة نمار', 'حتى 450 ضيفة، ودرج زفة وممر رخامي', '4.1', '2,284', 'ChIJAeKfYLEQLz4R-v-M_03KlTo' ),
		array( 'lg-diyar.png', 'قصر ليالي الديار', 'حي الحزم', 'قاعة بلا أعمدة، وأكثر من حفل في الوقت نفسه', '4.4', '1,347', 'ChIJr0Da5okRLz4RU4TXX8BSoDk' ),
		array( 'lg-helon.png', 'قصر هيلون بالاس', 'حي الشفاء', 'قاعة بلا أعمدة، وأكثر من حفل في الوقت نفسه', '4.3', '1,432', 'ChIJUevfTG8OLz4RV881J2weL3c' ),
	);
}

/** Positive Google review excerpts (translated). */
function zawaya_default_reviews() {
	return array(
		array( 'قصر ليالي الديار', 'خدمة ممتازة ومواقف واسعة، والطاقم محترف جداً وما عندي أي ملاحظة.' ),
		array( 'قصر روعة الملتقى', 'خدمة رائعة وقيمة مقابل السعر، وكانت تجربتي في زواج صديق خمس نجوم.' ),
		array( 'قصر الماسة', 'قاعة أفراح كبيرة جداً بصالة طعام ومواقف واسعة.' ),
		array( 'قصر مودة', 'مكان نظيف وجميل، وليلة رائعة.' ),
		array( 'قصر ليالي الديار', 'مكان رائع ومنظّم، وإدارة ممتازة ومناسب للمناسبات الكبيرة.' ),
		array( 'قصر هيلون بالاس', 'مكان جميل للاجتماعات والأفراح والحفلات.' ),
		array( 'قصر روعة الملتقى', 'سعدت بحضور زواج صديق هناك، تنظيم وخدمة تستحق التقدير.' ),
	);
}

/** Google Maps link for a venue. */
function zawaya_venue_map_url( $name, $place_id ) {
	return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $name ) . '&query_place_id=' . rawurlencode( $place_id );
}

/** Render the logos strip shown under the hero. */
function zawaya_render_venue_logos( array $items ) {
	echo '<div class="zw-logos"><div class="zw-logos-in">';
	foreach ( $items as $v ) {
		$logo = ! empty( $v['logo']['url'] ) ? $v['logo']['url'] : ZAWAYA_URI . '/demo/logos/' . $v['logo_file'];
		printf(
			'<a href="%s" target="_blank" rel="noopener" aria-label="%s"><img src="%s" alt="%s" class="skip-lazy" data-no-lazy="1" loading="lazy" decoding="async"></a>',
			esc_url( zawaya_venue_map_url( $v['name'], $v['place_id'] ) ),
			esc_attr( $v['name'] ),
			esc_url( $logo ),
			esc_attr( $v['name'] )
		);
	}
	echo '</div></div>';
}

/** Render the venue cards. */
function zawaya_render_venue_cards( array $items ) {
	echo '<div class="zw-venues">';
	foreach ( $items as $v ) {
		$logo = ! empty( $v['logo']['url'] ) ? $v['logo']['url'] : ZAWAYA_URI . '/demo/logos/' . $v['logo_file'];
		echo '<article class="zw-venue">';
		printf( '<span class="zw-venue-logo"><img src="%s" alt="%s" class="skip-lazy" data-no-lazy="1" loading="lazy" decoding="async"></span>', esc_url( $logo ), esc_attr( $v['name'] ) );
		printf( '<h3>%s</h3><span class="zw-venue-dist">%s</span><p>%s</p>', esc_html( $v['name'] ), esc_html( $v['district'] . '، الرياض' ), esc_html( $v['capacity'] ) );
		if ( '' !== (string) $v['rating'] ) {
			printf(
				'<div class="zw-venue-rate"><span class="zw-stars" aria-hidden="true">★★★★★</span><b>%s</b><small>%s تقييم في Google</small></div>',
				esc_html( $v['rating'] ),
				esc_html( $v['count'] )
			);
		}
		printf( '<a class="zw-more" href="%s" target="_blank" rel="noopener">الموقع على الخريطة <i class="fa-solid fa-arrow-left"></i></a>', esc_url( zawaya_venue_map_url( $v['name'], $v['place_id'] ) ) );
		echo '</article>';
	}
	echo '</div>';
}

/** Render the reviews carousel. */
function zawaya_render_reviews( array $items, $note = '' ) {
	echo '<div class="zw-reviews" data-zw-reviews><div class="zw-rev-track">';
	foreach ( $items as $r ) {
		printf(
			'<figure class="zw-rev"><span class="zw-stars" aria-hidden="true">★★★★★</span><blockquote><p>«%s»</p></blockquote><figcaption><b>%s</b><small>مترجم من تقييمات Google</small></figcaption></figure>',
			esc_html( $r['text'] ),
			esc_html( $r['venue'] )
		);
	}
	echo '</div><div class="zw-rev-ctl"><button type="button" class="zw-rev-btn" data-dir="1" aria-label="التالي"><i class="fa-solid fa-arrow-left"></i></button><button type="button" class="zw-rev-btn" data-dir="-1" aria-label="السابق"><i class="fa-solid fa-arrow-right"></i></button></div></div>';
	if ( $note ) {
		echo '<p class="zw-rev-note">' . esc_html( $note ) . '</p>';
	}
}
