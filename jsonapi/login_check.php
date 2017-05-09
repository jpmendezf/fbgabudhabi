<?
	include_once("header.php");
    include_once("../wp-blog-header.php");
    if($_REQUEST['user_name']){
        $userName = $_REQUEST['user_name'];
    }
    else{
        $userName = "";
    }

    if($_REQUEST['user_pass']){
        $password = $_REQUEST['user_pass'];
    }
    else{
        $password = "";
    }
   // $password = html_entity_decode($password);

    


    //print("Password" . $password);
   // $userName = "shiju@belpro.co";
   // $password = "Ws($(@0%9aRH^bT&KtCKjl4^";
    $format  = 'json';

    if(user_pass_ok($userName, $password)){
        //print("welcome");
    $link = mysql_connect($server,$dbUser,$dbPass) or die('Cannot connect to the DB');
	mysql_select_db($dbName,$link) or die('Cannot select the DB');

                  


                    /* grab the posts from the db */
                    $query = "";
                    $query .= "SELECT wpuser.ID user_id, wpuser.user_pass user_pass, wpuser.user_login user_name, wpuser.user_email user_email , payment_status.meta_value AS payment_status

                            FROM wp_xpksy4skky_users wpuser 
                            LEFT JOIN wp_xpksy4skky_usermeta AS payment_status
                             ON wpuser.ID = payment_status.user_id  
                             
                            AND payment_status.meta_key='paid_unpaid'
                            WHERE wpuser.user_email  = '{$userName}' ";
                    
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

                           if($post['payment_status'] == 'paid'){
                               $post['payment_status'] = 1;
                               $flagPayment = 1;

                           }
                           else{
                               $post['payment_status'] = 0;
                               $flagPayment = 0;
                           }
                            
                            

                           // array_push($post, $imgName);
                            $posts = array('status' => "1", 'userdetails'=>$post);

                           

                        }
                    }
                    else{
                         $posts = array("status" => "0");
                    }

                   

                 
    }
    else{
       
         $posts = array("status" => "0" , "reason" => "invalid username or password");
    
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

?>