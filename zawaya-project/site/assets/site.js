/* Zawaya Al Maali — site behaviour (vanilla JS) */
(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $ = function (s, r) { return (r || document).querySelector(s); };
  var $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };

  var y = $('#year'); if (y) y.textContent = new Date().getFullYear();

  /* Header shrinks on scroll */
  var hdr = $('.hdr');
  if (hdr) {
    var onScroll = function () { hdr.classList.toggle('scrolled', window.scrollY > 40); };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* Full-screen mobile menu */
  var burger = $('.burger'), mnav = $('#mnav');
  if (burger && mnav) {
    var setMenu = function (open) {
      mnav.hidden = !open;
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
      document.body.style.overflow = open ? 'hidden' : '';
      if (open) $('.mnav-x', mnav).focus(); else burger.focus();
    };
    burger.addEventListener('click', function () { setMenu(true); });
    $('.mnav-x', mnav).addEventListener('click', function () { setMenu(false); });
    $$('a', mnav).forEach(function (a) { a.addEventListener('click', function () { setMenu(false); }); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !mnav.hidden) setMenu(false); });
  }

  /* Reveal on scroll */
  var reveals = $$('.reveal');
  if ('IntersectionObserver' in window && !reduce) {
    var io = new IntersectionObserver(function (es) {
      es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
    }, { threshold: 0.12 });
    reveals.forEach(function (el) {
      if (el.getBoundingClientRect().top > window.innerHeight) io.observe(el); else el.classList.add('in');
    });
  } else reveals.forEach(function (el) { el.classList.add('in'); });

  /* Count-up numbers (final value is already in the HTML) */
  var nums = $$('[data-count]');
  if ('IntersectionObserver' in window && !reduce && nums.length) {
    var cio = new IntersectionObserver(function (es) {
      es.forEach(function (e) {
        if (!e.isIntersecting) return;
        cio.unobserve(e.target);
        var n = e.target, end = +n.dataset.count, pre = n.dataset.prefix || '', t0 = null;
        (function tick(t) {
          if (t0 === null) t0 = t;
          var p = Math.min((t - t0) / 1400, 1), v = end * (1 - Math.pow(1 - p, 3));
          n.textContent = pre + Math.round(v).toLocaleString('en-US');
          if (p < 1) requestAnimationFrame(tick);
        })(performance.now());
      });
    }, { threshold: 0.4 });
    nums.forEach(function (n) { cio.observe(n); });
  }

  /* Hero crossfade slideshow */
  var slides = $$('.slide');
  if (slides.length > 1 && !reduce) {
    var i = 0;
    setInterval(function () {
      slides[i].classList.remove('on');
      i = (i + 1) % slides.length;
      slides[i].classList.add('on');
    }, 6000);
  }

  /* Reviews carousel */
  $$('[data-carousel]').forEach(function (c) {
    var track = $('.car-track', c);
    $$('.car-btn', c).forEach(function (b) {
      b.addEventListener('click', function () {
        var step = track.firstElementChild.getBoundingClientRect().width + 20;
        /* RTL: scrollLeft is negative; "next" moves toward the end of the row */
        track.scrollBy({ left: -step * (+b.dataset.dir), behavior: reduce ? 'auto' : 'smooth' });
      });
    });
  });

  /* Tabs (services) — also opens a tab from #anchor */
  var tabs = $$('.tab[role=tab]');
  function selectTab(tab, focus) {
    tabs.forEach(function (t) {
      var on = t === tab;
      t.setAttribute('aria-selected', on ? 'true' : 'false');
      t.tabIndex = on ? 0 : -1;
      document.getElementById(t.getAttribute('aria-controls')).hidden = !on;
    });
    if (focus) tab.focus();
  }
  tabs.forEach(function (t, k) {
    t.addEventListener('click', function () { selectTab(t); history.replaceState(null, '', '#' + t.dataset.hash); });
    t.addEventListener('keydown', function (e) {
      var d = e.key === 'ArrowLeft' ? 1 : e.key === 'ArrowRight' ? -1 : 0;
      if (d) { e.preventDefault(); selectTab(tabs[(k + d + tabs.length) % tabs.length], true); }
    });
  });
  function fromHash() {
    var h = location.hash.slice(1);
    var t = tabs.filter(function (x) { return x.dataset.hash === h; })[0];
    if (t) selectTab(t);
  }
  if (tabs.length) { fromHash(); window.addEventListener('hashchange', fromHash); }

  /* Portfolio filter */
  var items = $$('.g-item');
  $$('[data-filter]').forEach(function (b) {
    b.addEventListener('click', function () {
      var f = b.dataset.filter, n = 0;
      $$('[data-filter]').forEach(function (x) { x.setAttribute('aria-pressed', x === b ? 'true' : 'false'); });
      items.forEach(function (it) {
        var show = f === 'all' || it.dataset.cat.split(' ').indexOf(f) > -1;
        it.hidden = !show; if (show) n++;
      });
      var c = $('#g-count'); if (c) c.textContent = n;
    });
  });

  /* Lightbox */
  var lb = $('#lightbox');
  if (lb) {
    var lbImg = $('img', lb), lbCap = $('figcaption', lb), last = null;
    var close = function () { lb.hidden = true; lbImg.src = ''; if (last) last.focus(); };
    items.forEach(function (it) {
      it.addEventListener('click', function () {
        last = it;
        var im = $('img', it);
        lbImg.src = im.src; lbImg.alt = im.alt; lbCap.textContent = im.alt;
        lb.hidden = false; $('.lb-close', lb).focus();
      });
    });
    lb.addEventListener('click', function (e) { if (e.target === lb || e.target.closest('.lb-close')) close(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !lb.hidden) close(); });
  }

  /* Copy buttons */
  $$('[data-copy]').forEach(function (b) {
    b.addEventListener('click', function () {
      var orig = b.textContent, text = b.dataset.copy;
      var done = function () { b.textContent = 'تم النسخ'; setTimeout(function () { b.textContent = orig; }, 1600); };
      if (navigator.clipboard) navigator.clipboard.writeText(text).then(done, function () {});
    });
  });

  /* Booking form (preview: validates and confirms in-page, sends nothing) */
  var form = $('#booking');
  if (form) {
    form.addEventListener('submit', function (e) {
      var live = !!form.getAttribute('action'); // on the real site the form posts to WordPress
      if (!live) e.preventDefault();
      var ok = true;
      $$('[data-req]', form).forEach(function (inp) {
        var field = inp.closest('.field'), err = $('.err', field);
        var v = (inp.value || '').trim(), msg = '';
        if (!v) msg = 'هذا الحقل مطلوب.';
        else if (inp.type === 'tel' && !/^0?5\d{8}$/.test(v.replace(/\s|-/g, ''))) msg = 'اكتب رقم جوال سعودي صحيح، مثل 05xxxxxxxx.';
        field.classList.toggle('bad', !!msg);
        if (err) { err.textContent = msg; err.hidden = !msg; }
        if (msg && ok) { inp.focus(); ok = false; }
      });
      if (!ok) { e.preventDefault(); return; }
      if (live) return;
      var box = $('#form-ok');
      box.hidden = false;
      box.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'center' });
      form.reset();
    });
  }

  // inner page head: pointer light + photo tilt
  $$('.phead').forEach(function (ph) {
    if (reduce) return;
    var photo = ph.querySelector('.phead-photo');
    ph.addEventListener('pointermove', function (e) {
      var r = ph.getBoundingClientRect(), x = (e.clientX - r.left) / r.width, y = (e.clientY - r.top) / r.height;
      ph.style.setProperty('--mx', (x * 100) + '%'); ph.style.setProperty('--my', (y * 100) + '%');
      if (photo) { photo.style.setProperty('--ry', ((x - .5) * -8) + 'deg'); photo.style.setProperty('--rx', ((y - .5) * 6) + 'deg'); }
    });
    ph.addEventListener('pointerleave', function () { if (photo) { photo.style.setProperty('--ry', '0deg'); photo.style.setProperty('--rx', '0deg'); } });
  });
})();
