<?php
/**
 * The header for our theme
 *
 * @subpackage Royal Luxury Hotel
 * @since 1.0
 * @version 0.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}?>

<a class="screen-reader-text skip-link" href="#skip-content"><?php esc_html_e( 'Skip to content', 'royal-luxury-hotel' ); ?></a>

<div id="header">
	<div class="container">
		<div class="row ">
			<div class="col-lg-3 col-md-3 align-self-center">
				<div class="logo text-md-left text-center">
					<?php if ( has_custom_logo() ) : ?>
	            		<?php the_custom_logo(); ?>
		            <?php endif; ?>
	             	<?php if (get_theme_mod('royal_luxury_hotel_show_site_title',true)) {?>
	          			<?php $royal_luxury_hotel_blog_info = get_bloginfo( 'name' ); ?>
		                <?php if ( ! empty( $royal_luxury_hotel_blog_info ) ) : ?>
		                  	<?php if ( is_front_page() && is_home() ) : ?>
		                    	<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		                  	<?php else : ?>
	                      		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
	                  		<?php endif; ?>
		                <?php endif; ?>
		            <?php }?>
		            <?php if (get_theme_mod('royal_luxury_hotel_show_tagline',true)) {?>
		                <?php $royal_luxury_hotel_description = get_bloginfo( 'description', 'display' );
	                  	if ( $royal_luxury_hotel_description || is_customize_preview() ) : ?>
		                  	<p class="site-description"><?php echo esc_html($royal_luxury_hotel_description); ?></p>
	              		<?php endif; ?>
	          		<?php }?>
				</div>
			</div>

			<div class="col-lg-9 col-md-9 main-bx">
				
				<!-- <div class="row mrg-0"> -->
				<div class="menu-bar row mrg-0 ">
					<div class="toggle-menu responsive-menu text-right">
						<?php if(has_nav_menu('primary')){ ?>
			            	<button onclick="royal_luxury_hotel_open()" role="tab" class="mobile-menu"><i class="fas fa-bars"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','royal-luxury-hotel'); ?></span></button>
			            <?php }?>
			        </div>
					<div id="sidelong-menu" class="nav sidenav">
		                <nav id="primary-site-navigation" class="nav-menu " role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'royal-luxury-hotel' ); ?>">
		                  	<?php if(has_nav_menu('primary')){
			                    wp_nav_menu( array( 
									'theme_location' => 'primary',
									'container_class' => 'main-menu-navigation clearfix' ,
									'menu_class' => 'clearfix',
									'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
									'fallback_cb' => 'wp_page_menu',
			                    ) ); 
		                  	} ?>
		                  	<a href="javascript:void(0)" class="closebtn responsive-menu" onclick="royal_luxury_hotel_close()"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','royal-luxury-hotel'); ?></span></a>

		                  	<?php if(get_theme_mod('royal_luxury_hotel_contact_btn_url') != '' || get_theme_mod('royal_luxury_hotel_contact_btn_text') != '') {?>
		                  	<div class=" mob-y">
						  		<div class=" contact-btn">
						  			<a href="<?php echo esc_url(get_theme_mod('royal_luxury_hotel_contact_btn_url')); ?>" target="_blank"><span><?php echo esc_html(get_theme_mod('royal_luxury_hotel_contact_btn_text')); ?></span></a>
						  		</div>
						  	</div>
						  	<?php }?>
		                </nav>
		            </div>
		            <?php if(get_theme_mod('royal_luxury_hotel_contact_btn_url') != '' || get_theme_mod('royal_luxury_hotel_contact_btn_text') != '') {?>
		            <div class=" mob-n">
				  		<div class=" contact-btn">
				  			<a href="<?php echo esc_url(get_theme_mod('royal_luxury_hotel_contact_btn_url')); ?>" target="_blank"><span><?php echo esc_html(get_theme_mod('royal_luxury_hotel_contact_btn_text')); ?></span></a>
				  		</div>
				  	</div>
				  	<?php }?>
		        </div>
		        
		  	<!-- </div> -->
		       <div class="clearfix"></div>
			</div>
			
		</div>
	</div>
</div>