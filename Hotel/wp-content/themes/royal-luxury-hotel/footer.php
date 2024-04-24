<?php
/**
 * The template for displaying the footer
 * @subpackage Royal Luxury Hotel
 * @since 1.0
 * @version 0.1
 */

?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<!-- <div class="footer-overlay"></div> -->
		<div class="container">
			<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
		</div>
		<div class="copyright"> 
			<div class="container">
				<?php get_template_part( 'template-parts/footer/site', 'info' ); ?>
			</div>
		</div>
	</footer>
	<?php if (get_theme_mod('royal_luxury_hotel_show_back_totop',true) != ''){ ?>
		<button role="tab" class="back-to-top"><span class="back-to-top-text"><?php echo esc_html('Top', 'royal-luxury-hotel'); ?></span></button>
	<?php }?>

<?php wp_footer(); ?>
</body>
</html>