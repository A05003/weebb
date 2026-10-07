<?php
/**
 * Template Name: مشاريعنا
 *
 * @package zawaya
 */

get_header();
?>
<section class="phead">
  <div class="wrap phead-in">
    <div class="phead-copy">
      <nav class="crumbs" aria-label="مسار التنقل"><a href="<?php echo esc_url( zv_url( 'home' ) ); ?>">الرئيسية</a><span aria-hidden="true">/</span><span>مشاريعنا</span></nav>
      <h1>مشاريعنا</h1>
      <hr class="dash">
      <p>قصورنا وشركاتنا، ولقطات من أفراحنا وتجهيزاتنا وضيافتنا.</p>
    </div>
    <figure class="phead-photo leaf"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/hero.jpg" alt=""></figure>
  </div>
</section><?php $zv_ps = zw_projects(); ?>
<?php if ( $zv_ps ) : ?>
<section class="sec" id="venues">
  <div class="wrap">
    <div class="head reveal"><h2>قصورنا وشركاتنا</h2></div>
    <div class="plist">
      <?php foreach ( $zv_ps as $zv_p ) : ?>
        <article class="pcard reveal">
          <span class="logo"><img src="<?php echo esc_url( zw_project_logo( $zv_p->ID, 'medium' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $zv_p ) ); ?>" loading="lazy"></span>
          <h3><?php echo esc_html( get_the_title( $zv_p ) ); ?></h3>
          <?php $zv_type = get_post_meta( $zv_p->ID, '_zw_type', true ); ?>
          <?php if ( $zv_type ) : ?><span class="dist"><?php echo esc_html( $zv_type ); ?></span><?php endif; ?>
          <p><?php echo esc_html( wp_trim_words( has_excerpt( $zv_p ) ? get_the_excerpt( $zv_p ) : wp_strip_all_tags( $zv_p->post_content ), 26, '…' ) ); ?></p>
          <div class="btns">
            <a class="btn btn-navy btn-sm" href="<?php echo esc_url( get_permalink( $zv_p ) ); ?>">عرض التفاصيل</a>
            <a class="btn btn-line btn-sm" href="<?php echo esc_url( zv_url( 'contact' ) ); ?>"><?php echo esc_html( zw_cta( $zv_p->ID ) ); ?></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<section class="sec pearl">
  <div class="wrap">
    <div class="filters" role="group" aria-label="تصفية المعرض">
      <button class="tab" type="button" data-filter="all" aria-pressed="true">الكل</button>
      <button class="tab" type="button" data-filter="weddings" aria-pressed="false">أفراح</button>
      <button class="tab" type="button" data-filter="setups" aria-pressed="false">تجهيزات</button>
      <button class="tab" type="button" data-filter="catering" aria-pressed="false">ضيافة وبوفيه</button>
      <button class="tab" type="button" data-filter="venues" aria-pressed="false">القصور</button>
      <span class="gcount" aria-live="polite"><b id="g-count">5</b> عمل</span>
    </div>
    <div class="gallery"><button class="g-item" type="button" data-cat="weddings" aria-label="تكبير: قاعة زفاف بثريات كريستالية"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hall.jpg" alt="قاعة زفاف بثريات كريستالية" loading="lazy"><span class="cap"><small>أفراح</small><b>قاعة زفاف بثريات كريستالية</b></span></button><button class="g-item" type="button" data-cat="catering" aria-label="تكبير: محطة حلويات الضيافة"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hospitality.jpg" alt="محطة حلويات الضيافة" loading="lazy"><span class="cap"><small>ضيافة وبوفيه</small><b>محطة حلويات الضيافة</b></span></button><button class="g-item" type="button" data-cat="setups" aria-label="تكبير: استقبال وتنسيق مدخل المناسبة"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-main.jpg" alt="استقبال وتنسيق مدخل المناسبة" loading="lazy"><span class="cap"><small>تجهيزات</small><b>استقبال وتنسيق مدخل المناسبة</b></span></button><button class="g-item" type="button" data-cat="venues" aria-label="تكبير: قصر روعة الملتقى ليلاً"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/hero.jpg" alt="قصر روعة الملتقى ليلاً" loading="lazy"><span class="cap"><small>القصور</small><b>قصر روعة الملتقى ليلاً</b></span></button><button class="g-item" type="button" data-cat="weddings setups" aria-label="تكبير: تنسيق ركن الاستقبال"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-banner.jpg" alt="تنسيق ركن الاستقبال" loading="lazy"><span class="cap"><small>أفراح</small><b>تنسيق ركن الاستقبال</b></span></button></div>
  </div>
</section>
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="عرض الصورة" hidden>
  <button class="lb-close" type="button" aria-label="إغلاق"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M204.24,195.76a6,6,0,1,1-8.48,8.48L128,136.49,60.24,204.24a6,6,0,0,1-8.48-8.48L119.51,128,51.76,60.24a6,6,0,0,1,8.48-8.48L128,119.51l67.76-67.75a6,6,0,0,1,8.48,8.48L136.49,128Z"/></svg></button>
  <figure><img src="" alt=""><figcaption></figcaption></figure>
</div>
<?php
get_footer();
