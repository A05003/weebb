<?php
/**
 * Zawaya widgets for Elementor (category "زوايا المعالي").
 * Only things Elementor's free widgets can't do are here; everything else
 * on the pages is made from Elementor's own widgets.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

/** Common base: category, icon keywords, editor detection. */
abstract class Zawaya_Widget_Base extends Widget_Base {
	public function get_categories() {
		return array( 'zawaya' );
	}

	public function get_keywords() {
		return array( 'zawaya', 'زوايا' );
	}

	public function get_style_depends() {
		return array( 'zawaya-style', 'zawaya-fa' );
	}

	public function get_script_depends() {
		return array( 'zawaya-main' );
	}

	protected function is_editor() {
		return \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode();
	}

	/** Grey hint box shown only inside the editor. */
	protected function editor_note( $text ) {
		if ( $this->is_editor() ) {
			echo '<div class="zw-editor-note"><i class="fa-solid fa-circle-info"></i> ' . esc_html( $text ) . '</div>';
		}
	}

	protected function dashboard_hint( $text ) {
		$this->add_control(
			'zw_hint',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html( $text ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			)
		);
	}
}

/* -------------------------------------------------------------------------- */
/* Page banner                                                                 */
/* -------------------------------------------------------------------------- */
class Zawaya_Banner_Widget extends Zawaya_Widget_Base {
	public function get_name() {
		return 'zawaya-banner';
	}

	public function get_title() {
		return 'بانر أعلى الصفحة';
	}

	public function get_icon() {
		return 'eicon-header';
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => 'المحتوى' ) );
		$this->add_control(
			'title',
			array(
				'label'       => 'العنوان',
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'يُؤخذ تلقائياً من عنوان الصفحة',
				'label_block' => true,
			)
		);
		$this->add_control(
			'subtitle',
			array(
				'label'       => 'العبارة تحت العنوان',
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => 'يُؤخذ تلقائياً من مقتطف الصفحة',
			)
		);
		$this->add_control(
			'image',
			array(
				'label'       => 'صورة الخلفية',
				'type'        => Controls_Manager::MEDIA,
				'description' => 'إن تُركت فارغة تُستخدم الصورة البارزة للصفحة.',
			)
		);
		$this->add_control(
			'crumbs',
			array(
				'label'        => 'مسار التنقل (الرئيسية / الصفحة)',
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => 'إظهار',
				'label_off'    => 'إخفاء',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section( 'style', array( 'label' => 'التصميم', 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control(
			'height',
			array(
				'label'      => 'الارتفاع',
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array( 'px' => array( 'min' => 200, 'max' => 900 ) ),
				'default'    => array( 'unit' => 'px', 'size' => 440 ),
				'selectors'  => array( '{{WRAPPER}} .banner' => 'min-height: {{SIZE}}{{UNIT}};' ),
			)
		);
		$this->add_control(
			'shade',
			array(
				'label'     => 'لون التظليل فوق الصورة',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .banner-shade' => 'background: {{VALUE}};' ),
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => 'لون العنوان',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .banner h1' => 'color: {{VALUE}};' ),
			)
		);
		$this->add_control(
			'sub_color',
			array(
				'label'     => 'لون العبارة',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .banner p' => 'color: {{VALUE}};' ),
			)
		);
		$this->add_control(
			'curve',
			array(
				'label'     => 'إظهار المنحنى السفلي',
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'selectors_dictionary' => array( '' => 'none', 'yes' => 'block' ),
				'selectors' => array( '{{WRAPPER}} .curve' => 'display: {{VALUE}};' ),
			)
		);
		$this->add_control(
			'curve_color',
			array(
				'label'     => 'لون المنحنى (لون القسم التالي)',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .curve path' => 'fill: {{VALUE}};' ),
				'condition' => array( 'curve' => 'yes' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s   = $this->get_settings_for_display();
		$id  = get_the_ID();
		$img = ! empty( $s['image']['url'] ) ? $s['image']['url'] : (string) get_the_post_thumbnail_url( $id, 'full' );
		if ( ! $img ) {
			$img = zw_img( 'hero.jpg' );
		}
		$title = '' !== trim( (string) $s['title'] ) ? $s['title'] : get_the_title( $id );
		$sub   = '' !== trim( (string) $s['subtitle'] ) ? $s['subtitle'] : ( has_excerpt( $id ) ? get_the_excerpt( $id ) : '' );
		echo '<div class="zw-banner' . ( 'yes' === $s['crumbs'] ? '' : ' no-crumbs' ) . '">';
		zw_banner(
			array(
				'title'    => $title,
				'subtitle' => $sub,
				'image'    => $img,
			)
		);
		echo '</div>';
	}
}

/* -------------------------------------------------------------------------- */
/* Flip cards carousel                                                         */
/* -------------------------------------------------------------------------- */
class Zawaya_Flip_Cards_Widget extends Zawaya_Widget_Base {
	public function get_name() {
		return 'zawaya-flip-cards';
	}

	public function get_title() {
		return 'بطاقات قلّابة متحركة';
	}

	public function get_icon() {
		return 'eicon-flip-box';
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => 'البطاقات' ) );

		$r = new Repeater();
		$r->add_control( 'image', array( 'label' => 'الصورة', 'type' => Controls_Manager::MEDIA ) );
		$r->add_control( 'title', array( 'label' => 'العنوان', 'type' => Controls_Manager::TEXT, 'label_block' => true, 'default' => 'عنوان البطاقة' ) );
		$r->add_control( 'text', array( 'label' => 'النص (يظهر عند المرور)', 'type' => Controls_Manager::TEXTAREA, 'default' => 'وصف قصير للخدمة.' ) );
		$r->add_control( 'btn', array( 'label' => 'نص الزر', 'type' => Controls_Manager::TEXT, 'default' => 'عرض المزيد' ) );
		$r->add_control( 'link', array( 'label' => 'رابط الزر', 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/services/' ) ) );

		$this->add_control(
			'items',
			array(
				'label'       => 'البطاقات',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $r->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array( 'title' => 'البطاقة الأولى' ),
					array( 'title' => 'البطاقة الثانية' ),
					array( 'title' => 'البطاقة الثالثة' ),
				),
			)
		);
		$this->add_control(
			'autoplay',
			array(
				'label'   => 'تحريك تلقائي',
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);
		$this->add_responsive_control(
			'per',
			array(
				'label'           => 'عدد البطاقات الظاهرة',
				'type'            => Controls_Manager::NUMBER,
				'min'             => 1,
				'max'             => 6,
				'default'         => 3,
				'tablet_default'  => 2,
				'mobile_default'  => 1,
				'selectors'       => array( '{{WRAPPER}} .carousel' => '--per: {{VALUE}};' ),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section( 'style', array( 'label' => 'التصميم', 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control(
			'h',
			array(
				'label'     => 'ارتفاع البطاقة',
				'type'      => Controls_Manager::SLIDER,
				'range'     => array( 'px' => array( 'min' => 160, 'max' => 600 ) ),
				'default'   => array( 'unit' => 'px', 'size' => 276 ),
				'selectors' => array( '{{WRAPPER}} .flip' => 'height: {{SIZE}}px;' ),
			)
		);
		$this->add_control(
			'shade',
			array(
				'label'     => 'تظليل الوجه الأمامي',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .flip-front .shade' => 'background: {{VALUE}};' ),
			)
		);
		$this->add_control(
			'back',
			array(
				'label'     => 'لون الوجه الخلفي',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .flip-back' => 'background: {{VALUE}};' ),
			)
		);
		$this->add_control(
			'arrows',
			array(
				'label'     => 'لون أزرار التنقل',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .carousel-btn' => 'background: {{VALUE}};' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s     = $this->get_settings_for_display();
		$items = array();
		foreach ( (array) $s['items'] as $it ) {
			$items[] = array(
				'image'    => isset( $it['image']['url'] ) ? $it['image']['url'] : '',
				'title'    => $it['title'],
				'text'     => $it['text'],
				'btn'      => $it['btn'],
				'link'     => isset( $it['link']['url'] ) ? $it['link']['url'] : '',
				'external' => ! empty( $it['link']['is_external'] ),
			);
		}
		zw_render_flip_carousel( $items, 'yes' === $s['autoplay'] && ! $this->is_editor() );
	}
}

/* -------------------------------------------------------------------------- */
/* Projects (from the dashboard)                                               */
/* -------------------------------------------------------------------------- */
class Zawaya_Projects_Widget extends Zawaya_Widget_Base {
	public function get_name() {
		return 'zawaya-projects';
	}

	public function get_title() {
		return 'المشاريع والقصور';
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => 'المشاريع' ) );
		$this->dashboard_hint( 'تُضاف المشاريع وتُعدّل (الشعار، النبذة، المعلومات، الأزرار) من لوحة التحكم ← المشاريع والقصور، وتظهر هنا تلقائياً.' );
		$this->add_control(
			'layout',
			array(
				'label'   => 'طريقة العرض',
				'type'    => Controls_Manager::SELECT,
				'default' => 'carousel',
				'options' => array(
					'carousel' => 'شعارات متحركة (الرئيسية)',
					'grid'     => 'شبكة شعارات (من نحن)',
					'list'     => 'قائمة مفصلة (صفحة مشاريعنا)',
				),
			)
		);
		$this->add_control(
			'autoplay',
			array(
				'label'     => 'تحريك تلقائي',
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array( 'layout' => 'carousel' ),
			)
		);
		$this->add_responsive_control(
			'per',
			array(
				'label'          => 'عدد الشعارات الظاهرة',
				'type'           => Controls_Manager::NUMBER,
				'min'            => 1,
				'max'            => 8,
				'default'        => 5,
				'tablet_default' => 3,
				'mobile_default' => 2,
				'selectors'      => array( '{{WRAPPER}} .carousel' => '--per: {{VALUE}};' ),
				'condition'      => array( 'layout' => 'carousel' ),
			)
		);
		$this->add_control(
			'tabs',
			array(
				'label'     => 'شريط التنقل بين المشاريع',
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => array( 'layout' => 'list' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		if ( 'list' === $s['layout'] ) {
			$ok = zw_render_projects_list( 'yes' === $s['tabs'] );
		} elseif ( 'grid' === $s['layout'] ) {
			$ok = zw_render_projects_grid();
		} else {
			$ok = zw_render_projects_carousel( 'yes' === $s['autoplay'] && ! $this->is_editor() );
		}
		if ( ! $ok ) {
			$this->editor_note( 'لا توجد مشاريع بعد. أضفها من لوحة التحكم ← المشاريع والقصور.' );
		}
	}
}

/* -------------------------------------------------------------------------- */
/* Partners (from the dashboard)                                               */
/* -------------------------------------------------------------------------- */
class Zawaya_Partners_Widget extends Zawaya_Widget_Base {
	public function get_name() {
		return 'zawaya-partners';
	}

	public function get_title() {
		return 'شركاء النجاح';
	}

	public function get_icon() {
		return 'eicon-logo';
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => 'شركاء النجاح' ) );
		$this->dashboard_hint( 'تُضاف الشعارات من لوحة التحكم ← شركاء النجاح. إن لم يوجد أي شريك يختفي هذا القسم كاملاً من الموقع.' );
		$this->end_controls_section();
	}

	protected function render() {
		if ( ! zw_render_partners() ) {
			echo '<span class="zw-partners-empty"></span>';
			$this->editor_note( 'لا يوجد شركاء بعد — هذا القسم مخفي في الموقع حتى تضيف شريكاً من لوحة التحكم ← شركاء النجاح.' );
		}
	}
}

/* -------------------------------------------------------------------------- */
/* Contact form                                                                */
/* -------------------------------------------------------------------------- */
class Zawaya_Contact_Form_Widget extends Zawaya_Widget_Base {
	public function get_name() {
		return 'zawaya-contact-form';
	}

	public function get_title() {
		return 'نموذج التواصل';
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => 'النموذج' ) );
		$this->dashboard_hint( 'الرسائل تصل إلى بريدك وتُحفظ في لوحة التحكم ← رسائل التواصل.' );
		$this->add_control(
			'kinds',
			array(
				'label'       => 'خيارات "نوع الاستفسار" (خيار في كل سطر)',
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 6,
				'default'     => "استفسار\nطلب خدمة\nطلب موعد\nحجز قاعة\nشكوى",
			)
		);
		$this->add_control(
			'button',
			array(
				'label'   => 'نص زر الإرسال',
				'type'    => Controls_Manager::TEXT,
				'default' => 'ارسل',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section( 'style', array( 'label' => 'التصميم', 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control(
			'max',
			array(
				'label'      => 'أقصى عرض للنموذج',
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array( 'px' => array( 'min' => 300, 'max' => 1200 ) ),
				'selectors'  => array( '{{WRAPPER}} .zw-form' => 'max-width: {{SIZE}}{{UNIT}}; margin-inline: auto;' ),
			)
		);
		$this->add_control(
			'btn_bg',
			array(
				'label'     => 'خلفية الزر',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .zw-form button' => 'background: {{VALUE}};' ),
			)
		);
		$this->add_control(
			'btn_color',
			array(
				'label'     => 'لون نص الزر',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .zw-form button' => 'color: {{VALUE}};' ),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		get_template_part(
			'template-parts/contact-form',
			null,
			array(
				'kinds'  => zw_lines( $s['kinds'] ),
				'button' => $s['button'],
			)
		);
	}
}
