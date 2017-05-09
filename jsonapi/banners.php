<?
    include_once("header.php");
    include_once("../wp-blog-header.php");
 /* connect to the db */
	$link = mysql_connect($server,$dbUser,$dbPass) or die('Cannot connect to the DB');
	mysql_select_db($dbName,$link) or die('Cannot select the DB');
/* require the user as the parameter */
//if(isset($_GET['user']) && intval($_GET['user'])) {


    if(isset($_REQUEST['user_id'])){
        $user_id = $_REQUEST['user_id'];
    }
    else{
        $user_id = 0;
    }

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


	/* soak in the passed variable or set our own */
	$number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
	//$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
    $format = 'json';
	//$user_id = intval($_GET['user']); //no default

	
 

	/* grab the posts from the db */
    $query = "";
	$query .= " SELECT wp_xpksy4skky_posts.ID banner_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as banner_title,
                banner_image.meta_value  AS banner_image,
                banner_link.meta_value AS banner_link,
                campaign_id.meta_value AS campaign_id
                FROM wp_xpksy4skky_posts 
                LEFT JOIN wp_xpksy4skky_postmeta  AS banner_image 
                ON wp_xpksy4skky_posts.ID = banner_image.post_id        
                AND banner_image.meta_key='_banner_url'

                LEFT JOIN wp_xpksy4skky_postmeta  AS campaign_id 
                ON wp_xpksy4skky_posts.ID = campaign_id.post_id        
                AND campaign_id.meta_key='_banner_campaign_id'

                LEFT JOIN wp_xpksy4skky_postmeta  AS banner_link 
                ON wp_xpksy4skky_posts.ID = banner_link.post_id        
                AND banner_link.meta_key='_banner_link'

                LEFT JOIN wp_xpksy4skky_postmeta  AS banner_status
                ON wp_xpksy4skky_posts.ID = banner_status.post_id        
                AND banner_status.meta_key='_banner_status'


                WHERE wp_xpksy4skky_posts.post_status = 'publish'
                AND wp_xpksy4skky_posts.post_type = 'banners'

                AND campaign_id.meta_value = '16811'

                AND banner_status.meta_value = '1'
                AND wp_xpksy4skky_posts.post_status = 'publish'
                ORDER BY RAND() LIMIT 1            ";
    
	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
      // $posts[] =  array("success" => "1");
		while($post = mysql_fetch_assoc($result)) {
            $posts = array('banner'=>$post);
		}
	}
    else{
         $posts = array();
    }

   
	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		sendResponse(200, json_encode($posts,true));
	}
	
	/* disconnect from the db */
	@mysql_close($link);
//}
?>