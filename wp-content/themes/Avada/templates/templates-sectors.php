<?php
/**

 * Template Name: Sectors

 */
?>

<?php get_header(); ?>

<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/lists.css">
<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/events.css">


<div class="banner_top_on_list_categories">
	<div class="set_dimensions_to_banner_top">
		<img src="<?php echo content_url(); ?>/uploads/2017/01/banner_top_img.jpg" alt="">
		<div class="include_search_on_list_categories_top">
			<form action="<?php echo get_permalink(13750); ?>">
				
				<input type="text" name="q" placeholder="Search for companies" class="style_input_search_on_page_list" value="<?php if(isset($_GET['q'])) echo $_GET['q'];?>">
				<div class="include_button_submit_on_page_list">
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
				</div>

			</form>
		</div>
	</div>
</div>
<div class="title_categories">
	<div class="m_events_in_future style_events_on_page">
		<h2>Corporate Sectors</h2>
	</div>
	<div class="back_button_right">
		<?php if(isset($_GET['start'])) { ?>
		<a href="<?php echo get_permalink(13726); ?>">
			<i class="fa fa-arrow-left" aria-hidden="true"></i>
			<span>Back</span>
		</a>
		<?php } ?>
	</div>
</div>
<div class="display_alphabetic_bar txtaC">
	<a class="link_to_all_sectors" href="javascript:void(0)">All Sectors</a>
</div>

<?php

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
	'posts_per_page'	=>	12,
	'post_type'			=>	'sector',
	'orderby'			=>	'title',
	'order'				=>	'ASC',
	'paged'				=>	$paged
	);


if(isset($_GET['start'])&&!empty($_GET['start'])) {
	$args['sector_title'] = esc_attr( sanitize_text_field( $_GET['start'] ) );
}

// query
$the_query = new WP_Query( $args );

?>
<div class="list_grid addBB">

	<?php if( $the_query->have_posts() ): ?>
		<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

			<?php $post_slug = get_post_field( 'post_name', get_post() ); ?>

			<div class="item_grid">
				<div class="img_wrap">
					<!-- <a class="company_img" href="<?php echo esc_url( add_query_arg( 'cat', get_the_ID(), get_permalink(13750) ) ) ?>">
						<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>" alt="picture">
					</a> -->
					<a class="company_img" href="<?php echo esc_url( add_query_arg( 'cat', $post_slug, get_permalink(13750) ) ) ?>">
						<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>" alt="picture">
					</a>
					<h5 class="company_name"><?php the_title(); ?></h5>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>

	<div class="clearfix"></div>

	<!-- <script>
		var lastItems = jQuery(".list_grid .item_grid");
		lastItems.slice(lastItems.length -2).addClass("removeBorder");
	</script> -->
</div>

<?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

<div class="pagination_wrap">
	<ul class="pagination_list">
		<?php

		$big = 999999999;

		echo paginate_links(
			array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $the_query->max_num_pages
				)
			);

			?>
		</ul>
	</div>

	<div class="m_member_to_events mt_0">
		<div class="m_text_find_event">
			<?php the_field('text_become_a_member_banner', 'option'); ?>
		</div>
		<div class="holding_card">
			<?php
			$image = get_field('image_become_a_member_banner', 'option');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>
	</div>


	<div class="title_categories noMinHeight noPad">
		<div class="m_events_in_future ">
			<h2> Members Overview</h2>
		</div>
	</div>

	<div class="m_slider_on_page mb_0">
		<div class="owl_carousel_slider">
			<?php suggestion_profile(); ?>
		</div>
	</div>

	<div class="m_due_cols">
		<div class="m_col1">
			<div class="m_image_col1">
				<?php
				$image = get_field('image_bottom_banner_left', 'option');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
			</div>
			<div class="m_present_consult txtaC">
				<?php the_field('text_bottom_banner_left', 'option'); ?>
			</div>
		</div>
		<div class="m_col2">
			<div class="m_benefits">
				<?php the_field('text_bottom_banner_right', 'option'); ?>
			</div>
			<div class="m_obtain_cart p_r m_t_20">
				<a href="<?php the_field('button_link', 'option'); ?>">
					<img src="http://belpro.co/fbg/wp-content/uploads/2017/01/blue-sticker.png" alt="sticker">
					<p><?php the_field('button_title', 'option'); ?></p>
				</a>
			</div>
			<div class="m_cart_img">
				<?php
				$image = get_field('image_bottom_banner_right', 'option');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
			</div>
		</div>
	</div>
	
	<div class="m_due_cols m_bg_blue_def">
		<div class="m_newsletter m_b_20">
			<p>Register to our newsletter</p>
			<p>Receive the latest news digest, upcoming events and stay informed!</p>
		</div>
		<div class="m_newsletter_inputs">
			<div class="m_style_label_input">
				<form action="/" method="POST">
					<div class="m_b_20">
						<label for="m_name">Your First Name*</label>
						<input type="text">
					</div>
					<div class="m_b_20">
						<label for="m_name">Your Email*</label>
						<input type="email">
					</div>
					<div class="m_b_20">
						<button type="submit">Sumbit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
		


	<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/owl.theme.css">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
	<script type='text/javascript' src='<?php echo content_url(); ?>/themes/Avada/assets/js/owl.carousel.min.js'></script> 
	<script>
		jQuery(document).ready(function() {				
			jQuery('.owl_carousel_slider').owlCarousel ({
				items: 5,
				itemsDesktop: [1299, 4],
				itemsDesktopSmall: [991, 3],
				itemsTablet: [768, 2],
				itemsMobile: [480, 1],
				navigation: true,
				pagination: false,
				autoPlay: false,
				navigationText: ['<i class="icon_left"></i>','<i class="icon_right"></i>']
			});
		});
	</script>
	<?php get_footer(); ?>