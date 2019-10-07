<?php

// function: post_type BEGIN
function wlcm_post_type(){
    
    $labels = array(
                    'name' => __( 'Welcome'), 
                    'singular_name' => __('Welcome'),
                    'rewrite' => array(
                            'slug' => __( 'welcome' ) 
                    ),
                    'add_new' => _x('Add Item', 'welcome'), 
                    'edit_item' => __('Edit Welcome Item'),
                    'new_item' => __('New Welcome Item'), 
                    'view_item' => __('View Welcome'),
                    'search_items' => __('Search Welcome'), 
                    'not_found' =>  __('No Welcome Items Found'),
                    'not_found_in_trash' => __('No Welcome Items Found In Trash'),
                    'parent_item_colon' => ''
                );
    $args = array(
                    'labels' => $labels,
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true,
                    'query_var' => true,
                    'rewrite' => true,
                    'capability_type' => 'post',
                    'hierarchical' => false,
                    'menu_position' => null,
                    'supports' => array(
                            'title',
                            'editor',
                            'thumbnail',
                            'excerpt',
                            'custom-fields'
                    )
             );
    
    register_post_type(__( 'welcome' ), $args);        
} 

// function: welcome_messages BEGIN
function welcome_messages($messages)
{
    $messages[__( 'welcome' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Welcome Updated. <a href="%s">View welcome</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Welcome Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Welcome Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Welcome Published. <a href="%s">View Welcome</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Welcome Saved.'),
                    8 => sprintf(__('Welcome Submitted. <a target="_blank" href="%s">Preview Welcome</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Welcome Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Welcome</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Welcome Draft Updated. <a target="_blank" href="%s">Preview Welcome</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: welcome_messages END

// function: welcome_filter BEGIN
function welcome_filter()
{
    register_taxonomy(
            __( "welcome-cat" ),
            array(__( "welcome" )),
            array(
                    "hierarchical" => true,
                    "label" => __( "Category Welcome" ),
                    "singular_label" => __( "Filter" ),
//                    "rewrite" => array(
//                            'slug' => 'welcome',
//                            'hierarchical' => true
//                    )
            )
    );
} // function: welcome_filter END


add_action( 'init', 'wlcm_post_type' );
add_action( 'init', 'welcome_filter', 0 );
add_filter( 'post_updated_messages', 'welcome_messages' );
