<?php
/**
 * Footer.
 *
 * @package zawaya
 */

$zw_phone = zw_opt( 'phone' );
$zw_email = zw_opt( 'email' );
$zw_addr  = zw_opt( 'address' );
$zw_map   = zw_opt( 'maps_url' );
$zw_wa    = zw_wa_link();
$zw_soc   = array(
	'tiktok'    => array( 'fa-brands fa-tiktok', 'TikTok' ),
	'x'         => array( 'fa-brands fa-x-twitter', 'X' ),
	'snapchat'  => array( 'fa-brands fa-snapchat', 'Snapchat' ),
	'instagram' => array( 'fa-brands fa-instagram', 'Instagram' ),
	'linkedin'  => array( 'fa-brands fa-linkedin', 'LinkedIn' ),
	'youtube'   => array( 'fa-brands fa-youtube', 'YouTube' ),
);
?>
</main>

<footer class="site-footer">
	<div class="wrap ftr">
		<div class="ftr-col">
			<h3>نسعد بتواصلك معنا</h3>
			<?php if ( $zw_email ) : ?>
				<a class="ftr-contact" href="mailto:<?php echo esc_attr( $zw_email ); ?>">
					<img src="<?php echo esc_url( zw_img( 'mail.svg' ) ); ?>" alt="" width="48" height="48">
					<span><b>البريد</b><span><?php echo esc_html( $zw_email ); ?></span></span>
				</a>
			<?php endif; ?>
			<?php if ( $zw_phone ) : ?>
				<a class="ftr-contact" href="<?php echo esc_attr( zw_tel( $zw_phone ) ); ?>">
					<img src="<?php echo esc_url( zw_img( 'phone.svg' ) ); ?>" alt="" width="48" height="48">
					<span><b>الهاتف</b><span dir="ltr"><?php echo esc_html( $zw_phone ); ?></span></span>
				</a>
			<?php endif; ?>
			<?php if ( $zw_addr ) : ?>
				<a class="ftr-contact" href="<?php echo esc_url( $zw_map ? $zw_map : '#' ); ?>" target="_blank" rel="noopener">
					<img src="<?php echo esc_url( zw_img( 'pin.svg' ) ); ?>" alt="" width="48" height="48">
					<span><b>المقر الرئيسي</b><span><?php echo esc_html( $zw_addr ); ?></span></span>
				</a>
			<?php endif; ?>
		</div>

		<div class="ftr-col ftr-about">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( zw_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" loading="lazy"></a>
			<p><strong><?php echo esc_html( zw_opt( 'footer_kicker' ) ); ?></strong><br><?php echo esc_html( zw_opt( 'footer_text' ) ); ?></p>
		</div>

		<div class="ftr-col ftr-links">
			<h3>روابط سريعة</h3>
			<nav aria-label="روابط سريعة">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => 'zawaya_footer_fallback',
					)
				);
				?>
			</nav>
		</div>

		<div class="ftr-col">
			<?php if ( $zw_map ) : ?>
				<a class="ftr-map" href="<?php echo esc_url( $zw_map ); ?>" target="_blank" rel="noopener">
					<img src="<?php echo esc_url( zw_img( 'pin.svg' ) ); ?>" alt="" width="56" height="56">
					<b>موقعنا على خرائط Google</b>
					<small>اضغط لفتح الموقع</small>
				</a>
			<?php endif; ?>
			<div class="socials">
				<?php foreach ( $zw_soc as $key => $s ) : ?>
					<?php $u = zw_opt( $key ); ?>
					<?php if ( $u ) : ?>
						<a href="<?php echo esc_url( $u ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $s[1] ); ?>"><i class="<?php echo esc_attr( $s[0] ); ?>"></i></a>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php if ( $zw_wa ) : ?>
					<a href="<?php echo esc_url( $zw_wa ); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>
<div class="copy"><p><?php echo esc_html( str_replace( '{year}', gmdate( 'Y' ), zw_opt( 'copyright' ) ) ); ?></p></div>

<button class="to-top" id="to-top" type="button" aria-label="العودة للأعلى"><i class="fa-solid fa-arrow-up"></i></button>
<?php if ( $zw_wa && zw_opt( 'wa_float' ) ) : ?>
	<a class="wa-float" href="<?php echo esc_url( $zw_wa ); ?>" target="_blank" rel="noopener" aria-label="تواصل عبر واتساب"><i class="fa-brands fa-whatsapp"></i></a>
<?php endif; ?>
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="عرض الصورة"><img alt=""></div>

<?php wp_footer(); ?>
</body>
</html>
