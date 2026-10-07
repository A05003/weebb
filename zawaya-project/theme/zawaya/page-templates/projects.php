<?php
/**
 * Template Name: مشاريعنا
 *
 * @package zawaya
 */

get_header();
zw_page_banner( '', 'hero.jpg' );
$zw_projects = zw_projects();
?>

<?php if ( $zw_projects ) : ?>
	<?php zw_render_projects_list(); ?>
<?php else : ?>
	<section class="section"><div class="wrap"><p class="empty-note">أضف مشاريعك من لوحة التحكم ← المشاريع والقصور.</p></div></section>
<?php endif; ?>

<?php
get_footer();
