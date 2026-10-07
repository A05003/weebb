/* Zawaya Al Maali — front-end behaviour (no dependencies) */
(function () {
  'use strict';
  var doc = document.documentElement;
  var header = document.getElementById('site-header');

  /* ---------- Dark / light mode ---------- */
  function setIcons() {
    var dark = doc.dataset.theme === 'dark';
    document.querySelectorAll('.js-theme').forEach(function (b) {
      b.innerHTML = '<i class="fa-solid ' + (dark ? 'fa-sun' : 'fa-moon') + '"></i>';
      var l = dark ? 'الوضع النهاري' : 'الوضع الليلي';
      b.setAttribute('aria-label', l); b.title = l;
    });
  }
  document.querySelectorAll('.js-theme').forEach(function (b) {
    if (b.hasAttribute('data-zw-inline')) return; /* toggled by its inline handler */
    b.addEventListener('click', function () {
      var dark = doc.dataset.theme !== 'dark';
      doc.dataset.theme = dark ? 'dark' : 'light';
      try { localStorage.setItem('zawaya-theme', dark ? 'dark' : 'light'); } catch (e) {}
      setIcons();
    });
  });
  setIcons();

  /* ---------- Header: scroll state, back-to-top ---------- */
  var toTop = document.getElementById('to-top');
  function onScroll() {
    var y = window.scrollY;
    if (header) header.classList.toggle('is-scrolled', y > 40);
    if (toTop) toTop.classList.toggle('show', y > 700);
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
  if (toTop) toTop.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });

  /* ---------- Mobile menu ---------- */
  var burger = document.querySelector('.js-burger');
  var mnav = document.getElementById('mobile-nav');
  if (burger && mnav) {
    burger.addEventListener('click', function () {
      var open = !mnav.classList.contains('open');
      mnav.classList.toggle('open', open);
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
      burger.innerHTML = '<i class="fa-solid ' + (open ? 'fa-xmark' : 'fa-bars') + '"></i>';
    });
  }

  /* ---------- Mega menu (projects) ---------- */
  var mega = document.getElementById('mega');
  var megaItem = document.querySelector('.nav .has-mega');
  if (mega && megaItem && header) {
    var closeT;
    var open = function () { clearTimeout(closeT); mega.classList.add('open'); mega.setAttribute('aria-hidden', 'false'); };
    var close = function () { closeT = setTimeout(function () { mega.classList.remove('open'); mega.setAttribute('aria-hidden', 'true'); }, 120); };
    megaItem.addEventListener('mouseenter', open);
    megaItem.addEventListener('focusin', open);
    mega.addEventListener('mouseenter', open);
    header.addEventListener('mouseleave', close);
    document.querySelectorAll('.nav li:not(.has-mega), .nav .hdr-cta, .nav .js-theme').forEach(function (el) {
      el.addEventListener('mouseenter', function () { clearTimeout(closeT); mega.classList.remove('open'); });
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') mega.classList.remove('open'); });
  }

  /* ---------- Reveal on scroll ---------- */
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var targets = document.querySelectorAll('main section, main article.svc, main .post-card');
  if ('IntersectionObserver' in window && !reduce) {
    var io = new IntersectionObserver(function (es) {
      es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('zr-in'); io.unobserve(e.target); } });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
    targets.forEach(function (el) {
      if (el.classList.contains('banner') || el.classList.contains('hero')) return;
      el.setAttribute('data-zr', '');
      if (el.getBoundingClientRect().top < window.innerHeight) el.classList.add('zr-in'); else io.observe(el);
    });
  } else {
    doc.classList.remove('zr-on');
  }

  /* ---------- Counters ---------- */
  var nums = document.querySelectorAll('[data-count]');
  function runCount(el) {
    var to = parseInt(el.getAttribute('data-count'), 10) || 0;
    var pre = el.getAttribute('data-prefix') || '';
    var t0 = performance.now(), d = 2000;
    function f(n) {
      var p = Math.min(1, (n - t0) / d), e = 1 - Math.pow(1 - p, 3);
      el.textContent = pre + Math.round(to * e).toLocaleString('en-US');
      if (p < 1) requestAnimationFrame(f);
    }
    requestAnimationFrame(f);
  }
  if (nums.length && 'IntersectionObserver' in window && !reduce) {
    var cio = new IntersectionObserver(function (es) {
      es.forEach(function (e) { if (e.isIntersecting) { runCount(e.target); cio.unobserve(e.target); } });
    }, { threshold: 0.3 });
    nums.forEach(function (n) { n.textContent = (n.getAttribute('data-prefix') || '') + '0'; cio.observe(n); });
  }

  /* ---------- Carousels (infinite, RTL) ---------- */
  function initCarousel(c) {
    if (c.getAttribute('data-zw-ready')) return;
    c.setAttribute('data-zw-ready', '1');
    var track = c.querySelector('.carousel-track');
    var items = Array.prototype.slice.call(track.children);
    var n = items.length;
    var prev = c.querySelector('.carousel-btn.prev');
    var next = c.querySelector('.carousel-btn.next');
    function per() { return parseInt(getComputedStyle(c).getPropertyValue('--per'), 10) || 1; }
    if (n <= per()) {
      if (prev) prev.style.display = 'none';
      if (next) next.style.display = 'none';
      return;
    }
    items.forEach(function (it) { var cl = it.cloneNode(true); cl.setAttribute('aria-hidden', 'true'); cl.querySelectorAll('a,button,[tabindex]').forEach(function (a) { a.setAttribute('tabindex', '-1'); }); track.appendChild(cl); });
    var i = 0, hover = false, busy = false;
    function apply(anim) {
      track.style.transition = anim ? '' : 'none';
      track.style.transform = 'translateX(' + (i * 100 / per()) + '%)';
      if (!anim) { void track.offsetWidth; track.style.transition = ''; }
    }
    function go(d) {
      if (busy) return;
      if (d < 0 && i === 0) { i = n; apply(false); }
      i += d; busy = true; apply(true);
    }
    track.addEventListener('transitionend', function () {
      busy = false;
      if (i >= n) { i = i - n; apply(false); }
    });
    if (next) next.addEventListener('click', function () { go(1); });
    if (prev) prev.addEventListener('click', function () { go(-1); });
    c.addEventListener('mouseenter', function () { hover = true; });
    c.addEventListener('mouseleave', function () { hover = false; });
    c.addEventListener('focusin', function () { hover = true; });
    c.addEventListener('focusout', function () { hover = false; });
    window.addEventListener('resize', function () { apply(false); });
    if (c.getAttribute('data-autoplay') === '1' && !reduce) {
      var timer = setInterval(function () {
        if (!document.body.contains(c)) { clearInterval(timer); return; }
        if (!hover && !document.hidden) go(1);
      }, 3500);
    }
    // touch swipe
    var sx = null;
    c.addEventListener('touchstart', function (e) { sx = e.touches[0].clientX; }, { passive: true });
    c.addEventListener('touchend', function (e) {
      if (sx === null) return;
      var dx = e.changedTouches[0].clientX - sx; sx = null;
      if (Math.abs(dx) > 40) go(dx > 0 ? 1 : -1);
    });
  }
  function initCarousels(root) {
    (root || document).querySelectorAll('[data-carousel]').forEach(initCarousel);
  }
  initCarousels();

  /* ---------- Hero YouTube video (fades in once playing) ---------- */
  var vid = document.getElementById('hero-video');
  if (vid && !reduce && window.innerWidth > 600) {
    vid.src = vid.getAttribute('data-src');
    window.addEventListener('message', function (e) {
      if (!/youtube/.test(e.origin || '')) return;
      var d = e.data; try { if (typeof d === 'string') d = JSON.parse(d); } catch (_) { return; }
      if (!d) return;
      var st = d.info && d.info.playerState;
      if ((d.event === 'onStateChange' && d.info === 1) || st === 1) vid.classList.add('playing');
    });
    vid.addEventListener('load', function () {
      var k = 0;
      var ping = setInterval(function () {
        if (vid.classList.contains('playing') || k++ > 12) { clearInterval(ping); return; }
        try {
          vid.contentWindow.postMessage(JSON.stringify({ event: 'listening', id: 1, channel: 'widget' }), '*');
          vid.contentWindow.postMessage(JSON.stringify({ event: 'command', func: 'playVideo', args: [] }), '*');
        } catch (_) {}
      }, 800);
    });
  }

  /* ---------- Projects page: active tab ---------- */
  function initTabs(root) {
    var tabs = (root || document).querySelectorAll('.prj-tabs a');
    if (!tabs.length || !('IntersectionObserver' in window)) return;
    var map = {};
    tabs.forEach(function (t) { map[t.getAttribute('href').slice(1)] = t; });
    var tio = new IntersectionObserver(function (es) {
      es.forEach(function (e) {
        if (e.isIntersecting) { tabs.forEach(function (t) { t.classList.remove('on'); }); var t = map[e.target.id]; if (t) t.classList.add('on'); }
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    (root || document).querySelectorAll('.prj-row').forEach(function (r) { tio.observe(r); });
  }
  initTabs();

  /* ---------- Elementor: (re)initialise widgets rendered in the editor ---------- */
  function hookElementor() {
    if (!window.elementorFrontend || !window.elementorFrontend.hooks) return;
    window.elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
      var el = $scope && $scope[0];
      if (!el) return;
      initCarousels(el);
      if (window.elementorFrontend.isEditMode && window.elementorFrontend.isEditMode()) initTabs(el);
    });
  }
  if (window.elementorFrontend && window.elementorFrontend.hooks) hookElementor();
  else window.addEventListener('elementor/frontend/init', hookElementor);

  /* ---------- Gallery lightbox ---------- */
  var lb = document.getElementById('lightbox');
  if (lb) {
    var lbImg = lb.querySelector('img');
    document.querySelectorAll('[data-lightbox]').forEach(function (a) {
      a.addEventListener('click', function (e) { e.preventDefault(); lbImg.src = a.href; lb.classList.add('open'); });
    });
    lb.addEventListener('click', function () { lb.classList.remove('open'); lbImg.src = ''; });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') lb.classList.remove('open'); });
  }
})();
