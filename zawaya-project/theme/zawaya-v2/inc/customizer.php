<?php
/**
 * Customizer (المظهر ← تخصيص) — every text, number, link and image of the site.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function zawaya_customizer_schema() {
	$s = array(
		'zw_contact' => array(
			'title'  => 'معلومات التواصل',
			'fields' => array(
				'phone'      => array( 'الهاتف', 'text' ),
				'email'      => array( 'البريد الإلكتروني (يظهر في الموقع)', 'email' ),
				'form_to'    => array( 'بريد استقبال رسائل النموذج', 'email', 'إذا تركته فارغاً تصل الرسائل إلى البريد أعلاه. كل الرسائل تُحفظ أيضاً في لوحة التحكم ← رسائل التواصل.' ),
				'address'    => array( 'العنوان', 'text' ),
				'maps_url'   => array( 'رابط الموقع على خرائط Google', 'url' ),
				'maps_embed' => array( 'رابط تضمين الخريطة (اختياري)', 'url', 'من خرائط Google: مشاركة ← تضمين خريطة ← انسخ الرابط داخل src فقط. يظهر في صفحة تواصل معنا.' ),
				'whatsapp'   => array( 'رقم واتساب (بالصيغة الدولية)', 'text', 'مثال: 966570001853' ),
				'wa_float'   => array( 'إظهار زر واتساب العائم', 'checkbox' ),
			),
		),
		'zw_social'  => array(
			'title'  => 'حسابات التواصل الاجتماعي',
			'desc'   => 'اترك أي حقل فارغاً لإخفاء أيقونته.',
			'fields' => array(
				'tiktok'    => array( 'TikTok', 'url' ),
				'x'         => array( 'X (تويتر)', 'url' ),
				'snapchat'  => array( 'Snapchat', 'url' ),
				'instagram' => array( 'Instagram', 'url' ),
				'linkedin'  => array( 'LinkedIn', 'url' ),
				'youtube'   => array( 'YouTube', 'url' ),
			),
		),
		'zw_hero'    => array(
			'title'  => 'الرئيسية: الواجهة',
			'fields' => array(
				'hero_image'     => array( 'صورة الخلفية', 'image', 'تظهر قبل تشغيل الفيديو وعند عدم وجوده.' ),
				'hero_video'     => array( 'فيديو يوتيوب (المعرّف فقط)', 'text', 'مثال: من الرابط youtube.com/watch?v=j51hK5eKZCU انسخ j51hK5eKZCU. اتركه فارغاً لإيقاف الفيديو.' ),
				'hero_show_text' => array( 'إظهار العبارات', 'checkbox' ),
				'hero_l1'        => array( 'السطر الأول (ذهبي صغير)', 'text' ),
				'hero_l2'        => array( 'السطر الثاني (أبيض كبير)', 'text' ),
				'hero_l3'        => array( 'السطر الثالث (ذهبي كبير)', 'text' ),
				'hero_overlay'   => array( 'شدة التعتيم فوق الصورة %', 'range', '', array( 'min' => 0, 'max' => 90, 'step' => 5 ) ),
				'hero_height'    => array( 'ارتفاع الواجهة (من الشاشة) %', 'range', '', array( 'min' => 50, 'max' => 100, 'step' => 5 ) ),
			),
		),
		'zw_counters' => array(
			'title'  => 'الأرقام (الرئيسية ومن نحن)',
			'fields' => array(
				'counters_title' => array( 'عنوان القسم', 'text' ),
			),
		),
		'zw_home'    => array(
			'title'  => 'الرئيسية: باقي الأقسام',
			'fields' => array(
				'services_title' => array( 'عنوان قسم الخدمات', 'text' ),
				'projects_title' => array( 'عنوان قسم المشاريع', 'text' ),
				'partners_title' => array( 'عنوان شركاء النجاح', 'text', 'الشركاء يُضافون من لوحة التحكم ← شركاء النجاح. القسم يختفي إذا لم يوجد شركاء.' ),
				'contact_title'  => array( 'عنوان نموذج التواصل', 'text' ),
				'autoplay'       => array( 'تحريك الشرائح تلقائياً', 'checkbox' ),
				'seo_home_desc'  => array( 'وصف الموقع لمحركات البحث', 'textarea' ),
			),
		),
		'zw_about'   => array(
			'title'  => 'صفحة من نحن',
			'desc'   => 'صورة الخلفية والعبارة تحت العنوان تُعدَّل من الصفحة نفسها (الصورة البارزة + المقتطف).',
			'fields' => array(
				'about_kicker'  => array( 'العبارة الصغيرة', 'text' ),
				'about_title'   => array( 'العنوان', 'text' ),
				'about_p1'      => array( 'الفقرة الأولى', 'textarea' ),
				'about_p2'      => array( 'الفقرة الثانية', 'textarea' ),
				'about_img1'    => array( 'الصورة الكبيرة', 'image' ),
				'about_img2'    => array( 'الصورة الصغيرة 1', 'image' ),
				'about_img3'    => array( 'الصورة الصغيرة 2', 'image' ),
				'about_badge'   => array( 'رقم الشارة', 'text' ),
				'about_badge_t' => array( 'نص الشارة', 'text' ),
				'vision'        => array( 'الرؤية', 'textarea' ),
				'mission'       => array( 'الرسالة', 'textarea' ),
				'goals_title'   => array( 'عنوان الأهداف', 'text' ),
				'values_title'  => array( 'عنوان القيم', 'text' ),
				'group_title'   => array( 'عنوان شعارات الشركات', 'text' ),
			),
		),
		'zw_footer'  => array(
			'title'  => 'الفوتر',
			'fields' => array(
				'footer_kicker' => array( 'العبارة الذهبية', 'text' ),
				'footer_text'   => array( 'نبذة الشركة', 'textarea' ),
				'copyright'     => array( 'حقوق النشر', 'text', 'اكتب {year} ليظهر العام الحالي تلقائياً.' ),
			),
		),
	);

	for ( $i = 1; $i <= 4; $i++ ) {
		$s['zw_counters']['fields'][ "c{$i}_label" ]  = array( "الرقم {$i}: العنوان", 'text', 1 === $i ? 'اترك العنوان فارغاً لإخفاء الرقم.' : '' );
		$s['zw_counters']['fields'][ "c{$i}_value" ]  = array( "الرقم {$i}: القيمة", 'number' );
		$s['zw_counters']['fields'][ "c{$i}_prefix" ] = array( "الرقم {$i}: رمز قبل الرقم (مثل + )", 'text' );
	}
	$s['zw_goals'] = array( 'title' => 'من نحن: الأهداف', 'desc' => 'الأيقونات من fontawesome.com/icons — اترك العنوان فارغاً لإخفاء البطاقة.', 'fields' => array() );
	for ( $i = 1; $i <= 5; $i++ ) {
		$s['zw_goals']['fields'][ "g{$i}_title" ] = array( "الهدف {$i}: العنوان", 'text' );
		$s['zw_goals']['fields'][ "g{$i}_text" ]  = array( "الهدف {$i}: الوصف", 'textarea' );
		$s['zw_goals']['fields'][ "g{$i}_icon" ]  = array( "الهدف {$i}: الأيقونة", 'text' );
	}
	$s['zw_values'] = array( 'title' => 'من نحن: القيم', 'desc' => 'اترك العنوان فارغاً لإخفاء القيمة.', 'fields' => array() );
	for ( $i = 1; $i <= 6; $i++ ) {
		$s['zw_values']['fields'][ "v{$i}_title" ] = array( "القيمة {$i}: العنوان", 'text' );
		$s['zw_values']['fields'][ "v{$i}_text" ]  = array( "القيمة {$i}: الوصف", 'textarea' );
		$s['zw_values']['fields'][ "v{$i}_icon" ]  = array( "القيمة {$i}: الأيقونة", 'text' );
	}
	return $s;
}

function zawaya_customize_register( $wp_customize ) {
	$d = zawaya_defaults();
	$wp_customize->add_panel(
		'zawaya',
		array(
			'title'    => 'إعدادات زوايا المعالي',
			'priority' => 20,
		)
	);
	$prio = 10;
	foreach ( zawaya_customizer_schema() as $sec_id => $sec ) {
		$wp_customize->add_section(
			$sec_id,
			array(
				'title'       => $sec['title'],
				'panel'       => 'zawaya',
				'priority'    => $prio++,
				'description' => isset( $sec['desc'] ) ? $sec['desc'] : '',
			)
		);
		foreach ( $sec['fields'] as $key => $f ) {
			$type     = $f[1];
			$sanitize = 'sanitize_text_field';
			if ( 'textarea' === $type ) {
				$sanitize = 'sanitize_textarea_field';
			} elseif ( 'url' === $type ) {
				$sanitize = 'esc_url_raw';
			} elseif ( 'email' === $type ) {
				$sanitize = 'sanitize_email';
			} elseif ( 'checkbox' === $type ) {
				$sanitize = 'zawaya_sanitize_bool';
			} elseif ( in_array( $type, array( 'number', 'range' ), true ) ) {
				$sanitize = 'absint';
			} elseif ( 'image' === $type ) {
				$sanitize = 'absint';
			}
			$wp_customize->add_setting(
				'zw_' . $key,
				array(
					'default'           => isset( $d[ $key ] ) ? $d[ $key ] : '',
					'sanitize_callback' => $sanitize,
					'transport'         => 'refresh',
				)
			);
			$args = array(
				'label'       => $f[0],
				'section'     => $sec_id,
				'description' => isset( $f[2] ) ? $f[2] : '',
			);
			if ( 'image' === $type ) {
				$args['mime_type'] = 'image';
				$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'zw_' . $key, $args ) );
				continue;
			}
			$args['type'] = $type;
			if ( 'range' === $type && isset( $f[3] ) ) {
				$args['input_attrs'] = $f[3];
			}
			$wp_customize->add_control( 'zw_' . $key, $args );
		}
	}
}
add_action( 'customize_register', 'zawaya_customize_register' );

function zawaya_sanitize_bool( $v ) {
	return (bool) $v;
}
