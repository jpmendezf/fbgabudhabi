<?php
include_once("header.php");
include_once("../wp-blog-header.php");

$image = get_post_thumbnail_id( '14702');
$post['company_image']  = $image;

print($image);

?>