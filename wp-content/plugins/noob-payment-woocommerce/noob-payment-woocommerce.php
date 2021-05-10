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
                  $this->init_form_fields();
                  $this->init_settings();
                 
                  //$this->icon = apply_filters( "woocommerce_noob_icon", plugins_url("/assets/icon.png", __FILE__));
                  
                  $this->has_fields = true;


                  $this->method_title = __("Payment Invoice", "noob-pay-woo");
                  $this->method_description = __("local payment system.", "noob-pay-woo");
               
                  $this->title = $this->get_option("title");
                  $this->description = $this->get_option("description");
                  $this->instruction = $this->get_option("instruction");
                  $this->payment_fields  = array(
                    'order_comments' => array(
                        'type' => 'textarea',
                        'class' => array('notes'),
                        'label' => __('Order Notes', 'woocommerce'),
                        'placeholder' => _x('Notes about your order, e.g. special notes for delivery.', 'placeholder', 'woocommerce')
                    ),);

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

		if ( $order->get_total() > 0 ) {
            // Mark as processing or on-hold (payment won't be taken until delivery).
			$order->update_status( apply_filters( 'woocommerce_cod_process_payment_order_status', $order->has_downloadable_item() ? 'on-hold' : 'processing', $order ), __( 'Payment to be made upon delivery.', 'woocommerce' ) );
		} else {
			$order->payment_complete();
		}

		// Remove cart.
		WC()->cart->empty_cart();

		// Return thankyou redirect.
		return array(
            'result'   => 'success',
			'redirect' => $this->get_return_url( $order ),
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
add_action( 'woocommerce_after_checkout_billing_form', 'noob_select_field' );

// save fields to order meta
add_action( 'woocommerce_checkout_update_order_meta', 'save_number' );
 
// select
function noob_select_field( $checkout ){
 
	
 
	woocommerce_form_field( 'personnummer', array(
		'type'          => 'text', 
		'required'	=> true, 
		
		'label'         => 'personnummer',
		
		
		), $checkout->get_value( 'personnummer' ) );
 
	
 
}
 

 
// save field values
function save_number( $order_id ){
    unset($_POST['personnummer']);
	if( !empty( $_POST['personnummer'] ) )
		update_post_meta( $order_id, 'personnummer', sanitize_text_field( $_POST['contactmethod'] ) );
 
 
	
 
}
add_action('woocommerce_checkout_process', 'check_number');

 function is_valid_luhn($number) {
    settype($number, 'string');
    $sumTable = array(
      array(0,1,2,3,4,5,6,7,8,9),
      array(0,2,4,6,8,1,3,5,7,9));
    $sum = 0;
    $flip = 0;
    for ($i = strlen($number) - 1; $i >= 0; $i--) {
      $sum += $sumTable[$flip++ & 0x1][$number[$i]];
    }
    return $sum % 10 === 0;
  } 
  
 
  
 
 
  function check_number() {
 
	// you can add any custom validations here
    
	if ((strlen($_POST['personnummer'])!=10) or is_numeric($_POST['personnummer'])==false){
		wc_add_notice( 'Ange ett personnummer med 10 siffror .', 'error' );
    }elseif (is_valid_luhn($_POST['personnummer'])==false) {
        wc_add_notice( 'Ange ett korrekt personnummer .', 'error' );
    }
}