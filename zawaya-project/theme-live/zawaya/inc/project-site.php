<?php
/**
 * Website link of a project (for example the restaurants' own site).
 * The project's own field wins; otherwise a default by slug is used.
 *
 * @package zawaya
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Default websites by project slug. */
function zawaya_default_project_sites() {
	return array(
		'maali' => 'https://almaalicatering.com',
	);
}

/** Website url for a project, or an empty string. */
function zw_project_site( $id ) {
	$url = trim( (string) get_post_meta( $id, '_zw_site', true ) );
	if ( '' !== $url ) {
		return $url;
	}
	$post = get_post( $id );
	$map  = zawaya_default_project_sites();
	return $post && isset( $map[ $post->post_name ] ) ? $map[ $post->post_name ] : '';
}

/** The "website" button. */
function zw_render_site_button( $id, $class = 'btn btn-gold' ) {
	$url = zw_project_site( $id );
	if ( ! $url ) {
		return;
	}
	printf(
		'<a class="%s" href="%s" target="_blank" rel="noopener"><i class="fa-solid fa-globe"></i><span>الموقع الإلكتروني</span></a>',
		esc_attr( $class ),
		esc_url( $url )
	);
}
