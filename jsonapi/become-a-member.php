<?
include_once("header.php")
include_once("../wp-blog-header.php");
// postid for the become a member;
$id = 14286;
$page_link =  get_page_link($id, "", ""); 
$page_title = get_the_title($id);
 $format  = 'json';
$page_details = array();
if(!empty($page_link)){

    $page_details['page_title'] = $page_title;
    $page_details['page_url'] = $page_link;
    
   $posts = array('status' => "1", 'page_details'=>$page_details);

}
else{
    $posts = array('status' => "0", 'reason'=>"page not found - 404 error");
}
if($format == 'json') {
    header('Content-type: application/json');
    echo json_encode($posts,true);
}
?>