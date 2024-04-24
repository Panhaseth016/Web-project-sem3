<?php 


/**
 *  Defining Constants
 */

// Core Constants
define('OWN_SHOPE_REQUIRED_PHP_VERSION', '5.6' );
define('OWN_SHOPE_THEME_AUTH','https://www.spiraclethemes.com/');
define('OWN_SHOPE_THEME_URL','https://www.spiraclethemes.com/own-shope-free-wordpress-theme/');
define('OWN_SHOPE_THEME_PRO_URL','https://www.spiraclethemes.com/own-shop-pro-addons/');
define('OWN_SHOPE_THEME_DOC_URL','https://www.spiraclethemes.com/own-shop-documentation/');
define('OWN_SHOPE_THEME_VIDEOS_URL','https://www.spiraclethemes.com/own-shope-video-tutorials/');
define('OWN_SHOPE_THEME_SUPPORT_URL','https://wordpress.org/support/theme/own-shope/');
define('OWN_SHOPE_THEME_RATINGS_URL','https://wordpress.org/support/theme/own-shope/reviews/');
define('OWN_SHOPE_THEME_CHANGELOGS_URL','https://themes.trac.wordpress.org/log/own-shope/');
define('OWN_SHOPE_THEME_CONTACT_URL','https://www.spiraclethemes.com/contact/');
define('OWN_SHOPE_CONTAINER_CLASS', esc_html(get_theme_mod('own_shop_layout_content_width_ratio','os-container')));


/**
* Check for minimum PHP version requirement 
*
*/
function own_shope_check_theme_setup( $oldtheme_name, $oldtheme ){
  	// Compare versions.
  	if ( version_compare(phpversion(), OWN_SHOPE_REQUIRED_PHP_VERSION, '<') ) :
	  	// Theme not activated info message.
	  	add_action( 'admin_notices', 'own_shope_php_admin_notice' );
	  	function own_shope_php_admin_notice() {
	    	?>
	      		<div class="update-nag">
	          		<?php 
	          			esc_html_e( 'You need to update your PHP version to a minimum of 5.6 to run Own Shope WordPress Theme.', 'own-shope' ); 
	          		?> 
	          		<br />
	          		<?php esc_html_e( 'Actual version is:', 'own-shope' ) ?> 
	          		<strong><?php echo phpversion(); ?></strong>, 
	          		<?php esc_html_e( 'required is', 'own-shope' ) ?> 
	          		<strong><?php echo OWN_SHOPE_REQUIRED_PHP_VERSION; ?></strong>
	      		</div>
	    	<?php
	  	}
		// Switch back to previous theme.
		switch_theme( $oldtheme->stylesheet );
		return false;
	endif;
}
add_action( 'after_switch_theme', 'own_shope_check_theme_setup', 10, 2  );



/**
 * Own Shope theme functions
 */	
function own_shope_theme_setup(){

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	//remove theme support for new widgets block editor
	remove_theme_support( 'widgets-block-editor' );
    
    remove_action( 'admin_menu', 'own_shop_add_menu' );
    remove_action( 'enqueue_block_editor_assets', 'own_shop_block_editor_width_styles' );
	
	add_action('wp_enqueue_scripts', 'own_shope_load_scripts');

	/**
	* Adding translation file
	*/
	$path = get_stylesheet_directory().'/languages';
    load_child_theme_textdomain( 'own-shope', $path );

    if ( is_customize_preview() ) :
    	require_once( get_stylesheet_directory(). '/inc/starter-content.php' );
		add_theme_support( 'starter-content', own_shope_get_starter_content() );
	endif;
}
add_action( 'after_setup_theme', 'own_shope_theme_setup', 99 );



/**
 * Setting default theme mods value for child theme
 */
function own_shope_set_default_theme_mods() {
	set_theme_mod('own_shop_site_primary_color', '#333333');
    set_theme_mod('own_shop_site_secondary_color', '#000000');
}
add_action('after_switch_theme', 'own_shope_set_default_theme_mods');


/**
 * Load Scripts
 */
function own_shope_load_scripts() {

	//dequeue parent blocks-frontend
	wp_dequeue_style( 'blocks-frontend' );
	
	wp_register_style( 'own-shope-style' , trailingslashit(get_stylesheet_directory_uri()).'style.min.css', false, wp_get_theme()->get('Version'), 'all');
	wp_style_add_data( 'own-shope-style', 'rtl', 'replace' );
	wp_style_add_data( 'own-shope-style', 'suffix', '.min' );
	wp_enqueue_style( 'own-shope-style' );

	if ( own_shope_is_active_woocommerce() ) :
		wp_register_style( 'own-shope-woocommerce-style', trailingslashit(get_stylesheet_directory_uri()) . 'css/woo-style.min.css', array(), wp_get_theme()->get('Version'));
    	wp_style_add_data( 'own-shope-woocommerce-style', 'rtl', 'replace' );
    	wp_style_add_data( 'own-shope-woocommerce-style', 'suffix', '.min' );
		wp_enqueue_style( 'own-shope-woocommerce-style' );
	endif;
	
	wp_register_style( 'own-shope-blocks-frontend', trailingslashit(get_stylesheet_directory_uri()).'css/blocks-frontend.min.css', false, wp_get_theme()->get('Version'), 'all');
	wp_style_add_data( 'own-shope-blocks-frontend', 'rtl', 'replace' );
	wp_style_add_data( 'own-shope-blocks-frontend', 'suffix', '.min' );
	wp_enqueue_style( 'own-shope-blocks-frontend' );

	// Child Main js
	wp_enqueue_script( 'own-shope-script', trailingslashit(get_stylesheet_directory_uri()).'js/own-shope.js',array(), wp_get_theme()->get('Version'), true );
	wp_localize_script( 'own-shope-script', 'own_shope_obj', 
		array( 
			'ajax_url' => admin_url( 'admin-ajax.php' ), 
			'nonce'    => wp_create_nonce( 'own-shope-search-nonce' )
		)
	);

}

/**
 * Display dynamic CSS.
 */
function own_shope_dynamic_css_wrap() {
    require_once( get_stylesheet_directory(). '/css/dynamic.css.php' );
    ?>
       	<style type="text/css" id="own-shope-dynamic-style">
        	<?php echo own_shope_dynamic_css_stylesheet(); ?>
       	</style>
    <?php 
}
add_action( 'wp_head', 'own_shope_dynamic_css_wrap',20 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function own_shope_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Topbar Sidebar', 'own-shope' ),
		'id'            => 'topsidebar',
		'description'   => esc_html__( 'Add widgets here.', 'own-shope' ),
		'before_widget' => '<ul id="%1$s" class="widget %2$s">',
		'after_widget'  => '</ul>',
	) );
}
add_action( 'widgets_init', 'own_shope_widgets_init', 20 );


/**
 * Admin scripts
 */
if ( ! function_exists( 'own_shope_admin_scripts' ) ) :
function own_shope_admin_scripts($hook) {
    if('appearance_page_own-shope-theme-info' != $hook)
    	return;  
    wp_enqueue_style( 'own-shope-info', trailingslashit(get_stylesheet_directory_uri()).'css/own-shope-theme-info.css', false );
}
endif;
add_action( 'admin_enqueue_scripts', 'own_shope_admin_scripts' );


/**
 * Adding class to body
 */
if ( ! function_exists( 'own_shope_add_classes_to_body' ) ) :
function own_shope_add_classes_to_body($classes = '') {
    return array_merge( $classes, array( 'own-shope','layout-'.OWN_SHOPE_CONTAINER_CLASS ) );
}
endif;
add_filter('body_class', 'own_shope_add_classes_to_body');


/**
 * Function for Minimizing dynamic CSS
 */
function own_shope_minimize_css($css){
    $css = preg_replace('/\/\*((?!\*\/).)*\*\//', '', $css);
    $css = preg_replace('/\s{2,}/', ' ', $css);
    $css = preg_replace('/\s*([:;{}])\s*/', '$1', $css);
    $css = preg_replace('/;}/', '}', $css);
    return $css;
}


/**
 * Load our Block Editor styles to style the Editor like the front-end
 */
if ( ! function_exists( 'own_shope_block_editor_width_styles' ) ) :
function own_shope_block_editor_width_styles() {
	$own_shope_layout_width = 1200;
	$styles = '';

	wp_register_style( 'own-shope-blocks-style', trailingslashit(get_stylesheet_directory_uri()).'css/blocks-style.min.css',  array(), '1.0.0', 'all');
	wp_style_add_data( 'own-shope-blocks-style', 'rtl', 'replace' );
	wp_style_add_data( 'own-shope-blocks-style', 'suffix', '.min' );
	wp_enqueue_style( 'own-shope-blocks-style' );

	// Increase width of Title
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-post-title .editor-post-title__block {max-width: ' . esc_attr( $own_shope_layout_width - 10 ) . 'px;}';

	// Increase width of all Blocks & Block Appender
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-block-list__block {max-width: ' . esc_attr( $own_shope_layout_width - 10 ) . 'px;}';
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-default-block-appender {max-width: ' . esc_attr( $own_shope_layout_width - 10 ) . 'px;}';

	// Increase width of Wide blocks
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-block-list__block[data-align="wide"] {max-width: ' . esc_attr( $own_shope_layout_width - 10 + 400 ) . 'px;}';

	// Remove max-width on Full blocks
	$styles .= 'body.gutenberg-editor-page .edit-post-visual-editor .editor-block-list__block[data-align="full"] {max-width: none;}';

	// Adding dynamic color
	$styles .= '.wp-block-button__link, .wc-block-grid__product-onsale, .wp-block-search .wp-block-search__button {background-color: ' .sanitize_hex_color(get_theme_mod( 'own_shop_site_primary_color','#cc9866' )) .';}';

	// Output our styles into the <head> whenever our block styles are enqueued
	wp_add_inline_style( 'own-shope-blocks-style', $styles );
}
endif;
add_action( 'enqueue_block_editor_assets', 'own_shope_block_editor_width_styles' );


/**
 * Add Class to body
 */

function own_shope_body_class_blocks( $classes ) {
	if ( is_singular() && has_blocks() && !is_single() ) {
		$classes[] = 'has-blocks';
	}
	return $classes;
}
add_filter( 'body_class', 'own_shope_body_class_blocks' );


/**
* Includes
*/

//include info
require_once( get_stylesheet_directory(). '/inc/theme-info.php' );


//include customizer
require_once( get_stylesheet_directory(). '/inc/customizer/customizer.php' );


//include template functions
require_once( get_stylesheet_directory(). '/inc/template-functions.php' );


//include template hooks
require_once( get_stylesheet_directory(). '/inc/template-hooks.php' );


/**
 * Upgrade to Pro
 */
require_once( get_stylesheet_directory(). '/own-shope-pro/class-customize.php' );