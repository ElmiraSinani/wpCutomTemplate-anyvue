<?php
    //ini_set('error_reporting', E_ALL);
    require_once(get_template_directory() . '/includes/libs/helpers.php');
    require_once (get_template_directory() .'/includes/metaboxes/meta-page-settings.php');
    require_once(get_template_directory() . '/templates/lis_top_menu.php');
    

    require_once("templates/inc/welcome-cpt.php");
    require_once("templates/inc/social-cpt.php");
    require_once("templates/inc/features-cpt.php");
    require_once("templates/inc/signage-cpt.php");
    
    require_once("templates/inc/contactInfo-cpt.php");
    
    //require_once("templates/inc/services-cpt.php");
    //require_once("templates/inc/team-cpt.php");   
    
    function load_styles_and_scripts() {
        
    //load styles     
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('cubeportfolio', get_template_directory_uri() . '/css/cubeportfolio.css');
    wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider.css');
    wp_enqueue_style('liquid-slider', get_template_directory_uri() . '/css/liquid-slider.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css');
    wp_enqueue_style('custom', get_template_directory_uri() . '/css/style.css');
  
    //load scripts
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.8.3.min.js', array(), '', true);
    }
   
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '', true);
    wp_enqueue_script('plugins', get_template_directory_uri() . '/js/plugins.js', array(), '', true);
    wp_enqueue_script('jsapi', 'http://www.google.com/jsapi', array(), '', true);
    wp_enqueue_script('easy-pie-chart', get_template_directory_uri() . '/js/jquery.easy-pie-chart.js', array(), '', true);
    wp_enqueue_script('functions', get_template_directory_uri() . '/js/functions.js', array(), '', true);
    //wp_enqueue_script('style-switcher', get_template_directory_uri() . '/js/style-switcher/style-switcher.js', array(), '', true);
    wp_enqueue_script('mail-validation', get_template_directory_uri() . '/js/mail_validation.js', array(), '', true);

    }

    add_action('wp_enqueue_scripts', 'load_styles_and_scripts');
   

    // Clean up the <head>
    function removeHeadLinks() {
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
   // Page Settings
    if (function_exists('add_theme_support')) {
        add_theme_support('post-thumbnails');           
    }
    
    //Register Menu
    add_action('init', 'lis_menus');

    function lis_menus() {
        register_nav_menus(array(
            'primary-nav' => __('Header Navigation', 'pt_admin_framework'),
            //'secondary-nav' => __('Header Secondary Navigation', 'pt_admin_framework'),
            'footer-nav' => __('Footer Navigation', 'pt_admin_framework')
        ));
    }
    
    
    
function the_page_slug($id) {
    $post_data = get_post($id, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug; 
}

function title_slider_item($slide_items){
    $item = explode('|', $slide_items);
    foreach ($item as $val){
        $span .= "<span>".$val."</span>";
    }
    return $span;
}