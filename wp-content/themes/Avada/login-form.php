<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="tml tml-login custom_style_home_login m_dn_first_p" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'login' ); ?>
	<?php $template->the_errors(); ?>
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login', 'login_post' ); ?>" method="post">
		<p class="tml-user-login-wrap">
			<label class="custom_style_label" for="user_login<?php $template->the_instance(); ?>"><?php
				if ( 'username' == $theme_my_login->get_option( 'login_type' ) ) {
					_e( 'Username', 'theme-my-login' );
				} elseif ( 'email' == $theme_my_login->get_option( 'login_type' ) ) {
					_e( 'E-mail', 'theme-my-login' );
				} else {
					_e( 'Username or E-mail', 'theme-my-login' );
				}
			?></label>
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
		</p>

		<p class="tml-user-pass-wrap">
			<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'theme-my-login' ); ?></label>
			<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="20" autocomplete="off" />
		</p>

		<?php do_action( 'login_form' ); ?>

		<div class="tml-rememberme-submit-wrap">
			<p class="tml-rememberme-wrap">
				<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />
				<label class="custom_remember_me" for="rememberme<?php $template->the_instance(); ?>"><?php esc_attr_e( 'Remember Me', 'theme-my-login' ); ?></label>
			</p>

			<p class="tml-submit-wrap">
				<input type="submit" class="custom_submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In', 'theme-my-login' ); ?>" />
				<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="action" value="login" />
			</p>
		</div>
	</form>
	<?php $template->the_action_links( array( 'login' => false ) ); ?>
</div>
<div class="set_login_img">
	<a href="">
		<?php 
		$image = get_field('image_register', 'option');
		if( !empty($image) ) { ?>
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		<?php }
        else{
            ?><img src="http://belpro.co/fbg/wp-content/uploads/2017/02/1b-1.jpg" alt="<?php echo $image['alt']; ?>" /><?
        }
        ?>
	</a>
	<div class="set_content_on_img_login">
		<div class="resgister_now"><?
			 if(ICL_LANGUAGE_CODE=='fr') {
                ?> <p>Devenez membre</p><?
            }
            else{
			   ?> <p>Become a Member</p><?
            }
		?></div>
		<div class="subtitle_register"><?
           
             if(ICL_LANGUAGE_CODE=='fr') {
                 $desc = "Rejoignez le réseau de professionnels du French Business Group";
                 //$descr = htmlentities($desc,ENT_COMPAT,'ISO-8859-15');
                 ?><p> <?=htmlentities($desc,ENT_COMPAT,'ISO-8859-15');?></p><?
             }
             else{
                ?><p>Join the French Business Group's network of Professionals</p><?
             }
			
		?></div>
		<div class="button_create_account"><?
            if(ICL_LANGUAGE_CODE=='fr') {
                ?><a href="<?echo get_site_url()."/select-plan"?>">
                    S'enregistrer
                </a><?
                
            }
            else{
                ?><a href="<?echo get_site_url()."/en/select-plan"?>">
                    Subscribe
                </a><?
                }
		?></div>
	</div>
</div>

