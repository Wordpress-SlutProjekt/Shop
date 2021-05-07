<?php
/**
 * Plugin Name: Noob Payment for Woocommerce
 * Plugin URI: http://localhost:8888
 * Description: This plugin allows for local content payment systems.
 * Version: 1.0
 * Author: Shahin
 * Author URI: http://localhost:8888
 * text-domain: noob-pay-woo
 */



if (! in_array("woocommerce/woocommerce.php", apply_filters( "active_plugins", get_option( "active_plugins")))) return;
    
add_action( "plugins_loaded", "noob_payment_init", 11);

function noob_payment_init(){
     if(class_exists("WC_Payment_Gateway")){
         class WC_Noob_pay_Gateway extends WC_Payment_Gateway{
              public function __construct(){
                  $this->id = "noob_payment";

                  $this->icon = apply_filters( "woocommerce_noob_icon", plugins_url("/assets/icon.png", __FILE__));
                  
                  $this->has_fields = false;
                  $this->method_title = __("Payment Invoice", "noob-pay-woo");
                  $this->method_description = __("local payment system.", "noob-pay-woo");

                  $this->title = $this->get_option("title");
                  $this->description = $this->get_option("description");
                  $this->instruction = $this->get_option("instruction");
                  
                  $this->init_form_fields();
                  $this->init_settings();

                  add_action( "woocommerce_update_options_payment_gateways_" . $this->id, array($this, "process_admin_option"));

              }
               
              public function init_form_fields() {
                $this->form_fields = apply_filters("woo_noob_pay_fields", array(
                    'enabled' => array(
                        "title" => __("Enable/Disable", "noob-pay-woo"),
                        "type" => "checkbox",
                    ),
                     'title' => array(
                        "title" => __("Noob Payments Gateway", "noob-pay-woo"),
                        "type" => "text",
                        "default" => __("Pay with invoice", "noob-pay-woo"),
                        "desc_tip " => true,
                        "description" => __("add a new title", "noob-pay-woo"),
                        
                    ),
                    'instructions' => array(
                        "title" => __("Intructions", "noob-pay-woo"),
                        "type" => "textarea",
                        "default" => __("", "noob-pay-woo"),
                        "desc_tip " => true,
                        "description" => __("Kommer att visas på thank you page", "noob-pay-woo"),
                        
                    ),
                    'description' => array(
                        "title" => __("Description", "noob-pay-woo"),
                        "type" => "textarea",
                        "default" => __("Please remit your payment to the shop to allow for the delivery", "noob-pay-woo"),
                        "desc_tip " => true,
                        "description" => __("", "noob-pay-woo"),
                        
                    ),
                ));

            }

            public function process_payment( $order_id ){
                $order = wc_get_order( $order_id );

                $order->update_status( "on-hold" ,__("Awaiting Noob Payment" ,"noob-pay-woo"));

                $this->clear_payment_with_api();

                

                WC()->cart->empty_cart();

                return array(
                    "result" => "successs",
                    "redirect" => $this->get_return_url($order)

                ); 

            }

            public function clear_payment_with_api(){
                
            }
         }
     }
}

add_filter( "woocommerce_payment_gateways", "add_to_woo_noob_payment_gateway");

function add_to_woo_noob_payment_gateway( $gateways ){
    $gateways[] = "WC_Noob_pay_Gateway";
    
    return $gateways;

}
