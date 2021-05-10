<?php
/**
 * The Ajax functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    XT_Woo_Quick_View
 * @subpackage XT_Woo_Quick_View_Ajax/public
 * @author     XplodedThemes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

class XT_Woo_Quick_View_Ajax {

    /**
     * Core class reference.
     *
     * @since    1.0.0
     * @access   private
     * @var      XT_Woo_Quick_View    $core    Core Class
     */
    public function __construct(&$core)
    {
        $this->core = $core;

        // Add WC Ajax Events
        add_filter($this->core->plugin_prefix('wc_ajax_add_events'), array( $this, 'ajax_add_events'), 1, 1);

    }

    /**
     * Add ajax events
     */
    public function ajax_add_events($ajax_events)
    {

        $ajax_events[] = array(
            'function' => 'xt_wooqv_quick_view',
            'callback' => array($this, 'quick_view'),
            'nopriv' => true
        );

        return $ajax_events;
    }

    /**
     * Render Quick View Content
     */
    public function quick_view() {

        $product_id = intval($_REQUEST['id']);
        $variation_id = !empty($_REQUEST['variation_id']) ? intval($_REQUEST['variation_id']) : null;
        $slider_only = !empty($_REQUEST['slider_only']) ? (bool)$_REQUEST['slider_only'] : false;

        $quickview = xt_woo_quick_view()->frontend()->get_product_quick_view($product_id, $variation_id, $slider_only);

        wp_send_json(array('quickview' => $quickview));
    }
  
}