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

                  $this->icon = apply_filters( "woocommerce_noob_icon", plugins_url() . "/assets/icon.png" );
                  
                  $this->has_fields = false;
                  $this->method_title = __("Payment cash", "noob-pay-woo");
                  $this->method_description = __("local payment system.", "noob-pay-woo");
                  
                  $this->init_form_fields();
                  $this->init_settings();

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
                        "default" => __("Pay with cash on delivery", "noob-pay-woo"),
                        "desc_tip " => true,
                        "description" => __("add a new title", "noob-pay-woo"),
                        
                    ),
                ));

            }
         }
     }
}

add_filter( "woocommerce_payment_gateways", "add_to_woo_noob_payment_gateway");

function add_to_woo_noob_payment_gateway( $gateways ){
    $gateways[] = "WC_Noob_pay_Gateway";
    
    return $gateways;

}
