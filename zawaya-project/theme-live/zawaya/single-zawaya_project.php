<?php
/**
 * Single hall / project page: its own colour, hero, facts, features, gallery, guest reviews.
 *
 * @package zawaya
 */

get_header();

while ( have_posts() ) :
	the_post();
	$zw_id    = get_the_ID();
	$zw_acc   = zw_hall_accent( $zw_id );
	$zw_cover = (int) get_post_meta( $zw_id, '_zw_cover', true );
	$zw_cover = $zw_cover ? wp_get_attachment_image_url( $zw_cover, 'full' ) : '';
	$zw_type  = get_post_meta( $zw_id, '_zw_type', true );
	$zw_facts = zw_facts( $zw_id );
	$zw_feats = zw_lines( get_post_meta( $zw_id, '_zw_features', true ) );
	$zw_phone = get_post_meta( $zw_id, '_zw_phone', true );
	$zw_link  = get_post_meta( $zw_id, '_zw_link', true );
	?>
	<div class="hall" style="--acc:<?php echo esc_attr( $zw_acc ); ?>">

	<section class="hall-hero">
		<?php if ( $zw_cover ) : ?><div class="hall-hero-bg" style="background-image:url('<?php echo esc_url( $zw_cover ); ?>')"></div><?php endif; ?>
		<div class="hall-hero-in">
			<div class="hall-hero-copy">
				<nav class="crumbs" aria-label="مسار التنقل">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">الرئيسية</a><span class="sep">/</span>
					<a href="<?php echo esc_url( zw_page_url( 'projects' ) ); ?>">مشاريعنا</a><span class="sep">/</span>
					<span class="cur"><?php echo esc_html( zw_short( $zw_id ) ); ?></span>
				</nav>
				<?php if ( $zw_type ) : ?><span class="hall-pill"><?php echo esc_html( $zw_type ); ?></span><?php endif; ?>
				<h1><?php the_title(); ?></h1>
				<?php zw_render_rating_chip( $zw_id ); ?>
				<div class="hall-actions">
					<a class="btn btn-gold" href="<?php echo esc_url( zw_contact_url() ); ?>"><?php echo esc_html( zw_cta( $zw_id ) ); ?></a>
					<?php zw_render_site_button( $zw_id, 'btn btn-soft' ); ?>
					<?php if ( $zw_link ) : ?>
						<a class="btn btn-ghost" href="<?php echo esc_url( $zw_link ); ?>" target="_blank" rel="noopener"><i class="fa-solid fa-link"></i><span>لينكتري القاعة</span></a>
					<?php endif; ?>
					<?php if ( $zw_phone ) : ?>
						<a class="btn btn-ghost btn-phone" href="<?php echo esc_attr( zw_tel( $zw_phone ) ); ?>"><i class="fa-solid fa-phone"></i><span dir="ltr"><?php echo esc_html( $zw_phone ); ?></span></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="hall-hero-logo"><img src="<?php echo esc_url( zw_project_logo( $zw_id, 'large' ) ); ?>" alt="<?php the_title_attribute(); ?>"></div>
		</div>
		<?php zw_curve( 'var(--bg)' ); ?>
	</section>

	<?php if ( $zw_facts ) : ?>
	<section class="hall-facts-wrap">
		<div class="wrap">
			<div class="hall-facts">
				<?php foreach ( $zw_facts as $f ) : ?>
					<div class="hall-fact"><span class="k"><?php echo esc_html( $f[0] ); ?></span><span class="v"><?php echo esc_html( $f[1] ); ?></span></div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<section class="hall-about">
		<div class="wrap hall-about-in">
			<div class="hall-about-text">
				<h2>نبذة عن <?php echo esc_html( zw_short( $zw_id ) ); ?></h2>
				<div class="entry"><?php the_content(); ?></div>
			</div>
			<?php if ( $zw_feats ) : ?>
			<aside class="hall-feats">
				<h3>المميزات والخدمات</h3>
				<ul>
					<?php foreach ( $zw_feats as $t ) : ?>
						<li><i class="fa-solid fa-circle-check"></i><span><?php echo esc_html( $t ); ?></span></li>
					<?php endforeach; ?>
				</ul>
			</aside>
			<?php endif; ?>
		</div>
	</section>

	<?php
	$zw_gal = array_filter( array_map( 'intval', explode( ',', (string) get_post_meta( $zw_id, '_zw_gallery', true ) ) ) );
	if ( $zw_gal ) :
		?>
	<section class="hall-gallery">
		<div class="wrap">
			<div class="sec-title"><h2>معرض الصور</h2><span class="bar"></span></div>
			<?php zw_render_project_gallery( $zw_id ); ?>
		</div>
	</section>
	<?php endif; ?>

	<?php zw_render_project_reviews( $zw_id ); ?>

	<section class="hall-cta">
		<div class="wrap hall-cta-in">
			<div><h2>جاهزين نستقبلكم في <?php echo esc_html( zw_short( $zw_id ) ); ?></h2><p>احجز موعد زيارة، أو اطلب عرضاً مفصلاً لمناسبتك.</p></div>
			<div class="hall-actions">
				<a class="btn btn-gold" href="<?php echo esc_url( zw_contact_url() ); ?>"><?php echo esc_html( zw_cta( $zw_id ) ); ?></a>
				<?php if ( $zw_phone ) : ?>
					<a class="btn btn-ghost btn-phone" href="<?php echo esc_attr( zw_tel( $zw_phone ) ); ?>"><i class="fa-solid fa-phone"></i><span dir="ltr"><?php echo esc_html( $zw_phone ); ?></span></a>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php $zw_others = zw_projects( $zw_id ); ?>
	<?php if ( $zw_others ) : ?>
	<section class="hall-others">
		<div class="wrap">
			<div class="sec-title"><h2>قاعات ومشاريع أخرى</h2><span class="bar"></span></div>
			<div class="hall-others-row">
				<?php foreach ( $zw_others as $o ) : ?>
					<a class="hall-mini" href="<?php echo esc_url( get_permalink( $o ) ); ?>" style="--acc:<?php echo esc_attr( zw_hall_accent( $o ) ); ?>" title="<?php echo esc_attr( get_the_title( $o ) ); ?>">
						<img src="<?php echo esc_url( zw_project_logo( $o->ID, 'medium' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $o ) ); ?>" loading="lazy">
						<span><?php echo esc_html( zw_short( $o->ID ) ); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	</div>
	<?php
endwhile;

get_footer();
