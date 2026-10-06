<?php
/**
 * Single blog post.
 *
 * @package zawaya
 */

get_header();

while ( have_posts() ) :
	the_post();
	$zw_cats = get_the_category();
	$zw_blog = (int) get_option( 'page_for_posts' );
	zw_banner(
		array(
			'title'  => get_the_title(),
			'type'   => $zw_cats && 'uncategorized' !== $zw_cats[0]->slug ? $zw_cats[0]->name : '',
			'crumbs' => array( array( $zw_blog ? get_the_title( $zw_blog ) : 'المدونة', $zw_blog ? get_permalink( $zw_blog ) : home_url( '/' ) ) ),
			'subtitle' => get_the_date(),
			'small'  => true,
		)
	);
	?>
	<article <?php post_class( 'section--lg bg-white' ); ?>>
		<div class="wrap">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-cover"><?php the_post_thumbnail( 'large' ); ?></div>
			<?php endif; ?>
			<div class="entry">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>
			<nav class="post-nav">
				<?php previous_post_link( '%link', '<span class="btn btn-outline"><i class="fa-solid fa-arrow-right"></i> %title</span>' ); ?>
				<?php next_post_link( '%link', '<span class="btn btn-outline">%title <i class="fa-solid fa-arrow-left"></i></span>' ); ?>
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
