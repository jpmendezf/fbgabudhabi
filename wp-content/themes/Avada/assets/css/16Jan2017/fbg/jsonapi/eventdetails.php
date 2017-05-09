<?
    include_once("../wp-blog-header.php");
/* require the user as the parameter */
//if(isset($_GET['user']) && intval($_GET['user'])) {

    if(isset($_REQUEST['event_id'])){
        $event_id = $_REQUEST['event_id'];
    }
    else{
        $event_id = 0;
    }

    if(!is_numeric($event_id)){
        $event_id = 0;
    }

	/* soak in the passed variable or set our own */
	$number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
	//$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
    $format = 'json';
	//$user_id = intval($_GET['user']); //no default

	/* connect to the db */
	$link = mysql_connect('localhost','fbg2017','hgM;eP4^_F9)') or die('Cannot connect to the DB');
	mysql_select_db('fbg2017',$link) or die('Cannot select the DB');

  // $link = mysql_connect('localhost','root','') or die('Cannot connect to the DB');
 // mysql_select_db('jsontest',$link) or die('Cannot select the DB');

 // _EventCost

 // _EventOrganizerID
 // _EventVenueID
 // _EventEndDate

 // _ecp_custom_2


	/* grab the posts from the db */
    $query = "";
	$query .= "SELECT wp_posts.ID event_id, CONVERT(CAST(wp_posts.post_title as BINARY) USING latin1) as event_title, CONVERT(CAST(wp_posts.post_content as BINARY) USING latin1) as event_description, 
            DATE_FORMAT(event_date.meta_value, '%M %d @ %l:%i %p')  AS event_date, 
             DATE_FORMAT(event_enddate.meta_value, '%l:%i %p' )   AS event_enddate,
            event_cost.meta_value        AS event_cost,
            event_venue.meta_value        AS event_venue,
            event_organiser.meta_value        AS event_organiser,
            event_totalrsvp.meta_value        AS event_totalrsvp,


            event_image.meta_value AS event_image
            FROM wp_posts 
            LEFT JOIN wp_postmeta  AS event_date 
             ON wp_posts.ID = event_date.post_id        
            AND event_date.meta_key='_EventStartDate'

            LEFT JOIN wp_postmeta  AS event_cost
             ON wp_posts.ID = event_cost.post_id AND event_cost.meta_key='_EventCost'

             LEFT JOIN wp_postmeta  AS event_venue
             ON wp_posts.ID = event_venue.post_id AND event_venue.meta_key='_EventVenueID'

             LEFT JOIN wp_postmeta  AS event_organiser
             ON wp_posts.ID = event_organiser.post_id AND event_organiser.meta_key='_EventOrganizerID'

             LEFT JOIN wp_postmeta  AS event_totalrsvp
             ON wp_posts.ID = event_totalrsvp.post_id AND event_totalrsvp.meta_key='_ecp_custom_2'



             LEFT JOIN wp_postmeta  AS event_enddate
             ON wp_posts.ID = event_enddate.post_id AND event_enddate.meta_key='_EventEndDate'


             LEFT JOIN wp_postmeta  AS event_image
             ON wp_posts.ID = event_image.post_id AND event_image.meta_key='_thumbnail_id'

            WHERE wp_posts.post_status = 'publish'
             AND wp_posts.post_type = 'tribe_events'
             AND wp_posts.ID = '{$event_id}'
            ";
    
	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
      // $posts[] =  array("success" => "1");
		while($post = mysql_fetch_assoc($result)) {
			
            if(empty($post['event_image'])){
                $post['event_image'] = 0;
            }
            // event_totalrsvp
            if(empty($post['event_totalrsvp'])){
                $post['event_totalrsvp'] = "0";
            }
            $result1 = mysql_query("SELECT wp_posts.ID, wp_posts.guid imageName FROM wp_posts WHERE id = {$post['event_image']} LIMIT 1");


            $row1 = mysql_fetch_assoc($result1);
            $imgName = $row1['imageName'];

            $post['event_image'] = $imgName;

            $post['event_date'] =  $post['event_date'] . " - " . $post['event_enddate'];

            $post['event_description'] = strip_tags($post['event_description']); 

           // $category = strip_tags(get_the_category_list( ",", "multiple", $event_id));
            //$post['event_category'] = $category;
            

            $event_url = get_permalink($event_id);

            $post['event_url'] = strip_tags($event_url); 

            $term_list = wp_get_post_terms( $event_id, Tribe__Events__Main::TAXONOMY );
           
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

            //$post['event_category'] = "";



            $result2 = mysql_query("SELECT wp_posts.ID, wp_posts.post_title venue FROM wp_posts WHERE id = {$post['event_venue']} LIMIT 1");


            $row2 = mysql_fetch_assoc($result2);
            $venue = $row2['venue'];

            $post['event_venue'] = $venue;


            $result3 = mysql_query("SELECT wp_posts.ID, wp_posts.post_title organiser FROM wp_posts WHERE id = {$post['event_organiser']} LIMIT 1");


            $row3 = mysql_fetch_assoc($result3);
            $organiser = $row3['organiser'];

            $post['event_organiser'] = $organiser;


           // array_push($post, $imgName);
            $posts = array('status' => "1", 'event_detail'=>$post);

           // $posts = array_merge(array('status' => "1"), $posts)
           

		}
	}
    else{
         $posts = array("status" => "0");
    }

    // for News

    /*$query = "SELECT wp_posts.ID news_id, CONVERT(CAST(wp_posts.post_title as BINARY) USING latin1) as news_title, wp_posts.post_date news_date,
            news_image.meta_value AS news_image
            FROM wp_posts 
            

            LEFT JOIN wp_postmeta  AS news_image
             ON wp_posts.ID = news_image.post_id AND news_image.meta_key='_thumbnail_id'

            WHERE wp_posts.post_status = 'publish'
             AND wp_posts.post_type = 'post'
            ORDER BY wp_posts.post_title
            LIMIT 4
            ";
	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

    $news = array();
	if(mysql_num_rows($result)) {
		while($newslist = mysql_fetch_assoc($result)) {
			
           if(empty($newslist['news_image'])){
                $newslist['news_image'] = 0;
            }
            $result1 = mysql_query("SELECT wp_posts.ID, wp_posts.guid imageName FROM wp_posts WHERE id = {$newslist['news_image']} LIMIT 1");



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
		echo json_encode($posts,true);
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