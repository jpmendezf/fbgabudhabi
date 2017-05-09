<?php

/**
 * Template Name: Select Plan
 */

?>


<?php get_header(); ?>

<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/events.css">

<style type="text/css">
	
	.gform_heading, .gf_progressbar_wrapper {
		display : none!important;
	}

</style>


<div class="mg_10 forms_select_plan">

	<?php echo do_shortcode('[gravityform id=1 title=false]'); ?>
	<?php echo do_shortcode('[gravityform id=2 title=false]'); ?>

</div>


<script type="text/javascript">

	jQuery('.forms_select_plan :input[type="radio"]').change(function () {

		jQuery('#gform_1 :input[type="button"]').hide();
		jQuery('#gform_2 :input[type="button"]').hide();

		jQuery('.forms_select_plan :input[type="radio"]').removeProp('checked');

		var id = this.id;
		jQuery('#' + id).prop('checked','checked');


		if( jQuery('#gform_1 :input[type="radio"]:checked').length > 0){
			jQuery('#gform_1 :input[type="button"]').show();
		}

		if( jQuery('#gform_2 :input[type="radio"]:checked').length > 0){
			jQuery('#gform_2 :input[type="button"]').show();
		}

	});


	jQuery( document ).ready(function() {

		jQuery('#gform_1').attr('action', '<?php echo get_permalink(13503); ?>');
		jQuery('#gform_2').attr('action', '<?php echo get_permalink(13764); ?>');

		jQuery('#gform_1 :input[type="button"]').hide();
		jQuery('#gform_2 :input[type="button"]').hide();

	});

</script>


<link rel="stylesheet" href="<?php echo content_url(); ?>/themes/Avada/assets/css/events.css"><div class="fusion-clearfix"></div>

<?php get_footer(); ?>

