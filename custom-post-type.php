<?php
//Example for Custom Post Type with Taxonomies

/*
    *** You van use dash-icons https://developer.wordpress.org/resource/dashicons/
*/
add_action( 'init', 'register_cpts' );
function register_cpts() {

    //custom taxonomy attached to jobs CPT
    $taxName = 'Taxonomy Name';
    $taxLabels = array(
        'name'                          => $taxName,
        'singular_name'                 => $taxName,
        'search_items'                  => 'Search '.$taxName,
        'popular_items'                 => 'Popular '.$taxName,
        'all_items'                     => 'All '.$taxName.'s',
        'parent_item'                   => 'Parent '.$taxName,
        'edit_item'                     => 'Edit '.$taxName,
        'update_item'                   => 'Update '.$taxName,
        'add_new_item'                  => 'Add New '.$taxName,
        'new_item_name'                 => 'New '.$taxName,
        'separate_items_with_commas'    => 'Separate '.$taxName.'s with commas',
        'add_or_remove_items'           => 'Add or remove '.$taxName.'s',
        'choose_from_most_used'         => 'Choose from most used '.$taxName.'s'
    );
    $taxArr = array(
        'label'                         => $taxName,
        'labels'                        => $taxLabels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_in_nav_menus'             => true,
        'show_admin_column'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        'query_var'                     => true,
        'show_ui'                       => true,
        'rewrite'                       => true,
    );
    register_taxonomy( 'taxonomy_name', 'custom_post_type', $taxArr );

    register_post_type( 'custom_post_type',
        array(
            'labels' => array(
                'name' => 'Custom Post Type',
                'singular_name' => 'Custom Post Type',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit_item' => 'Edit',
                'new_item' => 'New',
                'all_items' => 'All',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' =>  'Not found',
                'not_found_in_trash' => 'No found in Trash',
                'parent_item_colon' => '',
                'menu_name' => 'Custom Post Type'
            ),
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'rewrite'               => array( 'slug' => 'permalink' ),
            'has_archive'           => true,
            'hierarchical'          => true,
            'show_in_nav_menus'     => true,
            'capability_type'       => 'page',
            'query_var'             => true,
            'menu_icon'             => 'dashicons-admin-page',
        ));
    //flush_rewrite_rules();
}
