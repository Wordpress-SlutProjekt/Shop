<?php


add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support('widgets');
add_theme_support('woocommerce');

/* header menus */

function register_menus() {
    register_nav_menu('header-menu', 'header-meny');
    register_nav_menu( 'category-menu' , 'Kategorimeny' );
    
    }

    add_action('after_setup_theme', 'register_menus');
    
//Footer menus

function register_shop_menu(){
    register_nav_menu( 'info-payment', 'Footer column 1 info and payment');
    register_nav_menu( 'quicklinksmenu', 'Footer column 2 quicklinks ');
    register_nav_menu( 'accountlinksmenu', 'Footer column 3 accountlinks ');
    register_nav_menu( 'newsletter-sm-menu', 'Footer column 4 newsletter social media');
}

add_action('after_setup_theme', 'register_shop_menu');


//Footer widgets
register_sidebar(

    [

       'name' => 'search',

       'Description' => 'top_bar_search',

       'id' => 'search_bar', 

       'before_widget' => ' ',

    ]

);

register_sidebar(
    [
        'name' => 'Footer column 1',
        'Desription' => 'Footer column 1 info and payment',
        'id' => 'footercolumnone',
        'class' => 'no-border',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
        'before_widget' => false,
    ]
    );

register_sidebar(
    [
        'name' => 'Footer column 2',
        'Desription' => 'Footer column 2 quicklinks',
        'id' => 'footercolumntwo',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
        'before_widget' => false,
    ]
    );

register_sidebar(
    [
        'name' => 'Footer column 3',
        'Desription' => 'Footer column 3 accountlinks',
        'id' => 'footercolumnthree',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
        'before_widget' => false,
    ]
    );

register_sidebar(
    [
        'name' => 'Footer column 4',
        'Desription' => 'Footer column 4 newsletter social media',
        'id' => 'footercolumnfour',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
        'before_widget' => false,
    ]
    );

register_sidebar(
    [
        'name' => 'Footer bottom',
        'Desription' => 'Footer bottom with copyright text',
        'id' => 'footercolumnbottom',
        'before_title' => '<p>',
        'after_title' => '</p>',
        'before_widget' => false,
    ]
    );
    

    
    function css_files() {
        // registering the CSS  files 
        wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.1', 'all');
        wp_enqueue_style('bootstrap');
    
        wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.1', 'all');
        wp_enqueue_style('font-awesome');
    
    
        wp_register_style('style', get_template_directory_uri() . '/css/style.css', array(), '1.1', 'all');
        wp_enqueue_style('style');

        wp_register_style('elegant-icons', get_template_directory_uri() . '/css/elegant-icons.css', array(), '1.1', 'all');
        wp_enqueue_style('elegant-icons');

        wp_register_style('slicknavmin', get_template_directory_uri() . '/css/slicknav.min.css', array(), '1.1', 'all');
        wp_enqueue_style('slicknavmin');

        wp_register_style('jquery-style', get_template_directory_uri() . '/css/jquery-ui.min.css', array(), '1.1', 'all');
        wp_enqueue_style('jquery-style');

        wp_register_style('magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css', array(), '1.1', 'all');
        wp_enqueue_style('magnific-popup');
        
        wp_register_style('owl.carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '1.1', 'all');
        wp_enqueue_style('owl.carousel.min');


        
    
    }


    add_action( 'wp_enqueue_scripts', 'css_files');

    function js_files(){
        wp_enqueue_script('bootsstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js ', array(), 1, 'all');
        // wp_enqueue_script('jquery.min', get_template_directory_uri() . '/js/jquery-3.3.1.min.js ', array(), 1, 'all');
        wp_enqueue_script('jquery-ui.min', get_template_directory_uri() . '/js/jquery-ui.min.js ', array(), 1, 'all');
        wp_enqueue_script('jquery.count.min', get_template_directory_uri() . '/js/jquery.countdown.min.js ', array(), 1, 'all');
        wp_enqueue_script('magnific.min', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js ', array(), 1, 'all');
        wp_enqueue_script('nicescroll.min', get_template_directory_uri() . '/js/jquery.nicescroll.min.js ', array(), 1, 'all');
        wp_enqueue_script('slicknav.min', get_template_directory_uri() . '/js/jquery.slicknav.js ', array(), 1, 'all');
        wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js ', array(), 1, 'all');
        wp_enqueue_script('mix', get_template_directory_uri() . '/js/mixitup.min.js ', array(), 1, 'all');
        wp_enqueue_script('owl', get_template_directory_uri() . '/js/owl.carousel.min.js');

        wp_enqueue_script( 'popper-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' ); 

        wp_enqueue_script( 'jquery' ); 

    }
    add_action('wp_enqueue_scripts', 'js_files');









    // function my_acf_google_map_api( $api ){
    //     $api['AIzaSyBh3p65wVsOQhCGlnsO8uXpghP9aSy0KV4'] = 'xxx';
    //     return $api;
    // }
    // add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


    function fix_gmaps_api_key() {
        if(mb_strlen(acf_get_setting("google_api_key")) <= 0){
            acf_update_setting("google_api_key", "AIzaSyBh3p65wVsOQhCGlnsO8uXpghP9aSy0KV4");
        }
    }
    add_action( 'admin_enqueue_scripts', 'fix_gmaps_api_key' );


/* header menus */


    
    function wpdocs_filter_wp_title( $title, $sep ) {
        global $paged, $page;
     
        if ( is_feed() )
            return $title;
     
        // Add the site name.
        $title .= get_bloginfo( 'name' );
     
        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";
     
        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );
     
        return $title;
    }
    add_filter( 'wp_title', 'wpdocs_filter_wp_title', 10, 2 );


       
    function fd_theme_support() {
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
    add_action( 'after_setup_theme', 'fd_theme_support', 10 );




/**
 * @snippet       Remove Sidebar @ Single Product Page
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=19572
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.2.6
 */
 
add_action( 'wp', 'bbloomer_remove_sidebar_product_pages' );
 
function bbloomer_remove_sidebar_product_pages() {
if ( is_product() ) {
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}
}


if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'custom-thumb', 100, 100, true ); // 100 wide and 100 high
}


// Removes Order Notes Title

add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

// Remove Order Notes Field

add_filter( 'woocommerce_checkout_fields' , 'njengah_order_notes' );

function njengah_order_notes( $fields ) {

unset($fields['order']['order_comments']);

return $fields;

}

add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false');
add_filter( 'woocommerce_checkout_fields' , 'custom_mod_checkout_fields' ); 
function custom_mod_checkout_fields( $fields ) { unset($fields['billing']['billing_company']); return $fields; }


add_filter('woocommerce_checkout_fields', 'addBootstrapToCheckoutFields' );
function addBootstrapToCheckoutFields($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            // if you want to add the form-group class around the label and the input
            $field['class'][] = 'form-group'; 

            // add form-control to the actual input
            $field['input_class'][] = 'checkout__form';
        }
    }
    return $fields;
}




add_filter('woocommerce_form_field_args','wc_form_field_args',10,3);

function wc_form_field_args( $args, $key, $value = null ) {



// Start field type switch case

switch ( $args['type'] ) {

    case "select" :  /* Targets all select input type elements, except the country and state select input types */
        $args['class'][] = 'form-group'; // Add a class to the field's html element wrapper - woocommerce input types (fields) are often wrapped within a <p></p> tag  
        $args['input_class'] = array('form-select', 'input-lg'); // Add a class to the form input itself
        //$args['custom_attributes']['data-plugin'] = 'select2';
        $args['label_class'] = array('control-label');
        $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  ); // Add custom data attributes to the form input itself
    break;

    case 'country' : /* By default WooCommerce will populate a select with the country names - $args defined for this specific input type targets only the country select element */
        $args['class'][] = 'form-group single-country';
        $args['label_class'] = array('control-label');
    break;

    case "state" : /* By default WooCommerce will populate a select with state names - $args defined for this specific input type targets only the country select element */
        $args['class'][] = 'form-group'; // Add class to the field's html element wrapper 
        $args['input_class'] = array('form-control', 'input-lg'); // add class to the form input itself
        //$args['custom_attributes']['data-plugin'] = 'select2';
        $args['label_class'] = array('control-label');
        $args['custom_attributes'] = array( 'data-plugin' => 'select2', 'data-allow-clear' => 'true', 'aria-hidden' => 'true',  );
    break;


    case "password" :
    case "text" :
    case "email" :
    case "tel" :
    case "number" :
        $args['class'][] = 'form-group';
        //$args['input_class'][] = 'form-control input-lg'; // will return an array of classes, the same as bellow
        $args['input_class'] = array('form-control', 'input-lg');
        $args['label_class'] = array('control-label');
    break;

    case 'textarea' :
        $args['input_class'] = array('form-control', 'input-lg');
        $args['label_class'] = array('control-label');
    break;

    case 'checkbox' :  
    break;

    case 'radio' :
    break;

    default :
        $args['class'][] = 'form-group';
        $args['input_class'] = array('form-control', 'input-lg');
        $args['label_class'] = array('control-label');
    break;
    }

    return $args;
}