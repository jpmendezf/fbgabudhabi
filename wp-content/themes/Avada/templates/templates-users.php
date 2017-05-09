<?php

/**

 * Template Name: Users Templates

 */



?>

<?php get_header(); ?>

<style>
	.fusion-footer {
		padding-left: 300px;
	    padding-top: 25px;
	    padding-bottom: 20px;
	}
	.footer-copyright-text p {line-height: 2;}
</style>

<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/events.css">
<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/lists.css">


<link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.js"></script>

<?php

$users = "Individual members";
$category = "Individuals";

?>


<div class="banner_top_on_list_categories">
	<div class="set_dimensions_to_banner_top">
		<img src="<?php echo content_url(); ?>/uploads/2017/01/banner_top_img.jpg" alt="">
		<div class="include_search_on_list_categories_top">
			<form action="<?php echo get_permalink(14918); ?>">
				
				<input type="text" name="q" placeholder="Search for Individuals" class="style_input_search_on_page_list" value="<?php if(isset($_GET['q'])) echo $_GET['q'];?>">
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
		<?php if(isset($_GET['start']) || isset($_GET['q'])) { ?>
		<a href="<?php echo get_permalink(14918); ?>">
			<i class="fa fa-arrow-left" aria-hidden="true"></i>
			<span>Back</span>
		</a>
		<?php } ?>
	</div>
</div>
<!-- <div class="display_alphabetic_bar">
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
</div> -->

<?php

$number = 10;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $number;
$users = get_users();
$total_users = count($users);
$total_pages = (int) $total_users / $number + 1;


$args  = array(
	'orderby'			=> 'display_name',
	'role'				=> 'subscriber',
	'paged'				=> $paged,
	'offset'			=> $offset,
	'number'			=> $number
	);

if(isset($_GET['q'])&&!empty($_GET['q'])) {
	$qs = esc_attr( $_GET['q'] );

	$args['meta_query'] = array(
		'relation' => 'OR',
		array(
			'key'     => 'first_name',
			'value'   => $qs,
			'compare' => 'LIKE'
			),
		array(
			'key'     => 'last_name',
			'value'   => $qs,
			'compare' => 'LIKE'
			)
		);
} else {
	$args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key'     => 'company',
			'value'   => '14843',
			'compare' => '='
			)
		);
}

$wp_user_query = new WP_User_Query($args);

$usersqq = $wp_user_query->get_results();

?>

<div class="adelle_grid">

	<?php

	if (count($pageposts)>0) {
		include 'templates-users-inc-q.php';
	} else {
		include 'templates-users-inc-obj.php';
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
						'total' => $total_pages
						)
					);
				?>
			</ul>
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




		
	</div>

	<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/owl.theme.css">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
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
			});
		};

	</script>
	<?php

	get_footer();
