<?php


function custom_css_fs() {
	// echo "
	// <link rel='stylesheet' href='".content_url()."/themes/Avada/assets/css/lists.css'>
	// <link rel='stylesheet' href='".content_url()."/themes/Avada/assets/css/events.css'>
	// ";
}


function companies_form_search_fs($atts) {

	$placeholder = "Search for companies";
	if( isset($atts['placeholder']) ) {
		$placeholder = $atts['placeholder'];
	}

	echo "
	<div class='banner_top_on_list_categories'>
		<div class='set_dimensions_to_banner_top'>
			<img src='" . content_url() . "/uploads/2017/01/banner_top_img.jpg' alt=''>
			<div class='include_search_on_list_categories_top'>
				<form action='" .  get_permalink(13750) . "'>

					<input type='text' name='q' placeholder='" . $placeholder . "' class='style_input_search_on_page_list' value='" .  $_GET['q'] . "'>
					<div class='include_button_submit_on_page_list'>
						<button type='submit'>
							<i class='fa fa-search'></i>
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	";

}


function corporate_sectors_title_fs() {

	$back = "";
	if(isset($_GET['start'])) {
		$back = '
		<a href="' . get_permalink(13726) . '">
			<i class="fa fa-arrow-left" aria-hidden="true"></i>
			<span>Back</span>
		</a>
		';
	}

	$title = "Corporate Sectors";
	if( isset($atts['title']) ) {
		$title = $atts['title'];
	}

    if(ICL_LANGUAGE_CODE == 'fr') {
        $title = "Secteurs";
    }

	echo '
	<div class="title_categories">
		<div class="m_events_in_future style_events_on_page">
			<h2>' . $title . '</h2>
		</div>
		<div class="back_button_right">
			' . $back . '
		</div>
	</div>
	';

}


function corporate_sectors_subtitle_fs($atts) {

	$title = "All Sectors";
	if( isset($atts['title']) ) {
		$title = $atts['title'];
	}

	echo '
	<div class="display_alphabetic_bar txtaC">
		<a class="link_to_all_sectors" href="javascript:void(0)">' . $title . '</a>
	</div>
	';

}


function corporate_sectors_list_fs() {
	
	$returned_list = "";

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	$args = array(
		'posts_per_page'	=>	12,
		'post_type'			=>	'sector',
		'orderby'			=>	'title',
		'order'				=>	'ASC',
		'paged'				=>	$paged
		);


	if(isset($_GET['start'])&&!empty($_GET['start'])) {
		$args['sector_title'] = esc_attr( sanitize_text_field( $_GET['start'] ) );
	}

	$the_query = new WP_Query( $args );

	$returned_list .= '<div class="list_grid addBB">';


	if( $the_query->have_posts() ) {
		while( $the_query->have_posts() ) {
			$the_query->the_post();


			$post_slug = get_post_field( 'post_name', get_post() );

			$returned_list .= '<div class="item_grid">';
			$returned_list .= '<div class="img_wrap">';
			$returned_list .= '<a class="company_img" href="' . esc_url( add_query_arg( 'cat', $post_slug, get_permalink(13750) ) ) . '">';
			$returned_list .= '<img src="' . wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) . '" alt="picture">';
			$returned_list .= '</a>';
			$returned_list .= '<h5 class="company_name">' . get_the_title() . '</h5>';
			$returned_list .= '</div>';
			$returned_list .= '</div>';

		}
	}


	$returned_list .= '<div class="clearfix"></div>';
	$returned_list .= '</div>';

	wp_reset_query();

	$returned_list .= '<div class="pagination_wrap">';
	$returned_list .= '<ul class="pagination_list">';

	$big = 999999999;

	$returned_list .= 
	paginate_links(
		array
		(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $the_query->max_num_pages
			)
		);


	$returned_list .= '</ul>';
	$returned_list .= '</div>';

	echo $returned_list;

}


function custom_bottom_fs() {
	// echo "
	// <link rel='stylesheet' href='".content_url()."/themes/Avada/assets/css/owl.carousel.css'>
	// <link rel='stylesheet' href='".content_url()."/themes/Avada/assets/css/owl.theme.css'>
	// <script type='text/javascript' src='".content_url()."/themes/Avada/assets/js/owl.carousel.min.js'></script>
	// ";
}




function companies_page_title_fs($atts) {

	global $wpdb;

	$back = "";
	if(isset($_GET['start'])) {
		$back = '
		<a href="' . get_permalink(13750) . '">
			<i class="fa fa-arrow-left" aria-hidden="true"></i>
			<span>Back</span>
		</a>
		';
	}

	$category = "Companies";
	if( isset($atts['title']) ) {
		$category = $atts['title'];
	}

	$users = "Individual members";
	$category_id = 0;


	if(isset($_GET['cat'])&&!empty($_GET['cat'])) {

		$sector_company = esc_attr( sanitize_text_field( $_GET['cat'] ) );

		$result5 = $wpdb->get_results("SELECT ID, post_title FROM wp_xpksy4skky_posts WHERE `post_name` LIKE '{$sector_company}'");	
		foreach ($result5 as $row5) {
			$category = $row5->post_title;
			$category_id = $row5->ID;
		}
	}


	echo '
	<div class="title_categories">
		<div class="m_events_in_future style_events_on_page">
			<h2>' . $category . '</h2>
		</div>
		<div class="back_button_right">
			' . $back . '
		</div>
	</div>
	';

}



function companies_page_letters_fs($atts) {

	echo '<div class="display_alphabetic_bar">
	<ul class="ul_alphabetic_bar">
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "a" ) ) . '" class="active_link_on_alphabetic_sort">
				A
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "b" ) ) . '">
				B
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "c" ) ) . '">
				C
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "d" ) ) . '">
				D
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "e" ) ) . '">
				E
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "f" ) ) . '">
				F
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "g" ) ) . '">
				G
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "h" ) ) . '">
				H
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "i" ) ) . '">
				I
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "j" ) ) . '">
				J
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "k" ) ) . '">
				K
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "l" ) ) . '">
				L
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "m" ) ) . '">
				M
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "n" ) ) . '">
				N
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "o" ) ) . '">
				O
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "p" ) ) . '">
				P
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "q" ) ) . '">
				Q
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "r" ) ) . '">
				R
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "s" ) ) . '">
				S
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "t" ) ) . '">
				T
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "u" ) ) . '">
				U
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "v" ) ) . '">
				V
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "w" ) ) . '">
				W
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "x" ) ) . '">
				X
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "y" ) ) . '">
				Y
			</a>
		</li>
		<li>
			<a href="' . esc_url( add_query_arg( 'start', "z" ) ) . '">
				Z
			</a>
		</li>
	</ul>
</div>';
}

function companies_page_companies_show_fs($atts) {

	global $wpdb;

	$category_id = 0;


	if(isset($_GET['cat'])&&!empty($_GET['cat'])) {

		$sector_company = esc_attr( sanitize_text_field( $_GET['cat'] ) );

		$result5 = $wpdb->get_results("SELECT ID, post_title FROM wp_xpksy4skky_posts WHERE `post_name` LIKE '{$sector_company}'");	
		foreach ($result5 as $row5) {
			$category = $row5->post_title;
			$category_id = $row5->ID;
		}
	}



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
			wp_xpksy4skky_posts p
		WHERE
			p.post_type = 'company'
			AND p.post_status = 'publish'
			AND p.id <> '14843'
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

		if(isset($_GET['start'])&&!empty($_GET['start'])) {
			$query .= " AND p.post_title LIKE '" . esc_sql( $wpdb->esc_like( $_GET['start'] ) ) . "%'";
		}

		$pageposts = $wpdb->get_results($query, OBJECT);

	} else {

		$the_query = new WP_Query( $args );

	}



	echo '<div class="adelle_grid">';



	if (count($pageposts)>0) {
		include 'templates/templates-companies-inc-q.php';
	} else {
		include 'templates/templates-companies-inc-obj.php';
	}

	echo '
	<div class="clearfix"></div>

	<div class="pagination_wrap">
		<ul class="pagination_list">';


			$big = 999999999;

			echo paginate_links(
				array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $the_query->max_num_pages
					)
				);

			echo '
		</ul>
	</div>
</div>';


echo '
<script>
	function swal1(title, text, confirmButtonText){
		swal({
			title: title,
			html: text,
			confirmButtonText: confirmButtonText
		})
	};
</script>
';
}


function all_pages_become_member_banner_fs($atts) {
	global $wpdb;
	$image = get_field('image_become_a_member_banner', 'option');

echo '
		<div class="m_member_to_events mt_0">
			<div class="m_text_find_event">'.get_field('text_become_a_member_banner', 'option').'</div>
			<div class="holding_card">';
				$image = get_field('image_become_a_member_banner', 'option');
				if( !empty($image) ):
					echo '<img src="'.$image['url'].'" alt="'. $image['alt'] .'" />';
				endif;
			echo '</div>
		</div>';
}

function all_pages_split_banners_fs($atts) {

echo '
			<div class="m_due_cols">
			<div class="m_col1">
				<div class="m_image_col1">';
					$image = get_field('image_bottom_banner_left', 'option');
					if( !empty($image) ):
						echo '<img src="'. $image['url'].'" alt="'. $image['alt'].'" />';
					endif;
echo '				
				</div>
				<div class="m_present_consult txtaC">';
					the_field('text_bottom_banner_left', 'option');
echo '				
				</div>
			</div>
			<div class="m_col2">
				<div class="m_benefits">';
					the_field('text_bottom_banner_right', 'option');
echo '
				</div>
				<div class="m_obtain_cart p_r m_t_20">
					<a href="<?php'.get_field('button_link', 'option').'">
						<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/blue-sticker.png" alt="sticker">
						<p>'.get_field('button_title', 'option').'</p>
					</a>
				</div>
				<div class="m_cart_img">';
					$image = get_field('image_bottom_banner_right', 'option');
					if( !empty($image) ):
						echo '<img src="'. $image['url'].'" alt="'. $image['alt'].'" />';
					endif;
echo '
				</div>
			</div>
		</div>';
}

function individual_form_search_fs($atts) {

// Rechercher un membre individuel

if(ICL_LANGUAGE_CODE=='fr') {
       $strSrchText = "Rechercher un membre";
}
else{
    $strSrchText = "Search for Member";
}

echo '
	<div class="banner_top_on_list_categories">
	<div class="set_dimensions_to_banner_top">
		<img src="'.content_url().'/uploads/2017/01/banner_top_img.jpg" alt="">
		<div class="include_search_on_list_categories_top">
			<form action="' .get_permalink(14918).'">
				<input type="text" name="q" placeholder=" ' . $strSrchText .  ' " class="style_input_search_on_page_list" value="' . $_GET['q'] . '">
				<div class="include_button_submit_on_page_list">
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>';

}

function individuals_page_title_fs($atts) {
if(ICL_LANGUAGE_CODE=='fr') {
   $category = "Membre";
}
else{
    $category = "Member";
}

echo '
	<div class="title_categories">
	<div class="m_events_in_future style_events_on_page">
		<h2>'. $category.'</h2>
	</div>
	<div class="back_button_right">';
		if(isset($_GET['start']) || isset($_GET['q'])) {
		echo '<a href="'.get_permalink(14918).'">
			<i class="fa fa-arrow-left" aria-hidden="true"></i>
			<span>Back</span>
		</a>';
		}
echo '
	</div>
</div>';
}


function individuals_page_query_fs($atts) {

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


echo '<div class="adelle_grid">';

	if (count($pageposts)>0) {
		include 'templates/templates-users-inc-q.php';
	} else {
		include 'templates/templates-users-inc-obj.php';
	}

echo '
		<div class="clearfix"></div>

		<div class="pagination_wrap">
			<ul class="pagination_list">';

				$big = 999999999;

				echo paginate_links(
					array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $total_pages
						)
					);
echo '
			</ul>
		</div>
	</div>';

echo '
<script>
	function swal1(title, text, confirmButtonText){
		swal({
			title: title,
			html: text,
			confirmButtonText: confirmButtonText
		})
	};
</script>
';

}

function user_datail_search_fs($atts) {

if(ICL_LANGUAGE_CODE=='fr') {
       $strSrchText = "Rechercher un membre individuel";
}
else{
    $strSrchText = "Search for Member";
}

echo '

<div class="banner_top_on_list_categories">
	<div class="set_dimensions_to_banner_top">
		<img src="'.content_url().'/uploads/2017/01/banner_top_img.jpg" alt="">
		<div class="include_search_on_list_categories_top">
			<form action="' .get_permalink(14918).'">
				<input type="text" name="q" placeholder=" ' . $strSrchText . ' " class="style_input_search_on_page_list" value="' . $_GET['q'] . '">
				<div class="include_button_submit_on_page_list">
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>';
}

function user_detail_title_fs($atts) {
echo '
<div class="title_categories">
	<div class="m_events_in_future style_events_on_page">
		<h2>Member</h2>
	</div>
</div>';
}

function user_detail_image_fs($atts) {

if (isset($_GET['uid']) && !empty($_GET['uid'])) {
	$company_id = $_GET['uid'];
} else {
	wp_redirect(home_url());
}

echo '
		<div class="content_on_company_on_page">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="left_details_company_on_page">
						<div class="row">
							<div class="col-md-1 col-sm-12 col-xs-12"></div>
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
									<div class="set_img_company">
										<a class="company_img fullwh_img" href="javascript:void(0)">';

											$image = get_field('user_picture','user_'.$company_id);
											if(strlen($image) == 0) {
												$image = content_url() . "/uploads/2017/01/new-FBG-logo_transparent.png";
											}

											if( !empty($image) ):

												echo '<img src="'.$image.'" alt="" />';

										endif;
								echo '
										</a>

									</div>
								</div>';
}

function user_detail_name_fs($atts) {
$company_id = $_GET['uid'];
echo '
<div class="detail_page">
	<div class="top_company_on_page">
		<div class="style_company_and_individual_name_title txtaC">
			<h3>'. get_field('first_name','user_'.$company_id).' '.get_field('last_name','user_'.$company_id).'</h3>
		</div>';
}

function user_detail_details_fs($atts) {
	$company_id = $_GET['uid'];
	$fax_nr=get_field('fax', 'user_'.$company_id);
	$city_nr=get_field('city', 'user_'.$company_id);
	$phone_nr=get_field('mobile', 'user_'.$company_id);
	$position=get_field('position', 'user_'.$company_id);

	$user_info = get_userdata($company_id);
	$mailadresje = $user_info->user_email;


	$company = get_field('company', 'user_'.$company_id);
	$company_name = $company->post_title;

	$user_type = "Corporate";

	if($company->ID == "14843" || $company->ID=="") {
		$company_name = $company_img = "";
		$user_type = "Individual";
		$company->ID="14843";
	}

	if(is_user_logged_in()) {

		$phone_icon = '<i class="fa fa-phone" aria-hidden="true"></i>';
		$mail_icon = '<i class="fa fa-mail" aria-hidden="true"></i>';

		$phone_display = $mail_display = "";

		if(strlen($phone_nr) == 0) { $phone_nr = ""; $phone_icon = ''; $phone_display = ' style="display:none" '; }
		if(strlen($mailadresje) == 0) { $mailadresje = ""; $mail_icon = ''; $mail_display = ' style="display:none" '; }

		$company_details = <<<EOF
		<a onclick="swal1('Phone', '{$phone_nr}', 'OK');" class="button_sm" {$phone_display}>
			{$phone_icon}
		</a>
		<a onclick="swal1('Email', '{$mailadresje}', 'OK');" class="button_sm" {$mail_display}>
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

	echo '
	<div class="col-md-5 col-sm-12 col-xs-12 pl_0 pr_0">
		<div class="activity_sectors">
			<div class="member_period">
				<p>'.$position.'</p>
				<p>'.$company_name.'</p>
				<p>'.$user_type.'</p>
			</div>
			<div class="include_icons">
				<div class="bottom_buttons m_set_mt_20">
					'.$company_details.'
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>';

echo '
<script>
	function swal1(title, text, confirmButtonText){
		swal({
			title: title,
			html: text,
			confirmButtonText: confirmButtonText
		})
	};
</script>
';

}

function user_detail_company_fs($atts) {

$company_id = $_GET['uid'];

	if($company->ID == "14843" || $company->ID=="") {
		$company_name = $company_img = "";
		$user_type = "Individual";
		$company->ID="14843";
	}

$company = get_field('company', 'user_'.$company_id);
$company_name = $company->post_title;

$image = get_field('company_picture', $company->ID);
if(strlen($image) == 0) {
	$image = content_url() . "/uploads/2017/01/new-FBG-logo_transparent.png";
}
// $link_companie_user=get_permalink($company->ID);
// if ($company->ID=="14843") {
// 	$link_companie_user="javascript:void(0)";
// }
$company_img = "<a href='" . get_permalink($company->ID) . "'><img src='" . $image . "' alt='' /></a>";

if($company->ID == "14843" || $company->ID == "") {
	$company_name = $company_img = "";
}

echo '
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="desc_company_individual_name mg_b_50">

						<div class="activity_sectors member_period">
							<p>'.$company_name.'</p>
							'.$company_img.'
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>';

}