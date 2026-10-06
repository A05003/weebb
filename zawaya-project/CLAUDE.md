# Zawaya Al Maali — website redesign (handoff)

Owner writes in Arabic, Saudi dialect; reply in that dialect. Company: شركة زوايا المعالي للأفراح والمناسبات. It runs 5 wedding palaces in Riyadh, plus مطاعم زوايا المعالي (catering) and a tech/AV team.
Live site: https://zawayaalmaali.com (WordPress on Hostinger, custom theme "zawaya" + Elementor).
**Never change the live site without the owner's explicit OK.** He reviews a preview first.

## Folder layout
- `site/` — static preview (5 pages: index, about, services, portfolio, contact; assets/site.css, site.js, img/). The current version is v4.
- `sitebuild/build.py` — generates the 5 pages from a shared header and footer. Run it with `python3 sitebuild/build.py` (OUT already points to ../site).
- `zawaya-elementor.zip` — the theme currently installed on the live site (v1.1.1), already converted to Elementor.

## Brand
- Navy #18203b, gold #e5ad83. Content language: Arabic, RTL.
- Font: **SF Pro AR**, the same font as almaalicatering.com. It is used through the Blocksy custom font `ct_font_rahyb_font`, with two files:
  - `alfont_com_SFProAR_regular.ttf` (400/500)
  - `alfont_com_SFProAR_semibold.ttf` (600/700)
  - Both are on the owner's Hostinger in the almaalicatering.com mirror (search the File Manager for "alfont_com_SFProAR").
  - Put them in `site/assets/fonts/` and use @font-face. Until then the fallback is Noto Sans Arabic.
  - The owner said "the Arabic font did not change", so the real files are required.
- Patterns borrowed from almaalicatering.com:
  - leaf corners: two opposite corners rounded, e.g. `border-radius: 28px 0`
  - dashed gold rules: `rgba(229,173,131,.45)`
  - headings at weight 400
  - about section in 3 columns: story | photo | vision & mission
  - service cards built from a photo with a dark overlay
- Interactions inspired by omq.sa.com: reveal on scroll, counters, tilt, smooth transitions. Respect `prefers-reduced-motion`.

## Contact
- Phone 0570001853 · WhatsApp https://api.whatsapp.com/send/?phone=966570001853
- Email info@zawayaalmaali.com
- Address: الرياض، حي نمار، طريق ديراب · Maps https://maps.app.goo.gl/ojz2gjjTVpB4kJrt7
- Leadership: عبدالله علي صالح الفقيه (المدير التنفيذي), صالح مطيع الفقيه (المدير العام), بدر الفقيه (نائب المدير التنفيذي)

## Owner's latest request (2026-10-06): BUILT in preview v5 (not yet approved)
"احذف الخانات الغير مهمه للشركة واجعل الهوية واضحه وبدون تشتت والخط العربي لم يتم تغييره وغير فكرة رؤوس الصفحات والاسفل واضف صور ولو تكون خارجيه واضف التعليقات ال5 نجوم حق القاعات جميعها في الاراء اضف الحديثه من كل المواقع واجعل الموقع غير ممل"

In short:
- Remove the sections that don't matter to the company and make the identity clear, without distractions.
- The Arabic font still hasn't changed.
- Change the idea of the page headers and the footer.
- Add images, even external ones.
- Fill the reviews section with the 5-star reviews of all the halls, the most recent ones from every site.
- Make the site less boring.

Agreed plan (implemented in site/ v5; images are local only, reviews are translated Google excerpts, SF Pro AR files still missing):
1. **Remove**:
   - star canvas, glows, orbits, cursor light, the "browser mock" in the hero, and the pulse badge (all SaaS leftovers)
   - the FAQ (Claude wrote it)
   - the 6 generic "values" cards
   - the "how we work" steps
   - every placeholder: leader bios, working hours, empty gallery tiles
2. **Identity**:
   - Use real navy (#18203b) as the base, not near-black.
   - Alternate with pearl sections (#f7f3ee) for rhythm.
   - One motif only: leaf corners plus a dashed gold rule.
3. **New header**:
   - A slim top bar: phone, WhatsApp, location, socials.
   - Below it, a centered logo with the nav split on both sides and a "احجز" button. It shrinks on scroll.
   - On mobile: a full-screen navy menu.
4. **New footer**:
   - A gold "book now" band with a big phone number and WhatsApp.
   - A navy footer with 4 columns: brand + socials, our 5 palaces (each linking to Google Maps), services, contact.
   - A bottom copyright bar.
5. **Home order**:
   1. hero crossfade slideshow (Ken Burns) with the venue logos row
   2. stats strip (23,578 clients · 13,533 events · +250 staff · 5 palaces)
   3. about in 3 columns
   4. 3 photo service cards
   5. 5 venue cards (logo, district, capacity, Google rating, map link)
   6. reviews carousel
   7. gallery strip
6. **Images**:
   - The preview (claude.ai artifact) cannot load external images.
   - On a real host or the live site, external images are fine. Prefer the owner's own photos from the WordPress media library or almaalicatering.com.
   - Local photos: hero.jpg, about-main.jpg, about-hall.jpg, about-hospitality.jpg, about-banner.jpg, plus venue logos lg-*.png.
7. **Reviews**:
   - The data below comes from Google Places. It has no star rating or date per review.
   - On the live site, install a Google-reviews plugin (e.g. "Widgets for Google Reviews" by Trustindex), filtered to 5 stars and sorted newest first, so the reviews update automatically.
   - Label quotes "مترجم من تقييمات Google".

## Venue data (Google Places, fetched 2026-10-06)
| Venue | District | Google rating | # reviews | place_id | Positive quotes (English as returned) |
|---|---|---|---|---|---|
| قصر الماسة | الجنادرية | 4.4 | 1,168 | ChIJFxXQuahVLj4RgLuvd6L65zg | "It's A wedding venue, Very Big Hall & Dining, Parking also specious" |
| قصر روعة الملتقى (High Hall Forum) | المعيزيلة | 4.2 | 2,058 | ChIJz4SgnpCqLz4RfZI4qZWblVg | "Great service and value for money." / "I had a happy experience visiting a friend wedding and five star for my experience" |
| قاعة المودة | العوالي (*confirm it is theirs*) | 4.1 | 2,284 | ChIJAeKfYLEQLz4R-v-M_03KlTo | "Very nice and clean." / "Beautiful night" |
| قصر ليالي الديار | الحزم | 4.4 | 1,347 | ChIJr0Da5okRLz4RU4TXX8BSoDk | "Very good overall. The services are excellent, and the parking area is spacious… the staff is very professional, and I have no complaints whatsoever." / "Great place, well organized, good management staff" / "Amazing place and good for big events." |
| قاعة هيليون بالاس | بدر (*confirm*) | 4.3 | 1,432 | ChIJUevfTG8OLz4RV881J2weL3c | "Very good place for gathering 🌹" / "Nice place for party and wedding" |

- Total: 8,289 Google reviews, weighted average ≈ 4.25.
- Map link format: `https://www.google.com/maps/search/?api=1&query=<name>&query_place_id=<place_id>`
- Capacities (from the owner's old site):
  - الماسة: 350–400 per section, with a garden.
  - الملتقى: up to 400 women, dining hall for 450.
  - مودة: up to 450, with a زفة staircase.
  - ليالي الديار and هيلون: halls with no columns.

## Still missing from the owner
- The SF Pro AR font files
- Photos: buffet, Gobo, Touchpix, كوشة, palaces
- Social media links
- Working hours
- Leader bios


## Deployment status (2026-10-06): theme 2.0.1 was deployed, then ROLLED BACK at the owner's request (live site = v1.1.1 again)
- The owner approved deploying directly. Theme source: `theme/zawaya/` (v2.0.1). Uploaded in place to `wp-content/themes/zawaya/` through the Hostinger TUS upload API (`hosting_files_generate-upload-url`, user `u918801698`, domain `zawayaalmaali.com`). Same slug on purpose, so Customizer settings (logo, hero text, socials) are kept.
- New: v5 header/footer (top bar, centred logo with split nav, full-screen mobile menu, gold booking band, 4-column footer, link to almaalicatering.com), `assets/css/v5.css`, `assets/js/v5.js`, widgets `zawaya-venues` (logos strip or cards with Google rating and map link) and `zawaya-reviews`, new home layout, palette navy #18203B / gold #E5AD83 / pearl #F7F3EE.
- Only the home page (id 11) was rebuilt from the new layout (it ran once, as an administrator, via `zawaya_v5_maybe_apply()` in `inc/elementor.php`). About, services, projects and contact keep their content and only got the new styling and header/footer.
- Rollback: the original v1.1.1 theme is `zawaya-elementor.zip`; re-upload its files over `wp-content/themes/zawaya/`. The original home data is in post meta `_zawaya_el_backup` of page 11 (only the first backup is kept); copy it back to `_elementor_data`.
- LiteSpeed lazy-load swaps images late; images that must show up front use `class="skip-lazy" data-no-lazy="1"`.
- Still missing from the owner: SF Pro AR font files (fallback Tajawal is bundled), real palace/buffet/tech photos, social links, working hours.
- The 21st MCP server (`.mcp.json`) needs `API_KEY_21ST` and authorization.

### Rollback done (2026-10-06, owner request)
- Home page (id 11) data restored from `_zawaya_el_backup`; all theme files re-uploaded from the owner's `zawaya-elementor_2.zip` (identical to v1.1.1). Pages, menus and Customizer settings are untouched.
- Leftovers on the server, harmless and unused by v1.1.1: files `inc/v5-data.php`, `assets/css/v5.css`, `assets/js/v5.js`; options `zawaya_v5_done`, `zawaya_v5_applied`, `zw_restore_done`; Elementor Saved Templates created for the home page by the v2 import.
- The v2.0.1 source stays in `theme/zawaya/` in this repo, not deployed.

### Live theme 1.2.1 (2026-10-06) = v1.1.1 + motion + hall reviews (source in `theme-live/zawaya/`)
- Motion from almaalicatering.com (Elementor entrance fadeInUp/Left/Right at 1.2s, highlighted headline with a double underline redrawn every 8s) plus feedback motion (button press/hover, card lift, magnetic buttons, reading-progress bar via CSS scroll-driven animation). Files: `assets/css/motion-v2.css`, `assets/js/motion-v2.js`. Respects `prefers-reduced-motion`. LiteSpeed delays JS until the first interaction; the script skips anything already on screen then. Old unused `motion.css` / `motion.js` are still on the server.
- Per-hall Google rating and positive reviews on each project page: `inc/project-reviews.php`, `assets/css/project-reviews.css`; editable in the project edit screen (reviews, rating, count, place_id), defaults by slug (almasa, multaqa, mawadda, diyar, helon). A rating chip also shows in the projects list.
- Wording rule from the owner: never state a number of palaces ("five"); say we operate the halls ("نشغّل القاعات"). The projects page excerpt (page 16) was updated accordingly.

- Restaurant project (slug `maali`) shows a "الموقع الإلكتروني" button linking to https://almaalicatering.com on its page and in the projects list (`inc/project-site.php`; editable per project in the edit screen). Theme 1.2.2.

- Theme 1.3.0: all projects (halls, restaurants, contractor) live together on the projects page, each block with details, rating and reviews, website button and gallery. Single project URLs 301-redirect to `/projects/#slug` (`zawaya_projects_redirect()` in `inc/project-reviews.php`); the single template stays as a fallback. Owner chose this on 2026-10-06.

- Theme 1.4.1: day/night button now toggles instantly via an inline onclick (LiteSpeed delays scripts until the first touch, so the old handler lost the first click); `assets/js/main-v2.js` skips buttons with `data-zw-inline`; sun/moon icon is pure CSS. `assets/css/look-v2.css`: beige day mode (page and Elementor section colours), leaf-corner buttons with a soft sheen and press feedback, glass header with an animated dashed underline. Dark colours are untouched.

- Theme 1.5.1: real gold (#C9A227, brighter #E2BC3F in dark; gradient on gold buttons), font switched to SF Pro AR (files in `assets/fonts/`, `tajawal-v2.css` defines it; Tajawal is the fallback), projects page: tabs removed and replaced by a service-style flip-card carousel with arrows that jump to each project (`prj-nav` in `zw_render_projects_list`), beige leaf-corner project blocks, scroll/hover motion. All in `assets/css/look-v3.css`. Page 16 excerpt reworded. Headless checks need ~9 s to pass the Hostinger browser check.
