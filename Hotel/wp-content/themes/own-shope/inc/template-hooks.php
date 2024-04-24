<?php
/**
 * Custom template hooks for this theme.
 *
 *
 * @package own-shope
 */


/**
 * wishlist hook
 */
if ( ! function_exists( 'own_shope_action_header_wishlist' ) ) :
function own_shope_action_header_wishlist() {
	do_action('own_shope_action_header_wishlist');
}
endif;


/**
 * wishlist mobile hook
 */
if ( ! function_exists( 'own_shope_action_header_mobile_wishlist' ) ) :
function own_shope_action_header_mobile_wishlist() {
    do_action('own_shope_action_header_mobile_wishlist');
}
endif;

