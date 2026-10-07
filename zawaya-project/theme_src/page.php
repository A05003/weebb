<?php
/**
 * Default page (any new page you add from the dashboard).
 *
 * @package zawaya
 */

get_header();

while ( have_posts() ) :
	the_post();
	$img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
	zv_phead( get_the_title(), has_excerpt() ? get_the_excerpt() : '', $img ? $img : 'about-hall.jpg' );
	?>
	<section class="sec">
		<div class="wrap">
			<div class="entry"><?php the_content(); ?></div>
		</div>
	</section>
	<?php
endwhile;

get_footer();
