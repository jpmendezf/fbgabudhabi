<?
// for Indivituals

    include_once("header.php");
include_once("../wp-blog-header.php");

if(isset($_REQUEST['user_id'])){
    $user_id = $_REQUEST['user_id'];
}
else{
    $user_id = 0;
}

/* connect to the db */
	$link = mysql_connect($server,$dbUser,$dbPass) or die('Cannot connect to the DB');
	mysql_select_db($dbName,$link) or die('Cannot select the DB');

   $query = " SELECT u.ID emp_ID, CONVERT(CAST(u.display_name as BINARY) USING latin1) as display_name,  CONVERT(CAST(u.user_email as BINARY) USING latin1) as emp_email,
                        CONVERT(CAST(emp_firstname.meta_value as BINARY) USING latin1)        AS emp_firstname,
                        CONVERT(CAST(emp_lastname.meta_value as BINARY) USING latin1)        AS emp_lastname,
                        CONVERT(CAST(emp_position.meta_value as BINARY) USING latin1)        AS emp_position,
                        emp_description.meta_value AS emp_description,

                        CONVERT(CAST(emp_mobile.meta_value as BINARY) USING latin1)       AS emp_mobile,
                        CONVERT(CAST(emp_photo.meta_value as BINARY) USING latin1) AS       emp_photo ,
                        CONVERT(CAST(emp_company.meta_value as BINARY) USING latin1) AS  emp_company,
                        CONVERT(CAST(payment_status.meta_value as BINARY) USING latin1) AS payment_status,
                        CONVERT(CAST(contact_id.meta_value as BINARY) USING latin1) AS contact_id,
                        CONVERT(CAST(corporate_account_id.meta_value as BINARY) USING latin1) AS corporate_account_id

                        FROM wp_xpksy4skky_users AS u 
                        LEFT JOIN wp_xpksy4skky_usermeta AS um1 ON u.ID = um1.user_id 

                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_firstname
                                    ON u.ID = emp_firstname.user_id        
                                    AND emp_firstname.meta_key='first_name'

                        

                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_lastname
                                    ON u.ID = emp_lastname.user_id        
                                    AND emp_lastname.meta_key='last_name'

                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_photo
                                    ON u.ID = emp_photo.user_id        
                                    AND emp_photo.meta_key='user_picture'

                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_position
                                    ON u.ID = emp_position.user_id        
                                    AND emp_position.meta_key='position'
                         
                          LEFT JOIN wp_xpksy4skky_usermeta  AS emp_company
                                    ON u.ID = emp_company.user_id        
                                    AND emp_company.meta_key='company'
                          
                           LEFT JOIN wp_xpksy4skky_usermeta  AS emp_description
                                    ON u.ID = emp_description.user_id        
                                    AND emp_description.meta_key='description'

                         LEFT JOIN wp_xpksy4skky_usermeta AS payment_status
                             ON u.ID = payment_status.user_id        
                            AND payment_status.meta_key='paid_unpaid'

                         LEFT JOIN wp_xpksy4skky_usermeta AS contact_id
                             ON u.ID = contact_id.user_id        
                            AND contact_id.meta_key='contact_id'

                         LEFT JOIN wp_xpksy4skky_usermeta AS corporate_account_id
                             ON u.ID = corporate_account_id.user_id        
                            AND corporate_account_id.meta_key='corporate_account_id'

                        
                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_mobile
                                    ON u.ID = emp_mobile.user_id        
                                    AND emp_mobile.meta_key='mobile'

                        WHERE   1

                        GROUP BY u.ID
                        
                        ORDER BY emp_firstname" ;

	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

    $userdetails = array();
	if(mysql_num_rows($result)) {
		while($user = mysql_fetch_assoc($result)) {

            if(empty($user['emp_photo'])){
                $user['emp_photo'] = 0;
            }
            $result1 = mysql_query("SELECT wp_xpksy4skky_posts.ID, CONVERT(CAST(wp_xpksy4skky_posts.guid  as BINARY) USING latin1) AS imageName FROM wp_xpksy4skky_posts WHERE id = {$user['emp_photo']} LIMIT 1");



            $row1 = mysql_fetch_assoc($result1);
            $imgName = $row1['imageName'];

            if(!empty($imgName)){
                $user['emp_photo'] = $imgName;

            }
            else{
                $user['emp_photo'] = "";
            }
			
            


            if(!empty($user['emp_company'])){
                $companyName = get_the_title($user['emp_company']);
                $flagCorp = "Corporate";
            }
            else{
                $companyName = "";
                $flagCorp = "individual";
            }

            $user['emp_company'] = utf8_encode($companyName);

            $user['flag_corporate'] = $flagCorp;
          


           // array_push($post, $imgName);
            $userdetails[] = $user;

           

		}
	}


    $fp = fopen('file.csv', 'w');

    foreach ($userdetails as $fields) {
         fputcsv($fp, $fields);
    }

fclose($fp);

    print("<pre>");


   print_r($userdetails);
   print("</pre>");

  ?>
