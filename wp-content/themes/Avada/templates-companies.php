<?php

/**

 * Template Name: Companies Templates

 */



?>



<?php get_header(); ?>


<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/events.css">
<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/lists.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.js"></script>

<?php

$category = "Companies";
$users = "Individual members";
$category_id = 0;

if(isset($_GET['cat'])&&!empty($_GET['cat'])) {

	$sector_company = esc_attr( sanitize_text_field( $_GET['cat'] ) );

	$result5 = $wpdb->get_results("SELECT ID, post_title FROM wp_posts WHERE `post_name` LIKE '{$sector_company}'");	
	foreach ($result5 as $row5) {
		$category = $row5->post_title;
		$category_id = $row5->ID;
	}
}


?>


<div class="banner_top_on_list_categories">
	<div class="set_dimensions_to_banner_top">
		<img src="<?php echo content_url(); ?>/uploads/2017/01/banner_top_img.jpg" alt="">
		<div class="include_search_on_list_categories_top">
			<form action="<?php echo get_permalink(13750); ?>">
				
				<input type="text" name="q" placeholder="Search for companies and members" class="style_input_search_on_page_list" value="<?php if(isset($_GET['q'])) echo $_GET['q'];?>">
				<div class="include_button_submit_on_page_list">
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
				</div>

			</form>
		</div>
	</div>
</div>

<div class="title_categories">
	<div class="m_events_in_future style_events_on_page">
		<h2><?php echo $category; ?></h2>
	</div>
	<div class="back_button_right">
		<?php if(isset($_GET['start']) || isset($_GET['cat']) || isset($_GET['q'])) { ?>
		<a href="<?php echo get_permalink(13750); ?>">
			<i class="fa fa-arrow-left" aria-hidden="true"></i>
			<span>Back</span>
		</a>
		<?php } ?>
	</div>
</div>
<div class="display_alphabetic_bar">
	<ul class="ul_alphabetic_bar">
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "a" ) )?>" class="active_link_on_alphabetic_sort">
				A
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "b" ) )?>">
				B
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "c" ) )?>">
				C
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "d" ) )?>">
				D
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "e" ) )?>">
				E
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "f" ) )?>">
				F
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "g" ) )?>">
				G
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "h" ) )?>">
				H
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "i" ) )?>">
				I
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "j" ) )?>">
				J
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "k" ) )?>">
				K
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "l" ) )?>">
				L
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "m" ) )?>">
				M
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "n" ) )?>">
				N
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "o" ) )?>">
				O
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "p" ) )?>">
				P
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "q" ) )?>">
				Q
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "r" ) )?>">
				R
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "s" ) )?>">
				S
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "t" ) )?>">
				T
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "u" ) )?>">
				U
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "v" ) )?>">
				V
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "w" ) )?>">
				W
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "x" ) )?>">
				X
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "y" ) )?>">
				Y
			</a>
		</li>
		<li>
			<a href="<?php echo esc_url( add_query_arg( 'start', "z" ) )?>">
				Z
			</a>
		</li>
	</ul>
</div>

<?php

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
	'posts_per_page'	=>	6,
	'post_type'			=>	'company',
	'orderby'			=>	'title',
	'order'				=>	'ASC',
	'paged'				=>	$paged
	);


if(isset($_GET['start'])&&!empty($_GET['start'])) {
	$args['sector_title'] = esc_attr( sanitize_text_field( $_GET['start'] ) );
}


if(isset($_GET['cat'])&&!empty($_GET['cat'])) {

	$args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key'     => 'company_sector_obj_%_sector_obj',
			'value'   => esc_attr( sanitize_text_field( $category_id ) ),
			'compare' => '='
			)
		);
	$args['sector_company'] = "sector_company";

}


if(isset($_GET['q'])&&!empty($_GET['q'])) {
	$args['s'] = $_GET['q'];
}

$the_query = new WP_Query( $args );

$pageposts = array();
if(isset($_GET['q'])&&!empty($_GET['q'])) {

	$q = esc_attr( sanitize_text_field($_GET['q'] ) );
	$query = "
	SELECT
		*
	FROM
		wp_posts p
	WHERE
		p.post_type = 'company'
		AND p.post_status = 'publish'
		AND (
			p.id IN (
				SELECT
					meta_value um2
				FROM
					wp_usermeta um2
				WHERE
					um2.meta_key LIKE 'company'
					AND um2.user_id IN (

						SELECT
							um.user_id
						FROM
							wp_usermeta um
						WHERE
							(
								um.meta_key = 'first_name'
								OR um.meta_key = 'last_name'
							)
							AND meta_value LIKE '%{$q}%'
						)
				)
			OR p.post_title LIKE '%{$q}%'
		)";
	$pageposts = $wpdb->get_results($query, OBJECT);

} else {

	$the_query = new WP_Query( $args );

}

?>

<div class="adelle_grid">

	<?php

	if (count($pageposts)>0) {
		include 'templates-companies-inc-q.php';
	} else {
		include 'templates-companies-inc-obj.php';
	}

		?>

		<div class="clearfix"></div>

		<div class="pagination_wrap">
			<ul class="pagination_list">
				<?php

				$big = 999999999;

				echo paginate_links(
					array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $the_query->max_num_pages
						)
					);

				?>
			</ul>
		</div>
	</div>

		<div class="m_member_to_events mt_0" style="display:none;">
			<div class="m_text_find_event">
				<h3>Devenez Membres Dès à Present et Bénéficez d’une</h3>
				<h3>Réduction pour tous nos Évènements</h3>
			</div>
			<div class="holding_card">
				<img class="m_logo_img" src="<?php echo content_url(); ?>/uploads/2017/01/holding-card.png" alt="FBG FOoter Logo">
			</div>
		</div>

		<div class="m_events_in_future">
			<h2>Suggéstion de Profils</h2>
		</div>
		<div class="m_slider_on_page">
			<div class="owl_carousel_slider">
				<?php suggestion_profile(); ?>
			</div>
		</div>
		<div class="m_due_cols">
			<div class="m_col1">
				<div class="m_image_col1">
					<img src="<?php echo content_url(); ?>/uploads/2017/01/phone-in-hand.png" alt="phone-in-hand">
				</div>
				<div class="m_present_consult txtaC">
					<p>Telechargez des a present </p>
					<p>notre FBG app et consultez l’annuaire ou que vous soyez !</p>
				</div>
			</div>
			<div class="m_col2">
				<div class="m_benefits">
					<p>Bénéficiez dès à présent de votre</p>
					<p><strong>carte privilège membre</strong></p>
				</div>
				<div class="m_obtain_cart p_r m_t_20">
					<img src="<?php echo content_url(); ?>/uploads/2017/01/blue-sticker.png" alt="sticker">
					<p>Obtenir une carte</p>
				</div>
				<div class="m_cart_img">
					<img src="<?php echo content_url(); ?>/uploads/2017/01/m-cart.png" alt="cart">
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


	<div id="dialog" class="white_content" style="display: none">
		<div id="dvMap" style="height: 380px; width: 580px;">
		</div>
		<a href="javascript:void(0)" onclick="document.getElementById('fade').style.display='none';document.getElementById('dialog').style.display='none'">Close</a>
	</div>
	<div id="fade" class="black_overlay"></div>


	<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/owl.theme.css">

	<script type='text/javascript' src='<?php echo content_url(); ?>/themes/Avada/assets/js/owl.carousel.min.js'></script> 

	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
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


		var geocoder;
		var map;
		var address = "";

		function initialize_map(address) {
			geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(-34.397, 150.644);
			var myOptions = {
				zoom: 10,
				center: latlng,
				mapTypeControl: true,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
				},
				navigationControl: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById("dvMap"), myOptions);

			if (geocoder)
			{
				geocoder.geocode({
					'address': address
				}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {

							var infowindow = new google.maps.InfoWindow({
								content: '<b>' + address + '</b>',
								size: new google.maps.Size(150, 50)
							});

							var marker = new google.maps.Marker({
								position: results[0].geometry.location,
								map: map,
								title: address
							});
							google.maps.event.addListener(marker, 'click', function() {
								infowindow.open(map, marker);
							});

							document.getElementById('dialog').style.display='block';
							document.getElementById('fade').style.display='block';

							google.maps.event.trigger(map, "resize");
							map.setCenter(results[0].geometry.location);

						} else {
							swal1('Address', 'No results found', 'OK');
							return;
						}
					} else {
						swal1('Address', 'No results found', 'OK');
						return;
					}
				});
			}		

		}

	</script>
	<?php

	get_footer();
