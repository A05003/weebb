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
	$zw_check = '<svg aria-hidden="true" viewBox="0 0 256 256" fill="currentColor"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"/></svg>';

	zv_phead(
		get_the_title(),
		get_post_meta( $zw_id, '_zw_type', true ),
		$zw_cover ? (string) wp_get_attachment_image_url( $zw_cover, 'large' ) : 'about-hall.jpg',
		array( array( 'مشاريعنا', zv_url( 'projects' ) ) )
	);
	?>
	<section class="sec">
		<div class="wrap prj">
			<div class="prj-logo"><img src="<?php echo esc_url( zw_project_logo( $zw_id, 'large' ) ); ?>" alt="<?php the_title_attribute(); ?>"></div>
			<div>
				<h2>نبذة عن <?php echo esc_html( zw_short( $zw_id ) ); ?></h2>
				<div class="entry" style="margin:0;max-width:none"><?php the_content(); ?></div>
				<?php if ( $zw_facts ) : ?>
					<div class="pfacts">
						<?php foreach ( $zw_facts as $f ) : ?>
							<div class="pfact"><span class="k"><?php echo esc_html( $f[0] ); ?></span><span><?php echo esc_html( $f[1] ); ?></span></div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<div class="btns">
					<a class="btn btn-navy" href="<?php echo esc_url( zv_url( 'contact' ) ); ?>"><?php echo esc_html( zw_cta( $zw_id ) ); ?></a>
					<?php if ( $zw_link ) : ?>
						<a class="btn btn-line" href="<?php echo esc_url( $zw_link ); ?>" target="_blank" rel="noopener">روابط القاعة</a>
					<?php endif; ?>
					<?php if ( $zw_phone ) : ?>
						<a class="btn btn-line ltr" href="<?php echo esc_attr( zw_tel( $zw_phone ) ); ?>"><?php echo esc_html( $zw_phone ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php if ( $zw_feats ) : ?>
	<section class="sec pearl">
		<div class="wrap">
			<div class="head"><h2>المميزات والخدمات</h2></div>
			<ul class="checks" style="max-width:640px;margin-inline:auto">
				<?php foreach ( $zw_feats as $t ) : ?>
					<li><?php echo $zw_check; // phpcs:ignore ?><span><?php echo esc_html( $t ); ?></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( $zw_gal ) : ?>
	<section class="sec">
		<div class="wrap">
			<div class="head"><h2>معرض الصور</h2></div>
			<div class="gallery">
				<?php foreach ( $zw_gal as $img ) : ?>
					<?php $full = wp_get_attachment_image_url( $img, 'full' ); ?>
					<?php if ( $full ) : ?>
						<a class="g-item" href="<?php echo esc_url( $full ); ?>" target="_blank" rel="noopener"><?php echo wp_get_attachment_image( $img, 'zawaya-card', false, array( 'loading' => 'lazy' ) ); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php $zw_others = zw_projects( $zw_id ); ?>
	<?php if ( $zw_others ) : ?>
	<section class="sec navy">
		<div class="wrap">
			<div class="head"><h2>مشاريع أخرى</h2></div>
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
