<?php
/**
 * v2 front-end helpers: page URLs, current-page marker, inner-page head.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Page slug for each key used by the templates. */
function zv_slugs() {
	return array(
		'about'    => 'about-us',
		'services' => 'services',
		'projects' => 'projects',
		'contact'  => 'contact-us',
		'blog'     => 'blog',
	);
}

/** URL for a template key (home, about, services, projects, contact, blog). */
function zv_url( $key ) {
	if ( 'home' === $key ) {
		return home_url( '/' );
	}
	$slugs = zv_slugs();
	return zw_page_url( isset( $slugs[ $key ] ) ? $slugs[ $key ] : $key );
}

/** Echo ' aria-current="page"' when $key is the section being viewed. */
function zv_cur( $key ) {
	$cur = zawaya_current_section();
	$map = array(
		'home'     => 'home',
		'about'    => 'about-us',
		'services' => 'services',
		'projects' => 'projects',
		'contact'  => 'contact-us',
		'blog'     => 'blog',
	);
	if ( isset( $map[ $key ] ) && $map[ $key ] === $cur ) {
		echo ' aria-current="page"';
	}
}

/** Social link from the Customizer ('' when not set). */
function zv_social( $key ) {
	$u = trim( (string) zw_opt( $key ) );
	return $u ? esc_url( $u ) : '';
}

/**
 * Inner-page head (same markup as the static templates).
 *
 * @param string $title  Page title.
 * @param string $sub    Short text under the title.
 * @param string $img    Image file in assets/img, or a full URL.
 * @param array  $crumbs Extra crumbs: array of [label, url].
 */
function zv_phead( $title, $sub = '', $img = 'about-hall.jpg', $crumbs = array() ) {
	$src = ( 0 === strpos( $img, 'http' ) ) ? $img : zw_img( $img );
	?>
<section class="phead">
  <div class="wrap phead-in">
    <div class="phead-copy">
      <nav class="crumbs" aria-label="مسار التنقل"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">الرئيسية</a><?php foreach ( $crumbs as $c ) : ?><span aria-hidden="true">/</span><a href="<?php echo esc_url( $c[1] ); ?>"><?php echo esc_html( $c[0] ); ?></a><?php endforeach; ?><span aria-hidden="true">/</span><span><?php echo esc_html( wp_strip_all_tags( $title ) ); ?></span></nav>
      <h1><?php echo esc_html( $title ); ?></h1>
      <hr class="dash">
      <?php if ( $sub ) : ?><p><?php echo esc_html( $sub ); ?></p><?php endif; ?>
    </div>
    <figure class="phead-photo leaf"><img src="<?php echo esc_url( $src ); ?>" alt=""></figure>
  </div>
</section>
	<?php
}
