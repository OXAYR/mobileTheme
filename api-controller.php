<?php
// api-controller.php

function handle_api_requests() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle POST request
        if (isset($_POST['create_product'])) {
            handle_create_product();
        } elseif (isset($_POST['update_product'])) {
            handle_update_product();
        } elseif (isset($_POST['delete_product'])) {
            handle_delete_product();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Handle GET request
        if (isset($_GET['get_product'])) {
            handle_get_product();
        }
    }

    // Additional API request handling can go here...
}

function handle_create_product() {
    // Logic for handling the creation of a new product via API
    // Implement your logic here for creating a new product via API

    // Example: Create product logic
    $product_data = array(
        'title' => sanitize_text_field($_POST['create_product_title']),
        'description' => sanitize_text_field($_POST['create_product_description']),
        'price' => floatval($_POST['create_product_price'])
    );

    // Perform the API request to create a new product
    $response = wp_remote_post('https://fakestoreapi.com/products', array(
        'body' => json_encode($product_data),
        'headers' => array('Content-Type' => 'application/json')
    ));

    if (!is_wp_error($response)) {
        $result = json_decode(wp_remote_retrieve_body($response), true);
        // Process the result as needed
    } else {
        // Handle error
    }
}

function handle_update_product() {
    // Logic for handling the update of a product via API
    // Implement your logic here for updating a product via API

    // Example: Update product logic
    $product_id = intval($_POST['update_product_id']);
    $updated_product_data = array(
        'title' => sanitize_text_field($_POST['update_product_title']),
        'description' => sanitize_text_field($_POST['update_product_description']),
        'price' => floatval($_POST['update_product_price'])
    );

    // Perform the API request to update the product
    $response = wp_remote_request("https://fakestoreapi.com/products/{$product_id}", array(
        'method' => 'PUT',
        'body' => json_encode($updated_product_data),
        'headers' => array('Content-Type' => 'application/json')
    ));

    if (!is_wp_error($response)) {
        $result = json_decode(wp_remote_retrieve_body($response), true);
        // Process the result as needed
    } else {
        // Handle error
    }
}

function handle_delete_product() {
    // Logic for handling the deletion of a product via API
    // Implement your logic here for deleting a product via API

    // Example: Delete product logic
    $product_id = intval($_POST['delete_product_id']);

    // Perform the API request to delete the product
    $response = wp_remote_request("https://fakestoreapi.com/products/{$product_id}", array(
        'method' => 'DELETE'
    ));

    if (!is_wp_error($response)) {
        $result = json_decode(wp_remote_retrieve_body($response), true);
        // Process the result as needed
    } else {
        // Handle error
    }
}

function handle_get_product() {
    // Logic for handling the retrieval of a product via API
    if (isset($_GET['product_id'])) {
        $product_id = intval($_GET['product_id']);

        // Perform the API request to get product information
        $response = wp_remote_get("https://fakestoreapi.com/products/{$product_id}");

        if (!is_wp_error($response)) {
            $result = json_decode(wp_remote_retrieve_body($response), true);
            // Process the result as needed
        } else {
            // Handle error
        }
    }
}