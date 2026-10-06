<?php
/**
 * Blog index (the page set as "Posts page").
 *
 * @package zawaya
 */

get_header();

$zw_blog = (int) get_option( 'page_for_posts' );
zw_banner(
	array(
		'title'    => $zw_blog ? get_the_title( $zw_blog ) : 'المدونة',
		'subtitle' => $zw_blog && has_excerpt( $zw_blog ) ? get_the_excerpt( $zw_blog ) : '',
		'image'    => $zw_blog ? get_the_post_thumbnail_url( $zw_blog, 'full' ) : '',
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
			<p class="empty-note">لا توجد مقالات بعد.</p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
