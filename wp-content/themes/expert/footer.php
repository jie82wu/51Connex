<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		<div class="footer">
	<div class="container">
		<div class="copyright"><?php dynamic_sidebar('copy');?></div>
		<div class="policy">
			<?php dynamic_sidebar('footer');?>
		</div>
		<div class="clr"></div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
