<div class="wrap">
	<h2><?php _e( 'Testimonial Settings', "testimonial-slider-showcase-pro" ) ?></h2>
	<div class="tlp-content-holder clear">
		<div class="tss-admin-wrapper tch-left">
			<form id="tss-settings">
				<div id="settings-tabs" class="rt-tabs rt-tab-container">
					<ul class="tab-nav rt-tab-nav">
						<li><a href="#general"><?php _e( 'General', "testimonial-slider-showcase-pro" ); ?></a></li>
						<li><a href="#custom-css"><?php _e( 'Custom Css', "testimonial-slider-showcase-pro" ); ?></a>
						</li>
					</ul>
					<div id="general" class="rt-tab-content">
						<?php echo TSSPro()->rtFieldGenerator( TSSPro()->generalSettings() ); ?>
					</div>
					<div id="custom-css" class="rt-tab-content">
						<?php echo TSSPro()->rtFieldGenerator( TSSPro()->othersSettings() ); ?>
					</div>
				</div>
				<p class="submit"><input type="submit" name="submit" id="tlpSaveButton" class="button button-primary"
				                         value="<?php _e( 'Save Changes', "testimonial-slider-showcase-pro" ); ?>"></p>

				<?php wp_nonce_field( TSSPro()->nonceText(), TSSPro()->nonceId() ); ?>
			</form>
			<div id="response" class="updated"></div>
		</div>
		<div class="tch-right">
			<div id="pro-feature" class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle ui-sortable-handle"><span>Testimonial Pro Feature</span></h3>
				<div class="inside">
					<?php echo TSSPro()->get_pro_feature_list(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="tlp-help">
		<p></p>
		<p class="tlp-help-link"><a class="button-primary"
		                            href="http://demo.radiustheme.com/wordpress/plugins/testimonials-slider/"
		                            target="_blank"><?php _e( 'Demo', "testimonial-slider-showcase" ); ?></a> <a
				class="button-primary"
				href="https://www.radiustheme.com/setup-wp-testimonials-slider-showcase-wordpress/"
				target="_blank"><?php _e( 'Documentation', "testimonial-slider-showcase" ); ?></a></p>
	</div>
</div>
