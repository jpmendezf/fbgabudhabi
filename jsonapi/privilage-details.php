<?php
  include_once("header.php");
 include_once("../wp-blog-header.php");

  $sitepress->switch_lang('en');

/* require the user as the parameter */
//if(isset($_GET['user']) && intval($_GET['user'])) {
    
    if(isset($_REQUEST['prev_id'])){
        $prev_id = $_REQUEST['prev_id'];
    }
    else{
        $prev_id = 0;
    }

    if(!is_numeric($prev_id)){
        $prev_id = 0;
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
	$query .= "SELECT wp_xpksy4skky_posts.ID privilege_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as privilege_title, CONVERT(CAST(wp_xpksy4skky_posts.post_content as BINARY) USING latin1) as portfolio_description, 
            
            privilege_image.meta_value AS privilege_image
            FROM wp_xpksy4skky_icl_translations JOIN wp_xpksy4skky_posts
            

            LEFT JOIN wp_xpksy4skky_postmeta  AS privilege_image
             ON wp_xpksy4skky_posts.ID = privilege_image.post_id AND privilege_image.meta_key='_thumbnail_id'


            WHERE wp_xpksy4skky_posts.post_status = 'publish'
             AND wp_xpksy4skky_posts.post_type = 'avada_portfolio'

             AND wp_xpksy4skky_icl_translations.element_id = wp_xpksy4skky_posts.ID
             AND wp_xpksy4skky_icl_translations.language_code = 'en'
             AND wp_xpksy4skky_posts.ID = '{$prev_id}'
            ORDER BY privilege_title
            ";

    
  
	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
      // $posts[] =  array("success" => "1");
		while($post = mysql_fetch_assoc($result)) {


            $post['portfolio_description'] = apply_filters('the_content', $post['portfolio_description'] );
			
            if(empty($post['privilege_image'])){
                $post['privilege_image'] = 0;
            }


            $result1 = mysql_query("SELECT wp_xpksy4skky_posts.ID, wp_xpksy4skky_posts.guid imageName FROM wp_xpksy4skky_posts WHERE id = {$post['privilege_image']} LIMIT 1");


            $row1 = mysql_fetch_assoc($result1);
            $imgName = $row1['imageName'];

            $post['privilege_image'] = $imgName;




             //$category = strip_tags(get_the_category_list( ",", "multiple", $post['privilege_id'] ));
             $preCategory = strip_tags(get_the_term_list( $post['privilege_id'], 'portfolio_category', '', ', ', '' ));


            $post['privilege_category'] = ltrim($preCategory, "1");

           // array_push($post, $imgName);
            $posts = array("status" => "1", 'privilege'=>$post);

           // $posts = array_merge(array('status' => "1"), $posts)
           

		}
	}
    else{
         $posts = array("status" => "0");
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