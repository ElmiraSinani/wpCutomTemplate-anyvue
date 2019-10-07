<?php

// function: post_type BEGIN
function contactInfo_post_type(){
    
    $labels = array(
                    'name' => __( 'Contact Info'), 
                    'singular_name' => __('Contact Info'),
                    'rewrite' => array(
                            'slug' => __( 'contact_info' ) 
                    ),
                    'add_new' => _x('Add Item', 'contact_info'), 
                    'edit_item' => __('Edit Contact Info Item'),
                    'new_item' => __('New Contact Info Item'), 
                    'view_item' => __('View Contact Info'),
                    'search_items' => __('Search Contact Info'), 
                    'not_found' =>  __('No Contact Info Items Found'),
                    'not_found_in_trash' => __('No Contact Info Items Found In Trash'),
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
    
    register_post_type(__( 'contact_info' ), $args);        
} 

// function: contact_info_messages BEGIN
function contact_info_messages($messages)
{
    $messages[__( 'contact_info' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Contact Info Updated. <a href="%s">View contact_info</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Contact Info Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Contact Info Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Contact Info Published. <a href="%s">View Contact Info</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Contact Info Saved.'),
                    8 => sprintf(__('Contact Info Submitted. <a target="_blank" href="%s">Preview Contact Info</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Contact Info Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Contact Info</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Contact Info Draft Updated. <a target="_blank" href="%s">Preview Contact Info</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: contact_info_messages END

// function: contact_info_filter BEGIN
function contact_info_filter()
{
    register_taxonomy(
            __( "contact_info-cat" ),
            array(__( "contact_info" )),
            array(
                    "hierarchical" => true,
                    "label" => __( "Category Contact" ),
                    "singular_label" => __( "Filter" ),
//                    "rewrite" => array(
//                            'slug' => 'contact_info',
//                            'hierarchical' => true
//                    )
            )
    );
} // function: contact_info_filter END


add_action( 'init', 'contactInfo_post_type' );
add_action( 'init', 'contact_info_filter', 0 );
add_filter( 'post_updated_messages', 'contact_info_messages' );
