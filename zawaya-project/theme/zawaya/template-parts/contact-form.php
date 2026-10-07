<?php
/**
 * Contact form (used on the home page and contact page).
 *
 * @package zawaya
 */

$zw_sent = isset( $_GET['zw_sent'] ); // phpcs:ignore WordPress.Security.NonceVerification
$zw_err  = isset( $_GET['zw_err'] ) ? sanitize_key( $_GET['zw_err'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$zw_args  = isset( $args ) && is_array( $args ) ? $args : array();
$zw_kinds = ! empty( $zw_args['kinds'] ) ? (array) $zw_args['kinds'] : array( 'استفسار', 'طلب خدمة', 'طلب موعد', 'حجز قاعة', 'شكوى' );
$zw_btn   = ! empty( $zw_args['button'] ) ? $zw_args['button'] : 'ارسل';
$zw_errs = array(
	'fields'  => 'الرجاء كتابة الاسم ورقم الجوال أو البريد الإلكتروني.',
	'expired' => 'انتهت صلاحية الصفحة، حدّثها ثم أعد الإرسال.',
	'limit'   => 'أرسلت عدة رسائل خلال وقت قصير، حاول بعد قليل أو تواصل معنا هاتفياً.',
);
?>
<form class="zw-form" id="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<?php if ( $zw_sent ) : ?>
		<div class="form-msg ok" role="status"><i class="fa-solid fa-circle-check"></i> تم الإرسال، شكراً لتواصلك. سيتواصل معك فريقنا في أقرب وقت.</div>
	<?php elseif ( $zw_err && isset( $zw_errs[ $zw_err ] ) ) : ?>
		<div class="form-msg err" role="alert"><?php echo esc_html( $zw_errs[ $zw_err ] ); ?></div>
	<?php endif; ?>
	<input type="hidden" name="action" value="zw_contact">
	<?php wp_nonce_field( 'zw_contact', 'zw_contact_nonce' ); ?>
	<div class="hp" aria-hidden="true"><label>الموقع<input type="text" name="zw_website" tabindex="-1" autocomplete="off"></label></div>
	<label>الإسم بالكامل
		<input type="text" name="zw_name" placeholder="الإسم بالكامل" required autocomplete="name">
	</label>
	<label>رقم الجوال
		<input type="tel" name="zw_phone" placeholder="رقم الهاتف" dir="rtl" autocomplete="tel" inputmode="tel">
	</label>
	<label>نوع الإستفسار
		<select name="zw_kind">
			<?php foreach ( $zw_kinds as $zw_k ) : ?>
				<option value="<?php echo esc_attr( $zw_k ); ?>"><?php echo esc_html( $zw_k ); ?></option>
			<?php endforeach; ?>
		</select>
	</label>
	<label>البريد الإلكتروني
		<input type="email" name="zw_email" placeholder="البريد الإلكتروني" autocomplete="email">
	</label>
	<label class="full">الرسالة
		<textarea name="zw_message" rows="4" placeholder="الرسالة"></textarea>
	</label>
	<div class="actions">
		<button type="submit"><?php echo esc_html( $zw_btn ); ?></button>
	</div>
</form>
