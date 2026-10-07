<?php
/**
 * Fallback template (archives, search, categories).
 *
 * @package zawaya
 */

get_header();

if ( is_search() ) {
	$zw_title = 'نتائج البحث عن: ' . get_search_query();
} elseif ( is_archive() ) {
	$zw_title = wp_strip_all_tags( get_the_archive_title() );
} else {
	$zw_title = 'المدونة';
}
zw_banner(
	array(
		'title'    => $zw_title,
		'subtitle' => is_archive() ? wp_strip_all_tags( get_the_archive_description() ) : '',
		'crumbs'   => is_archive() || is_search() ? array( array( 'المدونة', get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/' ) ) ) : array(),
		'curve'    => 'var(--bg-soft)',
	)
);
?>
<section class="section--lg bg-soft">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
			<div class="posts">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/post-card' );
				endwhile;
				?>
			</div>
			<div class="pagination"><?php echo wp_kses_post( (string) paginate_links( array( 'prev_text' => '<i class="fa-solid fa-chevron-right"></i>', 'next_text' => '<i class="fa-solid fa-chevron-left"></i>' ) ) ); ?></div>
		<?php else : ?>
			<p class="empty-note">لا توجد نتائج.</p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
