<?php


// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>


<?php

global $wpdb;

$sq = get_search_query();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


$users = array();

if($paged == 1) {

	$sql = "
	SELECT
		*
	FROM
		wp_usermeta 
	WHERE
		user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key LIKE 'company' AND meta_value > 0)
		AND
		(
			(
				meta_key LIKE  'first_name'
				AND meta_value LIKE '%{$sq}%'
			)
			OR
			(
				meta_key LIKE  'last_name'
				AND meta_value LIKE '%{$sq}%'
			)
		)
	";

	$users = $wpdb->get_results( $sql );

}


?>

<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php if ( ( have_posts() || !empty($users) ) && 0 != strlen( trim( get_search_query() ) ) ) : ?>

		<?php if ( 'bottom' == Avada()->settings->get( 'search_new_search_position' ) ) : ?>
			<?php get_template_part( 'templates/blog', 'layout' ); ?>
			<div class="fusion-clearfix"></div>
		<?php endif; ?>

		<?php if ( 'hidden' != Avada()->settings->get( 'search_new_search_position' ) ) : ?>
			<div class="search-page-search-form search-page-search-form-<?php echo Avada()->settings->get( 'search_new_search_position' ); ?>">
				<?php
				/**
				 * Render the post title
				 */
				echo avada_render_post_title( 0, false, esc_html__( 'Need a new search?', 'Avada' ) );
				?>
				<p><?php esc_html_e( 'If you didn\'t find what you were looking for, try a new search!', 'Avada' ); ?></p>
				<form class="searchform seach-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
					<div class="search-table">
						<div class="search-field">
							<label class="screen-reader-text" for="searchform"><?php _e( 'Search for:', 'Avada' ); ?></label>
							<input id="searchform" type="text" value="" name="s" class="s" placeholder="<?php esc_html_e( 'Search ...', 'Avada' ); ?>"/>
						</div>
						<div class="search-button">
							<input type="submit" class="searchsubmit" value="&#xf002;" />
						</div>
					</div>
				</form>
			</div>
		<?php endif; ?>

		<?php if ( 'top' == Avada()->settings->get( 'search_new_search_position' ) || 'hidden' == Avada()->settings->get( 'search_new_search_position' ) ) : ?>
			
			<?php if(!empty($users)) { ?>
			<div id="posts-container2" class="fusion-blog-layout-grid fusion-blog-layout-grid-3 isotope fusion-blog-pagination fusion-blog-archive fusion-clearfix" data-pages="2">

				<?php foreach ($users as $key => $value) { ?>

				<?php $user_info = get_userdata($value->user_id); ?>

				<?php $user_l = get_user_meta( $value->user_id , 'first_name', true ); ?>
				<?php $user_f = get_user_meta( $value->user_id , 'last_name', true ); ?>
				<?php $company = get_user_meta( $value->user_id , 'company', true ); ?>

				<article id="post-user-<?php echo $value->user_id; ?>" class="fusion-post-grid post fusion-clearfix post-14692 company type-company status-publish hentry" >

					<div class="fusion-post-wrapper">
						<div class="fusion-post-content-wrapper">
							<div class="fusion-post-content post-content">
								<h2 class="entry-title fusion-post-title" data-fontsize="21" data-lineheight="27">
									<a href="<?php echo get_permalink(14559) . '?uid=' . $value->user_id; ?>"><?php echo $user_l . " " . $user_f; ?></a>
								</h2>
								<p class="fusion-single-line-meta">
									<span><?php echo $user_info->user_registered; ?></span>
								</p>

								<div class="fusion-content-sep"></div>
								<div class="fusion-post-content-container">
									<p><?php echo get_the_title($company); ?></p>
								</div>
							</div>
							<div class="fusion-meta-info">
								<div class="fusion-alignleft">
									<a href="<?php echo get_permalink(14559) . '?uid=' . $value->user_id; ?>" class="fusion-read-more">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</article>

				<?php } ?>

				</div>
			<?php } ?>

			<?php get_template_part( 'templates/blog', 'layout' ); ?>

		<?php endif; ?>

	<?php else : ?>

		<div class="post-content">

			<?php echo Avada()->template->title_template( esc_html__( 'Couldn\'t find what you\'re looking for!', 'Avada' ) ); ?>
			<div class="error-page">
				<div class="fusion-columns fusion-columns-3">
					<div class="fusion-column col-lg-4 col-md-4 col-sm-4">
						<h1 class="oops"><?php esc_html_e( 'Oops!', 'Avada' ); ?></h1>
					</div>
					<div class="fusion-column col-lg-4 col-md-4 col-sm-4 useful-links">
						<h3><?php esc_html_e( 'Helpful Links:', 'Avada' ); ?></h3>
						<?php $circle_class = ( Avada()->settings->get( 'checklist_circle' ) ) ? 'circle-yes' : 'circle-no'; ?>
						<?php wp_nav_menu( array(
							'theme_location' => '404_pages',
							'depth'          => 1,
							'container'      => false,
							'menu_class'     => 'error-menu list-icon list-icon-arrow ' . $circle_class,
							'echo'           => 1,
							) ); ?>
						</div>
						<div class="fusion-column col-lg-4 col-md-4 col-sm-4">
							<h3><?php esc_html_e( 'Try again', 'Avada' ); ?></h3>
							<p><?php esc_html_e( 'If you want to rephrase your query, here is your chance:', 'Avada' ); ?></p>
							<?php echo get_search_form( false ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<?php do_action( 'avada_after_content' ); ?>
	<?php get_footer();


	echo "
	<style>
	.side-header-wrapper{
		padding-top: 33px;
	}
	#posts-container2.fusion-blog-layout-grid .fusion-post-grid {
		padding: 20px;
	}
	</style>";

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
