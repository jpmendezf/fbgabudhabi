<?php

foreach ($usersqq as $post) {

	$user_id = $post->data->ID;

	$user_l = get_field( "first_name" , 'user_'.$user_id);
	$user_f = get_field( "last_name" , 'user_'.$user_id);
	$position = get_field( "position" , 'user_'.$user_id);


	$user_picture = get_field('user_picture', 'user_'.$user_id);
	if(strlen($user_picture) == 0) {
		$user_picture = content_url() . "/uploads/2017/01/new-FBG-logo_transparent.png";
	}	

	?>

	<div class="item_grid">
		<div class="company_wrap individ-wrap">
			<a href='<?php echo get_permalink(14559); ?>?uid=<?php echo $user_id; ?>'><img src="<?php echo $user_picture; ?>" alt="picture"></a>
		</div>
	</div>

	<div class="item_grid">
		<div class="company_info_wrap">
			<h6 class="company_name_2">
				<?php echo $user_l ." ". $user_f; ?>
			</h6>

			<ul>
				<p class="member_since">
					<?php echo $position; ?>
				</p>
			</ul>

			<p class="member_since">
				<?php

				if(is_user_logged_in()) {

				$phone = get_field('mobile', 'user_'.$user_id);
					$udata = get_userdata( $user_id );
					$mailadr = $udata->user_email;

					$phone_icon = '<i class="fa fa-phone" aria-hidden="true"></i>';
					$mail_icon = '<i class="fa fa-envelope-o" aria-hidden="true"></i>';

					$phone_display = $mail_display = "";


					if(strlen($phone) == 0) { $phone = ""; $phone_icon = ''; $phone_display = ' style="display:none" '; }
					if(strlen($mailadr) == 0) { $mailadr = "Not set.."; $mail_icon = ''; $mail_display = ' style="display:none" '; }

					$company_details = <<<EOF
					<a onclick="swal1('Phone', '{$phone}', 'OK');" class="bottom_buttons" href="javascript:void(0)" {$phone_display}>
						{$phone_icon}
					</a>
					<a onclick="swal1('Mail', '{$mailadr}', 'OK');" class="button_sm btn_white" {$mail_display}>
						{$mail_icon}
					</a>
EOF;

				} else {

					$link_register = "<a href='" . get_permalink(13739) . "'>Login</a> or <a href='" . get_permalink(13760) . "'>Become a member!</a> ";

					$company_details = <<<EOF
					<a  onclick="swal1('Phone', `{$link_register}`, 'OK');" class="bottom_buttons" href="javascript:void(0)">
						<i class="fa fa-phone" aria-hidden="true"></i>
					</a>
					<a  onclick="swal1('Mail', `{$link_register}`, 'OK');" class="button_sm btn_white" href="javascript:void(0)">
						<i class="fa fa-envelope-o" aria-hidden="true"></i>
					</a>
EOF;
				}

				$udata = get_userdata( $user_id );
				// print_r($udata);
				$date = date( "F Y" , strtotime($udata->user_registered) );

				if(strlen($date)>0) {
					?>
					<!-- Members Since <span class="member_date"><?php echo $date ?></span> -->
					<?php
				}
				?>
			</p>

			<div>
				<?php echo $company_details; ?>
			</div>


		</div>
	</div>

	<?php
}