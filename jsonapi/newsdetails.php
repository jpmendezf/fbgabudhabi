<?
    /*
        inclide the wporpress header
    */
    include_once("header.php");
    include_once("../wp-blog-header.php");

    if(isset($_REQUEST['news_id'])){
        $news_id = $_REQUEST['news_id'];
    }
    else{
        $news_id = 0;
    }

    if(!is_numeric($news_id)){
        $news_id = 0;
    }

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


 //$link = mysql_connect('localhost','root','') or die('Cannot connect to the DB');
 //mysql_select_db('jsontest',$link) or die('Cannot select the DB');

	/* grab the posts from the db */
   /* $query = "";
	$query .= "SELECT wp_xpksy4skky_posts.ID event_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as event_title, 
            event_date.meta_value        AS event_date,
            event_image.meta_value AS event_image
            FROM wp_xpksy4skky_posts 
            LEFT JOIN wp_xpksy4skky_postmeta  AS event_date 
             ON wp_xpksy4skky_posts.ID = event_date.post_id        
            AND event_date.meta_key='_EventStartDate'

            LEFT JOIN wp_xpksy4skky_postmeta  AS event_image
             ON wp_xpksy4skky_posts.ID = event_image.post_id AND event_image.meta_key='_thumbnail_id'

            WHERE wp_xpksy4skky_posts.post_status = 'publish'
             AND wp_xpksy4skky_posts.post_type = 'tribe_events'
            ORDER BY wp_xpksy4skky_posts.post_title 
            ";
    if($limit != 0){
        $query .= " LIMIT {$limit }" ;

    }
	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

	//create one master array of the records 
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


           // array_push($post, $imgName);
            $posts[] = array('event'=>$post);

           // $posts = array_merge(array('status' => "1"), $posts)
           

		}
	}
    else{
         $posts = array("success" => "0");
    }

*/
    // for News

    $query = "";

    $query .= "SELECT wp_xpksy4skky_posts.ID news_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as news_title, CONVERT(CAST(wp_xpksy4skky_posts.post_content as BINARY) USING latin1) as news_description, DATE_FORMAT(wp_xpksy4skky_posts.post_date, '%d %b %Y') news_date, 
            news_image.meta_value AS news_image
            FROM wp_xpksy4skky_posts 
             
            

            LEFT JOIN wp_xpksy4skky_postmeta  AS news_image
             ON wp_xpksy4skky_posts.ID = news_image.post_id AND news_image.meta_key='_thumbnail_id'

            WHERE wp_xpksy4skky_posts.post_status = 'publish'
             AND wp_xpksy4skky_posts.post_type = 'post'
             AND wp_xpksy4skky_posts.ID = '{$news_id}'
            ORDER BY wp_xpksy4skky_posts.post_title ";

            
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

            $news_url = get_permalink($news_id);



            $newslist['news_image'] = strip_tags($imgName);

            //$newslist['news_description'] = $newslist['news_description'];

            $newslist['news_url'] = $news_url;


          /*  if(empty($newslist['news_author'])){
                $newslist['news_author'] = 0;
            }
            $result2 = mysql_query("SELECT wp_xpksy4skky_users.ID, wp_xpksy4skky_users.display_name authorName FROM wp_xpksy4skky_users WHERE wp_xpksy4skky_users.ID = {$newslist['news_author']} LIMIT 1");



            $row2 = mysql_fetch_assoc($result2);
            $author = $row2['authorName'];

            $newslist['author_photo'] = strip_tags(get_avatar_url( $newslist['news_author'], "", "", "", "" ));*/

            $category = strip_tags(get_the_category_list( ",", "multiple", $news_id ));

           



           // $newslist['news_author'] = $author;

            $newslist['news_category'] = $category;




           // array_push($post, $imgName);
            $news = array('status' => "1", 'newsdetails'=>$newslist);

           // $posts = array_merge(array('status' => "1"), $posts)
           

		}
        
	}
    else{
            $news = array("status" => "0");
     }





  

	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		//echo json_encode(array("status" => "1", $news),true);
        sendResponse(200, json_encode($news,true));
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