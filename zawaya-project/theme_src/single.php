<?php
/**
 * Single blog post.
 *
 * @package zawaya
 */

get_header();

while ( have_posts() ) :
	the_post();
	$zw_blog = (int) get_option( 'page_for_posts' );
	$img     = get_the_post_thumbnail_url( get_the_ID(), 'large' );
	zv_phead(
		get_the_title(),
		get_the_date(),
		$img ? $img : 'about-hospitality.jpg',
		array( array( $zw_blog ? get_the_title( $zw_blog ) : 'المدونة', $zw_blog ? get_permalink( $zw_blog ) : home_url( '/' ) ) )
	);
	?>
	<article <?php post_class( 'sec' ); ?>>
		<div class="wrap">
			<div class="entry">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>
			<nav class="post-nav">
				<?php previous_post_link( '%link', '<span class="btn btn-line">→ %title</span>' ); ?>
				<?php next_post_link( '%link', '<span class="btn btn-line">%title ←</span>' ); ?>
			</nav>
			<?php
			if ( comments_open() || get_comments_number() ) {
				echo '<div class="entry" style="margin-top:48px">';
				comments_template();
				echo '</div>';
			}
			?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
