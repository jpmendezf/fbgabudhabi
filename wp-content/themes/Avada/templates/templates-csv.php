<?php

/**
* Template Name: CSV
*/


exit;
exit;
exit;
exit;

$result = $wpdb->get_results("
	SELECT
		*
	FROM
		wp_posts
	WHERE
		post_type LIKE 'company'
		AND post_status LIKE 'publish'
	");

foreach ($result as $row) {

	$value_sectors = array();
	$id = $row->ID;
	$var = get_field('company_sectors', $id);

	foreach($var as $k => $v) {

		$sector_unic = strtoupper( trim( $v['company_sector'] ) );

		if( isset($v['company_sector']) && !empty($v['company_sector']) ) {

			$post_sector = $wpdb->get_results("
			SELECT
				*
			FROM
				wp_posts
			WHERE
				post_title LIKE '%{$sector_unic}%'
				AND post_type LIKE 'sector'
				AND post_status LIKE 'publish'
			");

			foreach ($post_sector as $row_sector) {
				array_push( $value_sectors,	array("sector_obj" => $row_sector->ID) );
			}
		}
	}

	$value_sectors = array_unique($value_sectors, SORT_REGULAR);

	// print_r();
	// exit;

	if(count($value_sectors)>0) {
		update_field('company_sector_obj', $value_sectors, $id);
	}
}


exit;
exit;
exit;
exit;
exit;
exit;
exit;
exit;

?>

<?php

$file = fopen('Contact.csv', 'r');

// skip first line
fgetcsv($file);

while (($line = fgetcsv($file)) !== FALSE) {

	echo "<pre>";
	print_r($line[8]);
	echo "</pre>";
	// continue;

	$contact_id = $line[0];
	$corporate_account_id = $line[7];

	$description = "";
	$fname = $line[4];
	$lname = $line[5];
	$position = $line[9];

	$resident = $line[32];
	$city = $line[28] ." ". $line[26];
	$mobile = $line[15];
	$fax = $line[14];
	$email = $line[8];

	$id_companie = 14843;
	$result = $wpdb->get_results("
		SELECT
			* 
		FROM
			`wp_postmeta` 
		WHERE
			`meta_value` LIKE '{$corporate_account_id}'
		LIMIT
			0 , 30
		");
	foreach ($result as $row) {
		$id_companie = $row->post_id;
	}

	if( email_exists( $email ) || empty($email) ) {
		echo "1";
		continue;
	} else {
		echo "2";
		// email doesn't exists
		$password = wp_generate_password( 12, false );
		$user_id = wp_create_user( $email, $password, $email );

		// Set the nickname
		wp_update_user(
			array(
				'ID'		=>	$user_id,
				'nickname'	=>	$email
				)
			);

		update_field('contact_id', $contact_id, "user_".$user_id);
		update_field('corporate_account_id', $corporate_account_id, "user_".$user_id);
		update_field('description', $description, "user_".$user_id);
		update_field('first_name', $fname, "user_".$user_id);
		update_field('last_name', $lname, "user_".$user_id);
		update_field('position', $position, "user_".$user_id);
		update_field('resident', $resident, "user_".$user_id);
		update_field('city', $city, "user_".$user_id);
		update_field('mobile', $mobile, "user_".$user_id);
		update_field('fax', $fax, "user_".$user_id);

		update_field('company', $id_companie, "user_".$user_id);


		// Set the role
		$user = new WP_User( $user_id );
		$user->set_role( 'subscriber' );
	}

	// exit;

}


fclose($file);
exit;



$file = fopen("contacte.csv","r");

// $email = fgetcsv($file);
while(! feof($file))
{

// echo fgetcsv($file)[0];



	$email = fgetcsv($file);
	print_r($email);
	echo "<br>";
// // 	$description = "";
// 	$fname = fgetcsv($file)[5];
	// echo $fname;
	// $lname = fgetcsv($file)[6];
	// echo $lname;
// 	$password = generatePassword(8);

// 	$short_bio = "";
// 	$position = fgetcsv($file)[10];
// 	$nationality = "";

// 	$french = "";
// 	$resident = "";


// 	$city = fgetcsv($file)[29];
// 	$pobox = fgetcsv($file)[31];
// 	$mobile = fgetcsv($file)[16];
// 	$fax = fgetcsv($file)[15];
// 	$company = fgetcsv($file)[7];

// 	if( null == username_exists( $email ) ) {

// 		$user_id = wp_create_user( $email, $password, $email );

// 		wp_update_user(
// 			array(
// 				'ID'		=>	$user_id,
// 				'nickname'	=>	$email
// 				)
// 			);

// 		update_field('description', $description, "user_".$user_id);
// 		update_field('first_name', $fname, "user_".$user_id);
// 		update_field('last_name', $lname, "user_".$user_id);
// 		update_field('short_bio', $short_bio, "user_".$user_id);
// 		update_field('position', $position, "user_".$user_id);
// 		update_field('nationality', $nationality, "user_".$user_id);
// 		update_field('french', $french, "user_".$user_id);
// 		update_field('resident', $resident, "user_".$user_id);
// 		update_field('city', $city, "user_".$user_id);
// 		update_field('pobox', $pobox, "user_".$user_id);
// 		update_field('mobile', $mobile, "user_".$user_id);
// 		update_field('fax', $fax, "user_".$user_id);
// 		update_field('company', $company, "user_".$user_id);


// 		$user = new WP_User( $user_id );
// 		$user->set_role( 'subscriber' );

	
// }

	// print_r(fgetcsv($file));

}

fclose($file);




// // companyes
// $file = fopen('CorporateAccount.csv', 'r');

// // skip first line
// fgetcsv($file);

// while (($line = fgetcsv($file)) !== FALSE) {

// 	// print_r($line);exit;

// 	$post_title = $line[3];
// 	$post_content = $line[22];
// 	$corporate_account_id = $line[0];
// 	$corporate_account_owner_id = $line[2];
// 	$corporate_account_type = $line[9];
// 	$po_box_no = $line[25];
// 	$city = $line[20] ." ". $line[21];
// 	$phone = $line[4];
// 	$fax = $line[5];
// 	$email = $line[27];
// 	$website = $line[8];
// 	$total_number_of_employees_worldwide = $line[11];
// 	$total_number_of_employees_uae = $line[11];


// 	$the_post_id  = wp_insert_post(
// 		array (
// 			'post_type' => 'company',
// 			'post_title' => $post_title,
// 			'post_content' => $post_content,
// 			'post_status' => 'publish',
// 			'comment_status' => 'closed'
// 			)
// 		);

// 	update_field('corporate_account_id', $corporate_account_id, $the_post_id);
// 	update_field('corporate_account_owner_id', $corporate_account_owner_id, $the_post_id);
// 	update_field('corporate_account_type', $corporate_account_type, $the_post_id);
// 	update_field('po_box_no', $po_box_no, $the_post_id);
// 	update_field('city', $city, $the_post_id);
// 	update_field('phone', $phone, $the_post_id);
// 	update_field('fax', $fax, $the_post_id);
// 	update_field('email', $email, $the_post_id);
// 	update_field('website', $website, $the_post_id);
// 	update_field('total_number_of_employees_worldwide', $total_number_of_employees_worldwide, $the_post_id);
// 	update_field('total_number_of_employees_uae', $total_number_of_employees_uae, $the_post_id);


// 	$sectors =  explode( ';', $line[24]);

// 	$value_sectors = array();
// 	foreach ($sectors as $key => $value) {
// 		array_push($value_sectors, array("company_sector"	=> strtoupper(trim($value)) ) );
// 	}

// 	if(count($value_sectors)>0) {
// 		// save a repeater field value
// 		update_field('company_sectors', $value_sectors, $the_post_id );
// 	}
// }

// fclose($file);
// exit;
// // companyes



function generatePassword($length = 8) {
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$count = mb_strlen($chars);

	for ($i = 0, $result = ''; $i < $length; $i++) {
		$index = rand(0, $count - 1);
		$result .= mb_substr($chars, $index, 1);
	}

	return $result;
}