<?php
/**
 * Template Name: تواصل معنا
 *
 * @package zawaya
 */

$zw_sent = isset( $_GET['zw_sent'] ); // phpcs:ignore WordPress.Security.NonceVerification
$zw_err  = isset( $_GET['zw_err'] ) ? sanitize_key( $_GET['zw_err'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$zw_errs = array(
	'fields'  => 'الرجاء كتابة الاسم ورقم الجوال أو البريد الإلكتروني.',
	'expired' => 'انتهت صلاحية الصفحة، حدّثها ثم أعد الإرسال.',
	'limit'   => 'أرسلت عدة رسائل خلال وقت قصير، حاول بعد قليل أو تواصل معنا هاتفياً.',
);

get_header();
?>
<section class="phead">
  <div class="wrap phead-in">
    <div class="phead-copy">
      <nav class="crumbs" aria-label="مسار التنقل"><a href="<?php echo esc_url( zv_url( 'home' ) ); ?>">الرئيسية</a><span aria-hidden="true">/</span><span>تواصل معنا</span></nav>
      <h1>تواصل معنا</h1>
      <hr class="dash">
      <p>احجز زيارة للقصر، أو اطلب عرض ضيافة وتجهيزات، وسيعود إليك فريقنا خلال يوم عمل.</p>
    </div>
    <figure class="phead-photo leaf"><img src="<?php echo esc_url( ZAWAYA_URI ); ?>/assets/img/about-main.jpg" alt=""></figure>
  </div>
</section>
<section class="sec pearl">
  <div class="wrap contact-grid">
    <div class="form-card">
      <h2>نموذج الحجز والاستفسار</h2>
      <p>الحقول المعلّمة بـ * مطلوبة.</p>
      <div class="ok" id="form-ok" role="status"<?php echo $zw_sent ? '' : ' hidden'; ?>><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg><span>وصلنا طلبك، شكراً لتواصلك. سيتواصل معك فريقنا في أقرب وقت.</span></div>
      <?php if ( $zw_err && isset( $zw_errs[ $zw_err ] ) ) : ?><div class="formerr" role="alert"><?php echo esc_html( $zw_errs[ $zw_err ] ); ?></div><?php endif; ?>
      <span id="contact-form"></span>
      <form id="booking" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
        <input type="hidden" name="action" value="zw_contact">
        <?php wp_nonce_field( 'zw_contact', 'zw_contact_nonce' ); ?>
        <div aria-hidden="true" style="position:absolute;inset-inline-start:-9999px"><label>الموقع<input type="text" name="zw_website" tabindex="-1" autocomplete="off"></label></div>
        <div class="fgrid">
          <div class="field"><label for="f-name">الاسم الكامل *</label><input id="f-name" name="zw_name" autocomplete="name" data-req><span class="err" hidden></span></div>
          <div class="field"><label for="f-phone">رقم الجوال *</label><input id="f-phone" name="zw_phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="05xxxxxxxx" data-req><span class="err" hidden></span></div>
          <div class="field full"><span class="lbl">نوع الطلب</span>
            <div class="chips" role="radiogroup" aria-label="نوع الطلب">
              <label class="chip"><input type="radio" name="zw_kind" value="زفاف" checked><span>حفل زفاف</span></label>
              <label class="chip"><input type="radio" name="zw_kind" value="مناسبة"><span>مناسبة عائلية</span></label>
              <label class="chip"><input type="radio" name="zw_kind" value="مؤتمر"><span>مؤتمر أو فعالية</span></label>
              <label class="chip"><input type="radio" name="zw_kind" value="ضيافة"><span>ضيافة وبوفيه فقط</span></label>
            </div>
          </div>
          <div class="field"><label for="f-venue">القصر المفضّل</label>
            <select id="f-venue" name="zw_venue"><option>لم أحدد بعد</option><option>قصر الماسة</option><option>قصر روعة الملتقى</option><option>قصر مودة</option><option>قصر ليالي الديار</option><option>قصر هيلون بالاس</option></select></div>
          <div class="field"><label for="f-date">التاريخ المتوقع *</label><input id="f-date" name="zw_date" type="date" data-req><span class="err" hidden></span></div>
          <div class="field"><label for="f-guests">عدد الضيوف التقريبي</label><input id="f-guests" name="zw_guests" type="number" min="20" step="10" inputmode="numeric" placeholder="مثال: 300"></div>
          <div class="field full"><label for="f-msg">تفاصيل إضافية</label><textarea id="f-msg" name="zw_message" placeholder="الخدمات المطلوبة: ضيافة، جوبو، Touchpix…"></textarea></div>
        </div>
        <div class="form-foot"><button class="btn btn-navy" type="submit">إرسال الطلب <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg></button><small>نرد عادةً خلال يوم عمل.</small></div>
      </form>
    </div>
    <aside class="side">
      <div class="info"><span class="ico"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.59,160.3l-47.24-21.17a14,14,0,0,0-13.28,1.22,4.81,4.81,0,0,0-.56.42l-24.69,21a1.88,1.88,0,0,1-1.68.06c-15.87-7.66-32.31-24-40-39.65a1.91,1.91,0,0,1,0-1.68l21.07-25a6.13,6.13,0,0,0,.42-.58,14,14,0,0,0,1.12-13.27L95.73,34.49a14,14,0,0,0-14.56-8.38A54.24,54.24,0,0,0,34,80c0,78.3,63.7,142,142,142a54.25,54.25,0,0,0,53.89-47.17A14,14,0,0,0,221.59,160.3ZM176,210C104.32,210,46,151.68,46,80A42.23,42.23,0,0,1,82.67,38h.23a2,2,0,0,1,1.84,1.31l21.1,47.11a2,2,0,0,1,0,1.67L84.73,113.15a4.73,4.73,0,0,0-.43.57,14,14,0,0,0-.91,13.73c8.87,18.16,27.17,36.32,45.53,45.19a14,14,0,0,0,13.77-1c.19-.13.38-.27.56-.42l24.68-21a1.92,1.92,0,0,1,1.6-.1l47.25,21.17a2,2,0,0,1,1.21,2A42.24,42.24,0,0,1,176,210Z"/></svg></span><div><b>الهاتف</b><a class="ltr" href="tel:0570001853">0570001853</a><button class="copy" type="button" data-copy="0570001853">نسخ</button></div></div>
      <div class="info"><span class="ico"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M186.68,146.63l-32-16a6,6,0,0,0-6,.38L133,141.46A42.49,42.49,0,0,1,114.54,123L125,107.33a6,6,0,0,0,.38-6l-16-32A6,6,0,0,0,104,66a38,38,0,0,0-38,38,86.1,86.1,0,0,0,86,86,38,38,0,0,0,38-38A6,6,0,0,0,186.68,146.63ZM152,178a74.09,74.09,0,0,1-74-74,26,26,0,0,1,22.42-25.75l12.66,25.32-10.39,15.58a6,6,0,0,0-.54,5.63,54.43,54.43,0,0,0,29.07,29.07,6,6,0,0,0,5.63-.54l15.58-10.39,25.32,12.66A26,26,0,0,1,152,178ZM128,26A102,102,0,0,0,38.35,176.69L26.73,211.56a14,14,0,0,0,17.71,17.71l34.87-11.62A102,102,0,1,0,128,26Zm0,192a90,90,0,0,1-45.06-12.08,6.09,6.09,0,0,0-3-.81,6.2,6.2,0,0,0-1.9.31L40.65,217.88a2,2,0,0,1-2.53-2.53L50.58,178a6,6,0,0,0-.5-4.91A90,90,0,1,1,128,218Z"/></svg></span><div><b>واتساب</b><a href="https://api.whatsapp.com/send/?phone=966570001853" target="_blank" rel="noopener">رد سريع على استفساراتكم</a></div></div>
      <div class="info"><span class="ico"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M224,50H32a6,6,0,0,0-6,6V192a14,14,0,0,0,14,14H216a14,14,0,0,0,14-14V56A6,6,0,0,0,224,50ZM208.58,62,128,135.86,47.42,62ZM216,194H40a2,2,0,0,1-2-2V69.64l86,78.78a6,6,0,0,0,8.1,0L218,69.64V192A2,2,0,0,1,216,194Z"/></svg></span><div><b>البريد</b><a href="mailto:info@zawayaalmaali.com">info@zawayaalmaali.com</a><button class="copy" type="button" data-copy="info@zawayaalmaali.com">نسخ</button></div></div>
      <a class="info" href="https://maps.app.goo.gl/ojz2gjjTVpB4kJrt7" target="_blank" rel="noopener"><span class="ico"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M128,66a38,38,0,1,0,38,38A38,38,0,0,0,128,66Zm0,64a26,26,0,1,1,26-26A26,26,0,0,1,128,130Zm0-112a86.1,86.1,0,0,0-86,86c0,30.91,14.34,63.74,41.47,94.94a252.32,252.32,0,0,0,41.09,38,6,6,0,0,0,6.88,0,252.32,252.32,0,0,0,41.09-38c27.13-31.2,41.47-64,41.47-94.94A86.1,86.1,0,0,0,128,18Zm0,206.51C113,212.93,54,163.62,54,104a74,74,0,0,1,148,0C202,163.62,143,212.93,128,224.51Z"/></svg></span><div><b>المقر الرئيسي</b><span>الرياض، حي نمار، طريق ديراب</span><span class="more">افتح في خرائط Google</span></div></a>
    </aside>
  </div>
</section>
<?php
get_footer();
