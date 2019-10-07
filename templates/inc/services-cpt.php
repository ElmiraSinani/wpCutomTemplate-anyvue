<?php

// function: post_type BEGIN
function services_post_type(){
    
    $labels = array(
                    'name' => __( 'Services'), 
                    'singular_name' => __('Services'),
                    'rewrite' => array(
                            'slug' => __( 'services' ) 
                    ),
                    'add_new' => _x('Add Item', 'services'), 
                    'edit_item' => __('Edit Services Item'),
                    'new_item' => __('New Services Item'), 
                    'view_item' => __('View Services'),
                    'search_items' => __('Search Services'), 
                    'not_found' =>  __('No Services Items Found'),
                    'not_found_in_trash' => __('No Services Items Found In Trash'),
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
    
    register_post_type(__( 'services' ), $args);        
} 

// function: services_messages BEGIN
function services_messages($messages)
{
    $messages[__( 'services' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Services Updated. <a href="%s">View services</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Services Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Services Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Services Published. <a href="%s">View Services</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Services Saved.'),
                    8 => sprintf(__('Services Submitted. <a target="_blank" href="%s">Preview Services</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Services Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Services</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Services Draft Updated. <a target="_blank" href="%s">Preview Services</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: services_messages END

// function: services_filter BEGIN
function services_filter()
{
    register_taxonomy(
            __( "services-cat" ),
            array(__( "services" )),
            array(
                    "hierarchical" => true,
                    "label" => __( "Category Services" ),
                    "singular_label" => __( "Services" ),
//                    "rewrite" => array(
//                            'slug' => 'services',
//                            'hierarchical' => true
//                    )
            )
    );
} // function: services_filter END


add_action( 'init', 'services_post_type' );
add_action( 'init', 'services_filter', 0 );
add_filter( 'post_updated_messages', 'services_messages' );
