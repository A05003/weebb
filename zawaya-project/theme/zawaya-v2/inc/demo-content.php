<?php
/**
 * First-time setup: creates the pages, menus, projects, services and sample
 * posts of the current zawayaalmaali.com site, once, when the theme is activated.
 * Nothing existing is overwritten.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function zawaya_demo_projects() {
	return array(
		array(
			'slug'  => 'multaqa',
			'title' => 'قصر روعة الملتقى للاحتفالات والمؤتمرات',
			'short' => 'روعة الملتقى',
			'type'  => 'قصر أفراح ومؤتمرات',
			'logo'  => 'lg-multaqa.png',
			'cover' => 'hero.jpg',
			'card'  => 'قصر مخصص لحفلات الأعراس والمناسبات، يجمع بين الفخامة وحسن التنظيم، ويقدم تجربة متكاملة تشمل التنسيق والضيافة وتجهيز القاعات بما يليق بضيوفه.',
			'about' => 'يقع قصر روعة الملتقى في حي المعيزيلة شرق الرياض، خلف طريق الشيخ جابر الأحمد الصباح، في موقع يسهل الوصول إليه. يجمع القصر بين الديكور الفخم والتنظيم المتقن، ويستقبل حفلات الزفاف والملكة والتخرج إلى جانب المؤتمرات والمعارض.',
			'facts' => "الموقع | حي المعيزيلة، شرق الرياض\nقسم الرجال | حتى 300 ضيف\nقسم النساء | حتى 400 ضيفة\nصالة الطعام | حتى 450 شخص",
			'feat'  => "قاعتان منفصلتان للرجال والنساء\nصالة طعام بنظام البوفيه المفتوح\nطبخ داخلي للذبائح\nبوفيه نسائي متنوع\nقهوجي لخدمة الضيوف\nديكور وأثاث فاخر",
			'phone' => '0558366639',
			'link'  => 'https://linktr.ee/multqa.sa',
			'cta'   => 'احجز الآن',
		),
		array(
			'slug'  => 'almasa',
			'title' => 'قصر الألماسة للاحتفالات والمؤتمرات',
			'short' => 'قصر الألماسة',
			'type'  => 'قصر أفراح ومؤتمرات',
			'logo'  => 'lg-almasa.png',
			'card'  => 'قصر أفراح ومناسبات بتصاميم راقية وقاعات رحبة، يوفر خدمات الاستقبال والضيافة والتنسيق لتكون كل مناسبة مميزة من بدايتها حتى نهايتها.',
			'about' => 'قصر أفراح يتميز باتساع صالاته وديكوره العصري الفاخر، ويستقبل مختلف المناسبات من حفلات الزفاف والملكة إلى التخرج وأعياد الميلاد. يضم القصر صالتين مجهزتين بالكامل للرجال والنساء، إضافة إلى حديقة خارجية يمكن تجهيزها لاستقبال الضيوف.',
			'facts' => "الموقع | حي الجنادرية، الرياض\nقسم الرجال | 350 – 400 ضيف\nقسم النساء | 350 – 400 ضيفة\nمساحات إضافية | حديقة خارجية",
			'feat'  => "صالتان منفصلتان للرجال والنساء\nحديقة خارجية للاستقبال\nديكور عصري فاخر\nتجهيز كامل لحفلات الزفاف والملكة\nمناسب للتخرج والمناسبات العائلية",
			'phone' => '',
			'link'  => 'https://linktr.ee/masaah.sa',
			'cta'   => 'احجز الآن',
		),
		array(
			'slug'  => 'mawadda',
			'title' => 'قصر مودة للاحتفالات والمؤتمرات',
			'short' => 'قصر مودة',
			'type'  => 'قاعة احتفالات ومؤتمرات',
			'logo'  => 'lg-mawadda.png',
			'card'  => 'قاعة للاحتفالات والمؤتمرات تناسب المناسبات العائلية وفعاليات الأعمال، بتجهيزات حديثة ومرونة في التنسيق بحسب حجم المناسبة وطبيعتها.',
			'about' => 'تقع قاعة مودة في ظهرة نمار غرب الرياض على شارع نجم الدين الأيوبي، وتجمع بين الاتساع والتنظيم والخدمات المتكاملة. يمزج تصميمها بين الطابع العصري والكلاسيكي، بمدخل عالٍ وأعمدة فخمة، وصالة نساء بسقف مرتفع وثريات ذهبية ودرج للزفة يتصل بممر رخامي حتى منصة الكوشة.',
			'facts' => "الموقع | ظهرة نمار، غرب الرياض\nقسم الرجال | حتى 350 ضيف\nقسم النساء | حتى 450 ضيفة\nصالة الطعام | 400 – 450 شخص",
			'feat'  => "قسمان منفصلان للرجال والنساء\nدرج للزفة وممر للعروس\nغرفة خاصة للعروس\nصالة طعام مستقلة\nإضاءة وثريات مميزة\nمناسبة للمناسبات العائلية وفعاليات الأعمال",
			'phone' => '',
			'link'  => 'https://linktr.ee/Mawadh.sa',
			'cta'   => 'احجز الآن',
		),
		array(
			'slug'  => 'helon',
			'title' => 'قصر هيلون بالاس للاحتفالات والمناسبات',
			'short' => 'هيلون بالاس',
			'type'  => 'قصر أفراح ومؤتمرات',
			'logo'  => 'lg-helon.png',
			'card'  => 'قصر للاحتفالات والمؤتمرات بطابع عصري فاخر، مهيأ لاستضافة حفلات الزفاف والمناسبات الكبرى والمؤتمرات مع خدمات ضيافة وتنسيق متكاملة.',
			'about' => 'يقع قصر هيلون بالاس في حي الشفاء جنوب الرياض، ويتميز بتصميمه العصري الفاخر ومساحاته الرحبة التي تناسب الحفلات الكبيرة. يوفر القصر خدمات متكاملة من الاستقبال والضيافة إلى المؤثرات والأجهزة الصوتية، مع إمكانية إقامة أكثر من حفل في الوقت نفسه.',
			'facts' => "الموقع | حي الشفاء، جنوب الرياض\nقسم الرجال | حتى 350 ضيف\nقسم النساء | حتى 350 ضيفة\nعدد القاعات | قاعتان",
			'feat'  => "مدخل مستقل للعروس ودرج للزفة\nغرفة تجهيز للعروس\nبوفيه طعام ومشروبات ساخنة وباردة\nطهي الذبائح\nليزر وبخار ودي جي\nحراسة أمنية ومواقف سيارات",
			'phone' => '',
			'link'  => 'https://linktr.ee/helon.sa',
			'cta'   => 'احجز الآن',
		),
		array(
			'slug'  => 'diyar',
			'title' => 'قصر ليالي الديار للاحتفالات والمؤتمرات',
			'short' => 'ليالي الديار',
			'type'  => 'قصر أفراح ومؤتمرات',
			'logo'  => 'lg-diyar.png',
			'card'  => 'قصر أفراح ومناسبات يعكس أصالة الضيافة السعودية، ويوفر أجواء مريحة وخدمات متكاملة لإحياء الأعراس والمناسبات العائلية.',
			'about' => 'يقع قصر ليالي الديار في حي الحزم غرب الرياض، ويتميز بطابع كلاسيكي يجمع بين الأصالة والأناقة. قاعاته واسعة خالية من الأعمدة، بسقوف مرتفعة مزينة بالثريات الكريستالية وقناطر مضاءة، ويتوسطها ممر للعروس يبدأ من درج الزفة وينتهي بمسرح واسع.',
			'facts' => "الموقع | حي الحزم، غرب الرياض\nالقاعات | قاعتان منفصلتان\nسعة كل قاعة | أكثر من 150 ضيف\nالطبخ الداخلي | حتى 10 ذبائح",
			'feat'  => "قاعات خالية من الأعمدة\nدرج واسع وشرفة في كل قاعة\nبوفيه نسائي متكامل\nقهوجي محترف\nغرفة تجهيز للعروس\nليزر وبخار",
			'phone' => '0558220533',
			'link'  => 'https://linktr.ee/layali.sa',
			'cta'   => 'احجز الآن',
		),
		array(
			'slug'  => 'maali',
			'title' => 'مطاعم المعالي للبوفيهات المفتوحة والضيافة',
			'short' => 'مطاعم المعالي',
			'type'  => 'بوفيهات مفتوحة وضيافة',
			'logo'  => 'lg-maali-rest.png',
			'card'  => 'متخصصة في البوفيهات المفتوحة والضيافة، تقدم قوائم طعام متنوعة وخدمة احترافية للأعراس والمناسبات والفعاليات بمختلف أحجامها.',
			'about' => 'ذراع الضيافة في مجموعة زوايا المعالي، متخصصة في إعداد البوفيهات المفتوحة وخدمات الإعاشة للأعراس والمناسبات والفعاليات. تعمل المطاعم بطهاة ذوي خبرة وقوائم تجمع بين المطبخ السعودي والعربي والعالمي، مع طاقم تقديم مدرّب يضمن جودة الخدمة من بداية المناسبة حتى نهايتها.',
			'facts' => "التخصص | بوفيهات مفتوحة وإعاشة\nالخدمة | داخل قصور المجموعة وخارجها\nالقوائم | سعودية، عربية، عالمية\nالفئة | أعراس، مناسبات، فعاليات",
			'feat'  => "قوائم طعام متنوعة حسب الطلب\nطهاة ذوو خبرة\nطاقم تقديم وضيافة\nتجهيز أماكن التقديم\nحلويات ومشروبات ساخنة وباردة\nخدمة المناسبات الكبيرة والصغيرة",
			'phone' => '',
			'link'  => '',
			'cta'   => 'اطلب الخدمة',
		),
		array(
			'slug'  => 'manar',
			'title' => 'شركة منار التعمير للمقاولات',
			'short' => 'منار التعمير',
			'type'  => 'مقاولات عامة',
			'logo'  => 'lg-manar.png',
			'card'  => 'شركة مقاولات تتولى أعمال الإنشاء والتشطيب وتجهيز المنشآت والقاعات، وتدعم مشاريع المجموعة بالتنفيذ وفق أعلى معايير الجودة.',
			'about' => 'شركة مقاولات ضمن مجموعة زوايا المعالي، تتولى أعمال الإنشاء والتشطيب والترميم وتجهيز القاعات والمنشآت التجارية. تنقل الشركة خبرة المجموعة في تشغيل القصور إلى مرحلة التنفيذ، فتصمم وتنفذ المساحات بما يخدم التشغيل الفعلي، مع التزام بالجودة والجدول الزمني.',
			'facts' => "التخصص | مقاولات عامة\nالمجالات | إنشاء، تشطيب، ترميم\nالقطاعات | قاعات، منشآت تجارية، سكنية\nالنطاق | الرياض والمناطق المجاورة",
			'feat'  => "أعمال الإنشاءات العامة\nالتشطيبات الداخلية والخارجية\nتجهيز قاعات الأفراح والمناسبات\nأعمال الترميم والتطوير\nالإشراف على التنفيذ\nالتزام بالجودة والمواعيد",
			'phone' => '',
			'link'  => '',
			'cta'   => 'اطلب عرض سعر',
		),
	);
}

function zawaya_demo_services() {
	return array(
		array(
			'title' => 'التغطيات الميدانية الإعلامية للمناسبات والفعاليات',
			'icon'  => 'fa-solid fa-camera',
			'img'   => 'about-main.jpg',
			'card'  => 'نمتلك في زوايا المعالي للأفراح والمناسبات فريقاً إبداعياً محترفاً يعمل على صناعة التغطيات الإعلامية والميدانية الاحترافية',
			'body'  => 'نمتلك في زوايا المعالي للأفراح والمناسبات فريقاً إبداعياً محترفاً يعمل على صناعة التغطيات الإعلامية والميدانية الاحترافية للمناسبات والفعاليات، بما يشمل التصوير الفوتوغرافي والفيديو، إعداد تقارير صحفية، البث المباشر، وإدارة منصات التواصل الاجتماعي لضمان توثيق الحدث ونشره بأفضل صورة ممكنة.',
		),
		array(
			'title' => 'تقديم خدمات الضيافة المتكاملة',
			'icon'  => 'fa-solid fa-mug-hot',
			'img'   => 'about-hospitality.jpg',
			'card'  => 'نقدم في زوايا المعالي للأفراح والمناسبات خدمات ضيافة متكاملة تشمل إعداد وتجهيز الأطعمة والمشروبات، تنظيم بوفيهات فاخرة',
			'body'  => 'نقدم في زوايا المعالي للأفراح والمناسبات خدمات ضيافة متكاملة تشمل إعداد وتجهيز الأطعمة والمشروبات، تنظيم بوفيهات فاخرة، وخدمات تقديم متميزة للضيوف بطاقم متكامل في مختلف المناسبات والفعاليات. ونحرص على تقديم تجربة ضيافة راقية تعكس طابع الحدث، مع فريق محترف يهتم بأدق التفاصيل لضمان راحة الضيوف وترك انطباع لا يُنسى.',
		),
		array(
			'title' => 'تشغيل قصور الأفراح والمناسبات',
			'icon'  => 'fa-solid fa-building',
			'img'   => 'hero.jpg',
			'card'  => 'نعمل في زوايا المعالي للأفراح والمناسبات على إدارة وتشغيل قصور الأفراح والمناسبات من خلال توفير خدمات متكاملة',
			'body'  => 'نعمل في زوايا المعالي للأفراح والمناسبات على إدارة وتشغيل قصور الأفراح والمناسبات من خلال توفير خدمات متكاملة تشمل تنظيم الحفلات، مع الإشراف على التجهيزات الفنية والتقنية، وتقديم الضيافة، وتنسيق الديكور، وإدارة جميع التفاصيل اللوجستية لضمان تجربة فاخرة ومتميزة.',
		),
		array(
			'title' => 'تصميم الديكور والتنسيقات الخاصة بالمناسبات والفعاليات',
			'icon'  => 'fa-solid fa-wand-magic-sparkles',
			'img'   => 'about-hall.jpg',
			'card'  => 'نقدم في زوايا المعالي للأفراح والمناسبات خدمات تصميم ديكور والتنسيقات الفاخرة والجذابة التي تناسب مختلف الأذواق',
			'body'  => 'نقدم في زوايا المعالي للأفراح والمناسبات خدمات تصميم ديكور والتنسيقات الفاخرة والجذابة التي تناسب مختلف الأذواق وجميع أنواع المناسبات والفعاليات، مع الاهتمام بأدق التفاصيل من اختيار الألوان والزهور إلى تنسيق الأثاث والإضاءة. حيث نحرص على تصميم مساحات تعكس هوية الحدث وتجمع بين الفخامة والابتكار مما يضمن تجربة مميزة تترك انطباعًا لا يُنسى.',
		),
	);
}

function zawaya_demo_posts() {
	return array(
		array(
			'title' => 'كيف تختار قاعة الأفراح المناسبة لمناسبتك',
			'cat'   => 'قاعات',
			'img'   => 'about-hall.jpg',
			'ex'    => 'عدد الضيوف والموقع ومواقف السيارات والخدمات المشمولة في الحجز، أهم ما يجب مراجعته قبل اختيار القاعة.',
			'body'  => "<!-- wp:paragraph -->\n<p>اختيار القاعة هو أول قرار كبير في التخطيط لأي مناسبة، وكل ما بعده يُبنى عليه. قبل الحجز راجع هذه النقاط مع فريق القاعة.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>عدد الضيوف والسعة</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>اعرف العدد التقريبي للضيوف في قسمي الرجال والنساء، واسأل عن السعة الفعلية لكل قسم ولصالة الطعام، لا السعة القصوى فقط.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>الموقع ومواقف السيارات</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>قاعة يسهل الوصول إليها مع مواقف كافية توفّر على ضيوفك الكثير من الوقت والعناء، خصوصاً في المناسبات الكبيرة.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>الخدمات المشمولة في الحجز</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>اسأل بوضوح عمّا يشمله السعر: الضيافة، البوفيه، القهوجي، الإضاءة والصوت، غرفة العروس، وتنسيق الكوشة، حتى تقارن بين العروض بشكل عادل.</p>\n<!-- /wp:paragraph -->",
		),
		array(
			'title' => 'أبرز توجهات تنسيق حفلات الزفاف هذا الموسم',
			'cat'   => 'تنسيق',
			'img'   => 'about-main.jpg',
			'ex'    => 'من الألوان الهادئة إلى الإضاءة الدافئة والزهور الطبيعية، نستعرض أفكاراً تمنح حفلك طابعاً مميزاً.',
			'body'  => "<!-- wp:paragraph -->\n<p>يتجه تنسيق حفلات الزفاف هذا الموسم إلى البساطة الفاخرة: تفاصيل أقل، وجودة أعلى في كل عنصر.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>ألوان هادئة</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>درجات العاجي والبيج والذهبي الخفيف تمنح القاعة دفئاً وأناقة، وتبرز فستان العروس في الصور.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>إضاءة دافئة وزهور طبيعية</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>الإضاءة الصفراء الخافتة مع تنسيقات الزهور الطبيعية على الطاولات وممر العروس تصنع أجواء رومانسية دون مبالغة.</p>\n<!-- /wp:paragraph -->",
		),
		array(
			'title' => 'دليلك لتخطيط بوفيه مفتوح ناجح',
			'cat'   => 'ضيافة',
			'img'   => 'about-hospitality.jpg',
			'ex'    => 'كيف تقدّر الكميات وتنوّع القائمة وتنظم أماكن التقديم ليحظى كل ضيف بتجربة مريحة.',
			'body'  => "<!-- wp:paragraph -->\n<p>البوفيه المفتوح من أكثر ما يتذكره الضيوف بعد المناسبة. التخطيط الجيد له يبدأ مبكراً.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>تقدير الكميات</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>احسب الكميات على أساس العدد المؤكد للضيوف مع هامش بسيط، وناقش مع فريق الضيافة توزيع الأطباق بين الأصناف الرئيسية والجانبية والحلويات.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>تنوع القائمة</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>اجمع بين المطبخ السعودي والعربي والعالمي، وخصص خيارات خفيفة للأطفال وكبار السن.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:heading -->\n<h2>تنظيم أماكن التقديم</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>وزّع محطات التقديم بحيث لا تتكون طوابير طويلة، ووفّر طاقم تقديم يساعد الضيوف ويحافظ على ترتيب البوفيه طوال المناسبة.</p>\n<!-- /wp:paragraph -->",
		),
	);
}

/** Copy a bundled image into the media library. */
function zawaya_import_image( $rel_path, $parent = 0, $title = '' ) {
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$src = ZAWAYA_DIR . '/' . ltrim( $rel_path, '/' );
	if ( ! file_exists( $src ) ) {
		return 0;
	}
	$tmp = wp_tempnam( basename( $src ) );
	if ( ! $tmp || ! copy( $src, $tmp ) ) {
		return 0;
	}
	$file = array(
		'name'     => 'zawaya-' . basename( $src ),
		'tmp_name' => $tmp,
	);
	$id = media_handle_sideload( $file, $parent, $title );
	if ( is_wp_error( $id ) ) {
		@unlink( $tmp ); // phpcs:ignore
		return 0;
	}
	return (int) $id;
}

/** Cache imported images so the same file isn't imported twice in one run. */
function zawaya_image_once( $rel_path, $parent = 0 ) {
	static $cache = array();
	if ( ! isset( $cache[ $rel_path ] ) ) {
		$cache[ $rel_path ] = zawaya_import_image( $rel_path, $parent );
	}
	return $cache[ $rel_path ];
}

function zawaya_ensure_page( $slug, $title, $template = '', $excerpt = '', $image = '' ) {
	$p = get_page_by_path( $slug );
	if ( $p ) {
		return $p->ID;
	}
	$id = wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_excerpt' => $excerpt,
			'post_content' => '',
		)
	);
	if ( $id && $template ) {
		update_post_meta( $id, '_wp_page_template', $template );
	}
	if ( $id && $image ) {
		$img = zawaya_image_once( 'assets/img/' . $image, $id );
		if ( $img ) {
			set_post_thumbnail( $id, $img );
		}
	}
	return $id;
}

function zawaya_run_setup() {
	if ( get_option( 'zawaya_setup_done' ) ) {
		return;
	}
	@set_time_limit( 300 ); // phpcs:ignore

	// Pages (same URLs as the old site).
	$home     = zawaya_ensure_page( 'home', 'الرئيسية' );
	$about    = zawaya_ensure_page( 'about-us', 'من نحن', 'page-templates/about.php', 'زوايا المعالي للأفراح والمناسبات، خبرة في إدارة وتشغيل قصور الأفراح وخدمات التنسيق والضيافة.', 'about-banner.jpg' );
	$services = zawaya_ensure_page( 'services', 'خدماتنا', 'page-templates/services.php', 'خدمات متكاملة لإقامة الأفراح والمناسبات والفعاليات، من تشغيل القاعات حتى الضيافة والتغطية الإعلامية.', 'about-hospitality.jpg' );
	$projects = zawaya_ensure_page( 'projects', 'مشاريعنا', 'page-templates/projects.php', 'قصور وقاعات وشركات تعمل تحت مظلة زوايا المعالي للأفراح والمناسبات.', 'hero.jpg' );
	$blog     = zawaya_ensure_page( 'blog', 'المدونة', '', 'مقالات ونصائح في تنظيم الأفراح والمناسبات والتنسيق والضيافة.' );
	$contact  = zawaya_ensure_page( 'contact-us', 'تواصل معنا', 'page-templates/contact.php', 'يسعدنا استقبال استفساراتكم وطلباتكم، وسيتواصل معكم فريقنا في أقرب وقت.', 'about-main.jpg' );

	if ( 'page' !== get_option( 'show_on_front' ) || ! get_option( 'page_on_front' ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home );
		update_option( 'page_for_posts', $blog );
	} elseif ( ! get_option( 'page_for_posts' ) ) {
		update_option( 'page_for_posts', $blog );
	}

	// Projects.
	if ( ! get_posts( array( 'post_type' => 'zawaya_project', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) {
		$order = 1;
		foreach ( zawaya_demo_projects() as $p ) {
			$id = wp_insert_post(
				array(
					'post_type'    => 'zawaya_project',
					'post_status'  => 'publish',
					'post_title'   => $p['title'],
					'post_name'    => $p['slug'],
					'post_excerpt' => $p['card'],
					'post_content' => "<!-- wp:paragraph -->\n<p>" . $p['about'] . "</p>\n<!-- /wp:paragraph -->",
					'menu_order'   => $order++,
				)
			);
			if ( ! $id || is_wp_error( $id ) ) {
				continue;
			}
			update_post_meta( $id, '_zw_short', $p['short'] );
			update_post_meta( $id, '_zw_type', $p['type'] );
			update_post_meta( $id, '_zw_facts', $p['facts'] );
			update_post_meta( $id, '_zw_features', $p['feat'] );
			update_post_meta( $id, '_zw_phone', $p['phone'] );
			update_post_meta( $id, '_zw_link', $p['link'] );
			update_post_meta( $id, '_zw_cta', $p['cta'] );
			$logo = zawaya_import_image( 'demo/logos/' . $p['logo'], $id, $p['short'] );
			if ( $logo ) {
				set_post_thumbnail( $id, $logo );
			}
			if ( ! empty( $p['cover'] ) ) {
				$c = zawaya_image_once( 'assets/img/' . $p['cover'], $id );
				if ( $c ) {
					update_post_meta( $id, '_zw_cover', $c );
				}
			}
		}
	}

	// Services.
	if ( ! get_posts( array( 'post_type' => 'zawaya_service', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) {
		$order = 1;
		foreach ( zawaya_demo_services() as $s ) {
			$id = wp_insert_post(
				array(
					'post_type'    => 'zawaya_service',
					'post_status'  => 'publish',
					'post_title'   => $s['title'],
					'post_excerpt' => $s['card'],
					'post_content' => "<!-- wp:paragraph -->\n<p>" . $s['body'] . "</p>\n<!-- /wp:paragraph -->",
					'menu_order'   => $order++,
				)
			);
			if ( ! $id || is_wp_error( $id ) ) {
				continue;
			}
			update_post_meta( $id, '_zw_icon', $s['icon'] );
			$img = zawaya_image_once( 'assets/img/' . $s['img'], $id );
			if ( $img ) {
				set_post_thumbnail( $id, $img );
			}
		}
	}

	// Blog posts (only on a fresh site).
	$sample = get_page_by_path( 'hello-world', OBJECT, 'post' );
	if ( $sample && false !== strpos( $sample->post_content, 'Welcome to WordPress' ) ) {
		wp_trash_post( $sample->ID );
	}
	$existing = get_posts( array( 'post_type' => 'post', 'posts_per_page' => 1, 'post_status' => 'publish' ) );
	if ( ! $existing ) {
		$time = time();
		foreach ( zawaya_demo_posts() as $i => $p ) {
			$cat = term_exists( $p['cat'], 'category' );
			if ( ! $cat ) {
				$cat = wp_insert_term( $p['cat'], 'category' );
			}
			$cat_id = is_array( $cat ) ? (int) $cat['term_id'] : (int) $cat;
			$id     = wp_insert_post(
				array(
					'post_type'     => 'post',
					'post_status'   => 'publish',
					'post_title'    => $p['title'],
					'post_excerpt'  => $p['ex'],
					'post_content'  => $p['body'],
					'post_category' => $cat_id ? array( $cat_id ) : array(),
					'comment_status' => 'closed',
					'post_date'     => wp_date( 'Y-m-d H:i:s', $time - ( ( $i + 1 ) * DAY_IN_SECONDS ) ),
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				$img = zawaya_image_once( 'assets/img/' . $p['img'], $id );
				if ( $img ) {
					set_post_thumbnail( $id, $img );
				}
			}
		}
	}

	// Menus.
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( empty( $locations['primary'] ) ) {
		$menu_id = wp_create_nav_menu( 'القائمة الرئيسية' );
		if ( ! is_wp_error( $menu_id ) ) {
			wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'الرئيسية', 'menu-item-url' => home_url( '/' ), 'menu-item-type' => 'custom', 'menu-item-status' => 'publish' ) );
			foreach ( array( $about, $services, $projects, $blog ) as $pid ) {
				wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-object-id' => $pid, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
			}
			$locations['primary'] = $menu_id;
		}
	}
	if ( empty( $locations['footer'] ) ) {
		$menu_id = wp_create_nav_menu( 'روابط سريعة' );
		if ( ! is_wp_error( $menu_id ) ) {
			wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => 'الرئيسية', 'menu-item-url' => home_url( '/' ), 'menu-item-type' => 'custom', 'menu-item-status' => 'publish' ) );
			foreach ( array( $about, $services, $projects, $blog, $contact ) as $pid ) {
				wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-object-id' => $pid, 'menu-item-object' => 'page', 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
			}
			$locations['footer'] = $menu_id;
		}
	}
	set_theme_mod( 'nav_menu_locations', $locations );

	// Pretty permalinks are required for /project/name/ URLs.
	if ( ! get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}
	update_option( 'zawaya_setup_done', ZAWAYA_VER );
	zawaya_register_post_types();
	flush_rewrite_rules();
}

add_action(
	'after_switch_theme',
	function () {
		// v2: activating the theme must not create demo content; only refresh the permalinks.
		zawaya_register_post_types();
		flush_rewrite_rules();
	}
);

/* Manual re-run from the dashboard (Tools → زوايا: إعداد المحتوى). */
add_action(
	'admin_menu',
	function () {
		add_management_page( 'إعداد محتوى زوايا', 'زوايا: إعداد المحتوى', 'manage_options', 'zawaya-setup', 'zawaya_setup_page' );
	}
);
function zawaya_setup_page() {
	if ( isset( $_POST['zw_run'] ) && check_admin_referer( 'zw_run_setup' ) ) {
		delete_option( 'zawaya_setup_done' );
		zawaya_run_setup();
		echo '<div class="notice notice-success"><p>تم. أُنشئ كل ما كان ناقصاً (لا يُستبدل أي محتوى موجود).</p></div>';
	}
	echo '<div class="wrap"><h1>إعداد محتوى قالب زوايا المعالي</h1><p>ينشئ الصفحات والقوائم والمشاريع والخدمات والمقالات التجريبية إذا لم تكن موجودة. لا يحذف ولا يعدّل أي شيء موجود.</p><form method="post">';
	wp_nonce_field( 'zw_run_setup' );
	echo '<p><button class="button button-primary" name="zw_run" value="1">تشغيل الإعداد</button></p></form></div>';
}
