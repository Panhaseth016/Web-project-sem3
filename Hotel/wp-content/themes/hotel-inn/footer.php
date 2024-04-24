<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hotel_inn
 */

$hotel_inn_options = hotel_inn_theme_options();

$show_prefooter = $hotel_inn_options['show_prefooter'];

?>

<footer id="colophon" class="site-footer">


	<?php if ($show_prefooter== 1){ ?>
	    <section class="footer-sec">
	        <div class="container">
	            <div class="row">
	                <?php if (is_active_sidebar('hotel_inn_footer_1')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('hotel_inn_footer_1') ?>
	                    </div>
	                    <?php
	                else: hotel_inn_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('hotel_inn_footer_2')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('hotel_inn_footer_2') ?>
	                    </div>
	                    <?php
	                else: hotel_inn_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('hotel_inn_footer_3')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('hotel_inn_footer_3') ?>
	                    </div>
	                    <?php
	                else: hotel_inn_blank_widget();
	                endif; ?>
	            </div>
	        </div>
	    </section>
	<?php } ?>

		<div class="site-info">
		<p><?php esc_html_e('Powered By WordPress', 'hotel-inn');
                    esc_html_e(' | ', 'hotel-inn') ?>
                    <span><a target="_blank" rel="nofollow"
                       href="<?php echo esc_url('https://www.flawlessthemes.com/theme/hotel-inn-best-hotel-booking-wordpress-theme/'); ?>"><?php esc_html_e('Hotel Inn' , 'hotel-inn'); ?></a></span>
                    
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
