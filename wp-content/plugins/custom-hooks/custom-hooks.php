<?php
/*
Plugin Name: Custom Hooks
Plugin URI: https://facetwp.com/
Description: A container for custom hooks
Version: 1.0
Author: FacetWP, LLC
*/

$params = array(
    // 'post_id' => 123,
    'facet_name' => 'address',
    'facet_source' => 'tax/category',
    'facet_value' => '45',
    'facet_display_value' => 'My Test Category',
    'term_id' => 0,
    'parent_id' => 0,
    'depth' => 0,
    'variation_id' => 0
);

// Save date in "Jan 1, 2014" format
add_filter( 'facetwp_index_row', function( $params, $class ) {
    if ( 'my_date' == $params['facet_name'] ) {
        $raw_value = $params['facet_value'];
        $params['facet_display_value'] = date( 'M j, Y', strtotime( $raw_value ) );
    }
    return $params;
}, 10, 2 );