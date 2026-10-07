<?php
/**
 * Header (v2): top bar, centred logo with split navigation, full-screen mobile menu.
 *
 * @package zawaya
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php if ( ! has_site_icon() ) : ?><link rel="icon" href="<?php echo esc_url( zw_img( 'logo-v.png' ) ); ?>"><?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="sr" href="#main">تخطَّ إلى المحتوى</a>
<div class="topbar"><div class="wrap topbar-in">
  <a href="tel:0570001853" class="ltr"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.59,160.3l-47.24-21.17a14,14,0,0,0-13.28,1.22,4.81,4.81,0,0,0-.56.42l-24.69,21a1.88,1.88,0,0,1-1.68.06c-15.87-7.66-32.31-24-40-39.65a1.91,1.91,0,0,1,0-1.68l21.07-25a6.13,6.13,0,0,0,.42-.58,14,14,0,0,0,1.12-13.27L95.73,34.49a14,14,0,0,0-14.56-8.38A54.24,54.24,0,0,0,34,80c0,78.3,63.7,142,142,142a54.25,54.25,0,0,0,53.89-47.17A14,14,0,0,0,221.59,160.3ZM176,210C104.32,210,46,151.68,46,80A42.23,42.23,0,0,1,82.67,38h.23a2,2,0,0,1,1.84,1.31l21.1,47.11a2,2,0,0,1,0,1.67L84.73,113.15a4.73,4.73,0,0,0-.43.57,14,14,0,0,0-.91,13.73c8.87,18.16,27.17,36.32,45.53,45.19a14,14,0,0,0,13.77-1c.19-.13.38-.27.56-.42l24.68-21a1.92,1.92,0,0,1,1.6-.1l47.25,21.17a2,2,0,0,1,1.21,2A42.24,42.24,0,0,1,176,210Z"/></svg>0570001853</a>
  <a href="https://api.whatsapp.com/send/?phone=966570001853" target="_blank" rel="noopener"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M186.68,146.63l-32-16a6,6,0,0,0-6,.38L133,141.46A42.49,42.49,0,0,1,114.54,123L125,107.33a6,6,0,0,0,.38-6l-16-32A6,6,0,0,0,104,66a38,38,0,0,0-38,38,86.1,86.1,0,0,0,86,86,38,38,0,0,0,38-38A6,6,0,0,0,186.68,146.63ZM152,178a74.09,74.09,0,0,1-74-74,26,26,0,0,1,22.42-25.75l12.66,25.32-10.39,15.58a6,6,0,0,0-.54,5.63,54.43,54.43,0,0,0,29.07,29.07,6,6,0,0,0,5.63-.54l15.58-10.39,25.32,12.66A26,26,0,0,1,152,178ZM128,26A102,102,0,0,0,38.35,176.69L26.73,211.56a14,14,0,0,0,17.71,17.71l34.87-11.62A102,102,0,1,0,128,26Zm0,192a90,90,0,0,1-45.06-12.08,6.09,6.09,0,0,0-3-.81,6.2,6.2,0,0,0-1.9.31L40.65,217.88a2,2,0,0,1-2.53-2.53L50.58,178a6,6,0,0,0-.5-4.91A90,90,0,1,1,128,218Z"/></svg>واتساب</a>
  <a href="https://maps.app.goo.gl/ojz2gjjTVpB4kJrt7" target="_blank" rel="noopener" class="tb-loc"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M128,66a38,38,0,1,0,38,38A38,38,0,0,0,128,66Zm0,64a26,26,0,1,1,26-26A26,26,0,0,1,128,130Zm0-112a86.1,86.1,0,0,0-86,86c0,30.91,14.34,63.74,41.47,94.94a252.32,252.32,0,0,0,41.09,38,6,6,0,0,0,6.88,0,252.32,252.32,0,0,0,41.09-38c27.13-31.2,41.47-64,41.47-94.94A86.1,86.1,0,0,0,128,18Zm0,206.51C113,212.93,54,163.62,54,104a74,74,0,0,1,148,0C202,163.62,143,212.93,128,224.51Z"/></svg>الرياض، حي نمار، طريق ديراب</a>
</div></div>
<header class="hdr">
  <div class="wrap hdr-in">
    <nav class="nav nav-r" aria-label="القائمة الرئيسية"><a href="<?php echo esc_url( zv_url( 'home' ) ); ?>"<?php zv_cur( 'home' ); ?>>الرئيسية</a><a href="<?php echo esc_url( zv_url( 'about' ) ); ?>"<?php zv_cur( 'about' ); ?>>من نحن</a><a href="<?php echo esc_url( zv_url( 'services' ) ); ?>"<?php zv_cur( 'services' ); ?>>خدماتنا</a></nav>
    <a class="brand" href="<?php echo esc_url( zv_url( 'home' ) ); ?>" aria-label="زوايا المعالي الرئيسية"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/logo-v.png" alt="زوايا المعالي" width="150" height="63"></a>
    <nav class="nav nav-l" aria-label="القائمة الرئيسية (تابع)"><a href="<?php echo esc_url( zv_url( 'projects' ) ); ?>"<?php zv_cur( 'projects' ); ?>>مشاريعنا</a><a href="<?php echo esc_url( zv_url( 'contact' ) ); ?>"<?php zv_cur( 'contact' ); ?>>تواصل معنا</a><a class="btn btn-gold btn-sm" href="<?php echo esc_url( zv_url( 'contact' ) ); ?>">احجز مناسبتك</a></nav>
    <button class="burger" type="button" aria-expanded="false" aria-controls="mnav" aria-label="فتح القائمة"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H40a6,6,0,0,1,0-12H216A6,6,0,0,1,222,128ZM40,70H216a6,6,0,0,0,0-12H40a6,6,0,0,0,0,12ZM216,186H40a6,6,0,0,0,0,12H216a6,6,0,0,0,0-12Z"/></svg></button>
  </div>
</header>
<nav class="mnav" id="mnav" aria-label="قائمة الجوال" hidden>
  <button class="mnav-x" type="button" aria-label="إغلاق القائمة"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M204.24,195.76a6,6,0,1,1-8.48,8.48L128,136.49,60.24,204.24a6,6,0,0,1-8.48-8.48L119.51,128,51.76,60.24a6,6,0,0,1,8.48-8.48L128,119.51l67.76-67.75a6,6,0,0,1,8.48,8.48L136.49,128Z"/></svg></button>
  <img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/logo-v.png" alt="" width="150" height="63">
  <a href="<?php echo esc_url( zv_url( 'home' ) ); ?>"<?php zv_cur( 'home' ); ?>>الرئيسية</a><a href="<?php echo esc_url( zv_url( 'about' ) ); ?>"<?php zv_cur( 'about' ); ?>>من نحن</a><a href="<?php echo esc_url( zv_url( 'services' ) ); ?>"<?php zv_cur( 'services' ); ?>>خدماتنا</a><a href="<?php echo esc_url( zv_url( 'projects' ) ); ?>"<?php zv_cur( 'projects' ); ?>>مشاريعنا</a><a href="<?php echo esc_url( zv_url( 'contact' ) ); ?>"<?php zv_cur( 'contact' ); ?>>تواصل معنا</a>
  <a class="btn btn-gold" href="<?php echo esc_url( zv_url( 'contact' ) ); ?>">احجز مناسبتك</a>
</nav>
<main id="main">
