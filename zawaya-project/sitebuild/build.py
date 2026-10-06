# Builds the 5 preview pages from shared header/footer.
import pathlib
OUT = pathlib.Path(__file__).resolve().parent.parent / 'site'

# Icons: Phosphor Icons (light weight), inlined. https://phosphoricons.com
I = {
 'arrow': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H54.49l61.75,61.76a6,6,0,1,1-8.48,8.48l-72-72a6,6,0,0,1,0-8.48l72-72a6,6,0,0,1,8.48,8.48L54.49,122H216A6,6,0,0,1,222,128Z"/></svg>',
 'menu': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M222,128a6,6,0,0,1-6,6H40a6,6,0,0,1,0-12H216A6,6,0,0,1,222,128ZM40,70H216a6,6,0,0,0,0-12H40a6,6,0,0,0,0,12ZM216,186H40a6,6,0,0,0,0,12H216a6,6,0,0,0,0-12Z"/></svg>',
 'x': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M204.24,195.76a6,6,0,1,1-8.48,8.48L128,136.49,60.24,204.24a6,6,0,0,1-8.48-8.48L119.51,128,51.76,60.24a6,6,0,0,1,8.48-8.48L128,119.51l67.76-67.75a6,6,0,0,1,8.48,8.48L136.49,128Z"/></svg>',
 'phone': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.59,160.3l-47.24-21.17a14,14,0,0,0-13.28,1.22,4.81,4.81,0,0,0-.56.42l-24.69,21a1.88,1.88,0,0,1-1.68.06c-15.87-7.66-32.31-24-40-39.65a1.91,1.91,0,0,1,0-1.68l21.07-25a6.13,6.13,0,0,0,.42-.58,14,14,0,0,0,1.12-13.27L95.73,34.49a14,14,0,0,0-14.56-8.38A54.24,54.24,0,0,0,34,80c0,78.3,63.7,142,142,142a54.25,54.25,0,0,0,53.89-47.17A14,14,0,0,0,221.59,160.3ZM176,210C104.32,210,46,151.68,46,80A42.23,42.23,0,0,1,82.67,38h.23a2,2,0,0,1,1.84,1.31l21.1,47.11a2,2,0,0,1,0,1.67L84.73,113.15a4.73,4.73,0,0,0-.43.57,14,14,0,0,0-.91,13.73c8.87,18.16,27.17,36.32,45.53,45.19a14,14,0,0,0,13.77-1c.19-.13.38-.27.56-.42l24.68-21a1.92,1.92,0,0,1,1.6-.1l47.25,21.17a2,2,0,0,1,1.21,2A42.24,42.24,0,0,1,176,210Z"/></svg>',
 'mail': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M224,50H32a6,6,0,0,0-6,6V192a14,14,0,0,0,14,14H216a14,14,0,0,0,14-14V56A6,6,0,0,0,224,50ZM208.58,62,128,135.86,47.42,62ZM216,194H40a2,2,0,0,1-2-2V69.64l86,78.78a6,6,0,0,0,8.1,0L218,69.64V192A2,2,0,0,1,216,194Z"/></svg>',
 'pin': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M128,66a38,38,0,1,0,38,38A38,38,0,0,0,128,66Zm0,64a26,26,0,1,1,26-26A26,26,0,0,1,128,130Zm0-112a86.1,86.1,0,0,0-86,86c0,30.91,14.34,63.74,41.47,94.94a252.32,252.32,0,0,0,41.09,38,6,6,0,0,0,6.88,0,252.32,252.32,0,0,0,41.09-38c27.13-31.2,41.47-64,41.47-94.94A86.1,86.1,0,0,0,128,18Zm0,206.51C113,212.93,54,163.62,54,104a74,74,0,0,1,148,0C202,163.62,143,212.93,128,224.51Z"/></svg>',
 'check': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M172.24,99.76a6,6,0,0,1,0,8.48l-56,56a6,6,0,0,1-8.48,0l-24-24a6,6,0,0,1,8.48-8.48L112,151.51l51.76-51.75A6,6,0,0,1,172.24,99.76ZM230,128A102,102,0,1,1,128,26,102.12,102.12,0,0,1,230,128Zm-12,0a90,90,0,1,0-90,90A90.1,90.1,0,0,0,218,128Z"/></svg>',
 'wa': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M186.68,146.63l-32-16a6,6,0,0,0-6,.38L133,141.46A42.49,42.49,0,0,1,114.54,123L125,107.33a6,6,0,0,0,.38-6l-16-32A6,6,0,0,0,104,66a38,38,0,0,0-38,38,86.1,86.1,0,0,0,86,86,38,38,0,0,0,38-38A6,6,0,0,0,186.68,146.63ZM152,178a74.09,74.09,0,0,1-74-74,26,26,0,0,1,22.42-25.75l12.66,25.32-10.39,15.58a6,6,0,0,0-.54,5.63,54.43,54.43,0,0,0,29.07,29.07,6,6,0,0,0,5.63-.54l15.58-10.39,25.32,12.66A26,26,0,0,1,152,178ZM128,26A102,102,0,0,0,38.35,176.69L26.73,211.56a14,14,0,0,0,17.71,17.71l34.87-11.62A102,102,0,1,0,128,26Zm0,192a90,90,0,0,1-45.06-12.08,6.09,6.09,0,0,0-3-.81,6.2,6.2,0,0,0-1.9.31L40.65,217.88a2,2,0,0,1-2.53-2.53L50.58,178a6,6,0,0,0-.5-4.91A90,90,0,1,1,128,218Z"/></svg>',
 'ig': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M128,82a46,46,0,1,0,46,46A46.06,46.06,0,0,0,128,82Zm0,80a34,34,0,1,1,34-34A34,34,0,0,1,128,162ZM176,26H80A54.06,54.06,0,0,0,26,80v96a54.06,54.06,0,0,0,54,54h96a54.06,54.06,0,0,0,54-54V80A54.06,54.06,0,0,0,176,26Zm42,150a42,42,0,0,1-42,42H80a42,42,0,0,1-42-42V80A42,42,0,0,1,80,38h96a42,42,0,0,1,42,42ZM190,76a10,10,0,1,1-10-10A10,10,0,0,1,190,76Z"/></svg>',
 'snap': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M245.87,182.68a6,6,0,0,0-3.85-4.43c-.4-.14-30.71-11.53-44.87-52.25l21.08-8.43a6,6,0,1,0-4.46-11.14l-20,8A148.66,148.66,0,0,1,190,80,62,62,0,0,0,66,80a151.37,151.37,0,0,1-3.72,34.48l-20.05-8a6,6,0,0,0-4.46,11.14L58.93,126A96.13,96.13,0,0,1,40,158.87c-12.85,14.44-25.91,19.34-26,19.38a6,6,0,0,0-2.08,10c6.6,6.19,16.83,7.2,26.71,8.18,6.51.64,13.23,1.31,17.16,3.47,3.76,2.07,7.36,7,10.85,11.79,5.21,7.13,11.11,15.22,20.12,17.53,8.5,2.16,17.09-.76,25.4-3.59,5.72-1.94,11.11-3.78,15.86-3.78s10.14,1.84,15.86,3.78c6.29,2.14,12.74,4.34,19.19,4.34a25.36,25.36,0,0,0,6.21-.75h0c9-2.3,14.91-10.39,20.12-17.52,3.49-4.78,7.09-9.72,10.85-11.79,3.93-2.16,10.65-2.83,17.16-3.47,9.88-1,20.11-2,26.71-8.18A6,6,0,0,0,245.87,182.68Zm-29.66,1.84c-7.71.76-15.68,1.55-21.76,4.9s-10.5,9.39-14.77,15.22-8.56,11.74-13.39,13c-5,1.28-11.61-1-18.57-3.32-6.38-2.17-13-4.42-19.72-4.42s-13.34,2.25-19.72,4.42c-7,2.37-13.53,4.6-18.57,3.32-4.83-1.24-9.18-7.2-13.39-13s-8.67-11.88-14.77-15.23-14-4.14-21.76-4.9c-3.37-.33-6.79-.67-9.89-1.21a93.88,93.88,0,0,0,18.55-15.9c8.24-9.11,17.44-22.86,23.35-42.48a1.42,1.42,0,0,0,.08-.18,5.47,5.47,0,0,0,.35-1.27A156.21,156.21,0,0,0,78,80a50,50,0,0,1,100,0,156.21,156.21,0,0,0,5.77,43.51,5.34,5.34,0,0,0,.35,1.27.89.89,0,0,0,.08.17c5.91,19.63,15.11,33.38,23.35,42.49a93.88,93.88,0,0,0,18.55,15.9C223,183.85,219.58,184.19,216.21,184.52Z"/></svg>',
 'tiktok': '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M224,74a50.06,50.06,0,0,1-50-50,6,6,0,0,0-6-6H128a6,6,0,0,0-6,6V156a22,22,0,1,1-31.43-19.89A6,6,0,0,0,94,130.69V88a6,6,0,0,0-7-5.91C52.2,88.28,26,120.05,26,156a74,74,0,0,0,148,0V112.93A101.28,101.28,0,0,0,224,126a6,6,0,0,0,6-6V80A6,6,0,0,0,224,74Zm-6,39.8a89.13,89.13,0,0,1-46.5-16.69A6,6,0,0,0,162,102v54a62,62,0,0,1-124,0c0-27.72,18.47-52.48,44-60.38v31.53A34,34,0,1,0,134,156V30h28.29A62.09,62.09,0,0,0,218,85.71Z"/></svg>',
}

NAV = [('index.html', 'الرئيسية'), ('about.html', 'من نحن'), ('services.html', 'خدماتنا'), ('portfolio.html', 'معرض الأعمال'), ('contact.html', 'تواصل معنا')]
PHONE = '0570001853'
EMAIL = 'info@zawayaalmaali.com'
ADDR = 'الرياض، حي نمار، طريق ديراب'
CATERING = 'https://almaalicatering.com'
MAPS = 'https://maps.app.goo.gl/ojz2gjjTVpB4kJrt7'
WA = 'https://api.whatsapp.com/send/?phone=966570001853'
GMAP = 'https://www.google.com/maps/search/?api=1&query={q}&query_place_id={pid}'

# logo, name, district, capacity, google rating, review count, place_id
VENUES = [
 ('lg-almasa.png', 'قصر الماسة', 'حي الجنادرية', '350-400 ضيف لكل قسم، وحديقة خارجية', '4.4', '1,168', 'ChIJFxXQuahVLj4RgLuvd6L65zg'),
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
    <a class="brand" href="index.html" aria-label="زوايا المعالي الرئيسية"><img src="assets/img/logo-v.png" alt="زوايا المعالي" width="150" height="63"></a>
    <nav class="nav nav-l" aria-label="القائمة الرئيسية (تابع)">{lk(NAV[half:])}<a class="btn btn-gold btn-sm" href="contact.html">احجز مناسبتك</a></nav>
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
      <li><a href="{CATERING}" target="_blank" rel="noopener">موقع مطاعم زوايا المعالي</a></li>
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

FONTS = '<link rel="icon" href="assets/img/logo-v.png">\n<link rel="preconnect" href="https://fonts.googleapis.com">\n<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>\n<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600;700&display=swap">\n<link rel="stylesheet" href="assets/site.css">'

def page(fname, title, body, entry=False):
    if entry:  # the artifact entry page: the host adds doctype/html/head/body
        html = f'<meta charset="utf-8">\n<title>{title}</title>\n{FONTS}\n<script>document.documentElement.lang="ar";document.documentElement.dir="rtl";</script>\n{header(fname)}\n<main id="main">\n{body}\n</main>\n{FOOTER}\n'
    else:
        html = f'<!doctype html>\n<html lang="ar" dir="rtl">\n<head>\n<meta charset="utf-8">\n<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">\n<title>{title}</title>\n<meta name="description" content="زوايا المعالي: خمسة قصور أفراح في الرياض مع تنسيق الزفاف والضيافة والعروض التقنية.">\n{FONTS}\n</head>\n<body>\n{header(fname)}\n<main id="main">\n{body}\n</main>\n{FOOTER}\n</body>\n</html>\n'
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
    <figure class="a-photo bezel reveal"><img class="leaf" src="assets/img/about-main.jpg" alt="استقبال الضيوف في إحدى مناسبات زوايا المعالي" loading="lazy"></figure>
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
      <a class="svc svc-lg reveal" href="services.html#halls"><img src="assets/img/about-hall.jpg" alt="" loading="lazy"><div><h3>القاعات وتنسيق الزفاف</h3><p>الكوشة والزفة وغرفة التجهيز بتنسيق يناسب ذوقكم.</p><span class="more">التفاصيل {I["arrow"]}</span></div></a>
      <a class="svc reveal" href="services.html#catering"><img src="assets/img/about-hospitality.jpg" alt="" loading="lazy"><div><h3>الضيافة والبوفيه</h3><p>مطاعم زوايا المعالي: بوفيهات وقهوجية وحلويات.</p><span class="more">التفاصيل {I["arrow"]}</span></div></a>
      <a class="svc reveal" href="services.html#tech"><img src="assets/img/hero.jpg" alt="" loading="lazy"><div><h3>العروض التقنية</h3><p>صوتيات وإضاءة وجوبو وكشك Touchpix للضيوف.</p><span class="more">التفاصيل {I["arrow"]}</span></div></a>
    </div>
  </div>
</section>

<section class="sec navy" id="venues">
  <div class="wrap">
    <div class="head reveal"><h2>خمسة قصور نُديرها في الرياض</h2></div>
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
    <div class="head reveal"><h2>من مناسباتنا</h2></div>
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
page('about.html', 'من نحن | زوايا المعالي', about)

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
          <a class="btn btn-navy" href="contact.html">اطلب عرض ضيافة</a> <a class="btn btn-line" href="{CATERING}" target="_blank" rel="noopener">موقع المطعم</a>
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
page('services.html', 'خدماتنا | زوايا المعالي', services)

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
page('portfolio.html', 'معرض الأعمال | زوايا المعالي', portfolio)

# ---------------- CONTACT ----------------
contact = pagehead('تواصل معنا', 'احجز زيارة للقصر، أو اطلب عرض ضيافة وتجهيزات، وسيعود إليك فريقنا خلال يوم عمل.', 'about-main.jpg', 'تواصل معنا') + f'''
<section class="sec pearl">
  <div class="wrap contact-grid">
    <div class="form-card">
      <h2>نموذج الحجز والاستفسار</h2>
      <p>الحقول المعلّمة بـ * مطلوبة.</p>
      <div class="ok" id="form-ok" role="status" hidden>{I["check"]}<span>وصلنا طلبك (هذه معاينة ولم يُرسل شيء فعلياً).</span></div>
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
page('contact.html', 'تواصل معنا | زوايا المعالي', contact)
print('built')
