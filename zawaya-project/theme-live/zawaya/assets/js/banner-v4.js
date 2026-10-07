/* Page banner: light that follows the pointer + gentle parallax on the photo. */
(function () {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  var banners = [].slice.call(document.querySelectorAll('.banner, .hall-hero'));
  if (!banners.length) return;
  banners.forEach(function (b) {
    b.addEventListener('pointermove', function (e) {
      var r = b.getBoundingClientRect();
      b.style.setProperty('--mx', ((e.clientX - r.left) / r.width * 100).toFixed(1) + '%');
      b.style.setProperty('--my', ((e.clientY - r.top) / r.height * 100).toFixed(1) + '%');
      var logo = b.querySelector('.hall-hero-logo');
      if (logo) {
        logo.style.setProperty('--ry', (((e.clientX - r.left) / r.width - .5) * -10).toFixed(1) + 'deg');
        logo.style.setProperty('--rx', (((e.clientY - r.top) / r.height - .5) * 8).toFixed(1) + 'deg');
      }
    }, { passive: true });
  });
  var ticking = false;
  function parallax() {
    ticking = false;
    banners.forEach(function (b) {
      var r = b.getBoundingClientRect();
      if (r.bottom < 0 || r.top > window.innerHeight) return;
      b.style.setProperty('--py', (Math.max(0, -r.top) * 0.25).toFixed(1) + 'px');
    });
  }
  window.addEventListener('scroll', function () {
    if (!ticking) { ticking = true; requestAnimationFrame(parallax); }
  }, { passive: true });
})();
