<?php
/**
 * The site pages rebuilt as Elementor layouts (containers + widgets).
 * Texts are taken from the current Customizer values, so nothing is lost.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Page banner inside its own full-width section. */
function zawaya_layout_banner( $image, $next_bg = '' ) {
	return zwe_con(
		array(
			'content_width'  => 'full',
			'flex_direction' => 'column',
			'padding'        => zwe_box( 0 ),
			'flex_gap'       => zwe_gap( 0 ),
		),
		array( zwe_w( 'zawaya-banner', zwe_m( array( 'image' => zawaya_el_media( $image ) ), $next_bg ? zwe_glob( array( 'curve_color' => $next_bg ) ) : array() ) ) )
	);
}

/** Counter boxes (shared by home + about). */
function zawaya_layout_counters_grid() {
	$items = array();
	foreach ( zw_counters() as $c ) {
		$items[] = zwe_box_con(
			'column',
			array(
				zwe_image( array( 'url' => $c['icon'], 'id' => '' ), array( 'width' => zwe_size( 90 ), 'width_mobile' => zwe_size( 70 ), 'align' => 'center' ) ),
				zwe_w(
					'counter',
					zwe_m(
						array(
							'starting_number'         => 0,
							'ending_number'           => $c['value'],
							'prefix'                  => trim( $c['prefix'] ),
							'thousand_separator'      => 'yes',
							'thousand_separator_char' => ',',
							'title'                   => $c['label'],
							'_css_classes'            => 'zw-counter',
						),
						zwe_typo( 'typography_number', array( 50, 42, 32 ), 800, 1 ),
						zwe_typo( 'typography_title', array( 20, 19, 17 ), 500, 1.5 ),
						zwe_glob( array( 'number_color' => 'zwwhite', 'title_color' => 'zwgold' ) )
					)
				),
			),
			array(
				'flex_align_items' => 'center',
				'flex_gap'         => zwe_gap( 12 ),
			)
		);
	}
	return zwe_grid( array( 4, 2, 2 ), $items, array( 32, 24 ) );
}

/* ========================================================================== */
/* Home                                                                        */
/* ========================================================================== */
function zawaya_layout_home() {
	$video = trim( (string) zw_opt( 'hero_video' ) );
	$hero  = zawaya_el_media( 'hero.jpg', 'hero_image' );
	$out   = array();

	$venues = array();
	foreach ( zawaya_default_venues() as $v ) {
		$venues[] = array(
			'_id'       => zwe_id(),
			'name'      => $v[1],
			'logo_file' => $v[0],
			'district'  => $v[2],
			'capacity'  => $v[3],
			'rating'    => $v[4],
			'count'     => $v[5],
			'place_id'  => $v[6],
		);
	}
	$reviews = array();
	foreach ( zawaya_default_reviews() as $r ) {
		$reviews[] = array( '_id' => zwe_id(), 'venue' => $r[0], 'text' => $r[1] );
	}

	$hero_settings = array(
		'content_width'                    => 'boxed',
		'flex_direction'                   => 'column',
		'flex_justify_content'             => 'center',
		'flex_align_items'                 => 'flex-start',
		'flex_gap'                         => zwe_gap( 6 ),
		'min_height'                       => zwe_size( 72, 'vh' ),
		'min_height_mobile'                => zwe_size( 64, 'vh' ),
		'padding'                          => zwe_box( 90, 16, 70, 16 ),
		'padding_mobile'                   => zwe_box( 60, 16, 50, 16 ),
		'background_overlay_background'    => 'classic',
		'background_overlay_color'         => '#18203B',
		'background_overlay_opacity'       => zwe_size( 0.62 ),
		'_css_classes'                     => 'zw-hero',
		'overflow'                         => 'hidden',
	);
	if ( $video ) {
		$hero_settings += array(
			'background_background'     => 'video',
			'background_video_link'     => 'https://www.youtube.com/watch?v=' . $video,
			'background_video_fallback' => array( 'url' => $hero['url'], 'id' => $hero['id'] ),
			'background_play_once'      => '',
			'background_play_on_mobile' => '',
			'background_privacy_mode'   => 'yes',
			'background_color'          => '#18203B',
		);
	} else {
		$hero_settings += array(
			'background_background' => 'classic',
			'background_image'      => array( 'url' => $hero['url'], 'id' => $hero['id'] ),
			'background_position'   => 'center center',
			'background_size'       => 'cover',
			'background_color'      => '#18203B',
		);
	}
	$out[] = zwe_con(
		$hero_settings,
		array(
			zwe_heading( zw_opt( 'hero_l1' ), 'h1', 'zwgold', array( 34, 30, 24 ), 600, 1.5, array( 'align' => 'right' ) ),
			zwe_heading( zw_opt( 'hero_l2' ), 'p', 'zwwhite', array( 64, 48, 36 ), 600, 1.35, array( 'align' => 'right' ) ),
			zwe_heading( zw_opt( 'hero_l3' ), 'p', 'zwgold', array( 64, 48, 36 ), 600, 1.35, array( 'align' => 'right' ) ),
			zwe_box_con(
				'row',
				array(
					zwe_button( 'احجز مناسبتك', zw_contact_url(), 'gold' ),
					zwe_button( 'شاهد قصورنا', '#venues', 'outline', array( '_css_classes' => 'zw-btn zw-btn-ghost' ) ),
				),
				array( 'flex_gap' => zwe_gap( 14 ), 'flex_wrap' => 'wrap' )
			),
		)
	);

	// Venue logos strip (under the hero).
	$out[] = zwe_con(
		array(
			'content_width'  => 'full',
			'flex_direction' => 'column',
			'padding'        => zwe_box( 0 ),
			'flex_gap'       => zwe_gap( 0 ),
			'_css_classes'   => 'zw-logos-sec',
		),
		array( zwe_w( 'zawaya-venues', array( 'mode' => 'logos', 'items' => $venues ) ) )
	);

	// Numbers.
	$out[] = zwe_section(
		'zwnavy',
		array( zawaya_layout_counters_grid() ),
		array( 'padding' => zwe_box( 64, 16, 64, 16 ), 'padding_mobile' => zwe_box( 44, 16, 44, 16 ) )
	);

	// About (story + photo + vision / mission).
	$about_img = zawaya_el_media( 'about-main.jpg' );
	$out[]     = zwe_section(
		'zwsoft',
		array(
			zwe_grid(
				array( 3, 1, 1 ),
				array(
					zwe_box_con(
						'column',
						array(
							zwe_heading( 'شركة عائلية في صناعة المناسبات منذ أكثر من تسعة أعوام', 'h2', 'zwhead', array( 34, 30, 26 ), 600, 1.4, array( 'align' => 'right' ) ),
							zwe_text( 'نُدير خمسة قصور للأفراح والمؤتمرات في الرياض، ومعها مطاعم زوايا المعالي للبوفيه المفتوح والضيافة، وفريق تقني للإضاءة والعروض.', 'zwtext', 17, 1.9 ),
							zwe_button( 'تعرّف علينا', zw_page_url( 'about-us' ), 'outline' ),
						)
					),
					zwe_w( 'html', array( 'html' => '<figure class="zw-leaf-img-fig"><img class="skip-lazy" data-no-lazy="1" src="' . esc_url( $about_img['url'] ) . '" alt="استقبال الضيوف في إحدى مناسبات زوايا المعالي" width="900" height="506" loading="lazy" decoding="async"></figure>' ) ),
					zwe_box_con(
						'column',
						array(
							zwe_heading( 'رؤيتنا', 'h3', 'zwhead', array( 24, 22, 20 ), 600, 1.4, array( 'align' => 'right' ) ),
							zwe_text( 'أن نكون الوجهة الأولى في إدارة وتشغيل قصور الأفراح وصناعة المناسبات في المملكة.', 'zwtext', 16, 1.8 ),
							zwe_heading( 'رسالتنا', 'h3', 'zwhead', array( 24, 22, 20 ), 600, 1.4, array( 'align' => 'right', '_css_classes' => 'zw-dash-top' ) ),
							zwe_text( 'خدمات مبتكرة بأعلى معايير الجودة، وتجارب تعكس الإبداع والأصالة.', 'zwtext', 16, 1.8 ),
						)
					),
				),
				array( 36, 28 ),
				array( 'grid_columns_grid' => zwe_size( 3, 'fr' ), '_css_classes' => 'zw-about3' )
			),
		)
	);

	// Services (flip cards).
	$cards = array();
	foreach ( zw_services() as $s ) {
		$tid     = (int) get_post_thumbnail_id( $s );
		$cards[] = array(
			'_id'   => zwe_id(),
			'image' => array( 'url' => (string) get_the_post_thumbnail_url( $s, 'zawaya-square' ), 'id' => $tid ? $tid : '' ),
			'title' => get_the_title( $s ),
			'text'  => has_excerpt( $s ) ? get_the_excerpt( $s ) : wp_trim_words( wp_strip_all_tags( $s->post_content ), 20, '…' ),
			'btn'   => 'عرض المزيد',
			'link'  => zwe_link( zw_page_url( 'services' ) ),
		);
	}
	if ( ! $cards ) {
		foreach ( zawaya_demo_services() as $s ) {
			$cards[] = array(
				'_id'   => zwe_id(),
				'image' => zawaya_el_media( $s['img'] ),
				'title' => $s['title'],
				'text'  => $s['card'],
				'btn'   => 'عرض المزيد',
				'link'  => zwe_link( zw_page_url( 'services' ) ),
			);
		}
	}
	$out[] = zwe_section(
		'zwbg',
		array(
			zwe_title( zw_opt( 'services_title' ) ),
			zwe_w(
				'zawaya-flip-cards',
				array(
					'items'    => $cards,
					'autoplay' => zw_opt( 'autoplay' ) ? 'yes' : '',
				)
			),
		),
		array( 'overflow' => 'hidden' )
	);

	// Venues (cards with Google rating and map link).
	$out[] = zwe_section(
		'zwnavy',
		array(
			zwe_title( 'خمسة قصور نُديرها في الرياض', 'zwgold' ),
			zwe_w( 'zawaya-venues', array( 'mode' => 'cards', 'items' => $venues ) ),
		),
		array( 'css_id' => 'venues' )
	);

	// Reviews.
	$out[] = zwe_section(
		'zwsoft',
		array(
			zwe_title( 'ماذا قال ضيوفنا في قصورنا' ),
			zwe_w(
				'zawaya-reviews',
				array(
					'items' => $reviews,
					'note'  => 'مقتطفات إيجابية من تقييمات Google للقصور الخمسة. إجمالي التقييمات 8,289 بمتوسط 4.3 من 5.',
				)
			),
		)
	);

	// Contact.
	$out[] = zwe_section(
		'zwbg',
		array(
			zwe_title( zw_opt( 'contact_title' ) ),
			zwe_w( 'zawaya-contact-form', array( 'max' => zwe_size( 860 ) ) ),
		),
		array( 'padding' => zwe_box( 40, 16, 104, 16 ), 'padding_mobile' => zwe_box( 32, 16, 60, 16 ) )
	);

	return $out;
}

/* ========================================================================== */
/* About                                                                       */
/* ========================================================================== */
function zawaya_layout_about() {
	$out   = array();
	$out[] = zawaya_layout_banner( 'about-banner.jpg' );

	// Story.
	$paras = '';
	foreach ( array( 'about_p1', 'about_p2' ) as $k ) {
		if ( zw_opt( $k ) ) {
			$paras .= '<p>' . esc_html( zw_opt( $k ) ) . '</p>';
		}
	}
	$text_col = zwe_box_con(
		'column',
		array(
			zwe_heading( zw_opt( 'about_kicker' ), 'h6', 'zwgold', array( 17 ), 700, 1.6 ),
			zwe_heading( zw_opt( 'about_title' ), 'h2', 'zwhead', array( 40, 34, 28 ), 800, 1.4 ),
			zwe_text( $paras, 'zwtext', 17, 2, array( '_css_classes' => 'zw-paras' ) ),
			zwe_box_con(
				'row',
				array(
					zwe_button( 'خدماتنا', zw_page_url( 'services' ), 'navy' ),
					zwe_button( 'تواصل معنا', zw_contact_url(), 'outline' ),
				),
				array( 'flex_gap' => zwe_gap( 12 ), 'flex_wrap' => 'wrap', 'width' => zwe_size( 100, '%' ) )
			),
		),
		array(
			'flex_gap'     => zwe_gap( 18 ),
			'width'        => zwe_size( 50, '%' ),
			'width_tablet' => zwe_size( 100, '%' ),
		)
	);

	$media_kids = array(
		zwe_image( zawaya_el_media( 'about-main.jpg', 'about_img1' ), array( '_css_classes' => 'zw-collage-main' ) ),
		zwe_image( zawaya_el_media( 'about-hospitality.jpg', 'about_img2' ), array( '_css_classes' => 'zw-collage-sm' ) ),
		zwe_image( zawaya_el_media( 'about-hall.jpg', 'about_img3' ), array( '_css_classes' => 'zw-collage-sm' ) ),
	);
	if ( zw_opt( 'about_badge' ) ) {
		$media_kids[] = zwe_con(
			array(
				'content_width'         => 'full',
				'flex_direction'        => 'column',
				'flex_align_items'      => 'center',
				'flex_gap'              => zwe_gap( 4 ),
				'padding'               => zwe_box( 16, 22, 16, 22 ),
				'background_background' => 'classic',
				'border_radius'         => zwe_box( 12 ),
				'_css_classes'          => 'zw-badge',
				'__globals__'           => array( 'background_color' => 'globals/colors?id=zwnavy' ),
			),
			array(
				zwe_heading( zw_opt( 'about_badge' ), 'div', 'zwgold', array( 40, 34, 26 ), 800, 1, array( '_css_classes' => 'zw-ltr' ) ),
				zwe_heading( zw_opt( 'about_badge_t' ), 'div', 'zwwhite', array( 14 ), 500, 1.4 ),
			)
		);
	}
	$media_col = zwe_grid(
		array( 2, 2, 2 ),
		$media_kids,
		14,
		array(
			'_css_classes'      => 'zw-collage',
			'width'             => zwe_size( 50, '%' ),
			'width_tablet'      => zwe_size( 100, '%' ),
			'grid_rows_grid'        => array( 'unit' => 'custom', 'size' => 'auto auto', 'sizes' => array() ),
			'grid_rows_grid_tablet' => array( 'unit' => 'custom', 'size' => 'auto auto', 'sizes' => array() ),
			'grid_rows_grid_mobile' => array( 'unit' => 'custom', 'size' => 'auto auto', 'sizes' => array() ),
		)
	);

	$out[] = zwe_section(
		'zwbg',
		array(
			zwe_box_con(
				'row',
				array( $text_col, $media_col ),
				array(
					'flex_direction_tablet' => 'column',
					'flex_gap'              => zwe_gap( 56 ),
					'flex_align_items'      => 'center',
					'flex_wrap'             => 'nowrap',
				)
			),
		),
		array( 'padding' => zwe_box( 120, 16, 120, 16 ) )
	);

	// Numbers.
	$out[] = zwe_section( 'zwnavydk', array( zawaya_layout_counters_grid() ), array( 'padding' => zwe_box( 88, 16, 88, 16 ) ) );

	// Vision & mission.
	$vm = array();
	foreach ( array( array( 'الرؤية', 'vision', 'fas fa-eye', 'zwnavy' ), array( 'الرسالة', 'mission', 'fas fa-bullseye', 'zwnavydk' ) ) as $c ) {
		$vm[] = zwe_con(
			zwe_m(
				array(
					'content_width'         => 'full',
					'flex_direction'        => 'column',
					'padding'               => zwe_box( 44, 40, 44, 40 ),
					'padding_mobile'        => zwe_box( 32, 24, 32, 24 ),
					'background_background' => 'classic',
					'border_radius'         => zwe_box( 16 ),
					'_css_classes'          => 'zw-vm',
				),
				zwe_glob( array( 'background_color' => $c[3] ) )
			),
			array(
				zwe_w(
					'icon-box',
					zwe_m(
						array(
							'selected_icon'    => zwe_icon( $c[2] ),
							'view'             => 'framed',
							'shape'            => 'circle',
							'title_text'       => $c[0],
							'description_text' => zw_opt( $c[1] ),
							'title_size'       => 'h2',
							'text_align'       => 'start',
							'icon_size'        => zwe_size( 24 ),
							'icon_padding'     => zwe_size( 16 ),
							'border_width'     => zwe_box( 2 ),
							'icon_space'       => zwe_size( 16 ),
							'title_bottom_space' => zwe_size( 14 ),
						),
						zwe_typo( 'title_typography', array( 34, 30, 24 ), 700, 1.4 ),
						zwe_typo( 'description_typography', array( 18, 18, 16 ), 400, 1.9 ),
						zwe_glob( array( 'primary_color' => 'zwgold', 'title_color' => 'zwgold', 'description_color' => 'zwwhite' ) )
					)
				),
			)
		);
	}
	$out[] = zwe_section( 'zwsoft', array( zwe_grid( array( 2, 2, 1 ), $vm, 24 ) ) );

	// Goals.
	$goals = array();
	for ( $i = 1; $i <= 5; $i++ ) {
		if ( ! zw_opt( "g{$i}_title" ) ) {
			continue;
		}
		$goals[] = zwe_w(
			'icon-box',
			zwe_m(
				array(
					'selected_icon'      => zwe_icon( zawaya_fa5( zw_opt( "g{$i}_icon" ) ) ),
					'view'               => 'stacked',
					'shape'              => 'square',
					'title_text'         => zw_opt( "g{$i}_title" ),
					'description_text'   => zw_opt( "g{$i}_text" ),
					'title_size'         => 'h3',
					'text_align'         => 'start',
					'icon_size'          => zwe_size( 22 ),
					'icon_padding'       => zwe_size( 16 ),
					'border_radius'      => zwe_box( 12 ),
					'icon_space'         => zwe_size( 14 ),
					'title_bottom_space' => zwe_size( 10 ),
					'_css_classes'       => 'zw-card zw-goal',
				),
				zwe_typo( 'title_typography', array( 21, 20, 19 ), 700, 1.4 ),
				zwe_typo( 'description_typography', array( 16, 16, 15 ), 400, 1.9 ),
				zwe_glob( array( 'primary_color' => 'zwnavy', 'secondary_color' => 'zwgold', 'title_color' => 'zwhead', 'description_color' => 'zwtext' ) )
			)
		);
	}
	$out[] = zwe_section( 'zwbg', array( zwe_title( zw_opt( 'goals_title' ), 'zwhead', true ), zwe_grid( array( 3, 2, 1 ), $goals, 20 ) ) );

	// Values.
	$values = array();
	for ( $i = 1; $i <= 6; $i++ ) {
		if ( ! zw_opt( "v{$i}_title" ) ) {
			continue;
		}
		$values[] = zwe_w(
			'icon-box',
			zwe_m(
				array(
					'selected_icon'      => zwe_icon( zawaya_fa5( zw_opt( "v{$i}_icon" ) ) ),
					'view'               => 'stacked',
					'shape'              => 'circle',
					'title_text'         => zw_opt( "v{$i}_title" ),
					'description_text'   => zw_opt( "v{$i}_text" ),
					'title_size'         => 'h3',
					'text_align'         => 'center',
					'icon_size'          => zwe_size( 40 ),
					'icon_size_mobile'   => zwe_size( 30 ),
					'icon_padding'       => zwe_size( 28 ),
					'icon_space'         => zwe_size( 20 ),
					'title_bottom_space' => zwe_size( 12 ),
					'_css_classes'       => 'zw-value',
				),
				zwe_typo( 'title_typography', array( 22, 21, 20 ), 700, 1.4 ),
				zwe_typo( 'description_typography', array( 16, 16, 15 ), 400, 1.8 ),
				zwe_glob( array( 'primary_color' => 'zwnavydk', 'secondary_color' => 'zwgold', 'title_color' => 'zwgold', 'description_color' => 'zwwhite' ) )
			)
		);
	}
	$out[] = zwe_section( 'zwnavy', array( zwe_title( zw_opt( 'values_title' ), 'zwgold', true ), zwe_grid( array( 3, 2, 1 ), $values, array( 40, 24 ) ) ) );

	// Group companies.
	$out[] = zwe_section(
		'zwbg',
		array(
			zwe_title( zw_opt( 'group_title' ), 'zwhead', true ),
			zwe_w( 'zawaya-projects', array( 'layout' => 'grid' ) ),
		)
	);

	return $out;
}

/* ========================================================================== */
/* Services                                                                    */
/* ========================================================================== */
function zawaya_layout_service_item( $title, $icon, $img, $body ) {
	return zwe_box_con(
		'column',
		array(
			zwe_image( $img, array( '_css_classes' => 'zw-svc-img' ) ),
			zwe_w(
				'icon',
				zwe_m(
					array(
						'selected_icon' => zwe_icon( zawaya_fa5( $icon ) ),
						'view'          => 'stacked',
						'shape'         => 'circle',
						'align'         => 'start',
						'size'          => zwe_size( 22 ),
						'icon_padding'  => zwe_size( 16 ),
						'_css_classes'  => 'zw-svc-ic',
					),
					zwe_glob( array( 'primary_color' => 'zwnavy', 'secondary_color' => 'zwgold' ) )
				)
			),
			zwe_heading( $title, 'h2', 'zwhead', array( 28, 26, 22 ), 800, 1.4 ),
			zwe_w(
				'divider',
				zwe_m(
					array(
						'width'  => zwe_size( 56 ),
						'weight' => zwe_size( 3 ),
						'align'  => 'start',
						'gap'    => zwe_size( 2 ),
					),
					zwe_glob( array( 'color' => 'zwgold' ) )
				)
			),
			zwe_text( '<p>' . esc_html( $body ) . '</p>', 'zwtext', 16.5, 2 ),
			zwe_button( 'اطلب الخدمة', zw_contact_url(), 'link', array( 'selected_icon' => zwe_icon( 'fas fa-arrow-left' ), 'icon_align' => 'row-reverse', 'icon_indent' => zwe_size( 8 ), 'align' => 'start' ) ),
		),
		array( 'flex_gap' => zwe_gap( 14 ), '_css_classes' => 'zw-svc' )
	);
}

function zawaya_layout_services() {
	$out   = array();
	$out[] = zawaya_layout_banner( 'about-hospitality.jpg' );

	$items = array();
	foreach ( zw_services() as $s ) {
		$tid     = (int) get_post_thumbnail_id( $s );
		$items[] = zawaya_layout_service_item(
			get_the_title( $s ),
			get_post_meta( $s->ID, '_zw_icon', true ) ?: 'fa-solid fa-star',
			array( 'url' => (string) get_the_post_thumbnail_url( $s, 'zawaya-square' ), 'id' => $tid ? $tid : '' ),
			wp_strip_all_tags( $s->post_content )
		);
	}
	if ( ! $items ) {
		foreach ( zawaya_demo_services() as $s ) {
			$items[] = zawaya_layout_service_item( $s['title'], $s['icon'], zawaya_el_media( $s['img'] ), $s['body'] );
		}
	}
	$cols = array( array(), array() );
	foreach ( $items as $i => $it ) {
		$cols[ $i % 2 ][] = $it;
	}
	$col_cons = array();
	foreach ( $cols as $i => $kids ) {
		$col_cons[] = zwe_box_con(
			'column',
			$kids,
			array(
				'flex_gap'       => zwe_gap( 64 ),
				'flex_gap_mobile' => zwe_gap( 48 ),
				'width'          => zwe_size( 50, '%' ),
				'width_tablet'   => zwe_size( 100, '%' ),
				'padding'        => 0 === $i ? zwe_box( 120, 0, 0, 0 ) : zwe_box( 0 ),
				'padding_tablet' => zwe_box( 0 ),
			)
		);
	}
	$out[] = zwe_section(
		'zwbg',
		array(
			zwe_box_con(
				'row',
				$col_cons,
				array(
					'flex_direction_tablet' => 'column',
					'flex_gap'              => zwe_gap( 56 ),
					'flex_gap_tablet'       => zwe_gap( 48 ),
					'flex_wrap'             => 'nowrap',
				)
			),
		),
		array( 'padding' => zwe_box( 120, 16, 136, 16 ) )
	);
	return $out;
}

/* ========================================================================== */
/* Projects                                                                    */
/* ========================================================================== */
function zawaya_layout_projects() {
	return array(
		zawaya_layout_banner( 'hero.jpg' ),
		zwe_con(
			array(
				'content_width'  => 'full',
				'flex_direction' => 'column',
				'padding'        => zwe_box( 0 ),
				'flex_gap'       => zwe_gap( 0 ),
			),
			array( zwe_w( 'zawaya-projects', array( 'layout' => 'list', 'tabs' => 'yes' ) ) )
		),
	);
}

/* ========================================================================== */
/* Contact                                                                     */
/* ========================================================================== */
function zawaya_layout_contact() {
	$phone = zw_opt( 'phone' );
	$email = zw_opt( 'email' );
	$addr  = zw_opt( 'address' );
	$map   = zw_opt( 'maps_url' );
	$wa    = zw_wa_link();
	$out   = array();
	$out[] = zawaya_layout_banner( 'about-main.jpg', 'zwsoft' );

	$card = function ( $svg, $title, $desc, $url, $ext = false ) {
		return zwe_w(
			'image-box',
			zwe_m(
				array(
					'image'            => array( 'url' => zw_img( $svg ), 'id' => '', 'source' => 'library' ),
					'title_text'       => $title,
					'description_text' => $desc,
					'link'             => zwe_link( $url, $ext ),
					'title_size'       => 'h3',
					'text_align'       => 'center',
					'image_size'       => zwe_size( 60 ),
					'image_space'      => zwe_size( 12 ),
					'title_bottom_space' => zwe_size( 6 ),
					'_css_classes'     => 'zw-card zw-info',
				),
				zwe_typo( 'title_typography', array( 18 ), 700, 1.5 ),
				zwe_typo( 'description_typography', array( 16 ), 400, 1.6 ),
				zwe_glob( array( 'title_color' => 'zwhead', 'description_color' => 'zwtext' ) )
			)
		);
	};
	$cards = array();
	if ( $phone ) {
		$cards[] = $card( 'phone.svg', 'الهاتف', '<span dir="ltr">' . esc_html( $phone ) . '</span>', zw_tel( $phone ) );
	}
	if ( $email ) {
		$cards[] = $card( 'mail.svg', 'البريد', esc_html( $email ), 'mailto:' . $email );
	}
	if ( $addr ) {
		$cards[] = $card( 'pin.svg', 'المقر الرئيسي', esc_html( $addr ), $map ? $map : '#', true );
	}
	$out[] = zwe_section( 'zwsoft', array( zwe_grid( array( count( $cards ), 1, 1 ), $cards, 20 ) ), array( 'padding' => zwe_box( 104, 16, 16, 16 ), 'padding_mobile' => zwe_box( 56, 16, 12, 16 ) ) );

	$form_card = zwe_con(
		zwe_m(
			array(
				'content_width'         => 'full',
				'flex_direction'        => 'column',
				'flex_gap'              => zwe_gap( 26 ),
				'padding'               => zwe_box( 40 ),
				'padding_mobile'        => zwe_box( 24 ),
				'background_background' => 'classic',
				'border_radius'         => zwe_box( 16 ),
				'width'                 => zwe_size( 55, '%' ),
				'width_tablet'          => zwe_size( 100, '%' ),
			),
			zwe_glob( array( 'background_color' => 'zwcard' ) )
		),
		array(
			zwe_heading( 'أرسل لنا رسالة', 'h2', 'zwhead', array( 32, 28, 23 ), 700, 1.4 ),
			zwe_w( 'zawaya-contact-form', array() ),
		)
	);

	$side = array(
		zwe_w(
			'google_maps',
			array(
				'address'      => $addr ? $addr : 'Riyadh',
				'zoom'         => zwe_size( 14 ),
				'height'       => zwe_size( 340 ),
				'_css_classes' => 'zw-map',
			)
		),
	);
	if ( $map ) {
		$side[] = zwe_button( 'افتح موقعنا على خرائط Google', $map, 'outline', array( 'selected_icon' => zwe_icon( 'fas fa-map-marker-alt' ), 'icon_indent' => zwe_size( 8 ), 'align' => 'justify' ), true );
	}
	if ( $wa ) {
		$side[] = zwe_w(
			'icon-box',
			zwe_m(
				array(
					'selected_icon'      => zwe_icon( 'fab fa-whatsapp' ),
					'view'               => 'default',
					'title_text'         => 'تواصل عبر واتساب',
					'description_text'   => 'رد سريع على استفساراتكم',
					'link'               => zwe_link( $wa, true ),
					'position'           => 'inline-start',
					'content_vertical_alignment' => 'middle',
					'text_align'         => 'start',
					'title_size'         => 'h3',
					'icon_size'          => zwe_size( 40 ),
					'icon_space'         => zwe_size( 16 ),
					'title_bottom_space' => zwe_size( 2 ),
					'_padding'           => zwe_box( 22, 26, 22, 26 ),
					'_background_background' => 'classic',
					'_border_radius'     => zwe_box( 16 ),
					'_css_classes'       => 'zw-wa-card',
				),
				zwe_typo( 'title_typography', array( 18 ), 700, 1.4 ),
				zwe_typo( 'description_typography', array( 14 ), 400, 1.5 ),
				zwe_glob( array( 'primary_color' => 'zwgold', 'title_color' => 'zwgold', 'description_color' => 'zwwhite', '_background_color' => 'zwnavy' ) )
			)
		);
	}
	$side_col = zwe_box_con( 'column', $side, array( 'width' => zwe_size( 45, '%' ), 'width_tablet' => zwe_size( 100, '%' ) ) );

	$out[] = zwe_section(
		'zwsoft',
		array(
			zwe_box_con(
				'row',
				array( $form_card, $side_col ),
				array(
					'flex_direction_tablet' => 'column',
					'flex_gap'              => zwe_gap( 28 ),
					'flex_align_items'      => 'stretch',
					'flex_wrap'             => 'nowrap',
				)
			),
		),
		array( 'padding' => zwe_box( 40, 16, 120, 16 ), 'padding_mobile' => zwe_box( 24, 16, 64, 16 ) )
	);
	return $out;
}

/** FA6 class names (Customizer) -> Elementor's Font Awesome names. */
function zawaya_fa5( $cls ) {
	$cls = trim( (string) $cls );
	$map = array(
		'fa-wand-magic-sparkles' => 'fa-magic',
		'fa-shield-halved'       => 'fa-shield-alt',
		'fa-circle-check'        => 'fa-check-circle',
		'fa-location-dot'        => 'fa-map-marker-alt',
		'fa-phone'               => 'fa-phone-alt',
		'fa-x-twitter'           => 'fa-twitter',
	);
	$style = 'fas';
	if ( false !== strpos( $cls, 'fa-brands' ) || 0 === strpos( $cls, 'fab ' ) ) {
		$style = 'fab';
	} elseif ( false !== strpos( $cls, 'fa-regular' ) || 0 === strpos( $cls, 'far ' ) ) {
		$style = 'far';
	}
	$name = 'fa-star';
	foreach ( preg_split( '/\s+/', $cls ) as $part ) {
		if ( 0 === strpos( $part, 'fa-' ) && ! in_array( $part, array( 'fa-solid', 'fa-regular', 'fa-brands' ), true ) ) {
			$name = $part;
		}
	}
	return $style . ' ' . ( isset( $map[ $name ] ) ? $map[ $name ] : $name );
}
