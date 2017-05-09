<?
    include_once("header.php");
    include_once("../wp-blog-header.php");
 /* connect to the db */
	$link = mysql_connect($server,$dbUser,$dbPass) or die('Cannot connect to the DB');
	mysql_select_db($dbName,$link) or die('Cannot select the DB');
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


    if(isset($_REQUEST['user_id'])){
        $user_id = $_REQUEST['user_id'];
    }
    else{
        $user_id = 0;
    }
    $siteUrl = get_site_url();
    $cartUrl = $siteUrl . "/cart";
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


    /*
        Code update the status - 

    */
    if($user_id != 0){

        $rsvp_status = mysql_query(
                    "SELECT wp_xpksy4skky_posts.ID event_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as person_name, event_date.meta_value AS user_id, event_id.meta_value AS eventId, rsvp_status.meta_value AS rsvp, checkin_status.meta_value AS checkin_status 
                    FROM wp_xpksy4skky_posts 
                    LEFT JOIN wp_xpksy4skky_postmeta  AS event_date 
                    ON wp_xpksy4skky_posts.ID = event_date.post_id   
                    AND event_date.meta_key='_tribe_tickets_attendee_user_id'
                    LEFT JOIN wp_xpksy4skky_postmeta AS event_id
                    ON wp_xpksy4skky_posts.ID = event_id.post_id
                    AND event_id.meta_key = '_tribe_rsvp_event'

                    LEFT JOIN wp_xpksy4skky_postmeta  AS rsvp_status
                    ON wp_xpksy4skky_posts.ID = rsvp_status.post_id   
                    AND rsvp_status.meta_key='_tribe_rsvp_status'

                    LEFT JOIN wp_xpksy4skky_postmeta  AS checkin_status
                    ON wp_xpksy4skky_posts.ID = checkin_status.post_id   
                    AND checkin_status.meta_key='_tribe_rsvp_checkedin'

                    WHERE wp_xpksy4skky_posts.post_status = 'publish'
                    AND wp_xpksy4skky_posts.post_type = 'tribe_rsvp_attendees'
                    AND  event_date.meta_value = '{$user_id}'
                    AND event_id.meta_value = '{$event_id}'
                    ORDER BY wp_xpksy4skky_posts.ID DESC
                    LIMIT 1"
                    );


        $rsvp = mysql_fetch_assoc($rsvp_status);
        $rsvp_status = $rsvp['rsvp'];
         $checkin_status = $rsvp['checkin_status'];
        
       if(empty($rsvp_status)){
            // $rsvp_status

            // _tribe_wooticket_event

            // tribe_wooticket


            $rsvp_ticket_status = mysql_query(
                    "SELECT wp_xpksy4skky_posts.ID event_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as person_name, event_date.meta_value AS user_id, event_id.meta_value AS eventId,  checkin_status.meta_value AS checkin_status 
                    FROM wp_xpksy4skky_posts 
                    LEFT JOIN wp_xpksy4skky_postmeta  AS event_date 
                    ON wp_xpksy4skky_posts.ID = event_date.post_id   
                    AND event_date.meta_key='_tribe_tickets_attendee_user_id'
                    LEFT JOIN wp_xpksy4skky_postmeta AS event_id
                    ON wp_xpksy4skky_posts.ID = event_id.post_id
                    AND event_id.meta_key = '_tribe_wooticket_event'

                   

                    LEFT JOIN wp_xpksy4skky_postmeta  AS checkin_status
                    ON wp_xpksy4skky_posts.ID = checkin_status.post_id   
                    AND checkin_status.meta_key='_tribe_wooticket_checkedin'

                    WHERE wp_xpksy4skky_posts.post_status = 'publish'
                    AND wp_xpksy4skky_posts.post_type = 'tribe_rsvp_attendees'
                    AND  event_date.meta_value = '{$user_id}'
                    AND event_id.meta_value = '{$event_id}'
                    ORDER BY wp_xpksy4skky_posts.ID DESC
                    LIMIT 1"
                    );

                    $rsvp_ticket = mysql_fetch_assoc($rsvp_ticket_status);
                    $rsvp_status = $rsvp_ticket['user_id'];

                    if($rsvp_status == $user_id){
                        $rsvp_status = 'yes';
                    }
                    $checkin_status = $rsvp_ticket['checkin_status'];

        }

        

       

        if(empty($checkin_status)){
            $checkin_status = "0";
        }

        $post['checkin_status'] = $checkin_status;

        $rsvp_status_id = $rsvp['event_id'];

        if(empty($rsvp_status_id)){
            $rsvp_status_id = "0";
        }


        

    }

	if(isset($_REQUEST['doAction'])){

        
        if(isset($_REQUEST['rsvp_status'])){
            if($_REQUEST['rsvp_status'] == '1'){
                $rsvp_status = 'no';
            }
            else if($_REQUEST['rsvp_status'] == '2'){
                $rsvp_status = 'yes';
            }
            else{
                $rsvp_status = "";
            }
             
        }
        if($_REQUEST['doAction'] == 'rsvp_update'){
            
            $sql = "UPDATE wp_xpksy4skky_postmeta SET meta_value ='{$rsvp_status}' WHERE post_id={$rsvp_status_id} AND meta_key = '_tribe_rsvp_status' ";

            if (mysql_query($sql)){
            }
        }

        if($_REQUEST['doAction'] == 'checkin'){
            if(isset($_REQUEST['checkin_status'])){
                $check_status = $_REQUEST['checkin_status'];
                if($check_status == 0){
                     $sqlIns = "INSERT INTO wp_xpksy4skky_postmeta (post_id, meta_key, meta_value) VALUES ({$rsvp_status_id}, '_tribe_rsvp_checkedin', '1')";
                             if (mysql_query($sqlIns)){
                             }
                }
                else if($check_status == 1){
                    $sqlDel = "DELETE FROM wp_xpksy4skky_postmeta WHERE post_id={$rsvp_status_id} AND meta_key = '_tribe_rsvp_checkedin' ";
                                if (mysql_query($sqlDel)){
                                }
                }
            }
         }
    }

    // 15873


 

	/* grab the posts from the db */
    $query = "";
	$query .= "SELECT wp_xpksy4skky_posts.ID event_id, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as event_title, CONVERT(CAST(wp_xpksy4skky_posts.post_content as BINARY) USING latin1) as event_description, 
            DATE_FORMAT(event_date.meta_value, '%M %d @ %l:%i %p')  AS event_date, 
             event_date.meta_value  AS event_dbdate,
             DATE_FORMAT(event_enddate.meta_value, '%l:%i %p' )   AS event_enddate,
             event_enddate.meta_value   AS event_dbenddate,
            event_venue.meta_value        AS event_venue,
            event_organiser.meta_value        AS event_organiser,
            event_rsvp_ticket.meta_value        AS event_rsvp_ticket,
            event_attendees_list.meta_value        AS event_attendees_list,
            event_image.meta_value AS event_image

            FROM wp_xpksy4skky_posts 
            LEFT JOIN wp_xpksy4skky_postmeta  AS event_date 
             ON wp_xpksy4skky_posts.ID = event_date.post_id        
            AND event_date.meta_key='_EventStartDate'

            LEFT JOIN wp_xpksy4skky_postmeta  AS event_cost
             ON wp_xpksy4skky_posts.ID = event_cost.post_id AND event_cost.meta_key='_EventCost'

             LEFT JOIN wp_xpksy4skky_postmeta  AS event_venue
             ON wp_xpksy4skky_posts.ID = event_venue.post_id AND event_venue.meta_key='_EventVenueID'

             LEFT JOIN wp_xpksy4skky_postmeta  AS event_organiser
             ON wp_xpksy4skky_posts.ID = event_organiser.post_id AND event_organiser.meta_key='_EventOrganizerID'

             LEFT JOIN wp_xpksy4skky_postmeta  AS event_rsvp_ticket
             ON wp_xpksy4skky_posts.ID = event_rsvp_ticket.post_id AND event_rsvp_ticket.meta_key='_tribe_progressive_ticket_current_number'

             LEFT JOIN wp_xpksy4skky_postmeta  AS event_enddate
             ON wp_xpksy4skky_posts.ID = event_enddate.post_id AND event_enddate.meta_key='_EventEndDate'

             LEFT JOIN wp_xpksy4skky_postmeta  AS event_image
             ON wp_xpksy4skky_posts.ID = event_image.post_id AND event_image.meta_key='_thumbnail_id'

             LEFT JOIN wp_xpksy4skky_postmeta  AS event_attendees_list
             ON wp_xpksy4skky_posts.ID = event_attendees_list.post_id 
             AND event_attendees_list.meta_key='_tribe_hide_attendees_list'

            WHERE wp_xpksy4skky_posts.post_status = 'publish'
             AND wp_xpksy4skky_posts.post_type = 'tribe_events'
             AND wp_xpksy4skky_posts.ID = '{$event_id}'
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
            // event_rsvp_ticket
            if(empty($post['event_rsvp_ticket'])){
                $post['event_rsvp_ticket'] = "0";
            }
            $result1 = mysql_query("SELECT wp_xpksy4skky_posts.ID, wp_xpksy4skky_posts.guid imageName FROM wp_xpksy4skky_posts WHERE id = {$post['event_image']} LIMIT 1");


            $row1 = mysql_fetch_assoc($result1);
            $imgName = $row1['imageName'];

            if(!empty($imgName)){
                $post['event_image'] = $imgName;
            }
            else{
                $post['event_image'] = "";
            }

            

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



            $result2 = mysql_query("SELECT wp_xpksy4skky_posts.ID, wp_xpksy4skky_posts.post_title venue FROM wp_xpksy4skky_posts WHERE id = {$post['event_venue']} LIMIT 1");


            $row2 = mysql_fetch_assoc($result2);
            $venue = $row2['venue'];

            $post['event_venue'] = $venue;


           

                $rsvp_total_going = mysql_query("SELECT wp_xpksy4skky_posts.ID event_id, COUNT(*) rsvp_count
                FROM wp_xpksy4skky_posts 
                LEFT JOIN wp_xpksy4skky_postmeta  AS event_date 
                ON wp_xpksy4skky_posts.ID = event_date.post_id   
                AND event_date.meta_key='_tribe_tickets_attendee_user_id'
                LEFT JOIN wp_xpksy4skky_postmeta AS event_id
                ON wp_xpksy4skky_posts.ID = event_id.post_id
                AND event_id.meta_key = '_tribe_rsvp_event'

                LEFT JOIN wp_xpksy4skky_postmeta  AS rsvp_status
                ON wp_xpksy4skky_posts.ID = rsvp_status.post_id   
                AND rsvp_status.meta_key='_tribe_rsvp_status'


                WHERE wp_xpksy4skky_posts.post_status = 'publish'
                AND wp_xpksy4skky_posts.post_type = 'tribe_rsvp_attendees'

                AND event_id.meta_value = '{$event_id}'
                AND rsvp_status.meta_value = 'yes'
                GROUP BY event_id.meta_value");

                $rsvp_going = mysql_fetch_assoc($rsvp_total_going);
                $rsvp_going_count = $rsvp_going['rsvp_count'];

                $post['event_rsvp_ticket']  = $rsvp_going_count;

                if(empty($post['event_rsvp_ticket'])){
                    $post['event_rsvp_ticket']  = 0;
                }

                $ticket_total_going = mysql_query("SELECT wp_xpksy4skky_posts.ID event_id, COUNT(*) ticket_count
                                        FROM wp_xpksy4skky_posts 
                                        LEFT JOIN wp_xpksy4skky_postmeta  AS event_date 
                                        ON wp_xpksy4skky_posts.ID = event_date.post_id   
                                        AND event_date.meta_key='_tribe_tickets_attendee_user_id'

                                        LEFT JOIN wp_xpksy4skky_postmeta AS event_id
                                        ON wp_xpksy4skky_posts.ID = event_id.post_id
                                        AND event_id.meta_key = '_tribe_wooticket_event'

                                        WHERE wp_xpksy4skky_posts.post_status = 'publish'
                                        AND wp_xpksy4skky_posts.post_type = 'tribe_wooticket'

                                        AND event_id.meta_value = '{$event_id}'
                                        GROUP BY event_id.meta_value");
                $ticket_going = mysql_fetch_assoc($ticket_total_going);
                $ticket_going_count = $ticket_going['ticket_count'];

                $post['event_rsvp_ticket']  = $rsvp_going_count;

                $post['event_attendees_list'] = $ticket_going_count;

                if(empty($post['event_rsvp_ticket'])){
                    $post['event_rsvp_ticket']  = "0";
                }


                if(empty($post['event_attendees_list'])){
                    $post['event_attendees_list']  = 0;
                }

                $post['event_totalrsvp'] = $post['event_rsvp_ticket'] + $post['event_attendees_list'];


                if($rsvp_status == 'yes'){
                    $post['rsvp_status'] = "1";

                }
                else if($rsvp_status == 'no'){
                    $post['rsvp_status'] = "2";
                }
                else{
                    $post['rsvp_status'] = "0";
                }

                if($post['rsvp_status'] == "0"){
                    $post['ticket_status'] = "0";
                }
                else{
                    $post['ticket_status'] = "1";
                }


            
            $result3 = mysql_query("SELECT wp_xpksy4skky_posts.ID, wp_xpksy4skky_posts.post_title organiser FROM wp_xpksy4skky_posts WHERE id = {$post['event_organiser']} LIMIT 1");


            $row3 = mysql_fetch_assoc($result3);
            $organiser = $row3['organiser'];

            $post['event_organiser'] = $organiser;

            $qryPrice =  "SELECT wp_xpksy4skky_posts.ID event_priceid, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as ticket_name, event_price.meta_value AS event_price, event_id.meta_value AS eventId, member_type.meta_value AS member_type
            FROM wp_xpksy4skky_posts 
            LEFT JOIN wp_xpksy4skky_postmeta  AS event_price 
            ON wp_xpksy4skky_posts.ID = event_price.post_id   
            AND event_price.meta_key='_regular_price'


            LEFT JOIN wp_xpksy4skky_postmeta AS event_id
            ON wp_xpksy4skky_posts.ID = event_id.post_id
            AND event_id.meta_key = '_tribe_wooticket_for_event'

            LEFT JOIN wp_xpksy4skky_postmeta AS member_type
            ON wp_xpksy4skky_posts.ID = member_type.post_id
            AND member_type.meta_key = 'member_type'

            WHERE wp_xpksy4skky_posts.post_status = 'publish'
            AND wp_xpksy4skky_posts.post_type = 'product'
            AND event_id.meta_value = '{$event_id}'";
            

            $resultPrice = mysql_query($qryPrice) or die('Errant query:  '.$query);

            $eventprice = array();

            while($eventPrice = mysql_fetch_assoc($resultPrice)) {
                $productId = $eventPrice['event_priceid'];
                $eventPrice['event_ticket_url'] = $cartUrl . "?add-to-cart=" . $productId;

                $eventprice[] = $eventPrice;

            }

            
            $qryRSVPTickets = " SELECT wp_xpksy4skky_posts.ID event_priceid, CONVERT(CAST(wp_xpksy4skky_posts.post_title as BINARY) USING latin1) as ticket_name,  event_id.meta_value AS eventId, member_type.meta_value AS member_type
            FROM wp_xpksy4skky_posts 
            LEFT JOIN wp_xpksy4skky_postmeta AS member_type
            ON wp_xpksy4skky_posts.ID = member_type.post_id
            AND member_type.meta_key = 'member_type'

            LEFT JOIN wp_xpksy4skky_postmeta AS event_id
            ON wp_xpksy4skky_posts.ID = event_id.post_id
            AND event_id.meta_key = '_tribe_rsvp_for_event'

            WHERE wp_xpksy4skky_posts.post_status = 'publish'
            AND wp_xpksy4skky_posts.post_type = 'tribe_rsvp_tickets'
            AND event_id.meta_value = '{$event_id}' ";

            $resultRSVP = mysql_query($qryRSVPTickets) or die('Errant query:  '.$query);

            $eventRSVP = array();

            while($eventRSVPTicket = mysql_fetch_assoc($resultRSVP)) {
                $productId = $eventRSVPTicket['event_priceid'];
                $eventRSVPTicket['event_ticket_url'] = $event_url;
                $eventRSVPTicket['event_price'] = "";


                $eventRSVP[] = $eventRSVPTicket;
            }


            if(!empty($eventRSVP)){
               $eventprice =  array_merge($eventprice, $eventRSVP);
            } 

            
            

            // tribe_rsvp_tickets

             $posts = array('status' => "1", 'event_detail'=>$post,);


            // Function used to get the event price


           if(!empty($eventprice)){
               if($user_id != 0){
                     $posts = array('status' => "1", "userdetails"=>$userArray, 'event_detail'=>$post, "eventprice"=>$eventprice);
               }
               else{
                   $posts = array('status' => "1", 'event_detail'=>$post, "eventprice"=>$eventprice);
               }
            }
            else{
                if($user_id != 0){
                     $posts = array('status' => "1", "userdetails"=>$userArray, 'event_detail'=>$post);
                }
                else{
                    $posts = array('status' => "1", 'event_detail'=>$post);
                }
            }

            


           // array_push($post, $imgName);
            

           // $posts = array_merge(array('status' => "1"), $posts)
           

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