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

<header class="site-header" id="site-header">
	<div class="hdr">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php echo esc_url( zw_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="190" height="80">
		</a>

		<nav class="nav" aria-label="القائمة الرئيسية">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'zawaya_menu_fallback',
				)
			);
			?>
			<button class="icon-btn js-theme" type="button" data-zw-inline="1" onclick="var d=document.documentElement,k=d.dataset.theme!=='dark';d.classList.add('zm-theming');d.dataset.theme=k?'dark':'light';try{localStorage.setItem('zawaya-theme',k?'dark':'light')}catch(e){}setTimeout(function(){d.classList.remove('zm-theming')},700)" aria-label="تبديل الوضع الليلي والنهاري" title="الوضع الليلي / النهاري"><i class="fa-solid fa-moon"></i></button>
			<a class="btn btn-gold hdr-cta" href="<?php echo esc_url( zw_contact_url() ); ?>">تواصل معنا</a>
		</nav>

		<div class="hdr-mobile">
			<button class="icon-btn js-theme" type="button" data-zw-inline="1" onclick="var d=document.documentElement,k=d.dataset.theme!=='dark';d.classList.add('zm-theming');d.dataset.theme=k?'dark':'light';try{localStorage.setItem('zawaya-theme',k?'dark':'light')}catch(e){}setTimeout(function(){d.classList.remove('zm-theming')},700)" aria-label="تبديل الوضع الليلي والنهاري" title="الوضع الليلي / النهاري"><i class="fa-solid fa-moon"></i></button>
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

	<nav class="mobile-nav" id="mobile-nav" aria-label="قائمة الجوال">
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
		<a class="btn btn-gold" href="<?php echo esc_url( zw_contact_url() ); ?>">تواصل معنا</a>
	</nav>
</header>

<main id="main">
