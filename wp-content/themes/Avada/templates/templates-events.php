<?php

/**

 * Template Name: Calendar Events

 */



?>



<?php get_header(); ?>



<!-- <link rel="stylesheet" href="<?php echo get_template_directory(); ?>/assets/css/events.css"> -->

<?php

// args
$args = array(
	'numberposts'	=> 3,
	'post_type'		=> 'tribe_events',
	'meta_key'		=> 'event_du_mois',
	'meta_value'	=> 'a:1:{i:0;s:1:"1";}'
	);

// query
$the_query = new WP_Query( $args );

?>

<link rel="stylesheet" href="http://belpro.co/fbg/wp-content/themes/Avada/assets/css/events.css">
<div class="m_set_def_bg">
	<div class="m_events_in_future">
		<h2>Events of the Month</h2>
	</div>

	<div class="m_b_30">
		<div class="list_with_images owl_carousel_slider1">
			


			<?php if( $the_query->have_posts() ): ?>
				<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<!-- <li class=""> -->
						<div class="item">
							<div class="m_set_event_img">
								<a href="<?php the_permalink(); ?>">
								<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() )
				); ?>" alt="event">
								</a>
							</div>
						</div>
						
						
				<!-- 	</li> -->

				<?php endwhile; ?>
			<?php endif; ?>

			<?php wp_reset_query(); ?>

		</div>
	</div>	
</div>
<!-- <div class="m_name_of_comp txtaC m_b_40">
	<img class="m_logo_img" src="http://belpro.co/fbg/wp-content/uploads/2017/01/logo-comp.jpg" alt="FBG FOoter Logo">
</div> -->
<!-- <div class="m_bussiness_after_h txtaC">
	<p>Business after hours at roberto's al maryah island</p>
	<p>16<sup>th</sup> january 2017</p>
</div> -->
<!-- <div class="m_set_def_bg">
	<div class="m_events_in_future">
		<h2>Prochains Évènements</h2>
	</div>	
	<div class="">
		<ul class="m_custom_list_of_events">
			<li>
				<div class="m_set_event_img">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/future-event1.jpg" alt="event">
				</div>
				<div class="m_event_desc">
					<a class="m_link_to_desc_event" href="#">Plus de 240 membres, entreprises et particuliers</a>
					<p class="m_link_to_desc_event m_t_10">5 nov 2016</p>
					<a class="participate_to_event" href="#">Participer à l’Évènetment </a>
					<p class="m_right_date" href="#"><span>5 nov</span></p>
				</div>
			</li>		
			<li>
				<div class="m_set_event_img">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/future-event2.jpg" alt="event">
				</div>
				<div class="m_event_desc">
					<a class="m_link_to_desc_event" href="#">Un site pour toutes les informations concernant</a>
					<p class="m_link_to_desc_event m_t_10">19 nov 2016 </p>
					<a class="participate_to_event" href="#">Participer à l’Évènetment </a>
					<p class="m_right_date" href="#"><span>19 nov</span></p>
				</div>
			</li>				
			<li>
				<div class="m_set_event_img">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/future-event3.jpg" alt="event">
				</div>
				<div class="m_event_desc">
					<a class="m_link_to_desc_event" href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, dolorem quis omnis, nam quas sint assumenda, id adipisci veritatis totam, consectetur amet mollitia dolores optio. In doloribus sed reprehenderit officiis!</a>
					<p class="m_link_to_desc_event m_t_10">18 dec 2016 </p>
					<a class="participate_to_event" href="#">Participer à l’Évènetment </a>
					<p class="m_right_date" href="#"><span>18 nov</span></p>
				</div>
			</li>				
			<li>
				<div class="m_set_event_img">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/future-event4.jpg" alt="event">
				</div>
				<div class="m_event_desc">
					<a class="m_link_to_desc_event" href="#">Tous les mois la Newsletter du FBG vous informe les</a>
					<p class="m_link_to_desc_event m_t_10">26 nov 2016</p>
					<a class="participate_to_event" href="#">Participer à l’Évènetment </a>
					<p class="m_right_date" href="#"><span>26 nov</span></p>
				</div>
			</li>				
		</ul>
	</div>
</div> -->


<div class="m_set_def_bg p_t_0">
	<div class="m_events_in_future txtaL">
		<h2>Events categories</h2>
	</div>	

	<div class="total_width">
		<ul class="m_custom_list_of_events events_set_new_h">
<? 
global $wpdb;
$result = $wpdb->get_results("SELECT * FROM wp_posts WHERE post_status='publish' AND post_type LIKE'%tribe_events%' ORDER BY ID DESC");
foreach($result as $row) {
	// echo $row->ID;
	// print_r($row);

$result4 = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE meta_key='_EventVenueID' AND post_id={$row->ID}");	
foreach ($result4 as $row4) {
	$id_vanue=$row4->meta_value;

	$result5 = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE meta_key='_VenueVenue' AND post_id={$id_vanue}");	
	foreach ($result5 as $row5) {
		$address=$row5->meta_value;
	}

}

$result3 = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE meta_key='_EventEndDate' AND post_id={$row->ID}");	
foreach ($result3 as $row3) {
	$originalEndDate=$row3->meta_value;
}

$result2 = $wpdb->get_results("SELECT * FROM wp_postmeta WHERE meta_key='_EventStartDate' AND post_id={$row->ID}");	
foreach ($result2 as $row2) {

	$originalDate=$row2->meta_value;
	$newDate = date("d", strtotime($originalDate))."<sup>".date("S", strtotime($originalDate))."</sup> ".date("F", strtotime($originalDate));
	$newHour=date("g", strtotime($originalDate))."<sup>".date("a", strtotime($originalDate))."</sup> to ".date("g", strtotime($originalEndDate))."<sup>".date("a", strtotime($originalEndDate))."</sup>";
}

?>
<li>
	<div class="m_default_name_of_event bg_blue">
		<p><?echo $row->post_title?></p>
	</div>
	<div class="m_set_event_img">
		<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $row->ID )
		); ?>" alt="event">
	</div>
	<div class="m_new_padd_on_m_event_desc">
		<div>
			<a class="m_date_of_event_h" href="#">
				<?php echo $newDate; ?>
			</a>
			<a class="m_date_of_event_h" href="#">
				<?php echo $newHour; ?>
			</a>
			<span class="m_participate_at_event">
				<a class="participate_to_event" href="<?php echo get_permalink($row->ID); ?>">Participer à l’Évènetment </a>
			</span>	
		</div>
		<div class="m_location_event txtaL">
			<p><?php echo $address; ?></p>
		</div>
<!-- 		<div class="m_members_nr">
			<p>MEMBERS FOC/NM 70 AED</p>
		</div> -->
	</div>
</li>	
<?php
// echo "test".$row->ID;
}
?>
		</ul>
	</div>

	<div class="m_member_to_events">
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
<!-- 
	<div class="m_events_in_future">
		<h2>Suggested Profiles</h2>
	</div> -->
	<!-- <div class="m_slider_on_page">
		<div class="owl_carousel_slider">
			<div class="item">
				<div class="set_bg_for_item">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/client1.jpg" alt="client">
				</div>
				<div class="m_features_name">
					<p class="m_right_date m_right_corner_feature bg_white_f" href="#"><span>FEATURED</span></p>
				</div>
				<div class="m_desc_of_position">
					<div class="m_name_of_person">
						<p>Maelle Morvan</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Directrice Générale</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Membre depuis mai 2015</p>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="set_bg_for_item">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/client2.jpg" alt="client">
				</div>
				<div class="m_desc_of_position">
					<div class="m_name_of_person">
						<p>Sabrina Amiar</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Responsable Communication</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Membre depuis juin 2014</p>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="set_bg_for_item">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/client3.jpg" alt="client">
				</div>
				<div class="m_features_name">
					<p class="m_right_date m_right_corner_feature bg_blue_f" href="#"><span>new</span></p>
				</div>
				<div class="m_desc_of_position">
					<div class="m_name_of_person">
						<p>Héléne Orgnon Breyton</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Service Appui aux Entreprises</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Membre depuis octobre 2016</p>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="set_bg_for_item">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/client4.jpg" alt="client">
				</div>
				<div class="m_features_name">
					<p class="m_right_date m_right_corner_feature bg_pink_f" href="#"><span>SPONSOR</span></p>
				</div>
				<div class="m_desc_of_position">
					<div class="m_name_of_person">
						<p>Nicole Ratsimandaimanana</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Service Evénementiel</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Membre depuis juin 2013</p>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="set_bg_for_item">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/client5.jpg" alt="client">
				</div>
				<div class="m_features_name">
					<p class="m_right_date m_right_corner_feature bg_white_f" href="#"><span>FEATURED</span></p>
				</div>
				<div class="m_desc_of_position">
					<div class="m_name_of_person">
						<p>Étienne Gouin</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Responsable Membres</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Membre depuis août 2014</p>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="set_bg_for_item">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/client4.jpg" alt="client">
				</div>
				<div class="m_features_name">
					<p class="m_right_date m_right_corner_feature bg_white_f" href="#"><span>FEATURED</span></p>
				</div>
				<div class="m_desc_of_position">
					<div class="m_name_of_person">
						<p>Maelle Morvan</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Directrice Générale</p>
					</div>
					<div class="occupation_position_ahead m_b_20">
						<p>Membre depuis mai 2015</p>
					</div>
				</div>
			</div>
		</div>
	</div> -->
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




	
</div>

<link rel="stylesheet" href="http://belpro.co/fbg/wp-content/themes/Avada/assets/css/owl.carousel.css">
<link rel="stylesheet" href="http://belpro.co/fbg/wp-content/themes/Avada/assets/css/owl.theme.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script type='text/javascript' src='http://belpro.co/fbg/wp-content/themes/Avada/assets/js/owl.carousel.min.js'></script> 
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
		jQuery('.owl_carousel_slider1').owlCarousel ({
			items: 3,
			itemsDesktop: [1299, 3],
			itemsDesktopSmall: [991, 2],
			itemsTablet: [768, 2],
			itemsMobile: [480, 1],
			pagination: false,
			autoPlay: false,
			navigation: false
		});
	});
</script>
<?php get_footer(); ?>