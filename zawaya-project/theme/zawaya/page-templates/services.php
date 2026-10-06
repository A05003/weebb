<?php
/**
 * Template Name: خدماتنا
 *
 * @package zawaya
 */

get_header();
zw_page_banner( '', 'about-hospitality.jpg' );

$zw_services = zw_services();
$zw_cols     = array( array(), array() );
foreach ( $zw_services as $i => $s ) {
	$zw_cols[ $i % 2 ][] = $s;
}
?>

<section class="bg-white" style="padding:clamp(64px,10vw,120px) 0 clamp(72px,11vw,136px)">
	<div class="wrap">
		<?php
		while ( have_posts() ) :
			the_post();
			if ( trim( get_the_content() ) ) {
				echo '<div class="entry" style="margin-bottom:56px">';
				the_content();
				echo '</div>';
			}
		endwhile;
		?>
		<?php if ( $zw_services ) : ?>
			<div class="svc-cols">
				<?php foreach ( $zw_cols as $col ) : ?>
					<div class="svc-col">
						<?php foreach ( $col as $s ) : ?>
							<?php $icon = get_post_meta( $s->ID, '_zw_icon', true ); ?>
							<article class="svc" id="service-<?php echo (int) $s->ID; ?>">
								<div class="svc-media">
									<?php echo get_the_post_thumbnail( $s, 'zawaya-square', array( 'loading' => 'lazy' ) ); ?>
									<span class="ic"><i class="<?php echo esc_attr( $icon ? $icon : 'fa-solid fa-star' ); ?>"></i></span>
								</div>
								<div class="svc-body">
									<h2><?php echo esc_html( get_the_title( $s ) ); ?></h2>
									<span class="bar"></span>
									<div class="txt"><?php echo apply_filters( 'the_content', $s->post_content ); // phpcs:ignore ?></div>
									<a class="link-arrow" href="<?php echo esc_url( zw_contact_url() ); ?>">اطلب الخدمة <i class="fa-solid fa-arrow-left"></i></a>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="empty-note">أضف خدماتك من لوحة التحكم ← الخدمات.</p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
