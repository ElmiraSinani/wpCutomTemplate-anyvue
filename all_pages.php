<?php

/**
  Page for one page Layouts
 * */


$pages = get_pages( array('sort_order' => 'ASC', 'sort_column' => 'menu_order') );


global $post;

if ($pages) {
    echo '<div class="container-wrap">';

    foreach ($pages as $page_data) {
        //print_r($page_data);
        $page = lis_get_page_options($page_data->ID);
        //print_r($page);
        $pageTemplate = $page['template'];
       
        $showPage = get_post_meta($page_data->ID, '_lis_show_page', true);
        
        if (isset($showPage) && $showPage != "") {
            
            echo "<div id='".$page['post_name'] ."' class='page-item " . $page['class']. "' >";
            
            if($pageTemplate && $pageTemplate != "" ){                
                echo "<div class='page-content' >";   
                    if (get_edit_post_link( $page_data->ID )){
                        echo '<a href="' . get_edit_post_link( $page_data->ID ) . '" class="quickEdit" target="_blank"> Edit</a>';
                    }
                    echo '<div class="'.$page['post_name'].'">'. $page['page_content']. '</div>';
                    include_once($pageTemplate);
                echo "</div>";
                
            }else{
                echo "<div class='page-content' >";
                    if (get_edit_post_link( $page_data->ID )){
                        echo '<a href="' . get_edit_post_link( $page_data->ID ) . '" class="quickEdit" target="_blank"> Edit</a>';
                    }
                echo '<div class="'.$page['post_name'].'">'. $page['page_content']. '</div>';
                
                include("template-default.php");
                echo "</div>";
               
            }
            echo "</div>";
        }
        
    }

    echo '</div>';
}
