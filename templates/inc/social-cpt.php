<?php

// function: post_type BEGIN
function social_post_type(){
    
    $labels = array(
                    'name' => __( 'Social'), 
                    'singular_name' => __('Social'),
                    'rewrite' => array(
                            'slug' => __( 'social' ) 
                    ),
                    'add_new' => _x('Add Item', 'social'), 
                    'edit_item' => __('Edit Social Item'),
                    'new_item' => __('New Social Item'), 
                    'view_item' => __('View Social'),
                    'search_items' => __('Search Social'), 
                    'not_found' =>  __('No Social Items Found'),
                    'not_found_in_trash' => __('No Social Items Found In Trash'),
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
    
    register_post_type(__( 'social' ), $args);        
} 

// function: social_messages BEGIN
function social_messages($messages)
{
    $messages[__( 'social' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Social Updated. <a href="%s">View social</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Social Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Social Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Social Published. <a href="%s">View Social</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Social Saved.'),
                    8 => sprintf(__('Social Submitted. <a target="_blank" href="%s">Preview Social</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Social Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Social</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Social Draft Updated. <a target="_blank" href="%s">Preview Social</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: social_messages END

// function: social_filter BEGIN
function social_filter()
{
    register_taxonomy(
            __( "social-cat" ),
            array(__( "social" )),
            array(
                    "hierarchical" => true,
                    "label" => __( "Category Social" ),
                    "singular_label" => __( "Filter" ),
//                    "rewrite" => array(
//                            'slug' => 'social',
//                            'hierarchical' => true
//                    )
            )
    );
} // function: social_filter END


add_action( 'init', 'social_post_type' );
add_action( 'init', 'social_filter', 0 );
add_filter( 'post_updated_messages', 'social_messages' );
