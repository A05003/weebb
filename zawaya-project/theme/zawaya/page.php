<?php
/**
 * Default page (any new page you add from the dashboard).
 *
 * @package zawaya
 */

get_header();

while ( have_posts() ) :
	the_post();
	zw_page_banner();
	?>
	<section class="section--lg bg-white">
		<div class="wrap">
			<div class="entry">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php
endwhile;

get_footer();
