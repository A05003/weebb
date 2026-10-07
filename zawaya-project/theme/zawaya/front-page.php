<?php
/**
 * Home page.
 *
 * @package zawaya
 */

get_header();

$zw_video    = trim( (string) zw_opt( 'hero_video' ) );
$zw_hero_img = zw_opt_img( 'hero_image', 'hero.jpg' );
$zw_services = zw_services();
$zw_projects = zw_projects();
$zw_auto     = zw_opt( 'autoplay' ) ? '1' : '0';
?>

<section class="hero" style="background-image:url('<?php echo esc_url( $zw_hero_img ); ?>');--overlay:<?php echo esc_attr( (int) zw_opt( 'hero_overlay' ) / 100 ); ?>;--hero-h:<?php echo esc_attr( (int) zw_opt( 'hero_height' ) ); ?>vh">
	<?php if ( $zw_video ) : ?>
		<div class="hero-video">
			<iframe id="hero-video" data-src="<?php echo esc_url( 'https://www.youtube-nocookie.com/embed/' . rawurlencode( $zw_video ) . '?autoplay=1&mute=1&loop=1&playlist=' . rawurlencode( $zw_video ) . '&controls=0&modestbranding=1&playsinline=1&rel=0&enablejsapi=1' ); ?>" title="video" allow="autoplay; encrypted-media; picture-in-picture" referrerpolicy="strict-origin-when-cross-origin" tabindex="-1"></iframe>
		</div>
	<?php endif; ?>
	<div class="hero-overlay"></div>
	<div class="hero-content">
		<?php if ( zw_opt( 'hero_show_text' ) ) : ?>
			<h1 class="l1"><?php echo esc_html( zw_opt( 'hero_l1' ) ); ?></h1>
			<p class="l2"><?php echo esc_html( zw_opt( 'hero_l2' ) ); ?></p>
			<p class="l3"><?php echo esc_html( zw_opt( 'hero_l3' ) ); ?></p>
		<?php else : ?>
			<h1 class="screen-reader-text"><?php bloginfo( 'name' ); ?></h1>
		<?php endif; ?>
	</div>
	<?php zw_curve( 'var(--navy-700)' ); ?>
</section>

<?php if ( zw_counters() ) : ?>
<section class="counters bg-navy">
	<div class="wrap">
		<h2><?php echo esc_html( zw_opt( 'counters_title' ) ); ?></h2>
		<?php zw_counters_grid(); ?>
	</div>
</section>
<?php endif; ?>

<?php if ( $zw_services ) : ?>
<section class="section bg-white" style="overflow-x:clip">
	<div class="wrap">
		<div class="sec-title"><h2><?php echo esc_html( zw_opt( 'services_title' ) ); ?></h2></div>
		<?php zw_render_flip_carousel( zw_services_as_cards(), '1' === $zw_auto ); ?>
	</div>
</section>
<?php endif; ?>

<?php if ( $zw_projects ) : ?>
<section class="section home-projects">
	<div class="wrap">
		<div class="sec-title"><h2><?php echo esc_html( zw_opt( 'projects_title' ) ); ?></h2></div>
		<?php zw_render_projects_carousel( '1' === $zw_auto ); ?>
	</div>
</section>
<?php endif; ?>

<?php
ob_start();
$zw_has_partners = zw_render_partners();
$zw_partners_html = ob_get_clean();
?>
<?php if ( $zw_has_partners ) : ?>
<section class="section bg-white">
	<div class="wrap">
		<div class="sec-title"><h2><?php echo esc_html( zw_opt( 'partners_title' ) ); ?></h2></div>
		<?php echo $zw_partners_html; // phpcs:ignore ?>
	</div>
</section>
<?php endif; ?>

<section class="section bg-white">
	<div class="wrap">
		<div class="sec-title"><h2><?php echo esc_html( zw_opt( 'contact_title' ) ); ?></h2></div>
		<div class="form-narrow">
			<?php get_template_part( 'template-parts/contact-form' ); ?>
		</div>
	</div>
</section>

<?php
get_footer();
