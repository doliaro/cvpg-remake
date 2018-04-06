<?php
/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called mind-Blank
add_action('init', 'ema_custom_post_type'); // Add our mind Blank Custom Post Type
function ema_custom_post_type()
{
    $Physician_labels = array(
        'name' => 'Physicians',
        'singular_name' => 'Physician',
        'menu_name' => 'Physicians',
        'name_admin_bar' => 'Physician',
        'archives' => 'Physician Archives',
        'attributes' => 'Physician Attributes',
        'parent_item_colon' => 'Physician Items:',
        'all_items' => 'All Physicians',
        'add_new_item' => 'Add New Physician',
        'add_new' => 'Add Physician',
        'new_item' => 'New Physician',
        'edit_item' => 'Edit Physician',
        'update_item' => 'Update Physician',
        'view_item' => 'View Physician',
        'view_items' => 'View Physicians',
        'search_items' => 'Search Physician',
        'not_found' => 'Not found',
        'not_found_in_trash' => 'Not found in Trash',
        'featured_image' => 'Featured Image',
        'set_featured_image' => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image' => 'Use as featured image',
        'insert_into_item' => 'Insert into item',
        'uploaded_to_this_item' => 'Uploaded to this item',
        'items_list' => 'Physicians list',
        'items_list_navigation' => 'Physicians list navigation',
        'filter_items_list' => 'Filter Physician list',
    );
    $Physician_args = array(
        'label' => 'Physician',
        'description' => 'Physicians of the EMA',
        'labels' => $Physician_labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array('Physician_tax'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 3.3,
        'menu_icon' => 'dashicons-admin-users',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => 'Physician',
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    $slider_labels = array(
        'name' => 'Slides',
        'singular_name' => 'Slide',
        'menu_name' => 'Slides',
        'name_admin_bar' => 'Slide',
        'archives' => 'Slide Archives',
        'attributes' => 'Slide Attributes',
        'parent_item_colon' => 'Slide Items:',
        'all_items' => 'All Slides',
        'add_new_item' => 'Add New Slide',
        'add_new' => 'Add Slide',
        'new_item' => 'New Slide',
        'edit_item' => 'Edit Slide',
        'update_item' => 'Update Slide',
        'view_item' => 'View Slide',
        'view_items' => 'View Slides',
        'search_items' => 'Search Slide',
        'not_found' => 'Not found',
        'not_found_in_trash' => 'Not found in Trash',
        'featured_image' => 'Featured Image',
        'set_featured_image' => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image' => 'Use as featured image',
        'insert_into_item' => 'Insert into item',
        'uploaded_to_this_item' => 'Uploaded to this item',
        'items_list' => 'Slide list',
        'items_list_navigation' => 'Slides list navigation',
        'filter_items_list' => 'Filter slider list',
    );
    $slider_args = array(
        'label' => 'Slide',
        'description' => 'Slide content',
        'labels' => $slider_labels,
        'supports' => array('title', 'thumbnail'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 3.1,
        'menu_icon' => 'dashicons-format-gallery',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => 'slider',
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );


    register_post_type('slides', $slider_args);

    register_post_type( 'Physicians', $Physician_args);


}