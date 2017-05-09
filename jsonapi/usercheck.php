<?
include_once("header.php");
include_once("../wp-blog-header.php");
/* require the user as the parameter */
//if(isset($_GET['user']) && intval($_GET['user'])) {


    /*
        This API used check the user exist or not in the 

    */

    if(isset($_REQUEST['user_email'])){
        $useremail = $_REQUEST['user_email'];
    }
    else{
        $useremail = 0;
    }

    

	/* soak in the passed variable or set our own */
	$number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
	//$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
    $format = 'json';
	//$user_id = intval($_GET['user']); //no default

	/* connect to the db */
	$link = mysql_connect($server,$dbUser,$dbPass) or die('Cannot connect to the DB');
	mysql_select_db($dbName,$link) or die('Cannot select the DB');


  


	/* grab the posts from the db */
    $query = "";
	$query .= "SELECT wpuser.ID user_id, wpuser.user_pass user_pass, wpuser.user_login user_name, wpuser.user_email user_email 

            FROM wp_xpksy4skky_users wpuser 
            WHERE wpuser.user_email  = '{$useremail}' ";
    
	$result = mysql_query($query,$link) or die('Print query:  '.$query);

	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
      // $posts[] =  array("success" => "1");
		while($post = mysql_fetch_assoc($result)) {
			
           if(empty($post['user_pass'])){
               $post['user_pass'] = "0";
           }
           else{
                $post['user_pass'] = "1";
           }
            

           // array_push($post, $imgName);
            $posts = array('status' => "1", 'userdetails'=>$post);

           

		}
	}
    else{
         $posts = array("status" => "0");
    }

   

	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		sendResponse(200, json_encode($posts,true));
        error_reporting(0);
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