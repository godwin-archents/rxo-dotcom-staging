<?php

function rxo_rest_permissions_check($request)
{

    //GET HOSTNAME INFO
    $host = $_SERVER['SERVER_NAME'];
    $request_origin = $_SERVER['HTTP_ORIGIN'];
    $cors = $_SERVER['HTTP_SEC_FETCH_SITE'];

    if ($cors == 'same-origin') {
        return true;
    }

    $allowed_origins = array();

    if ($host == 'dotcomdev.rxo.com') {
        $allowed_origins = array('http://localhost:3333', 'http://localhost:4200', 'https://track.rxoconnectdev.rxo.com', 'https://track.rxoconnectperf.rxo.com', 'https://track.rxoconnectdemo.rxo.com');
    }

    if ($host == 'dotcomstg.rxo.com') {
        $allowed_origins = array('https://dotcomdev.rxo.com', 'https://track.rxoconnectdemo.rxo.com/track/');
    }


    if (!(in_array($request_origin, $allowed_origins))) {
        return new WP_Error('rest_forbidden_access', 'Access denied to this origin - ' . $request_origin . 'from host ' . $host, array('status' => rest_authorization_required_code()));
    }

    return true;
}

function rxo_get_menu_items($request)
{
    $response = [];
    $menu_locations = get_nav_menu_locations();
    foreach ($menu_locations as $slug => $id) {
        $items = wp_get_nav_menu_items($id);
        $response[$slug] = $items ? buildTree($items, 0) : [];
    }

    return $response;
}

function rxo_get_menu_item($request)
{
    $term = $request['id'];
    if (is_wp_error($term)) {
        return $term;
    }

    $items = wp_get_nav_menu_items($term);
    return $items ? buildTree($items, 0) : [];
}

/* Get Menu Item ID From Item Name */
function rxo_get_menu_item_by_name($menu_name, $item_name) {

    $menu = wp_get_nav_menu_object($menu_name);
    
     if (!$menu) {
     return null;
     }
    
    $menu_items = wp_get_nav_menu_items($menu->term_id);
     foreach ($menu_items as $menu_item) {
      if ($menu_item->title === $item_name) {
      return $menu_item;
      }
    }
}

/* Get Mega Menu Gray Box Details */
function rxo_get_megamenu_items($request)
{
    $response = [];
   

    $menu_name = 'header-primary'; 
    $item_name = $request['id']; 

    $menu_item = rxo_get_menu_item_by_name($menu_name, $item_name);
    
    $item_id = $menu_item->ID;

    $response[0]['menu_top_title']=get_post_meta( $item_id, 'menu_top_title', true );
    $response[0]['menu_top_title_url']=get_post_meta( $item_id, 'menu_top_title_url', true );
    $response[0]['menu_copy_top']=get_post_meta( $item_id, 'menu_copy_top', true );
    $response[0]['menu_bottom_title']=get_post_meta( $item_id, 'menu_bottom_title', true );
    $response[0]['menu_bottom_title_url']=get_post_meta( $item_id, 'menu_bottom_title_url', true );
    $response[0]['menu_copy_bottom']=get_post_meta( $item_id, 'menu_copy_bottom', true );

    $repeater_field_data = get_field('menu_quick_links', $item_id);

    if ($repeater_field_data) {
        foreach ($repeater_field_data as $key=>$row) {
            $menu_link_type = get_link_type($row['menu_url']);

            $response[0]['menu_quick_links'][$key]['menu_name'] = $row['menu_name'];
            $response[0]['menu_quick_links'][$key]['menu_url']= $row['menu_url'];
            $response[0]['menu_quick_links'][$key]['menu_target']= $menu_link_type;
        }
    }

    return $response;
}

function rxo_register_api_endpoints()
{
    $namespace = "wp/v2";
    $rest_base = "menu";
    $rest_mm_base = "megamenu"; //Rest API End point for Megamenu Item 

    register_rest_route(
        $namespace,
        '/' . $rest_base,
        array(
            array(
                'methods' => WP_REST_Server::READABLE,
                'callback' => "rxo_get_menu_items",
                'permission_callback' => 'rxo_rest_permissions_check',
            )
        )
    );

    register_rest_route(
        $namespace,
        '/' . $rest_base . '/(?P<id>[a-zA-Z0-9_-]+)',
        array(
            'args' => array(
                'id' => array(
                    'description' => __('Unique identifier for the term.'),
                    'type' => 'string',
                ),
            ),
            array(
                'methods' => WP_REST_Server::READABLE,
                'callback' => 'rxo_get_menu_item',
                'permission_callback' => 'rxo_rest_permissions_check',
            )
        )
    );

    /* Megamenu Rest URL Register */
    register_rest_route(
        $namespace,
        '/' . $rest_mm_base . '/(?P<id>[a-zA-Z0-9_-]+)',
        array(
            array(
                'methods' => WP_REST_Server::READABLE,
                'callback' => "rxo_get_megamenu_items",
                'permission_callback' => 'rxo_rest_permissions_check',
            )
        )
    );
}

add_action("rest_api_init", "rxo_register_api_endpoints");


function buildTree($elements, $parentId = 0)
{
    $branch = array();
    foreach ($elements as &$element) {
        if ($element->menu_item_parent == $parentId) {
            $children = buildTree($elements, $element->ID);
            if ($children) {
                $element->children = $children;
            }

            $branch[] = array(
                'id' => $element->ID,
                "menu_order" => $element->menu_order,
                "title" => $element->title,
                "url" => $element->url,
                "target" => $element->target,
                "classes" => $element->classes,
                "children" => $element->children
            );
            unset($element);
        }
    }
    return $branch;
}
