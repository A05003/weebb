<?php
/**
 * Meta boxes for projects, services and contact messages (no plugins required).
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function zawaya_add_meta_boxes() {
	add_meta_box( 'zw_project', 'تفاصيل المشروع / القصر', 'zawaya_project_box', 'zawaya_project', 'normal', 'high' );
	add_meta_box( 'zw_project_media', 'صورة الغلاف ومعرض الصور', 'zawaya_project_media_box', 'zawaya_project', 'normal', 'default' );
	add_meta_box( 'zw_service', 'إعدادات الخدمة', 'zawaya_service_box', 'zawaya_service', 'side', 'default' );
	add_meta_box( 'zw_partner', 'رابط الشريك (اختياري)', 'zawaya_partner_box', 'zawaya_partner', 'normal', 'default' );
	add_meta_box( 'zw_message', 'تفاصيل الرسالة', 'zawaya_message_box', 'zawaya_message', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'zawaya_add_meta_boxes' );

function zawaya_field( $label, $html, $help = '' ) {
	echo '<div class="zw-field"><label><strong>' . esc_html( $label ) . '</strong></label>' . $html; // phpcs:ignore
	if ( $help ) {
		echo '<p class="description">' . esc_html( $help ) . '</p>';
	}
	echo '</div>';
}

function zawaya_admin_css() {
	echo '<style>.zw-field{margin:0 0 16px}.zw-field label{display:block;margin-bottom:6px}.zw-field input[type=text],.zw-field input[type=url],.zw-field textarea{width:100%}.zw-gal{display:flex;flex-wrap:wrap;gap:8px;margin:8px 0}.zw-gal img{width:90px;height:68px;object-fit:cover;border-radius:6px;border:1px solid #ddd}.zw-cover img{max-width:320px;height:auto;border-radius:8px;display:block;margin:8px 0}.zw-msg th{text-align:right;width:140px;padding:8px;background:#f6f7f7}.zw-msg td{padding:8px}</style>';
}

function zawaya_project_box( $post ) {
	wp_nonce_field( 'zw_save', 'zw_nonce' );
	zawaya_admin_css();
	$m = function ( $k ) use ( $post ) {
		return get_post_meta( $post->ID, $k, true );
	};
	echo '<p class="description" style="margin-bottom:16px">النبذة الكاملة تكتبها في المحرر بالأعلى. <b>الشعار</b> = "شعار المشروع" في العمود الجانبي. <b>الوصف المختصر</b> (يظهر في بطاقة الصفحة الرئيسية) = حقل "المقتطف".</p>';
	zawaya_field( 'الاسم المختصر', '<input type="text" dir="auto" name="zw_short" value="' . esc_attr( $m( '_zw_short' ) ) . '" placeholder="مثال: روعة الملتقى">', 'يظهر في القائمة المنسدلة ومسار التنقل.' );
	zawaya_field( 'نوع المشروع', '<input type="text" dir="auto" name="zw_type" value="' . esc_attr( $m( '_zw_type' ) ) . '" placeholder="مثال: قصر أفراح ومؤتمرات">' );
	zawaya_field( 'معلومات سريعة (المربعات الزرقاء)', '<textarea dir="auto" name="zw_facts" rows="5" placeholder="الموقع | حي المعيزيلة، شرق الرياض&#10;قسم الرجال | حتى 300 ضيف">' . esc_textarea( $m( '_zw_facts' ) ) . '</textarea>', 'كل سطر = مربع. اكتب العنوان ثم علامة | ثم القيمة.' );
	zawaya_field( 'المميزات والخدمات', '<textarea dir="auto" name="zw_features" rows="6" placeholder="ميزة في كل سطر">' . esc_textarea( $m( '_zw_features' ) ) . '</textarea>', 'كل سطر = ميزة.' );
	zawaya_field( 'آراء الضيوف (من Google)', '<textarea dir="auto" name="zw_reviews" rows="5" placeholder="رأي في كل سطر">' . esc_textarea( $m( '_zw_reviews' ) ) . '</textarea>', 'كل سطر = رأي إيجابي يظهر في صفحة هذا المشروع. إن تُرك فارغاً تُستخدم آراء القصر الجاهزة.' );
	zawaya_field( 'تقييم Google', '<input type="text" name="zw_rating" value="' . esc_attr( $m( '_zw_rating' ) ) . '" dir="ltr" placeholder="4.4"> <input type="text" name="zw_rating_count" value="' . esc_attr( $m( '_zw_rating_count' ) ) . '" dir="ltr" placeholder="1,168">', 'التقييم (من 5) ثم عدد التقييمات.' );
	zawaya_field( 'Google place_id (لرابط الخريطة)', '<input type="text" name="zw_place_id" value="' . esc_attr( $m( '_zw_place_id' ) ) . '" dir="ltr" placeholder="ChIJ...">' );
	zawaya_field( 'رقم الحجز', '<input type="text" name="zw_phone" value="' . esc_attr( $m( '_zw_phone' ) ) . '" dir="ltr" placeholder="05xxxxxxxx">', 'اتركه فارغاً لإخفاء الزر.' );
	zawaya_field( 'رابط "روابط القاعة" (Linktree أو غيره)', '<input type="url" name="zw_link" value="' . esc_attr( $m( '_zw_link' ) ) . '" dir="ltr" placeholder="https://">', 'اتركه فارغاً لإخفاء الزر.' );
	zawaya_field( 'نص زر الحجز', '<input type="text" dir="auto" name="zw_cta" value="' . esc_attr( $m( '_zw_cta' ) ) . '" placeholder="احجز الآن">' );
}

function zawaya_project_media_box( $post ) {
	$cover = (int) get_post_meta( $post->ID, '_zw_cover', true );
	$gal   = (string) get_post_meta( $post->ID, '_zw_gallery', true );
	echo '<div class="zw-field"><label><strong>صورة الغلاف (خلفية أعلى صفحة المشروع)</strong></label>';
	echo '<div class="zw-cover" id="zw-cover-prev">' . ( $cover ? wp_get_attachment_image( $cover, 'medium' ) : '' ) . '</div>';
	echo '<input type="hidden" name="zw_cover" id="zw-cover" value="' . esc_attr( $cover ? $cover : '' ) . '">';
	echo '<button type="button" class="button" id="zw-cover-btn">اختيار صورة الغلاف</button> <button type="button" class="button-link-delete" id="zw-cover-clear">إزالة</button></div>';

	echo '<div class="zw-field"><label><strong>معرض الصور</strong></label><div class="zw-gal" id="zw-gal-prev">';
	foreach ( array_filter( array_map( 'intval', explode( ',', $gal ) ) ) as $id ) {
		echo wp_get_attachment_image( $id, 'thumbnail' );
	}
	echo '</div><input type="hidden" name="zw_gallery" id="zw-gal" value="' . esc_attr( $gal ) . '">';
	echo '<button type="button" class="button button-primary" id="zw-gal-btn">إضافة / تعديل صور المعرض</button> <button type="button" class="button-link-delete" id="zw-gal-clear">إفراغ المعرض</button>';
	echo '<p class="description">يمكنك اختيار عدة صور مرة واحدة وترتيبها بالسحب داخل نافذة الوسائط.</p></div>';
}

function zawaya_service_box( $post ) {
	wp_nonce_field( 'zw_save', 'zw_nonce' );
	zawaya_admin_css();
	$icon = get_post_meta( $post->ID, '_zw_icon', true );
	zawaya_field( 'أيقونة (Font Awesome)', '<input type="text" name="zw_icon" value="' . esc_attr( $icon ? $icon : 'fa-solid fa-star' ) . '" dir="ltr">', 'مثال: fa-solid fa-camera — من fontawesome.com/icons' );
	echo '<p class="description">الوصف الكامل في المحرر، والوصف المختصر لبطاقة الرئيسية في "المقتطف"، والصورة في "صورة الخدمة".</p>';
}

function zawaya_partner_box( $post ) {
	wp_nonce_field( 'zw_save', 'zw_nonce' );
	zawaya_admin_css();
	zawaya_field( 'رابط موقع الشريك', '<input type="url" name="zw_link" value="' . esc_attr( get_post_meta( $post->ID, '_zw_link', true ) ) . '" dir="ltr" placeholder="https://">', 'الشعار يُضاف من "شعار الشريك" في العمود الجانبي.' );
}

function zawaya_message_box( $post ) {
	zawaya_admin_css();
	$rows = array(
		'الاسم'         => $post->post_title,
		'الجوال'        => get_post_meta( $post->ID, '_zw_phone', true ),
		'البريد'        => get_post_meta( $post->ID, '_zw_email', true ),
		'نوع الاستفسار' => get_post_meta( $post->ID, '_zw_kind', true ),
		'الصفحة'        => get_post_meta( $post->ID, '_zw_page', true ),
		'التاريخ'       => get_the_date( 'Y-m-d H:i', $post ),
	);
	echo '<table class="zw-msg widefat striped">';
	foreach ( $rows as $k => $v ) {
		echo '<tr><th>' . esc_html( $k ) . '</th><td>' . esc_html( $v ) . '</td></tr>';
	}
	echo '<tr><th>الرسالة</th><td>' . nl2br( esc_html( get_post_meta( $post->ID, '_zw_message', true ) ) ) . '</td></tr></table>';
	$email = get_post_meta( $post->ID, '_zw_email', true );
	$phone = preg_replace( '/[^0-9]/', '', (string) get_post_meta( $post->ID, '_zw_phone', true ) );
	echo '<p style="margin-top:14px">';
	if ( $email ) {
		echo '<a class="button button-primary" href="mailto:' . esc_attr( $email ) . '">الرد بالبريد</a> ';
	}
	if ( $phone ) {
		if ( 0 === strpos( $phone, '05' ) ) {
			$phone = '966' . substr( $phone, 1 );
		}
		echo '<a class="button" target="_blank" href="https://wa.me/' . esc_attr( $phone ) . '">مراسلة واتساب</a>';
	}
	echo '</p>';
	// Mark as read.
	if ( 'pending' === $post->post_status ) {
		wp_update_post( array( 'ID' => $post->ID, 'post_status' => 'publish' ) );
	}
}

function zawaya_save_meta( $post_id ) {
	if ( ! isset( $_POST['zw_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['zw_nonce'] ), 'zw_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$text = array( 'zw_short' => '_zw_short', 'zw_type' => '_zw_type', 'zw_phone' => '_zw_phone', 'zw_cta' => '_zw_cta', 'zw_icon' => '_zw_icon', 'zw_rating' => '_zw_rating', 'zw_rating_count' => '_zw_rating_count', 'zw_place_id' => '_zw_place_id' );
	foreach ( $text as $f => $k ) {
		if ( isset( $_POST[ $f ] ) ) {
			update_post_meta( $post_id, $k, sanitize_text_field( wp_unslash( $_POST[ $f ] ) ) );
		}
	}
	foreach ( array( 'zw_facts' => '_zw_facts', 'zw_features' => '_zw_features', 'zw_reviews' => '_zw_reviews' ) as $f => $k ) {
		if ( isset( $_POST[ $f ] ) ) {
			update_post_meta( $post_id, $k, sanitize_textarea_field( wp_unslash( $_POST[ $f ] ) ) );
		}
	}
	if ( isset( $_POST['zw_link'] ) ) {
		update_post_meta( $post_id, '_zw_link', esc_url_raw( wp_unslash( $_POST['zw_link'] ) ) );
	}
	if ( isset( $_POST['zw_cover'] ) ) {
		update_post_meta( $post_id, '_zw_cover', absint( $_POST['zw_cover'] ) );
	}
	if ( isset( $_POST['zw_gallery'] ) ) {
		$ids = array_filter( array_map( 'absint', explode( ',', sanitize_text_field( wp_unslash( $_POST['zw_gallery'] ) ) ) ) );
		update_post_meta( $post_id, '_zw_gallery', implode( ',', $ids ) );
	}
}
add_action( 'save_post', 'zawaya_save_meta' );

/* Media picker script for the project screen */
function zawaya_admin_scripts( $hook ) {
	$screen = get_current_screen();
	if ( ! $screen || 'zawaya_project' !== $screen->post_type || ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script( 'zawaya-admin', ZAWAYA_URI . '/assets/js/admin.js', array( 'jquery' ), ZAWAYA_VER, true );
}
add_action( 'admin_enqueue_scripts', 'zawaya_admin_scripts' );
