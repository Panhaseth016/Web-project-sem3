<?php
/**
 * @package own-shope
 */



/**
 * Check if woocommerce is activated.
 */
if ( ! function_exists( 'own_shope_is_active_woocommerce' ) ) {
    function own_shope_is_active_woocommerce() {
        if ( class_exists( 'WooCommerce' ) ) :
            return true;
        else :
            return false;
        endif;
    }
}


/**
 * Topbar
 */
if ( ! function_exists( 'own_shope_topbar_sidebar' ) ) :
    function own_shope_topbar_sidebar() {
        if ( is_active_sidebar('topsidebar')) :
            get_sidebar('topsidebar');
        endif;
    }
endif;
add_action('own_shope_action_topbar_sidebar', 'own_shope_topbar_sidebar');


/**
* Header Category Custom Menu
*/
if ( ! function_exists( 'own_shope_header_product_custom_menu' ) ) :
function own_shope_header_product_custom_menu() {
    ?>
        <div class="header-product-custom-menu">
            <div class="custom-menu-wrapper">
                <a href="#" class="title navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2"><i class="la la-bars"></i> <?php 
                    echo esc_html(get_theme_mod( 'own_shope_header_category_heading_text', esc_html__('Browse Categories','own-shope')));
                    ?>
                </a>
            </div>
            <div class="custom-menu-product">
                <div class="collapse navbar-collapse" id="navbar-collapse-2">
                    <?php
                        wp_nav_menu( array(                             
                            'theme_location'    => 'categorymenu',
                            'depth'             => 3,
                            'container'         => 'ul',
                            'container_class'   => 'product-custom-menu-container',
                            'container_id'      => 'menu-categorymenu',
                            'menu_class'        => 'category-custom',
                            )
                        );
                    ?>
                </div>
            </div>
        </div>
    <?php
}
endif;
add_action('own_shope_action_header_product_custom_menu', 'own_shope_header_product_custom_menu');


/**
 * Remove class from woo pages
 */

function own_shope_remove_blocks_cart ($wp_classes) {
    if ( own_shop_is_active_woocommerce() ) :
        if ( is_page( 'cart' ) || is_cart() || is_page( 'checkout' ) || is_checkout() || is_page( 'my-account' ) || is_account_page() ) :
            unset( $wp_classes[ array_search( "has-blocks", $wp_classes ) ] );
        endif;
    endif;
    return $wp_classes;
}
add_filter( 'body_class', 'own_shope_remove_blocks_cart' );


/**
 * Add topbar class to body
 */

 function own_shope_body_topbar_class_add( $classes ) {
	if(true===get_theme_mod( 'own_shop_enable_header_topbar',true)) {
		$classes[] = 'has-topbar';
	}
    else {
        $classes[] = 'no-topbar';
    }
	return $classes;
}
add_filter( 'body_class', 'own_shope_body_topbar_class_add' );


/**
 * Search products
 */

function own_shope_search_products() {
    $query = isset( $_POST['query'] ) ? sanitize_text_field( $_POST['query'] ) : '';
    $category = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        's' => $query,
        'meta_query' => WC()->query->get_meta_query(),
        'tax_query' => WC()->query->get_tax_query(),
    );

    if ( $category ) {
        $args['tax_query'][] = array(
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => $category,
        );
    }

    $products = get_posts( $args );
    $results = array();

    foreach ( $products as $product ) {
        $product = wc_get_product( $product->ID );

        $result = array(
        'id' => $product->get_id(),
        'name' => $product->get_name(),
        'permalink' => get_permalink( $product->get_id() ),
        'image' => wp_get_attachment_url( $product->get_image_id() ),
        'price' => wc_price( $product->get_price() ),
        'regular_price' => wc_price( $product->get_regular_price() ),
        'sale_price' => wc_price( $product->get_sale_price() ),
        );

        $results[] = $result;
    }
    echo json_encode( $results );
    die();
}
add_action('wp_ajax_search_products', 'own_shope_search_products');
add_action('wp_ajax_nopriv_search_products', 'own_shope_search_products');
  

/**
 * products form
 */

if (!function_exists('own_shop_product_search_form')) :
    function own_shop_product_search_form() {
        ?>
            <div class="search-form-wrapper">
                <form method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="form-group search">
                        <?php
                            $search_placeholder = esc_html(get_theme_mod('own_shop_header_product_search_placeholder', esc_html__('Search for products','own-shope'))) ;
                            $cat_placeholder = esc_html(get_theme_mod('own_shop_header_product_category_placeholder',esc_html__('All Categories','own-shope'))) ;
                            $button_text = esc_html(get_theme_mod('own_shop_header_product_search_button_text',esc_html__('Search','own-shope'))) ;
                        ?>
                        <label class="screen-reader-text" for="woocommerce-product-search-field"><?php esc_html_e('Search for:', 'own-shope'); ?></label>
                        <input type="search" id="woocommerce-product-search-field" class="search-field"   placeholder="<?php echo esc_attr($search_placeholder); ?>" value="<?php echo get_search_query(); ?>" name="s"/>
                        <div class="search-results-popup">
                            <ul class="search-results-list"></ul>
                        </div>
                        <?php
                            $product_cats = get_terms(array(
                                'taxonomy' => 'product_cat',
                            ));
                            if (!empty($product_cats) && !is_wp_error($product_cats)) :
                                $selected_product_cat = get_query_var('product_cat');
                                ?>
                                    <select name="product_cat" class="category-dropdown">
                                        <option value=""><?php echo esc_html($cat_placeholder); ?></option>
                                        <?php
                                            foreach ($product_cats as $product_cat) {
                                                ?>
                                                    <option value="<?php echo esc_attr($product_cat->slug) ?>" <?php esc_html(selected($product_cat->slug, $selected_product_cat)) ?>> <?php echo esc_html($product_cat->name); ?>
                                                    </option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                <?php
                            endif;
                        ?>
                        <button type="submit" value=""><i class="la la-search" aria-hidden="true"></i> <?php echo esc_html($button_text); ?></button>
                        <input type="hidden" name="post_type" value="product"/>
                        <label class="woocommerce-product-search__field" for="woocommerce-product-search-field"></label>
                    </div>
                </form>
            </div>
        <?php
    }
endif;