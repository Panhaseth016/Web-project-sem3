<?php 

	$royal_luxury_hotel_custom_style = '';

	// Logo Size
	$royal_luxury_hotel_logo_top_padding = get_theme_mod('royal_luxury_hotel_logo_top_padding');
	$royal_luxury_hotel_logo_bottom_padding = get_theme_mod('royal_luxury_hotel_logo_bottom_padding');
	$royal_luxury_hotel_logo_left_padding = get_theme_mod('royal_luxury_hotel_logo_left_padding');
	$royal_luxury_hotel_logo_right_padding = get_theme_mod('royal_luxury_hotel_logo_right_padding');

	if( $royal_luxury_hotel_logo_top_padding != '' || $royal_luxury_hotel_logo_bottom_padding != '' || $royal_luxury_hotel_logo_left_padding != '' || $royal_luxury_hotel_logo_right_padding != ''){
		$royal_luxury_hotel_custom_style .=' .logo {';
			$royal_luxury_hotel_custom_style .=' padding-top: '.esc_attr($royal_luxury_hotel_logo_top_padding).'px; padding-bottom: '.esc_attr($royal_luxury_hotel_logo_bottom_padding).'px; padding-left: '.esc_attr($royal_luxury_hotel_logo_left_padding).'px; padding-right: '.esc_attr($royal_luxury_hotel_logo_right_padding).'px;';
		$royal_luxury_hotel_custom_style .=' }';
	}

//Slider color
$royal_luxury_hotel_slider_color = get_theme_mod('royal_luxury_hotel_slider_color');

if ( $royal_luxury_hotel_slider_color != '') {
	$royal_luxury_hotel_custom_style .=' #slider h2,#slider p {';
		$royal_luxury_hotel_custom_style .=' color:'.esc_attr($royal_luxury_hotel_slider_color).';';
	$royal_luxury_hotel_custom_style .=' }';
}

//Feature color
$royal_luxury_hotel_feature_color = get_theme_mod('royal_luxury_hotel_feature_color');

if ( $royal_luxury_hotel_feature_color != '') {
	$royal_luxury_hotel_custom_style .=' #feature-section .features-area-data h4 a,#feature-section .hi-icon i {';
		$royal_luxury_hotel_custom_style .=' color:'.esc_attr($royal_luxury_hotel_feature_color).';';
	$royal_luxury_hotel_custom_style .=' }';
}

//Service color
$royal_luxury_hotel_service_color = get_theme_mod('royal_luxury_hotel_service_color');

if ( $royal_luxury_hotel_service_color != '') {
	$royal_luxury_hotel_custom_style .=' .service-box .service-content h4 {';
		$royal_luxury_hotel_custom_style .=' color:'.esc_attr($royal_luxury_hotel_service_color).';';
	$royal_luxury_hotel_custom_style .=' }';
}