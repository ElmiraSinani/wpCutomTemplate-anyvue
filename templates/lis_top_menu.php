<?php

class lis_top_menu extends Walker_Nav_Menu {
    /* Constructor */

    function lis_top_menu($is_home = '') {
        $this->is_home = $is_home;
    }

    /**
     * @see Walker::start_lvl()
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {

        //$indent = str_repeat( "\t", $depth );
        //$output .= "\n$indent<ul role=\"menu\" class=\" teste dropdown-menu\">\n";

        $display_depth = ($depth + 1); // because it counts the first submenu as 0

        if ($display_depth == '1')
            $class_names = 'dropdown-menu';
        else
            $class_names = 'megamenu';

        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"" . $class_names . "\"><ul role=\"menu\" class=\"list-unstyled\">\n";
    }

    function end_lvl(&$output, $depth = 1, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }

    /**
     * @see Walker::start_el()
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
        
        /**
         * Dividers, Headers or Disabled
         * =============================
         * Determine whether the item is a Divider, Header, Disabled or regular
         * menu item. To prevent errors we use the strcasecmp() function to so a
         * comparison that is not case sensitive. The strcasecmp() function returns
         * a 0 if the strings are equal.
         */
        /*
          Vars de Retorno

          $item->divider;
          $item->icon;
          $item->dropdown_header;
          $item->external_link
         */

        //var_dump($item);
        
        
        
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
       
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        if ($args->has_children) {
            $class_names .= ' dropdown';
        }

        if ($item->divider && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if ($item->divider && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if ($item->dropdown_header && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="dropdown-header ' . $class_names . '"><span>' . esc_attr($item->title) . '</span>';
        } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr($item->title) . '</a>';
        } else {

            if (in_array('current-menu-item', $classes))
                $class_names .= ' active';

            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . '>';

            $atts = array();
            $atts['title'] = !empty($item->title) ? $item->title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';

            // If item has_children add atts to a.
            if ($args->has_children && $depth === 0) {
                $atts['href'] = '#';
                $atts['data-toggle'] = 'dropdown';
                $atts['class'] = 'dropdown-toggle';
            } else {
               
                if ($item->external_link) {
                    $atts['href'] = !empty($item->url) ? $item->url : '';
                } else {
                    $page_data = get_post($item->object_id);
                    
                    $slug = the_page_slug($page_data->ID);
                    $atts['class'] = $slug;
                    
                    $openPage = get_post_meta( $page_data->ID, '_lis_open_page', true );
                    if( $openPage ){
                         $atts['href'] = home_url('/') . $page_data->post_name;
                    }else{
                        if ($this->is_home) {
                            $atts['href'] = '#' . $page_data->post_name;
                        } else {
                            $atts['href'] = home_url('/') . '#' . $page_data->post_name;
                        }
                    }
                }
            }

            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;

            /*
             * Glyphicons
             * ===========
             * Since the the menu item is NOT a Divider or Header we check the see
             * if there is a value in the attr_title property. If the attr_title
             * property is NOT null we apply it as the class name for the glyphicon.
             */
            if (!empty($item->icon))
                $item_output .= '<a' . $attributes . '><i class="' . esc_attr($item->icon) . '"></i>&nbsp;';
            else
                $item_output .= '<a' . $attributes . '>';

            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="fa fa-chevron-down"></span></a>' : '</a>';
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
    }

    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth.
     *
     * This method shouldn't be called directly, use the walk() method instead.
     *
     * @see Walker::start_el()
     * @since 2.5.0
     *
     * @param object $element Data object
     * @param array $children_elements List of elements to continue traversing.
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of current element.
     * @param array $args
     * @param string $output Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
        if (!$element)
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function fallback($args) {
        if (current_user_can('manage_options')) {

            extract($args);

            $fb_output = null;

            if ($container) {
                $fb_output = '<' . $container;

                if ($container_id)
                    $fb_output .= ' id="' . $container_id . '"';

                if ($container_class)
                    $fb_output .= ' class="' . $container_class . '"';

                $fb_output .= '>';
            }

            $fb_output .= '<ul';

            if ($menu_id)
                $fb_output .= ' id="' . $menu_id . '"';

            if ($menu_class)
                $fb_output .= ' class="' . $menu_class . '"';

            $fb_output .= '>';
            $fb_output .= '<li><a href="' . admin_url('nav-menus.php') . '">Add a menu</a></li>';
            $fb_output .= '</ul>';

            if ($container)
                $fb_output .= '</' . $container . '>';

            echo $fb_output;
        }
    }

}
