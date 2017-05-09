<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/lists.css">
<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/events.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.js"></script>
<?
$page_slug ='contact-us';
$page_data = get_page_by_path($page_slug);
$page_id = $page_data->ID;
echo '<h2>' . $page_data->post_title . '</h2>';
echo apply_filters('the_content', $page_data->post_content)
?>