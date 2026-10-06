<?php
/**
 * Custom post types: projects (القصور والمشاريع), services, partners, contact messages.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function zawaya_register_post_types() {
	register_post_type(
		'zawaya_project',
		array(
			'labels'       => array(
				'name'               => 'المشاريع والقصور',
				'singular_name'      => 'مشروع',
				'menu_name'          => 'المشاريع والقصور',
				'add_new'            => 'إضافة مشروع',
				'add_new_item'       => 'إضافة مشروع / قصر جديد',
				'edit_item'          => 'تعديل المشروع',
				'new_item'           => 'مشروع جديد',
				'view_item'          => 'عرض المشروع',
				'all_items'          => 'كل المشاريع',
				'search_items'       => 'بحث في المشاريع',
				'not_found'          => 'لا توجد مشاريع',
				'featured_image'     => 'شعار المشروع',
				'set_featured_image' => 'تعيين الشعار',
				'remove_featured_image' => 'إزالة الشعار',
				'use_featured_image' => 'استخدام كشعار',
			),
			'public'       => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-building',
			'menu_position'=> 5,
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'rewrite'      => array( 'slug' => 'project', 'with_front' => false ),
			'has_archive'  => false,
		)
	);

	register_post_type(
		'zawaya_service',
		array(
			'labels'       => array(
				'name'               => 'الخدمات',
				'singular_name'      => 'خدمة',
				'menu_name'          => 'الخدمات',
				'add_new'            => 'إضافة خدمة',
				'add_new_item'       => 'إضافة خدمة جديدة',
				'edit_item'          => 'تعديل الخدمة',
				'all_items'          => 'كل الخدمات',
				'not_found'          => 'لا توجد خدمات',
				'featured_image'     => 'صورة الخدمة',
				'set_featured_image' => 'تعيين صورة الخدمة',
			),
			'public'             => false,
			'show_ui'            => true,
			'show_in_rest'       => true,
			'menu_icon'          => 'dashicons-star-filled',
			'menu_position'      => 6,
			'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		)
	);

	register_post_type(
		'zawaya_partner',
		array(
			'labels'        => array(
				'name'               => 'شركاء النجاح',
				'singular_name'      => 'شريك',
				'menu_name'          => 'شركاء النجاح',
				'add_new'            => 'إضافة شريك',
				'add_new_item'       => 'إضافة شريك جديد',
				'edit_item'          => 'تعديل الشريك',
				'all_items'          => 'كل الشركاء',
				'not_found'          => 'لا يوجد شركاء',
				'featured_image'     => 'شعار الشريك',
				'set_featured_image' => 'تعيين شعار الشريك',
			),
			'public'        => false,
			'show_ui'       => true,
			'menu_icon'     => 'dashicons-groups',
			'menu_position' => 7,
			'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
		)
	);

	register_post_type(
		'zawaya_message',
		array(
			'labels'        => array(
				'name'          => 'رسائل التواصل',
				'singular_name' => 'رسالة',
				'menu_name'     => 'رسائل التواصل',
				'all_items'     => 'كل الرسائل',
				'edit_item'     => 'عرض الرسالة',
				'not_found'     => 'لا توجد رسائل بعد',
			),
			'public'        => false,
			'show_ui'       => true,
			'menu_icon'     => 'dashicons-email-alt',
			'menu_position' => 8,
			'supports'      => array( 'title' ),
			'capability_type' => 'post',
			'capabilities'  => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'  => true,
		)
	);
}
add_action( 'init', 'zawaya_register_post_types' );

/* ----- Admin list columns ----- */

add_filter(
	'manage_zawaya_project_posts_columns',
	function ( $cols ) {
		return array(
			'cb'        => $cols['cb'],
			'zw_logo'   => 'الشعار',
			'title'     => 'الاسم',
			'zw_type'   => 'النوع',
			'menu_order'=> 'الترتيب',
			'date'      => $cols['date'],
		);
	}
);
add_filter(
	'manage_zawaya_service_posts_columns',
	function ( $cols ) {
		return array(
			'cb'        => $cols['cb'],
			'zw_logo'   => 'الصورة',
			'title'     => 'الخدمة',
			'menu_order'=> 'الترتيب',
			'date'      => $cols['date'],
		);
	}
);
add_filter(
	'manage_zawaya_partner_posts_columns',
	function ( $cols ) {
		return array(
			'cb'        => $cols['cb'],
			'zw_logo'   => 'الشعار',
			'title'     => 'الاسم',
			'menu_order'=> 'الترتيب',
		);
	}
);
function zawaya_admin_columns( $col, $post_id ) {
	if ( 'zw_logo' === $col ) {
		$u = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
		echo $u ? '<img src="' . esc_url( $u ) . '" style="width:60px;height:60px;object-fit:contain;background:#fff;border:1px solid #eee;border-radius:6px">' : '—';
	} elseif ( 'zw_type' === $col ) {
		echo esc_html( get_post_meta( $post_id, '_zw_type', true ) );
	} elseif ( 'menu_order' === $col ) {
		echo (int) get_post_field( 'menu_order', $post_id );
	}
}
add_action( 'manage_zawaya_project_posts_custom_column', 'zawaya_admin_columns', 10, 2 );
add_action( 'manage_zawaya_service_posts_custom_column', 'zawaya_admin_columns', 10, 2 );
add_action( 'manage_zawaya_partner_posts_custom_column', 'zawaya_admin_columns', 10, 2 );

/* Messages list */
add_filter(
	'manage_zawaya_message_posts_columns',
	function ( $cols ) {
		return array(
			'cb'       => $cols['cb'],
			'title'    => 'الاسم',
			'zw_phone' => 'الجوال',
			'zw_email' => 'البريد',
			'zw_kind'  => 'نوع الاستفسار',
			'date'     => 'التاريخ',
		);
	}
);
add_action(
	'manage_zawaya_message_posts_custom_column',
	function ( $col, $post_id ) {
		$map = array( 'zw_phone' => '_zw_phone', 'zw_email' => '_zw_email', 'zw_kind' => '_zw_kind' );
		if ( isset( $map[ $col ] ) ) {
			echo esc_html( get_post_meta( $post_id, $map[ $col ], true ) );
		}
	},
	10,
	2
);

/* Sort admin lists by menu order */
add_action(
	'pre_get_posts',
	function ( $q ) {
		if ( is_admin() && $q->is_main_query() && in_array( $q->get( 'post_type' ), array( 'zawaya_project', 'zawaya_service', 'zawaya_partner' ), true ) && ! $q->get( 'orderby' ) ) {
			$q->set( 'orderby', array( 'menu_order' => 'ASC', 'date' => 'ASC' ) );
		}
	}
);

/* Unread-messages bubble in the admin menu */
add_action(
	'admin_menu',
	function () {
		global $menu;
		$count = (int) wp_count_posts( 'zawaya_message' )->pending;
		if ( ! $count ) {
			return;
		}
		foreach ( $menu as $k => $item ) {
			if ( isset( $item[2] ) && 'edit.php?post_type=zawaya_message' === $item[2] ) {
				$menu[ $k ][0] .= ' <span class="awaiting-mod"><span class="pending-count">' . $count . '</span></span>';
			}
		}
	},
	99
);
