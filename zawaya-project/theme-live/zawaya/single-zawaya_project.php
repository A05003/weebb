<?php
/**
 * Single project / palace page.
 *
 * @package zawaya
 */

get_header();

while ( have_posts() ) :
	the_post();
	$zw_id    = get_the_ID();
	$zw_cover = (int) get_post_meta( $zw_id, '_zw_cover', true );
	$zw_facts = zw_facts( $zw_id );
	$zw_feats = zw_lines( get_post_meta( $zw_id, '_zw_features', true ) );
	$zw_phone = get_post_meta( $zw_id, '_zw_phone', true );
	$zw_link  = get_post_meta( $zw_id, '_zw_link', true );
	$zw_gal   = array_filter( array_map( 'intval', explode( ',', (string) get_post_meta( $zw_id, '_zw_gallery', true ) ) ) );

	zw_banner(
		array(
			'title'  => get_the_title(),
			'type'   => get_post_meta( $zw_id, '_zw_type', true ),
			'image'  => $zw_cover ? wp_get_attachment_image_url( $zw_cover, 'full' ) : '',
			'crumbs' => array( array( 'مشاريعنا', zw_page_url( 'projects' ) ) ),
			'small'  => true,
		)
	);
	?>

	<section class="bg-white" style="padding:clamp(48px,8vw,96px) 0 clamp(64px,10vw,120px)">
		<div class="wrap prj-split">
			<div class="prj-logo"><img src="<?php echo esc_url( zw_project_logo( $zw_id, 'large' ) ); ?>" alt="<?php the_title_attribute(); ?>"></div>
			<div class="prj-info">
				<h2>نبذة عن <?php echo esc_html( zw_short( $zw_id ) ); ?></h2>
				<div class="about entry" style="margin:0;max-width:none"><?php the_content(); ?></div>
				<?php if ( $zw_facts ) : ?>
					<div class="facts">
						<?php foreach ( $zw_facts as $f ) : ?>
							<div class="fact"><span class="k"><?php echo esc_html( $f[0] ); ?></span><span class="v"><?php echo esc_html( $f[1] ); ?></span></div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<div class="prj-btns">
					<a class="btn btn-navy" href="<?php echo esc_url( zw_contact_url() ); ?>"><?php echo esc_html( zw_cta( $zw_id ) ); ?></a>
					<?php if ( $zw_link ) : ?>
						<a class="btn btn-soft" href="<?php echo esc_url( $zw_link ); ?>" target="_blank" rel="noopener"><i class="fa-solid fa-link"></i><span>روابط القاعة</span></a>
					<?php endif; ?>
					<?php if ( $zw_phone ) : ?>
						<a class="btn btn-outline btn-phone" href="<?php echo esc_attr( zw_tel( $zw_phone ) ); ?>"><i class="fa-solid fa-phone"></i><span><?php echo esc_html( $zw_phone ); ?></span></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php if ( $zw_feats ) : ?>
	<section class="section bg-soft">
		<div class="wrap">
			<div class="sec-title"><h2>المميزات والخدمات</h2><span class="bar"></span></div>
			<div class="feats">
				<?php foreach ( $zw_feats as $t ) : ?>
					<div class="feat"><span class="ic"><i class="fa-solid fa-check"></i></span><span><?php echo esc_html( $t ); ?></span></div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $zw_gal ) : ?>
	<section class="section bg-white">
		<div class="wrap">
			<div class="sec-title"><h2>معرض الصور</h2><span class="bar"></span></div>
			<div class="gallery">
				<?php foreach ( $zw_gal as $img ) : ?>
					<?php $full = wp_get_attachment_image_url( $img, 'full' ); ?>
					<?php if ( $full ) : ?>
						<a href="<?php echo esc_url( $full ); ?>" data-lightbox><?php echo wp_get_attachment_image( $img, 'zawaya-card', false, array( 'loading' => 'lazy' ) ); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php zw_render_project_reviews( $zw_id ); ?>

	<?php $zw_others = zw_projects( $zw_id ); ?>
	<?php if ( $zw_others ) : ?>
	<section class="section bg-navy">
		<div class="wrap">
			<div class="sec-title"><h2>مشاريع أخرى</h2><span class="bar"></span></div>
			<div class="others">
				<?php foreach ( $zw_others as $o ) : ?>
					<a href="<?php echo esc_url( get_permalink( $o ) ); ?>" title="<?php echo esc_attr( get_the_title( $o ) ); ?>"><img src="<?php echo esc_url( zw_project_logo( $o->ID, 'medium' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $o ) ); ?>" loading="lazy"></a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
endwhile;

get_footer();
