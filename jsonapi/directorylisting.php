<?
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


$flagPayment = 0;
if($user_id != 0){
    $queryPay .= "SELECT wpuser.ID user_id, wpuser.user_login user_name, wpuser.user_email user_email, payment_status.meta_value AS payment_status

                            FROM wp_xpksy4skky_users wpuser 

                            LEFT JOIN wp_xpksy4skky_usermeta AS payment_status
                             ON wpuser.ID = payment_status.user_id        
                            AND payment_status.meta_key='paid_unpaid'

                            WHERE wpuser.ID  = '{$user_id}' ";
                    
                    $result = mysql_query($queryPay,$link) or die('Print query:  '.$queryPay);

                    /* create one master array of the records */
                    $posts = array();
                    if(mysql_num_rows($result)) {
                      // $posts[] =  array("success" => "1");
                        while($post = mysql_fetch_assoc($result)) {

                           if($post['payment_status'] == 'paid'){
                               $post['payment_status'] = 1;
                               $flagPayment = 1;

                           }
                           else{
                               $post['payment_status'] = 0;
                               $flagPayment = 0;
                           }
                            
                          
                            

                           // array_push($post, $imgName);
                            $userArray  = $post;

                           

                        }
                    }
                    
}
/* require the user as the parameter */
//if(isset($_GET['user']) && intval($_GET['user'])) {

	/* soak in the passed variable or set our own */
	$number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
	//$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
    $format = 'json';


	$query = "SELECT wp_xpksy4skky_posts.ID company_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as company_name, 
            
            company_sector1.meta_value        AS company_sector1,
            company_sector2.meta_value        AS company_sector2,
            company_sector3.meta_value        AS company_sector3,
            company_logo.meta_value           AS company_logo

            FROM  wp_xpksy4skky_posts 
            LEFT JOIN wp_xpksy4skky_postmeta  AS company_sector1
             ON wp_xpksy4skky_posts.ID = company_sector1.post_id        
            AND company_sector1.meta_key='company_sector_obj_0_sector_obj'

            LEFT JOIN wp_xpksy4skky_postmeta  AS company_sector2
            ON wp_xpksy4skky_posts.ID = company_sector2.post_id        
            AND company_sector2.meta_key='company_sector_obj_1_sector_obj'

            LEFT JOIN wp_xpksy4skky_postmeta  AS company_sector3
            ON wp_xpksy4skky_posts.ID = company_sector3.post_id        
            AND company_sector3.meta_key='company_sector_obj_2_sector_obj'


            LEFT JOIN wp_xpksy4skky_postmeta  AS company_logo
            ON wp_xpksy4skky_posts.ID = company_logo.post_id        
            AND company_logo.meta_key='company_picture'

            WHERE wp_xpksy4skky_posts.post_status = 'publish'
            AND wp_xpksy4skky_posts.post_type = 'company' 
            ORDER BY company_name";
             
	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
      // $posts[] =  array("success" => "1");
		while($post = mysql_fetch_assoc($result)) {
			
           if(empty($post['company_logo'])){
                $post['company_logo'] = 0;
            }
            $result1 = mysql_query("SELECT wp_xpksy4skky_posts.ID, wp_xpksy4skky_posts.guid imageName FROM wp_xpksy4skky_posts WHERE id = {$post['company_logo']} LIMIT 1");


            $row1 = mysql_fetch_assoc($result1);
            $imgName = $row1['imageName'];


            if(!empty($imgName)){
                $post['company_logo'] = $imgName;
            }
            else{
                $post['company_logo'] = "";
            }

            $post['company_sector1'] = get_the_title($post['company_sector1']);
            if(empty($post['company_sector1'])){
                $post['company_sector1'] = "";
            }
            $post['company_sector2'] = get_the_title($post['company_sector2']);
            $post['company_sector3'] = get_the_title($post['company_sector3']);

            if(empty($post['company_sector2'])){
                $post['company_sector2'] = "";
            }
            if(empty($post['company_sector3'])){
                $post['company_sector3'] = "";
            }


           /* $result2 = mysql_query("SELECT wp_xpksy4skky_posts.ID, wp_xpksy4skky_posts.post_title venue FROM wp_xpksy4skky_posts WHERE id = {$post['event_venue']} LIMIT 1");


            $row2 = mysql_fetch_assoc($result2);
            $venue = $row2['venue'];

            $post['event_venue'] = $venue;*/


           // array_push($post, $imgName);
           // $posts[] = array('company'=>$post);
           $posts[] = array('company'=>$post);

           // $posts = array_merge(array('status' => "1"), $posts)
           

		}
	}
    else{
         $posts = array();
    }

    // for Indivituals

   $query = " SELECT u.ID emp_ID, CONVERT(CAST(u.display_name as BINARY) USING latin1) as display_name,  CONVERT(CAST(u.user_email as BINARY) USING latin1) as emp_email,
                        CONVERT(CAST(emp_firstname.meta_value as BINARY) USING latin1)        AS emp_firstname,
                        CONVERT(CAST(emp_lastname.meta_value as BINARY) USING latin1)        AS emp_lastname,
                        CONVERT(CAST(emp_position.meta_value as BINARY) USING latin1)        AS emp_position,
                        CONVERT(CAST(emp_mobile.meta_value as BINARY) USING latin1)       AS emp_mobile,
                        CONVERT(CAST(emp_photo.meta_value as BINARY) USING latin1) AS       emp_photo ,
                        CONVERT(CAST(emp_company.meta_value as BINARY) USING latin1) AS  emp_company,
                        CONVERT(CAST(payment_status.meta_value as BINARY) USING latin1) AS payment_status

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

                         LEFT JOIN wp_xpksy4skky_usermeta AS payment_status
                             ON u.ID = payment_status.user_id        
                            AND payment_status.meta_key='paid_unpaid'

                        
                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_mobile
                                    ON u.ID = emp_mobile.user_id        
                                    AND emp_mobile.meta_key='mobile'

                        WHERE   um1.meta_key = 'paid_unpaid' AND um1.meta_value = 'paid' 
                        
                        ORDER BY emp_firstname" ;

	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

    $userdetails = array();
	if(mysql_num_rows($result)) {
		while($user = mysql_fetch_assoc($result)) {

            $adminuser = false;

            $resultadmin = $wpdb->get_results(" SELECT `meta_value` FROM wp_xpksy4skky_usermeta WHERE user_id='{$user['emp_ID']}' AND meta_key='wp_xpksy4skky_capabilities' AND meta_value  LIKE '%administrator%' ");	
            foreach ($resultadmin as $rowadmin) {
                
                $adminuser = true;
            }

            if($adminuser) {
                continue;
            } 

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
                $flagCorp = "C";
            }
            else{
                $companyName = "";
                $flagCorp = "I";
            }

            $user['emp_company'] = utf8_encode($companyName);

            $user['flag_corporate'] = $flagCorp;
          


           // array_push($post, $imgName);
            $userdetails[] = array('memberdetails'=>$user);

           

		}
	}

   // print("<pre>");


  // print_r($userdetails);
  // print("</pre>");





  

	/* output in necessary format */
	if($format == 'json') {

        if($flagPayment != 0){
		


            sendResponse(200, json_encode(array("status" => "1", "userdetails"=>$userArray, 'company'=>$posts, 'members'=>$userdetails),true));

        }
        else if($user_id != 0){
            sendResponse(200, json_encode(array("status" => "1", "userdetails"=>$userArray, 'company'=>$posts),true));
        }
        else{
            sendResponse(200, json_encode(array("status" => "1",'company'=>$posts),true));
        }
	}
	else {
		header('Content-type: text/xml');
		echo '<posts>';
		foreach($posts as $index => $post) {
			if(is_array($post)) {
				foreach($post as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
							echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
						}
					}
					echo '</',$key,'>';
				}
			}
		}
		echo '</posts>';
	}

	/* disconnect from the db */
	@mysql_close($link);
//}
?>