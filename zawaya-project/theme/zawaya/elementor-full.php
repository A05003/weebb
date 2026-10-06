<?php
/**
 * Full-width wrapper for any page designed with Elementor
 * (theme header + Elementor content + theme footer).
 *
 * @package zawaya
 */

get_header();
while ( have_posts() ) :
	the_post();
	the_content();
endwhile;
get_footer();
