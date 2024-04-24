<?php
/**
 * Royal Luxury Hotel: Customizer
 *
 * @subpackage Royal Luxury Hotel
 * @since 1.0
 */

use WPTRT\Customize\Section\Royal_Luxury_Hotel_Button;

add_action( 'customize_register', function( $manager ) {

	$manager->register_section_type( Royal_Luxury_Hotel_Button::class );

	$manager->add_section(
		new Royal_Luxury_Hotel_Button( $manager, 'royal_luxury_hotel_pro', [
			'title' => __( 'Royal Luxury Hotel Pro', 'royal-luxury-hotel' ),
			'priority' => 0,
			'button_text' => __( 'Go Pro', 'royal-luxury-hotel' ),
			'button_url'  => esc_url( 'https://www.luzuk.com/product/hotel-wordpress-template', 'royal-luxury-hotel')
		] )
	);

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script(
		'royal-luxury-hotel-customize-section-button',
		get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
		[ 'customize-controls' ],
		$version,
		true
	);

	wp_enqueue_style(
		'royal-luxury-hotel-customize-section-button',
		get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
		[ 'customize-controls' ],
 		$version
	);

} );

function royal_luxury_hotel_customize_register( $wp_customize ) {

	$wp_customize->add_setting('royal_luxury_hotel_logo_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('royal_luxury_hotel_logo_padding',array(
		'label' => __('Logo Margin','royal-luxury-hotel'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting('royal_luxury_hotel_logo_top_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'royal_luxury_hotel_sanitize_float'
	));
	$wp_customize->add_control('royal_luxury_hotel_logo_top_padding',array(
		'type' => 'number',
		'description' => __('Top','royal-luxury-hotel'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('royal_luxury_hotel_logo_bottom_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'royal_luxury_hotel_sanitize_float'
	));
	$wp_customize->add_control('royal_luxury_hotel_logo_bottom_padding',array(
		'type' => 'number',
		'description' => __('Bottom','royal-luxury-hotel'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('royal_luxury_hotel_logo_left_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'royal_luxury_hotel_sanitize_float'
	));
	$wp_customize->add_control('royal_luxury_hotel_logo_left_padding',array(
		'type' => 'number',
		'description' => __('Left','royal-luxury-hotel'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('royal_luxury_hotel_logo_right_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'royal_luxury_hotel_sanitize_float'
 	));
 	$wp_customize->add_control('royal_luxury_hotel_logo_right_padding',array(
		'type' => 'number',
		'description' => __('Right','royal-luxury-hotel'),
		'section' => 'title_tagline',
    ));

	$wp_customize->add_setting('royal_luxury_hotel_show_site_title',array(
		'default' => true,
		'sanitize_callback'	=> 'royal_luxury_hotel_sanitize_checkbox'
	));
	$wp_customize->add_control('royal_luxury_hotel_show_site_title',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Site Title','royal-luxury-hotel'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting('royal_luxury_hotel_show_tagline',array(
		'default' => true,
		'sanitize_callback'	=> 'royal_luxury_hotel_sanitize_checkbox'
	));
	$wp_customize->add_control('royal_luxury_hotel_show_tagline',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Site Tagline','royal-luxury-hotel'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_panel( 'royal_luxury_hotel_panel_id', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Settings', 'royal-luxury-hotel' ),
		'description' => __( 'Description of what this panel does.', 'royal-luxury-hotel' ),
	) );

	$wp_customize->add_section( 'royal_luxury_hotel_theme_options_section', array(
    	'title'      => __( 'General Settings', 'royal-luxury-hotel' ),
		'priority'   => 30,
		'panel' => 'royal_luxury_hotel_panel_id'
	) );

	$wp_customize->add_setting('royal_luxury_hotel_theme_options',array(
		'default' => 'One Column',
		'sanitize_callback' => 'royal_luxury_hotel_sanitize_choices'
	));
	$wp_customize->add_control('royal_luxury_hotel_theme_options',array(
		'type' => 'select',
		'label' => __('Blog Page Sidebar Layout','royal-luxury-hotel'),
		'section' => 'royal_luxury_hotel_theme_options_section',
		'choices' => array(
		   'Left Sidebar' => __('Left Sidebar','royal-luxury-hotel'),
		   'Right Sidebar' => __('Right Sidebar','royal-luxury-hotel'),
		   'One Column' => __('One Column','royal-luxury-hotel'),
		   'Grid Layout' => __('Grid Layout','royal-luxury-hotel')
		),
	));

	$wp_customize->add_setting('royal_luxury_hotel_single_post_sidebar',array(
		'default' => 'Right Sidebar',
		'sanitize_callback' => 'royal_luxury_hotel_sanitize_choices'
	));
	$wp_customize->add_control('royal_luxury_hotel_single_post_sidebar',array(
        'type' => 'select',
        'label' => __('Single Post Sidebar Layout','royal-luxury-hotel'),
        'section' => 'royal_luxury_hotel_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','royal-luxury-hotel'),
            'Right Sidebar' => __('Right Sidebar','royal-luxury-hotel'),
            'One Column' => __('One Column','royal-luxury-hotel')
        ),
	));

	$wp_customize->add_setting('royal_luxury_hotel_page_sidebar',array(
		'default' => 'One Column',
		'sanitize_callback' => 'royal_luxury_hotel_sanitize_choices'
	));
	$wp_customize->add_control('royal_luxury_hotel_page_sidebar',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','royal-luxury-hotel'),
        'section' => 'royal_luxury_hotel_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','royal-luxury-hotel'),
            'Right Sidebar' => __('Right Sidebar','royal-luxury-hotel'),
            'One Column' => __('One Column','royal-luxury-hotel')
        ),
	));

	$wp_customize->add_setting('royal_luxury_hotel_archive_page_sidebar',array(
		'default' => 'One Column',
		'sanitize_callback' => 'royal_luxury_hotel_sanitize_choices'
	));
	$wp_customize->add_control('royal_luxury_hotel_archive_page_sidebar',array(
        'type' => 'select',
        'label' => __('Archive & Search Page Sidebar Layout','royal-luxury-hotel'),
        'section' => 'royal_luxury_hotel_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','royal-luxury-hotel'),
            'Right Sidebar' => __('Right Sidebar','royal-luxury-hotel'),
            'One Column' => __('One Column','royal-luxury-hotel'),
            'Grid Layout' => __('Grid Layout','royal-luxury-hotel')
        ),
	));

	//home page header
	$wp_customize->add_section( 'royal_luxury_hotel_header_section' , array(
    	'title'    => __( 'Header Settings', 'royal-luxury-hotel' ),
		'priority' => null,
		'panel' => 'royal_luxury_hotel_panel_id'
	) );

    $wp_customize->add_setting('royal_luxury_hotel_contact_btn_text',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('royal_luxury_hotel_contact_btn_text',array(
		'label'	=> __('Button Text','royal-luxury-hotel'),
		'section' => 'royal_luxury_hotel_header_section',
		'type' => 'text'
	));

    $wp_customize->add_setting('royal_luxury_hotel_contact_btn_url',array(
		'default' => '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('royal_luxury_hotel_contact_btn_url',array(
		'label'	=> __('Button URL','royal-luxury-hotel'),
		'section' => 'royal_luxury_hotel_header_section',
		'type' => 'url'
	));

	//home page slider
	$wp_customize->add_section( 'royal_luxury_hotel_slider_section' , array(
    	'title'    => __( 'Slider Settings', 'royal-luxury-hotel' ),
		'priority' => null,
		'panel' => 'royal_luxury_hotel_panel_id'
	) );

	$wp_customize->add_setting('royal_luxury_hotel_slider_hide_show',array(
    	'default' => false,
    	'sanitize_callback'	=> 'royal_luxury_hotel_sanitize_checkbox'
	));
	$wp_customize->add_control('royal_luxury_hotel_slider_hide_show',array(
	   	'type' => 'checkbox',
	   	'label' => __('Show / Hide Slider','royal-luxury-hotel'),
	   	'section' => 'royal_luxury_hotel_slider_section',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'royal_luxury_hotel_slider' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'royal_luxury_hotel_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'royal_luxury_hotel_slider' . $count, array(
			'label' => __('Select Slider Image Page', 'royal-luxury-hotel' ),
			'description' => __('Image Size ( 600 x 650 )', 'royal-luxury-hotel' ),
			'section' => 'royal_luxury_hotel_slider_section',
			'type' => 'dropdown-pages'
		));
	}

	$wp_customize->add_setting( 'royal_luxury_hotel_slider_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	   ));
	 $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'royal_luxury_hotel_slider_color', array(
		   'label' => 'Text Color',
		'section' => 'royal_luxury_hotel_slider_section',
	   )));


	//feature Section
	$wp_customize->add_section('royal_luxury_hotel_feature_section',array(
		'title'	=> __('Feature Section','royal-luxury-hotel'),
		'description'=> __('<b>Note :</b> This section will appear below the Slider.','royal-luxury-hotel'),
		'panel' => 'royal_luxury_hotel_panel_id',
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_pst[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_pst[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('royal_luxury_hotel_featurecategory_setting',array(
		'default' => 'select',
		'sanitize_callback' => 'royal_luxury_hotel_sanitize_choices',
	));
	$wp_customize->add_control('royal_luxury_hotel_featurecategory_setting',array(
		'type' => 'select',
		'choices' => $cat_pst,
		'label' => __('Select Category To Display Post','royal-luxury-hotel'),
		'section' => 'royal_luxury_hotel_feature_section',
	));

	$wp_customize->add_setting( 'royal_luxury_hotel_feature_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	   ));
	 $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'royal_luxury_hotel_feature_color', array(
		   'label' => 'Text Color',
		'section' => 'royal_luxury_hotel_feature_section',
	   )));


	//Service Section
	$wp_customize->add_section('royal_luxury_hotel_service_section',array(
		'title'	=> __('Service Section','royal-luxury-hotel'),
		'description'=> __('<b>Note :</b> This section will appear below the Feature.','royal-luxury-hotel'),
		'panel' => 'royal_luxury_hotel_panel_id',
	));

 
    $wp_customize->add_setting('royal_luxury_hotel_section_title',array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('royal_luxury_hotel_section_title',array(
		'label'	=> __('Section Title','royal-luxury-hotel'),
		'section' => 'royal_luxury_hotel_service_section',
		'type' => 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_pst[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_pst[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('royal_luxury_hotel_category_setting',array(
		'default' => 'select',
		'sanitize_callback' => 'royal_luxury_hotel_sanitize_choices',
	));
	$wp_customize->add_control('royal_luxury_hotel_category_setting',array(
		'type' => 'select',
		'choices' => $cat_pst,
		'label' => __('Select Category To Display Post','royal-luxury-hotel'),
		'section' => 'royal_luxury_hotel_service_section',
	));

	$wp_customize->add_setting( 'royal_luxury_hotel_service_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	   ));
	 $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'royal_luxury_hotel_service_color', array(
		   'label' => 'Text Color',
		'section' => 'royal_luxury_hotel_service_section',
	   )));

	//Footer
    $wp_customize->add_section( 'royal_luxury_hotel_footer', array(
    	'title'  => __( 'Footer Setting', 'royal-luxury-hotel' ),
		'priority' => null,
		'panel' => 'royal_luxury_hotel_panel_id'
	) );

	$wp_customize->add_setting('royal_luxury_hotel_show_back_totop',array(
       'default' => true,
       'sanitize_callback'	=> 'royal_luxury_hotel_sanitize_checkbox'
    ));
    $wp_customize->add_control('royal_luxury_hotel_show_back_totop',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Back to Top','royal-luxury-hotel'),
       'section' => 'royal_luxury_hotel_footer'
    ));

    $wp_customize->add_setting('royal_luxury_hotel_footer_copy',array(
		'default' => 'Royal Luxury Hotel WordPress Theme By Luzuk',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('royal_luxury_hotel_footer_copy',array(
		'label'	=> __('Copyright Text','royal-luxury-hotel'),
		'section' => 'royal_luxury_hotel_footer',
		'setting' => 'royal_luxury_hotel_footer_copy',
		'type' => 'text'
	));

	$wp_customize->add_setting('royal_luxury_hotel_footer_copylink',array(
		'default' => 'https://www.luzuk.com/themes/royal-luxury-hotel-wordpress-theme',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('royal_luxury_hotel_footer_copylink',array(
		'label'	=> __('Copyright Link','royal-luxury-hotel'),
		'section' => 'royal_luxury_hotel_footer',
		'setting' => 'royal_luxury_hotel_footer_copylink',
		'type' => 'text'
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'royal_luxury_hotel_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'royal_luxury_hotel_customize_partial_blogdescription',
	) );
}
add_action( 'customize_register', 'royal_luxury_hotel_customize_register' );

function royal_luxury_hotel_customize_partial_blogname() {
	bloginfo( 'name' );
}

function royal_luxury_hotel_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if (class_exists('WP_Customize_Control')) {

   	class royal_luxury_hotel_Fontawesome_Icon_Chooser extends WP_Customize_Control {

      	public $type = 'icon';

      	public function render_content() { ?>
	     	<label>
	            <span class="customize-control-title">
	               <?php echo esc_html($this->label); ?>
	            </span>

	            <?php if ($this->description) { ?>
	                <span class="description customize-control-description">
	                   <?php echo wp_kses_post($this->description); ?>
	                </span>
	            <?php } ?>

	            <div class="royal-luxury-hotel-selected-icon">
	                <i class="fa <?php echo esc_attr($this->value()); ?>"></i>
	                <span><i class="fa fa-angle-down"></i></span>
	            </div>

	            <ul class="royal-luxury-hotel-icon-list clearfix">
	                <?php
	                $royal_luxury_hotel_font_awesome_icon_array = royal_luxury_hotel_font_awesome_icon_array();
	                foreach ($royal_luxury_hotel_font_awesome_icon_array as $royal_luxury_hotel_font_awesome_icon) {
	                   $icon_class = $this->value() == $royal_luxury_hotel_font_awesome_icon ? 'icon-active' : '';
	                   echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($royal_luxury_hotel_font_awesome_icon) . '"></i></li>';
	                }
	                ?>
	            </ul>
	            <input type="hidden" value="<?php $this->value(); ?>" <?php $this->link(); ?> />
	        </label>
	        <?php
      	}
  	}
}
function royal_luxury_hotel_customizer_script() {
   wp_enqueue_style( 'font-awesome-1', get_template_directory_uri().'/assets/css/fontawesome-all.css');
}
add_action( 'customize_controls_enqueue_scripts', 'royal_luxury_hotel_customizer_script' );