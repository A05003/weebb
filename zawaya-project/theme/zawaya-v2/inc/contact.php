<?php
/**
 * Contact form: saves every message in the dashboard and emails it.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function zawaya_handle_contact() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( array( 'zw_sent', 'zw_err' ), $back );
	$back = preg_replace( '/#.*$/', '', $back );

	if ( ! isset( $_POST['zw_contact_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['zw_contact_nonce'] ), 'zw_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'zw_err', 'expired', $back ) . '#contact-form' );
		exit;
	}
	// Honeypot: bots fill hidden fields.
	if ( ! empty( $_POST['zw_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'zw_sent', '1', $back ) . '#contact-form' );
		exit;
	}
	// Simple rate limit per IP: 5 messages / 10 minutes.
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'zw_rl_' . md5( $ip );
	$hit = (int) get_transient( $key );
	if ( $hit >= 5 ) {
		wp_safe_redirect( add_query_arg( 'zw_err', 'limit', $back ) . '#contact-form' );
		exit;
	}
	set_transient( $key, $hit + 1, 10 * MINUTE_IN_SECONDS );

	$name    = sanitize_text_field( wp_unslash( $_POST['zw_name'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['zw_phone'] ?? '' ) );
	$kind    = sanitize_text_field( wp_unslash( $_POST['zw_kind'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['zw_email'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['zw_message'] ?? '' ) );
	// Extra booking fields from the v2 contact form (all optional).
	$extra = array();
	foreach ( array( 'zw_venue' => 'القصر المفضّل', 'zw_date' => 'التاريخ المتوقع', 'zw_guests' => 'عدد الضيوف' ) as $k => $label ) {
		$val = sanitize_text_field( wp_unslash( $_POST[ $k ] ?? '' ) );
		if ( '' !== $val ) {
			$extra[] = $label . ': ' . $val;
		}
	}
	if ( $extra ) {
		$message = implode( "\n", $extra ) . ( '' !== $message ? "\n\n" . $message : '' );
	}

	if ( '' === $name || ( '' === $phone && ! is_email( $email ) ) ) {
		wp_safe_redirect( add_query_arg( 'zw_err', 'fields', $back ) . '#contact-form' );
		exit;
	}

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'zawaya_message',
			'post_status' => 'pending',
			'post_title'  => $name,
		)
	);
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_zw_phone', $phone );
		update_post_meta( $post_id, '_zw_email', $email );
		update_post_meta( $post_id, '_zw_kind', $kind );
		update_post_meta( $post_id, '_zw_message', $message );
		update_post_meta( $post_id, '_zw_page', esc_url_raw( $back ) );
	}

	$to = zw_opt( 'form_to' );
	if ( ! is_email( $to ) ) {
		$to = zw_opt( 'email' );
	}
	if ( ! is_email( $to ) ) {
		$to = get_option( 'admin_email' );
	}
	$subject = 'رسالة جديدة من الموقع: ' . ( $kind ? $kind : 'تواصل' ) . ' — ' . $name;
	$body    = "الاسم: {$name}\nالجوال: {$phone}\nالبريد: {$email}\nنوع الاستفسار: {$kind}\n\nالرسالة:\n{$message}\n\n— أُرسلت من: {$back}";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( is_email( $email ) ) {
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}
	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'zw_sent', '1', $back ) . '#contact-form' );
	exit;
}
add_action( 'admin_post_nopriv_zw_contact', 'zawaya_handle_contact' );
add_action( 'admin_post_zw_contact', 'zawaya_handle_contact' );
