/* Zawaya v2: reviews carousel + mobile menu close button. */
(function () {
  'use strict';
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  document.querySelectorAll('[data-zw-reviews]').forEach(function (c) {
    var track = c.querySelector('.zw-rev-track');
    c.querySelectorAll('.zw-rev-btn').forEach(function (b) {
      b.addEventListener('click', function () {
        var first = track.firstElementChild;
        if (!first) return;
        var step = first.getBoundingClientRect().width + 20;
        /* RTL: scrollLeft runs negative, so "next" is a negative delta */
        track.scrollBy({ left: -step * (+b.getAttribute('data-dir')), behavior: reduce ? 'auto' : 'smooth' });
      });
    });
  });
  var x = document.querySelector('.js-mnav-x'), burger = document.querySelector('.js-burger'), mnav = document.getElementById('mobile-nav');
  if (x && mnav) {
    x.addEventListener('click', function () {
      mnav.classList.remove('open');
      if (burger) { burger.setAttribute('aria-expanded', 'false'); burger.focus(); }
      document.body.style.overflow = '';
    });
  }
})();
