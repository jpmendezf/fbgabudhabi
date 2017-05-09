<?php
/**
* Template Name: About Us - Mob
*/
?><!DOCTYPE html>
<?php global $woocommerce; ?>
<html class="<?php echo ( Avada()->settings->get( 'smooth_scrolling' ) ) ? 'no-overflow-y' : ''; ?>" <?php language_attributes(); ?>>
<head>

  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel='stylesheet' id='google-font-css'  href='https://fonts.googleapis.com/css?family=Raleway%3A300%2C300i%2C400%2C400i%2C600%2C600i%2C700%2C700i&#038;ver=4.7.2' type='text/css' media='all' />
  <style>
  p    {margin-top: 20px !important;}

  .fusion-button.button-1{
        margin-top:20px !important;
  }
  </style>

  <?php $is_ipad = (bool) ( isset( $_SERVER['HTTP_USER_AGENT'] ) && false !== strpos( $_SERVER['HTTP_USER_AGENT'],'iPad' ) ); ?>

  <?php
  $viewport = '';
  if ( Avada()->settings->get( 'responsive' ) && $is_ipad ) {
    $viewport .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
  } elseif ( Avada()->settings->get( 'responsive' ) ) {
    if ( Avada()->settings->get( 'mobile_zoom' ) ) {
      $viewport .= '<meta name="viewport" content="width=device-width, initial-scale=1" />';
    } else {
      $viewport .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />';
    }
  }

  $viewport = apply_filters( 'avada_viewport_meta', $viewport );
  echo $viewport;
  ?>

  <?php wp_head(); ?>

  <?php

  $object_id = get_queried_object_id();
  $c_page_id  = Avada()->get_page_id();
  ?>

  <script type="text/javascript">
    var doc = document.documentElement;
    doc.setAttribute('data-useragent', navigator.userAgent);
  </script>

  <?php echo Avada()->settings->get( 'google_analytics' ); ?>

  <?php echo Avada()->settings->get( 'space_head' ); ?>
</head><?
$wrapper_class = '';


if ( is_page_template( 'blank.php' ) ) {
  $wrapper_class  = 'wrapper_blank';
}

if ( 'modern' == Avada()->settings->get( 'mobile_menu_design' ) ) {
  $mobile_logo_pos = strtolower( Avada()->settings->get( 'logo_alignment' ) );
  if ( 'center' == strtolower( Avada()->settings->get( 'logo_alignment' ) ) ) {
    $mobile_logo_pos = 'left';
  }
}

?>
<body <?php body_class(); ?>>

<?
$full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/lists.css">
<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/events.css">
<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/style.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/sweetalert2/6.3.2/sweetalert2.js"></script><?
$page_slug ='about-us';
$page_data = get_page_by_path($page_slug);
$page_id = $page_data->ID;
echo apply_filters('the_content', $page_data->post_content)
?>
</body>
</html>