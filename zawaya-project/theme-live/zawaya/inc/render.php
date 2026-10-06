<?php
/**
 * Shared renderers used by both the classic page templates and the Elementor widgets.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Projects logo carousel (home page).
 *
 * @param bool $autoplay Autoplay.
 */
function zw_render_projects_carousel( $autoplay = true ) {
	$projects = zw_projects();
	if ( ! $projects ) {
		return false;
	}
	?>
	<div class="carousel prj-carousel" data-carousel data-autoplay="<?php echo $autoplay ? '1' : '0'; ?>">
		<div class="carousel-viewport">
			<div class="carousel-track">
				<?php foreach ( $projects as $p ) : ?>
					<div class="carousel-item">
						<a class="prj-card" href="<?php echo esc_url( get_permalink( $p ) ); ?>">
							<img src="<?php echo esc_url( zw_project_logo( $p->ID ) ); ?>" alt="<?php echo esc_attr( get_the_title( $p ) ); ?>" loading="lazy">
							<span class="ov">
								<h3><?php echo esc_html( get_the_title( $p ) ); ?></h3>
								<?php if ( has_excerpt( $p ) ) : ?>
									<p><?php echo esc_html( get_the_excerpt( $p ) ); ?></p>
								<?php endif; ?>
							</span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
	return true;
}

/**
 * Grid of project logos (about page "our companies").
 *
 * @param int $exclude Project id to leave out.
 */
function zw_render_projects_grid( $exclude = 0 ) {
	$projects = zw_projects( $exclude );
	if ( ! $projects ) {
		return false;
	}
	echo '<div class="logo-grid">';
	foreach ( $projects as $p ) {
		printf(
			'<a href="%1$s" title="%2$s"><img src="%3$s" alt="%2$s" loading="lazy"></a>',
			esc_url( get_permalink( $p ) ),
			esc_attr( get_the_title( $p ) ),
			esc_url( zw_project_logo( $p->ID ) )
		);
	}
	echo '</div>';
	return true;
}

/**
 * Full projects list with sticky tabs (projects page).
 *
 * @param bool $tabs Show the tabs bar.
 */
function zw_render_projects_list( $tabs = true ) {
	$projects = zw_projects();
	if ( ! $projects ) {
		return false;
	}
	if ( $tabs ) :
		?>
		<nav class="prj-tabs" aria-label="المشاريع">
			<div class="wrap">
				<?php foreach ( $projects as $p ) : ?>
					<a href="#<?php echo esc_attr( $p->post_name ); ?>"><?php echo esc_html( zw_short( $p->ID ) ); ?></a>
				<?php endforeach; ?>
			</div>
		</nav>
		<?php
	endif;
	?>
	<div class="prj-list">
		<?php foreach ( $projects as $p ) : ?>
			<?php
			$facts = zw_facts( $p->ID );
			$feats = zw_lines( get_post_meta( $p->ID, '_zw_features', true ) );
			$phone = get_post_meta( $p->ID, '_zw_phone', true );
			$link  = get_post_meta( $p->ID, '_zw_link', true );
			$type  = get_post_meta( $p->ID, '_zw_type', true );
			?>
			<section class="prj-row" id="<?php echo esc_attr( $p->post_name ); ?>">
				<div class="wrap prj-split">
					<a class="prj-logo" href="#<?php echo esc_attr( $p->post_name ); ?>"><img src="<?php echo esc_url( zw_project_logo( $p->ID, 'large' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $p ) ); ?>" loading="lazy"></a>
					<div class="prj-info">
						<?php if ( $type ) : ?>
							<span class="pill"><?php echo esc_html( $type ); ?></span>
						<?php endif; ?>
						<h2><?php echo esc_html( get_the_title( $p ) ); ?></h2>
						<?php zw_render_rating_chip( $p->ID ); ?>
						<div class="about"><?php echo wp_kses_post( wpautop( wp_strip_all_tags( strip_shortcodes( $p->post_content ) ) ) ); ?></div>
						<?php if ( $facts ) : ?>
							<div class="facts">
								<?php foreach ( $facts as $f ) : ?>
									<div class="fact"><span class="k"><?php echo esc_html( $f[0] ); ?></span><span class="v"><?php echo esc_html( $f[1] ); ?></span></div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<?php if ( $feats ) : ?>
							<div class="feat-mini">
								<h3>المميزات والخدمات</h3>
								<ul>
									<?php foreach ( $feats as $t ) : ?>
										<li><i class="fa-solid fa-circle-check"></i><?php echo esc_html( $t ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
						<?php zw_render_project_reviews_inline( $p->ID ); ?>
						<?php zw_render_project_gallery( $p->ID ); ?>
						<div class="prj-btns">
							<a class="btn btn-navy" href="<?php echo esc_url( zw_contact_url() ); ?>"><?php echo esc_html( zw_cta( $p->ID ) ); ?></a>
							<?php zw_render_site_button( $p->ID, 'btn btn-gold' ); ?>
							<?php if ( $link ) : ?>
								<a class="btn btn-soft" href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener"><i class="fa-solid fa-link"></i><span>روابط القاعة</span></a>
							<?php endif; ?>
							<?php if ( $phone ) : ?>
								<a class="btn btn-outline btn-phone" href="<?php echo esc_attr( zw_tel( $phone ) ); ?>"><i class="fa-solid fa-phone"></i><span><?php echo esc_html( $phone ); ?></span></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		<?php endforeach; ?>
	</div>
	<?php
	return true;
}

/** Partners logos. Returns false when there are none. */
function zw_render_partners() {
	$partners = get_posts(
		array(
			'post_type'      => 'zawaya_partner',
			'posts_per_page' => -1,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
		)
	);
	$items = array();
	foreach ( $partners as $pt ) {
		$logo = get_the_post_thumbnail_url( $pt, 'medium' );
		if ( $logo ) {
			$items[] = array( $pt, $logo, get_post_meta( $pt->ID, '_zw_link', true ) );
		}
	}
	if ( ! $items ) {
		return false;
	}
	echo '<div class="partners">';
	foreach ( $items as $it ) {
		list( $pt, $logo, $link ) = $it;
		$title = esc_attr( get_the_title( $pt ) );
		$img   = '<img src="' . esc_url( $logo ) . '" alt="' . $title . '" loading="lazy">';
		if ( $link ) {
			echo '<a class="partner" href="' . esc_url( $link ) . '" target="_blank" rel="noopener" title="' . $title . '">' . $img . '</a>'; // phpcs:ignore
		} else {
			echo '<div class="partner" title="' . $title . '">' . $img . '</div>'; // phpcs:ignore
		}
	}
	echo '</div>';
	return true;
}

/**
 * Flip-card carousel.
 *
 * @param array $items    Each: image (url), title, text, btn, link, external.
 * @param bool  $autoplay Autoplay.
 */
function zw_render_flip_carousel( $items, $autoplay = true ) {
	if ( ! $items ) {
		return false;
	}
	?>
	<div class="carousel svc-carousel" data-carousel data-autoplay="<?php echo $autoplay ? '1' : '0'; ?>">
		<div class="carousel-viewport">
			<div class="carousel-track">
				<?php foreach ( $items as $it ) : ?>
					<div class="carousel-item">
						<div class="flip" tabindex="0">
							<div class="flip-face flip-front"<?php echo $it['image'] ? ' style="background-image:url(\'' . esc_url( $it['image'] ) . '\')"' : ''; ?>>
								<div class="shade"><h3><?php echo esc_html( $it['title'] ); ?></h3></div>
							</div>
							<div class="flip-face flip-back">
								<?php if ( $it['text'] ) : ?>
									<p><?php echo esc_html( $it['text'] ); ?></p>
								<?php endif; ?>
								<?php if ( $it['btn'] && $it['link'] ) : ?>
									<a class="btn btn-gold" href="<?php echo esc_url( $it['link'] ); ?>"<?php echo ! empty( $it['external'] ) ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html( $it['btn'] ); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<button class="carousel-btn prev" type="button" aria-label="السابق"><i class="fa-solid fa-chevron-right"></i></button>
		<button class="carousel-btn next" type="button" aria-label="التالي"><i class="fa-solid fa-chevron-left"></i></button>
	</div>
	<?php
	return true;
}

/** Services (from the dashboard) as flip-carousel items. */
function zw_services_as_cards() {
	$out = array();
	foreach ( zw_services() as $s ) {
		$out[] = array(
			'image' => (string) get_the_post_thumbnail_url( $s, 'zawaya-square' ),
			'title' => get_the_title( $s ),
			'text'  => has_excerpt( $s ) ? get_the_excerpt( $s ) : wp_trim_words( wp_strip_all_tags( $s->post_content ), 20, '…' ),
			'btn'   => 'عرض المزيد',
			'link'  => zw_page_url( 'services' ),
		);
	}
	return $out;
}
