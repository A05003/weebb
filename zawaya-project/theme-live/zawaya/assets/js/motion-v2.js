/* Entrance animations + highlighted headline (motion taken from almaalicatering.com). */
(function () {
  'use strict';
  var doc = document.documentElement;
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  /* never touch the Elementor editor / preview */
  if (/elementor-preview|elementor-editor/.test(location.search + ' ' + document.body.className) || window.self !== window.top) return;

  /* 1. Double underline under the last word of section titles (loops every ~8s). */
  document.querySelectorAll('main .zw-sec-title .elementor-heading-title').forEach(function (h) {
    if (h.childNodes.length !== 1 || h.firstChild.nodeType !== 3) return;
    var words = h.textContent.trim().split(/\s+/);
    var last = words.pop();
    if (!last) return;
    var span = document.createElement('span');
    span.className = 'zm-hl';
    span.appendChild(document.createTextNode(last));
    span.insertAdjacentHTML('beforeend', '<svg viewBox="0 0 100 20" preserveAspectRatio="none" aria-hidden="true"><path pathLength="1" d="M2 6 Q50 13 98 5"/><path pathLength="1" d="M2 15 Q50 21 98 12"/></svg>');
    h.textContent = words.length ? words.join(' ') + ' ' : '';
    h.appendChild(span);
  });

  /* 1b. Magnetic pull on primary buttons (mouse only). */
  if (!reduce && window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
    document.querySelectorAll('.btn-gold, .hdr-cta, .elementor-button').forEach(function (b) {
      b.classList.add('zm-mag');
      b.addEventListener('pointermove', function (e) {
        var r = b.getBoundingClientRect();
        var x = (e.clientX - (r.left + r.width / 2)) / r.width, y = (e.clientY - (r.top + r.height / 2)) / r.height;
        b.style.setProperty('--mx', (x * 8).toFixed(1) + 'px');
        b.style.setProperty('--my', (y * 6).toFixed(1) + 'px');
      });
      b.addEventListener('pointerleave', function () { b.style.removeProperty('--mx'); b.style.removeProperty('--my'); });
    });
  }

  if (reduce || !('IntersectionObserver' in window)) return;

  /* 2. Entrance animations. Columns of a row enter from the sides, everything else rises. */
  var main = document.querySelector('main');
  if (!main) return;
  /* Caching plugins may delay this script until the first touch/scroll. In that case elements already on screen are left alone, so nothing blinks. */
  var late = performance.now() > 1500 || window.scrollY > 40;
  var units = [];
  var taken = new Set();
  function add(el, dir, delay) {
    if (!el || taken.has(el)) return;
    for (var p = el.parentElement; p && p !== main; p = p.parentElement) if (taken.has(p)) return;
    taken.add(el);
    units.push({ el: el, dir: dir, delay: delay || 0 });
  }
  function cols(parent) {
    return Array.prototype.filter.call(parent.children, function (c) { return c.classList.contains('e-con'); });
  }
  main.querySelectorAll('.e-con').forEach(function (con) {
    var kids = cols(con);
    if (kids.length < 2 || con.classList.contains('zw-hero')) return;
    var cs = getComputedStyle(con);
    if (con.classList.contains('e-grid') || cs.display === 'grid') {
      kids.forEach(function (k, i) { add(k, 'up', i * 0.12); });
    } else if (cs.flexDirection === 'row' || cs.flexDirection === 'row-reverse') {
      kids.forEach(function (k, i) { add(k, i === 0 ? 'right' : i === kids.length - 1 ? 'left' : 'up', i * 0.1); });
    }
  });
  main.querySelectorAll('.elementor-widget').forEach(function (w) {
    if (w.matches('.elementor-widget-spacer')) return;
    var hero = w.closest('.zw-hero');
    add(w, 'up', hero ? Array.prototype.indexOf.call(hero.querySelectorAll('.elementor-widget'), w) * 0.18 : 0);
  });
  /* late start: only things still below the fold are animated; nothing above or on screen is touched */
  if (late) units = units.filter(function (u) { return u.el.getBoundingClientRect().top >= innerHeight * 0.92; });
  if (!units.length) return;

  doc.classList.add('zm-ready');
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (!e.isIntersecting) return;
      var el = e.target, u = el.__zm;
      io.unobserve(el);
      el.style.setProperty('--zm-delay', u.delay + 's');
      el.classList.add('zm-in', 'zm-' + u.dir);
      el.classList.remove('zm-pre');
      el.addEventListener('animationend', function () { el.classList.remove('zm-in', 'zm-' + u.dir); el.style.removeProperty('--zm-delay'); }, { once: true });
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
  units.forEach(function (u) { u.el.__zm = u; u.el.classList.add('zm-pre'); io.observe(u.el); });
  /* safety net: never leave anything hidden */
  setTimeout(function () { document.querySelectorAll('.zm-pre').forEach(function (el) { var r = el.getBoundingClientRect(); if (r.top < innerHeight * 1.5) el.classList.remove('zm-pre'); }); }, 6000);
})();
