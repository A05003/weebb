<?php
/**
 * 404.
 *
 * @package zawaya
 */

get_header();
zv_phead( 'الصفحة غير موجودة', 'ربما تم نقل الصفحة أو حذفها. جرّب الروابط أدناه.', 'about-main.jpg' );
?>
<section class="sec">
	<div class="wrap center" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
		<a class="btn btn-navy" href="<?php echo esc_url( home_url( '/' ) ); ?>">الصفحة الرئيسية</a>
		<a class="btn btn-line" href="<?php echo esc_url( zv_url( 'projects' ) ); ?>">مشاريعنا</a>
		<a class="btn btn-line" href="<?php echo esc_url( zv_url( 'contact' ) ); ?>">تواصل معنا</a>
	</div>
</section>
<?php
get_footer();
