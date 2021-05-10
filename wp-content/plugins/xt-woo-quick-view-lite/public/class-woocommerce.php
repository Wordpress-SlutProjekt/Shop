<?php

class XT_Woo_Quick_View_Woocommerce{

    function __construct() {

        add_filter('woocommerce_short_description', array($this, 'woocommerce_short_description'), 10, 1);
    }

    // define the woocommerce_short_description callback
    function woocommerce_short_description( $post_post_excerpt ) {

        global $post;

        $auto_generate_description = xt_wooqv_option_bool('auto_generate_description', false);

        if($auto_generate_description && is_single() && ($post->post_type === 'product') && empty($post_post_excerpt)) {

            $post_post_excerpt = wp_trim_words( strip_tags($post->post_content), 55, null );
        }

        return $post_post_excerpt;
    }
}

new XT_Woo_Quick_View_Woocommerce;