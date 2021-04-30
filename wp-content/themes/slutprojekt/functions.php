<?php


add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support('widgets');

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
        'name' => 'Footer column 1',
        'Desription' => 'Footer column 1 info and payment',
        'id' => 'footercolumnone',
        'before_title' => '<p>',
        'after_title' => '</p>',
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















?>