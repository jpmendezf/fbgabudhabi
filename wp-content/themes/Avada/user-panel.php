<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/

?>
<div class="tml tml-user-panel" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php if ( $template->options['show_gravatar'] ) : ?>
	<div class="tml-user-avatar">
		<?php 
		$post_id = "user_".get_current_user_id();
		$image = get_field('user_picture' , $post_id);
		// echo $post_id;
		if( !empty($image) ): ?>
			<img src="<?php echo $image; ?>" alt="" style="max-width:120px"/>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php $template->the_user_links(); ?>

	<?php do_action( 'tml_user_panel' ); ?>
</div>
