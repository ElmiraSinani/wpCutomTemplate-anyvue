<?php

// function: post_type BEGIN
function features_post_type(){
    
    $labels = array(
                    'name' => __( 'Features'), 
                    'singular_name' => __('Features'),
                    'rewrite' => array(
                            'slug' => __( 'features' ) 
                    ),
                    'add_new' => _x('Add Item', 'features'), 
                    'edit_item' => __('Edit Features Item'),
                    'new_item' => __('New Features Item'), 
                    'view_item' => __('View Features'),
                    'search_items' => __('Search Features'), 
                    'not_found' =>  __('No Features Items Found'),
                    'not_found_in_trash' => __('No Features Items Found In Trash'),
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
    
    register_post_type(__( 'features' ), $args);        
} 

// function: features_messages BEGIN
function features_messages($messages)
{
    $messages[__( 'features' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Features Updated. <a href="%s">View features</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Features Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Features Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Features Published. <a href="%s">View Features</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Features Saved.'),
                    8 => sprintf(__('Features Submitted. <a target="_blank" href="%s">Preview Features</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Features Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Features</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Features Draft Updated. <a target="_blank" href="%s">Preview Features</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: features_messages END

// function: features_filter BEGIN
function features_filter()
{
    register_taxonomy(
            __( "features-cat" ),
            array(__( "features" )),
            array(
                    "hierarchical" => true,
                    "label" => __( "Category Features" ),
                    "singular_label" => __( "Filter" ),
//                    "rewrite" => array(
//                            'slug' => 'features',
//                            'hierarchical' => true
//                    )
            )
    );
} // function: features_filter END


add_action( 'init', 'features_post_type' );
add_action( 'init', 'features_filter', 0 );
add_filter( 'post_updated_messages', 'features_messages' );
