<?php /*
Plugin Name: cat menu
Plugin URI: 
Description: menu for category
Version: 1.0.0
Author: Fredrik Ljungqvist
*/

function pop_jquery_test() {
    wp_enqueue_script( 'jquery' );
    $src = plugins_url('cat.js', __FILE__);
    wp_register_script( 'jquerytest', $src );
    wp_enqueue_script( 'jquerytest' );
}     
add_action('init','pop_jquery_test'); 



