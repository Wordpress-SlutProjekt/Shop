<?php
/*
Plugin Name: Cykel Shipping plugin

Description: Få dina skor med cyckel
Version: 1.0.0
Author: Fredrik Ljungqvist
7
*

/**
 * Check if WooCommerce is active
 */

  
 


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  
  function your_shipping_method_init() {
    if ( ! class_exists( 'WC_Your_Shipping_Method' ) ) {
      class WC_Your_Shipping_Method extends WC_Shipping_Method {
        /**
         * Constructor for your shipping class
				 *
         * @access public
         * @return void
				 */
        public function __construct() {
          $this->id                 = 'your_shipping_method'; 
					$this->method_title       = __( 'Cykelbud' );  
					$this->method_description = __( 'Transport med cykel' ); 
          
					$this->enabled            = "yes"; 
					$this->title              = "Cykelbud"; 
          
					$this->init();
				}
        
				/**
         * Init your settings
				 *
         * @access public
         * @return void
				 */
        function init() {
          
          $this->init_form_fields(); 
          $this->init_settings();
					
					add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
				}
        
        function init_form_fields(){
          $this->form_fields = array(
                        'enabled' => array(
                          'title' => __('Enable'),
                          'type' => 'checkbox',
                          'default' => 'yes'
                        ),
                        'a-class' => array(
                          'title' => __('Klass A, Pris (kr)'),
                        'type' => 'number',
                        'default' => 50
                      ),
                      'b-class' => array(
                        'title' => __('Klass B, Pris (kr)'),
                        'type' => 'number',
                        'default' => 40
                      ),
                      'c-class' => array(
                        'title' => __('Klass C, Pris (kr)'),
                        'type' => 'number',
                        'default' => 30
                      ),
                      'distance' => array(
                        'title' => __('Kostand per kilometer,  (kr/km)'),
                        'type' => 'float',
                        'default' => 0
                      ),
                      
                        );
                      }
                      
                      
                      
                      /**
				 * 
				 *
         * @access public
         * @param mixed $package
				 * @return void
				 */
        public function calculate_shipping($package = array())
        {
                    
          
          $price_array=0;
          $weight_array=0;
          
          $price_a = (int)$this->settings['a-class'];
          $price_b = (int)$this->settings['b-class'];
          $price_c = (int)$this->settings['c-class'];
          global $woocommerce;
          $postal_code = $package[ 'destination' ][ 'postcode' ];
          
        
          

$distance_cost=(float)$this->settings['distance'];

$distance_price=$distance_cost +distance($postal_code);


$items = $woocommerce->cart->get_cart();


foreach($items as $item => $values) { 
  $_product =  wc_get_product( $values['data']->get_id()); 
   
  $price = get_post_meta($values['product_id'] , '_price', true);
        
        $id=$_product->get_shipping_class_id();
        
        $ship_classname= get_term_by('id',$id ,'product_shipping_class');
        $weight=$_product->get_weight();
        
        $name=$ship_classname->name;
       
        $weight_array+=$weight*$values['quantity'];
        if ($name='aklass') {
            $price_array+=$price_a*$values['quantity'];
        }elseif ($name='bklass') {
            $price_array+=$price_b*$values['quantity'];
        }else{
            $price_array+=$price_c*$values['quantity'];
        }
    } 
    $shipping_cost=$price_array+$weight_array+$distance_price;
    




                
					$rate = array(
						'label' => $this->title,
						'cost' => $shipping_cost,
						'calc_tax' => 'per_item'
					);

					
					$this->add_rate( $rate );
				}
			}
		}
	}

	add_action( 'woocommerce_shipping_init', 'your_shipping_method_init' );

	function add_your_shipping_method( $methods ) {
		$methods['your_shipping_method'] = 'WC_Your_Shipping_Method';
		return $methods;
	}

	add_filter( 'woocommerce_shipping_methods', 'add_your_shipping_method' );
}
function distance($customer){
  require(__DIR__ . '/src/client.php');
   try {
 
     $postnummersok = new Client();
 
     $postnummersok->setCustomerId(363)
                ->setApiKey('f20018674cdab3'); 
 
     $request = [
       'from' => [
         'postcode' => '42676',
         'country_code' => 'SE',
       ],
       'to' => [
         'postcode' => $customer,
         'country_code' => 'SE',
       ],
       'unit' => 'km',
     ];
 
     $result = $postnummersok->Distance($request);
     var_dump($result);
     return $result["road"];
 
   } catch(Exception $e) {
     die('An error occured: '. $e->getMessage() . PHP_EOL . PHP_EOL
       . $postnummersok->getLastLog());
   }
 
   
} 
