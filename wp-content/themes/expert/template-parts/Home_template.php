<?php
/*
Template Name: Home Page
*/

get_header(); ?>
<div class="banner" style="background-image:url('<?php echo get_field('slider_image_one'); ?>');">
	<div class="container">
		<div class="banner-main">
			<?php the_field('slider_content'); ?>
			<div class="company">
			<?php 
				$image = get_field('companies');
				foreach($image as $img) { ?>
			<span><img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" /></span>
			<?php } ?>
            
			</div>
		</div>
	</div>
</div>
<div class="wrappar process">
	<div class="container">
		<div class="process-left">
			<img src="<?php echo get_field('insiders_1'); ?>" alt="" />
			<img src="<?php echo get_field('insiders_2'); ?>" alt="" />
		</div>
		<div class="process-right">
		<?php echo get_field('inseder_text_1'); ?>
			<div class="process-main">
				<div class="p-row">
					<img src="<?php echo get_field('browse_image'); ?>" alt="" />
					<?php echo get_field('browse_text'); ?>
				</div>
				<div class="p-row">
					<img src="<?php echo get_field('select_image'); ?>" alt="" />
					<?php echo get_field('select_text'); ?>
				</div>
				<div class="p-row">
					<img src="<?php echo get_field('connect_image'); ?>" alt="" />
					<?php echo get_field('connect_text'); ?>
				</div>
				<div class="p-row">
					<a href="<?php echo site_url();?>/find-insiders/" class="btn btn-pink">Find your insiders</a>
				</div>
			</div>
		</div>
		<div class="clr"></div>
	</div>
</div>
<div class="wrappar grey-wrap testimonial">
	<div class="container">
		<h2 class="heading">What people say</h2>
		<div class="testi-main">
			<?php echo do_shortcode( '[rt-testimonial id="98" title="Home Testimonial"]' ) ?>
		</div>
	</div>
</div>
<div class="wrappar more">
	<div class="container">
		<div class="more-box">
		<?php echo get_field('career_conversation'); ?>
		</div>
		<div class="more-box">
		<?php echo get_field('business_consulting'); ?>
			
		</div>
		<div class="more-box">
		<?php echo get_field('background_check'); ?>
		
		</div>
		<div class="clr"></div>
	</div>
</div>
<div class="become-insider">
	<div class="container">
		<a href="<?php echo site_url();?>/find-insiders/" class="btn btn-pink">Find your insiders</a>
		<span>OR</span>
		<a href="<?php echo site_url();?>/become-an-insider/" class="link">Become an insider yourself!</a>
	</div>
</div>
<?php get_footer(); ?>