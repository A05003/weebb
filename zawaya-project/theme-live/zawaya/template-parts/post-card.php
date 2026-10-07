<?php
/**
 * Blog post card.
 *
 * @package zawaya
 */

$zw_cats = get_the_category();
?>
<article <?php post_class( 'post-card' ); ?>>
	<a class="thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'zawaya-card', array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
		<?php else : ?>
			<span class="ph"><i class="fa-regular fa-image"></i></span>
		<?php endif; ?>
	</a>
	<div class="body">
		<?php if ( $zw_cats && 'uncategorized' !== $zw_cats[0]->slug ) : ?>
			<a class="pill" href="<?php echo esc_url( get_category_link( $zw_cats[0] ) ); ?>"><?php echo esc_html( $zw_cats[0]->name ); ?></a>
		<?php endif; ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php echo esc_html( get_the_excerpt() ); ?></p>
		<a class="link-arrow" href="<?php the_permalink(); ?>">اقرأ المزيد <i class="fa-solid fa-arrow-left"></i></a>
	</div>
</article>
