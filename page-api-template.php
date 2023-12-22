<?php
/*
Template Name: API Template
*/

get_header();
?>

<div class="container mt-5">
    <form method="get" class="form-inline">
        <label for="data" class="mr-2">Search Fake Product</label>
        <input type="text" name="data" class="form-control mr-2" required>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<?php

if (isset($_GET['data'])) {
    
    $search_input = sanitize_text_field($_GET['data']);

    $response = wp_remote_get('https://fakestoreapi.com/products?limit=1&search=' . urlencode($search_input));

    if (is_wp_error($response)) {
        echo 'Error retrieving data from API.';
    } else {
        
        $data = json_decode(wp_remote_retrieve_body($response), true);

        
        echo '<div class="container mt-5">';
        echo '<h2 class="mb-3">Product Information</h2>';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<p class="card-text"><strong>Title:</strong> ' . esc_html(wp_kses($data[0]['title'], 'post')) . '</p>';
        echo '<p class="card-text"><strong>Description:</strong> ' . esc_html(wp_kses($data[0]['description'], 'post')) . '</p>';
        echo '<p class="card-text text-success"><strong>Price:</strong> $' . esc_html($data[0]['price']) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        
        $post_data = array(
            'post_title'   => wp_kses($data[0]['title'], 'post'),
            'post_content' => wp_kses($data[0]['description'], 'post'),
            'post_type'    => 'fake_store_products',
            'post_status'  => 'publish'
        );

        
        $post_id = wp_insert_post($post_data);

        
        if ($post_id) {
            
            update_post_meta($post_id, '_product_price', $data[0]['price']);
            echo '<div class="container mt-3"><div class="alert alert-success" role="alert">API data successfully saved!</div></div>';
        } else {
            echo '<div class="container mt-3"><div class="alert alert-danger" role="alert">Error saving data to custom post type.</div></div>';
        }
    }
}

get_footer();
?>
