<?php
/**
 * Home page.
 *
 * @package zawaya
 */

get_header();
?>
<section class="hero">
  <div class="slides" aria-hidden="true"><img class="slide on" src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/hero.jpg" alt=""><img class="slide" src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hall.jpg" alt=""><img class="slide" src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hospitality.jpg" alt=""></div>
  <div class="wrap hero-in">
    <h1>زوايا المعالي<br><em>خمسة قصور، وتفاصيل تُروى</em></h1>
    <hr class="dash">
    <p>نُدير قصور الأفراح في الرياض، وننسّق الزفاف والضيافة والتقنية بفريق واحد من الحجز حتى آخر ضيف.</p>
    <div class="hero-ctas">
      <a class="btn btn-gold" href="<?php echo esc_url( zv_url( 'contact' ) ); ?>">احجز مناسبتك <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></a>
      <a class="btn btn-ghost" href="<?php echo esc_url( zv_url( 'projects' ) ); ?>">شاهد قصورنا</a>
    </div>
  </div>
  <div class="hero-logos"><div class="wrap"><a href="https://www.google.com/maps/search/?api=1&query=قصر+الماسة&query_place_id=ChIJFxXQuahVLj4RgLuvd6L65zg" target="_blank" rel="noopener" aria-label="قصر الماسة"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/lg-almasa.png" alt="قصر الماسة"></a><a href="https://www.google.com/maps/search/?api=1&query=قصر+روعة+الملتقى&query_place_id=ChIJz4SgnpCqLz4RfZI4qZWblVg" target="_blank" rel="noopener" aria-label="قصر روعة الملتقى"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/lg-multaqa.png" alt="قصر روعة الملتقى"></a><a href="https://www.google.com/maps/search/?api=1&query=قصر+مودة&query_place_id=ChIJAeKfYLEQLz4R-v-M_03KlTo" target="_blank" rel="noopener" aria-label="قصر مودة"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/lg-mawadda.png" alt="قصر مودة"></a><a href="https://www.google.com/maps/search/?api=1&query=قصر+ليالي+الديار&query_place_id=ChIJr0Da5okRLz4RU4TXX8BSoDk" target="_blank" rel="noopener" aria-label="قصر ليالي الديار"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/lg-diyar.png" alt="قصر ليالي الديار"></a><a href="https://www.google.com/maps/search/?api=1&query=قصر+هيلون+بالاس&query_place_id=ChIJUevfTG8OLz4RV881J2weL3c" target="_blank" rel="noopener" aria-label="قصر هيلون بالاس"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/lg-helon.png" alt="قصر هيلون بالاس"></a></div></div>
</section>

<section class="stats" aria-label="أرقامنا">
  <div class="wrap stats-grid">
    <div class="stat"><b data-count="23578">23,578</b><span>عميل خدمناهم</span></div>
    <div class="stat"><b data-count="13533">13,533</b><span>مناسبة نظّمناها</span></div>
    <div class="stat"><b data-count="250" data-prefix="+">+250</b><span>موظف وموظفة</span></div>
    <div class="stat"><b>5</b><span>قصور في الرياض</span></div>
  </div>
</section>

<section class="sec pearl">
  <div class="wrap about3">
    <div class="a-story reveal">
      <span class="eyebrow">من نحن</span>
      <h2>شركة عائلية في صناعة المناسبات منذ أكثر من تسعة أعوام</h2>
      <p>نُدير خمسة قصور للأفراح والمؤتمرات في الرياض، ومعها مطاعم زوايا المعالي للبوفيه المفتوح والضيافة، وفريق تقني للإضاءة والعروض.</p>
      <a class="btn btn-line" href="<?php echo esc_url( zv_url( 'about' ) ); ?>">تعرّف علينا</a>
    </div>
    <figure class="a-photo bezel reveal"><img class="leaf" src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-main.jpg" alt="استقبال الضيوف في إحدى مناسبات زوايا المعالي" loading="lazy"></figure>
    <div class="a-vm reveal">
      <article><h3>رؤيتنا</h3><p>أن نكون الوجهة الأولى في إدارة وتشغيل قصور الأفراح وصناعة المناسبات في المملكة.</p></article>
      <hr class="dash">
      <article><h3>رسالتنا</h3><p>خدمات مبتكرة بأعلى معايير الجودة، وتجارب تعكس الإبداع والأصالة.</p></article>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="head reveal"><h2>كل ما تحتاجه مناسبتك</h2></div>
    <div class="svc3">
      <a class="svc svc-lg reveal" href="<?php echo esc_url( zv_url( 'services' ) ); ?>#halls"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hall.jpg" alt="" loading="lazy"><div><h3>القاعات وتنسيق الزفاف</h3><p>الكوشة والزفة وغرفة التجهيز بتنسيق يناسب ذوقكم.</p><span class="more">التفاصيل <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></span></div></a>
      <a class="svc reveal" href="<?php echo esc_url( zv_url( 'services' ) ); ?>#catering"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hospitality.jpg" alt="" loading="lazy"><div><h3>الضيافة والبوفيه</h3><p>مطاعم زوايا المعالي: بوفيهات وقهوجية وحلويات.</p><span class="more">التفاصيل <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></span></div></a>
      <a class="svc reveal" href="<?php echo esc_url( zv_url( 'services' ) ); ?>#tech"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/hero.jpg" alt="" loading="lazy"><div><h3>العروض التقنية</h3><p>صوتيات وإضاءة وجوبو وكشك Touchpix للضيوف.</p><span class="more">التفاصيل <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></span></div></a>
    </div>
  </div>
</section>

<section class="sec navy" id="venues">
  <div class="wrap">
    <div class="head reveal"><h2>خمسة قصور نُديرها في الرياض</h2></div>
    <div class="venues">
      <article class="venue reveal"><span class="logo"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/lg-almasa.png" alt="شعار قصر الماسة"></span><h3>قصر الماسة</h3><span class="dist">حي الجنادرية، الرياض</span><p>350-400 ضيف لكل قسم، وحديقة خارجية</p><div class="rate"><span class="stars" role="img" aria-label="تقييم 4.4 من 5">★★★★★</span><b>4.4</b><small>1,168 تقييم في Google</small></div><a class="more" href="https://www.google.com/maps/search/?api=1&query=قصر+الماسة&query_place_id=ChIJFxXQuahVLj4RgLuvd6L65zg" target="_blank" rel="noopener">الموقع على الخريطة <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></a></article><article class="venue reveal"><span class="logo"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/lg-multaqa.png" alt="شعار قصر روعة الملتقى"></span><h3>قصر روعة الملتقى</h3><span class="dist">حي المعيزيلة، الرياض</span><p>حتى 400 ضيفة، وصالة طعام لـ 450</p><div class="rate"><span class="stars" role="img" aria-label="تقييم 4.2 من 5">★★★★★</span><b>4.2</b><small>2,058 تقييم في Google</small></div><a class="more" href="https://www.google.com/maps/search/?api=1&query=قصر+روعة+الملتقى&query_place_id=ChIJz4SgnpCqLz4RfZI4qZWblVg" target="_blank" rel="noopener">الموقع على الخريطة <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></a></article><article class="venue reveal"><span class="logo"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/lg-mawadda.png" alt="شعار قصر مودة"></span><h3>قصر مودة</h3><span class="dist">ظهرة نمار، الرياض</span><p>حتى 450 ضيفة، ودرج زفة وممر رخامي</p><div class="rate"><span class="stars" role="img" aria-label="تقييم 4.1 من 5">★★★★★</span><b>4.1</b><small>2,284 تقييم في Google</small></div><a class="more" href="https://www.google.com/maps/search/?api=1&query=قصر+مودة&query_place_id=ChIJAeKfYLEQLz4R-v-M_03KlTo" target="_blank" rel="noopener">الموقع على الخريطة <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></a></article><article class="venue reveal"><span class="logo"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/lg-diyar.png" alt="شعار قصر ليالي الديار"></span><h3>قصر ليالي الديار</h3><span class="dist">حي الحزم، الرياض</span><p>قاعة بلا أعمدة، وأكثر من حفل في الوقت نفسه</p><div class="rate"><span class="stars" role="img" aria-label="تقييم 4.4 من 5">★★★★★</span><b>4.4</b><small>1,347 تقييم في Google</small></div><a class="more" href="https://www.google.com/maps/search/?api=1&query=قصر+ليالي+الديار&query_place_id=ChIJr0Da5okRLz4RU4TXX8BSoDk" target="_blank" rel="noopener">الموقع على الخريطة <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></a></article><article class="venue reveal"><span class="logo"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/lg-helon.png" alt="شعار قصر هيلون بالاس"></span><h3>قصر هيلون بالاس</h3><span class="dist">حي الشفاء، الرياض</span><p>قاعة بلا أعمدة، وأكثر من حفل في الوقت نفسه</p><div class="rate"><span class="stars" role="img" aria-label="تقييم 4.3 من 5">★★★★★</span><b>4.3</b><small>1,432 تقييم في Google</small></div><a class="more" href="https://www.google.com/maps/search/?api=1&query=قصر+هيلون+بالاس&query_place_id=ChIJUevfTG8OLz4RV881J2weL3c" target="_blank" rel="noopener">الموقع على الخريطة <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></a></article>
    </div>
  </div>
</section>

<section class="sec pearl">
  <div class="wrap">
    <div class="head reveal"><span class="eyebrow">آراء ضيوفنا</span><h2>ماذا قال ضيوفنا في قصورنا</h2><p class="lead">مقتطفات إيجابية من تقييمات Google للقصور الخمسة (مترجمة).</p></div>
    <div class="carousel" data-carousel>
      <div class="car-track">
        <figure class="rev"><span class="stars" aria-hidden="true">★★★★★</span><blockquote><p>«خدمة ممتازة ومواقف واسعة، والطاقم محترف جداً وما عندي أي ملاحظة.»</p></blockquote><figcaption><b>قصر ليالي الديار</b><small>مترجم من تقييمات Google</small></figcaption></figure><figure class="rev"><span class="stars" aria-hidden="true">★★★★★</span><blockquote><p>«خدمة رائعة وقيمة مقابل السعر، وكانت تجربتي في زواج صديق خمس نجوم.»</p></blockquote><figcaption><b>قصر روعة الملتقى</b><small>مترجم من تقييمات Google</small></figcaption></figure><figure class="rev"><span class="stars" aria-hidden="true">★★★★★</span><blockquote><p>«قاعة أفراح كبيرة جداً بصالة طعام ومواقف واسعة.»</p></blockquote><figcaption><b>قصر الماسة</b><small>مترجم من تقييمات Google</small></figcaption></figure><figure class="rev"><span class="stars" aria-hidden="true">★★★★★</span><blockquote><p>«مكان نظيف وجميل، وليلة رائعة.»</p></blockquote><figcaption><b>قصر مودة</b><small>مترجم من تقييمات Google</small></figcaption></figure><figure class="rev"><span class="stars" aria-hidden="true">★★★★★</span><blockquote><p>«مكان رائع ومنظّم، وإدارة ممتازة ومناسب للمناسبات الكبيرة.»</p></blockquote><figcaption><b>قصر ليالي الديار</b><small>مترجم من تقييمات Google</small></figcaption></figure><figure class="rev"><span class="stars" aria-hidden="true">★★★★★</span><blockquote><p>«مكان جميل للاجتماعات والأفراح والحفلات.»</p></blockquote><figcaption><b>قصر هيلون بالاس</b><small>مترجم من تقييمات Google</small></figcaption></figure><figure class="rev"><span class="stars" aria-hidden="true">★★★★★</span><blockquote><p>«سعدت بحضور زواج صديق هناك، تنظيم وخدمة تستحق التقدير.»</p></blockquote><figcaption><b>قصر روعة الملتقى</b><small>مترجم من تقييمات Google</small></figcaption></figure>
      </div>
      <div class="car-ctl"><button type="button" class="car-btn" data-dir="1" aria-label="التالي"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></button><button type="button" class="car-btn flip" data-dir="-1" aria-label="السابق"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></button></div>
    </div>
    <p class="note reveal">إجمالي تقييمات قصورنا على Google: <b>8,289</b> تقييم بمتوسط <b>4.3</b> من 5.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="head reveal"><h2>من مناسباتنا</h2></div>
    <div class="strip reveal">
      <img class="leaf" src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/hero.jpg" alt="قصر روعة الملتقى ليلاً" loading="lazy">
      <img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hall.jpg" alt="قاعة أفراح مزينة" loading="lazy">
      <img class="leaf" src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hospitality.jpg" alt="ضيافة الحلويات" loading="lazy">
      <img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-main.jpg" alt="استقبال الضيوف" loading="lazy">
    </div>
    <p class="center"><a class="btn btn-line" href="<?php echo esc_url( zv_url( 'projects' ) ); ?>">كل الصور</a></p>
  </div>
</section>
<?php
get_footer();
