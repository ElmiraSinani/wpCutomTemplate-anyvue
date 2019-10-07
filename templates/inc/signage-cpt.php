<?php

// function: post_type BEGIN
function signage_post_type(){
    
    $labels = array(
                    'name' => __( 'Signage'), 
                    'singular_name' => __('Signage'),
                    'rewrite' => array(
                            'slug' => __( 'signage' ) 
                    ),
                    'add_new' => _x('Add Item', 'signage'), 
                    'edit_item' => __('Edit Signage Item'),
                    'new_item' => __('New Signage Item'), 
                    'view_item' => __('View Signage'),
                    'search_items' => __('Search Signage'), 
                    'not_found' =>  __('No Signage Items Found'),
                    'not_found_in_trash' => __('No Signage Items Found In Trash'),
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
    
    register_post_type(__( 'signage' ), $args);        
} 

// function: signage_messages BEGIN
function signage_messages($messages)
{
    $messages[__( 'signage' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Signage Updated. <a href="%s">View signage</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Signage Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Signage Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Signage Published. <a href="%s">View Signage</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Signage Saved.'),
                    8 => sprintf(__('Signage Submitted. <a target="_blank" href="%s">Preview Signage</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Signage Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Signage</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Signage Draft Updated. <a target="_blank" href="%s">Preview Signage</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: signage_messages END

// function: signage_filter BEGIN
function signage_filter()
{
    register_taxonomy(
            __( "signage-cat" ),
            array(__( "signage" )),
            array(
                    "hierarchical" => true,
                    "label" => __( "Category Signage" ),
                    "singular_label" => __( "Filter" ),
//                    "rewrite" => array(
//                            'slug' => 'signage',
//                            'hierarchical' => true
//                    )
            )
    );
} // function: signage_filter END


add_action( 'init', 'signage_post_type' );
add_action( 'init', 'signage_filter', 0 );
add_filter( 'post_updated_messages', 'signage_messages' );
