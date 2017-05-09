<?php

/**

 * Template Name: User Details

 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<?php

$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

?>


<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/lists.css">

<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/events.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.js"></script>

<div class="banner_top_on_list_categories">
	<div class="set_dimensions_to_banner_top">
		<img src="<?php echo content_url(); ?>/uploads/2017/01/banner_top_img.jpg" alt="">
		<div class="include_search_on_list_categories_top">
			<input type="text" placeholder="Search for companies or individuals" class="style_input_search_on_page_list">
			<div class="include_button_submit_on_page_list">
				<button type="submit">
					<i class="fa fa-search"></i>
				</button>
			</div>
		</div>
	</div>
</div>
<!-- company -->
<div class="title_categories">
	<div class="m_events_in_future style_events_on_page">
		<h2>Member</h2>
	</div>
</div>
<?php
if (isset($_GET['uid']) && !empty($_GET['uid'])) {
	$company_id = $_GET['uid'];
} else {
	wp_redirect(home_url());
}

$fax_nr=get_field('fax', 'user_'.$company_id);
$city_nr=get_field('city', 'user_'.$company_id);
$phone_nr=get_field('mobile', 'user_'.$company_id);
$position=get_field('position', 'user_'.$company_id);

$user_info = get_userdata($company_id);
$mailadresje = $user_info->user_email;



$company = get_field('company', 'user_'.$company_id);
$company_name = $company->post_title;


$user_type = "Corporate";

$image = get_field('company_picture', $company->ID);
if(strlen($image) == 0) {
	$image = content_url() . "/uploads/2017/01/new-FBG-logo_transparent.png";
}

$company_img = "<a href='" . get_permalink($company->ID) . "'><img src='" . $image . "' alt='' /></a>";



if($company == "14843") {
	$company_name = $company_img = "";
	$user_type = "Individual";
}


if(is_user_logged_in()) {

	$phone_icon = '<i class="fa fa-phone" aria-hidden="true"></i>';
	$mail_icon = '<i class="fa fa-mail" aria-hidden="true"></i>';

	$phone_display = $mail_display = "";

	if(strlen($phone_nr) == 0) { $phone_nr = ""; $phone_icon = ''; $phone_display = ' style="display:none" '; }
	if(strlen($mailadresje) == 0) { $mailadresje = ""; $mail_icon = ''; $mail_display = ' style="display:none" '; }

	$company_details = <<<EOF
	<a  onclick="swal1('Phone', '{$phone_nr}', 'OK');" class="button_sm" {$phone_display}>
		{$phone_icon}
	</a>
	<a  onclick="swal1('Email', '{$mailadresje}', 'OK');" class="button_sm" {$mail_display}>
		{$mail_icon}
	</a>
EOF;
} else {

	$link_register = "<a href='" . get_permalink(13739) . "'>Login</a> or <a href='" . get_permalink(13760) . "'>Become a member!</a> ";

	$company_details = <<<EOF
	<a  onclick="swal1('Phone', `{$link_register}`, 'OK');" class="button_sm">
		<i class="fa fa-phone" aria-hidden="true"></i>
	</a>
	<a  onclick="swal1('Fax', `{$link_register}`, 'OK');" class="button_sm">
		<i class="fa fa-mail" aria-hidden="true"></i>
	</a>
EOF;
}

?>
<div class="detail_page">
	<div class="top_company_on_page">
		<div class="style_company_and_individual_name_title txtaC">
			<h3><?php echo get_field('first_name','user_'.$company_id).' '.get_field('last_name','user_'.$company_id); ?></h3>
		</div>
		<div class="content_on_company_on_page">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="left_details_company_on_page">
						<div class="row">
							<div class="col-md-1 col-sm-12 col-xs-12"></div>
							<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
								<div class="set_img_company">
									<a class="company_img fullwh_img" href="javascript:void(0)">
										<?php

										$image = get_field('user_picture','user_'.$company_id);
										if(strlen($image) == 0) {
											$image = content_url() . "/uploads/2017/01/new-FBG-logo_transparent.png";
										}

										if( !empty($image) ): ?>

											<img src="<?php echo $image; ?>" alt="" />

									<?php endif; ?>
									</a>

								</div>
							</div>
							<div class="col-md-5 col-sm-12 col-xs-12 pl_0 pr_0">

							
								<div class="activity_sectors">
									
									<div class="member_period">
										<p><?php echo $position; ?></p>
										<p><?php echo $company_name; ?></p>
										<p><?php echo $user_type; ?></p>
									</div>
									<div class="include_icons">
										<div class="bottom_buttons m_set_mt_20">
											<?php echo $company_details;?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="desc_company_individual_name mg_b_50">

						<div class="activity_sectors member_period">
							<p><?php echo $company_name; ?></p>
							<?php echo $company_img; ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="m_member_to_events mt_0">
	<div class="m_text_find_event">
		<?php the_field('text_become_a_member_banner', 'option'); ?>
	</div>
	<div class="holding_card">
		<?php
		$image = get_field('image_become_a_member_banner', 'option');
		if( !empty($image) ): ?>
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
		<?php endif; ?>
	</div>
</div>

<div class="m_events_in_future">
	<h2>Members Overview</h2>
</div>

<div class="m_slider_on_page">
	<div class="owl_carousel_slider">
		<?php suggestion_profile(); ?>
	</div>
</div>

<div class="m_due_cols">
	<div class="m_col1">
		<div class="m_image_col1">
			<?php
			$image = get_field('image_bottom_banner_left', 'option');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>
		<div class="m_present_consult txtaC">
			<?php the_field('text_bottom_banner_left', 'option'); ?>
		</div>
	</div>
	<div class="m_col2">
		<div class="m_benefits">
			<?php the_field('text_bottom_banner_right', 'option'); ?>
		</div>
		<div class="m_obtain_cart p_r m_t_20">
			<a href="<?php the_field('button_link', 'option'); ?>">
				<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/blue-sticker.png" alt="sticker">
				<p><?php the_field('button_title', 'option'); ?></p>
			</a>
		</div>
		<div class="m_cart_img">
			<?php
			$image = get_field('image_bottom_banner_right', 'option');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>
	</div>
</div>



<div class="fusion-fullwidth fullwidth-box newsletter hundred-percent-fullwidth" style="background-color: #0291dd;background-position: center center;background-repeat: no-repeat;padding-top:18px;padding-right:40px;padding-bottom:18px;padding-left:40px;"><div class="fusion-builder-row fusion-row "><div class="fusion-layout-column fusion_builder_column fusion_builder_column_1_2  fusion-one-half fusion-column-first 1_2" style="margin-top:0px;margin-bottom:0px;width:48%; margin-right: 4%;">
			<div class="fusion-column-wrapper" style="background-position:left top;background-repeat:no-repeat;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;" data-bg-url="">
				<h3 data-fontsize="26" data-lineheight="34">Register to our newsletter</h3>
<p>Receive the latest news digest, upcoming events and&nbsp;stay informed!</p>
<div class="fusion-clearfix"></div>

			</div>
		</div><div class="fusion-layout-column fusion_builder_column fusion_builder_column_1_2  fusion-one-half fusion-column-last 1_2" style="margin-top:0px;margin-bottom:0px;width:48%">
			<div class="fusion-column-wrapper" style="background-position:left top;background-repeat:no-repeat;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;" data-bg-url="">
				<!-- Note :
   - You can modify the font style and form style to suit your website. 
   - Code lines with comments “Do not remove this code”  are required for the form to work properly, make sure that you do not remove these lines of code. 
   - The Mandatory check script can modified as to suit your business needs. 
   - It is important that you test the modified form before going live.-->
<div id="crmWebToEntityForm">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <form action="https://crm.zoho.com/crm/WebToLeadForm" name="WebToLeads2176218000000190001" method="POST" onsubmit="javascript:document.charset=&quot;UTF-8&quot;; return checkMandatory()" accept-charset="UTF-8">

    <!-- Do not remove this code. -->
    <input type="text" style="display:none;" name="xnQsjsdp" value="f0c2d3e6d84ecc82a3d8a0746191447b4f01858995c17fea22853bdb1248ad43">
    <input type="hidden" name="zc_gad" id="zc_gad" value="">
    <input type="text" style="display:none;" name="xmIwtLD" value="75c2ca91349b7090ee10b32d5eef7683b2e5bd852d9be8a3de54f4aeaf311fcc">
    <input type="text" style="display:none;" name="actionType" value="TGVhZHM=">
    <input type="text" style="display:none;" name="returnURL" value="http://fbgabudhabi.com">
    <!-- Do not remove this code. -->
    <div class="form-group">
      <label class="visually-hidden">Your First Name*</label>
      <input type="text" maxlength="40" name="First Name" class="form-control">
    </div>
    <div class="form-group">
      <label class="visually-hidden">Your Email*</label>
      <input type="text" class="form-control" maxlength="100" name="Email">
    </div>
    <div class="form-submit">
      <input type="submit" value="Submit" class="fusion-button btn btn-primary-2">
    </div>
    <script>
      var mndFileds = new Array('First Name', 'Last Name', 'Email');
      var fldLangVal = new Array('First Name', 'Last Name', 'Email');
      var name = '';
      var email = '';

      function checkMandatory() {
        for (i = 0; i < mndFileds.length; i++) {
          var fieldObj = document.forms['WebToLeads2176218000000190001'][mndFileds[i]];
          if (fieldObj) {
            if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length == 0) {
              if (fieldObj.type == 'file') {
                alert('Please select a file to upload.');
                fieldObj.focus();
                return false;
              }
              alert(fldLangVal[i] + ' cannot be empty.');
              fieldObj.focus();
              return false;
            } else if (fieldObj.nodeName == 'SELECT') {
              if (fieldObj.options[fieldObj.selectedIndex].value == '-None-') {
                alert(fldLangVal[i] + ' cannot be none.');
                fieldObj.focus();
                return false;
              }
            } else if (fieldObj.type == 'checkbox') {
              if (fieldObj.checked == false) {
                alert('Please accept  ' + fldLangVal[i]);
                fieldObj.focus();
                return false;
              }
            }
            try {
              if (fieldObj.name == 'Last Name') {
                name = fieldObj.value;
              }
            } catch (e) {}
          }
        }
      }
    </script>
  </form>
</div><div class="fusion-clearfix"></div>

			</div>
		</div></div></div>

		


<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/owl.theme.css">

<script type='text/javascript' src='<?php echo content_url(); ?>/themes/Avada/assets/js/owl.carousel.min.js'></script> 

<script>
	jQuery(document).ready(function() {				
		jQuery('.owl_carousel_slider').owlCarousel ({
			items: 5,
			itemsDesktop: [1299, 4],
			itemsDesktopSmall: [991, 3],
			itemsTablet: [768, 2],
			itemsMobile: [480, 1],
			navigation: true,
			pagination: false,
			autoPlay: false,
			navigationText: ['<i class="icon_left"></i>','<i class="icon_right"></i>']
		});

		jQuery(".show_members_button").click(function(){
			jQuery(this).closest(".company_wrap").next(".dd_info").fadeToggle();
		});
	});

	function swal1(title, text, confirmButtonText){
		swal({
			title: title,
			html: text,
			confirmButtonText: confirmButtonText
		})
	};

</script>

<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
