<?php 

function mobile_script_enqueue() {
    
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), '4.3.1', 'all');

    wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/mobileTheme.css', array(), '1.0.0', 'all');

    
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), '4.3.1', true);
    wp_enqueue_script('customscript', get_template_directory_uri() . '/js/mobileTheme.js', array(), '1.0.0', true);
}


add_action( 'wp_enqueue_scripts','mobile_script_enqueue' );

function mobile_theme_setup(){
    add_theme_support('menus');

    register_nav_menu( 'primary', 'Primary Navigation menu' );
    register_nav_menu( 'secondary', 'Footer Navigation menu' );

}


add_action('init', 'mobile_theme_setup');




add_theme_support('custom-background' );
add_theme_support( 'custome-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('image'));




function mobile_widget_setup(){
    register_sidebar(
		array(	
			'name'	=> 'Sidebar',
			'id'	=> 'sidebar-1',
			'class'	=> 'custom',
			'description' => 'Standard Sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		)
	);
}

add_action('widgets_init','mobile_widget_setup');


function mobile_remove_version(){
    return '';
}

add_filter('the_generator', 'mobile_remove_version');

function custom_mobile_post_type() {
    register_post_type('mobile',
        array(
            'labels'      => array(
                'name'          => 'Mobiles',
                'singular_name' => 'Mobile',
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title', 'editor', 'thumbnail', 'custom-fields'),
           // 'taxonomies'  => array('category', 'post_tag','android_category', 'ios_category'),
            'menu_icon'   => 'dashicons-smartphone',
        )
    );


    $labels = array(
		'name' => 'Fields',
		'singular_name' => 'Field',
		'search_items' => 'Search Fields',
		'all_items' => 'All Fields',
		'parent_item' => 'Parent Field',
		'parent_item_colon' => 'Parent Field:',
		'edit_item' => 'Edit Field',
		'update_item' => 'Update Field',
		'add_new_item' => 'Add New Work Field',
		'new_item_name' => 'New Field Name',
		'menu_name' => 'Fields'
	);
	
	
	$args = array(
		'hierarchical' => true, 
		'labels' => $labels, 
		'show_ui' => true, 
		'show_admin_column' => true, 
		'query_var' => true, 
		'rewrite' => array( 'slug' => 'field' ) 
	);

    register_taxonomy('android_category', 'mobile', $args
    );

}

add_action('init', 'custom_mobile_post_type');



function add_mobile_custom_fields() {
    add_meta_box(
        'mobile_custom_fields',
        'Mobile Specifications',
        'display_mobile_custom_fields',
        'mobile',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_mobile_custom_fields');

function display_mobile_custom_fields($post) {
   
    $ram = get_post_meta($post->ID, '_ram', true);
    
    $front_camera = get_post_meta($post->ID, '_front_camera', true);
    
    $back_camera = get_post_meta($post->ID, '_back_camera', true);
    
    $screen_resolution = get_post_meta($post->ID, '_screen_resolution', true);
    
    $rom = get_post_meta($post->ID, '_rom', true);
    
    $price = get_post_meta($post->ID, '_price', true);
    ?>
    <label for="ram">RAM:</label>
    
    <input type="text" id="ram" name="ram" value="<?php echo esc_attr($ram); ?>"><br>

    <label for="front_camera">Front Camera:</label>
    
    <input type="text" id="front_camera" name="front_camera" value="<?php echo esc_attr($front_camera); ?>"><br>

    <label for="back_camera">Back Camera:</label>
    
    <input type="text" id="back_camera" name="back_camera" value="<?php echo esc_attr($back_camera); ?>"><br>

    <label for="screen_resolution">Screen Resolution:</label>
    
    <input type="text" id="screen_resolution" name="screen_resolution" value="<?php echo esc_attr($screen_resolution); ?>"><br>

    <label for="rom">ROM:</label>
    
    <input type="text" id="rom" name="rom" value="<?php echo esc_attr($rom); ?>"><br>

<label for="price">Price:</label>
<input type="text" id="price" name="price" value="<?php echo esc_attr($price); ?>"><br>
<?php
}

function save_mobile_custom_fields($post_id) {
update_post_meta($post_id, '_ram', sanitize_text_field($_POST['ram']));

update_post_meta($post_id, '_front_camera', sanitize_text_field($_POST['front_camera']));

update_post_meta($post_id, '_back_camera', sanitize_text_field($_POST['back_camera']));

update_post_meta($post_id, '_screen_resolution', sanitize_text_field($_POST['screen_resolution']));

update_post_meta($post_id, '_rom', sanitize_text_field($_POST['rom']));

update_post_meta($post_id, '_price', sanitize_text_field($_POST['price']));
}
add_action('save_post', 'save_mobile_custom_fields');


function custom_post_type_archive($query) {
    if ($query->is_archive() && $query->is_main_query()) {
        $query->set('post_type', array('post', 'mobile'));
    }
}
add_action('pre_get_posts', 'custom_post_type_archive');

function mobile_form_shortcode(){
    $form_html = '
    <form id="my_custom_form" action="submit" method="post" class="form-inline mt-2">
    <div class="form-group  ">
        <label for="name" class="sr-only w-25">Name:</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
    </div>

    <div class="form-group  mx-5">
        <label for="email" class="sr-only">Email:</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
    </div>
</form>

';

return $form_html;
}

add_shortcode( "footer_form", "mobile_form_shortcode" );

add_action('wp_ajax_contact_us','ajax_contact_us');

function ajax_contact_us(){
    error_log("AJAX Contact Us function called."); 

    $arr = [];
    wp_parse_str($_POST['contact_us'], $arr);

    error_log("Received data: " . print_r($arr, true)); 
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix . 'contact_us';
    error_log("Table: " . $table); 

    $result = $wpdb->insert($table, array(
        "Name" => $arr['name'],
        "Email" => $arr['email']
    ));

    if ($result !== false) {
        wp_send_json_success("Form submitted successfully!");
    } else {
        wp_send_json_error("Error submitting form.");
    }
}

function mobile_add_form_shortcode($atts) {
    
    $atts = shortcode_atts(
        array(
            'show_name' => true,
            'show_dimensions' => false,
            'show_ram' => false,
            'show_rom' => false,
            'show_front_camera' => false,
            'show_back_camera' => false,
            'show_price' => true,
            'show_image' => true,
        ),
        $atts,
        'mobile_form'
    );

     $atts['show_dimensions'] = filter_var($atts['show_dimensions'], FILTER_VALIDATE_BOOLEAN);
     $atts['show_ram'] = filter_var($atts['show_ram'], FILTER_VALIDATE_BOOLEAN);
     $atts['show_rom'] = filter_var($atts['show_rom'], FILTER_VALIDATE_BOOLEAN);
     $atts['show_front_camera'] = filter_var($atts['show_front_camera'], FILTER_VALIDATE_BOOLEAN);
     $atts['show_back_camera'] = filter_var($atts['show_back_camera'], FILTER_VALIDATE_BOOLEAN); 

    ob_start();
    ?>
    <form id="mobile_custom_form" action="#" method="post" class="form mt-2" enctype="multipart/form-data">
        <?php if ($atts['show_name']) : ?>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="mobileName">Mobile Name:</label>
                    <input type="text" class="form-control" id="mobileName" name="mobileName" placeholder="Mobile Name" required>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($atts['show_dimensions']) : ?>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="dimensions">Dimensions:</label>
                    <input type="text" class="form-control" id="dimensions" name="dimensions" placeholder="Dimensions" required>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($atts['show_ram']) : ?>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="ram">RAM:</label>
                    <input type="text" class="form-control" id="ram" name="ram" placeholder="RAM">
                </div>
            </div>
        <?php endif; ?>

        <?php if ($atts['show_rom']) : ?>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="rom">ROM:</label>
                    <input type="text" class="form-control" id="rom" name="rom" placeholder="ROM">
                </div>
            </div>
        <?php endif; ?>

        <?php if ($atts['show_front_camera']) : ?>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="frontCamera">Front Camera:</label>
                    <input type="text" class="form-control" id="frontCamera" name="frontCamera" placeholder="Front Camera">
                </div>
            </div>
        <?php endif; ?>

        <?php if ($atts['show_back_camera']) : ?>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="backCamera">Back Camera:</label>
                    <input type="text" class="form-control" id="backCamera" name="backCamera" placeholder="Back Camera">
                </div>
            </div>
        <?php endif; ?>

        <?php if ($atts['show_price']) : ?>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                </div>
            </div>
        <?php endif; ?>

        <?php if ($atts['show_image']) : ?>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="mobileImage">Mobile Image:</label>
                    <input type="file" class="form-control-file" id="mobileImage" name="mobileImage">
                </div>
            </div>
        <?php endif; ?>

        <button type="button" class="btn btn-primary" id="submit_mobile_form">Submit</button>
    </form>

    <script>
        jQuery(document).ready(function ($) {
            $('#submit_mobile_form').on('click', function () {
                var formData = new FormData($('#mobile_custom_form')[0]);
                var link = "<?php echo admin_url('admin-ajax.php'); ?>";
                formData.append('action', 'mobile_form');
                formData.append('nonce', $('#nonce').val());

                $.ajax({
                    type: 'POST',
                    url: link,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            $('#response_message').html('<p style="color: green;">Response recorded</p>');
                        } else {
                            $('#response_message').html('<p style="color: red;">Try again</p>');
                        }
                    },
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

add_shortcode("mobile_form", "mobile_add_form_shortcode");


add_action('wp_ajax_mobile_form', 'handle_mobile_form_submission');
add_action('wp_ajax_nopriv_mobile_form', 'handle_mobile_form_submission');

function handle_mobile_form_submission() {
    check_ajax_referer('mobile_form_nonce', 'nonce');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'mobile_form') {
        $mobile_name = sanitize_text_field($_POST['mobileName']);
        $dimensions = sanitize_text_field($_POST['dimensions']);
        $ram = sanitize_text_field($_POST['ram']);
        $rom = sanitize_text_field($_POST['rom']);
        $front_camera = sanitize_text_field($_POST['frontCamera']);
        $back_camera = sanitize_text_field($_POST['backCamera']);
        $price = sanitize_text_field($_POST['price']);

        $post_id = wp_insert_post(array(
            'post_title' => $mobile_name,
            'post_content' => '',
            'post_type' => 'mobile',
            'post_status' => 'publish',
        ));

        update_post_meta($post_id, '_dimensions', $dimensions);
        update_post_meta($post_id, '_ram', $ram);
        update_post_meta($post_id, '_rom', $rom);
        update_post_meta($post_id, '_front_camera', $front_camera);
        update_post_meta($post_id, '_back_camera', $back_camera);
        update_post_meta($post_id, '_price', $price);

        if (!empty($_FILES['mobileImage']['name'])) {
            $uploaded_file = wp_handle_upload($_FILES['mobileImage'], array('test_form' => false));
            if (!isset($uploaded_file['error'])) {
                update_post_meta($post_id, '_mobile_image', $uploaded_file['url']);
            } else {
                error_log("Error uploading file: " . $uploaded_file['error']); 
            }
        }

        wp_send_json_success("Form submitted successfully!");
    } else {
        wp_send_json_error("Error submitting form.");
    }

    wp_die();
}


?>


