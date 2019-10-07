<?php

// function: post_type BEGIN
function team_post_type(){
    
    $labels = array(
                    'name' => __( 'Team'), 
                    'singular_name' => __('Team'),
                    'rewrite' => array(
                            'slug' => __( 'team' ) 
                    ),
                    'add_new' => _x('Add Item', 'team'), 
                    'edit_item' => __('Edit Team Item'),
                    'new_item' => __('New Team Item'), 
                    'view_item' => __('View Team'),
                    'search_items' => __('Search Team'), 
                    'not_found' =>  __('No Team Items Found'),
                    'not_found_in_trash' => __('No Team Items Found In Trash'),
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
    
    register_post_type(__( 'team' ), $args);        
} 

// function: team_messages BEGIN
function team_messages($messages)
{
    $messages[__( 'team' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Team Updated. <a href="%s">View team</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Team Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Team Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Team Published. <a href="%s">View Team</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Team Saved.'),
                    8 => sprintf(__('Team Submitted. <a target="_blank" href="%s">Preview Team</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Team Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Team</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Team Draft Updated. <a target="_blank" href="%s">Preview Team</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: team_messages END

// function: team_filter BEGIN
function team_filter()
{
    register_taxonomy(
            __( "team-cat" ),
            array(__( "team" )),
            array(
                    "hierarchical" => true,
                    "label" => __( "Category Team" ),
                    "singular_label" => __( "Filter" ),
//                    "rewrite" => array(
//                            'slug' => 'team',
//                            'hierarchical' => true
//                    )
            )
    );
} // function: team_filter END


add_action( 'init', 'team_post_type' );
add_action( 'init', 'team_filter', 0 );
add_filter( 'post_updated_messages', 'team_messages' );
