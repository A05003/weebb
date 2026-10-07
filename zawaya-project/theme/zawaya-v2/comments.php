<?php
/**
 * Comments.
 *
 * @package zawaya
 */

if ( post_password_required() ) {
	return;
}
?>
<div id="comments">
	<?php if ( have_comments() ) : ?>
		<h2>التعليقات (<?php echo (int) get_comments_number(); ?>)</h2>
		<ol class="comment-list">
			<?php wp_list_comments( array( 'style' => 'ol', 'short_ping' => true, 'avatar_size' => 42 ) ); ?>
		</ol>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>
	<?php
	comment_form(
		array(
			'title_reply'  => 'أضف تعليقاً',
			'label_submit' => 'إرسال',
			'class_submit' => 'btn btn-navy',
		)
	);
	?>
</div>
