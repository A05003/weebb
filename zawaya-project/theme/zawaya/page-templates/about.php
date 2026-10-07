<?php
/**
 * Template Name: من نحن
 *
 * @package zawaya
 */

get_header();
zw_page_banner( '', 'about-banner.jpg' );
?>

<section class="section--lg bg-white">
	<div class="wrap story">
		<div class="stack" style="gap:18px">
			<span class="kicker"><?php echo esc_html( zw_opt( 'about_kicker' ) ); ?></span>
			<h2><?php echo esc_html( zw_opt( 'about_title' ) ); ?></h2>
			<?php foreach ( array( 'about_p1', 'about_p2' ) as $k ) : ?>
				<?php if ( zw_opt( $k ) ) : ?>
					<p><?php echo esc_html( zw_opt( $k ) ); ?></p>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php
			// Anything written in the page editor appears here too.
			while ( have_posts() ) :
				the_post();
				if ( trim( get_the_content() ) ) {
					echo '<div class="entry" style="margin:0;max-width:none">';
					the_content();
					echo '</div>';
				}
			endwhile;
			?>
			<div class="btns">
				<a class="btn btn-navy" href="<?php echo esc_url( zw_page_url( 'services' ) ); ?>">خدماتنا</a>
				<a class="btn btn-outline" href="<?php echo esc_url( zw_contact_url() ); ?>">تواصل معنا</a>
			</div>
		</div>
		<div class="story-media">
			<img class="m1" src="<?php echo esc_url( zw_opt_img( 'about_img1', 'about-main.jpg' ) ); ?>" alt="" loading="lazy">
			<img class="m2" src="<?php echo esc_url( zw_opt_img( 'about_img2', 'about-hospitality.jpg' ) ); ?>" alt="" loading="lazy">
			<img class="m3" src="<?php echo esc_url( zw_opt_img( 'about_img3', 'about-hall.jpg' ) ); ?>" alt="" loading="lazy">
			<?php if ( zw_opt( 'about_badge' ) ) : ?>
				<div class="story-badge"><b dir="ltr"><?php echo esc_html( zw_opt( 'about_badge' ) ); ?></b><span><?php echo esc_html( zw_opt( 'about_badge_t' ) ); ?></span></div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php if ( zw_counters() ) : ?>
<section class="counters bg-navy-dark">
	<div class="wrap"><?php zw_counters_grid(); ?></div>
</section>
<?php endif; ?>

<section class="section--lg bg-soft">
	<div class="wrap vm">
		<div class="vm-card">
			<i class="fa-solid fa-eye bg-ic" aria-hidden="true"></i>
			<span class="ic"><i class="fa-solid fa-eye"></i></span>
			<h2>الرؤية</h2>
			<p><?php echo esc_html( zw_opt( 'vision' ) ); ?></p>
		</div>
		<div class="vm-card">
			<i class="fa-solid fa-bullseye bg-ic" aria-hidden="true"></i>
			<span class="ic"><i class="fa-solid fa-bullseye"></i></span>
			<h2>الرسالة</h2>
			<p><?php echo esc_html( zw_opt( 'mission' ) ); ?></p>
		</div>
	</div>
</section>

<section class="section--lg bg-white">
	<div class="wrap">
		<div class="sec-title"><h2><?php echo esc_html( zw_opt( 'goals_title' ) ); ?></h2><span class="bar"></span></div>
		<div class="goals">
			<?php
			$n = 0;
			for ( $i = 1; $i <= 5; $i++ ) :
				$t = zw_opt( "g{$i}_title" );
				if ( ! $t ) {
					continue;
				}
				$n++;
				?>
				<div class="goal">
					<span class="n"><?php echo esc_html( sprintf( '%02d', $n ) ); ?></span>
					<span class="ic"><i class="<?php echo esc_attr( zw_opt( "g{$i}_icon" ) ); ?>"></i></span>
					<h3><?php echo esc_html( $t ); ?></h3>
					<p><?php echo esc_html( zw_opt( "g{$i}_text" ) ); ?></p>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>

<section class="section--lg bg-navy">
	<div class="wrap">
		<div class="sec-title"><h2><?php echo esc_html( zw_opt( 'values_title' ) ); ?></h2><span class="bar"></span></div>
		<div class="values">
			<?php
			for ( $i = 1; $i <= 6; $i++ ) :
				$t = zw_opt( "v{$i}_title" );
				if ( ! $t ) {
					continue;
				}
				?>
				<div class="value">
					<span class="ic"><i class="<?php echo esc_attr( zw_opt( "v{$i}_icon" ) ); ?>"></i></span>
					<h3><?php echo esc_html( $t ); ?></h3>
					<p><?php echo esc_html( zw_opt( "v{$i}_text" ) ); ?></p>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>

<?php $zw_projects = zw_projects(); ?>
<?php if ( $zw_projects ) : ?>
<section class="section--lg bg-white">
	<div class="wrap">
		<div class="sec-title"><h2><?php echo esc_html( zw_opt( 'group_title' ) ); ?></h2><span class="bar"></span></div>
		<?php zw_render_projects_grid(); ?>
	</div>
</section>
<?php endif; ?>

<?php
get_footer();
