<?
include_once("header.php");
include_once("../wp-blog-header.php");

if(isset($_REQUEST['user_id'])){
        $user_id = $_REQUEST['user_id'];
}
else{
    $user_id = 0;
}

if(!is_numeric($user_id)){
    $user_id = 0;
}

/* require the user as the parameter */
//if(isset($_GET['user']) && intval($_GET['user'])) {

	/* soak in the passed variable or set our own */
	$number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
	//$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
    $format = 'json';
	//$user_id = intval($_GET['user']); //no default

	/* connect to the db */
	$link = mysql_connect($server,$dbUser,$dbPass) or die('Cannot connect to the DB');
	mysql_select_db($dbName,$link) or die('Cannot select the DB');

  // $link = mysql_connect('localhost','root','') or die('Cannot connect to the DB');
 // mysql_select_db('jsontest',$link) or die('Cannot select the DB');

	/* grab the posts from the db */


    // Company listing

    // company_sectors

   // company_sectors_0_company_sector

//company_sectors_1_company_sector

//company_sectors_2_company_sector


// city, email, phone, fax, po_box_no, total_number_of_employees_uae , total_number_of_employees_worldwide, website, description

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

                        
                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_company
                                    ON u.ID = emp_company.user_id        
                                    AND emp_company.meta_key='company'

                        LEFT JOIN wp_xpksy4skky_usermeta AS payment_status
                                 ON u.ID = payment_status.user_id        
                                AND payment_status.meta_key='paid_unpaid'


                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_lastname
                                    ON u.ID = emp_lastname.user_id        
                                    AND emp_lastname.meta_key='last_name'

                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_photo
                                    ON u.ID = emp_photo.user_id        
                                    AND emp_photo.meta_key='user_picture'

                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_position
                                    ON u.ID = emp_position.user_id        
                                    AND emp_position.meta_key='position'

                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_description
                                    ON u.ID = emp_description.user_id        
                                    AND emp_description.meta_key='description'
                        
                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_mobile
                                    ON u.ID = emp_mobile.user_id        
                                    AND emp_mobile.meta_key='mobile'

                        WHERE   u.ID = '{$user_id}'  
                          ";
             
	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
      // $posts[] =  array("success" => "1");
		while($post = mysql_fetch_assoc($result)) {


            if($post['payment_status'] == 'paid'){
                $post['payment_status'] = 1;
            }
            else {
                $post['payment_status'] = 0;
            }
			
            if(empty($post['emp_photo'])){
                $post['emp_photo'] = 0;
            }
            $post['emp_companyID'] = $post['emp_company'];


            $companyID = $post['emp_companyID'];

            $imageId = "";
            $resIamge = $wpdb->get_results("SELECT `meta_value` FROM wp_xpksy4skky_postmeta WHERE post_id='{$post['emp_companyID']}' AND meta_key='company_picture'");	
            foreach ($resIamge as $rowPos) {
                $imageId = $rowPos->meta_value;
            }

             
             $result1 = mysql_query("SELECT wp_xpksy4skky_posts.ID, CONVERT(CAST(wp_xpksy4skky_posts.guid  as BINARY) USING latin1) AS imageName FROM wp_xpksy4skky_posts WHERE id = {$imageId} LIMIT 1");


                $row1 = mysql_fetch_assoc($result1);
                $imgName = $row1['imageName'];


                if(!empty($imgName)){
                    $post['company_logo'] = $imgName;
                }
                else{
                    $post['company_logo'] = "";
                }

           // $post['emp_company'] = "";

            if($post['emp_company'] == ""){
                $post['flag_corporate']  = "I";
                $companyName = "";

                $post['company_url'] = "";

            }
            else{
                $post['flag_corporate']  = "C";
                
                $companyName = get_the_title($post['emp_company']);
                $company_url = get_permalink($post['emp_company']);

                $post['company_url'] = $company_url;
            }

            $post['emp_company']  = $companyName;

           

            



            
            $result1 = mysql_query("SELECT wp_xpksy4skky_posts.ID, CONVERT(CAST(wp_xpksy4skky_posts.guid  as BINARY) USING latin1) AS imageName FROM wp_xpksy4skky_posts WHERE id = {$post['emp_photo']} LIMIT 1");



            $row1 = mysql_fetch_assoc($result1);
            $imgName = $row1['imageName'];

			if(!empty($imgName)){
                $post['emp_photo'] = $imgName;
            }
            else{
                $post['emp_photo'] = "";
            }

           $userLink = "http://fbgabudhabi.com/users-details/?uid=" . $user_id;

           $post['emp_url'] = $userLink;


           /*
              Function used to get the  employees

           */

           if($post['flag_corporate'] == 'C'){

                        $queryEmp =  " SELECT u.ID emp_ID, CONVERT(CAST(u.display_name as BINARY) USING latin1) as display_name,  CONVERT(CAST(u.user_email as BINARY) USING latin1) as emp_email,
                        CONVERT(CAST(emp_firstname.meta_value as BINARY) USING latin1)        AS emp_firstname,
                        CONVERT(CAST(emp_lastname.meta_value as BINARY) USING latin1)        AS emp_lastname,
                        CONVERT(CAST(emp_position.meta_value as BINARY) USING latin1)        AS emp_position,
                        CONVERT(CAST(emp_mobile.meta_value as BINARY) USING latin1)       AS emp_mobile,
                        CONVERT(CAST(emp_photo.meta_value as BINARY) USING latin1) AS       emp_photo ,
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

                        LEFT JOIN wp_xpksy4skky_usermeta AS payment_status
                             ON u.ID = payment_status.user_id        
                            AND payment_status.meta_key='paid_unpaid'


                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_position
                                    ON u.ID = emp_position.user_id        
                                    AND emp_position.meta_key='position'
                        
                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_mobile
                                    ON u.ID = emp_mobile.user_id        
                                    AND emp_mobile.meta_key='mobile'


                        WHERE  um1.meta_key = 'company' 
                        AND um1.meta_value = '{$companyID}' 
                        AND payment_status.meta_key = 'paid_unpaid' 
                        AND payment_status.meta_value = 'paid' 
                        
                        AND u.ID != '{$user_id}' " ;


                        $resultEmp = mysql_query($queryEmp) or die('Errant query:  '.$query);

                    $employee = array();

                    while($employes = mysql_fetch_assoc($resultEmp)) {

                        $resultadmin = $wpdb->get_results(" SELECT `meta_value` FROM wp_xpksy4skky_usermeta WHERE user_id='{$employes['emp_ID']}' AND meta_key='wp_xpksy4skky_capabilities' AND  LIKE '%administrator%' ");	
                        foreach ($resultadmin as $rowadmin) {
                            
                            $adminuser=true;
                        }

                        if($adminuser) {
                            continue;
                        } 

                        if(empty($employes['emp_photo'])){
                            $employes['emp_photo'] = 0;
                        }
                        $resultEmpPhoto = mysql_query("SELECT wp_xpksy4skky_posts.ID, wp_xpksy4skky_posts.guid imageName FROM wp_xpksy4skky_posts WHERE id = {$employes['emp_photo']} LIMIT 1");



                        $rowEmpPhoto = mysql_fetch_assoc($resultEmpPhoto);
                        $imgEmpName = $rowEmpPhoto['imageName'];
                        
                        $employes['emp_photo'] = $imgName;

                        if(!empty($imgEmpName)){
                            $employes['emp_photo'] = $imgEmpName;
                        }
                        else{
                            $employes['emp_photo'] = "";
                        }

                        $employee[] = array("employee"=>$employes);


                        //$employee['emp_image'] = strip_tags(get_avatar_url( $employee['emp_ID'], "", "", "", "" ));;
                        // $employee = array("employee"=>$employee);

                       
                       

                    }   

           }

           if($post['flag_corporate'] == 'C'){
                 $posts = array('status' => "1", 'userdetails'=>$post, "employees"=> $employee);

           }
           else{
                 $posts = array('status' => "1", 'userdetails'=>$post);
           }



		}
	}
    else{
         $posts = array("status" => "0");
    }

   




  

	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		sendResponse(200, json_encode($posts,true));
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