<?
include_once("header.php");
include_once("../wp-blog-header.php");

if(isset($_REQUEST['company_id'])){
        $company_id = $_REQUEST['company_id'];
}
else{
    $company_id = 0;
}

if(!is_numeric($company_id)){
    $company_id = 0;
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


// city, email, phone, fax, po_box_no, total_number_of_employees_uae , total_number_of_employees_worldwide, website

	$query = "SELECT wp_xpksy4skky_posts.ID company_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as company_name, CONVERT(CAST(wp_xpksy4skky_posts.post_content as BINARY) USING latin1) as company_description, 
            
            company_sector1.meta_value        AS company_sector1,
            company_sector2.meta_value        AS company_sector2,
            company_sector3.meta_value        AS company_sector3,
            company_logo.meta_value           AS company_logo,
            company_city.meta_value           AS company_city,
            company_email.meta_value           AS company_email,
            company_phone.meta_value           AS company_phone,
            company_fax.meta_value           AS company_fax,
            company_pobox.meta_value           AS company_pobox,
            
             company_website.meta_value           AS company_website

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

            LEFT JOIN wp_xpksy4skky_postmeta  AS company_city
            ON wp_xpksy4skky_posts.ID = company_city.post_id        
            AND company_city.meta_key='city'

            LEFT JOIN wp_xpksy4skky_postmeta  AS company_email
            ON wp_xpksy4skky_posts.ID = company_email.post_id        
            AND company_email.meta_key='email'


             LEFT JOIN wp_xpksy4skky_postmeta  AS company_phone
            ON wp_xpksy4skky_posts.ID = company_phone.post_id        
            AND company_phone.meta_key='phone'


            LEFT JOIN wp_xpksy4skky_postmeta  AS company_fax
            ON wp_xpksy4skky_posts.ID = company_fax.post_id        
            AND company_fax.meta_key='fax'

            
            LEFT JOIN wp_xpksy4skky_postmeta  AS company_pobox
            ON wp_xpksy4skky_posts.ID = company_pobox.post_id        
            AND company_pobox.meta_key='po_box_no'

            LEFT JOIN wp_xpksy4skky_postmeta  AS company_totalemp_uae
            ON wp_xpksy4skky_posts.ID = company_totalemp_uae.post_id        
            AND company_totalemp_uae.meta_key='total_number_of_employees_uae'

            LEFT JOIN wp_xpksy4skky_postmeta  AS company_totalemp_world
            ON wp_xpksy4skky_posts.ID = company_totalemp_world.post_id        
            AND company_totalemp_world.meta_key='total_number_of_employees_worldwide'


            LEFT JOIN wp_xpksy4skky_postmeta  AS company_website
            ON wp_xpksy4skky_posts.ID = company_website.post_id        
            AND company_website.meta_key='website'



            WHERE wp_xpksy4skky_posts.post_status = 'publish'
            AND wp_xpksy4skky_posts.post_type = 'company' 
            AND wp_xpksy4skky_posts.ID = '{$company_id}'
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
            $result1 = mysql_query("SELECT wp_xpksy4skky_posts.ID, CONVERT(CAST(wp_xpksy4skky_posts.guid  as BINARY) USING latin1) AS imageName FROM wp_xpksy4skky_posts WHERE id = {$post['company_logo']} LIMIT 1");


            $row1 = mysql_fetch_assoc($result1);
            $imgName = $row1['imageName'];

            $post['company_logo'] = $imgName;


            $company_url = get_permalink($company_id);

            $post['company_url'] = $company_url;

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



           
           $posts = array('status' => "1", 'company'=>$post);


           // Query for find the employes under the company


         $queryEmp =  " SELECT u.ID emp_ID, CONVERT(CAST(u.display_name as BINARY) USING latin1) as display_name,  CONVERT(CAST(u.user_email as BINARY) USING latin1) as emp_email,
                        CONVERT(CAST(emp_firstname.meta_value as BINARY) USING latin1)        AS emp_firstname,
                        CONVERT(CAST(emp_lastname.meta_value as BINARY) USING latin1)        AS emp_lastname,
                        CONVERT(CAST(emp_position.meta_value as BINARY) USING latin1)        AS emp_position,
                        CONVERT(CAST(emp_mobile.meta_value as BINARY) USING latin1)       AS emp_mobile,
                        CONVERT(CAST(emp_photo.meta_value as BINARY) USING latin1) AS       emp_photo 

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

                        LEFT JOIN wp_xpksy4skky_usermeta AS payment_status
                             ON u.ID = payment_status.user_id        
                            AND payment_status.meta_key='paid_unpaid'
                        
                        LEFT JOIN wp_xpksy4skky_usermeta  AS emp_mobile
                                    ON u.ID = emp_mobile.user_id        
                                    AND emp_mobile.meta_key='mobile'


                        WHERE  um1.meta_key = 'company' AND um1.meta_value = '{$company_id}' 
                        AND payment_status.meta_key = 'paid_unpaid' 
                        AND payment_status.meta_value = 'paid'" ;

                


            $resultEmp = mysql_query($queryEmp) or die('Errant query:  '.$query);

            $employee = array();

            while($employes = mysql_fetch_assoc($resultEmp)) {

                if(empty($employes['emp_photo'])){
                    $employes['emp_photo'] = 0;
                }
                $result1 = mysql_query("SELECT wp_xpksy4skky_posts.ID, CONVERT(CAST(wp_xpksy4skky_posts.guid  as BINARY) USING latin1) AS imageName FROM wp_xpksy4skky_posts WHERE id = {$employes['emp_photo']} LIMIT 1");



                $row1 = mysql_fetch_assoc($result1);
                $imgName = $row1['imageName'];
                
                $employes['emp_photo'] = $imgName;

                $employee[] = array("employee"=>$employes);


                //$employee['emp_image'] = strip_tags(get_avatar_url( $employee['emp_ID'], "", "", "", "" ));;
                // $employee = array("employee"=>$employee);

               
               

            }

           


           $employee = array('status' => "1", 'company'=>$post, "employees"=> $employee);








            



           // $posts = array('status' => "1", 'company'=>$employee);

           // $posts = array('status' => "1", 'company'=>$post);



           // $posts = array_merge(array('status' => "1"), $posts)
           

		}
	}
    else{
         $posts = array();
    }

    // for News

  /*  $query = "SELECT wp_xpksy4skky_posts.ID news_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as news_title, DATE_FORMAT(wp_xpksy4skky_posts.post_date,'%d %b') news_date,
            news_image.meta_value AS news_image
            FROM wp_xpksy4skky_icl_translations JOIN wp_xpksy4skky_posts 
            

            LEFT JOIN wp_xpksy4skky_postmeta  AS news_image
             ON wp_xpksy4skky_posts.ID = news_image.post_id AND news_image.meta_key='_thumbnail_id'

            WHERE wp_xpksy4skky_posts.post_status = 'publish'
             AND wp_xpksy4skky_posts.post_type = 'post'
             AND wp_xpksy4skky_icl_translations.element_id = wp_xpksy4skky_posts.ID
             AND wp_xpksy4skky_icl_translations.language_code = 'en'
            ORDER BY wp_xpksy4skky_posts.post_date
            LIMIT 4
            ";
	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

    $news = array();
	if(mysql_num_rows($result)) {
		while($newslist = mysql_fetch_assoc($result)) {
			
           if(empty($newslist['news_image'])){
                $newslist['news_image'] = 0;
            }
            $result1 = mysql_query("SELECT wp_xpksy4skky_posts.ID, wp_xpksy4skky_posts.guid imageName FROM wp_xpksy4skky_posts WHERE id = {$newslist['news_image']} LIMIT 1");



            $row1 = mysql_fetch_assoc($result1);
            $imgName = $row1['imageName'];

             $category = strip_tags(get_the_category_list( ",", "multiple", $newslist['news_id'] ));
             $newslist['news_category'] = $category;

           




            $newslist['news_category'] = $category;



            $newslist['news_image'] = $imgName;


           // array_push($post, $imgName);
            $news[] = array('news'=>$newslist);

           // $posts = array_merge(array('status' => "1"), $posts)
           

		}
	}*/





  

	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		sendResponse(200, json_encode($employee,true));

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