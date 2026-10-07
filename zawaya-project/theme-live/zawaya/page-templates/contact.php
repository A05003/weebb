<?php
/**
 * Template Name: تواصل معنا
 *
 * @package zawaya
 */

get_header();
zw_page_banner( '', 'about-main.jpg' );

$zw_phone = zw_opt( 'phone' );
$zw_email = zw_opt( 'email' );
$zw_addr  = zw_opt( 'address' );
$zw_map   = zw_opt( 'maps_url' );
$zw_embed = zw_opt( 'maps_embed' );
$zw_wa    = zw_wa_link();
?>

<section class="bg-soft" style="padding:clamp(56px,9vw,104px) 0 clamp(20px,3vw,32px)">
	<div class="wrap info-cards">
		<?php if ( $zw_phone ) : ?>
			<a class="info-card" href="<?php echo esc_attr( zw_tel( $zw_phone ) ); ?>">
				<img src="<?php echo esc_url( zw_img( 'phone.svg' ) ); ?>" alt="" width="60" height="60">
				<b>الهاتف</b><span dir="ltr"><?php echo esc_html( $zw_phone ); ?></span>
			</a>
		<?php endif; ?>
		<?php if ( $zw_email ) : ?>
			<a class="info-card" href="mailto:<?php echo esc_attr( $zw_email ); ?>">
				<img src="<?php echo esc_url( zw_img( 'mail.svg' ) ); ?>" alt="" width="60" height="60">
				<b>البريد</b><span><?php echo esc_html( $zw_email ); ?></span>
			</a>
		<?php endif; ?>
		<?php if ( $zw_addr ) : ?>
			<a class="info-card" href="<?php echo esc_url( $zw_map ? $zw_map : '#' ); ?>" target="_blank" rel="noopener">
				<img src="<?php echo esc_url( zw_img( 'pin.svg' ) ); ?>" alt="" width="60" height="60">
				<b>المقر الرئيسي</b><span><?php echo esc_html( $zw_addr ); ?></span>
			</a>
		<?php endif; ?>
	</div>
</section>

<section class="bg-soft" style="padding:clamp(32px,5vw,56px) 0 clamp(64px,10vw,120px)">
	<div class="wrap contact-grid">
		<div class="form-card">
			<h2>أرسل لنا رسالة</h2>
			<?php get_template_part( 'template-parts/contact-form' ); ?>
		</div>
		<div class="map-col">
			<a class="map-card" href="<?php echo esc_url( $zw_map ? $zw_map : '#' ); ?>" target="_blank" rel="noopener">
				<?php if ( $zw_embed ) : ?>
					<iframe src="<?php echo esc_url( $zw_embed ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="خريطة الموقع"></iframe>
				<?php endif; ?>
				<span class="shade"></span>
				<span class="cap"><b><i class="fa-solid fa-location-dot"></i> موقعنا على خرائط Google</b><span><?php echo esc_html( $zw_addr ); ?></span></span>
			</a>
			<?php if ( $zw_wa ) : ?>
				<a class="wa-card" href="<?php echo esc_url( $zw_wa ); ?>" target="_blank" rel="noopener">
					<i class="fa-brands fa-whatsapp"></i>
					<span><b>تواصل عبر واتساب</b><small>رد سريع على استفساراتكم</small></span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
