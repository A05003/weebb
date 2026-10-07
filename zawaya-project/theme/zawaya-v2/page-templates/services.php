<?php
/**
 * Template Name: خدماتنا
 *
 * @package zawaya
 */

get_header();
?>
<section class="phead">
  <div class="wrap phead-in">
    <div class="phead-copy">
      <nav class="crumbs" aria-label="مسار التنقل"><a href="<?php echo esc_url( zv_url( 'home' ) ); ?>">الرئيسية</a><span aria-hidden="true">/</span><span>خدماتنا</span></nav>
      <h1>خدماتنا</h1>
      <hr class="dash">
      <p>ثلاث خدمات تكمل بعضها: القاعة والتنسيق، الضيافة، والعروض التقنية.</p>
    </div>
    <figure class="phead-photo leaf"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hospitality.jpg" alt=""></figure>
  </div>
</section>
<section class="sec">
  <div class="wrap">
    <div class="tabs" role="tablist" aria-label="أقسام الخدمات">
      <button class="tab" role="tab" id="t-halls" data-hash="halls" aria-controls="halls" aria-selected="true" type="button">القاعات وتنسيق الزفاف</button>
      <button class="tab" role="tab" id="t-catering" data-hash="catering" aria-controls="catering" aria-selected="false" tabindex="-1" type="button">الضيافة والبوفيه</button>
      <button class="tab" role="tab" id="t-tech" data-hash="tech" aria-controls="tech" aria-selected="false" tabindex="-1" type="button">العروض التقنية</button>
    </div>

    <div class="panel" role="tabpanel" id="halls" aria-labelledby="t-halls">
      <div class="svc-detail">
        <figure class="leaf"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hall.jpg" alt="قاعة أفراح جاهزة للزفاف"></figure>
        <div>
          <h2>إدارة القاعات وتنسيق حفلات الزفاف</h2>
          <p class="lead">نشغّل خمسة قصور في الرياض بقسمين منفصلين للرجال والنساء، ونتولى تنسيق الحفل من الاستقبال حتى الزفة.</p>
          <ul class="checks"><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>قاعات للرجال والنساء بسعات تصل إلى 450 ضيفاً</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>درج للزفة وممر للعروس ومنصة كوشة</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>غرفة تجهيز خاصة للعروس</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>استقبال وتنظيم ومواقف وحراسة</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>تنسيق الزهور والطاولات والإضاءة</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>إدارة الحفل يوم المناسبة</span></li></ul>
          <a class="btn btn-navy" href="<?php echo esc_url( zv_url( 'contact' ) ); ?>">احجز زيارة للقصر</a>
        </div>
      </div>
      <div class="feature-row">
        <div class="feature"><b>قصر الماسة</b><span>350-400 ضيف لكل قسم، وحديقة خارجية</span></div><div class="feature"><b>قصر روعة الملتقى</b><span>حتى 400 ضيفة، وصالة طعام لـ 450</span></div><div class="feature"><b>قصر مودة</b><span>حتى 450 ضيفة، ودرج زفة وممر رخامي</span></div><div class="feature"><b>قصر ليالي الديار</b><span>قاعة بلا أعمدة، وأكثر من حفل في الوقت نفسه</span></div><div class="feature"><b>قصر هيلون بالاس</b><span>قاعة بلا أعمدة، وأكثر من حفل في الوقت نفسه</span></div>
      </div>
    </div>

    <div class="panel" role="tabpanel" id="catering" aria-labelledby="t-catering" hidden>
      <div class="svc-detail">
        <figure class="leaf"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-hospitality.jpg" alt="ضيافة حلويات فاخرة"></figure>
        <div>
          <h2>مطاعم زوايا المعالي: بوفيهات وضيافة فاخرة</h2>
          <p class="lead">ذراع الضيافة في المجموعة. طهاة ذوو خبرة وقوائم تجمع المطبخ السعودي والعربي والعالمي، داخل قصورنا وخارجها.</p>
          <ul class="checks"><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>بوفيه مفتوح بقوائم حسب الطلب</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>طبخ داخلي للذبائح</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>قهوجية وصبابين لخدمة الضيوف</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>محطات حلويات ومشروبات ساخنة وباردة</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>بوفيه نسائي متكامل</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>تجهيز أماكن التقديم وطاقم مدرّب</span></li></ul>
          <a class="btn btn-navy" href="<?php echo esc_url( zv_url( 'contact' ) ); ?>">اطلب عرض ضيافة</a> <a class="btn btn-line" href="https://almaalicatering.com" target="_blank" rel="noopener">موقع المطعم</a>
        </div>
      </div>
    </div>

    <div class="panel" role="tabpanel" id="tech" aria-labelledby="t-tech" hidden>
      <div class="svc-detail">
        <figure class="leaf"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-main.jpg" alt="تجهيزات مناسبة بإضاءة وشاشات"></figure>
        <div>
          <h2>صوتيات، إضاءة، جوبو، وكشك تصوير Touchpix</h2>
          <p class="lead">فريق تقني يجهّز الصوت والإضاءة والمؤثرات، ويضيف لمسات تبقى في ذاكرة الضيوف وصورهم.</p>
          <ul class="checks"><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>أنظمة صوت ودي جي للقاعات</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>إضاءة مسرحية وليزر وبخار</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>إسقاط جوبو بأسماء العروسين أو شعار الجهة</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>كشك تصوير Touchpix بطباعة فورية</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>شاشات عرض وبث للمؤتمرات</span></li><li><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>فني مرافق طوال المناسبة</span></li></ul>
          <a class="btn btn-navy" href="<?php echo esc_url( zv_url( 'contact' ) ); ?>">اطلب التجهيزات التقنية</a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
get_footer();
