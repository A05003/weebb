<?php
/**
 * Elementor integration:
 *  - Zawaya widgets category + custom widgets.
 *  - Brand colours as Elementor global colours (with dark-mode support).
 *  - Full-width rendering for any page built with Elementor.
 *  - One-click importer that rebuilds the site pages as editable Elementor layouts
 *    and saves them in the Elementor templates library.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Is Elementor loaded? */
function zawaya_has_elementor() {
	return did_action( 'elementor/loaded' ) && class_exists( '\Elementor\Plugin' );
}

/** Was this post built with Elementor? */
function zawaya_built_with_elementor( $post_id ) {
	if ( ! zawaya_has_elementor() || 'builder' !== get_post_meta( $post_id, '_elementor_edit_mode', true ) ) {
		return false;
	}
	// A page opened in Elementor but never saved has no design yet: keep the theme layout for it.
	$data = get_post_meta( $post_id, '_elementor_data', true );
	return is_string( $data ) ? ! in_array( trim( $data ), array( '', '[]' ), true ) : ! empty( $data );
}

/** Pages that get an Elementor layout: slug => (title, layout callback, template, excerpt, image). */
function zawaya_el_pages() {
	return apply_filters( 'zawaya_el_pages', array(
		'home'       => array( 'الرئيسية', 'zawaya_layout_home' ),
		'about-us'   => array( 'من نحن', 'zawaya_layout_about', 'page-templates/about.php', 'زوايا المعالي للأفراح والمناسبات، خبرة في إدارة وتشغيل قصور الأفراح وخدمات التنسيق والضيافة.', 'about-banner.jpg' ),
		'services'   => array( 'خدماتنا', 'zawaya_layout_services', 'page-templates/services.php', 'خدمات متكاملة لإقامة الأفراح والمناسبات والفعاليات، من تشغيل القاعات حتى الضيافة والتغطية الإعلامية.', 'about-hospitality.jpg' ),
		'projects'   => array( 'مشاريعنا', 'zawaya_layout_projects', 'page-templates/projects.php', 'قصور وقاعات وشركات تعمل تحت مظلة زوايا المعالي للأفراح والمناسبات.', 'hero.jpg' ),
		'contact-us' => array( 'تواصل معنا', 'zawaya_layout_contact', 'page-templates/contact.php', 'يسعدنا استقبال استفساراتكم وطلباتكم، وسيتواصل معكم فريقنا في أقرب وقت.', 'about-main.jpg' ),
	) );
}

/** Brand colours registered as Elementor global colours. id => (title, light, dark). */
function zawaya_el_colors() {
	return array(
		'zwnavy'   => array( 'زوايا: كحلي', '#18203B', '' ),
		'zwnavydk' => array( 'زوايا: كحلي داكن', '#111833', '' ),
		'zwgold'   => array( 'زوايا: ذهبي', '#E5AD83', '' ),
		'zwhead'   => array( 'زوايا: العناوين', '#18203B', '#E5AD83' ),
		'zwtext'   => array( 'زوايا: النصوص', '#4A5068', '#C3C9DF' ),
		'zwbg'     => array( 'زوايا: خلفية الأقسام', '#FCFAF7', '#0B1330' ),
		'zwsoft'   => array( 'زوايا: خلفية لؤلؤية', '#F7F3EE', '#0B1330' ),
		'zwcard'   => array( 'زوايا: البطاقات', '#FFFFFF', '#16224F' ),
		'zwwhite'  => array( 'زوايا: أبيض', '#FFFFFF', '' ),
	);
}

/* -------------------------------------------------------------------------- */
/* Front end                                                                   */
/* -------------------------------------------------------------------------- */

/**
 * The theme always renders the site in Arabic/RTL. Tell WordPress too, so Elementor
 * (and core) load their RTL stylesheets even when the dashboard language is English.
 */
add_action(
	'wp',
	function () {
		if ( ! is_admin() && isset( $GLOBALS['wp_locale'] ) && is_object( $GLOBALS['wp_locale'] ) ) {
			$GLOBALS['wp_locale']->text_direction = 'rtl';
		}
	},
	0
);

add_action(
	'wp_enqueue_scripts',
	function () {
		$deps = array( 'zawaya-style' );
		if ( is_singular() && zawaya_built_with_elementor( get_queried_object_id() ) && wp_style_is( 'elementor-frontend', 'registered' ) ) {
			$deps[] = 'elementor-frontend'; // Load after Elementor's own stylesheet.
		}
		wp_enqueue_style( 'zawaya-elementor', ZAWAYA_URI . '/assets/css/elementor.css', $deps, ZAWAYA_VER );
		// Default values of the brand colours + their dark-mode versions.
		$light = 'body{';
		$dark  = 'html[data-theme="dark"] body{';
		foreach ( zawaya_el_colors() as $id => $c ) {
			$light .= '--e-global-color-' . $id . ':' . $c[1] . ';';
			if ( $c[2] ) {
				$dark .= '--e-global-color-' . $id . ':' . $c[2] . ';';
			}
		}
		wp_add_inline_style( 'zawaya-elementor', $light . '}' . $dark . '}' );
	},
	20
);

/**
 * A page built with Elementor always renders full width between the theme header and footer,
 * whatever page template is selected for it.
 */
add_filter(
	'template_include',
	function ( $template ) {
		if ( ! is_singular() || ! zawaya_has_elementor() ) {
			return $template;
		}
		$id = get_queried_object_id();
		// Inside the Elementor editor the page must always expose a content area,
		// even the first time it is opened (before it is saved as an Elementor page).
		$previewing = isset( $_GET['elementor-preview'] ) && (int) $_GET['elementor-preview'] === (int) $id; // phpcs:ignore WordPress.Security.NonceVerification
		if ( ! $previewing && ! zawaya_built_with_elementor( $id ) ) {
			return $template;
		}
		$slug = get_page_template_slug( $id );
		if ( in_array( $slug, array( 'elementor_canvas', 'elementor_header_footer', 'elementor_theme' ), true ) && false !== strpos( $template, 'elementor' ) ) {
			return $template;
		}
		return ZAWAYA_DIR . '/elementor-full.php';
	},
	99
);

/* -------------------------------------------------------------------------- */
/* Widgets                                                                     */
/* -------------------------------------------------------------------------- */

add_action(
	'elementor/elements/categories_registered',
	function ( $manager ) {
		$manager->add_category(
			'zawaya',
			array(
				'title' => 'زوايا المعالي',
				'icon'  => 'eicon-star',
			)
		);
	}
);

add_action(
	'elementor/widgets/register',
	function ( $widgets ) {
		require_once ZAWAYA_DIR . '/inc/elementor/widgets.php';
		$widgets->register( new Zawaya_Banner_Widget() );
		$widgets->register( new Zawaya_Flip_Cards_Widget() );
		$widgets->register( new Zawaya_Projects_Widget() );
		$widgets->register( new Zawaya_Partners_Widget() );
		$widgets->register( new Zawaya_Contact_Form_Widget() );
		$widgets->register( new Zawaya_Venues_Widget() );
		$widgets->register( new Zawaya_Reviews_Widget() );
	}
);

/* -------------------------------------------------------------------------- */
/* Importer                                                                    */
/* -------------------------------------------------------------------------- */

/**
 * Media item for an image bundled with the theme (imported once into the media library,
 * so it can be swapped from Elementor). If a Customizer image is set, that one wins.
 *
 * @param string $file    File name in assets/img.
 * @param string $opt_key Customizer option holding a replacement.
 * @return array url, id
 */
function zawaya_el_media( $file, $opt_key = '' ) {
	if ( $opt_key ) {
		$v = zw_opt( $opt_key );
		if ( is_numeric( $v ) && $v && wp_get_attachment_image_url( (int) $v, 'full' ) ) {
			return array( 'url' => wp_get_attachment_image_url( (int) $v, 'full' ), 'id' => (int) $v );
		} elseif ( $v && ! is_numeric( $v ) ) {
			return array( 'url' => $v, 'id' => '' );
		}
	}
	$map = get_option( 'zawaya_el_media', array() );
	if ( ! empty( $map[ $file ] ) && wp_get_attachment_image_url( $map[ $file ], 'full' ) ) {
		return array( 'url' => wp_get_attachment_image_url( $map[ $file ], 'full' ), 'id' => (int) $map[ $file ] );
	}
	// Reuse the copy the theme's first-time setup already put in the media library.
	global $wpdb;
	$id = (int) $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s ORDER BY post_id ASC LIMIT 1", '%/zawaya-' . $wpdb->esc_like( $file ) ) );
	if ( ! $id && function_exists( 'zawaya_image_once' ) ) {
		$id = zawaya_image_once( 'assets/img/' . $file );
	}
	if ( $id ) {
		$map[ $file ] = $id;
		update_option( 'zawaya_el_media', $map, false );
		return array( 'url' => wp_get_attachment_image_url( $id, 'full' ), 'id' => $id );
	}
	return array( 'url' => zw_img( $file ), 'id' => '' );
}

/** Add the brand colours to the active Elementor kit (Site Settings → Global Colors). */
function zawaya_el_setup_kit() {
	$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();
	if ( ! $kit || ! $kit->get_id() ) {
		return;
	}
	$settings = $kit->get_settings();
	$custom   = isset( $settings['custom_colors'] ) ? (array) $settings['custom_colors'] : array();
	$have     = wp_list_pluck( $custom, '_id' );
	foreach ( zawaya_el_colors() as $id => $c ) {
		if ( ! in_array( $id, $have, true ) ) {
			$custom[] = array(
				'_id'   => $id,
				'title' => $c[0],
				'color' => $c[1],
			);
		}
	}
	$settings['custom_colors']   = $custom;
	// Brand system colours, and no Google fonts (the theme ships its own Arabic font).
	$settings['system_colors'] = array(
		array( '_id' => 'primary', 'title' => 'Primary', 'color' => '#1D2D67' ),
		array( '_id' => 'secondary', 'title' => 'Secondary', 'color' => '#D4AF37' ),
		array( '_id' => 'text', 'title' => 'Text', 'color' => '#3A4368' ),
		array( '_id' => 'accent', 'title' => 'Accent', 'color' => '#D4AF37' ),
	);
	$settings['system_typography'] = array(
		array( '_id' => 'primary', 'title' => 'Primary', 'typography_typography' => 'custom', 'typography_font_weight' => '700' ),
		array( '_id' => 'secondary', 'title' => 'Secondary', 'typography_typography' => 'custom', 'typography_font_weight' => '500' ),
		array( '_id' => 'text', 'title' => 'Text', 'typography_typography' => 'custom', 'typography_font_weight' => '400' ),
		array( '_id' => 'accent', 'title' => 'Accent', 'typography_typography' => 'custom', 'typography_font_weight' => '700' ),
	);
	$settings['container_width'] = array( 'unit' => 'px', 'size' => 1140, 'sizes' => array() );
	$kit->save( array( 'settings' => $settings ) );
}

/**
 * Build all pages.
 *
 * @param bool $apply   Put the layouts on the pages.
 * @param bool $library Also save them in Elementor → Templates.
 * @return array messages
 */
function zawaya_el_import( $apply = true, $library = true ) {
	if ( ! zawaya_has_elementor() ) {
		return array( 'Elementor غير مفعّل.' );
	}
	@set_time_limit( 300 ); // phpcs:ignore
	require_once ZAWAYA_DIR . '/inc/elementor/builder.php';
	require_once ZAWAYA_DIR . '/inc/elementor/layouts.php';

	// Elementor should inherit the theme fonts and colours.
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );
	$cpt = (array) get_option( 'elementor_cpt_support', array( 'page', 'post' ) );
	foreach ( array( 'page', 'post', 'zawaya_project' ) as $t ) {
		if ( ! in_array( $t, $cpt, true ) ) {
			$cpt[] = $t;
		}
	}
	update_option( 'elementor_cpt_support', $cpt );
	zawaya_el_setup_kit();

	$msgs  = array();
	$names = array(
		'home'       => array( 'الواجهة', 'شريط القصور', 'الأرقام', 'من نحن', 'الخدمات', 'القصور', 'آراء الضيوف', 'تواصل معنا' ),
		'about-us'   => array( 'البانر', 'قصتنا', 'الأرقام', 'الرؤية والرسالة', 'أهدافنا', 'قيمنا', 'شركاتنا ومشاريعنا' ),
		'services'   => array( 'البانر', 'الخدمات' ),
		'projects'   => array( 'البانر', 'قائمة المشاريع' ),
		'contact-us' => array( 'البانر', 'بطاقات التواصل', 'النموذج والخريطة' ),
	);

	if ( $library ) {
		foreach ( get_posts( array( 'post_type' => 'elementor_library', 'posts_per_page' => -1, 'post_status' => 'any', 'meta_query' => array( array( 'key' => '_zawaya_tpl', 'value' => array_keys( zawaya_el_pages() ), 'compare' => 'IN' ) ), 'fields' => 'ids' ) ) as $old ) { // phpcs:ignore
			wp_delete_post( $old, true );
		}
	}

	foreach ( zawaya_el_pages() as $slug => $p ) {
		$page_id = zawaya_ensure_page( $slug, $p[0], isset( $p[2] ) ? $p[2] : '', isset( $p[3] ) ? $p[3] : '', isset( $p[4] ) ? $p[4] : '' );
		if ( ! $page_id ) {
			continue;
		}
		$elements = zwe_finalize( call_user_func( $p[1] ) );
		foreach ( $elements as $i => &$el ) {
			if ( isset( $names[ $slug ][ $i ] ) ) {
				$el['settings']['_title'] = $names[ $slug ][ $i ];
			}
		}
		unset( $el );

		if ( $apply ) {
			$old = get_post_meta( $page_id, '_elementor_data', true );
			if ( $old ) {
				update_post_meta( $page_id, '_zawaya_el_backup', wp_slash( $old ) );
			}
			$doc = \Elementor\Plugin::$instance->documents->get( $page_id, false );
			if ( $doc ) {
				$doc->set_is_built_with_elementor( true );
				$doc->save(
					array(
						'elements' => $elements,
						'settings' => array( 'template' => 'elementor_header_footer' ),
					)
				);
				update_post_meta( $page_id, '_wp_page_template', 'elementor_header_footer' );
				$msgs[] = 'تم تصميم صفحة «' . $p[0] . '» بـ Elementor.';
			}
		}

		if ( $library ) {
			$source = \Elementor\Plugin::$instance->templates_manager->get_source( 'local' );
			$tid    = $source->save_item(
				array(
					'title'         => 'زوايا — صفحة ' . $p[0],
					'type'          => 'page',
					'content'       => $elements,
					'page_settings' => array( 'template' => 'elementor_header_footer' ),
				)
			);
			if ( $tid && ! is_wp_error( $tid ) ) {
				update_post_meta( $tid, '_zawaya_tpl', $slug );
			}
			foreach ( $elements as $i => $el ) {
				if ( 'container' !== $el['elType'] || empty( $names[ $slug ][ $i ] ) ) {
					continue;
				}
				$sid = $source->save_item(
					array(
						'title'   => 'زوايا — ' . $p[0] . ' — ' . $names[ $slug ][ $i ],
						'type'    => 'container',
						'content' => array( $el ),
					)
				);
				if ( $sid && ! is_wp_error( $sid ) ) {
					update_post_meta( $sid, '_zawaya_tpl', $slug );
				}
			}
		}
	}
	if ( $library ) {
		$msgs[] = 'حُفظت الصفحات وأقسامها في: القوالب ← القوالب المحفوظة (Saved Templates).';
	}

	\Elementor\Plugin::$instance->files_manager->clear_cache();
	update_option( 'zawaya_el_done', ZAWAYA_VER );
	return $msgs;
}

/* -------------------------------------------------------------------------- */
/* Dashboard                                                                   */
/* -------------------------------------------------------------------------- */

add_action(
	'admin_menu',
	function () {
		add_theme_page( 'تصميم الصفحات بـ Elementor', 'قوالب Elementor', 'manage_options', 'zawaya-elementor', 'zawaya_el_admin_page' );
	}
);

function zawaya_el_admin_page() {
	$msgs = array();
	if ( isset( $_POST['zw_el_run'] ) && check_admin_referer( 'zw_el_run' ) && current_user_can( 'manage_options' ) ) {
		$msgs = zawaya_el_import( ! empty( $_POST['zw_apply'] ), ! empty( $_POST['zw_library'] ) );
	}
	echo '<div class="wrap" dir="rtl"><h1>تصميم صفحات زوايا المعالي بـ Elementor</h1>';
	foreach ( $msgs as $m ) {
		echo '<div class="notice notice-success"><p>' . esc_html( $m ) . '</p></div>';
	}
	if ( ! zawaya_has_elementor() ) {
		echo '<div class="notice notice-warning"><p>ثبّت إضافة <b>Elementor</b> وفعّلها أولاً، ثم ارجع لهذه الصفحة.</p><p><a class="button button-primary" href="' . esc_url( admin_url( 'plugin-install.php?s=elementor&tab=search&type=term' ) ) . '">تثبيت Elementor</a></p></div></div>';
		return;
	}
	echo '<p style="font-size:15px;max-width:780px">يحوّل هذا الزر صفحات الموقع (الرئيسية، من نحن، خدماتنا، مشاريعنا، تواصل معنا) إلى تصاميم Elementor بنفس الشكل الحالي، فتستطيع بعدها تعديل كل نص وصورة ولون وترتيب بالسحب والإفلات.</p>';
	echo '<form method="post">';
	wp_nonce_field( 'zw_el_run' );
	echo '<p><label><input type="checkbox" name="zw_apply" value="1" checked> تطبيق التصاميم على الصفحات الخمس</label><br><small style="color:#996800">إن كانت إحدى هذه الصفحات مصممة مسبقاً بـ Elementor سيُستبدل تصميمها (تُحفظ نسخة احتياطية تلقائياً).</small></p>';
	echo '<p><label><input type="checkbox" name="zw_library" value="1" checked> حفظ نسخة من الصفحات وكل أقسامها في مكتبة قوالب Elementor (لإعادة استخدامها في أي صفحة)</label></p>';
	echo '<p><button class="button button-primary button-hero" name="zw_el_run" value="1">إنشاء التصاميم الآن</button></p></form>';

	if ( get_option( 'zawaya_el_done' ) ) {
		echo '<h2>تعديل الصفحات</h2><ul style="list-style:disc;padding-right:20px">';
		foreach ( zawaya_el_pages() as $slug => $p ) {
			$page = get_page_by_path( $slug );
			if ( $page && zawaya_built_with_elementor( $page->ID ) ) {
				echo '<li><a href="' . esc_url( admin_url( 'post.php?post=' . $page->ID . '&action=elementor' ) ) . '">تعديل «' . esc_html( $p[0] ) . '» بـ Elementor</a></li>';
			}
		}
		echo '<li><a href="' . esc_url( admin_url( 'edit.php?post_type=elementor_library&tabs_group=library' ) ) . '">القوالب المحفوظة</a></li></ul>';
	}
	echo '<h2>ملاحظات</h2><ul style="list-style:disc;padding-right:20px;max-width:780px">';
	echo '<li>عناصر زوايا الخاصة تجدها في لوحة Elementor تحت تصنيف <b>«زوايا المعالي»</b>: بانر الصفحة، البطاقات القلّابة، المشاريع والقصور، شركاء النجاح، نموذج التواصل.</li>';
	echo '<li>ألوان الهوية مضافة في Elementor ← إعدادات الموقع ← الألوان العامة باسم «زوايا: …»، وتتبدل تلقائياً في الوضع الليلي.</li>';
	echo '<li>الهيدر والفوتر وقائمة المشاريع المنسدلة تبقى من القالب: عدّلها من المظهر ← تخصيص، والمظهر ← القوائم.</li>';
	echo '<li>المشاريع والقصور وشركاء النجاح تُدار من القائمة الجانبية وتظهر في التصاميم تلقائياً.</li>';
	echo '</ul></div>';
}

/** Nudge after installing Elementor. */
add_action(
	'admin_notices',
	function () {
		if ( ! current_user_can( 'manage_options' ) || get_option( 'zawaya_el_done' ) ) {
			return;
		}
		$screen = get_current_screen();
		if ( $screen && 'appearance_page_zawaya-elementor' === $screen->id ) {
			return;
		}
		$url = admin_url( 'themes.php?page=zawaya-elementor' );
		if ( zawaya_has_elementor() ) {
			echo '<div class="notice notice-info"><p><b>زوايا المعالي:</b> Elementor جاهز. <a href="' . esc_url( $url ) . '">حوّل صفحات الموقع إلى تصاميم قابلة للسحب والإفلات بضغطة زر</a>.</p></div>';
		} elseif ( $screen && in_array( $screen->id, array( 'dashboard', 'themes', 'plugins' ), true ) ) {
			echo '<div class="notice notice-info"><p><b>زوايا المعالي:</b> لتعديل الصفحات بالسحب والإفلات ثبّت إضافة Elementor المجانية، ثم <a href="' . esc_url( $url ) . '">أنشئ التصاميم من هنا</a>.</p></div>';
		}
	}
);


/* -------------------------------------------------------------------------- */
/* One-time apply of the v2.0 home layout                                      */
/* -------------------------------------------------------------------------- */

/**
 * After the theme is updated to this version, rebuild only the home page from the
 * new layout (the previous Elementor data is kept in the "_zawaya_el_backup" meta,
 * and the section templates go to Saved Templates). Other pages keep their content
 * and only pick up the new styling. Runs once.
 */
add_action(
	'init',
	function () {
		if ( wp_doing_ajax() || wp_doing_cron() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ! zawaya_has_elementor() ) {
			return;
		}
		if ( ZAWAYA_VER === get_option( 'zawaya_v5_applied' ) || get_transient( 'zawaya_v5_lock' ) ) {
			return;
		}
		set_transient( 'zawaya_v5_lock', 1, 300 );
		update_option( 'zawaya_v5_applied', ZAWAYA_VER, false );
		add_filter(
			'zawaya_el_pages',
			function ( $pages ) {
				return array_intersect_key( $pages, array( 'home' => true ) );
			}
		);
		zawaya_el_import( true, true );
	},
	40
);
