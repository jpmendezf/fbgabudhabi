<?
 include_once("header.php");
 include_once("../wp-blog-header.php");
/* require the user as the parameter */
//if(isset($_GET['user']) && intval($_GET['user'])) {

    if(isset($_REQUEST['limit'])){
        $limit = $_REQUEST['limit'];
    }
    else{
        $limit = 0;
    }

    if(!is_numeric($limit)){
        $limit = 0;
    }

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
    $query = "";
	$query .= "SELECT wp_xpksy4skky_posts.ID event_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as event_title, 
            DATE_FORMAT(event_date.meta_value, '%d %b')  AS event_date,
            event_venue.meta_value        AS event_venue,
            event_image.meta_value AS event_image
            FROM  wp_xpksy4skky_posts 
            LEFT JOIN wp_xpksy4skky_postmeta  AS event_date 
             ON wp_xpksy4skky_posts.ID = event_date.post_id        
            AND event_date.meta_key='_EventStartDate'

            LEFT JOIN wp_xpksy4skky_postmeta  AS event_image
             ON wp_xpksy4skky_posts.ID = event_image.post_id AND event_image.meta_key='_thumbnail_id'
             LEFT JOIN wp_xpksy4skky_postmeta  AS event_venue
             ON wp_xpksy4skky_posts.ID = event_venue.post_id AND event_venue.meta_key='_EventVenueID'

            WHERE wp_xpksy4skky_posts.post_status = 'publish'
             AND wp_xpksy4skky_posts.post_type = 'tribe_events'
             AND DATE(event_date.meta_value) >= CURDATE()

            ORDER BY event_date.meta_value
            ";
    if($limit != 0){
        $query .= " LIMIT {$limit }" ;

    }
	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
      // $posts[] =  array("success" => "1");
		while($post = mysql_fetch_assoc($result)) {
			
            if(empty($post['event_image'])){
                $post['event_image'] = 0;
            }
            $result1 = mysql_query("SELECT wp_xpksy4skky_posts.ID, wp_xpksy4skky_posts.guid imageName FROM wp_xpksy4skky_posts WHERE id = {$post['event_image']} LIMIT 1");


            $row1 = mysql_fetch_assoc($result1);
            $imgName = $row1['imageName'];

            $post['event_image'] = $imgName;


            $result2 = mysql_query("SELECT wp_xpksy4skky_posts.ID, wp_xpksy4skky_posts.post_title venue FROM wp_xpksy4skky_posts WHERE id = {$post['event_venue']} LIMIT 1");


            $row2 = mysql_fetch_assoc($result2);
            $venue = $row2['venue'];

            $post['event_venue'] = $venue;

             $term_list = wp_get_post_terms($post['event_id'], Tribe__Events__Main::TAXONOMY );
           
            $cnt = 0;
            $event_cats = '';
            foreach( $term_list as $term_single ) {
               // if($cnt == 0){
                    $event_cats .= $term_single->name . ', ';
               // }
                $cnt++;
            }
            $category =  rtrim($event_cats, ', ');
            $post['event_category'] = $category;


           // array_push($post, $imgName);
            $posts[] = array('event'=>$post);

           // $posts = array_merge(array('status' => "1"), $posts)
           

		}
	}
    else{
         $posts = array();
    }

    // for News

    /*$query = "SELECT wp_xpksy4skky_posts.ID news_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as news_title, wp_xpksy4skky_posts.post_date news_date,
            news_image.meta_value AS news_image
            FROM wp_xpksy4skky_posts 
            

            LEFT JOIN wp_xpksy4skky_postmeta  AS news_image
             ON wp_xpksy4skky_posts.ID = news_image.post_id AND news_image.meta_key='_thumbnail_id'

            WHERE wp_xpksy4skky_posts.post_status = 'publish'
             AND wp_xpksy4skky_posts.post_type = 'post'
            ORDER BY wp_xpksy4skky_posts.post_title
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



            $newslist['news_image'] = $imgName;


           // array_push($post, $imgName);
            $news[] = array('news'=>$newslist);

           // $posts = array_merge(array('status' => "1"), $posts)
           

		}
	}*/





  

	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		sendResponse(200, json_encode(array("status" => "1",'events'=>$posts),true));
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