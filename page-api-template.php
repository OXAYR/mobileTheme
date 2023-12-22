<?php
/*
Template Name: API Template
*/


$response = wp_remote_get('https://fakestoreapi.com/products/1');

if (is_wp_error($response)) {
    
    echo 'Error retrieving data from API.';
} else {

    $data = json_decode(wp_remote_retrieve_body($response), true);


    $post_data = array(
        'post_title' => $data['title'],
        'post_content' => $data['description'],
        'post_type' => 'fake_store_products',
        'post_status' => 'publish'
    );

    $post_id = wp_insert_post($post_data);

    if ($post_id) {
        
        update_post_meta($post_id, '_product_price', $data['price']);

        echo 'API data successfully saved!';
    } else {
        echo 'Error saving data to custom post type.';
    }
}
?>
