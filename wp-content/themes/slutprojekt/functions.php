<?php


add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support('widgets');



    
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















?>