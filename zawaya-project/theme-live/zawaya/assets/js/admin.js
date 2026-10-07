/* Media pickers for project cover + gallery */
jQuery(function ($) {
  var coverFrame, galFrame;

  $('#zw-cover-btn').on('click', function (e) {
    e.preventDefault();
    if (coverFrame) { coverFrame.open(); return; }
    coverFrame = wp.media({ title: 'صورة الغلاف', button: { text: 'استخدام الصورة' }, multiple: false, library: { type: 'image' } });
    coverFrame.on('select', function () {
      var a = coverFrame.state().get('selection').first().toJSON();
      $('#zw-cover').val(a.id);
      var u = (a.sizes && a.sizes.medium) ? a.sizes.medium.url : a.url;
      $('#zw-cover-prev').html('<img src="' + u + '">');
    });
    coverFrame.open();
  });
  $('#zw-cover-clear').on('click', function (e) { e.preventDefault(); $('#zw-cover').val(''); $('#zw-cover-prev').empty(); });

  $('#zw-gal-btn').on('click', function (e) {
    e.preventDefault();
    var ids = ($('#zw-gal').val() || '').split(',').filter(Boolean);
    galFrame = wp.media({ title: 'معرض الصور', button: { text: 'حفظ المعرض' }, multiple: 'add', library: { type: 'image' } });
    galFrame.on('open', function () {
      var sel = galFrame.state().get('selection');
      ids.forEach(function (id) { var a = wp.media.attachment(id); a.fetch(); sel.add(a); });
    });
    galFrame.on('select', function () {
      var sel = galFrame.state().get('selection').toJSON();
      $('#zw-gal').val(sel.map(function (a) { return a.id; }).join(','));
      $('#zw-gal-prev').html(sel.map(function (a) {
        var u = (a.sizes && a.sizes.thumbnail) ? a.sizes.thumbnail.url : a.url;
        return '<img src="' + u + '">';
      }).join(''));
    });
    galFrame.open();
  });
  $('#zw-gal-clear').on('click', function (e) { e.preventDefault(); $('#zw-gal').val(''); $('#zw-gal-prev').empty(); });
});
