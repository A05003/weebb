#!/usr/bin/env python3
"""Builds the WordPress theme "zawaya-v2" (folder + zip) from:
   - zawaya-elementor.zip   (the installed v1.1.1 theme: post types, contact handler, Elementor widgets)
   - site/                  (the v5/v6 static preview: header, footer, pages, css, js, images)
   - theme_src/             (hand-written PHP: functions, helpers, dynamic templates)
Run:  python3 sitebuild/make_theme.py   (after python3 sitebuild/build.py)
"""
import pathlib, re, shutil, subprocess, zipfile, tempfile

ROOT = pathlib.Path(__file__).resolve().parent.parent
SITE, SRC, OLDZIP = ROOT / 'site', ROOT / 'theme_src', ROOT / 'zawaya-elementor.zip'
OUT = ROOT / 'theme' / 'zawaya-v2'
ZIP = ROOT / 'zawaya-v2.zip'
VER = '2.0.0'


def rd(p): return pathlib.Path(p).read_text(encoding='utf-8')
def wr(p, s):
    p = pathlib.Path(p); p.parent.mkdir(parents=True, exist_ok=True); p.write_text(s, encoding='utf-8')
def sub1(s, old, new, label):
    assert old in s, f'patch target missing: {label}'
    return s.replace(old, new, 1)


# ---------------------------------------------------------------- 1. base = old theme
if OUT.parent.exists(): shutil.rmtree(OUT.parent)
OUT.parent.mkdir(parents=True)
with tempfile.TemporaryDirectory() as tmp:
    zipfile.ZipFile(OLDZIP).extractall(tmp)
    shutil.move(str(pathlib.Path(tmp) / 'zawaya'), str(OUT))

# ---------------------------------------------------------------- 2. legacy css, scoped under .elementor
def scope_css(css):
    css = re.sub(r'/\*.*?\*/', '', css, flags=re.S)
    out, i, n = [], 0, len(css)
    while i < n:
        j = css.find('{', i)
        if j < 0: break
        prelude = css[i:j].strip()
        depth, k = 1, j + 1
        while k < n and depth:
            depth += {'{': 1, '}': -1}.get(css[k], 0); k += 1
        body = css[j + 1:k - 1]
        i = k
        if prelude.startswith(('@media', '@supports')):
            out.append(f'{prelude}{{{scope_css(body)}}}')
        elif prelude.startswith('@keyframes'):
            out.append(f'{prelude.replace("@keyframes ", "@keyframes zl-")}{{{body}}}')
        elif prelude.startswith('@'):
            continue                      # @font-face / @import: the new theme loads its own fonts
        else:
            sels = []
            for s in (x.strip() for x in prelude.split(',')):
                if s.startswith(('html[data-theme', 'body.', 'html.', '.zawaya')) or 'data-theme' in s: continue
                if s in (':root', 'html', 'body', '*'): s = '.elementor'
                elif s.startswith('.elementor'): pass
                else: s = '.elementor ' + s
                sels.append(s)
            if sels: out.append(f'{",".join(sels)}{{{body}}}')
    return '\n'.join(out)

legacy = scope_css(rd(OUT / 'style.css')) + '\n' + rd(OUT / 'assets/css/elementor.css')
legacy = re.sub(r'(animation(?:-name)?:\s*)(?!none)([a-zA-Z])', lambda m: m.group(0), legacy)
wr(OUT / 'assets/css/legacy.css', '/* Legacy v1 styles, scoped under .elementor (used only by pages built with the Zawaya Elementor widgets) */\n' + legacy)
(OUT / 'assets/css/elementor.css').unlink()
wr(OUT / 'style.css', f'''/*
Theme Name: زوايا المعالي - Zawaya Al Maali v2
Theme URI: https://zawayaalmaali.com
Author: Zawaya Al Maali
Description: الواجهة الجديدة لزوايا المعالي للأفراح والمناسبات: هيدر وفوتر جديدان، أخضر زمردي مع ذهبي شمبانيا، رؤوس صفحات تفاعلية. نفس المحتوى (المشاريع، الخدمات، الشركاء، نموذج التواصل) وويدجتس Elementor المخصصة. التصميم في assets/site.css.
Version: {VER}
Requires at least: 6.0
Requires PHP: 7.4
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: zawaya
*/
''')

# ---------------------------------------------------------------- 3. hand-written PHP
for f in ['functions.php', 'index.php', 'home.php', 'page.php', 'single.php', '404.php', 'single-zawaya_project.php']:
    shutil.copy(SRC / f, OUT / f)
shutil.copy(SRC / 'inc/zv.php', OUT / 'inc/zv.php')
shutil.copy(SRC / 'template-post-card.php', OUT / 'template-parts/post-card.php')

# ---------------------------------------------------------------- 4. assets from the static preview
shutil.copy(SITE / 'assets/site.css', OUT / 'assets/site.css')
shutil.copy(SITE / 'assets/site.js', OUT / 'assets/site.js')
for f in (SITE / 'assets/img').iterdir():
    shutil.copy(f, OUT / 'assets/img' / f.name)
# font stack: SF Pro AR when its files are uploaded to assets/fonts/, bundled Tajawal until then
css = rd(OUT / 'assets/site.css')
css = css.replace('url(fonts/alfont_com_SFProAR_regular.ttf)', 'url(fonts/alfont_com_SFProAR_regular.ttf)')
css = sub1(css, '"SF Pro AR","Noto Sans Arabic"', '"SF Pro AR","Tajawal","Noto Sans Arabic"', 'font stack')
wr(OUT / 'assets/site.css', css)
wr(OUT / 'assets/fonts/README.txt', 'Put alfont_com_SFProAR_regular.ttf and alfont_com_SFProAR_semibold.ttf here.\nThe site uses them automatically (see @font-face at the top of assets/site.css); until then it falls back to the bundled Tajawal.\n')
(OUT / 'readme.txt').write_text(f'''=== زوايا المعالي v2 ===
Version {VER}

* الواجهة الجديدة: assets/site.css + assets/site.js، والقوالب: header.php footer.php front-page.php page-templates/*.php
* صفحات الموقع (الرئيسية، من نحن، خدماتنا، مشاريعنا، تواصل معنا) تستخدم قوالب القالب: من تعديل الصفحة اختر القالب المناسب.
* لإعادة صفحة إلى تصميم Elementor القديم: اجعل قالب الصفحة "Elementor Full Width" (محتواها لم يُمسّ).
* خط SF Pro AR: ارفع الملفين إلى assets/fonts/ (انظر README.txt هناك).
* نموذج التواصل: يحفظ الرسائل في لوحة التحكم ويرسلها بالبريد (inc/contact.php).
* ويدجتس Elementor المخصصة (زوايا المعالي) ما زالت متاحة.
''', encoding='utf-8')

# ---------------------------------------------------------------- 5. patches to inherited code
h = rd(OUT / 'inc/helpers.php')
h = sub1(h, "	$d = zawaya_defaults();\n	return get_theme_mod( 'zw_' . $key, isset( $d[ $key ] ) ? $d[ $key ] : '' );",
"""	$d   = zawaya_defaults();
	$def = isset( $d[ $key ] ) ? $d[ $key ] : '';
	$v   = get_theme_mod( 'zw_' . $key, null );
	if ( null !== $v ) {
		return $v;
	}
	// Settings saved in the previous theme ("zawaya") carry over until saved again here.
	static $old = null;
	if ( null === $old ) {
		$old = get_option( 'theme_mods_zawaya', array() );
		$old = is_array( $old ) ? $old : array();
	}
	return array_key_exists( 'zw_' . $key, $old ) ? $old[ 'zw_' . $key ] : $def;""", 'zw_opt')
wr(OUT / 'inc/helpers.php', h)

c = rd(OUT / 'inc/contact.php')
c = sub1(c, "	$message = sanitize_textarea_field( wp_unslash( $_POST['zw_message'] ?? '' ) );\n",
"""	$message = sanitize_textarea_field( wp_unslash( $_POST['zw_message'] ?? '' ) );
	// Extra booking fields from the v2 contact form (all optional).
	$extra = array();
	foreach ( array( 'zw_venue' => 'القصر المفضّل', 'zw_date' => 'التاريخ المتوقع', 'zw_guests' => 'عدد الضيوف' ) as $k => $label ) {
		$val = sanitize_text_field( wp_unslash( $_POST[ $k ] ?? '' ) );
		if ( '' !== $val ) {
			$extra[] = $label . ': ' . $val;
		}
	}
	if ( $extra ) {
		$message = implode( "\\n", $extra ) . ( '' !== $message ? "\\n\\n" . $message : '' );
	}
""", 'contact extra')
wr(OUT / 'inc/contact.php', c)

d = rd(OUT / 'inc/demo-content.php')
d = sub1(d, """	function () {
		zawaya_run_setup();
		flush_rewrite_rules();
	}""", """	function () {
		// v2: activating the theme must not create demo content; only refresh the permalinks.
		zawaya_register_post_types();
		flush_rewrite_rules();
	}""", 'after_switch_theme')
wr(OUT / 'inc/demo-content.php', d)

e = rd(OUT / 'inc/elementor.php')
e = sub1(e, """	function () {
		$deps = array( 'zawaya-style' );
		if ( is_singular() && zawaya_built_with_elementor( get_queried_object_id() ) && wp_style_is( 'elementor-frontend', 'registered' ) ) {""",
"""	function () {
		// v2: the legacy widget styles are needed only on pages that still render Elementor content.
		if ( ! is_singular() || zv_uses_theme_template() || ! zawaya_built_with_elementor( get_queried_object_id() ) ) {
			return;
		}
		$deps = array( 'zawaya-style' );
		if ( wp_style_is( 'elementor-frontend', 'registered' ) ) {""", 'el enqueue')
e = sub1(e, """		$id = get_queried_object_id();
		// Inside the Elementor editor""", """		if ( zv_uses_theme_template() ) {
			return $template; // v2 templates (home + page-templates/*) win over the Elementor wrapper.
		}
		$id = get_queried_object_id();
		// Inside the Elementor editor""", 'el template_include')
wr(OUT / 'inc/elementor.php', e)

z = rd(OUT / 'inc/zv.php')
z += '''
/**
 * True when the current request is rendered by one of the v2 templates
 * (front page or a page that selected page-templates/*.php) and not in the Elementor editor.
 */
function zv_uses_theme_template() {
	if ( isset( $_GET['elementor-preview'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		return false;
	}
	if ( is_front_page() ) {
		return true;
	}
	$slug = is_singular( 'page' ) ? get_page_template_slug( get_queried_object_id() ) : '';
	return is_string( $slug ) && 0 === strpos( $slug, 'page-templates/' );
}
'''
wr(OUT / 'inc/zv.php', z)

# ---------------------------------------------------------------- 6. templates generated from the preview pages
KEYS = {'index': 'home', 'about': 'about', 'services': 'services', 'portfolio': 'projects', 'contact': 'contact'}
ASSET = '<?php echo esc_url( ZAWAYA_URI ); ?>/assets/'

def split(name):
    t = rd(SITE / f'{name}.html')
    b = (t.index('<body>') + len('<body>')) if '<body>' in t else (t.index('</script>') + len('</script>'))
    m0 = t.index('<main id="main">')
    m1 = t.index('</main>')
    end = t.index('</body>') if '</body>' in t else len(t)
    return t[b:m0].strip(), t[m0 + len('<main id="main">'):m1].strip(), t[m1 + len('</main>'):end].strip()

def links(s, nav):
    def rep(m):
        key = KEYS[m.group(1)]
        cur = f"<?php zv_cur( '{key}' ); ?>" if nav else ''
        return f'<a href="<?php echo esc_url( zv_url( \'{key}\' ) ); ?>{m.group(2) or ""}"{cur}'
    s = re.sub(r'<a href="(index|about|services|portfolio|contact)\.html(#[^"]*)?"( aria-current="page")?', rep, s)
    s = re.sub(r'href="(index|about|services|portfolio|contact)\.html(#[^"]*)?"',
               lambda m: f'href="<?php echo esc_url( zv_url( \'{KEYS[m.group(1)]}\' ) ); ?>{m.group(2) or ""}"', s)
    return s.replace('assets/img/', ASSET + 'img/')

head_html, home_main, foot_html = split('index')
head_html = links(head_html, True)
foot_html = links(foot_html, False)
foot_html = foot_html.replace('<script src="assets/site.js"></script>', '')
foot_html = foot_html.replace('<span id="year">2026</span>', '<span id="year"><?php echo esc_html( gmdate( \'Y\' ) ); ?></span>')
SOC = {'إنستغرام': 'instagram', 'سناب شات': 'snapchat', 'تيك توك': 'tiktok'}
def soc(m):
    key = SOC[m.group(1)]
    return (f'<?php if ( $zv_u = zv_social( \'{key}\' ) ) : ?><a class="soc" href="<?php echo $zv_u; // phpcs:ignore ?>" target="_blank" rel="noopener" aria-label="{m.group(1)}">{m.group(2)}</a><?php endif; ?>')
foot_html, n = re.subn(r'<a class="soc" href="#" aria-label="([^"]*?) \(أضف الرابط\)">(.*?)</a>', soc, foot_html, flags=re.S)
assert n == 3, f'social placeholders: {n}'

wr(OUT / 'header.php', f'''<?php
/**
 * Header (v2): top bar, centred logo with split navigation, full-screen mobile menu.
 *
 * @package zawaya
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php if ( ! has_site_icon() ) : ?><link rel="icon" href="<?php echo esc_url( zw_img( 'logo-v.png' ) ); ?>"><?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
{head_html}
<main id="main">
''')
wr(OUT / 'footer.php', f'''<?php
/**
 * Footer (v2): booking band + four-column footer.
 *
 * @package zawaya
 */
?>
</main>
{foot_html}
<?php wp_footer(); ?>
</body>
</html>
''')

def template(fname, label, body, pre=''):
    top = f'<?php\n/**\n * Template Name: {label}\n *\n * @package zawaya\n */\n{pre}\nget_header();\n?>\n' if label else '<?php\n/**\n * Home page.\n *\n * @package zawaya\n */\n\nget_header();\n?>\n'
    wr(OUT / fname, top + body + '\n<?php\nget_footer();\n')

template('front-page.php', '', links(home_main, False))

_, about_main, _ = split('about'); template('page-templates/about.php', 'من نحن', links(about_main, False))
_, svc_main, _ = split('services'); template('page-templates/services.php', 'خدماتنا', links(svc_main, False))

_, prj_main, _ = split('portfolio')
prj_php = '''<?php $zv_ps = zw_projects(); ?>
<?php if ( $zv_ps ) : ?>
<section class="sec" id="venues">
  <div class="wrap">
    <div class="head reveal"><h2>قصورنا وشركاتنا</h2></div>
    <div class="plist">
      <?php foreach ( $zv_ps as $zv_p ) : ?>
        <article class="pcard reveal">
          <span class="logo"><img src="<?php echo esc_url( zw_project_logo( $zv_p->ID, 'medium' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $zv_p ) ); ?>" loading="lazy"></span>
          <h3><?php echo esc_html( get_the_title( $zv_p ) ); ?></h3>
          <?php $zv_type = get_post_meta( $zv_p->ID, '_zw_type', true ); ?>
          <?php if ( $zv_type ) : ?><span class="dist"><?php echo esc_html( $zv_type ); ?></span><?php endif; ?>
          <p><?php echo esc_html( wp_trim_words( has_excerpt( $zv_p ) ? get_the_excerpt( $zv_p ) : wp_strip_all_tags( $zv_p->post_content ), 26, '…' ) ); ?></p>
          <div class="btns">
            <a class="btn btn-navy btn-sm" href="<?php echo esc_url( get_permalink( $zv_p ) ); ?>">عرض التفاصيل</a>
            <a class="btn btn-line btn-sm" href="<?php echo esc_url( zv_url( 'contact' ) ); ?>"><?php echo esc_html( zw_cta( $zv_p->ID ) ); ?></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>'''
prj_main, n = re.subn(r'<!--ZV:PROJECTS-->.*?<!--/ZV:PROJECTS-->', lambda m: prj_php, prj_main, flags=re.S)
assert n == 1
template('page-templates/projects.php', 'مشاريعنا', links(prj_main, False))

_, ct_main, _ = split('contact')
form_open = '<form id="booking" novalidate>'
assert form_open in ct_main
ct_main = ct_main.replace(form_open, '''<span id="contact-form"></span>
      <form id="booking" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
        <input type="hidden" name="action" value="zw_contact">
        <?php wp_nonce_field( 'zw_contact', 'zw_contact_nonce' ); ?>
        <div aria-hidden="true" style="position:absolute;inset-inline-start:-9999px"><label>الموقع<input type="text" name="zw_website" tabindex="-1" autocomplete="off"></label></div>''')
for a, b in [('name="name"', 'name="zw_name"'), ('name="phone"', 'name="zw_phone"'), ('name="kind"', 'name="zw_kind"'),
             ('name="venue"', 'name="zw_venue"'), ('name="date"', 'name="zw_date"'), ('name="guests"', 'name="zw_guests"'), ('name="msg"', 'name="zw_message"')]:
    assert a in ct_main, a
    ct_main = ct_main.replace(a, b)
ct_main = ct_main.replace('<option>', '<option>')  # values equal the visible text, as before
ct_main = re.sub(r'<div class="ok" id="form-ok" role="status" hidden>(.*?)<span>.*?</span></div>',
    r'''<div class="ok" id="form-ok" role="status"<?php echo $zw_sent ? '' : ' hidden'; ?>>\1<span>وصلنا طلبك، شكراً لتواصلك. سيتواصل معك فريقنا في أقرب وقت.</span></div>
      <?php if ( $zw_err && isset( $zw_errs[ $zw_err ] ) ) : ?><div class="formerr" role="alert"><?php echo esc_html( $zw_errs[ $zw_err ] ); ?></div><?php endif; ?>''', ct_main, flags=re.S, count=1)
assert 'zw_sent' in ct_main
pre = '''
$zw_sent = isset( $_GET['zw_sent'] ); // phpcs:ignore WordPress.Security.NonceVerification
$zw_err  = isset( $_GET['zw_err'] ) ? sanitize_key( $_GET['zw_err'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$zw_errs = array(
	'fields'  => 'الرجاء كتابة الاسم ورقم الجوال أو البريد الإلكتروني.',
	'expired' => 'انتهت صلاحية الصفحة، حدّثها ثم أعد الإرسال.',
	'limit'   => 'أرسلت عدة رسائل خلال وقت قصير، حاول بعد قليل أو تواصل معنا هاتفياً.',
);
'''
template('page-templates/contact.php', 'تواصل معنا', links(ct_main, False), pre)

# the old widget form keeps working (template-parts/contact-form.php is untouched)

# ---------------------------------------------------------------- 7. lint + zip
bad = 0
for f in OUT.rglob('*.php'):
    r = subprocess.run(['php', '-l', str(f)], capture_output=True, text=True)
    if r.returncode: bad += 1; print(r.stdout, r.stderr)
assert not bad, 'PHP lint failed'
if ZIP.exists(): ZIP.unlink()
with zipfile.ZipFile(ZIP, 'w', zipfile.ZIP_DEFLATED) as z:
    for f in sorted(OUT.rglob('*')):
        if f.is_file(): z.write(f, f'zawaya-v2/{f.relative_to(OUT)}')
print('theme built:', OUT, '|', ZIP, f'{ZIP.stat().st_size/1024:.0f} KB')
