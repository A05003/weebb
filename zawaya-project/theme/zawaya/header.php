<?php
/**
 * Header.
 *
 * @package zawaya
 */

$zw_projects = zw_projects();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main">تخطَّ إلى المحتوى</a>

<?php
$zw_phone = zw_opt( 'phone' );
$zw_wa    = zw_wa_link();
$zw_addr  = zw_opt( 'address' );
$zw_map   = zw_opt( 'maps_url' );
?>
<div class="zw-topbar">
	<div class="zw-topbar-in">
		<?php if ( $zw_phone ) : ?>
			<a href="<?php echo esc_attr( zw_tel( $zw_phone ) ); ?>" dir="ltr"><i class="fa-solid fa-phone"></i><?php echo esc_html( $zw_phone ); ?></a>
		<?php endif; ?>
		<?php if ( $zw_wa ) : ?>
			<a href="<?php echo esc_url( $zw_wa ); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i>واتساب</a>
		<?php endif; ?>
		<?php if ( $zw_addr ) : ?>
			<a class="zw-tb-loc" href="<?php echo esc_url( $zw_map ? $zw_map : '#' ); ?>" target="_blank" rel="noopener"><i class="fa-solid fa-location-dot"></i><?php echo esc_html( $zw_addr ); ?></a>
		<?php endif; ?>
	</div>
</div>

<header class="site-header" id="site-header">
	<div class="hdr">
		<nav class="nav nav-r" aria-label="القائمة الرئيسية">
			<?php zw_split_menu( 'first' ); ?>
		</nav>

		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php echo esc_url( zw_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="190" height="80">
		</a>

		<nav class="nav nav-l" aria-label="القائمة الرئيسية (تابع)">
			<?php zw_split_menu( 'second' ); ?>
			<a class="btn btn-gold hdr-cta" href="<?php echo esc_url( zw_contact_url() ); ?>">احجز مناسبتك</a>
		</nav>

		<div class="hdr-mobile">
			<button class="icon-btn burger js-burger" type="button" aria-label="القائمة" aria-expanded="false" aria-controls="mobile-nav"><i class="fa-solid fa-bars"></i></button>
		</div>
	</div>

	<?php if ( $zw_projects ) : ?>
	<div class="mega" id="mega" aria-hidden="true">
		<div class="mega-inner">
			<div class="mega-grid">
				<?php foreach ( $zw_projects as $p ) : ?>
					<a href="<?php echo esc_url( get_permalink( $p ) ); ?>" title="<?php echo esc_attr( get_the_title( $p ) ); ?>">
						<div class="logo-box"><img src="<?php echo esc_url( zw_project_logo( $p->ID, 'medium' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $p ) ); ?>" loading="lazy"></div>
						<span><?php echo esc_html( zw_short( $p->ID ) ); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
			<a class="mega-all" href="<?php echo esc_url( zw_page_url( 'projects' ) ); ?>">عرض جميع المشاريع <i class="fa-solid fa-arrow-left" style="font-size:12px"></i></a>
		</div>
	</div>
	<?php endif; ?>
</header>

<nav class="mobile-nav" id="mobile-nav" aria-label="قائمة الجوال">
	<button class="mnav-x js-mnav-x" type="button" aria-label="إغلاق القائمة"><i class="fa-solid fa-xmark"></i></button>
	<img class="mnav-logo" src="<?php echo esc_url( zw_logo_url() ); ?>" alt="" width="150" height="63">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => false,
			'depth'          => 1,
			'fallback_cb'    => 'zawaya_mobile_fallback',
			'zw_no_mega'     => true,
		)
	);
	?>
	<a class="btn btn-gold" href="<?php echo esc_url( zw_contact_url() ); ?>">احجز مناسبتك</a>
</nav>

<main id="main">
