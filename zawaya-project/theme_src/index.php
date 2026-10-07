<?php
/**
 * Fallback: blog index, archives, search.
 *
 * @package zawaya
 */

get_header();

$zw_blog = (int) get_option( 'page_for_posts' );
zv_phead(
	is_home() && $zw_blog ? get_the_title( $zw_blog ) : ( is_archive() ? wp_strip_all_tags( get_the_archive_title() ) : 'المدونة' ),
	is_home() && $zw_blog && has_excerpt( $zw_blog ) ? get_the_excerpt( $zw_blog ) : 'أخبار ومقالات من زوايا المعالي للأفراح والمناسبات.',
	'about-hospitality.jpg'
);
?>
<section class="sec">
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
			<div class="pager"><?php echo wp_kses_post( (string) paginate_links( array( 'prev_text' => '→', 'next_text' => '←' ) ) ); ?></div>
		<?php else : ?>
			<p class="center">لا توجد مقالات بعد.</p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
