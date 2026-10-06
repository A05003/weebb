<?php
/**
 * 404.
 *
 * @package zawaya
 */

get_header();
zw_banner(
	array(
		'title'    => 'الصفحة غير موجودة',
		'subtitle' => 'ربما تم نقل الصفحة أو حذفها. جرّب الروابط أدناه.',
	)
);
?>
<section class="section bg-white">
	<div class="wrap center" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
		<a class="btn btn-navy" href="<?php echo esc_url( home_url( '/' ) ); ?>">الصفحة الرئيسية</a>
		<a class="btn btn-outline" href="<?php echo esc_url( zw_page_url( 'projects' ) ); ?>">مشاريعنا</a>
		<a class="btn btn-outline" href="<?php echo esc_url( zw_contact_url() ); ?>">تواصل معنا</a>
	</div>
</section>
<?php
get_footer();
