# Builds the 5 preview pages from shared header/footer.
import pathlib
OUT = pathlib.Path(__file__).resolve().parent.parent / 'site'

I = {
 'arrow': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5M11 18l-6-6 6-6"/></svg>',
 'menu': '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>',
 'rings': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="14" r="6"/><circle cx="15" cy="14" r="6"/><path d="M10 4l2-2 2 2-2 2z"/></svg>',
 'calendar': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M8 14h3v3H8z"/></svg>',
 'dish': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 17h18M5 17a7 7 0 0 1 14 0M12 8V6M10 6h4M2 20h20"/></svg>',
 'light': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v3M5.6 5.6l2.1 2.1M18.4 5.6l-2.1 2.1M3 12h3M18 12h3"/><path d="M8 21h8M9 17h6l1-3a5 5 0 1 0-8 0z"/></svg>',
 'camera': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 8h3l2-3h6l2 3h3a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/><circle cx="12" cy="13.5" r="3.5"/></svg>',
 'phone': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></svg>',
 'mail': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>',
 'pin': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
 'clock': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>',
 'wa': '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm5.3 14.1c-.2.6-1.3 1.2-1.8 1.2-.5.1-1 .1-3.3-.8-2.8-1.1-4.6-4-4.7-4.2-.1-.2-1.1-1.5-1.1-2.9 0-1.4.7-2 1-2.3.2-.3.5-.3.7-.3h.5c.2 0 .4 0 .6.5l.8 2c.1.2.1.4 0 .5l-.4.6-.4.4c-.1.1-.3.3-.1.6.2.3.8 1.3 1.7 2.1 1.2 1 2.1 1.3 2.4 1.5.3.1.5.1.6-.1l.9-1c.2-.3.4-.2.6-.1l1.9.9c.3.1.4.2.5.3.1.2.1.7-.1 1.1z"/></svg>',
 'check': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M8 12.5l2.5 2.5L16 9.5"/></svg>',
 'quote': '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M10 7H6a3 3 0 0 0-3 3v4h4v4l4-4v-7zM21 7h-4a3 3 0 0 0-3 3v4h4v4l4-4v-7z"/></svg>',
 'x': '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>',
 'ig': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg>',
 'xlogo': '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.2 2h3.3l-7.2 8.3L23 22h-6.6l-5.2-6.8L5.2 22H1.9l7.7-8.8L1.4 2h6.8l4.7 6.2zm-1.2 18h1.8L7.1 3.9H5.2z"/></svg>',
 'snap': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" aria-hidden="true"><path d="M12 3c3 0 5 2.2 5 5v3l2 .6-1.6 1.6 2.6 1.8c-1.4.8-3 .8-3.6 1.4-.4.5-.2 1.6-1.4 1.6-1 0-1.6-.6-3-.6s-2 .6-3 .6c-1.2 0-1-1.1-1.4-1.6-.6-.6-2.2-.6-3.6-1.4l2.6-1.8L5 11.6 7 11V8c0-2.8 2-5 5-5z"/></svg>',
 'tiktok': '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.6 3c.4 2.3 1.8 3.8 4.1 4v3.1c-1.5 0-2.9-.4-4.1-1.2v6.3a6 6 0 1 1-6-6c.3 0 .6 0 .9.1v3.2a2.9 2.9 0 1 0 2 2.7V3z"/></svg>',
 'gem': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" aria-hidden="true"><path d="M6 3h12l4 6-10 12L2 9z"/><path d="M2 9h20M9 3l3 18M15 3l-3 18"/></svg>',
 'shield': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="M9 12l2 2 4-4"/></svg>',
 'users': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20a6.5 6.5 0 0 1 13 0M16 4.5a3.5 3.5 0 0 1 0 7M18 14a6 6 0 0 1 3.5 6"/></svg>',
 'eye': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>',
 'spark': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l2.2 6.8L21 12l-6.8 2.2L12 21l-2.2-6.8L3 12l6.8-2.2z"/></svg>',
 'clockv': '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>',
}

NAV = [('index.html', 'الرئيسية'), ('about.html', 'من نحن'), ('services.html', 'خدماتنا'), ('portfolio.html', 'معرض الأعمال'), ('contact.html', 'تواصل معنا')]
PHONE = '0570001853'
EMAIL = 'info@zawayaalmaali.com'
ADDR = 'الرياض، حي نمار، طريق ديراب'
MAPS = 'https://maps.app.goo.gl/ojz2gjjTVpB4kJrt7'
WA = 'https://api.whatsapp.com/send/?phone=966570001853'
GMAP = 'https://www.google.com/maps/search/?api=1&query={q}&query_place_id={pid}'

# logo, name, district, capacity, google rating, review count, place_id
VENUES = [
 ('lg-almasa.png', 'قصر الماسة', 'حي الجنادرية', '350–400 ضيف لكل قسم، وحديقة خارجية', '4.4', '1,168', 'ChIJFxXQuahVLj4RgLuvd6L65zg'),
 ('lg-multaqa.png', 'قصر روعة الملتقى', 'حي المعيزيلة', 'حتى 400 ضيفة، وصالة طعام لـ 450', '4.2', '2,058', 'ChIJz4SgnpCqLz4RfZI4qZWblVg'),
 ('lg-mawadda.png', 'قصر مودة', 'ظهرة نمار', 'حتى 450 ضيفة، ودرج زفة وممر رخامي', '4.1', '2,284', 'ChIJAeKfYLEQLz4R-v-M_03KlTo'),
 ('lg-diyar.png', 'قصر ليالي الديار', 'حي الحزم', 'قاعة بلا أعمدة، وأكثر من حفل في الوقت نفسه', '4.4', '1,347', 'ChIJr0Da5okRLz4RU4TXX8BSoDk'),
 ('lg-helon.png', 'قصر هيلون بالاس', 'حي الشفاء', 'قاعة بلا أعمدة، وأكثر من حفل في الوقت نفسه', '4.3', '1,432', 'ChIJUevfTG8OLz4RV881J2weL3c'),
]
def vlink(v): return GMAP.format(q=v[1].replace(' ', '+'), pid=v[6])

# Positive excerpts from Google reviews (Places API), translated. Labelled as such on the page.
REVIEWS = [
 ('قصر ليالي الديار', 'خدمة ممتازة ومواقف واسعة، والطاقم محترف جداً وما عندي أي ملاحظة.'),
 ('قصر روعة الملتقى', 'خدمة رائعة وقيمة مقابل السعر، وكانت تجربتي في زواج صديق خمس نجوم.'),
 ('قصر الماسة', 'قاعة أفراح كبيرة جداً بصالة طعام ومواقف واسعة.'),
 ('قصر مودة', 'مكان نظيف وجميل، وليلة رائعة.'),
 ('قصر ليالي الديار', 'مكان رائع ومنظّم، وإدارة ممتازة ومناسب للمناسبات الكبيرة.'),
 ('قصر هيلون بالاس', 'مكان جميل للاجتماعات والأفراح والحفلات.'),
 ('قصر روعة الملتقى', 'سعدت بحضور زواج صديق هناك، تنظيم وخدمة تستحق التقدير.'),
]

def header(cur):
    half = len(NAV) // 2 + 1
    def lk(items): return ''.join(f'<a href="{h}"{" aria-current=\"page\"" if h == cur else ""}>{t}</a>' for h, t in items)
    allk = lk(NAV)
    return f'''<a class="sr" href="#main">تخطَّ إلى المحتوى</a>
<div class="topbar"><div class="wrap topbar-in">
  <a href="tel:{PHONE}" class="ltr">{I["phone"]}{PHONE}</a>
  <a href="{WA}" target="_blank" rel="noopener">{I["wa"]}واتساب</a>
  <a href="{MAPS}" target="_blank" rel="noopener" class="tb-loc">{I["pin"]}{ADDR}</a>
</div></div>
<header class="hdr">
  <div class="wrap hdr-in">
    <nav class="nav nav-r" aria-label="القائمة الرئيسية">{lk(NAV[:half])}</nav>
    <a class="brand" href="index.html" aria-label="زوايا المعالي — الرئيسية"><img src="assets/img/logo-v.png" alt="زوايا المعالي" width="150" height="63"></a>
    <nav class="nav nav-l" aria-label="القائمة الرئيسية (تابع)">{lk(NAV[half:])}<a class="btn btn-gold btn-sm" href="contact.html">احجز</a></nav>
    <button class="burger" type="button" aria-expanded="false" aria-controls="mnav" aria-label="فتح القائمة">{I["menu"]}</button>
  </div>
</header>
<nav class="mnav" id="mnav" aria-label="قائمة الجوال" hidden>
  <button class="mnav-x" type="button" aria-label="إغلاق القائمة">{I["x"]}</button>
  <img src="assets/img/logo-v.png" alt="" width="150" height="63">
  {allk}
  <a class="btn btn-gold" href="contact.html">احجز مناسبتك</a>
</nav>'''

FOOTER = f'''<section class="bookband" aria-label="احجز الآن">
  <div class="wrap bookband-in">
    <div><span>احجز موعد زيارة القصر</span><a class="bigphone ltr" href="tel:{PHONE}">{PHONE}</a></div>
    <a class="btn btn-navy" href="{WA}" target="_blank" rel="noopener">{I["wa"]} راسلنا واتساب</a>
  </div>
</section>
<footer class="ftr">
  <div class="wrap ftr-grid">
    <div class="ftr-brand">
      <img src="assets/img/logo-v.png" alt="زوايا المعالي" width="150" height="63">
      <p>شركة سعودية لإدارة قصور الأفراح وتنسيق المناسبات والضيافة الراقية في الرياض.</p>
      <div class="socials"><a class="soc" href="#" aria-label="إنستغرام (أضف الرابط)">{I["ig"]}</a><a class="soc" href="#" aria-label="سناب شات (أضف الرابط)">{I["snap"]}</a><a class="soc" href="#" aria-label="تيك توك (أضف الرابط)">{I["tiktok"]}</a><a class="soc" href="{WA}" target="_blank" rel="noopener" aria-label="واتساب">{I["wa"]}</a></div>
    </div>
    <div><h4>قصورنا الخمسة</h4><ul>{''.join(f'<li><a href="{vlink(v)}" target="_blank" rel="noopener">{v[1]}</a></li>' for v in VENUES)}</ul></div>
    <div><h4>خدماتنا</h4><ul>
      <li><a href="services.html#halls">القاعات وتنسيق الزفاف</a></li>
      <li><a href="services.html#catering">الضيافة والبوفيه</a></li>
      <li><a href="services.html#tech">العروض التقنية</a></li>
      <li><a href="portfolio.html">معرض الأعمال</a></li>
    </ul></div>
    <div><h4>تواصل</h4><ul>
      <li><a class="ltr" href="tel:{PHONE}">{PHONE}</a></li>
      <li><a href="mailto:{EMAIL}">{EMAIL}</a></li>
      <li><a href="{MAPS}" target="_blank" rel="noopener">{ADDR}</a></li>
    </ul></div>
  </div>
  <div class="wrap copy"><span>© <span id="year">2026</span> شركة زوايا المعالي للأفراح والمناسبات. جميع الحقوق محفوظة.</span></div>
</footer>
<a class="wa" href="{WA}" target="_blank" rel="noopener" aria-label="تواصل عبر واتساب">{I["wa"]}</a>
<script src="assets/site.js"></script>'''

FONTS = '<link rel="preconnect" href="https://fonts.googleapis.com">\n<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>\n<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap">\n<link rel="stylesheet" href="assets/site.css">'

def page(fname, title, body, entry=False):
    if entry:  # the artifact entry page: the host adds doctype/html/head/body
        html = f'<meta charset="utf-8">\n<title>{title}</title>\n{FONTS}\n<script>document.documentElement.lang="ar";document.documentElement.dir="rtl";</script>\n{header(fname)}\n<main id="main">\n{body}\n</main>\n{FOOTER}\n'
    else:
        html = f'<!doctype html>\n<html lang="ar" dir="rtl">\n<head>\n<meta charset="utf-8">\n<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">\n<title>{title}</title>\n{FONTS}\n</head>\n<body>\n{header(fname)}\n<main id="main">\n{body}\n</main>\n{FOOTER}\n</body>\n</html>\n'
    (OUT / fname).write_text(html, encoding='utf-8')

def pagehead(title, sub, img, crumb):
    return f'''<section class="phead">
  <div class="wrap phead-in">
    <div class="phead-copy">
      <nav class="crumbs" aria-label="مسار التنقل"><a href="index.html">الرئيسية</a><span aria-hidden="true">/</span><span>{crumb}</span></nav>
      <h1>{title}</h1>
      <hr class="dash">
      <p>{sub}</p>
    </div>
    <figure class="phead-photo leaf"><img src="assets/img/{img}" alt=""></figure>
  </div>
</section>'''

def stars(r):
    return f'<span class="stars" role="img" aria-label="تقييم {r} من 5">★★★★★</span>'

# ---------------- HOME ----------------
slides = ['hero.jpg', 'about-main.jpg', 'about-hall.jpg', 'about-hospitality.jpg']
home = f'''<section class="hero">
  <div class="slides" aria-hidden="true">{''.join(f'<img class="slide{" on" if i == 0 else ""}" src="assets/img/{s}" alt="">' for i, s in enumerate(slides))}</div>
  <div class="wrap hero-in">
    <h1>زوايا المعالي<br><em>خمسة قصور، وتفاصيل تُروى</em></h1>
    <hr class="dash">
    <p>نُدير قصور الأفراح في الرياض، وننسّق الزفاف والضيافة والتقنية بفريق واحد من الحجز حتى آخر ضيف.</p>
    <div class="hero-ctas">
      <a class="btn btn-gold" href="contact.html">احجز مناسبتك {I["arrow"]}</a>
      <a class="btn btn-ghost" href="portfolio.html">شاهد قصورنا</a>
    </div>
  </div>
  <div class="hero-logos"><div class="wrap">{''.join(f'<a href="{vlink(v)}" target="_blank" rel="noopener" aria-label="{v[1]}"><img src="assets/img/{v[0]}" alt="{v[1]}"></a>' for v in VENUES)}</div></div>
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
      <a class="btn btn-line" href="about.html">تعرّف علينا</a>
    </div>
    <figure class="a-photo leaf reveal"><img src="assets/img/about-main.jpg" alt="استقبال الضيوف في إحدى مناسبات زوايا المعالي" loading="lazy"></figure>
    <div class="a-vm reveal">
      <article><h3>رؤيتنا</h3><p>أن نكون الوجهة الأولى في إدارة وتشغيل قصور الأفراح وصناعة المناسبات في المملكة.</p></article>
      <hr class="dash">
      <article><h3>رسالتنا</h3><p>خدمات مبتكرة بأعلى معايير الجودة، وتجارب تعكس الإبداع والأصالة.</p></article>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="head reveal"><span class="eyebrow">خدماتنا</span><h2>كل ما تحتاجه مناسبتك</h2></div>
    <div class="svc3">
      <a class="svc reveal" href="services.html#halls"><img src="assets/img/about-hall.jpg" alt="" loading="lazy"><div><h3>القاعات وتنسيق الزفاف</h3><p>الكوشة والزفة وغرفة التجهيز بتنسيق يناسب ذوقكم.</p><span class="more">التفاصيل {I["arrow"]}</span></div></a>
      <a class="svc reveal" href="services.html#catering"><img src="assets/img/about-hospitality.jpg" alt="" loading="lazy"><div><h3>الضيافة والبوفيه</h3><p>مطاعم زوايا المعالي: بوفيهات وقهوجية وحلويات.</p><span class="more">التفاصيل {I["arrow"]}</span></div></a>
      <a class="svc reveal" href="services.html#tech"><img src="assets/img/hero.jpg" alt="" loading="lazy"><div><h3>العروض التقنية</h3><p>صوتيات وإضاءة وجوبو وكشك Touchpix للضيوف.</p><span class="more">التفاصيل {I["arrow"]}</span></div></a>
    </div>
  </div>
</section>

<section class="sec navy" id="venues">
  <div class="wrap">
    <div class="head reveal"><span class="eyebrow">قصورنا</span><h2>خمسة قصور نُديرها في الرياض</h2></div>
    <div class="venues">
      {''.join(f'<article class="venue reveal"><span class="logo"><img src="assets/img/{v[0]}" alt="شعار {v[1]}"></span><h3>{v[1]}</h3><span class="dist">{v[2]}، الرياض</span><p>{v[3]}</p><div class="rate">{stars(v[4])}<b>{v[4]}</b><small>{v[5]} تقييم في Google</small></div><a class="more" href="{vlink(v)}" target="_blank" rel="noopener">الموقع على الخريطة {I["arrow"]}</a></article>' for v in VENUES)}
    </div>
  </div>
</section>

<section class="sec pearl">
  <div class="wrap">
    <div class="head reveal"><span class="eyebrow">آراء ضيوفنا</span><h2>ماذا قال ضيوفنا في قصورنا</h2><p class="lead">مقتطفات إيجابية من تقييمات Google للقصور الخمسة (مترجمة).</p></div>
    <div class="carousel" data-carousel>
      <div class="car-track">
        {''.join(f'<figure class="rev"><span class="stars" aria-hidden="true">★★★★★</span><blockquote><p>«{t}»</p></blockquote><figcaption><b>{n}</b><small>مترجم من تقييمات Google</small></figcaption></figure>' for n, t in REVIEWS)}
      </div>
      <div class="car-ctl"><button type="button" class="car-btn" data-dir="1" aria-label="التالي">{I["arrow"]}</button><button type="button" class="car-btn flip" data-dir="-1" aria-label="السابق">{I["arrow"]}</button></div>
    </div>
    <p class="note reveal">إجمالي تقييمات قصورنا على Google: <b>8,289</b> تقييم بمتوسط <b>4.3</b> من 5.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="head reveal"><span class="eyebrow">لقطات</span><h2>من مناسباتنا</h2></div>
    <div class="strip reveal">
      <img class="leaf" src="assets/img/hero.jpg" alt="قصر روعة الملتقى ليلاً" loading="lazy">
      <img src="assets/img/about-hall.jpg" alt="قاعة أفراح مزينة" loading="lazy">
      <img class="leaf" src="assets/img/about-hospitality.jpg" alt="ضيافة الحلويات" loading="lazy">
      <img src="assets/img/about-main.jpg" alt="استقبال الضيوف" loading="lazy">
    </div>
    <p class="center"><a class="btn btn-line" href="portfolio.html">كل الصور</a></p>
  </div>
</section>'''
page('index.html', 'زوايا المعالي', home, entry=True)

# ---------------- ABOUT ----------------
about = pagehead('من نحن', 'شركة عائلية سعودية تدير قصور الأفراح وتصنع المناسبات وتقدّم الضيافة الراقية في الرياض.', 'about-hall.jpg', 'من نحن') + f'''
<section class="sec">
  <div class="wrap split">
    <div class="reveal">
      <span class="eyebrow">قصتنا</span>
      <h2>من قاعة واحدة إلى مجموعة متكاملة للمناسبات</h2>
      <p>تأسست شركة زوايا المعالي للأفراح والمناسبات لتكون البوابة الأولى في إدارة وتشغيل قصور الأفراح وصناعة الفعاليات، وخدمات الديكور والتنسيقات الخاصة بها.</p>
      <p>تضم المجموعة خمسة قصور للأفراح والمؤتمرات في الرياض، ومطاعم زوايا المعالي المتخصصة في البوفيهات المفتوحة والإعاشة، وشركة منار التعمير للمقاولات التي تجهّز القاعات وتطوّرها.</p>
      <p>نلبّي احتياجات عملائنا بالجودة والاهتمام بأدق التفاصيل من الفكرة حتى التنفيذ.</p>
    </div>
    <figure class="leaf reveal" style="margin:0"><img src="assets/img/about-hospitality.jpg" alt="ضيافة الحلويات" loading="lazy"></figure>
  </div>
</section>

<section class="sec pearl">
  <div class="wrap mv">
    <article class="reveal"><h3>رؤيتنا</h3><hr class="dash"><p>أن نكون الوجهة الأولى في إدارة وتشغيل قصور الأفراح وصناعة المناسبات والفعاليات في المملكة العربية السعودية.</p></article>
    <article class="reveal"><h3>رسالتنا</h3><hr class="dash"><p>تقديم خدمات مبتكرة بأعلى معايير الجودة، وخلق تجارب فريدة تعكس روح الإبداع والأصالة، مع تعزيز الشراكات وتحقيق النمو المستدام.</p></article>
  </div>
</section>

<section class="sec navy">
  <div class="wrap">
    <div class="head reveal"><span class="eyebrow">القيادة</span><h2>فريق يقود كل مناسبة بنفسه</h2></div>
    <div class="team">
      <article class="reveal"><span class="mono">ع</span><h3>عبدالله علي صالح الفقيه</h3><small>المدير التنفيذي</small></article>
      <article class="reveal"><span class="mono">ص</span><h3>صالح مطيع الفقيه</h3><small>المدير العام</small></article>
      <article class="reveal"><span class="mono">ب</span><h3>بدر الفقيه</h3><small>نائب المدير التنفيذي</small></article>
    </div>
  </div>
</section>'''
page('about.html', 'من نحن — زوايا المعالي', about)

# ---------------- SERVICES ----------------
def checks(items):
    return '<ul class="checks">' + ''.join(f'<li>{I["check"]}<span>{x}</span></li>' for x in items) + '</ul>'

services = pagehead('خدماتنا', 'ثلاث خدمات تكمل بعضها: القاعة والتنسيق، الضيافة، والعروض التقنية.', 'about-hospitality.jpg', 'خدماتنا') + f'''
<section class="sec">
  <div class="wrap">
    <div class="tabs" role="tablist" aria-label="أقسام الخدمات">
      <button class="tab" role="tab" id="t-halls" data-hash="halls" aria-controls="halls" aria-selected="true" type="button">القاعات وتنسيق الزفاف</button>
      <button class="tab" role="tab" id="t-catering" data-hash="catering" aria-controls="catering" aria-selected="false" tabindex="-1" type="button">الضيافة والبوفيه</button>
      <button class="tab" role="tab" id="t-tech" data-hash="tech" aria-controls="tech" aria-selected="false" tabindex="-1" type="button">العروض التقنية</button>
    </div>

    <div class="panel" role="tabpanel" id="halls" aria-labelledby="t-halls">
      <div class="svc-detail">
        <figure class="leaf"><img src="assets/img/about-hall.jpg" alt="قاعة أفراح جاهزة للزفاف"></figure>
        <div>
          <h2>إدارة القاعات وتنسيق حفلات الزفاف</h2>
          <p class="lead">نشغّل خمسة قصور في الرياض بقسمين منفصلين للرجال والنساء، ونتولى تنسيق الحفل من الاستقبال حتى الزفة.</p>
          {checks(['قاعات للرجال والنساء بسعات تصل إلى 450 ضيفاً', 'درج للزفة وممر للعروس ومنصة كوشة', 'غرفة تجهيز خاصة للعروس', 'استقبال وتنظيم ومواقف وحراسة', 'تنسيق الزهور والطاولات والإضاءة', 'إدارة الحفل يوم المناسبة'])}
          <a class="btn btn-navy" href="contact.html">احجز زيارة للقصر</a>
        </div>
      </div>
      <div class="feature-row">
        {''.join(f'<div class="feature"><b>{v[1]}</b><span>{v[3]}</span></div>' for v in VENUES)}
      </div>
    </div>

    <div class="panel" role="tabpanel" id="catering" aria-labelledby="t-catering" hidden>
      <div class="svc-detail">
        <figure class="leaf"><img src="assets/img/about-hospitality.jpg" alt="ضيافة حلويات فاخرة"></figure>
        <div>
          <h2>مطاعم زوايا المعالي: بوفيهات وضيافة فاخرة</h2>
          <p class="lead">ذراع الضيافة في المجموعة. طهاة ذوو خبرة وقوائم تجمع المطبخ السعودي والعربي والعالمي، داخل قصورنا وخارجها.</p>
          {checks(['بوفيه مفتوح بقوائم حسب الطلب', 'طبخ داخلي للذبائح', 'قهوجية وصبابين لخدمة الضيوف', 'محطات حلويات ومشروبات ساخنة وباردة', 'بوفيه نسائي متكامل', 'تجهيز أماكن التقديم وطاقم مدرّب'])}
          <a class="btn btn-navy" href="contact.html">اطلب عرض ضيافة</a>
        </div>
      </div>
    </div>

    <div class="panel" role="tabpanel" id="tech" aria-labelledby="t-tech" hidden>
      <div class="svc-detail">
        <figure class="leaf"><img src="assets/img/about-main.jpg" alt="تجهيزات مناسبة بإضاءة وشاشات"></figure>
        <div>
          <h2>صوتيات، إضاءة، جوبو، وكشك تصوير Touchpix</h2>
          <p class="lead">فريق تقني يجهّز الصوت والإضاءة والمؤثرات، ويضيف لمسات تبقى في ذاكرة الضيوف وصورهم.</p>
          {checks(['أنظمة صوت ودي جي للقاعات', 'إضاءة مسرحية وليزر وبخار', 'إسقاط جوبو بأسماء العروسين أو شعار الجهة', 'كشك تصوير Touchpix بطباعة فورية', 'شاشات عرض وبث للمؤتمرات', 'فني مرافق طوال المناسبة'])}
          <a class="btn btn-navy" href="contact.html">اطلب التجهيزات التقنية</a>
        </div>
      </div>
    </div>
  </div>
</section>'''
page('services.html', 'خدماتنا — زوايا المعالي', services)

# ---------------- PORTFOLIO ----------------
G = [
 ('weddings', 'about-hall.jpg', 'قاعة زفاف بثريات كريستالية', 'أفراح'),
 ('catering', 'about-hospitality.jpg', 'محطة حلويات الضيافة', 'ضيافة وبوفيه'),
 ('setups', 'about-main.jpg', 'استقبال وتنسيق مدخل المناسبة', 'تجهيزات'),
 ('venues', 'hero.jpg', 'قصر روعة الملتقى ليلاً', 'القصور'),
 ('weddings setups', 'about-banner.jpg', 'تنسيق ركن الاستقبال', 'أفراح'),
]
def gitem(cat, img, cap, tag):
    return f'<button class="g-item" type="button" data-cat="{cat}" aria-label="تكبير: {cap}"><img src="assets/img/{img}" alt="{cap}" loading="lazy"><span class="cap"><small>{tag}</small><b>{cap}</b></span></button>'

portfolio = pagehead('معرض الأعمال', 'لقطات من أفراحنا وتجهيزاتنا وضيافتنا وقصورنا.', 'hero.jpg', 'معرض الأعمال') + f'''
<section class="sec">
  <div class="wrap">
    <div class="filters" role="group" aria-label="تصفية المعرض">
      <button class="tab" type="button" data-filter="all" aria-pressed="true">الكل</button>
      <button class="tab" type="button" data-filter="weddings" aria-pressed="false">أفراح</button>
      <button class="tab" type="button" data-filter="setups" aria-pressed="false">تجهيزات</button>
      <button class="tab" type="button" data-filter="catering" aria-pressed="false">ضيافة وبوفيه</button>
      <button class="tab" type="button" data-filter="venues" aria-pressed="false">القصور</button>
      <span class="gcount" aria-live="polite"><b id="g-count">{len(G)}</b> عمل</span>
    </div>
    <div class="gallery">{''.join(gitem(*g) for g in G)}</div>
  </div>
</section>
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="عرض الصورة" hidden>
  <button class="lb-close" type="button" aria-label="إغلاق">{I["x"]}</button>
  <figure><img src="" alt=""><figcaption></figcaption></figure>
</div>'''
page('portfolio.html', 'معرض الأعمال — زوايا المعالي', portfolio)

# ---------------- CONTACT ----------------
contact = pagehead('تواصل معنا', 'احجز زيارة للقصر، أو اطلب عرض ضيافة وتجهيزات، وسيعود إليك فريقنا خلال يوم عمل.', 'about-main.jpg', 'تواصل معنا') + f'''
<section class="sec pearl">
  <div class="wrap contact-grid">
    <div class="form-card">
      <h2>نموذج الحجز والاستفسار</h2>
      <p>الحقول المعلّمة بـ * مطلوبة.</p>
      <div class="ok" id="form-ok" role="status" hidden>{I["check"]}<span>وصلنا طلبك (هذه معاينة: لم يُرسل شيء فعلياً).</span></div>
      <form id="booking" novalidate>
        <div class="fgrid">
          <div class="field"><label for="f-name">الاسم الكامل *</label><input id="f-name" name="name" autocomplete="name" data-req><span class="err" hidden></span></div>
          <div class="field"><label for="f-phone">رقم الجوال *</label><input id="f-phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="05xxxxxxxx" data-req><span class="err" hidden></span></div>
          <div class="field full"><span class="lbl">نوع الطلب</span>
            <div class="chips" role="radiogroup" aria-label="نوع الطلب">
              <label class="chip"><input type="radio" name="kind" value="زفاف" checked><span>حفل زفاف</span></label>
              <label class="chip"><input type="radio" name="kind" value="مناسبة"><span>مناسبة عائلية</span></label>
              <label class="chip"><input type="radio" name="kind" value="مؤتمر"><span>مؤتمر أو فعالية</span></label>
              <label class="chip"><input type="radio" name="kind" value="ضيافة"><span>ضيافة وبوفيه فقط</span></label>
            </div>
          </div>
          <div class="field"><label for="f-venue">القصر المفضّل</label>
            <select id="f-venue" name="venue"><option>لم أحدد بعد</option>{''.join(f'<option>{v[1]}</option>' for v in VENUES)}</select></div>
          <div class="field"><label for="f-date">التاريخ المتوقع *</label><input id="f-date" name="date" type="date" data-req><span class="err" hidden></span></div>
          <div class="field"><label for="f-guests">عدد الضيوف التقريبي</label><input id="f-guests" name="guests" type="number" min="20" step="10" inputmode="numeric" placeholder="مثال: 300"></div>
          <div class="field full"><label for="f-msg">تفاصيل إضافية</label><textarea id="f-msg" name="msg" placeholder="الخدمات المطلوبة: ضيافة، جوبو، Touchpix…"></textarea></div>
        </div>
        <div class="form-foot"><button class="btn btn-navy" type="submit">إرسال الطلب {I["arrow"]}</button><small>نرد عادةً خلال يوم عمل.</small></div>
      </form>
    </div>
    <aside class="side">
      <div class="info"><span class="ico">{I["phone"]}</span><div><b>الهاتف</b><a class="ltr" href="tel:{PHONE}">{PHONE}</a><button class="copy" type="button" data-copy="{PHONE}">نسخ</button></div></div>
      <div class="info"><span class="ico">{I["wa"]}</span><div><b>واتساب</b><a href="{WA}" target="_blank" rel="noopener">رد سريع على استفساراتكم</a></div></div>
      <div class="info"><span class="ico">{I["mail"]}</span><div><b>البريد</b><a href="mailto:{EMAIL}">{EMAIL}</a><button class="copy" type="button" data-copy="{EMAIL}">نسخ</button></div></div>
      <a class="info" href="{MAPS}" target="_blank" rel="noopener"><span class="ico">{I["pin"]}</span><div><b>المقر الرئيسي</b><span>{ADDR}</span><span class="more">افتح في خرائط Google</span></div></a>
    </aside>
  </div>
</section>'''
page('contact.html', 'تواصل معنا — زوايا المعالي', contact)
print('built')
